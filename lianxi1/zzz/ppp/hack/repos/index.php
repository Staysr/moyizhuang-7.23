<?php
set_time_limit(0);
ignore_user_abort(true);
!defined('IN_PHPVOD') && exit('Forbidden');
require_once PHPVOD_HACK_ROOT . 'function.php';

initvar('action', 'GP', 0);
if($action == 'test')
{
	echo '1';
}
elseif($action == 'update')
{
	ob_end_clean(); //关闭并清空输出缓存区
	ob_start();
	define('PHPVOD_SERVICE_URL', 'service.phpvod.com');
	$fromip = $_SERVER['REMOTE_ADDR'];
	$phpvod_service_ip = gethostbyname(PHPVOD_SERVICE_URL);

	if(empty($fromip) || empty($phpvod_service_ip) || $fromip != $phpvod_service_ip)
	{
		$status = '-2'; //数据来路非法
	}
	else 
	{
		initvar('data', 'P', 0);
		initvar('rid', 'P', 2);				
		$data = stripslashes($data);
		$video_list = json_decode($data, true);
		if(!empty($video_list))
			$status = '1'; //数据正确
		else 
			$status = '-1'; //数据解析失败
	}
	echo $status;

	finish_request(); //请求完成

	//导入数据
	$vl = array();
	if($status == '1')
	{
		//记录统计初始化
		$record = array('new' => 0, 'serialise' => 0, 'timestamp' => $timestamp);
		
		//获取管理员资料
		if(empty($col_random_userinfo))
			$admin = $db->get_one("SELECT uid,username FROM pv_members WHERE groupid='3' ORDER BY uid ASC LIMIT 1");
		
		foreach ($video_list as $video)
		{
			$video['rid'] = $rid;
			$r = import($video);
		
			//记录统计
			if($r['key'] == 'import_video' && $r['status'] > 0) $record['new']++;
			if($r['key'] == 'update_video' && $r['status'] > 0) $record['serialise']++;
		
			if($r['status'] > 0) $vl[] = $r['status'];
		}
		
		update_siteinfo(array('totalvideo'));
		
		$log = serialize($record);
		$db->update("INSERT INTO pv_reposlog(rid,log) VALUES('$rid', '$log')");
	}
	
	//下载图片、更新缓存依赖
	$selid = checkselid($vl);
	if(!empty($selid))
	{
		$result = $db->query("SELECT v.vid, v.cid, v.pic, r.id, r.downpic FROM pv_video AS v LEFT JOIN pv_repos AS r ON v.vid=r.vid WHERE v.vid IN($selid)");
		while($row = $db->fetch_array($result))
		{
			//下载图片
			if($col_downpic_auto == '1' && $row['downpic'] == '0')
			{
				if(!empty($row['pic']))
				{
					$r = import_video_pic($row['vid'], $row['pic']);
					if($r)
						$db->update("UPDATE pv_repos SET downpic='1' WHERE id='$row[id]'");
					else
						$db->update("UPDATE pv_repos SET downpic='2' WHERE id='$row[id]'"); //downpic设置为2，防止重复下载
				}
				else 
				{
					$db->update("UPDATE pv_repos SET downpic='2' WHERE id='$row[id]'"); //downpic设置为2，防止重复下载
				}
			}
			
			//更新缓存依赖
			$cs->delete('videoinfo_' . $row['vid']);
			$cs->delete('videourl_' . $row['vid']);
			$cd->refresh_depend_lasttime('cid', $row['cid']);
		}
	}	
}

function finish_request()
{
	if(function_exists('fastcgi_finish_request'))
	{
		fastcgi_finish_request();
	}
	else
	{
		header('X-Accel-Buffering: no');
		header('Content-Length: '. ob_get_length());
		header("Connection: Close");
		header("HTTP/1.1 200 OK");
		ob_end_flush();
		flush();
	}
}
?>