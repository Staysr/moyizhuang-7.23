<?php

namespace Cron\Controller;

use Common\Controller\CronController;

class AnswerController extends CronController {

    public $testModel;
    public $testLogModel;
    public $wrongModel;
    public $questionModel;
    public $statisticalModel;
    public $statUserQuestion;

    public function __construct() {
        parent::__construct();
        $this->testModel = M('answer_test');
        $this->testLogModel = M('answer_test_log');
        $this->wrongModel = M('answer_wrong');
        $this->questionModel = M('paper_question');
        $this->statisticalModel = M('answer_test_statistical');
    }

    public function index() {
        echo IS_CLI;
    }

    /**
     * 评卷
     */
    public function evaluation() {
        /**
         * TIP:过期没有交卷的测试，过滤掉
         */
        //查询交卷但未评卷的记录
        $data = $this->testModel->where("answer_time > 0 and evaluation = 0")->limit(100)->select();

        if (empty($data)) {
            exit;
        }

        //遍历试卷 评卷 并记录日志
        foreach ($data as $test) {
            //查询出试题
            $question = $this->questionModel->where("id in ({$test['qid']})")->field('id,answer')->select();
            //用户答案
            $userAnswer = json_decode($test['answer'], true);
            $answer = $this->mark($question, $userAnswer); //核对答案

            $tmp = array(
                'test_id' => $test['id'],
                'userid' => $test['userid'],
                'test_time' => $test['answer_time']
            );

            $right = 0; //回答正确数
            foreach ($answer as $qid => $r) {
                $r == 1 ? $right++ : ''; //如果正确，正确数加1
                //记录日志
                $log = array(
                    'qid' => $qid,
                    'result' => $r,
                    'add_time' => time()
                );
                $lastLogId = $this->testLogModel->add(array_merge($tmp, $log));

                //错题记录
                $isWrong = $this->wrongModel->where("userid = {$test['userid']} and qid = {$qid}")->find();
                if (!empty($isWrong)) {
                    if ($r == 2) {
                        $isWrong['times'] = $isWrong['times'] + 1;
                    } else {
                        $isWrong['right'] = $isWrong['right'] + 1;
                        if (!$isWrong['is_del'] && $isWrong['right'] > 2) {//做对三次即标识删除
                            $isWrong['is_del'] = 1;
                        }
                    }
                    $this->wrongModel->save($isWrong);
                } elseif ($r == 2) {
                    $wrong = array(
                        'userid' => $test['userid'],
                        'qid' => $qid,
                        'times' => 1,
                        'add_time' => time()
                    );
                    $this->wrongModel->add($wrong);
                }
            }

            //更新当前记录
            $update = array(
                'evaluation' => 1,
                'right' => $right,
                'evaluation_time' => time()
            );
            $this->testModel->where('id = ' . $test['id'])->save($update);

            //更新用户做题数量
            $this->statistical($test['userid'], $lastLogId);
        }
    }

    /**
     * 核对答案
     */
    private function mark($question, $userAnswer) {
        $answer = array();
        foreach ($question as $q) {
            if (isset($userAnswer[$q['id']]) && $userAnswer[$q['id']]) {
                if ($q['answer'] == $userAnswer[$q['id']]) {
                    $result = 1;
                } elseif (strlen($q['answer']) != strlen($userAnswer[$q['id']])) {
                    $result = 2;
                } else {
                    $result = array_diff(str_split(strtolower($q['answer'])), str_split(strtolower($userAnswer[$q['id']]))) ? 2 : 1; //差集为空时正确
                }
            } else {
                $result = 2;
            }
            $answer[$q['id']] = $result;
        }
        return $answer;
    }

    /**
     * 统计用户做题数数量[一级分类]
     */
    public function statistical($uid, $lastLogId = 0) {

        $sql = "SELECT count(qid) as num,type from (SELECT qid from app_answer_test_log  where userid={$uid}  GROUP BY qid) as log, app_paper_question as question where log.qid= question.id GROUP BY question.type";
        $result = $this->testLogModel->query($sql);

        $data = array();
        foreach ($result as $type) {
            $data['type' . $type['type'] . '_number'] = $type['num'];
        }

        $data['last_log_id'] = $lastLogId;

        $check = $this->statisticalModel->where("userid = {$uid}")->find();

        if ($check) {
            $this->statisticalModel->where("userid = {$uid}")->save($data);
        } else {
            $data['userid'] = $uid;
            $data['add_time'] = time();
            $this->statisticalModel->add($data);
        }
    }

    /**
     * 统计试题分类数量
     */
    public function statisticalTypeNum() {
        $upTopSql = "UPDATE app_question_type as qt,(SELECT type,count(id) as total from app_paper_question where status = 1 GROUP BY type) as pq set qt.total = pq.total where qt.id=pq.type";
        $upSupSql = "UPDATE app_question_type as qt,(SELECT subtype,count(id) as total from app_paper_question where status = 1 GROUP BY subtype) as pq set qt.total = pq.total where qt.id=pq.subtype";
        $upMinSql = "UPDATE app_question_type as qt,(SELECT min_type,count(id) as total from app_paper_question where status = 1 GROUP BY min_type) as pq set qt.total = pq.total where qt.id=pq.min_type";

        $model = M();
        $model->execute($upTopSql);
        $model->execute($upSupSql);
        $model->execute($upMinSql);
    }

    /**
     * 按分类统计用户做题数及正确率
     * @date 2018-01-21
     */
    public function statUserQuestion() {
        $this->statUserQuestion = $model = M('answer_user_statistical');
        /* 增量用户 */
        //先找出增量做题的用户
        $newUserSql = "SELECT DISTINCT userid from app_answer_test_log where userid not in(SELECT userid from app_answer_user_statistical) limit 100";
        $newUser = $model->query($newUserSql);
        if (!empty($newUser)) {
            foreach ($newUser as $user) {
                $data = $this->_statUserQuestion($user['userid']);
                $model->add($data);
            }
        }

        //增量做题
        $newAnswerSql = "SELECT anlog.userid from (SELECT userid,max(id) as maxid from app_answer_test_log GROUP BY userid) as anlog,app_answer_user_statistical as stat
            where anlog.userid = stat.userid and anlog.maxid > stat.max_log_id";
        $newAnswer = $model->query($newAnswerSql);
        if (!empty($newAnswer)) {
            foreach ($newAnswer as $user) {
                $data = $this->_statUserQuestion($user['userid']);
                $model->where("userid = {$user['userid']}")->save($data);
            }
        }
    }

    /**
     * 统计一个用户按分类的做题量和正确率
     * @param type $userid
     * @return type
     * @date 2018-01-21
     */
    private function _statUserQuestion($userid) {
        $sql = "SELECT DISTINCT max(anlog.id) as maxlogid,anlog.userid,pq.type,pq.subtype,pq.min_type,count(*) as num,count(if(anlog.result=1,true,null)) AS success from app_answer_test_log as anlog,app_paper_question as pq
                where userid = {$userid} and anlog.qid=pq.id GROUP BY pq.type,pq.subtype,min_type;";
        $result = $this->statUserQuestion->query($sql);
        $data = array();
        $maxLogId = 0;
        foreach ($result as $row) {
            $top = $row['type'];
            $sub = $row['subtype'];
            $min = $row['min_type'];
            $maxLogId = $maxLogId < $row['maxlogid'] ? $row['maxlogid'] : $maxLogId;
            if ($min) {
                $data[$min]['num'] = $row['num'];
                $data[$min]['success'] = $row['success'];
            }

            if (isset($data[$sub])) {
                $data[$sub]['num'] += $row['num'];
                $data[$sub]['success'] += $row['success'];
            } else {
                $data[$sub]['num'] = $row['num'];
                $data[$sub]['success'] = $row['success'];
            }

            if (isset($data[$top])) {
                $data[$top]['num'] += $row['num'];
                $data[$top]['success'] += $row['success'];
            } else {
                $data[$top]['num'] = $row['num'];
                $data[$top]['success'] = $row['success'];
            }
        }

        return array(
            'userid' => $userid,
            'detail' => json_encode($data),
            'max_log_id' => $maxLogId,
            'add_time' => time()
        );
    }

}
