<?php
error_reporting(0);
define('IN_CRONLITE', true);
define('ROOT', dirname(__FILE__).'/');
define('SYS_KEY', 'authsystemt');

date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
session_start();

if(is_file(ROOT.'360safe/360webscan.php')){//360网站卫士
    require_once(ROOT.'360safe/360webscan.php');
}

require ROOT.'config.php';


include_once(ROOT."function.php");

$password_hash='!@#%!s!';
$clientip=$_SERVER['REMOTE_ADDR'];

if(isset($_COOKIE["admin_token"]))
{
$token=authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($auth_user.$auth_pass.$password_hash);
	if($session==$sid) {
		$islogin=1;
	}
}
?>