<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if($action == 'upgrade')
{
	initvar('upgrade','P',2);
	$upgrade_str = serialize($upgrade);
	$db->if_update("SELECT db_name FROM pv_config WHERE db_name='db_upgrade'", "UPDATE pv_config SET db_value='$upgrade_str' WHERE db_name='db_upgrade'", "INSERT INTO pv_config(db_name,db_value) VALUES ('db_upgrade','$upgrade_str')");
	updatecache_config('db');
	adminmsg('operate_success');
}
else
{
	$db_upgrade = $db->get_one("SELECT db_value FROM pv_config WHERE db_name='db_upgrade'");
	$db_upgrade = unserialize($db_upgrade['db_value']);
}
include gettpl('upgrade');
?>