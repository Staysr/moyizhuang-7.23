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
$operation=empty($_GET['operation'])?'':trim($_GET['operation']);
if($operation=='deleteUser'){
	if($taskboard['perm']<3){
		exit(json_encode(array('error'=>'没有权限')));
	}
	$uid=intval($_GET['uid']);
	$arr=array();
	if($return=C::t('task_board_user')-> remove_uid_by_tbid($tbid,$uid)){
		if(is_array($return) && $return['error']){
			$arr['error']=$return['error'];
		}else{
			$arr['msg']='success';
		}
	}else{
		$arr['error']='删除失败';
	}
	exit(json_encode($arr));
}elseif($operation=='changeUserPerm'){
	if($taskboard['perm']<3){
		exit(json_encode(array('error'=>'没有权限')));
	}
	$uid=intval($_GET['uid']);
	$perm=intval($_GET['perm']);
	$arr=array();
	if($return=C::t('task_board_user')-> change_perm_by_uid($tbid,$uid,$perm)){
		if(is_array($return) && $return['error']){
			$arr['error']=$return['error'];
		}else{
			$arr['msg']='success';
		}
	}else{
		$arr['error']='删除失败';
	}
	exit(json_encode($arr));
}
?>
