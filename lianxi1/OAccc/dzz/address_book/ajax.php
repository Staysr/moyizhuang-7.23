<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
//此页的调用地址  index.php?mod=test;
//同目录的其他php文件调用  index.php?mod=test&op=test1;

if (!defined('IN_DZZ')) {//所有的php文件必须加上此句，防止被外部调用
	exit('Access Denied');
}
include_once libfile('function/profile', '', 'user');
include_once libfile('function/organization');
$ismobile=helper_browser::ismobile();
if ($_GET['do'] == 'user') {

	//	接收uid
	
	$uid = intval($_GET['suggest'] ? $_GET['suggest'] : $_G['suggest']);

	$space = getuserbyuid($uid);
	$avatar=avatar_block($uid);
	space_merge($space, 'profile');
	space_merge($space, 'field');
	space_merge($space, 'status');

	$privacy = $space['privacy']['profile'] ? $space['privacy']['profile'] : array();
	$_G['setting']['privacy'] = $_G['setting']['privacy'] ? $_G['setting']['privacy'] : array();
	$_G['setting']['privacy'] = is_array($_G['setting']['privacy']) ? $_G['setting']['privacy'] : dunserialize($_G['setting']['privacy']);
	$_G['setting']['privacy']['profile'] = !empty($_G['setting']['privacy']['profile']) ? $_G['setting']['privacy']['profile'] : array();
	$privacy = array_merge($_G['setting']['privacy']['profile'], $privacy);

	$space['regdate'] = dgmdate($space['regdate']);
	if ($space['lastvisit'])
		$profiles['lastvisit'] = array('title' => lang('last_visit'), 'value' => dgmdate($space['lastvisit']));

	$profiles['regdate'] = array('title' => lang('registration_time'), 'value' => $space['regdate']);

	$user = array();

	$space['fusesize'] = formatsize($space['usesize']);

	if (!$_G['cache']['usergroups'])
		loadcache('usergroups');
	$usergroup = $_G['cache']['usergroups'][$space['groupid']];
	if($usergroup['grouptitle']){
		$grouptitle = $usergroup['grouptitle'];
	}else{
		$grouptitle = lang('not_available');
	}
	$profiles['usergroup'] = array('title' => lang('usergroup'), 'value' => $grouptitle);
	//资料用户所在的部门
	$department = '';
	foreach (C::t('organization_user')->fetch_orgids_by_uid($uid) as $orgid) {
		$orgpath = getPathByOrgid($orgid);
		$department .= '<div style="margin-bottom: 5px;"><span class="label label-primary">' . implode('-', ($orgpath)) . '</span></div>';
	}
	if (empty($department))
		$department = lang('not_join_agency_department');
	$profiles['department'] = array('title' => lang('department'), 'value' => $department);

	if ($usergroup['maxspacesize'] == 0) {
		$space['maxspacesize'] = 0;
	} elseif ($usergroup['maxspacesize'] < 0) {
		if (($space['addsize'] + $space['buysize']) > 0) {
			$space['maxspacesize'] = ($space['addsize'] + $space['buysize']) * 1024 * 1024;
		} else {
			$space['maxspacesize'] = -1;
		}
	} else {
		$space['maxspacesize'] = ($usergroup['maxspacesize'] + $space['addsize'] + $space['buysize']) * 1024 * 1024;
	}
	if ($space['maxspacesize'] > 0) {
		$space['fmaxspacesize'] = formatsize($space['maxspacesize']);
	} elseif ($space['maxspacesize'] == 0) {
		$space['fmaxspacesize'] = lang('no_limit');
	} else {
		$space['fmaxspacesize'] = lang('unallocated_space');
	}
	$profiles['fusersize'] = array('title' => lang('space_usage'), 'value' => $space['fusesize'] . ' / ' . $space['fmaxspacesize']);

	if (empty($_G['cache']['profilesetting'])) {
		loadcache('profilesetting');
	}
	foreach ($_G['cache']['profilesetting'] as $fieldid => $field) {
		if (empty($field) || $fieldid == 'department' || !$field['available'] || $field['invisible'] || !profile_privacy_check($uid, intval($privacy[$fieldid]))) {
			continue;
		}
		$val = profile_show($fieldid, $space);
		if ($val !== false && $val != '') {
			$profiles[$fieldid] = array('title' => $field['title'], 'value' => $val);
		}
	}
	$frequent_uids=C::t('user_setting')->fetch_by_skey('contract_frequent');
	if($frequent_uids){
		$frequent_uids=explode(',',$frequent_uids);
	}
	//$profiles[$fieldid] = array('title' => $field['title'], 'value' => $val);
    if($ismobile) {
	    include template('mobile/detail');
    }else {
        exit(json_encode(array('profile'=>$profiles,'avatar'=>$avatar,'username'=>$space['username'],'uid'=>$space['uid'],'frequent_uids'=>$frequent_uids)));
    }
}elseif ($_GET['do'] == 'setFrequent') {//设置常用联系人
	$uid=intval($_GET['uid']);
	$frequent_uids=C::t('user_setting')->fetch_by_skey('contract_frequent');
	if($frequent_uids){
		$frequent_uids=explode(',',$frequent_uids);
	}else{
		$frequent_uids=array();
	}
	$add=0;
	if(in_array($uid,$frequent_uids)){
		$add=0;
		$frequent_uids=array_diff($frequent_uids,array($uid));
	}else{
		$add=1;
		$frequent_uids[]=$uid;
	}
	
	$frequent_uids=implode(',',array_unique($frequent_uids));
	$ret=C::t('user_setting')->insert(array('contract_frequent'=>$frequent_uids));
	exit(json_encode(array('uid'=>$uid,'add'=>$add,'msg'=>'success')));
}
