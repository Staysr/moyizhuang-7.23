<?php
/**
 * 文件同步控制器
 */
namespace Cron\Controller;

use Common\Controller\CronController;

class FileController extends CronController {

    public $syncLog;
    public $model;
    public $serverUrl = 'http://stb.bjdagong.com.cn';

    public function __construct() {
	parent::__construct();
	set_time_limit(0);
	$this->syncLog = APP_PATH . "log/syncFileLog.txt";
	$this->model = M('image');
    }

    /**
     * 初始化【统计】
     */
    public function initialize() {
	fileStatInitialize('./Public/Upload', $this->model);
	fileStatInitialize('./Public/questions', $this->model);
    }

    /**
     * 增量同步
     */
    public function sync() {
	if (file_exists($this->syncLog)) {
	    $id = file_get_contents($this->syncLog);
	} else {
	    $id = 0;
	}

	$data = $this->model->where("id >{$id}")->limit(200)->select();
	while (!empty($data)) {
	    foreach ($data as $file) {
		echo $file['id'] . "\n";
		$_path = $file['path'] . $file['name'] . '.' . $file['ext'];
		$fileUrl = $this->serverUrl . $_path;
		if (file_exists('.' . $_path)) {
		    continue;
		}
		$result = httpcopy($fileUrl, ".{$_path}");
		if ($result === false) {
		    sendMail('76723287@qq.com', '文件同步错误', json_encode($file));
		    echo 'error';
		    exit;
		}
		file_put_contents($this->syncLog, $file['id']);
	    }
	    $data = $this->model->where("id >{$file['id']}")->limit(200)->select();
	}
    }

}
