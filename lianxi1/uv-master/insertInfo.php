<?php
	header("Content-Type: text/html; charset=utf8");
	include("conn.php");
	session_start();	     
	    
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
	
	
	
//	echo "qq"."<br>";
//	echo $lb[0]."<br>";
//		if(isset($lb[1]))
//		echo $lb[1]."<br>";
//		//echo $xs."<br>";
	
	
	mysqli_query($conn,"insert into info(name,name_id,fans,sex_f,uv,jg,jg1,qq,xs,lb,username) values('{$name}','{$name_id}','{$fans}','{$sex_f}','{$uv}','{$jg}','{$jg1}','{$qq}','{$xs}','{$lbs}','{$username}')");
	header('location:index.php');
	
?>