<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	initvar('page');
	(!is_numeric($page) || $page < 1) && $page = 1;
	$limit = "LIMIT " . ($page - 1) * $db_adminperpage . ",$db_adminperpage";
	$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_members WHERE groupid='4'");
	$pages = page_format(numofpage($rt['sum'], $page, $db_adminperpage, "$basename&"));
	$memdb = array();
	$query = $db->query("SELECT * FROM pv_members WHERE groupid='4' $limit");
	while($member = $db->fetch_array($query))
	{
		$member['regdate'] = get_date($member['regdate']);
		$memdb[] = $member;
	}
}
elseif($action == 'check')
{
	initvar('yzmem','P',2);
	initvar('type','P');
	!$yzmem && adminmsg('operate_error');
	if($type == 'pass')
	{
		$uids = checkselid($yzmem);
		$db->update("UPDATE pv_members SET groupid='-1',yz='1' WHERE uid IN($uids)");
	}
	else
	{
		del_user($yzmem);
		update_siteinfo(array('totalmember','newmember'));
	}
	adminmsg('operate_success');
}

include gettpl('usercheck');
?>