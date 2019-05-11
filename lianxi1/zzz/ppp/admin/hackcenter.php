<?php
! defined('IN_PHPVOD') && exit('Forbidden');
include_once PHPVOD_ROOT . 'data/cache/hack.php';
require_once PHPVOD_ROOT . 'require/xml.php';

if(empty($action))
{
	$uninstall_list = array();
	if($fp = opendir(PHPVOD_ROOT . 'hack'))
	{
		$infodb = array();
		while(($directory = readdir($fp)))
		{
			if(strpos($directory, '.') === false && !isset($_hack[$directory]) && is_file(PHPVOD_ROOT . "hack/$directory/install.xml"))
			{
				$xml = readover(PHPVOD_ROOT . "hack/$directory/install.xml");
				$hackconfig = xml_unserialize($xml, true);
				$uninstall_list[] = $hackconfig;
			}
		}
		closedir($fp);
	}
}
elseif($action == 'add')
{
	initvar('directory', 'GP');
	isset($_hack[$directory]) && adminmsg('hackcenter_sign_exists', '', array($directory));
	$hackpath = PHPVOD_ROOT . "hack/$directory/";

	//安装检测
	if(is_file($hackpath . 'install_check.php'))
	{
		require_once $hackpath . 'install_check.php';
	}
	
	$hackconfig = array();
	if(is_file($hackpath . 'install.xml'))
	{
		$xml = readover($hackpath . "install.xml");
		$hackconfig = xml_unserialize($xml, true);
	}
	
	if(isset($hackconfig['name']) && $hackconfig['name'] != '' && isset($hackconfig['hidden']) && isset($hackconfig['spos']) && isset($hackconfig['listener']) && isset($hackconfig['version']))
	{
		if($hackconfig['hidden'] != '1') $hackconfig['hidden'] = '0';
		if(!in_array($hackconfig['spos'], array('0', '1', '2'))) $hackconfig['spos'] = '0';
		if(!empty($hackconfig['listener']) && !is_file($hackpath . $hackconfig['listener']))
			adminmsg('listener_not_exists');
		
		if(is_file($hackpath . 'install.sql'))
			database_revert($hackpath . 'install.sql');
		
		$db->update("INSERT INTO pv_hack (name,directory,hidden,spos,listener,version) VALUES ('$hackconfig[name]','$directory','$hackconfig[hidden]','$hackconfig[spos]','$hackconfig[listener]','$hackconfig[version]')");
		updatecache_hack();
		
		!empty($hackconfig['listener']) && register_listener(array('file' => "hack/{$directory}/{$hackconfig[listener]}")); //注册监听器
		adminmsg('operate_success');
	}
	else 
	{
		adminmsg('hackcenter_hack_error');
	}
}
elseif($action == "edit")
{
	initvar('step', 'P', 2);
	if($step != 2)
	{
		initvar('directory', 'GP');
		ifcheck($_hack[$directory]['hidden'], 'hidden');
		
		$exists_index = is_file(PHPVOD_ROOT . "hack/$directory/index.php") ? true : false;
		if($exists_index)
			ifcheck($_hack[$directory]['spos'], 'spos', 'select');
	}
	else
	{
		initvar(array('hidden', 'spos'), 'P', 2);
		initvar(array('name', 'directory'), 'P');
		
		if(empty($name))
			adminmsg('hackcenter_name_empty', 'goback');
		
		$db->update("UPDATE pv_hack SET hidden='$hidden',name='$name',spos='$spos' WHERE directory='$directory'");
		updatecache_hack();
		adminmsg('operate_success');
	}
}
elseif($action == "update")
{
	initvar('applyid', 'P', 2);
	$db->update("UPDATE pv_hack SET hidden=0");
	if($applyid = checkselid($applyid))
	{
		$db->update("UPDATE pv_hack SET hidden=1 WHERE hid IN($applyid)");
	}
	updatecache_hack();
	adminmsg('operate_success');
}
elseif($action == 'del')
{
	initvar('directory', 'GP');
	
	//卸载检测
	if(is_file(PHPVOD_ROOT . "hack/$directory/uninstall_check.php"))
	{
		require_once PHPVOD_ROOT . "hack/$directory/uninstall_check.php";
	}	
	
	// 卸载监听器
	if(!empty($_hack[$directory]['listener']))
	{
		$listener = "hack/$directory/{$_hack[$directory]['listener']}";
		$lis = $db->get_one("SELECT id FROM pv_listener WHERE file='$listener'");
		if(!empty($lis)) unregister_listener($lis['id']);
	}	
	
	// 删除数据库表
	if(is_file(PHPVOD_ROOT . "hack/$directory/uninstall.sql"))
		database_revert(PHPVOD_ROOT . "hack/$directory/uninstall.sql");	
	
	// 删除插件记录
	$db->query("DELETE FROM pv_hack WHERE directory='$directory'");
	updatecache_hack();
	
	// 删除文件及数据
	$hackpath = PHPVOD_ROOT . "hack/$directory";
	$datapath = PHPVOD_ROOT . "data/hack/$directory";	
	if(deldir($hackpath) === false || deldir($datapath) === false)
	{
		adminmsg('hackcenter_del_fail', '', array($_hack[$directory]['directory']));
	}
	else
	{
		adminmsg('operate_success');
	}
}
elseif($action == 'parse')
{
	initvar('directory', 'GP');
	updatecache_hack_template($directory);
	adminmsg('operate_success');
}
elseif($action == 'upgrade')
{
	initvar('directory', 'GP');
	
	if(!empty($directory))
	{
		$upgrade_xmlfile = PHPVOD_ROOT . "hack/$directory/upgrade.xml";
		if(is_file($upgrade_xmlfile))
		{
			$upgrade_xml = readover($upgrade_xmlfile);
			$upgrade_info = xml_unserialize($upgrade_xml, true);
		
			if(!empty($upgrade_info['fromversion']) && !empty($upgrade_info['toversion']))
			{
				if($_hack[$directory]['version'] != $upgrade_info['fromversion']) //版本不一致
					adminmsg('hackcenter_upgrade_error', 'goback', array($upgrade_info['fromversion']));
				
				if(!empty($upgrade_info['upgradefile']) && is_file(PHPVOD_ROOT . "hack/$directory/{$upgrade_info[upgradefile]}"))
				{
					$upgradefile = PHPVOD_ROOT . "hack/$directory/{$upgrade_info[upgradefile]}";
					require_once $upgradefile;
					delfile($upgradefile);
				}
				
				$db->update("UPDATE pv_hack SET version='$upgrade_info[toversion]' WHERE directory='$directory'"); //更新版本信息
				updatecache_hack();
			}
			
			delfile($upgrade_xmlfile);
		}
	}
	adminmsg('operate_success');	
}

include gettpl('hackcenter');
?>