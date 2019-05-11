<?php 
require '../conn/conn2.php';
require '../conn/function.php';

$qqid = $C_qqid;
$qqkey = $C_qqkey;

$D_domain=splitx($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"],"/qq",0);
$url="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$qqid."&redirect_uri=http://".$D_domain."/qq/reg.php&scope=add_topic,add_pic_t,get_user_info";

Header("Location: ".$url); 
?>