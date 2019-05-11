<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	initvar('page','GP',2);
	(!is_numeric($page) || $page < 1) && $page = 1;
	$limit = "LIMIT " . ($page - 1) * $db_adminperpage . ",$db_adminperpage";
	$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_video WHERE yz='0' ORDER BY vid ASC");
	$pages = page_format(numofpage($rt['sum'], $page, $db_adminperpage, "$basename&"));
	$voddb = array();
	$query = $db->query("SELECT * FROM pv_video WHERE yz='0' ORDER BY vid ASC $limit");
	while($yzvod = $db->fetch_array($query))
	{
		$yzvod['postdate'] = get_date($yzvod['postdate']);
		$yzvod['classname'] = $_class[$yzvod['cid']]['caption'];
		$voddb[] = $yzvod;
	}
	include gettpl('vodcheck');
	exit();
}
elseif($action == 'check')
{
	initvar('yzvod','P',2);
	initvar('type','P');
	empty($yzvod) && adminmsg('operate_error');
	$cids = array();
	foreach($yzvod as $vid)
	{
		if($type == 'pass')
		{
			$db->update("UPDATE pv_video SET yz='1' WHERE vid='$vid'");
			$t = $db->get_one("SELECT cid,authorid FROM pv_video WHERE vid='$vid'");
			$cids[] = $t['cid'];
			if($t['authorid'] != '0')
			{
				update_member_data($t['authorid'], 'Post');
			}
		}
		else
		{
			del_video($vid,false);
			update_siteinfo(array('totalvideo'));
		}
	}
	
	$cids = array_unique($cids);
	if(!empty($cids)) $cd->refresh_depend_lasttime('cid', $cids);
	adminmsg('operate_success');
}

?>