<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(0);
require_once dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)) . '/conf/date.php';
session_start();
$config = array();
$Dconfig = array_merge(require dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)) . "/conf/config.php", $config);
require dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)) . '/conf/cm.class.php';
// if (!isset($base) || !isset($domains) || !isset($webcess)) {
// 	exit();
// } 
if (function_exists('cntype')) {
} else {
	exit();
} 
if (function_exists('GetArray')) {
} else {
	exit();
} 
if (empty($_COOKIE["tuiarray"])) {
	if ($_GET["ck"] != "") {
		$cm -> query("SELECT * FROM f_user where u_id='" . $_GET["ck"] . "' order by u_id desc");
		$userck = $cm -> fetch_array($rs);
		if ($userck["u_id"] != "") {
			$cko = array($userck["u_id"], $userck["u_tui1"], $userck["u_tui2"]);
		} else {
			$cko = array(1, 1, 1);
		} 
	} else {
		$cko = array(1, 1, 1);
	} 
	$ckojson = json_encode($cko);
	setcookie('tuiarray', $ckojson, (3600 * 720) + time(), "/", "." . $fens["c_url"]);
} 
$b3 = "ew5$#";