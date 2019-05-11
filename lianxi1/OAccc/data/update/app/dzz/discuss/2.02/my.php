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
//判断游客,弹出登录框
Hook::listen('check_login');

define('IMGDIR','dzz/discuss/images');
$ismobile=helper_browser::ismobile();

$do=empty($_GET['do'])?'myforum':trim($_GET['do']);
$forward=rawurlencode($_SERVER['QUERY_STRING']);
if($_GET['do']=='mySort'){
	$fids=trim($_GET['fids']);
	C::t('discuss_setting')->update('paixu_'.$_G['uid'],$fids);
	exit('success');
}elseif($do=='mythread'){
	$navtitle=lang('my_post').' - '.lang('appname');
	$ordertype=trim($_GET['ordertype']);
	if(!in_array($ordertype,array('dateline','lastpost','heats','digest'))) $ordertype='dateline';
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	$perpage=20;
	$start=($page-1)*$perpage;
	$gets = array(
			'mod'=>'discuss',
			'op'=>'my',
			'do'=>'mythread',
			'ordertype'=>$ordertype
		);
	$theurl = DZZSCRIPT."?".url_implode($gets);
	$count=C::t('discuss_thread')->count_by_authorid($_G['uid']);
	$threads=C::t('discuss_thread')->fetch_all_by_authorid_displayorder($_G['uid'],$ordertype,null,'=',null,'',$start,$perpage); 
	$list=array();
	foreach($threads as $thread){
		$list[]=formatThreadData($thread,null,TIMESTAMP,$forward);
	}
	$multi=multi($count, $perpage, $page, $theurl);
	if($page*$perpage<$count){
		$nextpage=$page+1;
	}
	if ($ismobile) {
		include template('mobile/my_thread');
		exit;
	}
}elseif($do=='myfav'){
	$navtitle=lang('my_favorite').' - '.lang('appname');
	if(submitcheck('favsubmit')){
		foreach($_GET['del'] as $favid){
			C::t('discuss_favorite')->delete_by_favid($favid);
		}
		showmessage('do_success',dreferer());
	}else{
		$type = $_GET['type'];
		if ($type == 'discuss') {
			$ordertype=trim($_GET['ordertype']);
			if(!in_array($ordertype,array('favtime','dateline'))) $ordertype='favtime';
			$page = empty($_GET['page'])?1:intval($_GET['page']);
			$perpage=20;
			$start=($page-1)*$perpage;
			$gets = array(
					'mod'=>'discuss',
					'op'=>'my',
					'do'=>'myfav',
					'type'=>'discuss',
					'ordertype'=>$ordertype
				);
			$theurl = DZZSCRIPT."?".url_implode($gets);
			
			$count=C::t('discuss_favorite')->count_by_uid_idtype($_G['uid'],'forum');
			$fids=array();
			foreach(C::t('discuss_favorite')->fetch_all_by_uid_idtype($_G['uid'],'forum',0,$start,$perpage,$ordertype) as $value){
				$fids[$value['id']]=$value;
			}
			$list=array();
			$diss=C::t('discuss')->fetch_all_info_by_fids(array_keys($fids));
			//按tids顺序排序
			foreach($fids as $fid=>$value){
				if(isset($diss[$fid])) {
					$diss[$fid]['fdateline']=dgmdate($value['dateline'],'u');
					$diss[$fid]['favid']=$value['favid'];
					$list[]=$diss[$fid];
				}
			}
			unset($diss);
			$multi=multi($count, $perpage, $page, $theurl);
		} else {
			$ordertype=trim($_GET['ordertype']);
			if(!in_array($ordertype,array('favtime','dateline'))) $ordertype='favtime';
			$page = empty($_GET['page'])?1:intval($_GET['page']);
			$perpage=20;
			$start=($page-1)*$perpage;
			$gets = array(
					'mod'=>'discuss',
					'op'=>'my',
					'do'=>'myfav',
					'ordertype'=>$ordertype
				);
			$theurl = DZZSCRIPT."?".url_implode($gets);
			
			$count=C::t('discuss_favorite')->count_by_uid_idtype($_G['uid'],'thread');
			$tids=array();
			foreach(C::t('discuss_favorite')->fetch_all_by_uid_idtype($_G['uid'],'thread',0,$start,$perpage,$ordertype) as $value){
				$tids[$value['id']]=$value;
			}
			$list=$temp=array();
			$threads=C::t('discuss_thread')->fetch_all_by_tid(array_keys($tids));
			foreach($threads as $thread){
				$temp[$thread['tid']]=formatThreadData($thread,null,TIMESTAMP,$forward);
			}
			//按tids顺序排序
			foreach($tids as $tid=>$value){
				if(isset($temp[$tid])) {
					$temp[$tid]['fdateline']=dgmdate($value['dateline'],'u');
					$temp[$tid]['favid']=$value['favid'];
					$list[]=$temp[$tid];
				}
			}
			unset($threads);unset($temp);
			$multi=multi($count, $perpage, $page, $theurl);
	}
	if($page*$perpage<$count){
		$nextpage=$page+1;
	}
	if ($ismobile) {
		if ($_GET['ajax']) {
			include template('mobile/my_favorite_list');
		} else {
			include template('mobile/my_favorite');
		}
	} else {
		include template('my_favorite');
	}
	}
	exit;
} elseif ($do == 'mycomments') {
	$order = in_array($_GET['ordertype'], array('dateline', 'posttime')) ? $_GET['ordertype'] : 'dateline';
	$count = C::t('discuss_comment')->my_comment($_G['uid'], 1);
	$pageSize = 10;
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$start = ($page - 1) * $pageSize;
	$cmtlist = C::t('discuss_comment')->my_comment($_G['uid'], 0, $start, $pageSize, $order);
	$theurl = MOD_URL.'&op=my&do=mycomments';
	$multi=multi($count, $pageSize, $page, $theurl);
	if ($ismobile) {
		if($page*$pageSize<$count){
			$nextpage=$page+1;
		}
		if ($_GET['ajax']) {
			include template('mobile/mycmt_list');
		} else {
			include template('mobile/comment');
		}
		exit;
	}
} elseif ($do == 'receivedcmt') {
	$order = in_array($_GET['ordertype'], array('dateline', 'posttime')) ? $_GET['ordertype'] : 'dateline';
	$count = C::t('discuss_comment')->received_comment($_G['uid'], 1);
	$pageSize = 10;
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$start = ($page - 1) * $pageSize;
	$cmtlist = C::t('discuss_comment')->received_comment($_G['uid'], 0, $start, $pageSize, $order);
	$theurl = MOD_URL.'&op=my&do=receivedcmt';
	$multi=multi($count, $pageSize, $page, $theurl);
	if ($ismobile) {
		if($page*$pageSize<$count){
			$nextpage=$page+1;
		}
		if ($_GET['ajax']) {
			include template('mobile/recmt_list');
		} else {
			include template('mobile/receivedcmt');
		}
		exit;
	}
} else {
	if ($_GET['showtype']) {
		C::t('discuss_setting')->update('my_forum_showtype_'.$_G['uid'], $_GET['showtype']);
	}
	$perpage = 20;
	$ismoderator=0;
	loadcache('discuss_setting');
	$setting=$_G['cache']['discuss_setting'];
	$mycreate = trim($_GET['type']) == 'mycreate' ? 1 : 0;
	$order = in_array(trim($_GET['order']), array('lastpost', 'dateline', 'heats')) ? trim($_GET['order']) : 'dateline';
	if($_G['adminid']==1){
		$ismoderator=1;
	}elseif($setting['allownewboard']>0){
		$muids=$setting['moderators']?explode(',',$setting['moderators']):array();
		if(in_array($_G['uid'],$muids)) $ismoderator=1;
	}else{
		$ismoderator=1;
	}
	if($ismoderator){
		$setting['newboardsum']=C::t('discuss')->checkMaxBoard($_G['uid']);
	}
	$my_forum_showtype = C::t('discuss_setting')->fetch('my_forum_showtype_'.$_G['uid']);
	$my_forum_showtype = $my_forum_showtype ? $my_forum_showtype : 'module';
	$navtitle='我的讨论版';
	$keyword=trim($_GET['keyword']);
	$count = C::t('discuss')->getMyDiscuss($_G['uid'],$keyword, $mycreate, $order, 0, 1);
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$start = ($page - 1) * $perpage;
	$limit = ' LIMIT '.$start.','.$perpage;
	$list=array();
	$list=C::t('discuss')->getMyDiscuss($_G['uid'],$keyword, $mycreate, $order, 0, 0, $limit);
	$gets = array(
			'mod'=>'discuss',
			'op'=>'my',
			'order'=>$order,
			'type'=>$_GET['type'],
		);
	$theurl = DZZSCRIPT."?".url_implode($gets);
	$multi=multi($count, $perpage, $page, $theurl);
}
if($page*$perpage<$count){
	$nextpage=$page+1;
}
if($ismobile) {
	if ($_GET['ajax']) {
		include template('mobile/discuss_list');
	} else {
		include template('mobile/board');
	}
} else {
	include template('discuss_my');
}
?>
