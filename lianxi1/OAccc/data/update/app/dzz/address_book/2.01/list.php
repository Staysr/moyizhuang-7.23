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
require libfile('function/organization');
$ismobile=helper_browser::ismobile();
/*require 'conf.php';*/
$orgid = intval($_GET['gid']);
$org = C::t('organization') -> fetch($orgid);

/*if ($_GET['forgid']) {
	//获得顶级id
	$all_orgname = DB::fetch_all('select orgid,orgname from %t where forgid=%d', array('organization', intval($_GET['forgid'])));
}
*/
$keyword = getstr($_GET['content']);
$param = array('user', 'organization_user', 'organization');
$sql = "1";
if ($orgid) {
	if ($org) {
		$sql .= " and o.pathkey LIKE %s  escape '/'";
		$param[] = '%' . str_replace('_', '/_', $org['pathkey']) . '%';
	} else {
		$sql .= " and o.orgid=%d";
		$param[] = $orgid;
	}
} elseif ($_GET['gid']=='frequent') {
	$frequent_uids=C::t('user_setting')->fetch_by_skey('contract_frequent');
	if($frequent_uids){
		$frequent_uids=explode(',',$frequent_uids);
	}else{
		$frequent_uids=array();
	}
	$sql .= " and (isnull(o.type) OR o.type='0') and u.uid IN(%n)";
	$param[] = $frequent_uids;
//	$param[] = '%' . str_replace('_', '/_', $org['pathkey']) . '%';
}elseif(strpos($_GET['gid'],'search-')!==false){
	$keyword = getstr(str_replace('search-','',$_GET['gid']));
}

if($_GET['gid']=='all'){
	$param=array('user');
	$sql='1';
	if (!empty($keyword)) {
		$sql .= " and (u.username LIKE %s or u.email LIKE %s or u.phone LIKE %s)";
		$param[] = '%' . $keyword . '%';
		$param[] = '%' . $keyword . '%';
		$param[] = '%' . $keyword . '%';
	}
	$data = DB::fetch_all("select * from %t where $sql limit 10000", $param);
	$orgids = array(array('path'=>lang('alluser'),'users'=>array()), 'user_count' => 0);
	$users=array();
	foreach($data as $value){
		if(!preg_match("/\w+",$value['username'])){
			$pinyin=pinyin::encode(new_strsubstr($value['username'],1,''),'all');
		}else{
			$pinyin=$value['username'];
		}
	
		$users[$pinyin.'_'.$value['uid']] = array('uid' => $value['uid'], 'username' => $value['username'], 'email' => $value['email'], 'phone' => $value['phone'], 'orgid' => $value['orgid'], 'weixinid' => $value['weixinid'], 'nickname' => $value['nickname']);
	}
	
	ksort($users);
	$orgids[0]['users']=$users;
}else{
	if (!empty($keyword)) {
		$sql .= " and (u.username LIKE %s or u.email LIKE %s or u.phone LIKE %s)";
		$param[] = '%' . $keyword . '%';
		$param[] = '%' . $keyword . '%';
		$param[] = '%' . $keyword . '%';
	}
	$data = DB::fetch_all("select ou.*,o.orgname,o.forgid,o.disp,o.pathkey,o.disp,u.uid,u.username,u.weixinid,u.email,u.phone from %t u LEFT JOIN %t ou ON u.uid=ou.uid  LEFT JOIN %t o ON ou.orgid=o.orgid  where $sql limit 1000", $param);
	$orgids = array();
	//按pathkey升序排列（可以保证上级目录始终排在下级目录前面）；
	//将用户按部门分组；
	foreach ($data as $value) {
		if ($ismobile && $value['orgid'] != $orgid && $orgid) continue;
		$value['orgid'] = intval($value['orgid']);
		if(empty($value['pathkey'])) $value['pathkey']=0;
		if(empty($orgids[$value['pathkey']])) {
			$orgids[$value['pathkey']] = array('orgid' => $value['orgid'], 'orgname' => $value['orgname'], 'forgid' => $value['forgid'], 'disp' => $value['disp'], 'path' => ($value['orgid'] ? C::t('organization') -> getPathByOrgid($value['orgid']) : lang('no_institution_users')));
		}
		if ($orgids[$value['pathkey']]){
			if(!preg_match("/\w+",$value['username'])){
				$pinyin=pinyin::encode(new_strsubstr($value['username'],1,''),'all');
			}else{
				$pinyin=$value['username'];
			}
			$orgids[$value['pathkey']]['users'][$pinyin.'_'.$value['uid']] = array('uid' => $value['uid'], 'username' => $value['username'], 'email' => $value['email'], 'phone' => $value['phone'], 'orgid' => $value['orgid'], 'weixinid' => $value['weixinid']);
		}
	}
	ksort($orgids);
	foreach($orgids as $pathkey => $users){
		ksort($users['users']);
		$orgids[$pathkey]=$users;
	}
	if (isset($orgids[0]) && ($noorg = $orgids[0])) {
		unset($orgids[0]);
		$orgids[] = $noorg;
	}
	
}

if ($ismobile) {

	$users = array();
	foreach ($orgids as $k => $v) {
		foreach ($v['users'] as $key => $value) {
			if (!$users[$value['uid']]) $users[$value['uid']] = $value;
		}
	}
	if (!$keyword) $orgids['user_count'] = count($users);
    if(!intval($_GET['gid'])) {
        include  template('mobile/index');
    }else {
        include  template('mobile/addr_list');
    }

} else {
	include  template('content');
}
dexit();
