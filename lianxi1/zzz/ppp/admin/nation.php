<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$nationdb = array();
	$query = $db->query("SELECT * FROM pv_nations ORDER BY vieworder");
	while($nation = $db->fetch_array($query))
	{
		$nationdb[] = $nation;
	}
	include gettpl('nation');
	exit();
}
elseif($action == "add")
{
	initvar('subject', 'P');
	empty($subject) && adminmsg('operate_fail');
	$db->update("INSERT INTO pv_nations SET subject='$subject';");
	updatecache_nation();
	adminmsg('operate_success');
}
elseif($action == "edit")
{
	initvar('vieworder', 'P', 2);
	initvar('subject', 'P');
	foreach($vieworder as $key => $value)
	{
		!empty($subject[$key]) && $db->update("UPDATE pv_nations SET vieworder='$vieworder[$key]',subject='$subject[$key]' WHERE id='$key'");
	}
	updatecache_nation();
	adminmsg('operate_success');
}
elseif($action == "del")
{
	initvar('id', 'G', 2);
	$db->update("DELETE FROM pv_nations WHERE id='$id'");
	updatecache_nation();
	adminmsg('operate_success');
}
?>