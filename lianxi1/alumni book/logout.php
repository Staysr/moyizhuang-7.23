<?php
require_once('Common/common.php');
$newsid=md5(uniqid().rand(1,1000));
$db->query("update ".$Mysql['prefix']."users set cookie='$newsid' where uid='{$userrow['uid']}'");
setcookie("ssnh_sid", "", -1, '/');
header("Location:/");