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
define('IMGDIR','dzz/discuss/images');
define('FORUMINDEX',true);
$ismobile=helper_browser::ismobile();
//判断游客,弹出登录框
Hook::listen('check_login');
require_once libfile('function/discuss');
require_once libfile('function/code');
$navtitle=lang('index').' - '.lang('appname');

$keywords = trim($_GET['keywords']);

$threads = $posts = $todayposts = $announcepm = 0;
loadcache('historyposts');
$historyposts=$_G['cache']['historyposts'];
loadcache('discuss_setting');
$rules=dzzcode($_G['cache']['discuss_setting']['rules']);
$postdata = $historyposts ? explode("\t", $historyposts) : array(0,0);
$postdata[0] = intval($postdata[0]);
$postdata[1] = intval($postdata[1]);
$ordertype=trim($_GET['ordertype']);
if(!in_array($ordertype,array('dateline','lastpost','heats','digest'))) $ordertype='lastpost';
$page = empty($_GET['page'])?1:intval($_GET['page']);
$forward=rawurlencode(str_replace('&ajax=1','',$_SERVER['QUERY_STRING']));
$cachekey='index_'.$ordertype.'_'.$page;
extract(get_index_memory_by_key($cachekey));
if(!$_GET['ajax'] && $_G['cache']['discuss_setting']['indexcache'] && defined('FORUM_INDEX_PAGE_MEMORY') && FORUM_INDEX_PAGE_MEMORY) {
	include template('discuss_index');
	exit();
}

$forumlastvisit = 0;
	if(isset($_G['cookie']['forum_lastvisit']) && strexists($_G['cookie']['forum_lastvisit'], 'D_index')) {
		preg_match('/D\_index\_(\d+)/', $_G['cookie']['forum_lastvisit'], $a);
		$forumlastvisit = $a[1];
		unset($a);
	}
	dsetcookie('forum_lastvisit', preg_replace("/D\_index\_\d+/", '', $_G['cookie']['forum_lastvisit']).'D_index_'.TIMESTAMP, 604800);

if(!defined('FORUM_INDEX_PAGE_MEMORY') || !FORUM_INDEX_PAGE_MEMORY) {
	$forums = C::t('discuss')->fetch_all_fids_by_uid($_G['uid']);
	$fids = array();
	$all_fids = array();
	foreach($forums as $forum) {
		$threads += $forum['threads'];
		$posts += $forum['posts'];
		$todayposts += $forum['todayposts'];
		$fids[$forum['fid']] = $forum['fid'];
	}
	$all_fids = $fids;
	foreach(C::t('discuss_field')->fetch_all_by_fid($fids) as $value){
		if($value['icon']) $forums[$value['fid']]['icon']=DZZSCRIPT.'?mod=io&op=thumbnail&original=1&path='.dzzencode('attach::'.$value['icon']);
		if($value['description'])  $forums[$value['fid']]['description']=$value['description'];
	}
	
	
	$ppp=$perpage=20;
	$count_top=0;
	$toplist=array();
	if($page==1){
		$topthread_all=C::t('discuss_thread')->fetch_all_by_tid_fid_displayorder(1, null, $all_fids,3, 'displayorder');
		$threadindex=0;
		foreach($topthread_all as $thread){
			$thread=formatThreadData($thread,null,$forumlastvisit,$forward);
			if($value['fid']==$fid){
				 $count_top+=1;
			}
			$toplist[$thread['tid']]=$thread;
			$threadids[$threadindex] = $thread['tid'];
			$threadindex++;
		}
		$ppp=$perpage-$count_top;
		$start=0;
	}else{
		$count_top=C::t('discuss_thread')->count_by_tid_fid_displayorder(1, null, $fids,2);
		$ppp=$perpage;
		$start=($page-1)*$perpage-$count_top;
	}
	
	$gets = array(
			'mod'=>'discuss',
			'ordertype'=>$ordertype,
			'fid'=>$fid,
		);
	$theurl = DZZSCRIPT."?".url_implode($gets);
	$list=array();
	$threadindex = 0;
	$threadids=array();
		$count=$threads;
		if($count){
			foreach(C::t('discuss_thread')->fetch_all_by_tid_fid_displayorder(0, null, $fids, 3, $ordertype,$start,$perpage,'<') as $value){
				$value=formatThreadData($value,null,$forumlastvisit);
				$list[$value['tid']]=$value;
				$threadids[$threadindex] = $value['tid'];
				$threadindex++;
			}
		}
	if(!empty($threadids)) {
			$indexlist = array_flip($threadids);
			foreach(C::t('discuss_threadaddviews')->fetch_all($threadids) as $tidkey => $value) {
				$index = $indexlist[$tidkey];
				$threadlist[$index]['views'] += $value['addviews'];
				if($list[$index]) $list[$index]['views'] += $value['addviews'];
				elseif($toplist[$index]) $toplist[$index]['views'] += $value['addviews'];
			}
		}
	$multi=multi($count, $perpage, $page, $theurl);
	if($page*$perpage>$count){
		$nextpage=0;
	}else{
		$nextpage=$page+1;
	}
	if($page>1){
		$prevpage=$page-1;
	}else{
		$prevpage=0;
	}
	if($_G['cache']['discuss_setting']['indexcache']>0 && defined('FORUM_INDEX_PAGE_MEMORY') && !FORUM_INDEX_PAGE_MEMORY) {
		$key = $cachekey;
		memory('set', 'forum_index_page_'.$key, array(
			'forums'=>$forums,
			'threads' => $threads,
			'posts' => $posts,
			'todayposts' => $todayposts,
			'toplist'=>$toplist,
			'list'=>$list,
			'multi'=>$multi,
			'nextpage'=>$nextpage,
			'prevpage'=>$prevpage,
			'theurl'=>$theurl
			),$_G['cache']['discuss_setting']['indexcache']);
	}
}
function get_index_memory_by_key($key) {
	if(memory('check')) {
		$ret = memory('get', 'forum_index_page_'.$key);
		define('FORUM_INDEX_PAGE_MEMORY', $ret ? 1 : 0);
		if($ret) {
			return $ret;
		}
	}
	return array('none' => null);
}
	//$discuss['rules']=dzzcode($discuss['rules']);
$list = array_merge($toplist, $list);
if($ismobile) {
	if ($_GET['ajax']) {
		include template('mobile/thread_list');
	} else {
		include template('mobile/index');
	}
} else {
	include template('discuss_index');	
}

?>
