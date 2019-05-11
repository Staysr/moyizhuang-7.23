<?php
require_once('./conn/conn.php');
require_once('./conn/ip.php');
require_once('./conn/time.php');
session_start();
?>
<?php
@$ip=addslashes($onlineip);
@$Id=intval($_GET['Id']);
@$pengyou_user=$_SESSION['pengyou_user'];
@$pengyou_name=$_SESSION['pengyou_name'];
if($pengyou_user){
if($pengyou_name!=""){
	@$name=$_SESSION['pengyou_name'];
}else{
	@$name=$_SESSION['pengyou_user'];
}
if(!empty($Id)){
	$cxsql="select * from pengyou_zan where weiyibiaoshi = '$Id' and username = '$pengyou_user'";
	$zxcxsql=mysql_query($cxsql);
	$hqcxsql=mysql_fetch_assoc($zxcxsql);
	if($hqcxsql<1){
			$zansql="insert into pengyou_zan(ip,weiyibiaoshi,time,username) values('$ip','$Id','$time','$pengyou_user')";
			$zxsql=mysql_query($zansql);
		if($zxsql){
			echo '{"success":true,"msg":"点赞成功！","name":"'.$name.'"}';
		}else{
			echo '{"success":false,"msg":"点赞失败！"}';
		}
	}else{
		echo '{"success":false,"msg":"已经点过赞了！"}';
	}
	
}
}else{
	echo '{"success":false,"msg":"请登录账号！"}';
}
?>