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
require_once libfile('function/discuss');
require_once libfile('function/code');
define('IMGDIR','dzz/discuss/images');
$fid=intval($_GET['fid']);
$tid=intval($_GET['tid']);
if(!$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']) ){
	showmessage(lang('discuss_no_exist'),dreferer());
}
if($discuss['deletetime']>0 && $discuss['perm']<3){
	showmessage(lang('discuss_no_exist'),dreferer());
}
if($discuss['perm']<1 && $discuss['viewperm']>0 && !$discuss['allowshare']){ //私有的文件只有成员才能查看
	showmessage(lang('need_discuss_member'),dreferer());
}
if(!$thread=C::t('discuss_thread')->fetch($tid)){
	showmessage(lang('thread_no_exist'),dreferer());
}
$thread=formatThreadData($thread);

$thisbg = '#FFFFFF';
if(!getstatus($thread['status'], 2)) {
	$posts = C::t('discuss_post')->fetch_all_by_tid('tid:'.$thread['tid'], $thread['tid'], true, 'ASC', 0, 100, null, 0);
} else {
	$posts = C::t('discuss_post')->fetch_threadpost_by_tid_invisible($thread['tid'], 0);
	$posts = array($posts);
}
$userinfo = $uids = $skipaids = array();
foreach($posts as $post) {

	if(strpos($post['message'], '[/password]') !== FALSE) {
		$post['message'] = '';
	}

	$post['dateline'] = dgmdate($post['dateline'], 'u');
	if(preg_match("/\[hide\]\s*(.+?)\s*\[\/hide\]/is", $post['message'], $hide)) {
		if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $hide[1], $matchaids)) {
			$skipaids = array_merge($skipaids, $matchaids[1]);
		}
		$post['message'] = preg_replace("/\[hide\]\s*(.+?)\s*\[\/hide\]/is", '', $post['message']);
	}
	if(strpos(strtolower($post['message']), '[hide=') !== FALSE) {
		$post['message'] = preg_replace("/\[hide=(\d+)\]\s*(.*?)\s*\[\/hide\]/is", "", $post['message']);
	}
	$post['message'] = dzzcode($post['message']);

	if(strpos($post['message'], '[page]') !== FALSE) {
		$post['message'] = preg_replace("/\s?\[page\]\s?/is", '', $post['message']);
	}
	if(strpos($post['message'], '[/index]') !== FALSE) {
		$post['message'] = preg_replace("/\s?\[index\](.+?)\[\/index\]\s?/is", '', $post['message']);
	}

	if($post['attachment']) {
		$attachment = 1;
	}
	
	$uids[] = $post['authorid'];
	$postlist[$post['pid']] = $post;
}
unset($posts);
if($uids) {
	$uids = array_unique($uids);
	$userinfo = C::t('user')->fetch_all($uids);
}

include template('discuss_printthread');
?>
