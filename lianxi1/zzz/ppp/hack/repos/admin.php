<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!function_exists('curl_init'))
	adminmsg('curl_error','goback','',10);

if(!is_writeable(PHPVOD_HACK_ROOT.'cache') && !chmod(PHPVOD_HACK_ROOT.'cache',0777))
	adminmsg('admin_chmod','goback',array($hackpath.'/cache'),10);

empty($action) && $action = 'manage';
$scriptfile = PHPVOD_HACK_ROOT . $action . '.php';
if(is_file($scriptfile))
{
	require_once $scriptfile;
}
?>