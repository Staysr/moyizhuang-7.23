<?php
	header("Content-Type: text/html; charset=utf8");
	include("conn.php");
	session_start();	     
	if(isset($_SESSION['name'])){
		$name=$_POST['name'];
		$name_id=$_POST['name_id'];
		$fans=$_POST['fans'];
		$sex_f=$_POST['sex_f'];
		$uv=$_POST['uv'];
		$jg=$_POST['jg'];
		$jg1=$_POST['jg1'];
		$qq=$_POST['qq'];
		
		$xs=$_POST['xs'];
		$lb=$_POST['lb'];
		if(!isset($lb[0]))
			$lb[0]="";
		if(!isset($lb[1]))
			$lb[1]="";
		$lbs=$lb[0].$lb[1];
		$username=$_SESSION['username'];
		
				
		mysqli_query($conn,"UPDATE  info SET name='{$name}',fans='{$fans}',sex_f='{$sex_f}',uv='{$uv}',jg='{$jg}',jg1='{$jg1}',qq='{$qq}',xs='{$xs}',lb='{$lbs}' WHERE name_id='{$name_id}' ");  
		
		header('location:skip.php?url=./index.php&info=修改成功,即将转到首面');			
															
	}else  header('location:skip.php?url=./index.php&info=非法访问！请登录');
	
?>