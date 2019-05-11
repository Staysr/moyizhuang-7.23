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
$operation=$_GET['operation'];

if($operation=='getevent'){
	include_once DZZ_ROOT.'./dzz/taskboard/language/lang_event.php';
	$taskid=intval($_GET['taskid']);
	$perpage=20;
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$start=($page-1)*$perpage;
	$limit=$start.'-'.$perpage;
	
	if($count=C::t('task_event')->fetch_all_by_bz_date('task_'.$taskid,$limit,$uid,true)){
		$list=C::t('task_event')->fetch_all_by_bz_date('task_'.$taskid,$limit,$uid);
	}
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	if($ismobile && isset($_GET['first'])){
		include template('mobile/mobile_event');
		exit();
	}
	include template('list/event_item');
}elseif($operation=='getTasklistByCatid'){
	$catid=intval($_GET['catid']);
	$statusarr=array();
	$cat=C::t('task_cat')->fetch($ccatid);
	$taskboard=C::t('task_board')->fetch_by_tbid($cat['tbid']);
	if($taskboard['autoarchive']>0) $statusarr=array(0,1);
	else $statusarr=array(0,1,2);
	$tasks=C::t('task')->fetch_all_by_catid($catid,$statusarr);
	$taskids=array_keys($tasks);
	//获取任务的指派用户，获取后按taskid 放入tasks的users_assign字段里
	foreach(C::t('task_user')->fetch_all_by_id_idtype($taskids,'task',2) as $value){
		if($tasks[$value['id']]){
			if(!isset($tasks[$value['id']]['user_assign'])) $tasks[$value['id']]['user_assign']=array();
			$tasks[$value['id']]['user_assign'][]=$value;
		}
	}
	foreach($tasks as $taskid => $value){
		if($value['labels']>0) $tasks[$taskid]['labels']=getLabels($value['labels'],$value['tbid']);
		if(!isset($value['user_assign'])) $tasks[$taskid]['user_assign']=array();
		if($value['endtime']){
			 $tasks[$taskid]['fendtime']=dgmdate($value['endtime'],'m-d');
			 $today=strtotime(dgmdate(TIMESTAMP,'Y-m-d'));
			 if($tasks[$taskid]['endtime']<TIMESTAMP) $tasks[$taskid]['expire']=1;
			 if($tasks[$taskid]['endtime']>=$today && $tasks[$taskid]['endtime']-$today<60*60*24) $tasks[$taskid]['expire']=2;
		}
	}
	include template('taskboard_ajax');

}elseif($operation=='board_members'){
	
	if($taskboard['perm']>2){
		if($_GET['ids']){
			if(is_array($_GET['ids'])){
				$ids=$_GET['ids'];
			}else{
				$ids=explode(',',$_GET['ids']);
			}
		} 
		else $ids=array();
		$olduids=C::t('task_board_user')->fetch_uids_by_tbid($tbid);
		$insert_uids=array_diff($ids,$olduids);
		$remove_uids=array_diff($olduids,$ids);
		C::t('task_board_user')->insert_uids_by_tbid($tbid,$insert_uids,'2');
		foreach($remove_uids as $uid){
			C::t('task_board_user')->remove_uid_by_tbid($tbid,$uid);
		}
	}
	if($_GET['output']=='json'){
		exit(json_encode(array('success'=>true)));
	}else{
		$taskboard['users']=C::t('task_board_user')->fetch_all_by_tbid($tbid,array(1,2,3));
		include template('list/board_user_list');
	}
	
	exit();
}elseif($operation=='board_members_list'){
	$taskboard['users']=C::t('task_board_user')->fetch_all_by_tbid($tbid,array(1,2,3));
	include template('list/board_user_list');
	exit();
}
?>
