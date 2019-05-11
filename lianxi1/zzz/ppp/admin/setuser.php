<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$groupselect = create_usergroup_option();
}
elseif($action == 'addnew')
{
	initvar('groupid', 'P', 2);
	initvar(array('username', 'password', 'email'), 'P', 0);
	!$groupid && $groupid = '-1';
	$t = user_register($username, $password, $email, $groupid);
	if($t > 0)
	{
		update_siteinfo(array('newmember', 'totalmember'));
		adminmsg('operate_success');
	}
	else
		adminmsg('pv_user_' . $t);
}
elseif($action == 'search')
{
	initvar(array('groupid', 'schname', 'schemail', 'userip', 'regdate', 'orderway', 'asc'), 'GP', 0);
	initvar(array('schname_s', 'lines', 'page'), 'GP', 2);

	$sql = is_numeric($groupid) ? "m.groupid='$groupid'" : 1;

	$schname = trim($schname);
	if($schname != '')
	{
		$schname = str_replace('*', '%', $schname);
		$sql .= $schname_s == 1 ? " AND m.username LIKE '$schname'" : " AND (m.username LIKE '%$schname%')";
	}
	if($schemail != '')
	{
		$schemail = str_replace('*', '%', $schemail);
		$sql .= " AND (m.email LIKE '%$schemail%')";
	}
	if($userip != '')
	{
		$userip = str_replace('*', '%', $userip);
		$sql .= " AND (md.onlineip LIKE '%$userip%')";
	}
	if($regdate != 'all' && is_numeric($regdate))
	{
		$schtime = $timestamp - $regdate;
		$sql .= " AND m.regdate<'$schtime'";
	}
	if($orderway)
	{
		$order = "ORDER BY $orderway";
		$asc && $order .= ' '.$asc;
	}
	$rs = $db->get_one("SELECT COUNT(*) AS count FROM pv_members m LEFT JOIN pv_memberdata md ON md.uid=m.uid WHERE $sql");
	$count = $rs['count'];

	if($lines <= 0) $lines = 100;
	(!is_numeric($page) || $page < 1) && $page = 1;
	$rurl = "$admin_file?adminjob=setuser&action=$action&groupid=$groupid&schname=" . urlencode($schname) . "&schname_s=$schname_s&schemail=$schemail&regdate=$regdate&orderway=$orderway&asc=$asc&lines=$lines&";
	$pages = page_format(numofpage($count, $page, $lines, $rurl));
	$start = ($page - 1) * $lines;
	$limit = "LIMIT $start,$lines";

	$schdb = array();
	$query = $db->query("SELECT m.uid,m.username,m.email,m.groupid,m.regdate,md.postnum,md.onlineip FROM pv_members m LEFT JOIN pv_memberdata md ON md.uid=m.uid WHERE $sql $order $limit");
	while($sch = $db->fetch_array($query))
	{
		$sch['regdate'] = get_date($sch['regdate']);
		strpos($sch['onlineip'], '|') !== false && $sch['onlineip'] = substr($sch['onlineip'], 0, strpos($sch['onlineip'], '|'));
		$sch['groupselect'] = create_usergroup_option($sch['groupid']);
		$schdb[] = $sch;
	}
}
elseif($action == 'editgroup')
{
	initvar(array('gid', 'selid', 'delmsg'), 'P', 2);

	if(empty($gid)) adminmsg('operate_error');
	foreach($gid as $uid => $groupid)
	{
		$db->update("UPDATE pv_members SET groupid='$groupid' WHERE uid='$uid'");
	}

	if(!empty($selid))
	{
		del_user($selid, (boolean)$delmsg);
		update_siteinfo(array('newmember', 'totalmember'));
	}
	adminmsg('operate_success');
}
elseif($action == 'edit')
{
	initvar('step', 'GP', 2);
	if($step != '2')
	{
		initvar('uid', 'G', 2);
		@extract($db->get_one("SELECT m.*,md.* FROM pv_members m LEFT JOIN pv_memberdata md ON md.uid=m.uid WHERE m.uid='$uid'"));
		$groupselect = create_usergroup_option($groupid);
		$groupexpiry = $groupexpiry > 0 ? get_date($groupexpiry, 'Y-m-d H:i') : '';
		$togidselect = create_usergroup_option($togid);

		if(strpos($onlineip, '|'))
		{
			$onlineip = substr($onlineip, 0, strpos($onlineip, '|'));
		}
		$regdate = get_date($regdate, 'Y-m-d H:i:s');
		ifcheck($publicmail, 'publicmail');
		ifcheck($receivemail, 'receivemail');
		ifcheck($gender, 'gender', 'select');

		$getbirthday = explode("-", $bday);
		$year[(int)$getbirthday[0]] = 'selected="selected"';
		$month[(int)$getbirthday[1]] = 'selected="selected"';
		$day[(int)$getbirthday[2]] = 'selected="selected"';

	}
	else
	{
		initvar(array('uid','groupid','togid','groups','gender','publicmail','receivemail','postnum','rvrc','money'), 'P', 2);
		initvar(array('groupexpiry','expiretime','username','password','check_pwd','email','regdate','icon','year','month','day','honor','signature','oicq','msn','site','userip'), 'P');
		$basename .= "&action=edit&uid=$uid";

		$oldinfo = $db->get_one("SELECT username,email FROM pv_members WHERE uid='$uid'");

		//更新用户名
		if($oldinfo['username'] != stripcslashes($username) && $db_mergesystype == '0') //用户名不相同且没有与其它系统整合
		{
			//检测用户名
			$u = checkname($username);
			if($u != 1) adminmsg('pv_user_' . $u);

			//更新用户
			$db->update("UPDATE pv_members SET username='$username' WHERE uid='$uid'");

			//更新与此用户相关的资料
			$db->update("UPDATE pv_video SET author='$username' WHERE authorid='$uid'");
			$db->update("UPDATE pv_reply SET author='$username' WHERE authorid='$uid'");
			$db->update("UPDATE pv_article SET author='$username' WHERE author='" . addslashes($oldinfo['username']) . "'");
		}

		//更新密码及邮箱
		$newpass = '';
		$newemail = '';
		if($password != '' || $check_pwd != '')
		{
			$password != $check_pwd && adminmsg('password_confirm');
			$newpass = stripcslashes($password);
		}
		if($oldinfo['email'] != stripslashes($email))
		{
			$newemail = stripcslashes($email);
		}
		if($newpass != '' || $newemail != '')
		{
			user_edit($username, '', $newpass, $newemail, 1);
		}

		//更新扩展用户组
		$extgroup = array();
		foreach($groups as $extgid)
		{
			if($extgid == $groupid) continue;
			$et = !empty($expiretime[$extgid]) && strpos($expiretime[$extgid], '_') === false ? pv_strtotime($expiretime[$extgid]) : '0';
			$extgroup[$extgid] = $et;
		}
		if(empty($extgroup))
		{
		    $db->update("DELETE FROM pv_extgroups WHERE uid='$uid'");
		}
		else
		{
		    $extgroupinfo = serialize($extgroup);
		    $db->if_update("SELECT uid FROM pv_extgroups WHERE uid='$uid'",
		        "UPDATE pv_extgroups SET groups='$extgroupinfo' WHERE uid='$uid'",
		        "INSERT INTO pv_extgroups(uid,groups) VALUES('$uid','$extgroupinfo')");
		}

		//更新其它资料
		$groupexpiry = !empty($groupexpiry) && strpos($groupexpiry, '_') === false ? pv_strtotime($groupexpiry) : '0';
		$regdate = pv_strtotime($regdate);
		$bday = $year . "-" . $month . "-" . $day;

		$db->update("UPDATE pv_members SET groupid='$groupid',groupexpiry='$groupexpiry',togid='$togid',gender='$gender',regdate='$regdate',publicmail='$publicmail',receivemail='$receivemail',icon='$icon',bday='$bday',honor='$honor',signature='$signature',oicq='$oicq',msn='$msn',site='$site' WHERE uid='$uid'");
		$db->update("UPDATE pv_memberdata SET postnum='$postnum',rvrc='$rvrc',money='$money',onlineip='$userip' WHERE uid='$uid'");

		update_memberid($uid);
		adminmsg('operate_success');
	}
}

include gettpl('setuser');
?>