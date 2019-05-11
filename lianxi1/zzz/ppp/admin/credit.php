<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(empty($action))
{
	$credit = $db->query("SELECT * FROM pv_credits ORDER BY cid");
}
elseif($action == 'edit')
{
	initvar('step','P',2);
	if(!$step)
	{
		initvar('cid','G',2);
		$creditdb = $db->get_one("SELECT * FROM pv_credits WHERE cid='$cid'");
		if(!$creditdb) adminmsg('credit_error');
	}
	else
	{
		initvar('cid','P',2);
		initvar(array('name','description'),'P');
		if(empty($name) || empty($description)) adminmsg('operate_fail');
		$db->update("UPDATE pv_credits SET name='$name',description='$description' WHERE cid='$cid'");
		updatecache_credit();
		adminmsg('operate_success');
	}
}
elseif($action == 'newcredit')
{
	initvar('step','P',2);
	if($step==2)
	{
		initvar(array('name','description'),'P');
		if(empty($name) || empty($description)) adminmsg('operate_fail',$basename.'&action=newcredit',array(),3);
		$db->update("INSERT INTO pv_credits(name,description) VALUES('$name','$description')");
		updatecache_credit();
		adminmsg('operate_success');
	}
}
elseif($action == 'delete')
{
	initvar('delcid','P',2);
	$delcids = checkselid($delcid);
	if(empty($delcids)) adminmsg('operate_error');
	$db->update("DELETE FROM pv_credits WHERE cid IN($delcids)");
	$db->update("DELETE FROM pv_membercredit WHERE cid IN($delcids)");
	updatecache_credit();
	adminmsg('operate_success');
}
elseif($action == 'usercredit')
{
	initvar('step','P',2);
	if($step == '1')
	{
		initvar('username','P');
		$rt = $db->get_one("SELECT uid,username FROM pv_members WHERE username='$username'");
		!$rt && adminmsg('user_not_exists', $basename.'&action=usercredit', array($username),3);
		$credit = get_custom_credit($rt['uid']);
	}
	elseif($step == '2')
	{
		initvar('uid','P',2);
		initvar('creditdb','P');
		foreach($creditdb as $key => $value)
		{
			if(is_numeric($key) && is_numeric($value))
			{
				$db->if_update("SELECT uid FROM pv_membercredit WHERE uid='$uid' AND cid='$key'", "UPDATE pv_membercredit SET value='$value' WHERE uid='$uid' AND cid='$key'", "INSERT INTO pv_membercredit SET uid='$uid',cid='$key',value='$value'");
			}
		}
		update_memberid($uid);
		adminmsg('operate_success');
	}
}
include gettpl('credit');
?>
