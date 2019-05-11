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
define('IMGDIR','dzz/discuss/images');
$ismobile=helper_browser::ismobile();

$fid=intval($_GET['fid']);
if(!$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']) ){
	showmessage(lang('discuss_no_exist'),dreferer());
}
if($discuss['isdelete']) {
	showmessage(lang('discuss_no_exist'),dreferer());
}
if($discuss['0'] > 0){
	showmessage(lang('discuss_no_exist'),dreferer());
}
if($discuss['perm']<1 && $discuss['viewperm']>0 && $discuss['allowshare'] < 1){ //私有的文件只有成员才能查看
	showmessage(lang('need_discuss_member'),dreferer());
}
$tid=intval($_GET['tid']);
if(!$thread=C::t('discuss_thread')->fetch($tid)){
	showmessage(lang('thread_no_exist'),dreferer());
}
if($thread['isdelete']) {
	showmessage(lang('thread_no_exist'),dreferer());
}

//updatethreadcount($tid);
$extra=rawurlencode(rawurldecode($_GET['extra']));
$forward=rawurlencode(rawurldecode($_GET['forward']));
parse_str(rawurldecode($_GET['forward']), $urlarr);
if ($urlarr['fid'] && empty($_GET['page'])) {//处理“返回”
	$urlfid = $urlarr['fid'];
	unset($urlarr['fid']);
	$forward = rawurlencode(url_implode($urlarr));
	$forward = rawurlencode('mod=discuss&op=list&fid='.$urlfid.'&forward='.$forward);
}
$thread=formatThreadData($thread,$discuss,TIMESTAMP,$forward,$extra);
$authorid=$_GET['authorid'] = !empty($_GET['authorid']) ? intval($_GET['authorid']) : 0;
$ordertype=$_GET['ordertype'] = !empty($_GET['ordertype']) ? intval($_GET['ordertype']) : 0;
$page = empty($_GET['page'])?1:intval($_GET['page']);
$ppp=$perpage=$discuss['ppp2'];
$start=($page-1)*$perpage;
$gets = array(
		'mod'=>'discuss',
		'op'=>'viewthread',
		'fid'=>$fid,
		'tid'=>$tid,
		'ordertype'=>$ordertype,
		'authorid'=>$authorid,
		'extra'=>$extra,
		'forward'=>$forward
	);
$theurl = DZZSCRIPT."?".url_implode($gets);

if($thread['displayorder'] != -4) {
	$modmenu = array(
		'thread' => ($discuss['perm']>2 || $_G['adminid']==1),
		'post' => ($discuss['perm']>2 || $_G['adminid']==1 || $thread['authorid'] == $_G['uid'])
	);
} else {
	$modmenu = array();
}

$posttableid = $thread['posttableid'];
$navtitle=$thread['subject'].' - '.$discuss['name'];

$navlast='<a href="'.MOD_URL.'&op=viewthread&fid='.$fid.'&tid='.$tid.'&extra='.$extra.'&forward='.$forward.'">'.getstr($thread['subject'],30).'</a>';
$do=empty($_GET['do'])?'index':trim($_GET['do']);

if(!empty($_GET['authorid'])) {
		$thread['replies'] = C::t('discuss_post')->count_by_tid_invisible_authorid($tid, $_GET['authorid']);
		$thread['replies']--;
		if($thread['replies'] < 0) {
			showmessage(lang('undefined_opt'));
		}
}
$totalpage = ceil(($thread['replies'] + 1) / $perpage);
$page > $totalpage && $page = $totalpage;

$postlist=$postarr=array();
$start_limit  = max(0, ($page - 1) * $perpage);
if($start_limit > $thread['replies']) {
	$start_limit = 0;
	$page = 1;
}

if($page==1 && $ordertype>0 ){
	$ppp--;
}
$multi = multi($thread['replies'] + 1, $perpage, $page,$theurl);
if($page*$perpage < ($thread['replies'] + 1)){
	$nextpage=$page+1;
}
if($page>1){
	$prevpage=$page-1;
}
$postlist = C::t('discuss_post')->fetch_all_common_viewthread_by_tid($tid, 0, $_GET['authorid'], $ordertype, $thread['replies'] + 1, $start_limit,  $ppp);
foreach($postlist as $pid=>$post){
	$postarr[$post['position']]=$post;
}
unset($postarr[1]);
if ($ordertype != 2) {
	$ordertype != 1 ? ksort($postarr) : krsort($postarr);
}

$i=0; 
if ($ordertype != 2) {
	foreach($postarr as $key=> $value){
		$i++;
		if($ordertype!=1){
			if($page==1) $number=($start_limit+1)+$i;
			else{
				$number=($start_limit)+$i;
			}
		}else{
			$number=$thread['replies']+1-($start_limit+$i)+1;
		}
		
		$postarr[$key]['number']=$number;
	}	
} else {
	$pos = C::t('discuss_post')->fetch_all_order_position($tid);
	foreach ($postarr as $k => $v) {
		$postarr[$k]['number'] = $pos[$v['pid']];
	}
}
   

if($page == 1 ) {
	$firstpost = C::t('discuss_post')->fetch_threadpost_by_tid_invisible($tid);
	if($firstpost['invisible'] == 0 ) {
		unset($postarr[$firstpost['position']]);
		$firstpost['number']=1;
		$postarr = array_merge(array($firstpost), $postarr);
		unset($firstpost);
	}
}
$postarr=formatPostData($postarr);
foreach ($postarr as $k => $v) {
	$postarr[$k]['cmtcount'] = C::t('discuss_comment')->get_cmt_by_pid($v['pid'], 0, 1);
	$postarr[$k]['comments'] = C::t('discuss_comment')->get_cmt_by_pid($v['pid']);
}

viewthread_updateviews();

if ($ismobile) {
	if ($_GET['ajax']) {
		include template('mobile/viewthread_post_list');
	} else {
		include template('mobile/detail');
	}
} else {
	include template('discuss_viewthread');
}

?>
