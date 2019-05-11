<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/class.php';
include_once PHPVOD_ROOT . 'data/cache/bwd.php';

header("Content-type: text/html;charset=$db_charset");
header("Cache-Control: no-cache, must-revalidate"); //不缓存数据

initvar('action', 'GP');
initvar(array('vid', 'page'), 'GP', 2);

if(!$action)
{
	//GET CACHE
	$cache_key = 'replylist_' . $vid . '_' . $page;
	$cache_info = $cs->get($cache_key, 'all');
	if($cache_info != false)
	{
		$depend_lasttime = $cd->get_depend_lasttime('reply', $vid); //依赖最后更新时间
		$create_time = $cache_info['create_time']; //缓存创建时间
		if($create_time >= $depend_lasttime)
		{
			$pages = $cache_info['cache']['page'];
			$replydb = $cache_info['cache']['data'];
			require_once gettpl('reply');
			exit();
		}
	}	
	
	$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_reply WHERE vid='$vid' AND yz='1'");
	(!is_numeric($page) || $page < 1) && $page = 1;
	$limit = "LIMIT " . ($page - 1) * $db_readperpage . ",$db_readperpage";
	$pages = numofpage($rt['sum'], $page, $db_readperpage, "javascript:get_reply($vid,%page%)");

	$replydb = array();
	$query = $db->query("SELECT * FROM pv_reply WHERE vid='$vid' AND yz='1' ORDER BY postdate DESC $limit");
	while($reply = $db->fetch_array($query))
	{
		$reply['postdate'] = get_date($reply['postdate']);
		$reply['content'] = ieconvert($reply['content']);
		$reply['content'] = str_replace($_bwddb, '*', $reply['content']);

		if($reply['authorid'] == '0') //游客
		{
			$reply['signature'] = '';
			$reply['icon'] = "$imgpath/face/none.gif";
		}
		else
		{
			$s = $db->get_one("SELECT icon,signature FROM pv_members WHERE uid='$reply[authorid]'"); //个性签名
			$reply['signature'] = $s['signature'];

			if($s['icon'] == '' || !file_exists("$imgdir/face/$s[icon]"))
				$s['icon'] = "$imgpath/face/none.gif";
			else
				$s['icon'] = "$imgpath/face/$s[icon]";
			$reply['icon'] = $s['icon'];
		}

		$replydb[] = $reply;
	}
	unset($reply);
	
	//SET CACHE
	$cache_value = array('data'=>$replydb, 'page'=>$pages);
	$cs->set($cache_key, $cache_value, 0);

	require_once gettpl('reply');
}
elseif($ation = 'add')
{
	initvar('vid', 'GP', 2);
	initvar('content', 'GP', 0);
	initvar('gdcode', 'GP', 0);

	/* 用户组权限 */
	if($gp_allowrp != '1') exit(lang('reply_group'));

	/* 栏目权限 */
	$v = $db->get_one("SELECT cid,subject FROM pv_video WHERE vid='$vid'");
	$cid = $v['cid'];

	if($_class[$cid]['type'] != 'free' && $groupid == 'guest') exit(lang('reply_class1'));
	if($_class[$cid]['allowrp'] != '' && ($groupid == 'guest' || strpos($_class[$cid]['allowrp'], ",$groupid,") === false)) exit(lang('reply_class2'));

	if(($_class[$cid]['atccheck'] == '2' || $_class[$cid]['atccheck'] == '3') && $gp_rpcheck == '1')
		$yz = '0';
	else
		$yz = '1';

	/* 认证码 */
	if($db_gdcheck & 4)
	{
		if(!gdconfirm($_POST['gdcode'])) exit(lang('check_error'));
	}

	if($db_charset != 'utf-8')
	{
		$content = str_convert($content, $db_charset, 'utf-8');
	}

	if($groupid == 'guest')
	{
		$username = lang('guest');
		$uid = '0';
	}

	$reply = array(
		'vid' => $vid,
		'author' => $username,
		'authorid' => $uid,
		'postdate' => $timestamp,
		'content' => $content,
		'yz' => $yz
	);
	call_listener('before_postreply', $reply);
	$db->update("INSERT INTO pv_reply (vid,author,authorid,postdate,content,yz) VALUES ('$reply[vid]','$reply[author]','$reply[authorid]','$reply[postdate]','$reply[content]','$reply[yz]')");
	$id = $db->insert_id();
	call_listener('after_postreply', $id);
	$cd->refresh_depend_lasttime('reply', $reply[vid]);
	
	if($yz == '1')
	{
		$db->update("UPDATE pv_video SET reply=reply+1 WHERE vid='$vid'");
		if($groupid != 'guest') update_member_data($uid, 'Reply');

		 //添加事件
		if($db_mergesystype == 'ucenter' && ($db_mergefeed & 2))
		{
			$data = array(
							'title_template' => lang('uchomefeed_postreply_title_template'),
							'class_id' => $cid,
							'class_caption' => $_class[$cid]['caption'],
							'video_id' => $vid,
							'video_subject' => $v['subject']
						);
			$n = pv_feed_add('postreply', $data);
		}

		exit('success');
	}
	else
	{
		exit(lang('reply_admin_check'));
	}
}
?>