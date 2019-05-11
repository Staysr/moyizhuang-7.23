<?php
require dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))) . '/config.inc.php';
if (empty($_SESSION["adminid"]) || ($_SESSION["userkey"] != "ktkey2016")) {
	echo tiao("登录已超时，请重新登录！", "login.php");
} 
