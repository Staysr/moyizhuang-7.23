<?php
require_once("./conn/conn.php");
require_once("./conn/function.php");
session_start();
?>
<?php
@$ip=addslashes($onlineip);
@$user=addslashes($_POST['user']);
@$pass=md5($_POST['pass']);
@$xtime=date('Y-m-d H:i:s',strtotime("-30 min"));
if (!isset($user) || empty($user) ||
   !isset($pass) || empty($pass)
   ){
		$raoguojs="insert into pengyou_feifa(ip,time,content) value('$ip','$time','绕过前端提交数据')";
			mysql_query($raoguojs);
	echo '<meta charset="utf-8">';
	echo '<link href="style/yiqi.css" rel="stylesheet" />';
	echo '<script type="text/JavaScript" src="js/yiqi.js"></script>';
	echo '<body></body>';
	echo '<script type="text/javascript">';
		echo 'tishi(1,"非法操作已记录ip地址",3000);';
	 echo '</script>';
}else{
			$cxlogin="select * from pengyou_user_login_info where time>='$xtime' and ip='$ip' and username='$user'";
				$zxcxlogin=mysql_query($cxlogin);
				$cxloginsz=mysql_fetch_array($zxcxlogin);
				if($cxloginsz['cishu']>=5){
					echo '{"success":false,"msg":"错误次数超过5次已禁止登录，请30分钟后重试"}'; 
				}else{
	
	$cxpassword="select * from pengyou_user where username='$user' and password='$pass'";
	@$cx=mysql_query($cxpassword);
	@$row=mysql_fetch_array($cx);
	$yonghu=$row['username'];
	$yonghuname=$row['name'];
	if($yonghu){
			if($cxloginsz<1){
				$loginsb="insert into pengyou_user_login_info(username,ip,time,ok,cishu) value('$user','$ip','$time','1','0')";
				$zxloginsb=mysql_query($loginsb);
			}else{
				$gxdl="update pengyou_user_login_info set time='$time',ok='1' where username='$user' and time>='$xtime'";
				mysql_query($gxdl);
			}
		$cripsql="update pengyou_user set dlip='$ip',dltime='$time' where username = '$yonghu'";
			mysql_query($cripsql);
		 $_SESSION['pengyou_user']=$row['username'];
		$_SESSION['pengyou_name']=$yonghuname;
		echo '{"success":true,"msg":"登录成功"}';
	}else{
			if($cxloginsz<1){
				$loginsb="insert into pengyou_user_login_info(username,ip,time,ok,cishu) value('$user','$ip','$time','0','0')";
				$zxloginsb=mysql_query($loginsb);
			}else{
				$gxdl="update pengyou_user_login_info set time='$time',ok='0',ip='$ip',cishu=cishu+1 where username='$user' and time>='$xtime'";
				$gengxincishu=mysql_query($gxdl);
			}

        echo '{"success":false,"msg":"登录失败，一共五次机会哦"}'; 

	};
	
	
	
				}
}

?>

