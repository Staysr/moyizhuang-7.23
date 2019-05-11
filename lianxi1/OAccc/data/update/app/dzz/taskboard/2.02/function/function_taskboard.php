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
function getAdminPerm(){//检查用户是否是应用管理员
	global $_G;
	if($_G['uid']<1) return 0;
	if($_G['adminid']==1) return 3;
	if(!$_G['cache']['taskbaord:setting'])	loadcache('taskbaord:setting');
	$muids=$_G['cache']['taskbaord:setting']['moderators']?explode(',',$_G['cache']['taskbaord:setting']['moderators']):array();
	if(!$muids) return 0;
	//转换为数组
	$orgids=array();
	$uids=array();
	foreach($muids as $value){
		if(strpos($value,'uid_')!==false){
			$uids[]=str_replace('uid_','',$value);
		}else{
			$orgids[]=$value;
		}
	}
	if(in_array($_G['uid'],$uids)) return 1;
	
	//当未加入机构和部门在部门列表中时，单独判断;
	if(in_array('other',$orgids) && !DB::result_first("SELECT COUNT(*) from %t where uid=%d and orgid>0",array('organization_user',$_G['uid']))){ 
		 return 1;		
	}
	//获取用户所在的机构或部门
	$uorgids=C::t('organization_user')->fetch_orgids_by_uid($_G['uid']);
	
	if(array_intersect($uorgids,$orgids)) return 1;
	
	//检查每个部门的上级

	foreach($uorgids as $orgid){
		$upids= C::t('organization')->fetch_parent_by_orgid($orgid,true);
		if($upids && array_intersect($upids,$orgids)) return 1;
	}
	return 0;
}

//创建任务板权限
/*
	
 return array('new'=>$new,'max'=>$max,'sum'=>0,'errmsg'=>'')
  $new>0：允许创建；
  $max：最大允许创建数量
  $sum:已经创建的数量
  $errmsg:不能创建的原因
*/
function createBoardPerm($orgid=0,$uid=0){
	global $_G;
	if(empty($uid)) $uid=$_G['uid'];
	if(!$_G['cache']['taskboard:setting']) loadcache('taskboard:setting');
	$setting=$_G['cache']['taskboard:setting'];
	
	$new=0;
	$error='';
	if(getAdminPerm()>0){//管理员和应用管理员不限制
		$new=1;
		$max=0;//无限制
		return array('new'=>$new,'max'=>$max,'sum'=>0,'errmsg'=>'');
	}else{
		//首先检查用户允许的最大版数量
		$max=$setting['maxboard'];
		$sum=DB::result_first("select COUNT(*) from %t where uid=%d ",array('task_board',$uid));
		if($max && $max<$sum){
			$new=0;
			$errmsg='超过最大允许创建的任务板数量';
			return array('new'=>$new,'max'=>$max,'sum'=>$sum,'errmsg'=>$errmsg);
		}else{
			$new=1;
		}
		//检查哪些用户允许创建
		if($setting['allownewboard']>0){//指定用户时
			$newboard_users=$setting['newboard_users']?explode(',',$setting['newboard_users']):array();
			if(!in_array($uid,$newboard_users)){
				$new=0;
				$errmsg='您没有创建任务版的权限';
				return array('new'=>$new,'max'=>$max,'sum'=>$sum,'errmsg'=>$errmsg);
			}else{
				$new=1;
			}
		}else{
			$new=1;
		}
		//在机构内创建时,需要检查机构内创建用户权限
		if($orgid){
			$org=DB::fetch_first("select o.mperm_c,u.perm from %t o LEFT JOIN %t u ON o.orgid=u.orgid and u.uid=%d where o.orgid=%d",array('task_organization','task_organization_user',$uid,$orgid));
			if(($org['perm']>1 && $org['mperm_c']>0) || $org['perm']>2){
				$new=1;
			}else{
				$new=0;
				$errmsg='您没有在团队里创建任务版的权限';
				return array('new'=>$new,'max'=>$max,'sum'=>$sum,'errmsg'=>$errmsg);
			}
		}
		return array('new'=>$new,'max'=>$max,'sum'=>$sum,'errmsg'=>'');
	}
}
function createOrgPerm($uid=0){//获取用户创建团队的权限
	global $_G;
	if(empty($uid)) $uid=$_G['uid'];
	if(!$_G['cache']['taskboard:setting']) loadcache('taskboard:setting');
	$setting=$_G['cache']['taskboard:setting'];
	
	if(getAdminPerm()>0){//管理员和应用管理员不限制
		$new=1;
		$max=0;//无限制
		return array('new'=>$new,'max'=>$max,'sum'=>0,'errmsg'=>'');
	}else{
		//首先检查用户允许创建的最大团队数量
		$max=$setting['maxorganization'];
		$sum=DB::result_first("select COUNT(*) from %t where uid=%d ",array('task_organization',$uid));
		if($max && $max<$sum){
			$new=0;
			$errmsg='超过最大允许创建的任务板数量';
			return array('new'=>$new,'max'=>$max,'sum'=>$sum,'errmsg'=>$errmsg);
		}else{
			$new=1;
		}
		//检查哪些用户允许创建
		if($setting['allowneworg']>0){//指定用户时
			$neworg_users=$setting['neworg_users']?explode(',',$setting['neworg_users']):array();
			if(!in_array($uid,$neworg_users)){
				$new=0;
				$errmsg='您没有创建任务版的权限';
				return array('new'=>$new,'max'=>$max,'sum'=>$sum,'errmsg'=>$errmsg);
			}else{
				$new=1;
			}
		}
		return array('new'=>$new,'max'=>$max,'sum'=>0,'errmsg'=>'');
	}
}
function formatTask($task){
	
	$task['user_assign']=$task['user_follow']=array();
	foreach(C::t('task_user')->fetch_all_by_id_idtype($task['taskid'],'task',0) as $value){
		if($value['action']==2){
			 $task['user_assign'][]=$value;
		}elseif($value['action']==1){
			 $task['user_follow'][]=$value;
		}
	}
	$task['subarr']=C::t('task_sub')->fetch_all_by_taskid($task['taskid']);
	//获取所有附件
	$task['attacharr']=C::t('task_attach')->fetch_all_by_taskid($task['taskid']);
	
	if($task['labels']>0) $task['labels']=getLabels($task['labels'],$task['tbid']);
	
	if($task['endtime']){
		 $today=strtotime(dgmdate(TIMESTAMP,'Y-m-d'));
		 $dformat='Y-m-d';
		 if(strtotime(dgmdate(TIMESTAMP,'Y'))==strtotime(dgmdate($task['endtime'],'Y'))){
			 $dformat='m-d';
		 }
		 $task['fendtime']=dgmdate($task['endtime'],$dformat);
		 if($task['endtime']<TIMESTAMP) $task['expire']=1;
		 if($task['endtime']>=$today && $task['endtime']-$today<60*60*24) $task['expire']=2;
	}

	if(!$task['imageaid']){
		$task['imageaid']=C::t('task_attach')->fetch_newest_imageaid_by_taskid($task['taskid']);
	}
	foreach($task['attacharr'] as $key => $attach){
		if($task['imageaid']==$attach['id']){
			$task['dpath']=dzzencode('attach::'.$attach['aid']);
		}
	}
	if(empty($task['dpath'])) $task['imageaid']=0;
	return $task;
}
function getLabels($val,$tbid=0){//根据二进制值获取labels数组
	$labels=getLabelsBybtid($tbid);
	$ret=array();
	foreach($labels as $value){
		if(($val & $value['pow'])>0) $ret[$value['pow']]=$value;
	}
	return $ret;
}
function getAllLabels(){
	$labels=array(array('pow'=>1,'title'=>'blue','color'=>'blue'),
				  array('pow'=>2,'title'=>'green','color'=>'green'),
				  array('pow'=>4,'title'=>'orange','color'=>'orange'),
				  array('pow'=>8,'title'=>'purple','color'=>'purple'),
				  array('pow'=>16,'title'=>'red','color'=>'red'),
				  array('pow'=>32,'title'=>'yellow','color'=>'yellow')
				);
   return $labels;
}
function getLabelsBybtid($tbid){
	$alllabels=getAllLabels();
    $labels=C::t('task_setting')->fetch('labels_'.$tbid,true);
	$labelarr=array();
	foreach($alllabels as $key =>$value){
		if(isset($labels[$value['pow']])){
			 $value['title']=$labels[$value['pow']];
			 $labelarr[$value['pow']]=$value;
		}
	}
	return $labelarr;
}
function getCoverImage($taskid){
	$task=C::t('task')->fetch($taskid);
	if(!$task['imageaid']){
		$task['imageaid']=C::t('task_attach')->fetch_newest_imageaid_by_taskid($taskid);
	}
	if($task['imageaid']){
		$attach=C::t('task_attach')->fetch($task['imageaid']);
		return array('imageaid'=>$task['imageaid'],'aid'=>$attach['aid'],'dpath'=>dzzencode('attach::'.$attach['aid']));
	}else{
		return 0;
	}
	
}

