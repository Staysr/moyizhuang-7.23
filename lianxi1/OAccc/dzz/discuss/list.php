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
require_once libfile('function/code');
require_once libfile('function/discuss');
define('IMGDIR','dzz/discuss/images');
$ismobile=helper_browser::ismobile();

$fid=intval($_GET['fid']);
$do=empty($_GET['do'])?'index':trim($_GET['do']);
if(!$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']) ){
	showmessage(lang('discuss_no_exist'),dreferer());
}
$navtitle=$discuss['name'].'-'.lang('appname');
if($discuss['isdelete'] > 0){
	showmessage(lang('discuss_no_exist'),dreferer());
}
if($discuss['perm']<1 && $discuss['viewperm']>0 && $_G['adminid']!=1 && $discuss['allowshare'] < 1){ //私有的文件只有成员才能查看
	showmessage(lang('need_discuss_member'),dreferer());
}
if ($discuss['inarchive'] && $do != 'index' && $do != 'restore') {
	showmessage(lang('discuss_archived_cannot_do'),dreferer());
}
if($do=='newthread'){
	require( DZZ_ROOT.'./dzz/discuss/list/newthread.php');
	exit();
}elseif($do=='setting'){
	require(DZZ_ROOT.'./dzz/discuss/list/setting.php');
	exit();
}elseif($do=='event'){
	require(DZZ_ROOT.'./dzz/discuss/list/event.php');
	exit();
}elseif($do=='viewthread'){
	
	require(DZZ_ROOT.'./dzz/discuss/list/viewthread.php');
	exit();	
}elseif($do=='user'){
	require(DZZ_ROOT.'./dzz/discuss/list/user.php');
	exit();	
}elseif($do=='ajax'){
	require(DZZ_ROOT.'./dzz/discuss/list/ajax.php');
	exit();
} elseif($do=='deletepost'){//彻底删除
	$pid=intval($_GET['pid']);
	$tid=intval($_GET['tid']);
	$post=C::t('discuss_post')->fetch('tid:'.$tid,$pid);
	$thread = C::t('discuss_thread')->fetch($tid);
	if ($thread['inarchive']) {
		showmessage(lang('thread_archived_cannot_do'),dreferer());
	}
	if($post['first']>0 ||($_G['adminid']!=1 && $discuss['perm']<3 && $post['authorid']!=$_G['uid'])){
		showmessage(lang('no_privilege'),dreferer());
	}
	if(deletepost($pid, 'pid',true)){
		showmessage('do_success',dreferer());
	}else{
		showmessage(lang('delete_failed'),dreferer());
	}
} elseif ($do == 'archive') {
	$forward = $_GET['forward'];
	if($discuss['perm']<3 && $_G['adminid']!=1){
		showmessage(lang('no_privilege'),dreferer());
	}
	if(C::t('discuss')->archive_by_fid($fid)){
		showmessage(lang('archived_success'),MOD_URL.'&op=list&fid='.$fid.'&forward='.$forward);
	}else{
		showmessage(lang('archived_failed'),dreferer());
	}
}elseif($do=='restore'){
	    if($discuss['perm']<3 && $_G['adminid']!=1){
			exit(json_encode(array('code' => 400, 'type' => 'restore', 'message' => lang('no_privilege'))));
		}
		if(C::t('discuss')->restore_by_fid($fid)){
			exit(json_encode(array('code' => 200, 'type' => 'restore', 'message' => lang('cancle_archived_success'))));
		}else{
			exit(json_encode(array('code' => 400, 'type' => 'restore', 'message' => lang('cancle_archived_failed'))));
		}

	
}elseif($do=='delete'){
	 if($discuss['perm']<3 && $_G['adminid']!=1){
		showmessage(lang('no_privilege'),dreferer());
	}
	if(C::t('discuss')->delete_by_fid($fid)){
		showmessage(lang('discuss_delete_success'),MOD_URL.'&op=list&fid='.$fid);
	}else{
		showmessage(lang('discuss_delete_failed'),MOD_URL.'&op=list&fid='.$fid);
	}	
}elseif($do=='index'){
	if($discuss['redirect']){
		dheader("Location: $discuss[redirect]");
		exit();
	}
	$discuss['rules']=dzzcode($discuss['rules']);
	$forumlastvisit = 0;
	if(isset($_G['cookie']['forum_lastvisit']) && strexists($_G['cookie']['forum_lastvisit'], 'D_'.$discuss['fid'])) {
		preg_match('/D\_'.$discuss['fid'].'\_(\d+)/', $_G['cookie']['forum_lastvisit'], $a);
		$forumlastvisit = $a[1];
		unset($a);
	}
	dsetcookie('forum_lastvisit', preg_replace("/D\_".$discuss['fid']."\_\d+/", '', $_G['cookie']['forum_lastvisit']).'D_'.$discuss['fid'].'_'.TIMESTAMP, 604800);
	$keyword=trim($_GET['keyword']);
	$typeid=intval($_GET['typeid']);
	$ordertype=trim($_GET['ordertype']);
	if(!in_array($ordertype,array('dateline','lastpost','heats','digest'))) $ordertype='lastpost';
	$moderators=C::t('discuss_user')->fetch_all_by_perm($fid,array(3),5);
	$threadclass=C::t('discuss_threadclass')->fetch_all_by_fid($fid);
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	$ppp=$perpage=$discuss['ppp'];
	$extra = rawurlencode(!IS_ROBOT ? 'page='.$page.(($ordertype ? '&ordertype='.$ordertype : '').($typeid?'&typeid='.$typeid:'')) : 'page=1');
	if(!$ismobile) {
		parse_str(rawurldecode($_GET['forward']), $urlarr);
		$urlarr['fid'] = $fid;
		$forward= rawurlencode(url_implode($urlarr));
	}
	$count_top=0;
	$count_top_typeid=0;
	$start=($page-1)*$perpage;
	$gets = array(
			'mod'=>'discuss',
			'op'=>'list',
			'fid'=>$fid,
			'typeid'=>$typeid,
			'ordertype'=>$ordertype,
			'forward'=>$forward
		);
	$theurl = DZZSCRIPT."?".url_implode($gets);
	$toplist=array();
	if(!$keyword && $page==1){
		if (!$_G['adminid']) {
			$fids = array($fid);
			$fids = array_merge($fids,array_keys(C::t('discuss_user')->fetch_all_by_uid($_G['uid'])));
		} else {
			$fids = null;
		}
		$topthread_all=C::t('discuss_thread')->fetch_all_by_tid_fid_displayorder(1, null, $fids,3, 'displayorder');
		$topthread=C::t('discuss_thread')->fetch_all_by_tid_fid_displayorder(1, null, $fid, 2, 'displayorder',0,0,'=');
		foreach($topthread as $value){
			$topthread_all[$value['tid']]=$value;
		}
		$count_top=$threadindex=0;
		foreach($topthread_all as $thread){
			$thread=formatThreadData($thread,$discuss,$forumlastvisit,$forward);
			//if($value['fid']==$fid){
				 $count_top+=1;
			//	 if($typeid>0 && $value['typeid']==$typeid) $count_top_typeid+=1;
			//}
			$toplist[$thread['tid']]=$thread;
			$threadids[$threadindex] = $thread['tid'];
			$threadindex++;
		}
		
		$ppp=$perpage-$count_top;
		$start=0;
	}else{
		$count_top1=C::t('discuss_thread')->count_by_tid_fid_displayorder(1, null, $fids,3);
		$count_top2=C::t('discuss_thread')->count_by_tid_fid_displayorder(1, null, $fid,2,'=');
		$count_top=$count_top1+$count_top2;
		$start-=$count_top;
		$ppp=$perpage;
	}
	
	$list=array();
	$threadindex = 0;
	$threadids=array();
	if($typeid){
		
		$count=C::t('discuss_thread')->count_by_fid_typeid_displayorder($fid,$typeid,2,'<');
		if($count){
			foreach(C::t('discuss_thread')->fetch_all_by_fid_typeid_displayorder($fid,$typeid, 2,'<',$start,$ppp, $ordertype) as $value){
				$value=formatThreadData($value,$discuss,$forumlastvisit,$forward);
				$list[$value['tid']]=$value;
				$threadids[$threadindex] = $value['tid'];
				$threadindex++;
			}
		}
		
	}else{
		$count=C::t('discuss_thread')->count_by_fid($fid);
		if($count){
			foreach(C::t('discuss_thread')->fetch_all_by_tid_fid_displayorder(0, null, $fid, 2, $ordertype,$start,$ppp,'<','DESC',$keyword) as $value){
				$value=formatThreadData($value,$discuss,$forumlastvisit,$forward);
				$list[$value['tid']]=$value;
				$threadids[$threadindex] = $value['tid'];
				$threadindex++;
			}
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
	$list = array_merge($toplist, $list); 
	$multi=multi($count, $perpage, $page, $theurl);
	if($page*$perpage<$count){
		$nextpage=$page+1;
	}else{
		$nextpage=0;
	}
    if($ismobile) {
    	if ($_GET['ajax']) {
    		include template('mobile/thread_list');
    	} else {
    		include template('mobile/board_detail');
    	}
    }else {
        include template('discuss_list');
	}
}



?>
