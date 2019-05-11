<?php
if(!defined('VER'))exit('非法访问!');
require_once(PATH.'/Common/common.php');
if(!isset($_SESSION['authcode'])) {
	$query=file_get_contents('http://auth.lxlby.cn/check.php?url='.$_SERVER['HTTP_HOST'].'&authcode='.$authcode);
	if($query=json_decode($query,true)) {
	if($query['code']==1)$_SESSION['authcode']=true;
		else exit('<h3>'.$query['msg'].'</h3>');
	}
}
if (!$islogin){
	msg('请先进行登录再访问本页面!','/index.php?mod=login');
}else if ($userrow['active'] < 8 or $userrow['active'] > 9 ){
	msg('你没有权限访问该页面');
}