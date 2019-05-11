<?php
require_once 'global.php';

initvar('action');
!$action && $action = 'sendpwd';
if($action == 'sendpwd')
{
	initvar('step','GP',2);
	if($step == 2)
	{
		if($db_gdcheck & 16)
		{
			initvar('gdcode','GP',0);
			if(!gdconfirm($gdcode)) showmsg('check_error');
		}

		initvar(array('username','email'));
		$userarray = $db->get_one("SELECT uid,password,email,regdate FROM pv_members WHERE username='$username'");

		if($userarray)
		{
			if($userarray['email'] != $email) showmsg('email_error');
			if($timestamp - getcookie('lastwrite') <= 60) showmsg('sendpwd_limit');
			cookie('lastwrite', $timestamp);

			$submit = $userarray['regdate']. md5(substr($userarray['password'], 10));
			$toemail = $email;
			$subject = lang('email_sendpwd_subject',array($db_wwwname));
			$message = lang('email_sendpwd_content',array($db_wwwurl,$userarray['uid'],$submit,$db_wwwname));

			if(sendemail(array($toemail), $subject, $message))
				showmsg('mail_success');
			else
				showmsg('mail_failed');
		}
		else
		{
			showmsg('user_not_exists','','',array($username));
		}
	}
}
elseif($action == 'getback')
{
	initvar('submit','GP',0);
	initvar('uid','GP',2);
	if($uid <= 0 || $submit == '') showmsg('undefined_action');

	$detail = $db->get_one("SELECT username,password,regdate FROM pv_members WHERE uid='$uid'");
	if($detail)
	{
		$is_right = $detail['regdate'].md5(substr($detail['password'], 10));
		if($submit == $is_right)
		{
			initvar('job','GP',2);
			if($job == 2)
			{
				initvar(array('new_pwd','rep_pwd'));
				if($new_pwd != $rep_pwd)
				{
					showmsg('password_confirm','','goback');
				}
				else
				{
					user_edit($detail['username'],'',$new_pwd,'',1);
					showmsg('password_change_success', 'showmsg_login', 'login.php');
				}
			}
		}
		else
		{
			showmsg('password_confirm_fail','','sendpwd.php');
		}
	}
	else
	{
		showmsg('user_not_exists','','',array($detail['username']));
	}
}

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl('sendpwd');
footer();
?>