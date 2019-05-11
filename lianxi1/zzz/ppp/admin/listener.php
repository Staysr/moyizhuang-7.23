<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$listenerdb = array();
	$query = $db->query("SELECT * FROM pv_listener ORDER BY callorder DESC, id ASC");
	while($rt = $db->fetch_array($query))
	{
		$listenerdb[] = $rt;
	}
}
elseif($action == 'add')
{
	initvar('step', 'P', 2);
	if($step == '2')
	{
		initvar('callorder', 'P', 2);
		initvar('file', 'P', 0);
		if(empty($file)) adminmsg('operate_fail');
		!file_exists(PHPVOD_ROOT . $file) && adminmsg('listener_not_exists');
		register_listener(array('file'=>$file,'callorder'=>$callorder));
		adminmsg('operate_success');
	}
}
elseif($action == 'edit')
{
	initvar('step', 'GP', 2);
	if(!$step)
	{
		initvar('id', 'GP', 2);
		@extract($db->get_one("SELECT * FROM pv_listener WHERE id='$id'"));
	}
	elseif($step == '2')
	{
		initvar(array('callorder', 'id'), 'P', 2);
		initvar('file', 'P', 0);
		if(empty($file)) adminmsg('operate_fail');
		!file_exists(PHPVOD_ROOT . $file) && adminmsg('listener_not_exists');		
		update_listener(array('file'=>$file,'callorder'=>$callorder),$id);
		adminmsg('operate_success');
	}
}
elseif($action == 'del')
{
	initvar('selid', 'P', 2);
	if(!$selid = checkselid($selid)) adminmsg('operate_error');
	$db->update("DELETE FROM pv_listener WHERE id IN($selid)");
	updatecache_listener();
	adminmsg('operate_success');
}

include gettpl('listener');
?>