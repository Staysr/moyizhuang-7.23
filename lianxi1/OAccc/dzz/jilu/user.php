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
$ismobile=helper_browser::ismobile();
require_once 'conf.php';
$jid=trim($_GET['jid']);
$jilu=C::t('jilu')->fetch($jid);
include_once libfile('function/common');
include libfile('function/organization');
//判断查看权限:0:无权限，1：查看权限；2：发布权限
$perm=getVPermByUid($jid);
$permtitle=array('1'=>lang('follow_member'),'2'=>lang('cooper_member'),'3'=>lang('administrator'));
$operation=empty($_GET['operation'])?'':trim($_GET['operation']);
if($operation=='selectuser'){
	if($perm<3){
		showmessage(lang('privilege'),dreferer());
	}
	if(submitcheck('selectsubmit')){
		$uids = $_GET['uids'];
		$perm=intval($_GET['perm']);
		$users = array();
		foreach (C::t('jilu_user')->fetch_all_by_perm($jid,array($perm)) as $v) {
			C::t('jilu_user')->remove_uid_by_jid($jid, $v['uid']);
		}
		foreach ($uids as $v) {
			C::t('jilu_user')->remove_uid_by_jid($jid, $v);
		}
		if(C::t('jilu_user')->insert_uids_by_jid($jid,$uids,$perm)){
			foreach(C::t('jilu_user')->fetch_all_by_perm($jid,array($perm)) as $value){
				$users[$value['uid']] = array('uid' => $value['uid'], 'permtitle' => $permtitle[$value['perm']], 'username' => $value['username'], 'avatar' => avatar_block($value['uid']), 'perm' => $value['perm']);
			}
		}
		include template('user_select_list');
	}
}elseif($operation=='deleteUser'){
	if($perm<3){
		exit(json_encode(array('error'=>lang('privilege'))));
	}
	$uid=intval($_GET['uid']);
	$arr=array();
	if($return=C::t('jilu_user')-> remove_uid_by_jid($jid,$uid)){
		if(is_array($return) && $return['error']){
			$arr['error']=$return['error'];
		}else{
			$arr['msg']='success';
		}
	}else{
		$arr['error']=lang('delete_failed');
	}
	exit(json_encode($arr));
}elseif($operation=='changeUserPerm'){
	if($perm<3){
		exit(json_encode(array('error'=>lang('privilege'))));
	}
	$uid=intval($_GET['uid']);
	$perm=intval($_GET['perm']);
	$arr=array();
	if($return=C::t('jilu_user')-> change_perm_by_uid($jid,$uid,$perm)){
		if(is_array($return) && $return['error']){
			$arr['error']=$return['error'];
		}else{
			$arr['msg']='success';
		}
	}else{
		$arr['error']=lang('delete_failed');
	}
	exit(json_encode($arr));
}else if($operation=='getMore'){
	$perpage=50;
	$type=intval($_GET['type']);
	$start=intval($_GET['start']);
	if($type==1){
		$permarr=array('1');
	}else{
		$permarr=array('2','3');
	}
	$limit=$start.'-'.$perpage;
	$next=false;
	$list=array();
	$count=C::t('jilu_user')->fetch_all_by_perm($jid,$permarr,$limit,true);
	
	foreach(C::t('jilu_user')->fetch_all_by_perm($jid,$permarr,$limit) as $value){
		$value['permtitle']=$permtitle[$value['perm']];
		$list[]=$value;
	}
	if($count>$start+$perpage) $next=true;
	$nextstart=$start+$perpage;
	include template('list/user_item');
}else if($operation=='getavatar'){
	$uids = is_array($_GET['uids']) ? $_GET['uids'] : array($_GET['uids']);
	$avatar = array();
	foreach ($uids as $key => $value) {
		$avatar[$value] = avatar_block($value);
	}
	exit(json_encode($avatar));
} else {
	$limit=50;
	$navtitle=lang('member_management').' - '.lang('record_book');
	$navlast='<a href="'.MOD_URL.'&id='.$jid.'">'.getstr($jilu['title'],30).'</a> / '.lang('user_management');
	$userlist=$follows=array();
	$follows_next=$userlist_next=false;
	$userlist_count=C::t('jilu_user')->fetch_all_by_perm($jid,array('2','3'),$limit,true);
	foreach(C::t('jilu_user')->fetch_all_by_perm($jid,array('2','3'),$limit) as $value){
		$value['permtitle']=$permtitle[$value['perm']];
		$userlist[$value['uid']]=$value;
	}
	if($userlist_count>$limit) $userlist_next=true;
	$follows_count=C::t('jilu_user')->fetch_all_by_perm($jid,array('1'),$limit,true);
	foreach(C::t('jilu_user')->fetch_all_by_perm($jid,array('1'),$limit) as $value){
		$value['permtitle']=$permtitle[$value['perm']];
		$follows[$value['uid']]=$value;
	}
	if($follows_count>$limit) $follows_next=true;
	include template('user'); 
}

?>
