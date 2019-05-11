<?php
!defined('IN_PHPVOD') && exit('Forbidden');
@set_time_limit(0);

if(empty($action))
{
	require_once (PHPVOD_ROOT . 'admin/table.php');
}
elseif($action == 'repair' || $action=='optimize')
{
	initvar('tabledb','P');
	empty($tabledb) && adminmsg('operate_error');
	$table = implode(',', $tabledb);

	if($action == 'repair')
		$sql = 'REPAIR TABLE '.$table;
	else
		$sql = 'OPTIMIZE TABLE '.$table;

	$query = $db->query($sql);
	while($rt = $db->fetch_array($query))
	{
		$rt['Table'] = substr(strrchr($rt['Table'], '.'), 1);
		$msgdb[] = $rt;
	}
}
include gettpl('repair');
?>