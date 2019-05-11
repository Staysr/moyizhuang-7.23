<?php
require dirname(dirname(__FILE__)) . "/config.inc.php";
if (empty($_SESSION["adminidkt123"]) || ($_SESSION["key"] != "kt2017key")) {
	echo tiao("登录已超时，请重新登录！", "login.php");
}

