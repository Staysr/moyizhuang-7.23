<?php
error_reporting(E_ALL^E_DEPRECATED);
ob_start();
if (!session_id()) session_start();
define('PCFINAL', TRUE);
date_default_timezone_set('PRC');//设置时区
header('Content-type:text/html; charset=utf-8');//设置编码
include('data.php');
$conn = mysql_connect(DATA_HOST, DATA_USERNAME, DATA_PASSWORD);
mysql_select_db(DATA_NAME);
mysql_query('set names utf8');
$cms_version = 'v4.4.3-201800710';
?>
