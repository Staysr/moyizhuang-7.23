<?php
!defined('IN_PHPVOD') && exit('Forbidden');
$basename = "$admin_file?adminjob=chmod";

$filepath = array(
	'data',
	'data/cache',
	'data/groupdb',
	'data/hack',
	'data/player',
	'data/style',
	'data/temp',
	'data/template',
	'data/update',
	'data/sql_config.php',
	$imgpath,
	$imgpath . '/face/user',
	$imgpath . '/pic',
	'install',
	$db_mobiledirname . '/data',
	$db_mobiledirname . '/data/player',
	$db_mobiledirname . '/data/template',
	'video'
);

$filemode = array();
foreach($filepath as $key => $value)
{
	if(!file_exists($value))
	{
		$filemode[$key] = 1;
	}
	elseif(!pv_is_writable($value))
	{
		$filemode[$key] = 2;
	}
	else
	{
		$filemode[$key] = 0;
	}
}
include gettpl('chmod');
?>