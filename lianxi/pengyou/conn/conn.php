<?php 
$host='127.0.0.1';		//数据库地址
$sqlname='root';		//数据库账号
$sqlpass='root';		//数据库密码
$sqldb='pengyou';        //数据库名
$con = mysql_connect($host,$sqlname,$sqlpass);		//连接数据库

mysql_select_db($sqldb);						//选择数据库

mysql_query("set names 'utf8'");					//设置编码格式

?>