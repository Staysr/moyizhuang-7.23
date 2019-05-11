<?php
	header("content-type:text/html;charset=utf8");
	
	if(isset($_POST['submit'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$name=$_POST['name'];
    	//包含数据库连接文件
		include '../conn.php';  
		
    	$result=mysqli_query($conn,"INSERT INTO user (username, password,name)VALUES ('$username', '$password','$name');");
    	if($result){
    		
    		header('location:../skip.php?url=index.php&info=注册成功，跳转到登录页面！');
    	}
}


?>
