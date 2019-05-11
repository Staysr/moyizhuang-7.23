<?php
require_once 'global.php';

/**
 * 用户组权限判断
 */
$groupid == 'guest' && showmsg('not_login');
$gp_maxmsg <= 0 && showmsg('group_msg_max');

initvar('action');
if(!$action) $action = 'receivebox';

$msgdb = array();

//收件箱
if($action == "receivebox")
{
	$query = $db->query("SELECT mid,fromuid,username,ifnew,title,mdate FROM pv_msg WHERE type='rebox' AND touid='$uid' ORDER BY mdate DESC");
	$msgcount = $db->num_rows($query);
	if($msgcount)
	{
		$contl = number_format(($msgcount / $gp_maxmsg) * 100, 2);
	}
	else
	{
		$msgcount = '0';
		$contl = '0';
	}

	while($msginfo = $db->fetch_array($query))
	{
		$msginfo['title'] = pv_substr($msginfo['title'], 70);
		$msginfo['mdate'] = get_date($msginfo['mdate']);
		$msgdb[] = $msginfo;
	}
}

//发件箱
if($action == "sendbox")
{
	$query = $db->query("SELECT msg.mid,msg.fromuid,msg.touid,msg.title,msg.mdate,m.username AS touser FROM pv_msg AS msg LEFT JOIN pv_members AS m ON msg.touid=m.uid WHERE msg.type='sebox' AND msg.fromuid='$uid' ORDER BY mdate DESC");
	while($msginfo = $db->fetch_array($query))
	{
		$msginfo['title'] = pv_substr($msginfo['title'], 70);
		$msginfo['mdate'] = get_date($msginfo['mdate']);
		$msgdb[] = $msginfo;
	}
}

//阅读短消息
if($action == "read")
{
	initvar('mid','GP',2);
	$msginfo = $db->get_one("SELECT mid,touid,fromuid,username,ifnew,title,mdate,content FROM pv_msg WHERE mid='$mid'");
	if($msginfo)
	{
		$msginfo['content'] = ieconvert($msginfo['content']);
		$msginfo['mdate'] = get_date($msginfo['mdate']);
		if($msginfo['ifnew'] == 1)
		{
			$db->update("UPDATE pv_msg SET ifnew=0 WHERE mid='$mid'");
			setnewpm($uid);
		}
	}
	else
	{
		showmsg('msg_error');
	}
}

//写短信
if($action == "write")
{
	$gp_postpertime = "10"; //两次短消息发送的时间间隔
	$rp = $db->get_one("SELECT mdate FROM pv_msg WHERE fromuid='$uid' ORDER BY mdate DESC LIMIT 1");
	$lastwrite = $rp['mdate'];
	if($timestamp - $lastwrite <= $gp_postpertime)
	{
		showmsg('msg_limit','','',array($gp_postpertime));
	}

	initvar('step','GP',2);
	if(!$step)
	{
		/* 用户组权限 */
		if($gp_allowmessage != '1') showmsg('group_msg_post');
		$subject = $content = '';

		initvar(array('remid','touid'),'GP',2);
		if(is_numeric($remid) && $remid > 0)
		{
			 /* 回复消息 */
			$reinfo = $db->get_one("SELECT fromuid,touid,username,type,title,content FROM pv_msg WHERE mid='$remid' AND (type='rebox' AND touid='$uid')");
			if($reinfo)
			{
				$msgid = $reinfo['username'];
				$subject = strpos($reinfo['title'], 'Re:') === false ? 'Re:' . $reinfo['title'] : $reinfo['title'];
				$content = ieconvert($reinfo['content']);
			}
		}
		elseif(is_numeric($touid))
		{
			/* 给指定用户发送短消息 */
			$reinfo = $db->get_one("SELECT username FROM pv_members WHERE uid='$touid'");
			$msgid = $reinfo['username'];
		}
		else
		{
			$msgid = '';
		}
	}
	elseif($step == 2)
	{
		if($db_gdcheck & 8)
		{
			initvar('gdcode','GP',0);
			if(!gdconfirm($gdcode)) showmsg('check_error','','goback');
		}

		initvar(array('msg_title','ifsave'));
		initvar(array('msg_user','msg_content'),'GP',0);

		if(trim($msg_content)=='' || trim($msg_title)=='' || trim($msg_user)=='')
		{
			showmsg('msg_empty','','goback');
		}
		elseif(strlen($msg_title) > 75 || strlen($msg_content) > 1500)
		{
			showmsg('msg_subject_limit','','goback');
		}
		if($msg_user)
		{
			$rt = $db->get_one("SELECT uid FROM pv_members WHERE username='$msg_user'");
			if(!$rt)
			{
				showmsg('user_not_exists','','',array($msg_user));
			}
		}
		$msg = array(	'touser' 		=> $msg_user,
						'fromuid' 		=> $uid,
						'username' 		=> $username,
						'title' 		=> $msg_title,
						'content' 		=> $msg_content,
						'savetosebox'	=> $ifsave,
						'datetime' 		=> $timestamp,
					);
		$n = sendmsg($msg);
		switch ($n)
		{
			case '-1': showmsg('msg_touser_error','','goback'); break;
			case '-2': showmsg('msg_touser_myself','','goback'); break;
			case '-3': showmsg('sebox_full','','goback'); break;
			case '-4': showmsg('rebox_full','','goback'); break;
			case '1': refreshto("message.php", 'operate_success'); break;
		}
	}
}

if($action == "clear")
{
	$db->update("DELETE FROM pv_msg WHERE type='rebox' AND touid='$uid'");
	$db->update("DELETE FROM pv_msg WHERE type='sebox' AND fromuid='$uid'");
	setnewpm($uid);
	refreshto("message.php", 'operate_success');
}
if($action == "del")
{
	initvar('mid','GP',2);
	if($mid)
	{
		$delids = $mid;
	}
	else
	{
		initvar('delid','GP',2);
		$delids = checkselid($delid);
		if(!$delids) showmsg('operate_error');
	}
	$db->update("DELETE FROM pv_msg WHERE mid IN($delids) AND ((type='sebox' AND fromuid='$uid') OR (type='rebox' AND touid='$uid'))");
	setnewpm($uid);
	refreshto("message.php", 'operate_success');
}

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl('message');
footer();

/**
 * 更新用户的短消息状态
 * @param int $userid 用户ID
 */
function setnewpm($userid)
{
	global $db;
	$rs = $db->get_one("SELECT COUNT(*) AS count FROM pv_msg WHERE touid='$userid' AND ifnew='1' AND type='rebox'");
	$s = $rs['count'] > 0 ? '1' : '0';
	$db->update("UPDATE pv_members SET newpm='$s' WHERE uid='$userid'");
}
?>