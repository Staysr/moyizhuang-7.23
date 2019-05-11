<?php
if (!defined('IN_DZZ')) {
    exit('Access Denied');
}
require 'conf.php';
require libfile('class/yzOffice');
require libfile('function/yzoffice');

$dzzpath = $_GET['path'];
$do = trim($_GET['do']);
$path = dzzdecode($dzzpath);
$fileinfo = IO::getMeta($path);
$fileName = $fileinfo['name'];

$respath =downfile($fileinfo);//可以通过file_get_contents打开的地址
$resfilename = basename($respath);
//上传到永中解析
$mode = 1;//用于是否返回高清(1非高清  0高清)
$oyzoffice = new yzOffice($mode,$respath);
if($do == 'transfor'){
    transfor($oyzoffice);
} elseif ($do == 'getfile') {
    $file = $_GET['file'];
    $oyzoffice->getFile($file);
} else {
    if(!$oyzoffice->task['success']){
        include template('index');
        exit();
    }
    $task = $oyzoffice->task;

    $result = $task['steps'][count($oyzoffice->task['steps']) - 1]['result'];
    $html = $result['data'][0];
    $pageFile = $oyzoffice->cachePath.md5($html).'.'.fileext($html);
    if(!file_exists($pageFile)){
        $result = url_request($html,'GET');
        if($result['code'] == 200){
            $titlt = '<title>永中文档转换服务</title>';
            $content = str_replace($titlt,'<title>'.$fileName.'   永中文档</title>',$result['data']);
            file_put_contents($pageFile,$content);
        }else{
            $oyzoffice->clearChche();
            showmessage(lang('error_try_again'));
        }
    }else{
        $content = file_get_contents($pageFile);
    }
    //替换内容
    $pagePath = dirname($html).'/';
    $pageID = rtrim(basename($html),'.html').'.files/';
    $urlTo = $pagePath.$pageID;
 
    //文件缓存
    $urlTo = MOD_URL.'&do=getfile&path='.rawurlencode($dzzpath).'&file='.rawurlencode($urlTo);//不用缓存将此行注释
    $content = str_replace($pageID,$urlTo,$content);
    $content = str_replace('./http','http',$content);
    $content = str_replace($resfilename,$fileName,$content);
    $content = str_replace(array('<!DOCTYPE html>','<html>','<head>','</html>'),'',$content);
    
    include template('header');
	
    echo $content;
}

function transfor($obj){
    if(!is_object($obj)){
        return false;
    }
    $obj->runTask();
}




