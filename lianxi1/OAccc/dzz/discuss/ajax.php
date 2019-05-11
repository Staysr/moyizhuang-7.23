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
$ismobile=helper_browser::ismobile();
require_once libfile('function/discuss');

if($_GET['do']=='uploadimg'){
    include libfile('class/uploadhandler');
    $options=array( 'accept_file_types' => '/\.(gif|jpe?g|jpg|png)$/i',
        'upload_dir' =>$_G['setting']['attachdir'].'cache/',
        'upload_url' => $_G['setting']['attachurl'].'cache/',
        'thumbnail'=>array('max-width'=>240,'max-height'=>160)
    );
    $upload_handler = new uploadhandler($options);
    exit();
} elseif($_GET['do']=='favorite'){
	if(empty($_G['uid'])) {
		exit(json_encode(array('error'=>lang('need_login'))));
	}
	$id=intval($_GET['id']);
	$fav=array('id'=>intval($_GET['id']),
				'idtype'=>trim($_GET['idtype']),
				'uid'=>$_G['uid'],
				'dateline'=>TIMESTAMP
				);
	$favorite = C::t('discuss_favorite')->fetch_by_id_idtype($fav['id'],$fav['idtype'],$fav['uid']);
	if($favorite){
		$favid = $favorite['favid'];
		if(C::t('discuss_favorite')->delete_by_favid($favid)){
			exit(json_encode(array('code' => 200, 'status' => 0, 'msg'=>lang('cancle_favorite_success'))));
		}else{
			exit(json_encode(array('code' => 400, 'msg'=>lang('cancle_favorite_failed'))));
		}
	}else{
		C::t('discuss_favorite')->insert($fav);
		if($fav['idtype']=='forum'){
			C::t('discuss')->update_forum_counter($fav['id'], 0, 0, 0, 1);
		}elseif($fav['idtype']=='thread'){
			C::t('discuss_thread')->increase($fav['id'],array('favtimes'=>1,'heats'=>5));
		}
		exit(json_encode(array('msg'=>lang('favorite_success'), 'status' => 1)));
	}
}elseif($_GET['do']=='deletefavorite'){
	$favid=intval($_GET['favid']);
	if(C::t('discuss_favorite')->delete_by_favid($favid)){
		exit(json_encode(array('code' => 200, 'message'=>lang('cancle_favorite_success'))));
	}else{
		exit(json_encode(array('code' => 400, 'message'=>lang('cancle_favorite_failed'))));
	}
} elseif($_GET['do'] == 'getthreadclass') {
	$fid = intval($_GET['fid']);
	$class = array();
	if($fid) {
		$discuss = C::t('discuss')->fetch_by_fid($fid);
		$field = C::t('discuss_field')->fetch($fid);
		if(!empty($field['threadtypes'])) {
			$perm = C::t('discuss_user')->fetch_perm_by_uid($_G['uid'], $fid);
			foreach(C::t('discuss_threadclass')->fetch_all_by_fid($fid,1) as $tc) {
				if ($tc['moderators'] > 0) {
					if ($perm > 2) $class[$tc['typeid']] = $tc;
				} else {
					$class[$tc['typeid']] = $tc;
				}
			}
		}
	}
	exit(json_encode(array('code' => 200, 'data' => $class)));
} elseif($_GET['do'] == 'forumchecknew' && !empty($_GET['fid']) && !empty($_GET['time'])) {
	
	$fid = intval($_GET['fid']);
	$time = intval($_GET['time']);

	if(!$_GET['uncheck']) {
		$foruminfo = C::t('discuss')->fetch($fid);
		$lastpost_str = $foruminfo['lastpost'];
		if($lastpost_str) {
			$lastpost = explode("\t", $lastpost_str);
			unset($lastpost_str);
		}
		include template('common/header_ajax');
		echo $lastpost['2'] > $time ? 1 : 0 ;
		include template('common/footer_ajax');
	} else {
		
		$fromindex=$_GET['fromindex'];
		$discuss = C::t('discuss')->fetch_by_fid($fid,$_G['uid']);
		//$forum_field['threadtypes'] = dunserialize($query['threadtypes']);
		$todaytime = strtotime(dgmdate(TIMESTAMP, 'Ymd'));
		foreach(C::t('discuss_thread')->fetch_all_by_fid_lastpost($fid, $time, TIMESTAMP) as $thread) {
			$threadlist[] = formatThreadData($thread);
		}
		if($threadlist) {
			krsort($threadlist);
		}
		include template('ajax');
	}
	exit;
} elseif($_GET['do'] == 'delete') {//删除进回收站
	$position = $_GET['position'];
	$uid = $_G['uid'];
	if (!$uid) exit(json_encode(array('code' => 400, 'message' => lang('need_login'))));
	if ($position == 'field') {
		$fid = intval($_GET['fid']);
		$field = C::t('discuss')->fetch_by_fid($fid);
		$perm = C::t('discuss_user')->fetch_perm_by_uid($uid, $fid);
		if ($perm < 3 && $field['uid'] != $uid && !$_G['adminid']) exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		if ($field) {
			$setarr = array(
						'fid' => $fid,
						'type' => 'field',
						'id' => $fid, 
						'authorid' => intval($field['uid']),
						'deleteuid' => $uid,
						'deletetime' => TIMESTAMP

					);
			if (C::t('discuss_recycle')->insert($setarr)) {
				C::t('discuss')->update_by_fid($fid, array('isdelete' => 1, 'deletetime' => TIMESTAMP, 'deleteuid' => $uid));
				//通知所有版主
				$uids= C::t('discuss_user')->fetch_uids_by_fid($fid,3);
				$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
				foreach($uids as $uid){
					if($uid!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=discuss&op=recyclebin',
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'discussname'=>getstr($field['name'],30),
										
										);
						
							$action='discuss_delete';
							$type='discuss_delete_'.$fid;
						
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
					}
				}
				exit(json_encode(array('code' => 200, 'message' => lang('delete_success'))));
			}
		} else {
			exit(json_encode(array('code' => 400, 'message' => lang('discuss_no_exist'))));
		}
	}

} elseif($_GET['do'] == 'thgdel') {//彻底删除
	$rid = $_GET['rid'];
	$uid = $_G['uid'];
	$recycle = C::t('discuss_recycle')->fetch($rid);
	if ($recycle['type'] == 'thread') {
		$tid = $recycle['id'];
		$thread = C::t('discuss_thread')->fetch($tid);
		$perm = C::t('discuss_user')->fetch_perm_by_uid($uid, $thread['fid']);
		if ($perm < 3 && $recycle['authorid'] != $uid && !$_G['adminid']) exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		if (C::t('discuss_recycle')->thgdel('thread', $tid)) {
			
			deletethread(array($tid));
		}
	} elseif ($recycle['type'] == 'field') {
		$fid = $recycle['fid'];
		$perm = C::t('discuss_user')->fetch_perm_by_uid($uid, $fid);
		if ($perm < 3 && $recycle['authorid'] != $uid && !$_G['adminid']) exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		C::t('discuss_recycle')->thgdel('field', $fid);
	}
	exit(json_encode(array('code' => 200, 'message' => lang('thg_delete_success'))));
} elseif($_GET['do'] == 'thgdelall') {//清空回收站
	if (C::t('discuss_recycle')->thgdelall()) {
		exit(json_encode(array('code' => 200, 'message' => lang('empty_delete_success'))));
	} else {
		exit(json_encode(array('code' => 400, 'message' => lang('empty_delete_failed'))));
	}
} elseif($_GET['do'] == 'recovery') {//回收站恢复
	$rid = $_GET['rid'];
	$uid = $_G['uid'];
	$recycle = C::t('discuss_recycle')->fetch($rid);
	if ($recycle['type'] == 'thread') {
		$tid = $recycle['id'];
		$thread = C::t('discuss_thread')->fetch($tid);
		$perm = C::t('discuss_user')->fetch_perm_by_uid($uid, $thread['fid']);
		if ($perm < 3 && $recycle['authorid'] != $uid && !$_G['adminid']) exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		if (C::t('discuss_recycle')->delete('thread', $tid)) {
			
			updateforumcount($recycle['fid']);
		}
	} elseif ($recycle['type'] == 'field') {
		$fid = $recycle['fid'];
		$perm = C::t('discuss_user')->fetch_perm_by_uid($uid, $fid);
		if ($perm < 3 && $recycle['authorid'] != $uid && !$_G['adminid']) exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		C::t('discuss_recycle')->delete('field', $fid);
	}
	exit(json_encode(array('code' => 200, 'message' => lang('recovery_success'))));
} elseif ($_GET['do'] == 'comment') {
	
	$position = $_GET['position'];
	if ($position == 'addcmt') {
		$tid = intval($_GET['tid']);
		$thread = C::t('discuss_thread')->fetch($tid);
		if ($thread['inarchive']) {
			exit(json_encode(array('code' => 400, 'message' => lang('discuss_archived_no_cmt'))));
		}
		$discuss = C::t('discuss')->fetch($fid);
		if ($discuss['inarchive']) {
			exit(json_encode(array('code' => 400, 'message' => lang('thread_archived_no_cmt'))));
		}
		$pid = intval($_GET['pid']);
		$pcid = intval($_GET['pcid']) ? intval($_GET['pcid']) : 0;
		$pcmt = C::t('discuss_comment')->fetch($pcid);
		$post = C::t('discuss_post')->fetch('tid:'.$tid, $pid);
		$perm = C::t('discuss_user')->fetch_perm_by_uid($_G['uid'], $post['fid']);
		if ($perm < 1) exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		if (!$post || ($pcid && !$pcmt)) exit(json_encode(array('code' => 400, 'message' => lang('sub_paramet_error'))));
		if (submitcheck('addcmt')) {
			$content = censor(emoji_encode($_GET['content']));
			//处理@
			$at_users=array();
			$content=preg_replace_callback("/@\[(.+?):(.+?)\]/i","atreplacement",$content);
			if (empty($content)) {
				exit(json_encode(array('code' => 400, 'message' => lang('please_input_cmt'))));
			}
			$setarr = array(
							'pcid'	=> $pcid,
							'reuid'	=> $pcmt[$pcid]['uid'] ? $pcmt[$pcid]['uid'] : 0,
							'fid'	=> $post['fid'],
							'tid'	=> $post['tid'],
							'pid'	=> $post['pid'],
							'pauthorid' => $post['authorid'],
							'content'	=> $content,
							'uid'		=> $_G['uid'],
							'time'		=> TIMESTAMP
						);
			if ($cid = C::t('discuss_comment')->insert($setarr, true)) {
				$reauthor = C::t('user')->get_user_by_uid($setarr['reuid']);
				$setarr['reauthor'] = $reauthor['username'];
				$setarr['author'] = $_G['username'];
				C::t('discuss_post')->update('tid:'.$tid, $pid, array('lastcmttime' => TIMESTAMP));

				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
				//发送通知
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>MOD_URL.'&op=redirect&fid='.$setarr['fid'].'&pid='.$setarr['pid'].'&ptid='.$setarr['tid'],
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'message'=>getstr($content,30),
								);
				//处理@
				if($at_users){
					//发送通知
					$notevars['message'] = stripsAT($message);
					foreach($at_users as $k => $value){
						if($value==$_G['uid']) continue;
						dzz_notification::notification_add($value, 'discuss_at', 'discuss_at', $notevars, 0, MOD_PATH);
					}
				}

				//消息提醒
				if ($pcid) {//提醒评论的被回复者
					
					$action='discuss_cmt_reply';
					$type='discuss_cmt_reply_'.$setarr['tid'];
					
					dzz_notification::notification_add($setarr['reuid'], $type, $action, $notevars, 0, MOD_PATH);
				} else {//提醒帖子的作者
					if ($_G['uid'] != $setarr['pauthorid']) {
						$action='discuss_cmt';
						$type='discuss_cmt_'.$setarr['tid'];
						
						dzz_notification::notification_add($setarr['pauthorid'], $type, $action, $notevars, 0, MOD_PATH);
					}
				}


				exit(json_encode(array('code' => 200, 'message' => lang('comment_success'), 'cid' => $cid, 'data' => $setarr)));
			} else {
				exit(json_encode(array('code' => 400, 'message' => lang('comment_failed'))));
			}
		} else {
			exit(json_encode(array('code' => 400, 'message' => lang('sub_proving_failed'))));
		}
	} elseif($position == 'deletecmt') {
		$cid = intval($_GET['cid']);
		$cmt = C::t('discuss_comment')->fetch($cid, 1);
		$tid = $cmt['tid'];
		$thread=C::t('discuss_thread')->fetch($tid);
		if ($thread['inarchive']) {
			exit(json_encode(array('code' => 400, 'message' => lang('thread_archived_no_del_cmt'))));
		}
		$discuss = C::t('discuss')->fetch($fid);
		if ($discuss['inarchive']) {
			exit(json_encode(array('code' => 400, 'message' => lang('discuss_archived_no_del_cmt'))));
		}
		$pid = $cmt['pid'];
		$post = C::t('discuss_post')->fetch('tid:'.$tid, $pid);
		$perm = C::t('discuss_user')->fetch_perm_by_uid($_G['uid'], $post['fid']);
		if(!$thread){
			exit(json_encode(array('code' => 400, 'message' => lang('thread_no_exist'))));
		}
		if ($perm > 2 || $post['authorid'] == $_G['uid'] || $cmt['uid'] == $_G['uid']) {
			if (C::t('discuss_comment')->delete_cmt($cid)) {
				exit(json_encode(array('code' => 200, 'message' => lang('delete_cmt_success'))));
			} else {
				exit(json_encode(array('code' => 400, 'message' => lang('delete_cmt_failed'))));
			}
		} else {
			exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		}
	} elseif($position == 'getcmt') {
		include_once libfile('function/code');
		$cid = $_GET['cid'];
		$cmt = C::t('discuss_comment')->fetch($cid);
		$cmt[$cid]['content'] = emoji_decode(dzzcode($cmt[$cid]['content']));
		if ($ismobile) {
			include template("mobile/ajax");
			exit;
		}
	} elseif($position == 'getreplys') {
		$perm = C::t('discuss_user')->fetch_perm_by_uid($_G['uid'], $_GET['fid']);
		$thread = C::t('discuss_thread')->fetch($_GET['tid']);
		$cid = $_GET['cid'];
		$start = $_GET['start'] ? intval($_GET['start']) : 5;
		$count = C::t('discuss_comment')->get_reply_by_cid($cid, $start, 1);
		if ($count >= $start+5) {
			$next = $start + 5;
		}
		$replys = C::t('discuss_comment')->get_reply_by_cid($cid, $start);
	} elseif ($position == 'getmorecmt') {
		$perm = C::t('discuss_user')->fetch_perm_by_uid($_G['uid'], $_GET['fid']);
		$thread = C::t('discuss_thread')->fetch($_GET['tid']);
		$pid = $_GET['pid'];
		$start = $_GET['start'] ? intval($_GET['start']) : 5;
		$count = C::t('discuss_comment')->get_cmt_by_pid($cid, 0, 1);
		if ($count >= $start+5) {
			$next = $start + 5;
		}
		$cmts = C::t('discuss_comment')->get_cmt_by_pid($pid, $start);
		if ($ismobile) {
			include template('mobile/ajax');
			exit;
		}
	}
} elseif ($_GET['do'] == 'showwindow') {
	$position = $_GET['position'];
	$reasons = explode(',', C::t('discuss_setting')->fetch('modreasons'));
	if ($position == 'settop') {
		$setting=C::t('discuss_setting')->fetch_all(array('topperm'));
		$topperm = unserialize($setting['topperm']);
	} elseif ($position == 'settype') {
		$fid = $_GET['fid'];
		$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']);
		$threadtypes = array('available' => $discuss['threadtypes']['available'], 'types' => array());
		if ($discuss['threadtypes']['available']) {
			$types = C::t('discuss_threadclass')->fetch_all_by_fid($discuss['fid']);
			foreach ($types as $k => $v) {
				if ($discuss['perm'] > 2) {
					if ($v['enable'] || $v['moderators']) {
						$threadtypes['types'][$v['typeid']] = $v['name'];
					}
				} else {
					if ($v['enable']) {
						$threadtypes['types'][$v['typeid']] = $v['name'];
					}
				}
			}
		}
	}
} elseif ($_GET['do'] == 'viewthreadmore') {
	$tid = $_GET['tid'];
	$thread = C::t('discuss_thread')->fetch($tid);
} elseif ($_GET['do'] == 'share') {
	$type = $_GET['type'];
	$discuss = C::t('discuss')->fetch_info_by_fid($_GET['fid']);
	if ($type == 'thread') {
		$url = $_G['siteurl'].MOD_URL.'&op=viewthread&fid='.$_GET['fid'].'&tid='.$_GET['tid'];
		$target='./qrcode/thread/'.$_GET['tid'].'.png';
		if(is_file($_G['setting']['attachdir'].$target)) $qrcode=$_G['setting']['attachurl'].$target;
		else{
			$qrcode=C::t('discuss_thread')->getQRcodeBytid($_GET['tid']);
		}
	} else {
		$url = $_G['siteurl'].MOD_URL.'&op=list&fid='.$_GET['fid'];
		$target='./qrcode/discuss/'.$_GET['fid'].'.png';
		if(is_file($_G['setting']['attachdir'].$target)) $qrcode=$_G['setting']['attachurl'].$target;
		else{
			$qrcode=C::t('discuss')->getQRcodeByfid($_GET['fid']);
		}
	}
	if($ismobile) exit(json_encode(array('code' => 200, 'data' => array('url' => $url, 'qrcode' => $qrcode))));
} elseif ($_GET['do'] == 'archivethread') {
	$tid = $_GET['tid'];
	$thread = C::t('discuss_thread')->fetch($tid);
	$discuss = C::t('discuss')->fetch_by_fid($thread['fid'],$_G['uid']);
	if ($discuss['perm'] < 3) {
		exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
	}
	if ($discuss['inarchive']) {
		exit(json_encode(array('code' => 400, 'message' => lang('discuss_archived_cannot_do'))));
	}
	$setarr = array('inarchive' => 1, 'archivetime' => TIMESTAMP);
	if (C::t('discuss_thread')->update($tid, $setarr)) {
		
		updateforumcount($thread['fid']);
		//通知所有版主
		$uids= C::t('discuss_user')->fetch_uids_by_fid($thread['fid'],3);
		$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
		foreach($uids as $uid){
			if($uid!=getglobal('uid')){
				//发送通知
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>MOD_URL.'&op=viewthread&fid='.$thread['fid'].'&tid='.$tid,
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'threadname'=>getstr($thread['subject'],30),
								
								);
				
					$action='thread_archive';
					$type='thread_archive_'.$fid;
				
				dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
			}
		}
		exit(json_encode(array('code' => 200, 'message' => lang('archived_success'))));
	} else {
		exit(json_encode(array('code' => 200, 'message' => lang('archived_failed'))));
	}
} elseif ($_GET['do'] == 'canclearchive') {//取消主题归档
	$tid = $_GET['tid'];
	$thread = C::t('discuss_thread')->fetch($tid);
	$discuss = C::t('discuss')->fetch_by_fid($thread['fid'],$_G['uid']);
	if ($discuss['perm'] < 3) {
		exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
	}
	$setarr = array('inarchive' => 0, 'archivetime' => 0);
	if (C::t('discuss_thread')->update($tid, $setarr)) {
		
		updateforumcount($thread['fid']);
		//通知所有版主
		$uids= C::t('discuss_user')->fetch_uids_by_fid($thread['fid'],3);
		$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
		foreach($uids as $uid){
			if($uid!=getglobal('uid')){
				//发送通知
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>MOD_URL.'&op=viewthread&fid='.$thread['fid'].'&tid='.$tid,
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'threadname'=>getstr($thread['subject'],30),
								
								);
				
					$action='thread_restore';
					$type='thread_restore_'.$fid;
				
				dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
			}
		}
		exit(json_encode(array('code' => 200, 'message' => lang('cancle_archive_success'))));
	} else {
		exit(json_encode(array('code' => 200, 'message' => lang('cancle_archive_failed'))));
	}
} elseif ($_GET['do'] == 'clndisarh') {//取消讨论版归档
	$fid = $_GET['fid'];
	$discuss = C::t('discuss')->fetch_by_fid($fid, $_G['uid']);
	if ($discuss['perm'] < 3) {
		exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
	}
	$setarr = array('inarchive' => 0, 'archivetime' => 0);
	if (C::t('discuss')->update($fid, $setarr)) {
		
		updateforumcount($fid);
		//通知所有版主
		$uids= C::t('discuss_user')->fetch_uids_by_fid($fid,3);
		$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
		foreach($uids as $uid){
			if($uid!=getglobal('uid')){
				//发送通知
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>MOD_URL.'&op=list&fid='.$fid,
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'discussname'=>getstr($discuss['name'],30),
								
								);
				
					$action='discuss_restore';
					$type='discuss_restore_'.$fid;
				
				dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
			}
		}
		exit(json_encode(array('code' => 200, 'message' => lang('cancle_archive_success'))));
	} else {
		exit(json_encode(array('code' => 200, 'message' => lang('cancle_archive_failed'))));
	}
} elseif($_GET['do']=='getAtList') {
	$fid=trim($_GET['fid']);
	$keyword = trim($_GET['keyword']);
	$list=array();
	if($fid){
		 $param_user=array('discuss_user','user');
		 $sql_user="where f.fid=%d";
		 $param_user[]=$fid;
		 if($keyword){
		 	$sql_user .= ' and u.username like %s';
		 	$param_user[] = '%'.$keyword.'%';
		 }
		  foreach(DB::fetch_all("select u.uid,u.username  from %t f LEFT JOIN %t u on u.uid=f.uid  $sql_user",$param_user) as $value){
			if($value['uid'] == $_G['uid']) continue;
			$list[]=array('name'=>$value['username'],
						   'searchkey'=> pinyin::encode($value['username'], 'all').$value['username'],
						   'id'=>'u'.$value['uid'],
						   'uid'=>$value['uid'],
						   'icon'=>'avatar.php?uid='.$value['uid'].'&size=small',
						   'title'=>$value['username'].':'.'u'.$value['uid'],
						   'avatar'=>avatar_block($value['uid'])
						);
		  }
	}
	exit(json_encode($list));
} elseif ($_GET['do'] == 'getdislist') {
	$list = C::t('discuss')->getMyDiscuss($_G['uid'], '', 0, 'dateline', 'all');
	$return = array();
	foreach ($list as $k => $v) {
		$return[] = array('fid' => $k, 'title' => $v['name']);
	}
	exit(json_encode(array($return)));
} elseif ($_GET['do'] == 'disrename') {
	$fid = intval($_GET['fid']);
	$name = censor(trim($_GET['name']));
	$perm = C::t('discuss_user')->fetch_perm_by_uid($_G['uid'], $fid);
	if ($perm < 3) {
		exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
	}
	if (C::t('discuss')->update_by_fid($fid, array('name' => $name))) {
		exit(json_encode(array('code' => 200, 'name' => $name, 'message' => lang('rename_success'))));
	} else {
		exit(json_encode(array('code' => 400, 'message' => lang('rename_failed'))));
	}
}
if ($ismobile) {
	include template('mobile/ajax');
} else {
	include template('ajax');
}
?>
