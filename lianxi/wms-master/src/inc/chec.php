<?php 
session_start();
if(!isset($_SESSION[username]))
	echo "<script>alert('����Ȩ����');location='index.php';</script>";
if($_SERVER['HTTP_REFERER'] == "")
	echo "<script>alert('��ϵͳ������ӵ�ַ������');window.close();</script>";
?>