<?php
! defined('IN_PHPVOD') && exit('Forbidden');
$php_version = get_php_version();

if(empty($action))
{
	// 获取更新信息
	$re = request_service('update', 'get_update_info', array('version' => $version, 'php_version' => $php_version));
	if($re == -1) adminmsg('curl_error');
	if($re['errno'] == 0) //获取内容成功
	{
		$var = json_decode($re['return'], true);
		if(!is_array($var) || !isset($var['status'])) adminmsg('update_error');
		if($var['status'] == '0') //没有更新
			adminmsg('update_none');
		elseif($var['status'] == '1') //有更新
			$update_info = $var['update_info'];
	}
	else //获取内容失败
	{
		adminmsg('update_error');
	}
}
elseif($action == 'update')
{
	initvar('step', 'G', 0);
	if(empty($step))
	{
		adminmsg('update_step1', "$basename&action=update&step=2");
	}
	elseif($step == '2')
	{
		//获取更新文件
		$re = request_service('update', 'get_update_file', array('version' => $version, 'php_version' => $php_version));
		if($re == -1) adminmsg('curl_error');
		if($re['errno'] == 0) //获取内容成功
		{
			$file = json_decode($re['return'], true);
			if(!is_array($file)) adminmsg('update_error');
			
			$filename = basename($file['url']);
			$localfile = PHPVOD_ROOT . 'data' . DIRECTORY_SEPARATOR . 'update' . DIRECTORY_SEPARATOR . $filename;
			//下载文件
			$r = pv_downfile($file['url'], $localfile);
			if($r < 0) adminmsg('pv_downfile_' . $r, $basename, array('data/update'), 180);
			if(strtolower(md5_file($localfile)) != strtolower($file['md5'])) adminmsg('update_md5_error', $basename, array(), 180);
			adminmsg('update_step2', "$basename&action=update&filename=$filename&step=3");			
		}
		else //获取内容失败
		{
			adminmsg('update_error');
		}		
	}
	elseif($step == '3')
	{
		initvar('filename', 'G', 0);
		$basepath = PHPVOD_ROOT . 'data' . DIRECTORY_SEPARATOR . 'update' . DIRECTORY_SEPARATOR;
		$localfile = $basepath . $filename;

		//解压缩
		$r = pv_unzip($localfile);
		if($r === false) adminmsg('unzip_fail', $basename, array(), 180);
		
		$dirname = substr($filename, 0, strrpos($filename, '.')); //更新包解压缩目录名
		$updatedir = $basepath . $dirname . DIRECTORY_SEPARATOR; //更新包解压缩路径
		
		//检测目录权限
		$cannot_write = check_permission(PHPVOD_ROOT, $updatedir);
		if(!empty($cannot_write))
		{
			delfile($localfile);
			deldir($updatedir);			
			foreach ($cannot_write as $v)
				$p .= '<p>' . $v . '</p>';
			adminmsg('update_cannot_write', $basename, array($p), 3600);
		}
		else 
			adminmsg('update_step3', "$basename&action=update&filename=$filename&step=4");
	}
	elseif($step == '4')
	{	
		initvar('filename', 'G', 0);
		$basepath = PHPVOD_ROOT . 'data' . DIRECTORY_SEPARATOR . 'update' . DIRECTORY_SEPARATOR;
		$localfile = $basepath . $filename;
		$dirname = substr($filename, 0, strrpos($filename, '.'));
		$updatedir = $basepath . $dirname . DIRECTORY_SEPARATOR;
		
		//更新系统文件
		$log = array(
			'file' => $basepath . $dirname. '.log',
			'type' => 'all'
		);
		writeover($log['file'], ''); //初始化日志文件
		pv_copy($updatedir, PHPVOD_ROOT, $log);
		
		//更新数据库
		$sqlfile = PHPVOD_ROOT . 'update' . DIRECTORY_SEPARATOR . 'sql.sql';
		if(is_file($sqlfile)) database_revert($sqlfile);

		//后续操作
		$phpfile = PHPVOD_ROOT . 'update' . DIRECTORY_SEPARATOR . 'php.php';
		if(is_file($phpfile))
		{
			include $phpfile;
		}

		//删除update目录及update.php文件
		if(is_dir(PHPVOD_ROOT . 'update')) deldir(PHPVOD_ROOT . 'update');
		if(is_file(PHPVOD_ROOT . 'update.php')) delfile(PHPVOD_ROOT . 'update.php');
		
		//删除更新目录
		delfile($localfile);
		deldir($updatedir);
		adminmsg('update_success', $basename, array('data/update/' . $dirname . '.log'), 10);
	}
}
include gettpl('update');
?>