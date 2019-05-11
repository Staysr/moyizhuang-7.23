<?php
!defined('IN_PHPVOD') && exit('Forbidden');
initvar('step','GP',2);
if(empty($step))
{
	$_bwddb = array();
	if(file_exists(PHPVOD_ROOT . "data/cache/bwd.php"))	include_once (PHPVOD_ROOT . "data/cache/bwd.php");	
	$str = implode(',', $_bwddb);
	include gettpl('setbwd');
}
elseif($step == '2')
{
	initvar('bwd','P',0);
	$bwddb = explode(',', stripcslashes($bwd));
	updatecache_bwd($bwddb);
	adminmsg('operate_success');
}
?>