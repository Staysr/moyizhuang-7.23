<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$threaddb = array();
	$query = $db->query("SELECT * FROM pv_sharelinks ORDER BY threadorder ASC");
	while($share = $db->fetch_array($query))
	{
		strlen($share['url']) > 30 && $share['url'] = pv_substr($share['url'], 30);
		strlen($share['descrip']) > 30 && $share['descrip'] = pv_substr($share['descrip'], 30);
		$sharedb[] = $share;
	}
}
elseif($action == "add")
{
	initvar('step', 'P', 2);
	if($step == '2')
	{
		initvar(array('name', 'descrip'), 'P');
		initvar(array('url', 'logo'), 'P', 0);
		initvar('threadorder', 'P', 2);
		if(empty($name) || empty($url)) adminmsg('operate_fail');
		$db->update("INSERT INTO pv_sharelinks (threadorder ,name ,url ,descrip ,logo ) VALUES ('$threadorder', '$name', '$url', '$descrip', '$logo');");
		updatecache_sharelink();
		adminmsg('operate_success');
	}
}
elseif($action == "edit")
{
	initvar('step', 'GP', 2);
	if($step != 2)
	{
		initvar('sid', 'GP', 2);
		@extract($db->get_one("SELECT * FROM pv_sharelinks WHERE sid='$sid'"));
	}
	else
	{
		initvar(array('name', 'descrip'), 'P');
		initvar(array('url', 'logo'), 'P', 0);
		initvar(array('threadorder','sid'), 'P', 2);
		if(empty($name) || empty($url)) adminmsg('operate_fail');
		$db->update("UPDATE pv_sharelinks SET threadorder='$threadorder',name='$name',url='$url',descrip='$descrip',logo='$logo' WHERE sid='$sid'");
		updatecache_sharelink();
		adminmsg('operate_success');
	}
}
elseif($action == "del")
{
	initvar('selid','P',2);
	if(!$selid = checkselid($selid))
	{
		adminmsg('operate_error');
	}
	$db->update("DELETE FROM pv_sharelinks where sid IN($selid)");
	updatecache_sharelink();
	adminmsg('operate_success');
}

include gettpl('sharelink');
?>