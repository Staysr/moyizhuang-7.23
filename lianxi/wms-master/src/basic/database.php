<?php //½¨Á¢MySqlÁ¬½Ó
	$con = mysql_connect("localhost","root","root") or die("²»ÄÜÁ¬½Óµ½Mysql Server");
	mysql_select_db("db_wms", $con) or die("Êý¾Ý¿âÑ¡ÔñÊ§°Ü");
	mysql_query("set names gb2312 ");
?>