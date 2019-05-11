<?php
require dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))) . '/config.inc.php';
if (empty($_SESSION["adminid"]) || ($_SESSION["userkey"] != "ktkey2016")) {
	echo tiao("请登录后进行操作！", "login.php");
	exit();
} 
$cm -> query("SELECT * FROM d_adminuser where admin_id='" . $_SESSION["adminid"] . "' order by admin_id asc");
$adminuser = $cm -> fetch_array($rs);
date_default_timezone_set('PRC');
