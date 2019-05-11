<?php
error_reporting(E_ERROR | E_PARSE);
set_time_limit(0);
define('PHPVOD_INSTALL_ROOT', dirname(__FILE__) . '/');
define('PHPVOD_ROOT', str_replace('install/', '', PHPVOD_INSTALL_ROOT));
include PHPVOD_INSTALL_ROOT . 'config.php';
include PHPVOD_INSTALL_ROOT . 'lang.php';
include PHPVOD_ROOT . 'require/phpvod_version.php';

if(!($request_uri = $_SERVER['REQUEST_URI']))
{
	$request_uri = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
}
$installurl = strtolower('http://' . $_SERVER['HTTP_HOST'] . substr($request_uri, 0, strrpos($request_uri, '/')));
$wwwurl = str_replace('/install', '', $installurl);
$basename = "index.php";
$step = is_file(PHPVOD_INSTALL_ROOT . 'install.lock') ? 'lock_exists' : $_POST['step'];

if($step == 'lock_exists')
{
	include PHPVOD_INSTALL_ROOT . 'install.htm';
	exit();
}
elseif(!$step) //显示PHPVOD许可协议
{
	$land_licence = readover(PHPVOD_ROOT . 'licence.txt');
	$land_licence = str_replace('  ', '&nbsp; ', nl2br($land_licence));
	include PHPVOD_INSTALL_ROOT . 'install.htm';
	exit();
}
elseif($step == 1) //检查运行环境
{
	$php_version = get_php_version();

	$zend = extension_loaded('Zend Guard Loader');
	$zend_result = $zend ? $lang['ext_ok'] : $lang['ext_no'];

	$mysql = function_exists('mysql_close');
	$mysql_result = $mysql ? $lang['ext_ok'] : $lang['ext_no'];

	$gd = function_exists('gd_info');
	$gd_result = $gd ? $lang['ext_ok'] : $lang['ext_no'];

	$allow_url_fopen = (boolean)ini_get('allow_url_fopen');
	$allow_url_fopen_result = $allow_url_fopen ? $lang['ext_ok'] : $lang['ext_no'];

	$curl = function_exists('curl_init');
	$curl_result = $curl ? $lang['ext_ok'] : $lang['ext_no'];

	$zip = class_exists('ZipArchive');
	$zip_result = $zip ? $lang['ext_ok'] : $lang['ext_no'];

	$memcached = class_exists('Memcache') || class_exists('Memcached');
	$memcached_result = $memcached ? $lang['ext_ok'] : $lang['ext_no'];

	$apc = function_exists('apc_fetch');
	$apc_result = $apc ? $lang['ext_ok'] : $lang['ext_no'];

	$redis = class_exists('Redis');
	$redis_result = $redis ? $lang['ext_ok'] : $lang['ext_no'];

	include PHPVOD_INSTALL_ROOT . 'install.htm';
	exit();
}
elseif($step == 2) //检查读写权限和填写配置信息
{
	$check = true;
	$check_list = array(
		'', //根目录
		'data',
		'data/cache',
		'data/groupdb',
		'data/hack',
		'data/player',
		'data/style',
		'data/temp',
		'data/template',
		'data/update',
		'image',
		'image/face/user',
		'image/pic',
		'install',
		'mobile/data',
		'mobile/data/player',
		'mobile/data/template',
		'video'
	);
	$check_result = array();
	foreach($check_list as $dirname)
	{
		if(!file_exists(PHPVOD_ROOT . $dirname))
		{
			$check_result[] = $lang['file_not_exists'];
			$check = false;
		}
		elseif(is_writable(PHPVOD_ROOT . $dirname))
		{
			$check_result[] = $lang['write_ok'];
		}
		else
		{
			$check_result[] = $lang['write_no'];
			$check = false;
		}
	}
	include (PHPVOD_INSTALL_ROOT . 'install.htm');
	exit();
}
elseif($step == 3){ //填写数据库配置与创始人信息
	$mysql = extension_loaded('mysql');
	$mysqli = extension_loaded('mysqli');

	$mysql_status = $mysql ? '' : 'disabled="disabled"';
	$mysqli_status = $mysqli ? '' : 'disabled="disabled"';

	$mysql_checked = $mysqli_checked = '';
	if($mysqli)
		$mysqli_checked = 'checked="checked"';
	else
		$mysql_checked = 'checked="checked"';

	include (PHPVOD_INSTALL_ROOT . 'install.htm');
	exit();
}
elseif($step == 4) //保存配置信息 & 检测是否安装过PHPvod
{
	$charset = str_replace('-', '', $lang['db_charset']); //数据库编码
	$writetofile = "<?php
/*
$lang[comment_1]
*/
\$dbhost = '$_POST[server]'; // $lang[comment_2]
\$dbuser = '$_POST[sqluser]'; // $lang[comment_3]
\$dbpw = '$_POST[sqlpassword]'; // $lang[comment_4]
\$dbname = '$_POST[sqlname]'; // $lang[comment_5]
\$database = '$_POST[datatype]'; // $lang[comment_6]
\$dbpre = '$_POST[tablepre]'; // $lang[comment_7]
\$pconnect = 0; // $lang[comment_8]

/*
$lang[comment_9]
*/
\$charset = '$charset';
" . '?>';
	writeover(PHPVOD_ROOT . 'data/sql_config.php', $writetofile); //写入配置文件
	include PHPVOD_ROOT . 'data/sql_config.php';

	$link = mysql_connect($dbhost, $dbuser, $dbpw); //连接数据库
	if(!$link)
	{
		$step = 'mysql_connect_failed';
		include PHPVOD_INSTALL_ROOT . 'install.htm';
		exit();
	}

	if(!mysql_select_db($dbname))
	{
		if(mysql_get_server_info($link) > '4.1' && $charset)
		{
			mysql_query("CREATE DATABASE $dbname DEFAULT CHARACTER SET $charset", $link); //创建数据库(版本大于4.1)
		}
		else
		{
			mysql_query("CREATE DATABASE $dbname", $link); //创建数据库
		}
		if(mysql_errno($link) != 0)
		{
			$step = 'mysql_no_database';
			include PHPVOD_INSTALL_ROOT . 'install.htm';
			exit();
		}
	}

	mysql_select_db($dbname, $link);
	$query = mysql_query("SHOW TABLES LIKE '" . $dbpre . "members'", $link);
	while($table = mysql_fetch_array($query, MYSQL_NUM))
	{
		$database_exists = $table[0] == $dbpre . 'members' ? true : false;
	}

	include PHPVOD_INSTALL_ROOT . 'install.htm';
	exit();
}
elseif($step == 5) //开始安装 & 显示安装结果
{
	include PHPVOD_ROOT . 'data/sql_config.php';

	$link = mysql_connect($dbhost, $dbuser, $dbpw); //连接数据库
	if(!$link)
	{
		$step = 'mysql_connect_failed';
		include PHPVOD_INSTALL_ROOT . 'install.htm';
		exit();
	}
	if(!mysql_select_db($dbname,$link))
	{
		if(mysql_get_server_info($link) > '4.1' && $charset)
		{
			mysql_query("CREATE DATABASE $dbname DEFAULT CHARACTER SET $charset", $link); //创建数据库(版本大于4.1)
		}
		else
		{
			mysql_query("CREATE DATABASE $dbname", $link); //创建数据库
		}
		if(mysql_errno($link) != 0)
		{
			$step = 'mysql_no_database';
			include PHPVOD_INSTALL_ROOT . 'install.htm';
			exit();
		}
	}

	mysql_select_db($dbname,$link);
	mysql_query("SET NAMES $charset");

	$table_list = create_table(PHPVOD_INSTALL_ROOT . "phpvod.sql"); //导入数据
	$timestamp = time();
	$password = md5($_POST['password']);
	mysql_query("INSERT INTO {$dbpre}members SET username='$_POST[username]', password='$password', email='$_POST[email]', groupid='3', memberid='5', icon='none.gif', regdate='$timestamp'",$link);

	/* insert id */
	$uid = mysql_insert_id();

	/* rand sitehash */
	$sitehash = randstr(12);

	mysql_query("INSERT INTO {$dbpre}memberdata(uid) VALUES('$uid')",$link);
	mysql_query("UPDATE {$dbpre}config SET db_value='$_POST[url]' WHERE db_name='db_wwwurl'",$link);
	mysql_query("UPDATE {$dbpre}config SET db_value='$_POST[url]' WHERE db_name='db_ceoconnect'",$link);
	mysql_query("UPDATE {$dbpre}config SET db_value='$sitehash' WHERE db_name='db_sitehash'",$link);

	include PHPVOD_INSTALL_ROOT . 'install.htm';
	exit();
}
elseif($step == 6) //更新缓存
{
	define('IN_PHPVOD', 1);
	include PHPVOD_ROOT . 'data/sql_config.php';
	require_once PHPVOD_ROOT . 'require/' . $database . '.php';
	$db = new phpvod_database($dbhost, $dbuser, $dbpw, $dbname, $dbpre, $charset, $pconnect);
	include PHPVOD_ROOT . 'admin/cache.php';

	//更新dbset.php
	writeover(PHPVOD_ROOT . 'data/cache/dbset.php', "<?php\r\n\$picpath = 'image';\r\n?>");

	//更新系统缓存
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
	updatecache_bwd(array());
	include_once PHPVOD_ROOT.'data/cache/config.php';

	//更新模板缓存
	updatecache_template();

	//清除风格cookie
	$cookie_path = !$db_cookiepath ? '/' : $db_cookiepath;
	$cookie_domain = $db_cookiedomain;
	setcookie('pv_userstyle', '', time() - 31536000, $cookie_path, $cookie_domain, false);

	/* 更新站点信息 */
	$siteinfo = array();
	$item = array('newmember','totalmember','totalvideo');
	foreach($item as $val)
	{
		switch($val)
		{
			case 'newmember':
				$t = $db->get_one("SELECT username FROM pv_members ORDER BY uid DESC LIMIT 1");
				$siteinfo['newmember'] = $t['username'];
				break;
			case 'totalmember':
				$t = $db->get_one("SELECT COUNT(*) AS count FROM pv_members");
				$siteinfo['totalmember'] = $t['count'];
				break;
			case 'totalvideo':
				$t = $db->get_one("SELECT COUNT(*) AS count FROM pv_video");
				$siteinfo['totalvideo'] = $t['count'];
		}
	}
	writeover(PHPVOD_ROOT . 'data/cache/siteinfo.php', "<?php\r\n\$siteinfo = array(\r\n\t'newmember' => '{$siteinfo[newmember]}',\r\n\t'totalmember' => '{$siteinfo[totalmember]}',\r\n\t'totalvideo' => '{$siteinfo[totalvideo]}',\r\n);\r\n?>");

	writeover(PHPVOD_INSTALL_ROOT . 'install.lock', '');
	include PHPVOD_INSTALL_ROOT . 'install.htm';
	exit();
}

function create_table($filename)
{
	global $link, $dbpre, $lang, $charset;

	$table_list = array();
	$sql = file($filename);
	$query = '';
	foreach($sql as $key => $value)
	{
		$value = trim($value);
		if(!$value || $value[0] == '#' || substr($value, 0, 3) == '-- ' || $value == '--') continue;
		if(eregi("\;$", $value))
		{
			$query .= $value;
			if(eregi("^CREATE", $query))
			{
				$name = substr($query, 13, strpos($query, '(') - 13);
				$c_name = str_replace('pv_', $dbpre, $name);
				$table_list[] = $c_name;

				$extra = substr(strrchr($query, ')'), 1);
				$query = str_replace($extra, '', $query);
				if(mysql_get_server_info($link) > '4.1')
				{
					$extra = $charset ? "ENGINE=MyISAM DEFAULT CHARSET=$charset;" : "ENGINE=MyISAM;";
				}
				else
				{
					$extra = "TYPE=MyISAM;";
				}
				$query .= $extra;
			}
			$dbpre != 'pv_' && $query = str_replace(array(' pv_', '`pv_', " 'pv_"), array(" $dbpre", "`$dbpre", " '$dbpre"), $query);
			mysql_query($query, $link) or exit(mysql_error($link));
			$query = '';
		}
		else
		{
			$query .= $value;
		}
	}
	return $table_list;
}
function pv_var_export($input, $indent = '')
{
	switch(gettype($input))
	{
		case 'string':
			return "'" . str_replace(array("\\", "'"), array("\\\\", "\'"), $input) . "'";
		case 'array':
			$output = "array(\r\n";
			foreach($input as $key => $value)
			{
				$output .= $indent . "\t" . pv_var_export($key, $indent . "\t") . ' => ' . pv_var_export($value, $indent . "\t");
				$output .= ",\r\n";
			}
			$output .= $indent . ')';
			return $output;
		case 'boolean':
			return $input ? 'true' : 'false';
		case 'NULL':
			return 'NULL';
		case 'integer':
		case 'double':
		case 'float':
			return "'" . (string)$input . "'";
	}
	return 'NULL';
}
function readover($filename, $method = 'rb')
{
	$filename = path_cv($filename);
	$filedata = '';
	if(file_exists($filename))
	{
		if($handle = @fopen($filename, $method))
		{
			flock($handle, LOCK_SH);
			$filedata = @fread($handle, filesize($filename));
			fclose($handle);
		}
	}
	return $filedata;
}
function writeover($filename, $data, $method = 'rb+', $iflock = 1, $check = 1, $chmod = 1)
{
	$filename = path_cv($filename, $check);
	touch($filename);
	$handle = fopen($filename, $method);
	$iflock && flock($handle, LOCK_EX);
	fwrite($handle, $data);
	$method == 'rb+' && ftruncate($handle, strlen($data));
	fclose($handle);
	$chmod && @chmod($filename, 0777);
}
function path_cv($filename, $ifcheck = 1)
{
	$tmpname = strtolower($filename);
	$tmparray = array('http://', "\0");
	$ifcheck && $tmparray[] = '..';
	if(str_replace($tmparray, '', $tmpname) != $tmpname)
	{
		exit('Forbidden');
	}
	return $filename;
}
function key_cv($key)
{
	return preg_replace('/[^\d\w\_]/is', '', $key);
}
function ckfun($mod, $ckfunc)
{
	return extension_loaded($mod) && $ckfunc && function_exists($ckfunc) ? true : false;
}
function randnum($length)
{
	mt_srand((double)microtime() * 1000000);
	$randval = mt_rand(1, 9);
	for($i = 1; $i < $length; $i++)
	{
		$randval .= mt_rand(0, 9);
	}
	return $randval;
}
function randstr($length)
{
	return substr(md5(randnum($length)), mt_rand(0, 32 - $length), $length);
}
function get_php_version()
{
	$verinfo = explode('.', PHP_VERSION);
	$current_version = $verinfo[0] . '.' . $verinfo[1] . '.' . 'x';
	return $current_version;
}
?>
