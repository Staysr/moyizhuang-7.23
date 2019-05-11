<?php
require_once('./conn/conn.php');
require_once('./conn/ip.php');
require_once('./conn/time.php');
session_start();
?>

<?php 
@$ip=addslashes($onlineip);
@$content=addslashes($_POST['content']);
@$touser=intval($_POST['biaoshi']);
@$pengyou_user=$_SESSION['pengyou_user'];
@$pengyou_name=$_SESSION['pengyou_name'];
if($pengyou_user){
if($pengyou_name!=""){
	@$name=$_SESSION['pengyou_name'];
}else{
	@$name=$_SESSION['pengyou_user'];
}

$plsql="insert into pengyou_pinglun(name,content,time,ip,weiyibiaoshi,username) values('$name','$content','$time','$ip','$touser','$pengyou_user') ";
$zxsql=mysql_query($plsql);
if($zxsql){
	echo '{"success":true,"msg":"评论成功！","name":"'.$name.'","content":"'.$content.'","user":"'.$pengyou_user.'"}';
}else{
	echo '{"success":false,"msg":"评论失败！"}';
	
}
}else{
	echo '{"success":false,"msg":"请登录账号！"}';
}












?>