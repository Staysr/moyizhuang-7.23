﻿<?php
include("../includes/config.php");
session_start();
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}
include("../includes/classes.php");
require_once(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), 2));
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

$resultSettings = $db->query(getSettings()); 
$settings = $resultSettings->fetch_assoc();

// The theme complete url
$CONF['theme_url'] = $CONF['theme_path'].'/'.$settings['theme'];

if(!empty($_POST['start'])) {
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		$loggedIn = new loggedIn();
		$loggedIn->db = $db;
		$loggedIn->url = $CONF['url'];
		$loggedIn->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['username'];
		$loggedIn->password = (isset($_SESSION['password'])) ? $_SESSION['password'] : $_COOKIE['password'];
		
		$verify = $loggedIn->verify();
		
		$feed->user = $verify;
		$feed->id = $verify['idu'];
		$feed->username = $verify['username'];
		
	}
	$feed->per_page = $settings['perpage'];
	$feed->categories = $feed->getCategories();
	$feed->c_per_page = $settings['cperpage'];
	$feed->c_start = 0;
	$feed->l_per_post = $settings['lperpost'];
	$feed->profile = $_POST['profile'];
	$feed->profile_data = $feed->profileData($_POST['profile']);
	if(empty($_POST['filter'])) {
		$_POST['filter'] = '';
	}
	$messages = $feed->explore($_POST['start'], $_POST['filter']);
	echo $messages[0];
}
mysqli_close($db);
?>