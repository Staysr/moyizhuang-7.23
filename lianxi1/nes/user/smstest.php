<?php
include('../inc/aik.config.php');
session_start();
function generate_code($length = 6) {
    $min = pow(10 , ($length - 1));
    $max = pow(10, $length) - 1;
    return rand($min, $max);
}

$statusStr = array(
		"0" => "短信发送成功",
		"-1" => "参数不全",
		"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
		"30" => "短信宝密码错误",
		"40" => "短信宝账号不存在",
		"41" => "短信宝余额不足",
		"42" => "帐户已过期",
		"43" => "IP地址限制",
		"50" => "内容含有敏感词"
	);	
$smsapi = "http://www.smsbao.com/"; //短信网关
$user = $aik['sms_user'];  //短信平台帐号
$pass = md5($aik['sms_pass']);  //短信平台密码
$code=generate_code(6);
$_SESSION['smscode']=$code;
$content="您的验证码:".$code.",60秒内有效提示：请勿泄露短信验证码"; //要发送的短信内容
$phone=$_POST['tel'];

$sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
$result =file_get_contents($sendurl) ;
echo $statusStr[$result];
?>