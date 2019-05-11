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
$navtitle="统计 - ".$navtitle;
$navlast='统计报表';
include_once DZZ_ROOT.'./dzz/taskboard/language/lang_event.php';
$type=empty($_GET['type'])?'user':trim($_GET['type']);
$time=trim($_GET['time']);
$date=trim($_GET['date']);
if(empty($date) && !empty($time)){
	$date=dgmdate(strtotime('now'),'Y-m-d');
}

$operation=trim($_GET['operation']);
if($operation=='getdata'){
	 switch($type){
		 case 'user':
			$data=C::t('task_board')->fetch_user_stats_by_tbid($tbid,$time,$date);
			break;
		 case 'cat':
			$data=C::t('task_board')->fetch_cat_stats_by_tbid($tbid,$time,$date);
			break;
		 case 'label':
			$data=C::t('task_board')->fetch_label_stats_by_tbid($tbid,$time,$date);
			break;
	 }
	 include template('list/stats_ajax');
}else{
	switch($time){
		case 'month':
			$stamp=strtotime($date);
			$fdate=dgmdate($stamp,'Y-m');
			break;
		case 'week':
			$stamp=strtotime($date);
			$darr=getdate($stamp);
			$stamp_l=strtotime("this Monday",$stamp);
			$stamp_u=strtotime("+6 day",$stamp_l);
			$fdate=dgmdate($stamp_l,'Y-m-d').' - '.dgmdate($stamp_u,'Y-m-d');
			break;
		case 'day':
			$fdate=$date;
			break;
		
	}
	 switch($type){
		 case 'user':
			$data=C::t('task_board')->fetch_user_stats_by_tbid($tbid,$time,$date);
			break;
		 case 'cat':
			$data=C::t('task_board')->fetch_cat_stats_by_tbid($tbid,$time,$date);
			break;
		 case 'label':
			$data=C::t('task_board')->fetch_label_stats_by_tbid($tbid,$time,$date);
			break;
	 }
	include template('list/stats');
}
?>
