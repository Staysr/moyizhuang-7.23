<?php
error_reporting(E_ERROR | E_PARSE);
function_exists('set_magic_quotes_runtime') && set_magic_quotes_runtime(0);

define('IN_PHPVOD', 2);
define('PHPVOD_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
require_once (PHPVOD_ROOT . "admin/admincp.php");

$basename = $admin_file;
if(!empty($adminjob))
{
	$basename .= '?adminjob=' . $adminjob;
	if(!empty($admintype)) $basename .= '&admintype=' . $admintype;
}

if(!$adminjob)
{
	include_once gettpl('index');
	exit();
}
elseif($adminjob == 'admin')
{
	$server_info = get_server_info();
	include_once gettpl('admin');
	exit();
}
elseif(in_array($adminjob, array('record')))
{
	require_once PHPVOD_ROOT . "admin/$adminjob.php";
}
elseif($adminjob == 'hack')
{
	initvar('hackname','GP',0);
	if(!$hackname || !is_dir(PHPVOD_ROOT . "hack/$hackname") || !file_exists(PHPVOD_ROOT . "hack/$hackname/admin.php"))
	{
		adminmsg("hack_error","$admin_file?adminjob=hackcenter");
	}
	define('PHPVOD_HACK_ROOT', PHPVOD_ROOT . 'hack' . DIRECTORY_SEPARATOR . $hackname . DIRECTORY_SEPARATOR);
	$hackpath = "hack/$hackname";
	$basename = "$admin_file?adminjob=hack&hackname=$hackname";
	require_once PHPVOD_HACK_ROOT . 'admin.php';
}
elseif($adminjob == 'left')
{
	require_once PHPVOD_ROOT . 'admin/left.php';
}
elseif($adminjob)
{
	!file_exists(PHPVOD_ROOT . "admin/$adminjob.php") && adminmsg('undefine_action');

	$perflag = false;
	if($admin['groupid'] == '3')
	{
		$perflag = true;
	}
	else
	{
		$keyname = empty($admintype) ? $adminjob : $adminjob . '.' . $admintype;
		$permissions = unserialize($admin['permissions']);
		if($permissions[$keyname] == '1') $perflag = true;
	}

	if($perflag !== true) adminmsg('no_permission');
	require_once (PHPVOD_ROOT . "admin/$adminjob.php");
}

?>