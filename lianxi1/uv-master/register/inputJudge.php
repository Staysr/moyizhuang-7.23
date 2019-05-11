<?php
	include("../conn.php");

	if(isset($_GET['username'])){
		$result=mysqli_query($conn,"select * from user where username ='{$_GET['username']}' ");
		if($row=mysqli_fetch_array($result)){
				echo '此username已存在';
		}				
		mysqli_close($conn);
	}
	if(isset($_GET['name'])){
		$result=mysqli_query($conn,"select * from user where name ='{$_GET['name']}' ");
		if($row=mysqli_fetch_array($result)){
				echo '此name已存在';
		}				
		mysqli_close($conn);
	}
?>