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
$fid=intval($_GET['fid']);
$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']);

if(!$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']) ){
	showmessage(lang('discuss_no_exist'),dreferer());
}
foreach(array('pid', 'ptid', 'authorid', 'ordertype', 'postno') as $k) {
	$$k = !empty($_GET[$k]) ? intval($_GET[$k]) : 0;
}
$extra=rawurlencode(rawurldecode($_GET['extra']));
$forward=rawurlencode(rawurldecode($_GET['forward']));
if(empty($_GET['goto']) && $ptid) {
	$_GET['goto'] = 'findpost';
}
if($_GET['goto'] == 'findpost') {

	$post = $thread = array();

	if($ptid) {
		$thread = get_thread_by_tid($ptid);
	}
	if($pid) {

		if($thread) {
			$post = C::t('discuss_post')->fetch($thread['posttableid'], $pid);
		} else {
			$post = get_post_by_pid($pid);
		}

		if($post && empty($thread)) {
			$thread = get_thread_by_tid($post['tid']);
		}
	}

	if(empty($thread)) {
		showmessage(lang('thread_no_exist'));
	} else {
		$tid = $thread['tid'];
	}

	if(empty($pid)) {
		if($postno) {
			$postno = $postno > 1 ? $postno - 1 : 0;
			$post = C::t('discuss_post')->fetch_visiblepost_by_tid($thread['posttableid'], $ptid, $postno);
		}
	}
	if(empty($post)) {
		if($ptid) {
			header("HTTP/1.1 301 Moved Permanently");
			dheader("Location: ".$_G['siteurl'].outputurl(DZZSCRIPT."?mod=discuss&op=viewthread&fid=$fid&tid=$ptid&extra=$extra&forward=$forward"));
		} else {
			showmessage('post_check', NULL, array('tid' => $ptid));
		}
	} else {
		$pid = $post['pid'];
	}

	$ordertype = intval($_GET['ordertype']) ;

	$curpostnum=$postno?$postno+1:C::t('discuss_post')->fetch_postno_by_tid_pid($thread['posttableid'],$tid,$pid);

	if($ordertype != 1) {
		$page = ceil($curpostnum / $discuss['ppp2']);
	} elseif($curpostnum > 1) {
		$page = ceil(($thread['replies'] - $curpostnum + 3) / $discuss['ppp2']);
	} else {
		$page = 1;
	}
	$authoridurl = $authorid ? '&authorid='.$authorid : '';
	$ordertypeurl = $ordertype ? '&ordertype='.$ordertype : '';
	header("HTTP/1.1 301 Moved Permanently");
	dheader("Location: ".$_G['siteurl'].outputurl(DZZSCRIPT."?mod=discuss&op=viewthread&fid=$fid&tid=$thread[tid]&extra=$extra&forward=$forward&page=$page$authoridurl$ordertypeurl#post_$pid"));
}
	

$tid=intval($_GET['tid']);
if(!$thread=C::t('discuss_thread')->fetch($tid)){
	showmessage(lang('thread_no_exist'),dreferer());
}

if($_GET['goto'] == 'lastpost') {

	$pageadd = '';
	//if(!getstatus($_G['thread'], 4)) {
		$page =  ceil(($thread['replies'] + 1) / $discuss['ppp2']);
		$pageadd = $page > 1 ? '&page='.$page : '';
		$lastpostno=C::t('discuss_post')->fetch_last_postno_by_tid($thread['posttableid'],$tid);
	//}
	dheader('Location: '.$_G['siteurl'].outputurl(DZZSCRIPT.'?mod=discuss&op=viewthread&fid='.$thread['fid'].'&tid='.$thread['tid'].'&extra='.$extra.'&forward='.$forward.$pageadd.'#post_'.$lastpostno));

} elseif($_GET['goto'] == 'nextnewset' || $_GET['goto'] == 'nextoldset') {

	$lastpost = $thread['lastpost'];


	$glue = '<';
	$sort = 'DESC';
	if($_GET['goto'] == 'nextnewset') {
		$glue = '>';
		$sort = 'ASC';
	}
	$next = C::t('discuss_thread')->fetch_next_tid_by_fid_lastpost($thread['fid'], $lastpost, $glue, $sort, $thread['threadtableid']);
	if($next) {
		dheader("Location: ".$_G['siteurl'].outputurl(DZZSCRIPT."?mod=discuss&op=viewthread&fid=$fid&tid=$next&extra=$extra&forward=$forward"));
	} elseif($_GET['goto'] == 'nextnewset') {
		showmessage(lang('no_next_thread'),dreferer());
	} else {
		showmessage(lang('no_last_thread'),dreferer());
	}

} else {
	showmessage(lang('undefined_opt'), NULL);
}

?>

