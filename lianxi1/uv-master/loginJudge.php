<?php
	$username=$_POST['username'];
	$password=$_POST['password'];
	//文档编码格式设置
	header("Content-type:text/html;charset=utf8");
	include("conn.php");
	//数据库查询
	$result=mysqli_query($conn,"select * from user where username ='{$username}' ");
	if($row=mysqli_fetch_array($result)){
		if($password==$row['password']){
			session_start();
			$_SESSION['username']=$_POST['username'];
			$_SESSION['name']=$row['name'];
			header('location:skip.php?url=./index.php&info=登入成功,即将转到首面');			
		}			
		else header('location:skip.php?url=./index.php&info=密码错误,即将转到首面');	
	}else header('location:skip.php?url=./index.php&info=无此用户,即将转到首面');	
		
	mysqli_close($conn);
?>