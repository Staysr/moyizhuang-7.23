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
define('NOROBOT', TRUE);

$_G['inajax'] = 1;
$_GET['topiclist'] = !empty($_GET['topiclist']) ? (is_array($_GET['topiclist']) ? array_unique($_GET['topiclist']) : $_GET['topiclist']) : array();

loadcache(array('threadtableids'));

require_once libfile('function/discuss');
require_once libfile('function/misc');
$fid=intval($_GET['fid']);
$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']);

if(!$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']) ){
	showmessage(lang('discuss_no_exist'),dreferer());
}
if($discuss['perm']<3 && $_G['adminid']!=1){
	showmessage(lang('no_privilege'),NULL);
}
if ($discuss['inarchive']) {
	exit(json_encode(array('code' => 400, 'message' => lang('discuss_archived_cannot_do'))));
}
$_G['fid']=$fid;
$_G['forum']=$discuss;
$modpostsnum = 0;
$resultarray = $thread = array();

$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();

$frommodcp = !empty($_GET['frommodcp']) ? intval($_GET['frommodcp']) : 0;


$navigation = $navtitle = '';

if(!empty($_GET['tid'])) {
	
	$thread = C::t('discuss_thread')->fetch_by_tid_fid_displayorder($_GET['tid'], $_G['fid'], 0, 0);
	if(!$thread) {
		showmessage(lang('thread_no_exist'));
	}
	$navtitle .= ' - '.$thread['subject'].' - ';
}


$_GET['handlekey'] = 'mods';


if(preg_match('/^\w+$/', $_GET['action']) && file_exists($topicadminfile = libfile('topicadmin/'.$_GET['action']))) {
	require_once $topicadminfile;
} else {
	showmessage(lang('undefined_opt'), NULL);
}

if($resultarray) {

	if($resultarray['modtids']) {
		updatemodlog($resultarray['modtids'], $modaction, $resultarray['expiration']);
	}

	if(is_array($resultarray['modlog'])) {
		if(isset($resultarray['modlog']['tid'])) {
			modlog($resultarray['modlog'], $modaction);
		} else {
			foreach($resultarray['modlog'] as $thread) {
				modlog($thread, $modaction);
			}
		}
	}

	

	showmessage((isset($resultarray['message']) ? $resultarray['message'] : 'admin_succeed'), $resultarray['redirect']);

}

?>

