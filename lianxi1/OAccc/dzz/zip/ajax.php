<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
//ini_set("display_errors","On");
//error_reporting(E_ALL);
require_once libfile('function/zip');
//设定操作系统编码（生成临时文件时转码）；

/*@ini_set("memory_limit",'2048');//内存限制调大；
@set_time_limit(0);//执行时间调大；
*/
$do=$_GET['do'];
if($do=='init'){
}elseif($do=='prepare'){//下载打开压缩文档
	if($path=dzzdecode(rawurldecode($_GET['path']))){//将压缩文件添加到压缩处理目录
	    $name=random(32);
		if($zip=zip_addfile($path,ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$name.'.zip')){
			exit(json_encode(array('msg'=>'success','zip'=>$name.'.zip')));
		}else{
			exit(json_encode(array('error'=>'下载待解压文档失败')));
		}
	}else{
		exit(json_encode(array('error'=>'文件不存在！')));
	}

}elseif($do=='getfolder'){
//创建临时目录
	$folder=random(32);
	if($zip=$_GET['zip']){
		$zip=ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$zip;
		if($ret=zip_extract($zip,$folder)){
			if($ret['error']) exit(json_encode($ret));
		}
	}
	$folder=dzzencode($folder);
	exit(json_encode(array('folder'=>$folder,'comment'=>$ret['comment'])));
	
}elseif($do=='getfolderinfo'){
	$list=array();
	if($folder=dzzdecode($_GET['folder'])){
		$list=getFolderInfo($folder);
	}
	include template('main-item');
}elseif($do=='add'){
	$path=$_GET['path'];
	$folder=dzzdecode($_GET['folder']);
	
	if(!$meta=IO::getMeta($path)){
		exit(json_encode(array('error'=>'没有获取到此文件')));
	}

	if($meta['type']=='folder'){
		$meta['img']='dzz/images/default/system/folder.png';
		$tpath=ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.diconv($meta['name'],CHARSET,getglobal('config/system_charset'));
		zip_addfolder($meta['path'],$tpath);
	}else{
		$tpath=ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.diconv($meta['name'],CHARSET,getglobal('config/system_charset'));
		zip_addfile($meta['path'],$tpath);
	}
	$meta['folder']=dzzencode($folder.DIRECTORY_SEPARATOR.diconv($meta['name'],CHARSET,getglobal('config/system_charset')));
	$meta['dpath']=dzzencode('TMP::'.TMPPRE.'/'.$folder.DIRECTORY_SEPARATOR.diconv($meta['name'],CHARSET,getglobal('config/system_charset')));
	exit(json_encode($meta));
}elseif($do=='save'){
	if(!$folder=dzzdecode($_GET['folder'])){
		exit(json_encode(array('error'=>'获取目录信息错误')));
	};
	$comment=htmlspecialchars($_GET['comment']);
	$arr=explode('/',$folder);
	$folder=$arr[0];
	if($_GET['action']=='saveto'){
		$path=$_GET['path'];
		$filename=$_GET['filename'];
		$ret=zip_save($folder,$path,$filename,'saveto',$comment);
	}else{
		$path=dzzdecode($_GET['path']);
		$ret=zip_save($folder,$path,'','save',$comment);
	}
	if($ret){
		exit(json_encode($ret));
	}else{
		exit(json_encode(array('error'=>'保持失败')));
	}
}elseif($do=='extractTo'){
	$folder=dzzdecode($_GET['folder']);
	$list=$_GET['list'];
	$path=$_GET['position'];
	if($list){
		$ret=zip_extractTo($list,$path);
	}elseif($folder){
		$ret=zip_extractTo('',$path,$folder);
	}else{
		exit(json_encode(array('error'=>'获取目录信息错误')));
	}
	exit(json_encode($ret));
}elseif($do=='delete'){//删除选中的文件
	$list=$_GET['list'];
	foreach($list as $value){
		$file=ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.dzzdecode($value);
		if(is_file($file))	@unlink($file);
		else if(is_dir($file)) removedir($file); 
	}
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='empty'){//清空文件夹
	$folder=dzzdecode($_GET['folder']);
	removedir(ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$folder);
	exit(json_encode(array('msg'=>'success')));
}
?>
