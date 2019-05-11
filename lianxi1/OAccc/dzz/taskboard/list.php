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
require_once libfile('function/taskboard');
$ismobile=helper_browser::ismobile();
$tbid=intval($_GET['tbid']);
$opentaskid=intval($_GET['taskid']);
if(!$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']) ){
	showmessage('任务板不存在或已删除',dreferer());
}

if($taskboard['status']>1 && $taskboard['statustime']>0 && $taskboard['perm']<3){
	showmessage('任务板不存在或已删除',dreferer());
}
if($taskboard['orgid']>0){
	$org=DB::fetch_first("select o.*,u.perm from %t o LEFT JOIN %t u ON o.orgid=u.orgid and u.uid=%d where o.orgid=%d",array('task_organization','task_organization_user',$_G['uid'],$taskboard['orgid']));	
}
if($taskboard['perm']<1){
	if($taskboard['viewperm']==0){ //私有的文件只有成员才能查看
		showmessage('此任务板为私有，你不是任务板成员，无法查看');
	}elseif($taskboard['viewperm']==1){//团队内任务板；
		if($org['perm']<1){
			showmessage('此任务板为团队内可见，你不是团队成员，无法查看',dreferer());
		}
	}
}

if($taskboard['perm']<2){
	$taskboard['disable']=1;
}elseif($taskboard['status']>0){
	$taskboard['disable']=$taskboard['status']+1;
}else{
	$taskboard['disable']=0;
}
/*if($ismobile){
	$taskboard['layout']=1;
}*/
$json_board=json_encode($taskboard);
// print_r($json_board);
$navtitle=$taskboard['name'];
$do=empty($_GET['do'])?'index':trim($_GET['do']);
if($do=='setting'){
	require( DZZ_ROOT.'./dzz/taskboard/list/setting.php');
	exit();
}elseif($do=='event'){
	require(DZZ_ROOT.'./dzz/taskboard/list/event.php');
	exit();
}elseif($do=='comment'){
	require(DZZ_ROOT.'./dzz/taskboard/list/comment.php');
	exit();
}elseif($do=='stats'){
	require(DZZ_ROOT.'./dzz/taskboard/list/stats.php');
	exit();
}elseif($do=='recycle'){
	require(DZZ_ROOT.'./dzz/taskboard/list/recycle.php');
	exit();
}elseif($do=='archive'){
	require(DZZ_ROOT.'./dzz/taskboard/list/archive.php');
	exit();

}elseif($do=='user'){
	require(DZZ_ROOT.'./dzz/taskboard/list/user.php');
	exit();
}elseif($do=='panel'){
	require(DZZ_ROOT.'./dzz/taskboard/list/panel.php');
	exit();	
}elseif($do=='ajax'){
	
	require(DZZ_ROOT.'./dzz/taskboard/list/ajax.php');
	exit();

}elseif($do=='restore'){
	    if($taskboard['perm']<3 && $_G['adminid']!=1){
			showmessage('没有权限',dreferer());
		}
		if(C::t('taskboard')->restore_by_tbid($tbid)){
			showmessage('任务板恢复成功',DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid);
		}else{
			showmessage('任务板恢复失败',DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid);
		}
}elseif($do=='archive'){
	 if($taskboard['perm']<3 && $_G['adminid']!=1){
		showmessage('没有权限',dreferer());
	}
	if(C::t('taskboard')->archive_by_tbid($tbid)){
		showmessage('任务板归档成功',DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid);
	}else{
		showmessage('任务板归档失败',DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid);
	}		
}elseif($do=='delete'){
	if($taskboard['perm']<3 && $_G['adminid']!=1){
		showmessage('没有权限',dreferer());
	}
	if(C::t('task_board')->delete_by_tbid($tbid)){
		showmessage('任务板删除成功',DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid);
	}else{
		showmessage('任务板删除失败',DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid);
	}

}elseif($do=='index'){
	
	$navtitle=$taskboard['name']." - 任务板";
	$navlast='任务列表';
	$catlist=C::t('task_cat')->fetch_all_by_tbid($tbid);
	$catids=array();
	$imageaids=array();
	$catids=array_keys($catlist);
	$statusarr=array();
	if($taskboard['autoarchive']>0) $statusarr=array(0,1);
	else $statusarr=array(0,1,2);
	$tasks=C::t('task')->fetch_all_by_catid($catids,$statusarr);
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
			 $dformat='Y-m-d';
			 if(strtotime(dgmdate(TIMESTAMP,'Y'))==strtotime(dgmdate($value['endtime'],'Y'))){
				 $dformat='m-d';
			 }
			 $tasks[$taskid]['fendtime']=dgmdate($value['endtime'],$dformat);
			 $today=strtotime(dgmdate(TIMESTAMP,'Y-m-d'));
			 if($tasks[$taskid]['endtime']<TIMESTAMP) $tasks[$taskid]['expire']=1;
			 if($tasks[$taskid]['endtime']>=$today && $tasks[$taskid]['endtime']-$today<60*60*24) $tasks[$taskid]['expire']=2;
		}
		
		if($value['imageaid']){
			$imageaids[]=$value['imageaid'];
		}elseif($imageaid=C::t('task_attach')->fetch_newest_imageaid_by_taskid($taskid)){
			$imageaids[]=$imageaid;
			$tasks[$taskid]['imageaid']=$imageaid;
			
		} //$tasks[$taskid]['dpath']=dzzencode('attach::'.$value['imageaid']);
	}
	if($imageaids){
		$attacharr=C::t('task_attach')->fetch_all($imageaids);
	}
	if(isset($tasks[$opentaskid])) $navtitle=$tasks[$opentaskid]['name'].' - '.$navtitle;
	//将任务按catid 安排到catlist的tasks字段里
	foreach($tasks as $taskid => $value){
		if($value['imageaid'] && isset($attacharr[$value['imageaid']])) $value['dpath']=dzzencode('attach::'.$attacharr[$value['imageaid']]['aid']);
		if($catlist[$value['catid']]){
			if(isset($catlist[$value['catid']]['tasks'])) $catlist[$value['catid']]['tasks'][]=$value;
			else $catlist[$value['catid']]['tasks']=array($value);
		}
	}
	//将每个分类下的tasks排序
	foreach($catlist as $key => $value){
		$value['followed']=C::t('task_user')->fetch_followed_by_id_idtype_uid($value['catid'],'task_cat',1,$_G['uid']);
		if($value['tasks']){
			usort($value['tasks'],"cmp");
			$catlist[$key]['tasks']=$value['tasks'];
		}
		$catlist[$key]=$value;
	}
	
	//按catlist排序
	$catids=C::t('task_setting')->fetch('catlist_'.$tbid);
	$catids=explode(',',$catids);
	
	$temp=$catlist;
	$catlist=array();
	foreach($catids as $catid){
		if(isset($temp[$catid])){
			$catlist[]=$temp[$catid];
			unset($temp[$catid]);
		}
	}
	foreach($temp as $value){
		
		$catlist[]=$value;
	}
	//排序star
	$stared=array();

	if($cache=C::t('user_setting')->fetch_by_skey('taskboard_paixu_stared')){
		$stared=explode(',',$cache);
	}
	$bodyClass='color-block-'.$taskboard[aid];	
	if($ismobile){
		include template('mobile/taskboard_list');
	}else{
		include template('taskboard_list');
	}
	
	function cmp($a, $b){
		if ($a['disp'] == $b['disp']) {
			return 0;
		}
		return ($a['disp'] < $b['disp']) ? -1 : 1;
	}
	

}