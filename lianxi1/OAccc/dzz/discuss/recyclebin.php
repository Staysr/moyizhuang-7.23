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
//判断游客,弹出登录框
Hook::listen('check_login');
require_once libfile('function/discuss');
$type = $_GET['type'];
$uid = $_G['uid'];
$forward=rawurlencode(str_replace('&ajax=1','',$_SERVER['QUERY_STRING']));
$navtitle=lang('recyclebin').' - '.lang('appname');
if ($type == 'thread') {
	$count = C::t('discuss_recycle')->fetch_thread_by_recycle(1);
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$pageSize = 20;
	$start  = ($page - 1) * $pageSize;
	$list = C::t('discuss_recycle')->fetch_thread_by_recycle(0, $start, $pageSize);
	$tids = array();
	foreach ($list as $k => $v) {
		$tids[] = $v['id'];
	}
	if ($tids) {
		foreach (C::t('discuss_thread')->fetch_all_by_tid($tids) as $k => $v) {
			$list[$v['tid']]['thread'] = $v;
			$list[$v['tid']]['disname'] = emoji_decode(DB::result_first('select name from %t where fid = %d', array('discuss', $v['fid'])));
		}
	}
	$theurl = MOD_URL.'&op=recyclebin&type=thread';
	$multi=multi($count, $pageSize, $page, $theurl);
} elseif ($type == 'discuss') {
	$count = C::t('discuss_recycle')->fetch_discuss_by_recycle(1);
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$pageSize = 20;
	$start  = ($page - 1) * $pageSize;
	$list = C::t('discuss_recycle')->fetch_discuss_by_recycle(0, $start, $pageSize);
	$fids = array();
	foreach ($list as $k => $v) {
		$fids[] = $v['id'];
	}
	if ($fids) {
		foreach (C::t('discuss')->fetch_all_info_by_fids($fids) as $k => $v) {
			$list[$v['fid']]['discuss'] = $v;
		}
	}
	$theurl = MOD_URL.'&op=recyclebin&type=discuss';
	$multi=multi($count, $pageSize, $page, $theurl);
} else {
	$count = C::t('discuss_recycle')->my_all_recycle(1);
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$pageSize = 20;
	$start  = ($page - 1) * $pageSize;
	$list = C::t('discuss_recycle')->my_all_recycle(0, $start, $pageSize);
	foreach ($list as $k => $v) {
		if ($v['type'] == 'thread') {
			$list[$k]['thread'] = C::t('discuss_thread')->fetch($v['id']);
			$list[$k]['disname'] = emoji_decode(DB::result_first('select name from %t where fid = %d', array('discuss', $v['fid'])));
		} elseif($v['type'] == 'field') {
			$list[$k]['discuss'] = C::t('discuss')->fetch_by_fid($v['id']);
		}
		$user = C::t('user')->fetch_all_username_by_uid($v['deleteuid']);
		$list[$k]['deleter'] = $user[$v['deleteuid']];
	}
	$theurl = MOD_URL.'&op=recyclebin';
	$multi=multi($count, $pageSize, $page, $theurl);
}

include template('recyclebin');
?>

