﻿<?php
include("../includes/config.php");
session_start();
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}
include("../includes/classes.php");
include(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), 2));
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

$resultSettings = $db->query(getSettings()); 
$settings = $resultSettings->fetch_assoc();

if(isset($_POST['id']) && isset($_POST['type'])) {
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		$loggedIn = new loggedIn();
		$loggedIn->db = $db;
		$loggedIn->url = $CONF['url'];
		$loggedIn->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['username'];
		$loggedIn->password = (isset($_SESSION['password'])) ? $_SESSION['password'] : $_COOKIE['password'];
		
		$verify = $loggedIn->verify();

		if($verify['username']) {
			$feed = new feed();
			$feed->db = $db;
			$feed->url = $CONF['url'];
			$feed->title = $settings['title'];
			$feed->username = $verify['username'];
			$feed->id = $verify['idu'];
			$feed->profile = $_POST['profile'];
			$feed->email = $CONF['email'];
			$feed->profile_data = $feed->profileData(null, $_POST['id']);
			$feed->email_new_friend = $settings['email_new_friend'];
			
			$result = $feed->getSubscribe($_POST['type'], null, $_POST['z']);
			echo $result;
		}
	}
}
mysqli_close($db);
?>