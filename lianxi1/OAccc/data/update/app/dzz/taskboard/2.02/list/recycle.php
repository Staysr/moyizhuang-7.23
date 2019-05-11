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
/*if($taskboard['perm']<3 && $_G['adminid']!=1){
	showmessage('没有权限',dreferer());
}*/
$type=empty($_GET['type'])?'task':trim($_GET['type']);
$operation=empty($_GET['operation'])?'':trim($_GET['operation']);
if($operation=='getMore'){
	$perpage=20;
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$start=($page-1)*$perpage;
	$limit=$start.'-'.$perpage;
	$keyword=trim($_GET['keyword']);
	$starttime=$_GET['starttime']?strtotime($_GET['starttime']):0;
	$endtime=$_GET['endtime']?strtotime($_GET['endtime']):0;
	$list=array();
	if($type=='task'){
		if($count=C::t('task')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,true)){
			$list=C::t('task')->fetch_all_delete_by_tbid($tbid,$limit,$keyword);
		}
	}elseif($type=='attach'){
		if($count=C::t('task_attach')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,true)){
			$list=C::t('task_attach')->fetch_all_delete_by_tbid($tbid,$limit,$keyword);
		}
	}else{
		if($count=C::t('task_cat')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,true)){
			$list=C::t('task_cat')->fetch_all_delete_by_tbid($tbid,$limit,$keyword);
		}
	}
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	include template('list/recycle_item_'.$type);
}elseif($operation=='empty'){
	//删除所有任务列表
	if($taskboard['perm']<3){
		exit(json_encode(array('error'=>'没有权限')));
	}
	C::t('task_cat')->recycle_empty_by_tbid($tbid);
	C::t('task')->recycle_empty_by_tbid($tbid);
	C::t('task_attach')->recycle_empty_by_tbid($tbid);
	//showmessage('do_success',dreferer());
	exit(json_encode(array('msg'=>'success')));
	
}else{
	$navtitle="回收站 - ".$navtitle;
	$navlast='回收站';
	$perpage=20;
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$start=($page-1)*$perpage;
	$limit=$start.'-'.$perpage;
	$keyword=trim($_GET['keyword']);
	$starttime=$_GET['starttime']?strtotime($_GET['starttime']):0;
	$endtime=$_GET['endtime']?strtotime($_GET['endtime']):0;
	$list=array();
	if($type=='task'){
		if($count=C::t('task')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,$starttime,$endtime,true)){
			$list=C::t('task')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,$starttime,$endtime);
		}
	}elseif($type=='attach'){
		if($count=C::t('task_attach')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,$starttime,$endtime,true)){
			$list=C::t('task_attach')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,$starttime,$endtime);
		}
	}else{
		if($count=C::t('task_cat')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,$starttime,$endtime,true)){
			$list=C::t('task_cat')->fetch_all_delete_by_tbid($tbid,$limit,$keyword,$starttime,$endtime);
		}
	}
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	include template('list/recycle');
}
?>
