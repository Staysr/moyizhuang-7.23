<?php
     $conn=mysql_connect("localhost","root","hust") or die("���ݿ���������Ӵ���".mysql_error());
     mysql_select_db("db_wms",$conn) or die("���ݿ���ʴ���".mysql_error());
 	 mysql_query("set character set gb2312");
     mysql_query("set names gb2312");
?>
