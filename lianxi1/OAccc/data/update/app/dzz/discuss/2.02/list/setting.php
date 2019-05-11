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
if ($discuss['perm'] < 3) showmessage(lang('no_privilege'),dreferer());
$navtitle = lang('settings');
$forward=rawurlencode(rawurldecode($_GET['forward']));
$forward=rawurlencode('mod=discuss&op=list&fid='.intval($_GET['fid']).'&forward='.$forward);
if (submitcheck('discusssubmit')) {

	$discuss['threadtypes']['available'] = $_GET['threadtypes']['available'];
	if ($discuss['threadtypes']['available'] && (!$_GET['enable'] && !$_GET['newenable'] && !$_GET['newmoderators'] && !$_GET['moderators'])) {
		showmessage(lang('least_one_class_enabled'),dreferer());
	} 
	$types=array();
	$rtypes = array();
	foreach($_GET['newname'] as $key=>$value){
		if(empty($value)) continue;
		$tc_setarr=array('fid'=>$fid,
					  'displayorder'=>$_GET['newdisplayorder'][$key],
					  'name'=>str_replace('...','',getstr($value,50)),
					  'icon'=>$_GET['newicon'][$key],
					  'enable'=>$_GET['newenable'][$key] ? 1 : 0,
					  'moderators'=>$_GET['newmoderators'][$key] ? 1 : 0,
					  );

		$tc_setarr['typeid']=C::t('discuss_threadclass')->insert($tc_setarr,1);
		$types[$tc_setarr['typeid']]=$tc_setarr['name'];
		$rtypes[] = $tc_setarr;
	}
	foreach($_GET['cname'] as $key=>$value){
		if(empty($value)) continue;
		if(in_array($key,$_GET['delete'])) continue;
		$tc_setarr=array('fid'=>$fid,
					  'displayorder'=>$_GET['displayorder'][$key],
					  'name'=>str_replace('...','',getstr($value,50)),
					  'icon'=>$_GET['icon'][$key],
					  'enable'=>intval($_GET['enable'][$key]),
					  'moderators'=>intval($_GET['moderators'][$key])
					  );
		
		C::t('discuss_threadclass')->update($key,$tc_setarr);
		$tc_setarr['typeid']=$key;
		$types[$key]=$tc_setarr['name'];
		$rtypes[] = $tc_setarr;
	}
	//更新论坛
	$discuss['threadtypes']['types']=$types;
	C::t('discuss_field')->update($fid,array('threadtypes'=>serialize($discuss['threadtypes'])));

	$setarr = array(
					'name'=>str_replace('...','',getstr($_GET['name'],80)),
					'allowanonymous'=>intval($_GET['allowanonymous']),
				);
	$field=array(
					'rules'=>$_GET['rules'],
					'orderfield'=>intval($_GET['orderfield']),
					'order'=>intval($_GET['order']),
					'postperm'=>intval($_GET['postperm']),
					'replyperm'=>intval($_GET['replyperm']),
					'redirect'=>trim($_GET['redirect']),
					'anonymous'=>intval($_GET['anonymous']),
					'allowshare'=>$_GET['allowshare'] ? 1 : 0,
				 );
	
	C::t('discuss')->update_by_fid($fid,$setarr,$field);
	array_multisort(_array_column($rtypes,'displayorder'),SORT_ASC,$rtypes);
	showmessage('do_success',dreferer());
} elseif ($_GET['position'] == 'delete') {
	$typeid = $_GET['typeid'];
	$fid = intval($_GET['fid']);
	if ($discuss['perm'] < 3) {
		exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
	}
	$alltypes = C::t('discuss_threadclass')->fetch_all_by_fid($fid);
	$types = array();
	$enables = 0;
	foreach ($alltypes as $k => $v) {
		if (($v['enable'] || $v['moderators']) && !in_array($k, $typeid)) {
			$enables ++;
		}
		if (!in_array($k, $typeid)) {
			$types[$v['typeid']] = $v['name'];
		}
	}

	$discuss['threadtypes']['types'] = $types;

	if (!$enables && $discuss['threadtypes']['available']) {
		exit(json_encode(array('code' => 400, 'message' => lang('least_one_class_enabled'))));
	}
	if (C::t('discuss_threadclass')->delete_by_typeid($typeid) || !$typeid){
		C::t('discuss_field')->update($fid,array('threadtypes'=>serialize($discuss['threadtypes'])));
		exit(json_encode(array('code' => 200, 'message' => lang('delete_success'))));
	} else {
		exit(json_encode(array('code' => 400, 'message' => lang('delete_failed'))));
	}
} else {
	$list=C::t('discuss_threadclass')->fetch_all_by_fid($fid);
	$threadtypes=$discuss['threadtypes'];
}
include template('list/setting');
?>
 
