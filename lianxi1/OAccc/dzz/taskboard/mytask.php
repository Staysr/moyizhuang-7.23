<?php
/* @authorcode  f12c4e54920727fc04d615f7ab97416a
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
$ismobile=helper_browser::ismobile();
require_once libfile('function/taskboard');
$taskboard['layout']=1;
$json_board=json_encode($taskboard);
$type=empty($_GET['type'])?'task':trim($_GET['type']);
$do=empty($_GET['do'])?'':trim($_GET['do']);
if($do=='getMore'){
	$perpage=20;
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$start=($page-1)*$perpage;
	$keyword=trim($_GET['keyword']);
	$type=intval($_GET['type']);
	$gets = array(
				'mod'=>'taskboard',
				'op' =>'mytask',
				'type'=>$type,
				'keyword'=>$keyword,
			);
	$theurl = BASESCRIPT."?".url_implode($gets);
	$param=array('task_user','task','task_field','task_board');
	$sql="t.deletetime<1 and t.taskid>0 and u.uid=%d and u.action>1 and u.idtype='task' ";
	$param[]=$_G['uid'];
	if(empty($type)){
		$sql.=" and t.status ='0' and (endtime='0' or (endtime>0 and endtime>=%d)) ";
		$param[]=TIMESTAMP;
	}elseif($type==1){
		$sql.=" and t.status ='0' and  endtime>0 and  endtime<%d ";
		$param[]=TIMESTAMP;
	}elseif($type==2){
		$sql.=" and t.status ='2'";
	}
	if($keyword){
		$sql.=" and f.name like %s";
		$param[]='%'.$keyword.'%';
	}
	
	$tasks=array();
	
	if($count=DB::result_first("select COUNT(*) from %t u 
							LEFT JOIN %t t ON t.taskid=u.id
							LEFT JOIN %t f ON t.taskid=f.taskid 
							LEFT JOIN %t b ON t.tbid=b.tbid 
							where  $sql",$param)){
			foreach(DB::fetch_all("select t.*,u.action,f.name,b.name as bname,b.aid as cover from %t u
									LEFT JOIN %t t ON t.taskid=u.id
									LEFT JOIN %t f ON t.taskid=f.taskid 
									LEFT JOIN %t b ON t.tbid=b.tbid 
									where  $sql order by t.disp limit $start,$perpage",$param) as $value){
				$tasks[$value['taskid']]=$value;
			}
	}
	$taskids=array_keys($tasks);
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
			 if($tasks[$taskid]['endtime']<TIMESTAMP &&$tasks[$taskid]['status']!=2) $tasks[$taskid]['expire']=1;
			 if($tasks[$taskid]['endtime']>=$today && $tasks[$taskid]['endtime']-$today<60*60*24) $tasks[$taskid]['expire']=2;
		}
	}
	
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	if($ismobile){
		include template('mobile/taskboard_mytask_item');
	}else{
		include template('taskboard_mytask_item');
	}
	exit();
}else{
	
	$navtitle="我的任务";
	$navlast='我的任务';
	$perpage=20;
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$start=($page-1)*$perpage;
	$keyword=trim($_GET['keyword']);
	$type=intval($_GET['type']);
	$gets = array(
				'mod'=>'taskboard',
				'op' =>'mytask',
				'type'=>$type,
				'keyword'=>$keyword,
			);
	$theurl = BASESCRIPT."?".url_implode($gets);
	$param=array('task_user','task','task_field','task_board');
	$sql="t.deletetime<1 and t.taskid>0 and u.uid=%d and u.action>1 and u.idtype='task' ";
	$param[]=$_G['uid'];
	if(empty($type)){
		$sql.=" and t.status ='0' and (endtime='0' or (endtime>0 and endtime>=%d)) ";
		$param[]=TIMESTAMP;
	}elseif($type==1){
		$sql.=" and t.status ='0' and  endtime>0 and  endtime<%d ";
		$param[]=TIMESTAMP;
	}elseif($type==2){
		$sql.=" and t.status ='2'";
	}
	if($keyword){
		$sql.=" and f.name like %s";
		$param[]='%'.$keyword.'%';
	}
	
	
	$tasks=array();
	if($count=DB::result_first("select COUNT(*) from %t u 
							LEFT JOIN %t t ON t.taskid=u.id
							LEFT JOIN %t f ON t.taskid=f.taskid 
							LEFT JOIN %t b ON t.tbid=b.tbid 
							where  $sql",$param)){
			foreach(DB::fetch_all("select t.*,u.action,f.name,b.name as bname,b.aid as cover from %t u 
									LEFT JOIN %t t ON t.taskid=u.id
									LEFT JOIN %t f ON t.taskid=f.taskid 
									LEFT JOIN %t b ON t.tbid=b.tbid 
									where  $sql order by t.disp limit $start,$perpage",$param) as $value){
				$tasks[$value['taskid']]=$value;
			}
	}
	$taskids=array_keys($tasks);
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
			 if($tasks[$taskid]['endtime']<TIMESTAMP &&$tasks[$taskid]['status']!=2) $tasks[$taskid]['expire']=1;
			 if($tasks[$taskid]['endtime']>=$today && $tasks[$taskid]['endtime']-$today<60*60*24) $tasks[$taskid]['expire']=2;
		}
	}
	
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	if($ismobile){
		include template('mobile/mobile_taskboard_mytask');
		dexit();
	}
	include template('taskboard_mytask');
	exit();
}
?>
