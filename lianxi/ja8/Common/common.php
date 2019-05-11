<?php
error_reporting(0);

header("Content-type: text/html; charset=utf-8");

date_default_timezone_set('PRC');

require_once('functions.php');//公用函数库文件

require_once('config.php');//数据库信息配置文件

require_once('db.class.php');//数据库操作类文件

require_once('360safe/360webscan.php');//360网站安全文件

//连接数据库
$db = new db($Mysql['host'],$Mysql['user'],$Mysql['pwd'],$Mysql['name'],$Mysql['port']);

//获取系统配置
$sql = $db->query('SELECT * FROM '.$Mysql['prefix'].'config');
while($row = $db->fetch($sql)){
	$config[$row['vkey']] = $row['value'];
}
//获取用户信息
$cookie = $_COOKIE['ssnh_sid'];
if(preg_match('/^[0-9a-z]{32}$/i',$cookie)){
if($userrow = $db->get_row("SELECT * FROM ".$Mysql['prefix']."users WHERE `cookie` =  '{$cookie}' LIMIT 1")){
		$islogin = 1;
    }
}