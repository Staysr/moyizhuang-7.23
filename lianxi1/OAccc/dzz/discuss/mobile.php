<?php
/*
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
$ismobile=helper_browser::ismobile();
//判断游客,弹出登录框
Hook::listen('check_login');
if (!$ismobile) {
	dheader("location: ".outputurl($_G['siteurl'].MOD_URL));	
}
$do = trim($_GET['do']);
$uid = $_G['uid'];

if ($do == 'mycenter') {
	$space = C::t('user_profile')->get_userprofile_by_uid($uid);//用户资料信息
	include template('mobile/mycenter');
} elseif ($do == 'user') {
	$pageSize = 20;
	$ajax = $_GET['ajax'];
	$fid = intval($_GET['fid']);
	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$limit = ($page - 1) * $pageSize.'-'.$pageSize;
	$count = C::t('discuss_user')->fetch_all_by_perm($fid,array(2, 3),$limit,1);
	$users = C::t('discuss_user')->fetch_all_by_perm($fid,array(2, 3),$limit);
	if ($page * $pageSize < $count) {
		$nextpage = $page + 1;
	}
	$gets = array(
				'op' => 'mobile',
				'do' =>	'user',
				'fid' => $fid,
			);
	$theurl = MOD_URL.'&'.url_implode($gets);
	if ($ajax) {
		include template('mobile/user_item');
	} else {
		include template('mobile/user');
	}
} elseif ($do == 'postcmt') {
	$tid = intval($_GET['tid']);
	$pid = $_GET['pid'];
	$post = C::t('discuss_post')->fetch('tid:'.$tid, $pid);
	// $post['message'] = dzzcode($post['message']);
	if (!$post) showmessage(lang('post_no_exist'), dreferer());
	$perm = C::t('discuss_user')->fetch_perm_by_uid($uid, $post['fid']);
	$discuss = C::t('discuss')->fetch_by_fid($post['fid']);

	if (!$perm && !$discuss['allowshare']) showmessage(lang('no_privilege'), dreferer());
	$post['cmtcount'] = C::t('discuss_comment')->get_cmt_by_pid($pid, 0, 1);
	$post['comments'] = C::t('discuss_comment')->get_cmt_by_pid($pid, 0, 0, 10);
	include template('mobile/post');

} elseif ($do == 'create') {//创建讨论版
	loadcache('discuss_setting');
	$setting=$_G['cache']['discuss_setting'];
	if($setting['allownewboard']>0){
		$muids=$setting['moderators']?explode(',',$setting['moderators']):array();
		if(!in_array($_G['uid'],$muids)) showmessage(lang('only_appoint_member'), dreferer());
	}
	if($setting['maxboard'] && !C::t('discuss')->checkMaxBoard($_G['uid'])){
		showmessage(lang('exceed_max_discuss'), dreferer());
	}

	if(submitcheck('discusssubmit')){
		$setarr=array('name'=>emoji_encode(str_replace('...','',getstr($_GET['name'],80))),
					  'perm'=>1,//0表示公开 1表示隐私（默认全为隐私）
					  );
		$field=array(
					 'icon'=>intval($_GET['aid']),
					 'rules'=>$_GET['rules'],
					 'iconcolor' => $_GET['iconcolor'] ? $_GET['iconcolor'] : '#00b8c4',
					 'allowshare'=>intval($_GET['allowshare']),
					 'source'=>$ismobile ? $ismobile : 'PC',
					 );
		
		$setarr['dateline']=TIMESTAMP;
		$setarr['uid']=$_G['uid'];
		$setarr['username']=$_G['username'];
		if($fid=C::t('discuss')->insert_by_fid($setarr,$field)){
			$list[$fid] = C::t('discuss')->fetch_by_fid($fid);
			exit(json_encode(array('code' => 200, 'message' => lang('create_success'), 'url' => outputurl(MOD_URL.'&op=list&fid='.$fid))));
		}else{
			exit(json_encode(array('code' => 400, 'message' => lang('create_failed'))));
		}
	}else{
		include template('mobile/create');
	}
} elseif ($do == 'newthread') {//新建主题
	if (submitcheck('newthreadsub')) {
		$anonymous=intval($_GET['anonymous']);
		$fid = intval($_GET['fid']);
		if (!$fid) {
			exit(json_encode(array('code' => 400, 'message' => lang('please_chose_discuss'))));
		}
		$perm = C::t('discuss_user')->fetch_perm_by_uid($uid, $fid);
		if (!$perm) {
			exit(json_encode(array('code' => 400, 'message' => lang('no_privilege'))));
		}
		$typeid = intval($_GET['typeid']);
		$subject = emoji_encode(trim($_GET['subject']));
		$message = emoji_encode(helper_security::checkhtml($_GET['message'])); //去除换行
		$message = '<p>'.$message.'</p>';
		//获取文档内附件
		$attachs = $_GET['attachs'];
		$attachment = 0;
		if ($attachs) {
			$message .= '<p>';
			$attachment = 2;
			$aids = array();
			//图片拼接标签
			foreach ($attachs as $k => $v) {
				$imgs .= '<img class="dzz-image" data-from="mobile" src="'.DZZSCRIPT.'?mod=io&amp;op=thumbnail&amp;width=1440&amp;height=900&amp;original=0&amp;path='.dzzencode('attach::'.$v['aid']).'" title="'.$v['name'].'" alt="'.$v['name'].'" path="attach::10" apath="'.dzzencode('attach::'.$v['aid']).'" aid="'.$v['aid'].'" ext="'.$v['ext'].'" dsize="'.$v['size'].'"/>';
				$aids[] = $v['aid'];
			}
			$message .= $imgs;
			$message .= '</p>';
		}
		$thread=array(
				  'subject'=>$subject,
				  'typeid'=>$typeid,
				  'fid'=>$fid,
				  'attachment'=>$attachment,
				  'source'=>$ismobile ? $ismobile : 'PC',
				  );
		$thread['authorid'] =  ($anonymous>1)?0: getglobal('uid');
		$thread['author'] =  ($anonymous>1)?lang('anonymous'):getglobal('username');
		$thread['anonymous'] = $anonymous;
		$thread['dateline'] =  getglobal('timestamp');
		$thread['lastpost'] =  getglobal('timestamp');
		$thread['lastposter'] = ($anonymous>1)?lang('anonymous'):getglobal('username');
		$tid=C::t('discuss_thread')->insert($thread,1);
		$lastpost = $thread['tid']."\t".$thread['subject']."\t".getglobal('timestamp')."\t".$thread['author'];
		C::t('discuss')->update($fid, array('lastpost' => $lastpost, 'lastposttime' => getglobal('timestamp'), 'lastthreadtime' => getglobal('timestamp')));
		C::t('discuss')->update_forum_counter($fid, 1, 1, 1);
		C::t('discuss_userinfo')->update_counter($_G['uid'], 1, 1, 7);
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

		if($pid && $aids){
			//插入附件
			 C::t('discuss_post_attach')->insert_by_tid_pid($tid,$pid,$aids,$fid,($anonymous>1)?0:$_G['uid']);
		}
		exit(json_encode(array('code' => 200, 'message' => lang('post_success'), 'url' => outputurl(MOD_URL."&op=viewthread&fid=$fid&tid=$tid"))));
	} else {
		$diss = C::t('discuss')->fetch_all_post_fids_by_uid($uid);
		$fid = intval($_GET['fid']);
		if ($fid) {
			$discuss=C::t('discuss')->fetch_by_fid($fid,$_G['uid']);
			$threadtypes = array();
			if ($discuss['threadtypes']['available']) {
				$types = C::t('discuss_threadclass')->fetch_all_by_fid($discuss['fid']);
				foreach ($types as $k => $v) {
					if ($discuss['perm'] > 2) {
						if ($v['enable'] || $v['moderators']) {
							$threadtypes[] = array('typeid' => $v['typeid'], 'name' => $v['name']);
						}
					} else {
						if ($v['enable']) {
							$threadtypes[] = array('typeid' => $v['typeid'], 'name' => $v['name']);
						}
					}
				}
			}
		}
		include template('mobile/newthread');
	}
}

?>