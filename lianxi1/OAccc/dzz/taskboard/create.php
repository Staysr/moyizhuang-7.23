<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
if(empty($_G['uid'])) {
	showmessage('login');
}
include_once libfile('function/taskboard');

$orgid=intval($_GET['orgid']);
$newarr=createBoardPerm($orgid);
if($newarr['errmsg']){
	showmessage($newarr['errmsg']);
}
if(submitcheck('createsubmit')){
	$setarr=array('name'=>str_replace('...','',getstr($_GET['name'],80)),
				  'viewperm'=>intval($_GET['viewperm']),
				  'aid'=>intval($_GET['aid']),
				  'layout'=>intval($_GET['layout'])
				  );
	
		$setarr['dateline']=TIMESTAMP;
		$setarr['uid']=$_G['uid'];
		$setarr['username']=$_G['username'];
		if($tbid=C::t('task_board')->insert_by_tbid($setarr)){
			showmessage('do_success',$_GET['refer']);
		}else{
			showmessage('未知错误',$_GET['refer']);
		}
}else{
	$refer=dreferer();
	$taskboard=array();

	$navtitle='创建任务板 - 任务板';
	$navlast=' 创建任务板';
	
	
	$taskboard['aid']=1;
	
}
if($ismobile){
	$refer=dreferer();
	include template('mobile/taskboard_create');	
}else{
	include template('taskboard_create');	
}


?>
