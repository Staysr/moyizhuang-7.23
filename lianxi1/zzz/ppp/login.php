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
		
		$login = array(
			'username' => $username,
			'password' => $password,
			'cktime' => (int)$cktime
		);
		call_listener('before_login', $login);
		pv_user_login($login['username'], $login['password'], $login['cktime']);
	}
}
elseif($action == "quit")
{
	pv_user_loginout();
}
elseif($action == 'active')
{
	initvar(array('username','password'),'G',0);
	$username = urldecode($username);
	$password = authcode(base64_decode($password),'DECODE');

	if($db_mergesystype == 'ucenter')
	{
		$t = pv_user_active($username,$password); //激活帐号
		if($t > 0)
		{
			$result = $db->get_one("SELECT uid,password FROM pv_members WHERE ucuid='$t'");
			cookie('user', $result['uid'] . "\t" . $result['password']);
			$ucjs = uc_user_synlogin($t);
			refreshto($db_bfn,'have_login',$ucjs);
		}
		elseif($t == -2)
		{
			showmsg('uc_active_-2','',$db_bfn,array($username),10);
		}
		elseif($t == -3)
		{
			showmsg('uc_active_-3','',$db_bfn,array(),10);
		}
	}

}

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl('login');
footer();
?>