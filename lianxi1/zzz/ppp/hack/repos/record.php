<?php
!defined('IN_PHPVOD') && exit('Forbidden');
initvar('act', 'G');

if(empty($act))
{
	initvar('page', 'GP', 0);
	(!is_numeric($page) || $page < 1) && $page = 1;
	$limit = "LIMIT " . ($page - 1) * $db_adminperpage . ",$db_adminperpage";
	$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_reposlog");
	$pages = page_format(numofpage($rt['sum'], $page, $db_adminperpage, "$basename&action=record&"));
	$loglist = array();
	$result = $db->query("SELECT * FROM pv_reposlog ORDER BY lid DESC $limit");
	while($row = $db->fetch_array($result))
	{
		$log = unserialize($row['log']);
		$log['datetime'] = get_date($log['timestamp'], 'Y-m-d H:i:s');
		$row['log'] = $log;
		$loglist[] = $row;
	}
	include_once get_hack_tpl('record');
}
elseif($act == 'del')
{
	$db->update("TRUNCATE TABLE pv_reposlog");
	adminmsg('operate_success',"$basename&action=record");
}
?>