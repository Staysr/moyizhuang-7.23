<?php
	session_start();
	header("Content-Type:text/html; charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
body {
	margin-left: 12px;
	margin-top: 12px;
}
-->
</style>
<?php
	if(!isset($_SESSION['user']) or empty($_SESSION['user'])){
		include_once 'login.php';
	}else{
?>
<script>open('main.php','chat','width=1000,height=800,fullscreen=1,location=0,menubar=yes');</script>
<?php
	}
?>
</html>