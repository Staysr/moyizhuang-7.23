<?php
!defined('IN_PHPVOD') && exit('Forbidden');
@set_time_limit(0);
$basename = $admin_file . '?adminjob=bakup'; //兼容性处理

if($admintype == 'bakout')
{
	initvar('submit', 'GP', 2);
	if($submit != 1)
	{
		require_once (PHPVOD_ROOT . 'admin/table.php');
	}
	else
	{
		initvar(array('step', 'tableid', 'start', 'sizelimit'), 'GP', 2);
		initvar(array('tabledb', 'pre', 'tablesel'), 'GP');

		$bak = "# --------------------------------------------------------\n# PHPvod Backup File\n# Version: " . $version . "\n# Time: " . get_date($timestamp, 'Y-m-d H:i') . "\n# PHPvod: http://www.phpvod.com\n# --------------------------------------------------------\n";
		$db->query("SET SQL_QUOTE_SHOW_CREATE = 0");

		$start = intval($start);
		!$tabledb && !$tablesel && adminmsg('operate_error');
		!$tabledb && $tabledb = explode("|", $tablesel);

		if(empty($step))
		{
			empty($tabledb) && adminmsg('operate_error');
			$tablesel = implode("|", $tabledb);
			$step = 1;
			$pre = $dbpre . get_date($timestamp, 'YmdHis') . '_'; //备份文件前缀
			$tableid = 0;
			$start = 0;
			$bakuptable = database_bakup_struct($tabledb); //备份数据表结构
			$bakupdata = database_bakup_data($tabledb, $tableid, $start, $sizelimit / 2);
		}
		else
		{
			$bakupdata = database_bakup_data($tabledb, $tableid, $start, $sizelimit);
		}

		$filename = $pre . $step . '.sql'; //备份文件名
		$writedata = $bakuptable ? $bakuptable . $bakupdata['bakupdata'] : $bakupdata['bakupdata'];

		$t_name = $tabledb[$bakupdata['tableid']];
		$c_n = $bakupdata['start'];
		if($bakupdata['stop'] === 0) //继续备份
		{
			$f_num = $step++;
			trim($writedata) && writeover(PHPVOD_ROOT . 'data/' . $filename, $bak . $writedata, 'ab');
			$j_url = "$basename&admintype=$admintype&submit=1&tableid=$bakupdata[tableid]&start=$bakupdata[start]&sizelimit=$sizelimit&step=$step&pre=$pre&tablesel=$tablesel";
			adminmsg('bakup_step', $j_url, array($t_name, $c_n, $f_num), 2);
		}
		else //已完成
		{
			trim($writedata) && writeover(PHPVOD_ROOT . 'data/' . $filename, $bak . $writedata, 'ab');
			if($step >= 1)
			{
				for($i = 1; $i <= $step; $i++)
				{
					$bakfile .= '<a href="data/' . $pre . $i . '.sql">' . $pre . $i . '.sql</a><br>';
				}
			}
			$basename .= '&admintype=bakout';
			adminmsg('bakup_out', '', array($bakfile));
		}
	}
}
elseif($admintype == 'bakin')
{
	initvar('step', 'GP', 2);
	if(!$step)
	{
		$filedb = array();
		$handle = opendir(PHPVOD_ROOT . 'data');
		while($file = readdir($handle))
		{
			if((!$dbpre || preg_match("/^pv_/i", $file) || preg_match("/^$dbpre/i", $file)) && preg_match("/\.sql$/i", $file))
			{
				$strlen = preg_match("/^$dbpre/i", $file) ? 15 + strlen($dbpre) : 18;
				$fp = fopen(PHPVOD_ROOT . "data/$file", 'rb');
				$bakinfo = fread($fp, 200);
				fclose($fp);
				$detail = explode("\n", $bakinfo);
				$bk['name'] = $file;
				$bk['version'] = substr($detail[2], 11);
				$bk['time'] = substr($detail[3], 8);
				$bk['pre'] = substr($file, 0, $strlen);
				$bk['num'] = substr($file, $strlen, strrpos($file, '.') - $strlen);
				$filedb[] = $bk;
			}
		}
	}
	elseif($step == '1')
	{
		initvar('pre', 'GP');
	}
	elseif($step == '2')
	{
		initvar('pre', 'GP');
		initvar(array('r_step', 'count'), 'GP', 2);
		if(!$count)
		{
			$count = 0;
			$handle = opendir(PHPVOD_ROOT . 'data');
			while($file = readdir($handle))
			{
				if(preg_match("/^$pre/i", $file) && preg_match("/\.sql$/i", $file))	$count++;
			}
			$database_manager = array($admin['username'],$admin['password'],$admin['uid'],$admin['ucuid'],$admin['groupid'],$admin['groupexpiry']);
			writeover(PHPVOD_ROOT.'data/database_manager.php', "<?php\r\n\$database_manager = ".pv_var_export($database_manager).";\r\n?>");
		}
		!$r_step && $r_step = 1;
		database_revert(PHPVOD_ROOT . 'data/' . $pre . $r_step . '.sql');
		$i = $r_step++;
		if($count > 1 && $r_step <= $count)
		{
			$j_url = "$basename&admintype=bakin&step=2&r_step=$r_step&count=$count&pre=$pre";
			adminmsg('bakup_in', $j_url, array($i), 2);
		}
		updatecache();
		file_exists(PHPVOD_ROOT.'data/database_manager.php') && delfile(PHPVOD_ROOT.'data/database_manager.php');
		$basename .= '&admintype=bakin';
		adminmsg('operate_success');
	}
}
elseif($admintype == 'delbak')
{
	initvar('delfile','P');
	$basename .= '&admintype=bakin';
	if(!$delfile) adminmsg('operate_error');
	foreach($delfile as $key => $value)
	{
		if(preg_match("/\.sql$/i", $value))
		{
			delfile(PHPVOD_ROOT . "data/$value");
		}
	}
	adminmsg('operate_success');
}

include gettpl('bakup');
?>