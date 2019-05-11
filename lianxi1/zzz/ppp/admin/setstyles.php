<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if($action == 'add' || $action == 'edit')
{
	initvar('step', 'GP', 2);
	if($step != 2)
	{
		if($action == 'edit')
		{
			initvar('name', 'GP');
			isset($name) && !empty($name) && include_once path_cv(PHPVOD_ROOT . "data/style/$name.php");
		}
	}
	else
	{
		initvar('style', 'P');
		if(empty($style['name']) || empty($style['image']) || empty($style['tpl'])) adminmsg('operate_fail');
		if($action == 'add')
		{
			file_exists(PHPVOD_ROOT . 'data/style/' . $style['name'] . '.php') && adminmsg('style_exists');
			$db->update("INSERT INTO pv_styles(name,stylepath,tplpath) VALUES('$style[name]','$style[image]','$style[tpl]')");
			updatecache_style($style['name']);
			adminmsg('style_add_success');
		}
		elseif($action == 'edit')
		{
			initvar('oldname','P');
			$db->update("UPDATE pv_styles SET name='$style[name]',stylepath='$style[image]',tplpath='$style[tpl]' WHERE name LIKE '$oldname'");
			updatecache_style($style['name']);
			if($style['name'] != $oldname) delfile(PHPVOD_ROOT . "data/style/$oldname.php");
			adminmsg('operate_success');
		}
	}
}
elseif($action == 'del')
{
	initvar('name','GP');
	if(strtolower($name) == 'phpvod') adminmsg('style_del_phpvod');
	if($name == $db_defaultstyle) adminmsg('style_del_error');
	$db->update("DELETE FROM pv_styles WHERE name='$name'");
	if(file_exists(PHPVOD_ROOT . "data/style/$name.php"))
	{
		if(delfile(PHPVOD_ROOT . "data/style/$name.php"))
		{
			adminmsg('operate_success');
		}
		else
		{
			adminmsg('operate_fail');
		}
	}
	else
	{
		adminmsg('style_not_exists');
	}
}
else
{
	$styles = array();
	$result = $db->query("SELECT * FROM pv_styles ORDER BY sid ASC");
	while($row = $db->fetch_array($result))
	{
		$styles[] = $row;
	}
}

include gettpl('setstyles');
?>