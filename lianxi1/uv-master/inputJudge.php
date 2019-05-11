<?php
	include("conn.php");
	
	if(isset($_POST['username'])){
		$username=$_POST['username'];
	}
	else if(isset($_GET['username'])){
		$username=$_GET['username'];
	}else $username='';
	
	if($username=='admin1'){
		echo "不可用";
	}
	
	
	if(isset($_GET['name_id'])){
		$result=mysqli_query($conn,"select * from info where name_id ='{$_GET['name_id']}' ");
		if($row=mysqli_fetch_array($result)){
				echo '此ID已存在';
		}				
		mysqli_close($conn);
	}
	
	if(isset($_GET['qq'])){
		$result=mysqli_query($conn,"select * from info where qq ='{$_GET['qq']}' ");
		if($row=mysqli_fetch_array($result)){
			 session_start();	 
			if($_SESSION['name']!=$row['username'])
				echo '此QQ已存在';
		}				
		mysqli_close($conn);
	}
	

?>