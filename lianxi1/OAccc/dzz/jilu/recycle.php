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
@session_start();
$ismobile=helper_browser::ismobile();
require_once 'conf.php';
require_once libfile('function/common');
$navtitle=lang('recycle').' - '.lang('record_book');
$publish_type=array('text'=>lang('text'),'image'=>lang('image'),'attach'=>lang('attach'),'link'=>lang('link'),'list'=>lang('list'),'video'=>lang('video'),'voice'=>lang('voice'));
if(!$_G['uid']){
	showmessage(lang('to_login'));
	exit();
}
$ajax = $_GET['ajax'];
if($ajax){
	if($ajax == 'recovery_jilu'){//恢复删除的记录本
		$jid = $_GET['jid'];
		// $perm = C::t('jilu_user')->fetch_perm_by_uid($_G['uid'], $jid);
		$perm = getVPermByUid($jid);
		if($perm < 3){
			exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		}
		if(DB::update('jilu', array('deleteuid' => '', 'deletetime' => '', 'recycledel' => 0), array('jid' => $jid))){
			exit(json_encode(array('code' => 200, 'message' => lang('recovery_success'))));
		} else {
			exit(json_encode(array('code' => 400, 'message' => lang('recovery_failed'))));
		}
	} elseif( $ajax == 'recovery_jilu_item') {//恢复删除的单条记录
		$rid = intval($_GET['rid']);
		$jid = DB::result_first('select jid from %t where rid = %d', array('jilu_item', $rid));
		$perm = getVPermByUid($jid);
		if($perm < 2){
			exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		}
		if(DB::update('jilu_item', array('deleteuid' => '', 'deletetime' => '', 'recycledel' => 0), array('rid' => $rid))){
			exit(json_encode(array('code' => 200, 'message' => lang('recovery_success'))));
		} else {
			exit(json_encode(array('code' => 400, 'message' => lang('recovery_failed'))));
		}
	} elseif ($ajax == 'deletejilu') {//删除记录本回收站（创建者删除【未彻底删除：管理员才能彻底删除（其它接口）】）
		$perm = getPermByUid($_G['uid']);
		$jid = $_GET['jid'];
		$searchsql = 'deletetime > 0';
		$param = array('jilu');
		if ($perm > 1) {
			$searchsql .= ' and jid = %s';
			$param[] = $jid;
		} else {
			$searchsql .= ' and authorid = %d and jid = %s';
			$param[] = $_G['uid'];
			$param[] = $jid;
		}
		if(DB::result_first('select count(*) from %t where '.$searchsql, $param)){
			if($perm > 1){//管理员彻底删除
				$result = C::t('jilu')->delete_by_jid($jid);
			} else {
				$result = DB::update('jilu', array('recycledel' => 1), array('jid' => $jid));
			}
			if($result){
				exit(json_encode(array('code' => 200, 'message' => lang('delete_success'))));
			} else {
				exit(json_encode(array('code' => 400, 'message' => lang('delete_failed'))));
			}
		} else {
			exit(json_encode(array('code' => 400, 'message' => '参数错误')));
		}
	} elseif ($ajax == 'deletejiluItem'){//删除回收站单条记录（创建者删除【未彻底删除：管理员才能彻底删除（其它接口）】）
		$rid = intval($_GET['rid']);
		$searchsql = 'deletetime > 0';
		$param = array('jilu_item');
		$perm = getPermByUid($_G['uid']);
		if ($perm > 1) {
			$searchsql .= ' and rid = %d';
			$param[] = $rid;
		} else {
			$searchsql .= ' and authorid = %d and rid = %d';
			$param[] = $_G['uid'];
			$param[] = $rid;
		}
		if(DB::result_first('select count(*) from %t where '.$searchsql, $param)){
			if($perm > 1){//管理员彻底删除
				$result = C::t('jilu_item')->delete_by_rid($rid);
			} else {
				$result = DB::update('jilu_item', array('recycledel' => 1), array('rid' => $rid));
			}
			if($result){
				exit(json_encode(array('code' => 200, 'message' => lang('delete_success'))));
			} else {
				exit(json_encode(array('code' => 400, 'message' => lang('delete_failed'))));
			}
		} else {
			exit(json_encode(array('code' => 400, 'message' => lang('failed'))));
		}
	} elseif ($ajax == 'empty_trash') {
		$uid = $_G['uid'];
		$perm = getPermByUid($uid);
		$result = array();
		$users = array();
		if ($perm > 1) {//管理员彻底清空回收站
			//需彻底删除的所有记录本ID
			$jids = array_keys(DB::fetch_all('select jid from %t where deletetime > 0', array('jilu'), 'jid'));
			foreach ($jids as $v) {
				if(C::t('jilu')->delete_by_jid($v)){
					$result['jids'][] = $v;
				}
			}
			//已删除的所有单条记录ID
			$rids = array_keys(DB::fetch_all('select rid from %t where deletetime > 0', array('jilu_item'), 'rid'));
			foreach ($rids as $v) {
				if(C::t('jilu_item')->delete_by_rid($v)){
					$result['rids'][] = $v;
				}
			}
		} else {//普通用户清空回收站(未彻底删除)
			$jids = array_keys(DB::fetch_all('select jid from %t where deletetime > 0 and authorid = %d', array('jilu', $uid), 'jid'));
			foreach ($jids as $v) {
				if(DB::update('jilu',array('recycledel' => 1), array('jid' => $v))){
					$result['jids'][] = $v;
				}
			}
			$rids = array_keys(DB::fetch_all('select rid from %t where deletetime > 0 and authorid = %d', array('jilu_item', $uid), 'rid'));
			foreach ($rids as $v) {
				if(DB::update('jilu_item',array('recycledel' => 1), array('rid' => $v))){
					$result['rids'][] = $v;
				}
			}

		}
		exit(json_encode(array('code' => 200, 'message' => lang('clear_recycle_success'), 'data' => $result)));
	} elseif ($ajax == 'getuser') { 
		$name = $_GET['name'];
		$orgid = DB::result_first('select orgid from %t where orgname = %s',array('organization', $name));
		if($orgid){
			$uids = C::t('organization_user')->fetch_user_by_orgid($orgid);
			if($uids){
				foreach ($uids as $v) {
					$users[$v['uid']] = $name.'-'.$v['username'];
				}
			}	
		} else {
			$param = array('user');
			if ($name) {
				$searchsql = ' username like %s';
				$param[] = '%'.$name.'%';
				$param[] = '%'.$name.'%';
				$uids = DB::fetch_all('select uid,username from %t where'.$searchsql.' limit 5', $param, 'uid');
			}
			// else {
			// 	$uids = DB::fetch_all('select uid,username from %t limit 5', $param, 'uid');
			// }
			foreach ($uids as $k => $v) {
				$orgids = C::t('organization_user')->fetch_orgids_by_uid($k);
				$orgnames = array();
				if($orgids){
					$orgnames = array();
					foreach(DB::fetch_all('select orgname from %t where orgid IN (%n)', array('organization', $orgids)) as $vv) {
						$orgnames[] = $vv['orgname'];
					} 
				}
				$userstr = $orgnames ? implode($orgnames, '-').'-'.$uids[$k]['username'] : $uids[$k]['username'];
				$users[] = array('uid' => $k, 'name' => $userstr); 
			}
		}
		exit(json_encode($users));
	} elseif ($ajax == 'getjilus') {
		$title = $_GET['title'];
		$param = array('jilu');
		$perm = getPermByUid($_G['uid']);
		if(empty($title)){
			exit(json_encode(array()));
		}
		$searchsql = 'deletetime > 0 and title like %s';
		$param[] = '%'.$title.'%';
		if($perm < 2){
			$searchsql .= ' and authorid = %d and recycledel <= 0';
			$param[] = $_G['uid'];
		}
		$jilus = DB::fetch_all('select jid,title from %t where '.$searchsql.' limit 5', $param);
		exit(json_encode($jilus));
	}
} else {
	if($_GET['do'] == 'loadmore'){
		$urlparm = array();
		$pageSize = 10;
		$next = false;
		$keyword = $_GET['keyword'];
		//日期筛选
		if(isset($_GET['after']) && $_GET['after']){
		    $afterdate = strtotime($_GET['after']);
		    $date[0] = $afterdate;
		    $urlparm['after'] = $_GET['after'];
		}
		if(isset($_GET['before']) && $_GET['before']){
		    $beforedate = strtotime($_GET['before']);
		    $date[1] = $beforedate;
		    $urlparm['before'] = $_GET['before'];
		}
		if($_GET['uids']){
			$_GET['uids']=is_array($_GET['uids']) ? $_GET['uids'] : explode(',',$_GET['uids']);
			$uids=array();
			foreach($_GET['uids'] as  $uid){
				if(intval($uid)){
					$uids[]=intval($uid);
				}
			}
			$urlparm['uids'] = $_GET['uids'];
		}
		//处理jids
		if($_GET['jids']){
			$_GET['jids']=is_array($_GET['jids']) ? $_GET['jids'] : explode(',',$_GET['jids']);
			$jids=array();
			foreach($_GET['jids'] as  $val){
				if(!empty($val)){
					if($val=='none') $val='';
					$jids[]=($val);
				}
			}
			$urlparm['jids'] = $_GET['jids'];
		}
		$type = $_GET['type'];
		if($type == 'jilu'){
			$count = C::t('jilu')->getDelJilu($limit,$keyword,true,$date,$uids,$jids);
			$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
			if($page * $pageSize > $count) $page = ceil($count / $pageSize) ? ceil($count / $pageSize) : 1;
			$start = ($page - 1) * $pageSize;
			$nextStart = $start + $pageSize;
			$limit = $start.'-'.$pageSize;
			$jilus = C::t('jilu')->getDelJilu($limit,$keyword,false,$date,$uids,$jids);
			$multi = multi($count, $pageSize, $page, MOD_URL.'&op=recycle&type=jilu');
		} elseif($type == 'jiluItem'){
			$itemCount = C::t('jilu_item')->getDelJiluItem($limit,$keyword,true,$date,$uids,$jids);
			$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
			if($page * $pageSize > $itemCount) $page = ceil(($count + $itemCount) / $pageSize) ? ceil(($count + $itemCount) / $pageSize) : 1;
			$start = ($page - 1) * $pageSize;
			$nextStart = $start + $pageSize;
			$limit = $start.'-'.$pageSize;
			$items = C::t('jilu_item')->getDelJiluItem($limit,$keyword,false,$date,$uids,$jids);
			$multi = multi($itemCount, $pageSize, $page, MOD_URL.'&op=recycle&type=jilu&type=jiluItem');
		} else {
			$count = intval(C::t('jilu')->getDelJilu($limit,$keyword,true,$date,$uids,$jids));
			$itemCount = intval(C::t('jilu_item')->getDelJiluItem($limit,$keyword,true,$date,$uids,$jids));
			$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
			if($page * $pageSize > ($count + $itemCount)) $page = ceil(($count + $itemCount) / $pageSize) ? ceil(($count + $itemCount) / $pageSize) : 1;
			$start = ($page - 1) * $pageSize;
			$nextStart = $start + $pageSize;
			$limit = $start.'-'.$pageSize;
			if($count > $start){
				$jilus = C::t('jilu')->getDelJilu($limit,$keyword,false,$date,$uids,$jids);
			}
			if($count < $nextStart){//取得删除的事件
				if((!empty($jilus) && count($jilus) < $pageSize) || (empty($jilus) && $count == ($nextStart - $pageSize))){
					$limit = '0-'.($nextStart - $count);
				}else{
					$limit = ($start - $count).'-'.$pageSize;
				}
				$items = C::t('jilu_item')->getDelJiluItem($limit,$keyword,false,$date,$uids,$jids);
			}
			if($nextStart < $count + $itemCount) $next = true;
		}
		
		//调用jssdk
		if($ismobile=='wechat'){
			if($setting['AppID'] && $setting['AppSecret']){
				$jssdk=new JSSDK($setting['AppID'],$setting['AppSecret'],0);
				$SignPackage=$jssdk->getSignPackage();
			}elseif(getglobal('setting/CorpID') && getglobal('setting/CorpSecret')){
				$jssdk=new JSSDK(getglobal('setting/CorpID'),getglobal('setting/CorpSecret'));
				$SignPackage=$jssdk->getSignPackage();
			}
		}
		$gets = array(
						'mod'=>MOD_NAME,
						'op'=>'recycle',
						'uids'=>$uids?implode(',',$uids):'',
						'jids'=>$jids?implode(',',$jids):'',
						'keyword'=>$_GET['keyword'],
						'after'=>$_GET['after'],
						'before'=>$_GET['before'],
						'page'=>$page+1,
						'do'=>'loadmore',
						'type'=>$type,
					);
		$theurl = DZZSCRIPT."?".url_implode($gets);
		include template('trash_item');
	}else{
		include template('trash');
	}
}

?>
