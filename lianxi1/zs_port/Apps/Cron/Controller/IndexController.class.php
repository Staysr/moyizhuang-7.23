<?php

namespace Cron\Controller;

use Common\Controller\CronController;

class IndexController extends CronController {

    public function index() {
        echo IS_CLI;
    }

    public function test() {
        $time = time();
        sendMail('76723287@qq.com', 'crontab-test', '执行时间<br/>' . date('Y-m-d H:i:s'));
    }

    /**
     * 将新增加IPP写成文件
     */
    public function ipBlacklist() {
        $fileName = './ipBlacklistId.log';
        if (file_exists('ipBlacklistId.log')) {
            $id = (int) file_get_contents($fileName);
        } else {
            $id = 0;
        }

        $data = M("ip_blacklist")->where("id > {$id}")->select();

        if (empty($data)) {
            exit;
        }
        $str = '';
        foreach ($data as $ipRow) {
            $str .= "iptables -I INPUT -s {$ipRow['ip']} -j DROP" . "\n";
        }
        //iptables 语句
        file_put_contents('./iptables.txt', $str);
        //记录最大id
        file_put_contents($fileName, $ipRow[id]);
    }

    /**
     * 将原来已有的试卷导入新的试卷表
     */
    public function syncpaper() {
        $oldPaper = M('paper_xingce_170516')->select();
        $paperModel = M('paper_xingce');
        $questionModel = M('paper_question');
        $detailModel = M('paper_xingce_detail');
        $n = 0;
        foreach ($oldPaper as $old) {
            $pid = $old['id'];
            $paperData = array();
            $paperData['title'] = $old['title'];
            $paperData['year'] = $old['year'];
            if ($old['area_id']) {
                $paperData['area'] = "-{$old['area_id']}-";
            } else {
                $paperData['area'] = '';
            }
            $paperData['add_time'] = time();


            $questionList = $questionModel->where("paper_id = {$pid}")->order("paper_code")->field('id,paper_code,information_id')->select();
            if ($questionList && count($questionList) > 80) {
                $n++;
                $newPid = $paperModel->add($paperData);

                $info = array();
                foreach ($questionList as $qustion) {
                    $matter = array('paperid' => $newPid);

                    if ($qustion['information_id'] && $qustion['id'] > 80) {
                        $matter['item'] = 5;
                    } else {
                        $matter['item'] = floor($qustion['paper_code'] / 25);
                        $matter['item'] = $matter['item'] ? $matter['item'] : 1;
                    }

                    $matter['dataid'] = $qustion['id'];
                    $matter['type'] = 1;
                    $matter['number'] = $qustion['paper_code'];

                    echo $qustion['paper_code'] . "<br/>";
                    $matter['add_time'] = time();
                    $detailModel->add($matter);

                    if ($qustion['information_id'] && !isset($info[$qustion['information_id']])) {
                        $info[$qustion['information_id']] = $qustion['paper_code'];
                    }
                }

                //资料
                if (!empty($info)) {
                    foreach ($info as $inid => $fo) {
                        $matter = array('paperid' => $newPid);
                        if ($fo > 80) {
                            $matter['item'] = 5;
                        } else {
                            $matter['item'] = floor($fo / 25);
                        }
                        $matter['dataid'] = $inid;
                        $matter['type'] = 2;
                        $matter['number'] = $fo;
                        $matter['add_time'] = time();
                        $detailModel->add($matter);
                    }
                }
                echo $n . '-------' . $pid . '<br/>';
            }
        }
    }

    /**
     * 手机号归属地查询
     */
    public function mobileattr() {

        $attrModel = M('mobile_attr');
        $userModel = M('user');
        $lastUser = $attrModel->order('id desc')->find();

        if (empty($lastUser)) {
            $lastUserId = 0;
        } else {
            $lastUserId = $lastUser['id'];
        }

        $userList = $userModel->field('id,account')->where("id > {$lastUserId}")->limit(1000)->select();

        if (empty($userList)) {
            exit;
        }

        foreach ($userList as $user) {
            $attrData = array();
            $attrData['id'] = $user['id'];
            $attrData['account'] = $user['account'];
            $attrData['created'] = time();

            if (is_numeric($user['account'])) {
                $attrDetail = mobileAttr($user['account']);
                if (empty($attrDetail)) {
                    $attrData['ret'] = 2;
                } else {
                    $attrData['ret'] = $attrDetail['ret'];
                    $attrData['error_msg'] = $attrDetail['errorMsg'];

                    if ($attrDetail['ret'] == 200) {
                        $attrData = array_merge($attrData, $attrDetail['data']);
                    }
                }
            } else {
                $attrData['ret'] = 1;
            }

            $attrModel->add($attrData);
        }
    }

}
