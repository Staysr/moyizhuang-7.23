<?php
!defined('IN_PHPVOD') && exit('Forbidden');
require_once (PHPVOD_ROOT . "require/template.php");

function updatecache($array = '')
{
	if(!$array)
	{
		updatecache_config();
		updatecache_class();
		updatecache_nation();
		updatecache_artclass();
		updatecache_group();
		updatecache_level();
		updatecache_style();
		updatecache_advert();
		updatecache_sharelink();
		updatecache_credit();
		updatecache_hack();
		updatecache_listener();
		update_siteinfo(array('newmember', 'totalmember', 'totalvideo'));
		update_video_count();
	}
	else
	{
		foreach($array as $value)
		{
			$value();
		}
	}
}

/**
 * 更新核心设置缓存
 * @param string $pre 需要更新的缓存前缀
 */
function updatecache_config($pre = '')
{
	global $db;
	$config = "<?php\r\n";

	if(empty($pre))
	{
		updatecache_config('db');
		updatecache_config('rg');
	}
	else
	{
		$result = $db->query("SELECT * FROM pv_config WHERE db_name LIKE '{$pre}_%'");
		while(@extract($db->fetch_array($result)))
		{
			$db_name = key_cv($db_name);
			$config .= "\$$db_name = " . pv_var_export($db_value) . ";\r\n";
		}
		$config .= '?>';
	}

	switch($pre)
	{
		case 'db':
			writeover(PHPVOD_ROOT . 'data/cache/config.php', $config);
			break;
		case 'rg':
			writeover(PHPVOD_ROOT . 'data/cache/dbreg.php', $config);
			break;
	}
}

function class_array($cup, &$array)
{
	global $db;
	$query = $db->query("SELECT * FROM pv_class WHERE cup='$cup' ORDER BY vieworder,cid");
	while($row = $db->fetch_array($query))
	{
		$array[$row[cid]] = $row;
		class_array($row['cid'], $array);
	}
}

/**
 * 更新类别缓存
 */
function updatecache_class()
{
	$arr = array();
	class_array(0, $arr);
	$_class = '$_class = ' . pv_var_export($arr) . ';';
	writeover(PHPVOD_ROOT . 'data/cache/class.php', "<?php\r\n" . $_class . "\r\n?>");
}

/*
 * 更新地区缓存
 */
function updatecache_nation()
{
	global $db;
	$arr = array();
	$query = $db->query("SELECT * FROM pv_nations ORDER BY vieworder");
	while($row = $db->fetch_array($query))
	{
		$arr[$row['id']] = $row['subject'];
	}
	$_nation = '$_nation = ' . pv_var_export($arr) . ';';
	writeover(PHPVOD_ROOT . 'data/cache/nation.php', "<?php\r\n" . $_nation . "\r\n?>");
}

/**
 * 更新文档栏目缓存
 */
function updatecache_artclass()
{
	global $db;
	$arr = array();
	$query = $db->query("SELECT * FROM pv_artclass ORDER BY vieworder");
	while($row = $db->fetch_array($query))
	{
		$arr[$row['cid']] = $row['caption'];
	}
	$_artclass = '$_artclass = ' . pv_var_export($arr) . ';';
	writeover(PHPVOD_ROOT . 'data/cache/artclass.php', "<?php\r\n" . $_artclass . "\r\n?>");
}

function updatecache_gp($group)
{
	$group['SYSTEM'] = array();
	if($group['gptype'] == 'system')
	{
		$group['SYSTEM']['allowadmincp'] = $group['allowadmincp'];
		$group['SYSTEM']['allowadminedit'] = $group['allowadminedit'];
		$group['SYSTEM']['allowadmindel'] = $group['allowadmindel'];
		$group['SYSTEM']['allowadminshow'] = $group['allowadminshow'];
		$group['SYSTEM']['permissions'] = $group['permissions'];
	}
	unset($group['allowadmincp'], $group['allowadminedit'], $group['allowadmindel'], $group['allowadminshow'], $group['permissions']);

	$groupcache = '';
	foreach($group as $key => $value)
	{
		if(is_array($value))
		{
			$groupcache .= "\${$key}=" . pv_var_export($value) . ";\r\n";
		}
		else
		{
			$groupcache .= "\$gp_$key=" . pv_var_export($value) . ";\r\n";
		}
	}

	writeover(PHPVOD_ROOT . "data/groupdb/group_$group[gid].php", "<?php\r\n" . $groupcache . "?>");
}

/**
 * 更新用户组缓存
 */
function updatecache_group($gid = array())
{
	global $db;
	$sql = '';
	if(!empty($gid) && is_array($gid))
	{
		$sql .= ' AND gid IN(' . checkselid($gid) . ')';
	}
	elseif(is_numeric($gid))
	{
		$sql .= " AND gid='$gid'";
	}
	else
	{
		$sql .= " AND (ifdefault='0' OR gid='1')";
	}
	$gdb = array();
	$query = $db->query("SELECT * FROM pv_usergroups WHERE 1 $sql");
	while($rt = $db->fetch_array($query))
	{
		$gdb[$rt['gid']] = $rt;
	}
	if(empty($gdb))
	{
		return;
	}
	foreach($gdb as $key => $group)
	{
		updatecache_gp($group);
	}
}

/**
 * 更新用户组等级缓存
 */
function updatecache_level()
{
	global $db;
	$query = $db->query("SELECT gid,gptype,grouptitle,groupimg,grouppost FROM pv_usergroups ORDER BY grouppost,gid");
	$defaultdb = "\$ltitle=\$lpic=\$lneed=array();\r\n/**\r\n* default\r\n*/\r\n";
	$sysdb = "\r\n/**\r\n* system\r\n*/\r\n";
	$memdb = "\r\n/**\r\n* member\r\n*/\r\n";
	$specdb = "\r\n/**\r\n* special\r\n*/\r\n";
	while(@extract($db->fetch_array($query)))
	{
		$gid = (int)$gid;
		if($gptype == 'member')
		{
			$memdb .= "\$ltitle[$gid]=" . pv_var_export($grouptitle) . ";\t\t\$lpic[$gid]=" . pv_var_export($groupimg) . ";\t\t\$lneed[$gid]=" . pv_var_export($grouppost) . ";\t\t\$ltype[$gid]=" . pv_var_export($gptype) . ";\r\n";
		}
		elseif($gptype == 'system')
		{
			$sysdb .= "\$ltitle[$gid]=" . pv_var_export($grouptitle) . ";\t\t\$lpic[$gid]=" . pv_var_export($groupimg) . ";\t\t\$ltype[$gid]=" . pv_var_export($gptype) . ";\r\n";
		}
		elseif($gptype == 'default')
		{
			$defaultdb .= "\$ltitle[$gid]=" . pv_var_export($grouptitle) . ";\t\t\$lpic[$gid]=" . pv_var_export($groupimg) . ";\t\t\$ltype[$gid]=" . pv_var_export($gptype) . ";\r\n";
		}
		elseif($gptype == 'special')
		{
		    $specdb .= "\$ltitle[$gid]=" . pv_var_export($grouptitle) . ";\t\t\$lpic[$gid]=" . pv_var_export($groupimg) . ";\t\t\$ltype[$gid]=" . pv_var_export($gptype) . ";\r\n";
		}
	}
	writeover(PHPVOD_ROOT . 'data/cache/level.php', "<?php\r\n" . $defaultdb . $sysdb . $specdb . $memdb . "\r\n?>");
}

/**
 * 更新风格缓存
 */
function updatecache_style($name = '')
{
	global $db;
	if($name != '') $sqlwhere = "WHERE name='$name'"; else $sqlwhere = '';
	$query = $db->query("SELECT * FROM pv_styles $sqlwhere");
	while($row = $db->fetch_array($query))
	{
		$stylecontent = "\$stylename = " . pv_var_export($row['name']) . ";\r\n\$stylepath = " . pv_var_export($row['stylepath']) . ";\r\n\$tplpath = " . pv_var_export($row['tplpath']) . ";";
		writeover(PHPVOD_ROOT . "data/style/{$row[name]}.php", "<?php\r\n" . $stylecontent . "\r\n?>");
	}
}

/**
 * 更新广告缓存
 */
function updatecache_advert()
{
	global $db;
	$advert = array();
	$query = $db->query("SELECT * FROM pv_advert ORDER BY id ASC");
	while($row = $db->fetch_array($query))
	{
		$config = unserialize($row['config']);
		$id = $row['id'];
		$ckey = $row['ckey'];
		$advert[$ckey][$id] = $config;
	}
	writeover(PHPVOD_ROOT . 'data/cache/advert.php', "<?php\r\n\$advert = " . pv_var_export($advert) . ";\r\n?>");
}

/**
 * 更新友情链接缓存
 */
function updatecache_sharelink()
{
	global $db;
	$sharelink1 = '';
	$sharelink2 = '';
	$query = $db->query("SELECT * FROM pv_sharelinks ORDER BY threadorder");
	while(@extract($db->fetch_array($query)))
	{
		if($logo)
		{
			$sharelink1 .= "<a href=\"$url\" target=_blank><img src=\"$logo\" alt=\"$descrip\" width=\"88\" height=\"31\"></a> ";
		}
		else
		{
			$sharelink2 .= "<a href=\"$url\" target=\"_blank\" title=\"$descrip\">$name</a> ";
		}
	}

	$sharelink = $sharelink2;
	if(!empty($sharelink1))
	{
		$sharelink .= empty($sharelink) ? $sharelink1 : '<br />' . $sharelink1;
	}

	writeover(PHPVOD_ROOT . 'data/cache/sharelink.php', "<?php\r\n\$_sharelink = " . pv_var_export($sharelink) . ";\r\n?>");
}

/**
 * 更新不良词语缓存
 */
function updatecache_bwd($bwddb)
{
	$str = '';
	foreach($bwddb as $bwd)
	{
		$bwd != '' && $str .= pv_var_export($bwd) . ",";
	}
	$cache = "<?php\r\n\$_bwddb = array($str);\r\n?>";
	writeover(PHPVOD_ROOT . 'data/cache/bwd.php', $cache);
}

/**
 * 更新会员组头衔
 */
function updatecache_memberid()
{
	global $db;
	$result = $db->query("SELECT uid FROM pv_members WHERE 1");
	while($u = $db->fetch_array($result))
	{
		update_memberid($u['uid']);
	}
}

/**
 * 更新自定义积分缓存
 */
function updatecache_credit()
{
	global $db;
	$credits = array();
	$query = $db->query("SELECT * FROM  pv_credits ORDER BY cid");
	while($row = $db->fetch_array($query))
	{
		$credits[$row['cid']] = $row;
	}
	$_creditdb = '$_creditdb = ' . pv_var_export($credits) . ';';
	writeover(PHPVOD_ROOT . "data/cache/creditdb.php", "<?php\r\n" . $_creditdb . "\r\n?>");
}

/**
 * 更新模板缓存
 */
function updatecache_template($ext = 'htm')
{
	function fun($tplpath, $ext, $type = 'style')
	{
		if($type == 'style')
			$tpldir = PHPVOD_ROOT . 'template' . DIRECTORY_SEPARATOR . $tplpath . DIRECTORY_SEPARATOR;
		elseif($type == 'mobile')
			$tpldir = PHPVOD_MOBILE_ROOT . 'template' . DIRECTORY_SEPARATOR . $tplpath . DIRECTORY_SEPARATOR;

		$fp = @opendir($tpldir);
		if($fp)
		{
			while($tplfile = readdir($fp))
			{
				if(preg_match("/\.{$ext}$/i", $tplfile))
				{
					$tplfile = basename($tplfile, ".{$ext}");
					parse_template($tplpath, $tplfile, $ext, $type);
				}

			}
			closedir($fp);
		}
	}
	global $db_defaultstyle;
	include_once PHPVOD_ROOT . "data/style/{$db_defaultstyle}.php";
	fun($tplpath, $ext);
	fun($tplpath, $ext, 'mobile');
}

/**
 * 更新插件模板缓存
 */
function updatecache_hack_template($tplpath, $EXT = 'htm')
{
	$fp = @opendir(PHPVOD_ROOT . "hack/$tplpath/template/");
	if($fp)
	{
		while($tplfile = readdir($fp))
		{
			if(preg_match("/\.{$EXT}$/i", $tplfile))
			{
				$tplfile = basename($tplfile, ".{$EXT}");
				parse_template($tplpath, $tplfile, $EXT, "hack");
			}

		}
		closedir($fp);
	}
}

/**
 * 更新插件缓存
 */
function updatecache_hack()
{
	global $db;
	$hackdb = array();
	$query = $db->query("SELECT * FROM pv_hack ORDER BY hid ASC");
	while($hack = $db->fetch_array($query))
	{
		$hackdb[$hack['directory']] = $hack;
	}
	$_hack = '$_hack = ' . pv_var_export($hackdb) . ';';
	writeover(PHPVOD_ROOT . 'data/cache/hack.php', "<?php\r\n" . $_hack . "\r\n?>");
}

/**
 * 更新监听器缓存
 */
function updatecache_listener()
{
	global $db;
	$listenerdb = array();
	$query = $db->query("SELECT * FROM pv_listener ORDER BY callorder DESC,id ASC");
	while($row = $db->fetch_array($query))
	{
		$listenerdb[$row['id']] = $row;
	}
	writeover(PHPVOD_ROOT . 'data/cache/listener.php', "<?php\r\n\$_listener = " . pv_var_export($listenerdb) . ";\r\n?>");
}
?>