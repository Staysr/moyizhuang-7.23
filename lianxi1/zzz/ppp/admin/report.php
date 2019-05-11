<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	initvar('page','GP',2);
	(!is_numeric($page) || $page < 1) && $page = 1;
	$limit = "LIMIT " . ($page - 1) * $db_adminperpage . ",$db_adminperpage";
	$rt = $db->get_one("SELECT COUNT(*) AS count FROM pv_report");
	$sum = $rt['count'];
	$pages = page_format(numofpage($sum, $page, $db_adminperpage, "$basename&"));

	$query = $db->query("SELECT r.*,m.username,v.subject FROM pv_report r LEFT JOIN pv_members m ON m.uid=r.uid LEFT JOIN pv_video v ON r.vid=v.vid ORDER BY id $limit");
	while($rt = $db->fetch_array($query))
	{
		$reportdb[] = $rt;
	}
}
elseif($action == 'del')
{
	initvar('selid','P',2);
	if(!$selid = checkselid($selid))
	{
		adminmsg('operate_error');
	}
	$db->update("DELETE FROM pv_report where id IN ($selid)");
	adminmsg('operate_success');
}

include gettpl('report');
?>