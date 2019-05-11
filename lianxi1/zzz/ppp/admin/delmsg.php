<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if($action == 'del')
{
	initvar('step','P',2);
	initvar(array('type','keepnew','keyword','fromuser','touser','msgdate','direct','lines','page'),'GP');
	if(!$step)
	{
		if($type != 'all')
		{
			$sql = "m.type='$type'";
		}
		else
		{
			$sql = '1 ';
		}

		if($keepnew)
		{
			$sql .= " AND m.ifnew='0'";
		}

		if($keyword)
		{
			$keyword = trim($keyword);
			$keywordarray = explode(",", $keyword);
			foreach($keywordarray as $value)
			{
				$value = str_replace('*', '%', $value);
				$keywhere .= 'OR';
				$keywhere .= " m.content LIKE '%$value%' OR m.title LIKE '%$value%' ";
			}
			$keywhere = substr_replace($keywhere, "", 0, 3);
			$sql .= " AND ($keywhere) ";
		}

		if($fromuser)
		{
			$fromuser = str_replace('*', '_', $fromuser);
			$rt = $db->get_one("SELECT uid,username FROM pv_members WHERE username LIKE '$fromuser'");
			if(!$rt)
			{
				adminmsg('user_not_exists', '', array($fromuser));
			}
			if($type == 'rebox' || $type == 'sebox')
			{
				$sql .= " AND m.type='$type' AND m.fromuid='$rt[uid]'";
			}
			else
			{
				$sql .= " AND m.fromuid='$rt[uid]'";
			}
		}

		if($touser)
		{
			$touser = str_replace('*', '_', $touser);
			$rt = $db->get_one("SELECT uid,username FROM pv_members WHERE username LIKE '$touser'");
			if(!$rt)
			{
				adminmsg('user_not_exists', '', array($touser));
			}
			if($type == 'rebox' || $type == 'sebox')
			{
				$sql .= " AND m.type='$type' AND m.touid='$rt[uid]'";
			}
			else
			{
				$sql .= " AND m.touid='$rt[uid]'";
			}
		}

		if($msgdate)
		{
			$schtime = $timestamp - $msgdate * 24 * 3600;
			$sql .= " AND m.mdate<'$schtime'";
		}

		$rs = $db->get_one("SELECT COUNT(*) AS count FROM pv_msg m WHERE $sql");
		$count = $rs['count'];
		if(!is_numeric($lines)) $lines = 100;
		(!is_numeric($page) || $page < 1) && $page = 1;

		$pages = page_format(numofpage($count, $page, $lines, "$admin_file?adminjob=delmsg&action=$action&type=$type&keepnew=$keepnew&msgdate=$msgdate&fromuser=" . rawurlencode($fromuser) . "&touser=" . rawurlencode($touser) . "&lines=$lines&"));
		$start = ($page - 1) * $lines;
		$limit = "LIMIT $start,$lines";

		$query = $db->query("SELECT m.*,m1.username as fromuser,m2.username as touser FROM pv_msg m LEFT JOIN pv_members m1 ON m1.uid=m.fromuid LEFT JOIN pv_members m2 ON m2.uid=m.touid WHERE $sql ORDER BY mid DESC $limit");
		while($message = $db->fetch_array($query))
		{
			if($direct)
			{
				$delid[] = $message['mid'];
			}
			else
			{
				!$message['fromuser'] && $message['fromuser'] = $message['username'];
				$message['date'] = get_date($message['mdate']);
				$messagedb[] = $message;
			}
		}
	}

	if($step == 2 || $direct)
	{
		$direct && !$delid && adminmsg('msg_nofound');
		!isset($delid) && initvar('delid','P',2);
		!$delid && adminmsg('operate_error');
		$delidstr = checkselid($delid);
		$db->update("DELETE FROM pv_msg WHERE mid IN ($delidstr)");
		adminmsg('operate_success');
	}

}

include gettpl('delmsg');
?>