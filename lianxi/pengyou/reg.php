<?php
require_once("./conn/conn.php");
require_once("./conn/function.php");
session_start();
?>
<?php
@$ip=addslashes($onlineip);
@$user=addslashes($_POST['user']);
@$pass=md5($_POST['pass']);
@$okpass=md5($_POST['okpass']);
@$email=addslashes($_POST['email']);
if (!isset($user) || empty($user) ||
   !isset($pass) || empty($pass) ||
	$pass!==$okpass
   ){
	$raoguojs="insert into pengyou_feifa(ip,time,content) value('$ip','$time','绕过前端提交注册数据')";
			mysql_query($raoguojs);
	echo '<meta charset="utf-8">';
	echo '<link href="style/yiqi.css" rel="stylesheet" />';
	echo '<script type="text/JavaScript" src="js/yiqi.js"></script>';
	echo '<body></body>';
	echo '<script type="text/javascript">';
		echo 'tishi(1,"非法操作已记录ip地址",3000);';
	 echo '</script>';
}else{
		$sql="select * from pengyou_user where username ='$user'";
		$zxsql=mysql_query($sql);
		$hqsql=mysql_fetch_assoc($zxsql);
		if($hqsql>0){
			 echo '{"success":false,"msg":"账号已存在"}'; 
		}else{
		$regsql="insert into pengyou_user(username,password,email,zcip,zctime) values('$user','$pass','$email','$ip','$time') ";
		if(mysql_query($regsql)){
			echo '{"success":true,"msg":"注册成功"}';
		}
			 
			
		}
	
}