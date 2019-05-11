<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$_class_opt = create_class_option();
	$_nation_opt = create_nation_option();
	include gettpl('unite');
	exit();
}
elseif($action == 'unite_class')
{
	initvar(array('cid', 'tocid'), 'P', 2);
	if($cid == $tocid)
		adminmsg('unite_same');
	
	$sub = $db->get_one("SELECT cid FROM pv_class WHERE cup='$cid' LIMIT 1");
	if($sub)
		adminmsg('board_havesub');
	
	$db->update("UPDATE pv_video SET cid='$tocid' WHERE cid='$cid'");
	$db->update("DELETE FROM pv_class WHERE cid='$cid'");
	
	updatecache_class();
	adminmsg('operate_success');
}
elseif($action == 'unite_nation')
{
	initvar(array('nid', 'tonid'), 'P', 2);
	if($nid == $tonid)
		adminmsg('unite_same');
	
	$db->update("UPDATE pv_video SET nid='$tonid' WHERE nid='$nid'");
	$db->update("DELETE FROM pv_nations WHERE id='$nid'");
	
	updatecache_nation();
	adminmsg('operate_success');
}
?>