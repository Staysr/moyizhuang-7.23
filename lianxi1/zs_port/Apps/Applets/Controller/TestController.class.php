<?php

namespace Applets\Controller;

use Common\Controller\AppletsController;

class TestController extends AppletsController {

    
    public function index(){
      
	  //exit;
	   //先处理图片上传
            if (isset($_FILES['file']) && $_FILES['file']['name'] && !$_FILES['file']['error']) {
                $upResult = $this->_upload2($_FILES['file'], '/Public/Upload/cover/ttest/');
                echo json_encode($upResult);
				
    }
	
	}
	
	  /**
     * 处理单文件上传
     * @param type $file
     * @return type
     */
    public function _upload2($file, $path = '/Public/Upload/', $exts = array(), $size = 102400000) {
   
        $imageInfo = pathinfo($file['name']);
		
        $uploadPath = ROOT_PATH . $path;
		
        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 777, true);
        }

        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = $size; // 设置附件上传大小
        $upload->saveName = date('YmdHis') . mt_rand(1000, 9999); //文件名规则
        $upload->autoSub = false; //关闭子目录
        $upload->exts = $exts; // 设置附件上传类型
        $upload->rootPath = $uploadPath; // 设置附件上传根目录
        $upload->savePath = date('Ym') . '/';
        // 上传单个文件
        $info = $upload->uploadOne($file);
        if (!$info) {// 上传错误提示错误信息
            return array('code' => 1, 'msg' => $upload->getError()); //;
        } else {// 上传成功 获取上传文件信息并记录到数据库
           return array('code' => 0, 'msg' => '上传成功'); //;
        }
    }

	
}