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
$navtitle=lang('archived').' - '.lang('appname');
$forward=rawurlencode(str_replace('&ajax=1','',$_SERVER['QUERY_STRING']));
$type = $_GET['type'];
if ($type == 'discuss') {
	$pageSize = 20;
	$orderby = in_array($_GET['ordertype'], array('arhtime', 'dateline')) ? $_GET['ordertype'] : 'arhtime';
	$count = C::t('discuss')->fetch_archive(1);
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$start = ($page - 1) * $pageSize;
	$list = C::t('discuss')->fetch_archive(0, $start, $pageSize, $orderby);
	$gets = array(
					'op'=>'archive',
					'ordertype'=>$orderby,
					'type'=>'discuss'
				);
	$theurl = MOD_URL.'&'.url_implode($gets);
	$multi=multi($count, $pageSize, $page, $theurl);
} else {
	$pageSize = 20;
	$orderby = in_array($_GET['ordertype'], array('arhtime', 'dateline')) ? $_GET['ordertype'] : 'arhtime';
	$count = C::t('discuss_thread')->fetch_archive(1);
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$start = ($page - 1) * $pageSize;
	$list = C::t('discuss_thread')->fetch_archive(0, $start, $pageSize, $orderby);
	$gets = array(
					'op'=>'archive',
					'ordertype'=>$orderby,
				);
	$theurl = MOD_URL.'&'.url_implode($gets);
	$multi=multi($count, $pageSize, $page, $theurl);
}
include template('archive');
?>
