<?php
!defined('IN_PHPVOD') && exit('Forbidden');
require_once PHPVOD_HACK_ROOT . "function.php";

initvar('rid', 'G', 2);
$db->update("DELETE FROM pv_repos WHERE rid='$rid'");
adminmsg("operate_success");

?>