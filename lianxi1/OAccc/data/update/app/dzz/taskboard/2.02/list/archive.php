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
		if($count=C::t('task')->fetch_all_by_tbid_from_archive($tbid,$limit,$keyword,$starttime,$endtime,true)){
			$list=C::t('task')->fetch_all_by_tbid_from_archive($tbid,$limit,$keyword,$starttime,$endtime);
		}
	}else{
		if($count=C::t('task_cat')->fetch_all_by_tbid_from_archive($tbid,$limit,$keyword,$starttime,$endtime,true)){
			$list=C::t('task_cat')->fetch_all_by_tbid_from_archive($tbid,$limit,$keyword,$starttime,$endtime);
		}
	}
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	include template('list/archive_item_'.$type);
}else{
	
	$perpage=20;
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$start=($page-1)*$perpage;
	$limit=$start.'-'.$perpage;
	$keyword=trim($_GET['keyword']);
	$starttime=$_GET['starttime']?strtotime($_GET['starttime']):0;
	$endtime=$_GET['endtime']?strtotime($_GET['endtime']):0;
	$list=array();
	if($type=='task'){
		$navtitle="归档任务 - ".$navtitle;
		$navlast='归档任务';
		if($count=C::t('task')->fetch_all_by_tbid_from_archive($tbid,$limit,$keyword,$starttime,$endtime,true)){
			$list=C::t('task')->fetch_all_by_tbid_from_archive($tbid,$limit,$keyword,$starttime,$endtime);
		}
	}else{
		$navtitle="归档列表 - ".$navtitle;
		$navlast='归档列表';
		if($count=C::t('task_cat')->fetch_all_by_tbid_from_archive($tbid,$limit,$keyword,$starttime,$endtime,true)){
			$list=C::t('task_cat')->fetch_all_by_tbid_from_archive($tbid,$limit,$keyword,$starttime,$endtime);
		}
	}
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	include template('list/archive');
}
?>
