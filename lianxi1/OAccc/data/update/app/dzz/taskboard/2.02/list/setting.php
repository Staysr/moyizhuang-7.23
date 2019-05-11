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
$operation=trim($_GET['operation']);
if($taskboard['perm']<3){
	if($operation)	exit(json_encode(array('error'=>'管理员管理部分，普通用户无权限')));
	else showmessage('管理员管理部分，普通用户无权限');
}
$setting=C::t('task_setting')->fetch_all(array('moderators','maxboard','allownewboard'));

if(submitcheck('settingsubmit')){
	$setarr=$_GET['setting'];
	$setarr['name']=getstr($setarr['name'],80);
	C::t('task_board')->update_by_tbid($tbid,$setarr);
	exit(json_encode($setarr));
}elseif($operation=='setViewperm'){
	$viewperm=intval($_GET['viewperm']);
	if(C::t('task_board')->update_by_tbid($tbid,array('viewperm'=>$viewperm))){
		exit(json_encode(array('msg'=>'success','viewperm'=>$viewperm)));
	}
	exit(json_encode(array('error'=>'设置失败')));
}elseif($operation=='getContens'){
	if($taskboard['orgid']) $org=C::t('task_organization')->fetch($taskboard['orgid']);
	include template('list/board_setting');
	exit();
}elseif($operation=='archive'){	
	if(C::t('task_board')->archive_by_tbid($tbid)){
		exit(json_encode(array('msg'=>'success')));
	}	
	exit(json_encode(array('error'=>'归档失败')));
	
}elseif($operation=='active'){	
	if(C::t('task_board')->active_by_tbid($tbid)){
	exit(json_encode(array('msg'=>'success')));
	}	
	exit(json_encode(array('error'=>'激活失败')));
}elseif($operation=='restore'){
	if(C::t('task_board')->restore_by_tbid($tbid)){
		exit(json_encode(array('msg'=>'success')));
	}	
	exit(json_encode(array('error'=>'恢复失败')));
}elseif($operation=='delete'){
	if(C::t('task_board')->delete_by_tbid($tbid)){
		exit(json_encode(array('msg'=>'success')));
	}	
	exit(json_encode(array('error'=>'删除失败')));

}else{
	if($taskboard['orgid']){
		$org=DB::fetch_first("select o.mperm_c,u.perm from %t o LEFT JOIN %t u ON o.orgid=u.orgid and u.uid=%d where o.orgid=%d",array('task_organization','task_organization_user',$_G['uid'],$taskboard['orgid']));
	} 
	//$org=C::t('task_organization')->fetch($taskboard['orgid']);
	if(!$taskboard['aid']){
		$taskboard['aid']=1;
	}
}
if($ismobile){
	include template('mobile/setting');
}else{
	include template('list/setting');
}



?>
