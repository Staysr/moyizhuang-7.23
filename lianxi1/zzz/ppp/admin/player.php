<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$playerdb = array();
	$query = $db->query("SELECT * FROM pv_player ORDER BY pid");
	while($player = $db->fetch_array($query))
	{
		$playerdb[] = $player;
	}
}
elseif($action == "add")
{
	initvar('step', 'P', 2);
	if($step == '2')
	{
		initvar(array('name', 'subject'), 'P');
		initvar(array('playpath', 'content'), 'P', 0);
		initvar('hidden', 'P', 2);
		$content = stripslashes($content);

		if(empty($name) || empty($content) || empty($playpath)) adminmsg('operate_fail');
		$playpath .= '.htm';
		if(is_file(PHPVOD_ROOT . 'data/player/' . $playpath)) adminmsg('player_file_exists', 'goback', array($playpath));
		writeover(PHPVOD_ROOT . 'data/player/' . $playpath, $content);
		if(is_file(PHPVOD_ROOT . 'data/player/' . $playpath))
		{
			$db->update("INSERT INTO pv_player (hidden,name,subject,playpath) VALUES ('$hidden','$name','$subject','$playpath');");
			adminmsg('operate_success');
		}
		else
		{
			adminmsg('player_error', 'goback');
		}
	}
}
elseif($action == "edit")
{
	initvar('step', 'P', 2);
	if($step != '2')
	{
		initvar('pid', 'G', 2);
		$player = $db->get_one("SELECT * FROM pv_player WHERE pid='$pid'");
		!$player && adminmsg('player_not_exists');
		ifcheck($player['hidden'], 'hidden');
		$content = readover(PHPVOD_ROOT . 'data/player/' . $player['playpath']);
		$player['playpath'] = trim($player['playpath'], '.htm');
	}
	else
	{
		initvar(array('name', 'subject'), 'P');
		initvar(array('playpath', 'content'), 'P', 0);
		initvar(array('hidden', 'pid'), 'P', 2);
		$content = stripslashes($content);

		if(empty($name) || empty($content) || empty($playpath)) adminmsg('operate_fail');
		$playpath .= '.htm';

		$player = $db->get_one("SELECT playpath FROM pv_player WHERE pid='$pid'");
		if($player['playpath'] != $playpath)
		{
			if(is_file(PHPVOD_ROOT . 'data/player/' . $playpath)) adminmsg('player_file_exists', 'goback', array($playpath));
			rename(PHPVOD_ROOT . 'data/player/' . $player['playpath'], PHPVOD_ROOT . 'data/player/' . $playpath);
		}
		writeover(PHPVOD_ROOT . 'data/player/' . $playpath, $content);
		$db->update("UPDATE pv_player SET hidden='$hidden',name='$name',subject='$subject',playpath='$playpath' WHERE pid='$pid'");
		adminmsg('operate_success');
	}
}
elseif($action == "del")
{
	initvar(array('selid','applyid'), 'P', 2);
	if(!empty($selid))
	{
		foreach($selid as $pid)
		{
			$player = $db->get_one("SELECT playpath FROM pv_player WHERE pid='$pid'");
			delfile(PHPVOD_ROOT . 'data/player/' . $player['playpath']);
			delfile(PHPVOD_MOBILE_ROOT . 'data/player/' . $player['playpath']);
			$db->update("DELETE FROM pv_player WHERE pid='$pid'");
		}
	}
	$db->update("UPDATE pv_player SET hidden=0");
	if($idstr = checkselid($applyid))
	{
		$db->update("UPDATE pv_player SET hidden=1 WHERE pid IN($idstr)");
	}
	adminmsg('operate_success');
}
elseif($action == "playerlist")
{
	// 获取播放器列表
	$re = request_service('player', 'get_player_list');
	if($re == -1) adminmsg('curl_error');
	if($re['errno'] == 0) //获取内容成功
	{
		$playerlist = json_decode($re['return'], true);
	}
	else //获取内容失败
	{
		adminmsg('player_list_error');
	}
}
elseif($action == 'install')
{
	initvar('step', 'G', 0);
	if(empty($step))
	{
		initvar('pid', 'G', 2);
		adminmsg('player_install_step1', "$basename&action=install&pid=$pid&step=2");
	}	
	elseif($step == '2')
	{
		initvar('pid', 'G', 2);
		$re = request_service('player', 'get_player_info', array('pid' => $pid));
		if($re == -1) adminmsg('curl_error');
		if($re['errno'] == 0) //获取内容成功
		{
			$playerinfo = json_decode($re['return'], true);
			if(!is_array($playerinfo)) adminmsg('player_info_error'); //检测数据是否有效
			$url = $playerinfo['file']['url'];
			$md5 = $playerinfo['file']['md5'];
			$filename = basename($url);
			$localfile = PHPVOD_ROOT . 'data' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . $filename;
			$r = pv_downfile($url, $localfile); //下载文件
			if($r < 0) adminmsg('pv_downfile_' . $r, $basename, array('data/temp'), 180);
			if(strtolower(md5_file($localfile)) != strtolower($md5)) adminmsg('player_install_md5_error', $basename, array(), 180);			
			
			//将播放器信息写入缓存文件
			unset($playerinfo['file'], $playerinfo['datetime']);
			$data = "<?php\r\n\$playerinfo = " . pv_var_export($playerinfo) . ";\r\n?>";
			writeover(PHPVOD_ROOT . 'data/temp/playerinfo.php', $data);
			
			adminmsg('player_install_step2', "$basename&action=install&filename=$filename&step=3");
		}
		else //获取内容失败
		{
			adminmsg('player_info_error');
		}		
	}
	elseif($step == '3')
	{
		initvar('filename', 'G', 0);
		$basepath = PHPVOD_ROOT . 'data' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;
		$localfile = $basepath . $filename;
		
		//解压缩
		$r = pv_unzip($localfile);
		if($r === false) adminmsg('unzip_fail', $basename, array(), 180);
		
		$dirname = substr($filename, 0, strrpos($filename, '.')); //播放器包解压缩目录名
		$playerdir = $basepath . $dirname . DIRECTORY_SEPARATOR; //播放器包解压缩路径

		//检测PC端播放器权限
		$player_pc_dir = $playerdir . 'pc' . DIRECTORY_SEPARATOR;
		$pc_cannot_write = array();
		if(is_dir($player_pc_dir))
			$pc_cannot_write = check_permission(PHPVOD_ROOT . 'data/player/', $player_pc_dir);
		foreach ($pc_cannot_write as $k => $v)
			$pc_cannot_write[$k] = $v == '/' ? 'data/player/' : 'data/player/' . $v;

		//检测mobile端播放器权限
		$player_mobile_dir = $playerdir . 'mobile' . DIRECTORY_SEPARATOR;
		$mobile_cannot_write = array();
		if(is_dir($player_mobile_dir))
			$mobile_cannot_write = check_permission(PHPVOD_MOBILE_ROOT . 'data/player/', $player_mobile_dir);
		foreach($mobile_cannot_write as $k => $v)
			$mobile_cannot_write[$k] = $v == '/' ? $db_mobiledirname . '/data/player/' : $db_mobiledirname . '/data/player/' . $v;

		//合并数组
		$cannot_write = array_merge($pc_cannot_write, $mobile_cannot_write);
		if(!empty($cannot_write))
		{
			delfile(PHPVOD_ROOT . 'data/temp/playerinfo.php');
			delfile($localfile);
			deldir($playerdir);
			foreach ($cannot_write as $v)
				$p .= '<p>' . $v . '</p>';
			adminmsg('player_install_cannot_write', $basename, array($p), 3600);
		}
		else
			adminmsg('update_step3', "$basename&action=install&filename=$filename&step=4");		
	}
	elseif($step == '4')
	{
		initvar('filename', 'G', 0);
		include PHPVOD_ROOT . 'data/temp/playerinfo.php';
		$basepath = PHPVOD_ROOT . 'data' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;
		$localfile = $basepath . $filename;
		$dirname = substr($filename, 0, strrpos($filename, '.')); //播放器包解压缩目录名
		$playerdir = $basepath . $dirname . DIRECTORY_SEPARATOR; //播放器包解压缩路径				
		
		//更新系统文件
		$log = array(
			'file' => $basepath . $dirname . '.log',
			'type' => 'all'
		);
		writeover($log['file'], ''); //初始化日志文件
		
		//安装PC端播放器
		$player_pc_dir = $playerdir . 'pc' . DIRECTORY_SEPARATOR;
		if(is_dir($player_pc_dir))
			pv_copy($player_pc_dir, PHPVOD_ROOT . 'data' . DIRECTORY_SEPARATOR . 'player' . DIRECTORY_SEPARATOR, $log);
		
		//安装mobile端播放器
		$player_mobile_dir = $playerdir . 'mobile' . DIRECTORY_SEPARATOR;
		if(is_dir($player_mobile_dir))
			pv_copy($player_mobile_dir, PHPVOD_MOBILE_ROOT . 'data' . DIRECTORY_SEPARATOR . 'player' . DIRECTORY_SEPARATOR, $log);
		
		//更新数据库
		$db->if_update("SELECT pid FROM pv_player WHERE playpath='$playerinfo[playpath]'",
			"UPDATE pv_player SET name='$playerinfo[name]',subject='$playerinfo[subject]' WHERE playpath='$playerinfo[playpath]'",
			"INSERT INTO pv_player(name,subject,playpath,hidden) VALUES('$playerinfo[name]','$playerinfo[subject]','$playerinfo[playpath]','1')"
		);		
	
		//删除更新目录
		delfile(PHPVOD_ROOT . 'data/temp/playerinfo.php');
		delfile($localfile);
		deldir($playerdir);
		adminmsg('player_install_success', $basename, array('data/temp/' . $dirname . '.log'), 10);
	}	
}
include gettpl('player');
?>