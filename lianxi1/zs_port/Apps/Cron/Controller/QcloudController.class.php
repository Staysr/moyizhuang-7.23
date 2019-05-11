<?php

/**
 * 腾讯云相关定时任务
 */

namespace Cron\Controller;

use Common\Controller\CronController;

class QcloudController extends CronController {

    public $config;

    public function __construct() {
        parent::__construct();
        $config = array();
        $config['SecretId'] = C('SECRET_ID');
        $config['SecretKey'] = C('SECRET_KEY');
        $config['RequestMethod'] = C('REQUEST_METHOD');
        $config['DefaultRegion'] = C('DEFAULT_REGION');
        $this->config = $config;
    }

    /**
     * 同步点播视频信息列表
     * 接口名：DescribeVodInfo
     */
    public function syncVod() {
        //引入第三方类库
        vendor('QcloudApi.QcloudApi');
        $vod = \QcloudApi::load('vod', $this->config);

        //同步前先清空历史同步的信息
        M()->execute('truncate table app_qcloud_video_info');
        M()->execute('truncate table app_qcloud_video_playurls');

        $page = 1;
        $pageSize = 100;
        $package = array('Action' => 'DescribeVodInfo', 'pageNo' => $page, 'pageSize' => $pageSize);

        $list = $vod->DescribeVodInfo($package);

        while ($list) {
            if (!isset($list['fileSet']) || empty($list['fileSet'])) {
                break;
            }
            $data = $this->_accVodInfo($list['fileSet']);
            M('qcloud_video_info')->addAll($data);
            $package['pageNo'] ++;
            $list = $vod->DescribeVodInfo($package);
        }

        if ($list === false) {
            $error = $vod->getError();
            $html = "<h3>获取视频信息列表失败</h3><br/>";
            $html.= "Error code:" . $error->getCode() . "。<br/>";
            $html.= "message:" . $error->getMessage() . "。<br/>";
            $html.= "ext:" . var_export($error->getExt(), true) . "。<br/>";
            sendMail('76723287@qq.com', '获取视频信息列表失败', $html);
        }
    }

    /**
     * 自动同步增量点播视频信息列表
     * 接口名：DescribeVodInfo
     */
    public function autoSyncVod() {
        //引入第三方类库
        vendor('QcloudApi.QcloudApi');
        $vod = \QcloudApi::load('vod', $this->config);

        //先找到最后更新的时间
        $lastRow = M('qcloud_video_info')->field('id,fileId,createTime')->order('createTime desc')->find();
        $from = date('Y-m-d H:i:s', $lastRow['createtime'] + 1);
        $to = date('Y-m-d H:i:s');
        $page = 1;
        $pageSize = 100;
        $success = 0;
        $package = array('Action' => 'DescribeVodInfo', 'pageNo' => $page, 'pageSize' => $pageSize, 'from' => $from, 'to' => $to);

        $list = $vod->DescribeVodInfo($package);

        while ($list) {
            if (!isset($list['fileSet']) || empty($list['fileSet'])) {
                break;
            }
            $data = $this->_accVodInfo($list['fileSet']);
            $success+=count($data);
            M('qcloud_video_info')->addAll($data);
            $package['pageNo'] ++;
            $list = $vod->DescribeVodInfo($package);
        }

        if ($list === false) {
            $error = $vod->getError();
            $html = "<h3>自动获取视频信息列表失败</h3><br/>";
            $html.= "Error code:" . $error->getCode() . "。<br/>";
            $html.= "message:" . $error->getMessage() . "。<br/>";
            $html.= "ext:" . var_export($error->getExt(), true) . "。<br/>";
            sendMail('76723287@qq.com', '自动获取视频信息列表失败', $html);
        }
        if ($success) {
            $this->sendMail('自动同步增量点播视频信息列表成功', date("Y-m-d H:i:s") . "<br/>共获取{$success}条");
            sleep(10);
            $this->getVodInfo();
        }
    }

    /**
     * 获取视频详细信息(视频播放列表)
     * 接口名：DescribeVodPlayUrls
     */
    public function getVodInfo() {
        //引入第三方类库
        vendor('QcloudApi.QcloudApi');
        $vod = \QcloudApi::load('vod', $this->config);
        //var_dump($this->config);
        $package = array(); //array('Action' => 'DescribeVodPlayUrls');
        $vodModel = M('qcloud_video_info');
        $page = 1;
        $pageSize = 100;
        $success = 0;
        $list = $vodModel->field('id,fileId,vid,duration')->where('infoFlag = 1')->page($page, $pageSize)->select();

        while ($list) {
            foreach ($list as $row) {
                $package['fileId'] = $row['fileid']; //需要转小写
                $result = $vod->DescribeVodPlayUrls($package);
                if ($result === false) {
                    $error = $vod->getError();
                    $html = "<h3>获取视频详情信息失败</h3><br/>";
                    $html.= "fileId:" . $row['fileid'] . "。<br/>";
                    $html.= "Error code:" . $error->getCode() . "。<br/>";
                    $html.= "message:" . $error->getMessage() . "。<br/>";
                    $html.= "ext:" . var_export($error->getExt(), true) . "。<br/>";
                    sendMail('76723287@qq.com', '获取视频信息列表失败', $html);
                } else {
                    $data = $this->_accVodPlayurls($result['playSet'], $row);
                    $result = $this->_insertPlayurls($data, $row);
                    if ($result) {
                        $success+= count($data);
                    } else {
                        $this->sendMail('记录视频播放列表失败', "fileId:{$row['fileid']}");
                    }
                }
            }
            $page++;
            $list = M('qcloud_video_info')->field('id,fileId,vid')->where('infoFlag = 1')->page($page, $pageSize)->select();
        }

        if ($success) {
            $this->sendMail('获取视频播放地址列表成功', date("Y-m-d H:i:s") . "<br/>共获取{$success}条");
        }
    }

    /**
     * 记录播放列表并标识视频主表已同步
     * @param type $data
     * @param type $row
     * @param type $model
     * @return boolean
     */
    private function _insertPlayurls($data, $row) {
        $model = M('qcloud_video_info');
        try {
            $model->startTrans();
            $result = M('qcloud_video_playurls')->addAll($data);
            $updateR = $model->where("id = {$row['id']}")->save(array('infoFlag' => 2));
            if ($result && $updateR) {
                $model->commit();
                return true;
            } else {
                $model->rollback();
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 处理DescribeVodInfo接口返回的视频列表以便存入数据库
     * @param type $fileSet
     * @return type
     */
    private function _accVodInfo($fileSet) {
        if (empty($fileSet)) {
            return array();
        }
        $tmp = array();
        $time = time();
        foreach ($fileSet as $row) {
            $row['createTime'] = strtotime($row['createTime']);
            $row['updateTime'] = strtotime($row['updateTime']);
            $row['tags'] = implode(',', $row['tags']);
            $row['syncTime'] = $time;
            $tmp[] = $row;
        }
        return $tmp;
    }

    /**
     * 处理视频播放列表信息
     * @param type $playSet
     * @param type $vod
     * @return type
     */
    private function _accVodPlayurls($playSet, $vod) {
        if (empty($playSet)) {
            return array();
        }
        $tmp = array();
        $time = time();
        foreach ($playSet as $play) {
            $play['fileId'] = $vod['fileid'];
            $play['vid'] = $vod['vid'];
            $play['duration'] = $vod['duration'];
            $play['addTime'] = $time;
            $tmp[] = $play;
        }
        return $tmp;
    }

    /**
     * 报警邮件
     * @param type $title
     * @param type $html
     */
    private function sendMail($title = '异常', $html = '异常') {
        sendMail('76723287@qq.com', $title, $html);
    }

}
