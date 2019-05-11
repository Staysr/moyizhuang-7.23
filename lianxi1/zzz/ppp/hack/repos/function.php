<?php
!defined('IN_PHPVOD') && exit('Forbidden');
file_exists(PHPVOD_HACK_ROOT . 'cache/config.php') && include_once (PHPVOD_HACK_ROOT . 'cache/config.php');
file_exists(PHPVOD_HACK_ROOT . 'function.ext.php') && include_once (PHPVOD_HACK_ROOT . 'function.ext.php');

/**
 * 导入新视频
 * @param array $video 视频信息
 * @return int -1栏目未绑定；-2地区未绑定；-3播放器未绑定；-4影片URL解析错误；-5存在同名影片并已忽略；大于0则为入库后的视频ID
 */
function import_video($video)
{
	global $db, $timestamp, $admin, $col_samename, $col_random_userinfo, $col_random_hits_min, $col_random_hits_max, $col_random_postdate_start, $col_random_postdate_end;

	//class
	$cid = get_id($video['class'], 'class', $video['rid']);
	if(!is_null($cid))
		$video['cid'] = $cid;
	else
		return -1;

	//nation
	$nid = get_id($video['nation'], 'nation', $video['rid']);
	if(!is_null($nid))
		$video['nid'] = $nid;
	else
		return -2;

	//player
	$pflag = false;
	$url_format = array();
	$url = json_decode($video['url'], true);
	if(!empty($url))
	{
		foreach($url as $key => $value)
		{
			$pid = get_id($key, 'player', $video['rid']);
			if(is_null($pid))
			{
				$pflag = true;
				break;
			}
			$urlstring = trim(implode("\r\n", $value));
			$url_format[] = array('pid' => $pid, 'player' => $key, 'url' => $urlstring, 'serialise' => count($value));
		}
	}
	else
	{
		return -4;
	}
	if($pflag) return -3;

	$pv_video = check_same_video($video); //检测是否存在相同影片
	if(!is_null($pv_video) && $col_samename != '4') //已存在同名影片并且不是“正常入库”
	{
		$vid = $pv_video['vid']; //同名影片ID
		$serialise = $pv_video['serialise']; //同名影片连载状态
		if(!isset($col_samename) || !is_numeric($col_samename) || $col_samename < 1 || $col_samename > 4) $col_samename = 1;
		if($col_samename == '1' || $col_samename == '2')
		{
			if($col_samename == '1') //添加播放来源
			{
				$last_playgroup = get_last_playgroup($vid);
				if($last_playgroup === false)
					$playgroup = 1;
				else
					$playgroup = $last_playgroup + 1;
			}
			elseif($col_samename == '2') //覆盖源地址(如果影片有多个播放组也一起被覆盖)
			{
				$playgroup = 1;
				$db->update("DELETE FROM pv_urls WHERE vid='$vid'");
			}

			$json_playgroup = array();
			foreach($url_format as $u)
			{
				$db->update("INSERT INTO pv_urls(vid,pid,url,playgroup) VALUES ('$vid','$u[pid]','$u[url]','$playgroup')");
				$urlid = $db->insert_id();
				$json_playgroup[$u['player']] = $urlid;
				if($video['serialise_flag'] == '1' && $u['serialise'] > $serialise) $serialise = $u['serialise']; //更新连载标识
				$playgroup++;
			}
			$json_playgroup = pv_json_encode($json_playgroup);
			$db->update("UPDATE pv_video SET lastdate='$timestamp',serialise='$serialise' WHERE vid='$vid'"); //更新最后更新时间与连载标识
			$db->update("INSERT INTO pv_repos(rid,rvid,vid,playgroup,lasttime) VALUES('$video[rid]','$video[id]','$vid','$json_playgroup','$video[lasttime]')");
		}
		elseif($col_samename == '3') //忽略
		{
			return -5;
		}
	}
	else //新影片或同名影片“正常入库”
	{
		//随机用户名
		if(empty($col_random_userinfo))
		{
			$author = $admin['username'];
			$authorid = $admin['uid'];
		}
		else
		{
			$ulist = unserialize($col_random_userinfo);
			$i = array_rand($ulist);
			$author = $ulist[$i]['username'];
			$authorid = $ulist[$i]['uid'];
		}

		//随机点击数
		if(is_numeric($col_random_hits_min) && is_numeric($col_random_hits_max))
			$hits = rand($col_random_hits_min, $col_random_hits_max);
		else
			$hits = 0;

		//随机发布时间
		if(is_numeric($col_random_postdate_start) && is_numeric($col_random_postdate_end))
		{
			$time = rand($col_random_postdate_start, $col_random_postdate_end);
			$videotime = $time;
		}
		else
		{
			$videotime = $timestamp;
		}

		$db->update("INSERT INTO pv_video(cid,nid,author,authorid,postdate,lastdate,subject,pic,playactor,director,year,memo,hits,yz)
			VALUES('$video[cid]','$video[nid]','$author','$authorid','$videotime','$videotime','$video[subject]','$video[pic]','$video[playactor]','$video[director]','$video[year]','$video[memo]','$hits','1')
			");

		$vid = $db->insert_id();
		$db->update("INSERT INTO pv_videodata SET vid='$vid',synopsis='$video[content]'");

		$serialise = 0;
		$playgroup = 1;
		$json_playgroup = array();
		foreach($url_format as $u)
		{
			$db->update("INSERT INTO pv_urls(vid,pid,url,playgroup) VALUES ('$vid','$u[pid]','$u[url]','$playgroup')");
			$urlid = $db->insert_id();
			$json_playgroup[$u['player']] = $urlid;
			if($video['serialise_flag'] == '1' && $u['serialise'] > $serialise) $serialise = $u['serialise']; //更新连载标识
			$playgroup++;
		}
		$json_playgroup = pv_json_encode($json_playgroup);
		if($serialise > 0) //连载
			$db->update("UPDATE pv_video SET serialise='$serialise' WHERE vid='$vid'");
		$db->update("INSERT INTO pv_repos(rid,rvid,vid,playgroup,lasttime) VALUES('$video[rid]','$video[id]','$vid','$json_playgroup','$video[lasttime]')");
	}

	return $vid;
}

/**
 * 更新影片
 * @param array $video 采集到的影片信息
 * @param array $pv_video pv中的影片信息
 * @param array $rc pv_repos表中的关联记录
 * @return int 0不需要更新；大于0更新成功的视频ID
 */
function update_video($video, $pv_video, $rc)
{
	global $db, $timestamp, $col_update_subject, $col_update_pic, $col_update_playactor, $col_update_director, $col_update_year, $col_update_memo, $col_update_content;

	$vid = $pv_video['vid'];
	$serialise = $pv_video['serialise'];

	//根据lasttime判断是否需要更新
	if($rc['lasttime'] == $video['lasttime'])
		return 0;

	//更新连载影片时需要更新的字段
	$sql = '';
	$col_update_subject == 1 && $sql .= " subject='$video[subject]',";
	$col_update_pic == 1 && $sql .= " pic='$video[pic]',";
	$col_update_playactor == 1 && $sql .= " playactor='$video[playactor]',";
	$col_update_director == 1 && $sql .= " director='$video[director]',";
	$col_update_year == 1 && $sql .= "year='$video[year]',";
	$col_update_memo == 1 && $sql .= " memo='$video[memo]',";

	//更新pv_video
	$db->update("UPDATE pv_video SET{$sql} lastdate='$timestamp' WHERE vid='$vid'");

	//更新pv_videodata
	if($col_update_content == 1)
		$db->update("UPDATE pv_videodata SET synopsis='$video[content]' WHERE vid='$vid'");

	//更新pv_urls
	$relate = json_decode($rc['playgroup'], true);
	$url = json_decode($video['url'], true);
	foreach($url as $key => $value)
	{
		$urlstring = trim(implode("\r\n", $value));
		if(isset($relate[$key])) //播放组已关联
		{
			$urlid = $relate[$key];
			$db->update("UPDATE pv_urls SET url='$urlstring' WHERE uid='$urlid'");
			if(count($value) > $serialise) $serialise = count($value); //更新连载标识
		}
		else //未关联
		{
			//playgroup
			$last_playgroup = get_last_playgroup($vid);
			if($last_playgroup === false)
				$playgroup = 1;
			else
				$playgroup = $last_playgroup + 1;

			//pid
			$pid = get_id($key, 'player', $video['rid']);
			if(!is_null($pid))
			{
				$db->update("INSERT INTO pv_urls(vid,pid,url,playgroup) VALUES ('$vid','$pid','$urlstring','$playgroup')");
				$urlid = $db->insert_id();
				$relate[$key] = $urlid;
				if(count($value) > $serialise) $serialise = count($value); //更新连载标识
			}
		}
	}

	//更新关联数据
	$json_playgroup = pv_json_encode($relate);
	$db->update("UPDATE pv_repos SET playgroup='$json_playgroup',lasttime='$video[lasttime]' WHERE id='$rc[id]'");

	//连载
	if($video['serialise_flag'] == '1')
		$db->update("UPDATE pv_video SET serialise='$serialise' WHERE vid='$vid'");
	else
		$db->update("UPDATE pv_video SET serialise='0' WHERE vid='$vid'");

	return $vid;
}

/**
 * 影片入库
 * @param array $video 影片数据数组
 * @return array
 */
function import($video)
{
	global $db;
	array_cv($video);
	if(empty($video)) return array('key' => 'import_empty', 'status' => '0');

	$rc = $db->get_one("SELECT * FROM pv_repos WHERE rid='$video[rid]' AND rvid='$video[id]'");
	if(empty($rc)) //新影片
	{
		$r = import_video($video);
		return array('key' => 'import_video', 'status' => $r);
	}
	else //更新影片
	{
		$pv_video = $db->get_one("SELECT * FROM pv_video WHERE vid='$rc[vid]'"); //检测关联视频是否存在
		if(empty($pv_video))
		{
			$db->update("DELETE FROM pv_repos WHERE id='$rc[id]'"); //删除关联
			$r = import_video($video);
			return array('key' => 'import_video', 'status' => $r);
		}
		else
		{
			$r = update_video($video, $pv_video, $rc);
			return array('key' => 'update_video', 'status' => $r);
		}
	}
}

/**
 * 根据文字获取绑定的ID
 * @param string $str 文字字符串
 * @param string $type 绑定的类型（class/nation/player）
 * @param int $rid 资源库ID
 * @return Ambigous <NULL, string> 返回绑定ID，没有绑定时返回null
 */
function get_id($str, $type, $rid)
{
	$r = null;
	$replace_list = array();
	if(in_array($type, array('class', 'nation', 'player')))
	{
		$filepath = PHPVOD_HACK_ROOT . 'cache' . DIRECTORY_SEPARATOR . 'r' . $rid . '_replace' . $type . '.php';
		if(is_file($filepath))
		{
			include $filepath;
		}
	}

	foreach($replace_list as $item)
	{
		if($item['str1'] == $str)
		{
			$r = $item['str2'];
			break;
		}
	}

	return $r;
}

/**
 * 检测PHPVOD中是否存在相同的影片
 * @param array $video 采集到的影片资料
 * @return Ambigous <NULL, array>如果找到相同影片，则返回影片数据数组，否则返回NULL
 */
function check_same_video($video)
{
	global $db, $col_compare_cid, $col_compare_nid, $col_compare_director, $col_compare_playactor, $col_compare_year, $col_compare_memo;
	$r = null;
	$query = $db->query("SELECT * FROM pv_video WHERE subject='$video[subject]'");
	while($row = $db->fetch_array($query))
	{
		if($col_compare_cid == '1' && $video['cid'] != $row['cid']) continue;
		if($col_compare_nid == '1' && $video['nid'] != $row['nid']) continue;
		if($col_compare_director == '1' && (empty($video['director']) || $video['director'] != $row['director'])) continue;
		if($col_compare_playactor == '1')
		{
			$playactor_check = false;
			if(!empty($video['playactor']))
			{
				$playdb = pv_explode(array(',', '/', ' '), $video['playactor']);
				foreach($playdb as $value)
				{
					if(strpos($row['playactor'], $value) !== false)
					{
						$playactor_check = true;
						break;
					}
				}
			}
			if($playactor_check == false) continue;
		}
		if($col_compare_year == '1' && (empty($video['year']) || $video['year'] != $row['year'])) continue;
		if($col_compare_memo == '1' && (empty($video['memo']) || $video['memo'] != $row['memo'])) continue;

		$r = $row;
		break;
	}
	return $r;
}

/**
 * 获取视频最后一个播放组的序号
 * @param int $vid 视频ID
 * @return mixed 返回播放组序号，失败返回false
 */
function get_last_playgroup($vid)
{
	global $db;
	$max = $db->get_one("SELECT MAX(playgroup) as sm FROM pv_urls WHERE vid='$vid'");
	if($max['sm'] > 0)
		return $max['sm'];
	else
		return false;
}

/**
 * 保存采集进度
 * @param int $rid 资源库ID
 * @param array $data 进度数据
 */
function save_progress($rid, $data)
{
	$progress_file = PHPVOD_HACK_ROOT . 'cache' . DIRECTORY_SEPARATOR . 'r' . $rid . '_progress.php';
	$progress_data = "<?php \r\n\$progress = " . pv_var_export($data) . ";\r\n?>";
	writeover($progress_file, $progress_data);
}

/**
 * 删除进度文件
 * @param int $rid 资源库ID
 */
function del_progress($rid, $type = 'collect')
{
	$progress_file = PHPVOD_HACK_ROOT . 'cache' . DIRECTORY_SEPARATOR . 'r' . $rid . '_progress.php';
	if(is_file($progress_file))
		delfile($progress_file);
}

/**
 * 更新插件设置缓存
 * @param int $return 设置为0则将缓存写入文件，否则直接输出。(默认值为0)
 */
function updatecache_collect($return = 0)
{
	global $db;
	$col = '';
	$query = $db->query("SELECT * FROM pv_hackvar WHERE hk_name LIKE 'col\_%'");
	while($row = $db->fetch_array($query))
	{
		$hk_name = key_cv($row['hk_name']);
		$col .= '$' . $hk_name . ' = ' . pv_var_export($row['hk_value']) . ";\r\n";
	}

	if($return)
		return $col;
	else
		writeover(PHPVOD_HACK_ROOT . 'cache/config.php', "<?php\r\n" . $col . '?>');
}
?>
