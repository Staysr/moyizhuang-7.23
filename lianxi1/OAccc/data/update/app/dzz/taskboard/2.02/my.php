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
Hook::listen('check_login');
include_once libfile('function/taskboard');
$navtitle='任务板首页 - 我的';
$navlast="我的任务板";
if(!$_G['cache']['taskbaord:setting']) loadcache('taskbaord:setting');
$setting=$_G['cache']['taskbaord:setting'];
$ismobile=helper_browser::ismobile();

$wheresql = '';
$keyword=trim($_GET['keyword']);
$param1 = array('task_board_user','task_board',$_G['uid']);
$param2 = array('task_board','task_board_user',$_G['uid']);
if($keyword){
	$wheresql.=" and (c.name LIKE %s or u.username LIKE %s)";
	$param1[]='%'.$keyword.'%';
	$param1[]='%'.$keyword.'%';
	$param2[]='%'.$keyword.'%';
	$param2[]='%'.$keyword.'%';
}
$my=array();
$mylist=$list=array();
//获取我的任务板
foreach(DB::fetch_all("select c.*,u.perm,u.lastvisit as uperm from %t u LEFT JOIN %t c ON u.tbid=c.tbid where u.uid=%d and c.status='0'  $wheresql order by c.dateline DESC" ,$param1) as $value){
	$value['viewperm']=$value['perm'];
	$value['perm']=$value['uperm'];
	if($value['forceindex'] || empty($value['orgid'])){
		$my[$value['tbid']]=$value;		
	}else{
		$mylist[$value['orgid']][$value['tbid']]=$value;
	}

	$list[$value['tbid']]=$value;
}
//获取固定在首页的任务板
foreach(DB::fetch_all("select c.*,u.perm as uperm,u.lastvisit from %t c LEFT JOIN %t u ON u.tbid=c.tbid and u.uid=%d where  c.forceindex>0 and c.status='0'  $wheresql order by c.dateline DESC" ,$param2) as $value){
	$value['viewperm']=$value['perm'];
	$value['perm']=$value['uperm'];
	$my[$value['tbid']]=$value;		
}

//排序star
$stared=array();

if($cache=C::t('user_setting')->fetch_by_skey('taskboard_paixu_stared')){
	$paixu_stared=explode(',',$cache);
	foreach($paixu_stared as $tbid){
		if($list[$tbid]){
			$stared[$tbid]=$list[$tbid];
		}
	}
}
$stared_tbids=array_keys($stared);
//获取用户的organization
$orglist=array();
foreach(DB::fetch_all("select o.*,u.perm from %t u LEFT JOIN %t o ON u.orgid=o.orgid where u.uid=%d and o.orgid>0  order by o.dateline" ,array('task_organization_user','task_organization',$_G['uid'])) as $value){
	if($mylist[$value['orgid']]){
		 $value['list']=$mylist[$value['orgid']];
		 unset($mylist[$value['orgid']]);
	}else $value['list']=array();

	if($value['logo']){
		$value['logourl']='index.php?mod=io&op=thumbnail&size=small&path='.dzzencode('attach::'.$value['logo']);
	}
	$orglist[$value['orgid']]=$value;			
}
foreach($mylist as $olist){
	foreach($olist as $value){
		$my[$value['tbid']]=$value;
	}
}
if($ismobile){
	include template('mobile/taskboard_my');
}else{
	include template('taskboard_my');
}

dexit();
