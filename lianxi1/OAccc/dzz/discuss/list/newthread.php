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
//error_reporting(E_ALL);
if(empty($_G['uid'])) {
	//判断游客,弹出登录框
	Hook::listen('check_login');
	exit();
}
if ($discuss['inarchive']) {
	showmessage(lang('discuss_archived_cannot_do'), dreferer());
}
if ($fid) {
	if ($discuss['perm'] < 2) showmessage(lang('no_privilege'), dreferer());
}
$extra=rawurlencode(rawurldecode($_GET['extra']));
$forward=rawurlencode(rawurldecode($_GET['forward']));
if(submitcheck('edit')){
	$anonymous=intval($_GET['anonymous']);
	$ac=empty($_GET['ac'])?'newthread':trim($_GET['ac']);
	$fid=intval($_GET['fid']);
	$tid=intval($_GET['tid']);
	$subject=empty($_GET['subject'])?'':str_replace('...','',getstr($_GET['subject'],80));
	$subject = emoji_encode($subject);
	$pid=intval($_GET['pid']);
	$first=intval($_GET['first']);
	$message=helper_security::checkhtml($_GET['message']); //去除换行
	$message = emoji_encode($message);
	if (!$message) {
		showmessage(lang('input_message'), dreferer());
	}
	//获取文档内附件
	$attachs=getAidsByMessage($message);
	$ats=getAtsByMessage($message);
	$attachment=getAttachmentByMessage($message);
	$thread=array(
				  'subject'=>$subject,
				  'typeid'=>intval($_GET['typeid']),
				  'tid'=>intval($_GET['tid']),
				  'fid'=>$fid,
				  'attachment'=>$attachment
				  );
	if ($tid) {
		$thr=C::t('discuss_thread')->fetch($tid);
		if ($thr['inarchive']) showmessage(lang('thread_archived_cannot_do'), dreferer());
	}
	if (($ac == 'newthread' && !$discuss['fpostperm']) || ($ac != 'newthread' && !$discuss['freplyperm'] && $thr['authorid'] != $_G['uid'])) showmessage(lang('no_privilege'), dreferer());
	if($first){//是主题时
		if($tid){
			C::t('discuss_thread')->update($tid, $thread);
		}else{
			$thread['authorid'] =  ($anonymous>1)?0: getglobal('uid');
			$thread['author'] =  ($anonymous>1)?lang('anonymous'):getglobal('username');
			$thread['anonymous'] = $anonymous;
			$thread['dateline'] =  getglobal('timestamp');
			$thread['lastpost'] =  getglobal('timestamp');
			$thread['lastposter'] = ($anonymous>1)?lang('anonymous'):getglobal('username');
			$thread['source']=$ismobile ? $ismobile : 'PC';
			$tid=C::t('discuss_thread')->insert($thread,1);
			$lastpost = $thread['tid']."\t".$thread['subject']."\t".getglobal('timestamp')."\t".$thread['author'];
			C::t('discuss')->update($fid, array('lastpost' => $lastpost, 'lastposttime' => getglobal('timestamp'), 'lastthreadtime' => getglobal('timestamp')));
			C::t('discuss')->update_forum_counter($fid, 1, 1, 1);
			C::t('discuss_userinfo')->update_counter($_G['uid'], 1, 1, 7);
		}
		if($pid){
			$postdata=array(
				'subject' => $subject,
				'message' => $message,
				'attachment' => $attachment,
			);
			$pid=C::t('discuss_post')->update('tid:'.$tid,$pid,$postdata);
		}else{
			$postdata=array(
				'fid' => $fid,
				'tid' => $tid,
				'first' => '1',
				'author' => ($anonymous>1)?lang('anonymous'):$_G['username'],
				'authorid' => ($anonymous>1)?0:$_G['uid'],
				'subject' => $subject,
				'dateline' => getglobal('timestamp'),
				'message' => $message,
				'useip' =>  getglobal('clientip'),
				'port' =>getglobal('remoteport'),
				'invisible' => 0,
				'anonymous' => $anonymous,
				'usesig' =>0,
				'attachment' => $attachment,
				'status' => 0,
				'source'=>$ismobile ? $ismobile : 'PC',
			);
			$pid=insertpost($postdata);
		}
		if($pid){
			//插入附件
			 C::t('discuss_post_attach')->insert_by_tid_pid($tid,$pid,$attachs,$fid,($anonymous>1)?0:$_G['uid']);
			//插入@
			$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
			if($uids=C::t('discuss_post_at')->insert_by_pid($pid,$tid,$fid,$ats)){
				//发送@通知
			   foreach(DB::fetch_all("select * from %t where uid in(%n)",array('user',$uids)) as $value){
				  
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>DZZSCRIPT.'?mod=discuss&op=viewthread&fid='.$fid.'&tid='.$tid,
									'author'=>$_G['username'],
									'authorid'=>$_G['uid'],
									'message'=>getstr($message,300,0,0,0,-1),
									'dataline'=>dgmdate(TIMESTAMP)
									);
					dzz_notification::notification_add($value['uid'], 'discuss_at', 'discuss_at', $notevars, 0);
			   }
			}
		}
	}else{
		
		if($pid){
			$postdata=array(
				'subject' => $subject,
				'message' => $message,
				'attachment' =>$attachment,
			);
			C::t('discuss_post')->update('tid:'.$tid,$pid,$postdata);
		}else{
			$postdata=array(
				'fid' => $fid,
				'tid' => $tid,
				'first' => '0',
				'author' => ($anonymous>1)?lang('anonymous'):$_G['username'],
				'authorid' => ($anonymous>1)?0:$_G['uid'],
				'subject' => $subject,
				'dateline' => getglobal('timestamp'),
				'message' => $message,
				'useip' =>  getglobal('clientip'),
				'port' =>getglobal('remoteport'),
				'invisible' => 0,
				'anonymous' => $anonymous,
				'usesig' => 0,
				'attachment' => $attachment,
				'status' => 0,
				'source'=>$ismobile ? $ismobile : 'PC',
			);
			if($pid=insertpost($postdata)){
				//更新主题统计
				$thread=$thr;
				$fieldarr = array(
					'lastposter' => array($_G['uid']),
					'replies' => 1,
					'heats'=>2, //回复heats+2;
				);
				if($thread['lastpost'] < getglobal('timestamp')) {
					$fieldarr['lastpost'] = array(getglobal('timestamp'));
				}
				$row = C::t('discuss_threadaddviews')->fetch($tid);
				if(!empty($row)) {
					C::t('discuss_threadaddviews')->update($tid, array('addviews' => 0));
					$fieldarr['views'] = $row['addviews']; 
				}
				 C::t('discuss_thread')->increase($tid, $fieldarr);
				//更新讨论版统计
				$lastpost = $thread['tid']."\t".$thread['subject']."\t".getglobal('timestamp')."\t".($anonymous?lang('anonymous'):$thread['author']);
				C::t('discuss')->update($fid, array('lastpost' => $lastpost, 'lastposttime' => getglobal('timestamp')));
				C::t('discuss')->update_forum_counter($fid, 0, 1, 1);
				C::t('discuss_userinfo')->update_counter($_G['uid'], 0, 1, 2);
				//是回复
				$rpid=intval($_GET['rpid']);
				$nuids=array();
				if($rpid && $rpost=C::t('discuss_post')->fetch($thread['posttableid'],$rpid)){ //是回复的回复
					if($rpost['authorid']) $nuids[]=$rpost['authorid'];
				}
				if($thread['authorid']) $nuids[]=$thread['authorid'];
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
				$postno=C::t('discuss_post')->fetch_postno_by_tid_pid($thread['posttableid'],$thread['tid'],$pid);
				foreach($nuids as $uid){
					if($uid!=$_G['uid']){
						//发送通知
						
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=discuss&op=redirect&fid='.$thread['fid'].'&ptid='.$thread['tid'].'&postno='.$postno,
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'subject'=>getstr($thread['subject'],30),
										'message'=>cutstr(strip_tags(preg_replace("/<div\s+class=\"quote\">.+?<\/div>/i",'',$message)),30)
									);
						
							$action='discuss_thread_reply';
							$type='discuss_thread_reply_'.$thread['tid'];
						
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
					}
				}
			}				
		}
		if($pid){
				
			 //插入附件
			 C::t('discuss_post_attach')->insert_by_tid_pid($tid,$pid,$attachs,$fid,($anonymous>1)?0:$_G['uid']);
			//插入@
			$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
			$thread=C::t('discuss_thread')->fetch($tid);
			$postno=C::t('discuss_post')->fetch_postno_by_tid_pid($thread['posttableid'],$thread['tid'],$pid);
			if($uids=C::t('discuss_post_at')->insert_by_pid($pid,$tid,$fid,$ats)){
				//发送@通知
			   foreach(DB::fetch_all("select * from %t where uid in(%n)",array('user',$uids)) as $value){
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>MOD_URL.'&op=redirect&fid='.$thread['fid'].'&ptid='.$thread['tid'].'&postno='.$postno,
									'author'=>$_G['username'],
									'authorid'=>$_G['uid'],
									'message'=>getstr($message,300,0,0,0,-1),
									'dataline'=>dgmdate(TIMESTAMP)
									);
					dzz_notification::notification_add($value['uid'], 'discuss_at', 'discuss_at', $notevars, 0);
			   }
			}
		}
	}
	if ($ismobile) {
		$url=outputurl( MOD_URL.'&op=redirect&fid='.$thread['fid'].'&tid='.$thread['tid'].'&ptid='.$thread['tid'].'&postno='.$postno );
		dheader("Location: ".$_G['siteurl'].$url);
	} else {
		showmessage('do_success',dreferer(),array('data'=>rawurlencode(json_encode(array('fid'=>$fid,'tid'=>$tid,'pid'=>$pid,'ac'=>$ac,'first'=>$first,'extra'=>$_GET['extra'],'forward'=>$_GET['forward'])))),array('showmsg'=>true));
	}
	
}else{
	$discuss['rules']=dzzcode($discuss['rules']);
	$navtitle='';
	$str='';
	$pid=intval($_GET['pid']);
	$fid=intval($_GET['fid']);
	$tid=intval($_GET['tid']);
	$rpid=intval($_GET['rpid']);
	$refer=dreferer();
	$ac=empty($_GET['ac'])?'newthread':trim($_GET['ac']);
	if($tid){
		$thread=C::t('discuss_thread')->fetch($tid);
		if ($thread['inarchive']) {
			showmessage(lang('thread_archived_cannot_do'), dreferer());
		}
	}
	
	if($ac=='edit'){
		$navlast = lang('edit_post');
		 if(!$thread || !$post=C::t('discuss_post')->fetch($thread['tableid'],$pid)){
			 showmessage(lang('post_no_exist'),dreferer());
		 }
		 if($post['authorid']!=$_G['uid'] && $discuss['perm']<3 && $_G['adminid']!=1){
			 showmessage(lang('no_privilege'),dreferer());
		}
	}elseif($ac=='reply' || $ac=='fastreply'){
		 $navlast=lang('reply_post');
	}elseif($ac=='newthread'){
		$navlast=lang('send_post');
		if($thread) $post=array('first'=>0);
		else $post=array('first'=>1);
	}
	if($rpid){
		$post=array();
		$rpost=C::t('discuss_post')->fetch($thread['tableid'],$rpid);
		$html='';
		//$post['subject']='RE:'.preg_replace("/^RE:/i",'',$rpost['subject']);
		if(!$rpost['first']){
			$rpost['message']=preg_replace("/<blockquote>.+?<\/blockquote>/i",'',$rpost['message']);
			$rpost['message']=preg_replace("/\[(.+?):(.+?)\]/i",'',$rpost['message']);
			$shortmsg=cutstr(strip_tags($rpost['message']),80);
			$post['message'].='<blockquote><font size="2"><a href="'.DZZSCRIPT.'?mod=discuss&op=redirect&goto=findpost&fid='.$rpost['fid'].'&pid='.$rpid.'&ptid='.$rpost['tid'].'" target="_blank"><font color="#999999">'.$rpost['author'].' '.lang('published_in').' '.dgmdate($rpost['dateline']).'</font></a></font><br>'.$shortmsg.'</blockquote></div><br>';
		}
		
	}
	$navtitle=$navlast;
	$threadclass = array();
	if($fid) {
		$forum = C::t('discuss')->fetch($fid);
		$forum['name'] = emoji_decode($forum['name']);
		foreach (C::t('discuss_threadclass')->fetch_all_by_fid($fid) as $k => $v) {
			if ($v['moderators'] > 0) {
				if ($discuss['perm'] > 2) $threadclass[$v['typeid']] = $v;
			} elseif($v['enable'] > 0) {
				$threadclass[$v['typeid']] = $v;
			}
		}
	}
	$forums = C::t('discuss')->fetch_all_post_fids_by_uid($_G['uid']);
	if ($ismobile && $ac == 'edit') {
		include template('mobile/editthread');
	} else {
		include template('list/newthread');
	}
}

?>
