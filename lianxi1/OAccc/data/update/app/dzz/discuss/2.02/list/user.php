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
$permtitle=array('2'=>lang('member'),'3'=>lang('administrator'));
$operation=empty($_GET['operation'])?'':trim($_GET['operation']);
$forward=rawurlencode(rawurldecode($_GET['forward']));
if($operation=='selectuser'){
	if($discuss['perm']<3){
		showmessage(lang('administrator'),dreferer());
	}
	if(submitcheck('selectsubmit')){
		$uids = is_array($_GET['uids']) ? $_GET['uids'] : explode(',', $_GET['ids']);
		$perm=intval($_GET['perm']);
		$type = $perm == 3 ? 'adm' : '';
		if ($perm == 3 && empty($uids)) {
			exit(lang('least_a_administrator'));
		}
		$ouids = array_keys(C::t('discuss_user')->fetch_all_by_perm($fid,array($perm)));
		$ruids = array_diff($ouids, $uids);
		foreach ($ruids as $v) {
			C::t('discuss_user')->remove_uid_by_fid($fid, $v);
		}
		if(C::t('discuss_user')->insert_uids_by_fid($fid,$uids,$perm)){
			foreach (C::t('discuss_user')->fetch_all_by_perm($fid,array($perm)) as $k => $value) {
				$value['permtitle']=$permtitle[$value['perm']];
				$list[$k]=$value;
			}
			if ($ismobile) {
				exit(json_encode(array('success' => 1, 'deferer' => outputurl(MOD_URL.'&op=list&do=user&fid='.$fid))));
			} else {
				include template('list/user_item');
			}
		}
	}else{
		$title=lang('add_member');
		$navtitle=$title." - ".$navtitle;
		$navlast=$title;
		$refer=dreferer();
		$uids=C::t('discuss_user')->fetch_uids_by_fid($fid);
		include template('list/utree');
	}
}elseif($operation=='deleteUser'){
	if($discuss['perm']<3){
		exit(json_encode(array('error'=>lang('administrator'))));
	}
	$uid=intval($_GET['uid']);
	$perm = C::t("discuss_user")->fetch_perm_by_uid($uid, $fid);
	if ($perm == 3) {
		$adm_list_count = C::t('discuss_user')->fetch_all_by_perm($fid,array('3'),0,true);
		if ($adm_list_count < 2) {
			exit(json_encode(array('error'=>lang('least_a_administrator'))));
		}	
	}
	
	$arr=array();
	if($return=C::t('discuss_user')-> remove_uid_by_fid($fid,$uid)){
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
	if($discuss['perm']<3){
		exit(lang('no_privilege'));
	}
	$uid=intval($_GET['uid']);
	$perm=intval($_GET['perm']);
	$type = $perm == 3 ? 'adm' : 'user';
	$arr=array();
	if($return=C::t('discuss_user')-> change_perm_by_uid($fid,$uid,$perm)){
		if(is_array($return) && $return['error']){
			exit($return['error']);
		}else{
			foreach (C::t('discuss_user')->fetch_all_by_perm($fid,array($perm)) as $k => $value) {
				$value['permtitle']=$permtitle[$value['perm']];
				$list[$k]=$value;
			}
			include template('list/user_item');
		}
	}else{
		exit(lang('opt_failed'));
	}
}else if($operation=='getMore'){
	$perpage=50;
	$start=intval($_GET['start']);
	$type = $_GET['type'] == 'user' ? 'user' : 'adm';
	if ($type == 'user') {
		$permarr=array('2');
	} else {
		$permarr=array('3');
	}
	
	$limit=$start.'-'.$perpage;
	$next=false;
	$list=array();
	$count=C::t('discuss_user')->fetch_all_by_perm($fid,$permarr,$limit,true);
	foreach(C::t('discuss_user')->fetch_all_by_perm($fid,$permarr,$limit) as $value){
		$value['permtitle']=$permtitle[$value['perm']];
		$list[]=$value;
	}
	if($count>$start+$perpage) $next=true;
	$nextstart=$start+$perpage;
	if ($ismobile) {
		include template('mobile/user_item');
	} else {
		include template('list/user_item');
	}
	
}else{

	$limit=50;
	$navtitle=lang('member_manage')." - ".lang('appname');
	$userlist=$follows=array();
	$follows_next=$userlist_next=false;
	$adm_list_count = C::t('discuss_user')->fetch_all_by_perm($fid,array('3'),$limit,true);
	$user_list_count = C::t('discuss_user')->fetch_all_by_perm($fid,array('2'),$limit,true);
	$adm_userlist = array();
	$userlist = array();
	foreach(C::t('discuss_user')->fetch_all_by_perm($fid,array('3'),$limit) as $k => $value){
		$value['permtitle']=$permtitle[$value['perm']];
		$adm_userlist[$k]=$value;
	}
	foreach(C::t('discuss_user')->fetch_all_by_perm($fid,array('2'),$limit) as $k => $value){
		$value['permtitle']=$permtitle[$value['perm']];
		$userlist[$k]=$value;
	}
	if($adm_list_count>$limit) $adm_userlist_next=true;
	if($user_list_count>$limit) $user_list_next=true;
	$adm_uids = implode(',', array_keys($adm_userlist));
	$user_uids = implode(',', array_keys($userlist));
	if ($ismobile) {
		include template('mobile/user');
	} else {
		include template('list/user');
	}

}

?>
