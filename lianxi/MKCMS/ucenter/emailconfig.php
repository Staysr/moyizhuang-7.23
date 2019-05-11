<?php include('../system/inc.php');
include("smtp.class.php");
$MailServer = $mkcms_smtp; //SMTP服务器
    $MailPort = 465; //SMTP服务器端口
    $smtpMail = $mkcms_muser; //SMTP服务器的用户邮箱
    $smtpuser = $mkcms_muser; //SMTP服务器的用户帐号
    $smtppass = $mkcms_mpwd; //SMTP服务器的用户密码
?>
