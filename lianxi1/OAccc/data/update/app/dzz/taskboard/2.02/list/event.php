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
include_once DZZ_ROOT.'./dzz/taskboard/language/lang_event.php';
$operation=empty($_GET['operation'])?'':trim($_GET['operation']);
$perpage=$_GET['perpage']?intval($_GET['perpage']):20;
if($operation=='getEventByDate'){
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$start=($page-1)*$perpage;
	$limit=$start.'-'.$perpage;
	$users=C::t('task_board_user')->fetch_all_by_perm($tbid,array('2','3'),50);
	$uid=intval($_GET['uid']);
	if($count=C::t('task_event')->fetch_all_by_tbid_date($tbid,$limit,$uid,true)){
		$list=C::t('task_event')->fetch_all_by_tbid_date($tbid,$limit,$uid);
	}
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	if($_GET['from']=='rightMenu'){
		include template('list/event_item_right');
	}elseif($ismobile){
		include template('mobile/event_item_right');
	}else{
		include template('list/event_item');
	}
}else{
	$taskid=intval($_GET['taskid']);
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$start=($page-1)*$perpage;
	$limit=$start.'-'.$perpage;
	$users=C::t('task_board_user')->fetch_all_by_perm($tbid,array('2','3'),50);
	$uid=intval($_GET['uid']);
	if($count=C::t('task_event')->fetch_all_by_tbid_date($tbid,$limit,$uid,true)){
		$list=C::t('task_event')->fetch_all_by_tbid_date($tbid,$limit,$uid);
	}
	$next=false;
	if($count && ($count/$perpage)>$page) $next=true;
	
	include template('list/event');
	
}
?>
