<?php

error_reporting(0);
if (!isset($_COOKIE['admin_name'])) {
  	alert_href('非法登录', 'cms_login.php');
}else{
  
	$admin_name = base64_decode($_COOKIE['admin_name']);
  	$arr = explode("|",$admin_name);
  	$username = $arr[0];
  	$passwd = $arr[1];
  	$sql = 'select * from mkcms_manager where m_name = "'.$username.'" and m_password = "'.md5($passwd).'"';
	$result = mysql_query($sql);
	if(!$result){
     
    	alert_href('非法登录', 'cms_login.php');
    }
}

function getTopDomainhuo()
{
    $xzv_0 = $_SERVER['HTTP_HOST'];
}
?>