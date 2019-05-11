<?php
require_once 'global.php';

initvar('action');
if($groupid != 'guest' && $action != "quit") showmsg('login_have','showmsg_home','index.php');
!$action && $action = "login";

if($action == "login")
{
	initvar('step', 'GP', 2);
	if($step==2)
	{
		initvar(array('username', 'password', 'cktime'), 'P', 0);
		if($db_gdcheck & 2)
		{
			initvar('gdcode','P',0);
			if(!gdconfirm($gdcode)) showmsg('check_error');
		}
		pv_user_login($username, $password, (int)$cktime);
	}
}
elseif($action == "quit")
{
	pv_user_loginout();
}
require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl('login');
footer();
?>