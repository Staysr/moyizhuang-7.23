<?php
error_reporting(0);
define('UC_CLIENT_VERSION', '1.6.0');
define('UC_CLIENT_RELEASE', '20170101');

define('API_DELETEUSER', 1);
define('API_RENAMEUSER', 1);
define('API_GETTAG', 1);
define('API_SYNLOGIN', 1);
define('API_SYNLOGOUT', 1);
define('API_UPDATEPW', 1);
define('API_UPDATEBADWORDS', 1);
define('API_UPDATEHOSTS', 1);
define('API_UPDATEAPPS', 1);
define('API_UPDATECLIENT', 1);
define('API_UPDATECREDIT', 1);
define('API_GETCREDITSETTINGS', 1);
define('API_GETCREDIT', 1);
define('API_UPDATECREDITSETTINGS', 1);

define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '-2');

if(!defined('IN_UC'))
{
	require '../global.php';

	$get = $post = array();
	$code = @$_GET['code'];
	parse_str(authcode($code, 'DECODE', UC_KEY), $get);

	if($timestamp - $get['time'] > 3600)
	{
		exit('Authracation has expiried');
	}
	if(empty($get))
	{
		exit('Invalid Request');
	}

	require_once PHPVOD_ROOT . './uc_client/lib/xml.class.php';
	$post = xml_unserialize(file_get_contents('php://input'));

	if(in_array($get['action'], array('test', 'deleteuser', 'renameuser', 'gettag', 'synlogin', 'synlogout', 'updatepw', 'updatebadwords', 'updatehosts', 'updateapps', 'updateclient', 'updatecredit', 'getcreditsettings', 'updatecreditsettings')))
	{
		$uc_note = new uc_note();
		echo call_user_func(array($uc_note, $get['action']), $get, $post);
		exit();
	}
	else
	{
		exit(API_RETURN_FAILED);
	}
}
else
{
	exit();
}

class uc_note
{
	function _serialize($arr, $htmlon = 0)
	{
		if(!function_exists('xml_serialize'))
		{
			include_once PHPVOD_ROOT . './uc_client/lib/xml.class.php';
		}
		return xml_serialize($arr, $htmlon);
	}

	function _construct() {
	}

	//通信测试
	function test($get, $post)
	{
		return API_RETURN_SUCCEED;
	}

	//删除用户
	function deleteuser($get, $post)
	{
		if(!API_DELETEUSER)
		{
			 return API_RETURN_FORBIDDEN;
		}
		$uids = $get['ids']; //'ids' => '\'9\',\'10\',\'11\''
		$uids = str_replace("'", '', $uids); //去掉引号

		$ucuids = explode(',', $uids);
		if(!empty($ucuids))
		{
			del_user($ucuids, false, 'ucuid');
		}

		return API_RETURN_SUCCEED;
	}

	//重命名用户
	function renameuser($get, $post)
	{
		global $db;
		if(!API_RENAMEUSER)
		{
			return API_RETURN_FORBIDDEN;
		}
		$uid = $get['uid'];
		$oldusername = addslashes($get['oldusername']);
		$newusername = addslashes($get['newusername']);

		//更新用户
		$db->update("UPDATE pv_members SET username='$newusername' WHERE username='$oldusername'");

		//更新与此用户相关的资料
		$db->update("UPDATE pv_video SET author='$newusername' WHERE author='$oldusername'");
		$db->update("UPDATE pv_reply SET author='$newusername' WHERE author='$oldusername'");
		$db->update("UPDATE pv_article SET author='$newusername' WHERE author='$oldusername'");

		return API_RETURN_SUCCEED;
	}

	function gettag($get, $post)
	{
		if(!API_GETTAG)
		{
			return API_RETURN_FORBIDDEN;
		}
		$name = $get['id'];

		$return = array();
		return $this->_serialize($return, 1);
	}

	//同步登录
	function synlogin($get, $post)
	{
		global $db;

		if(!API_SYNLOGIN)
		{
			return API_RETURN_FORBIDDEN;
		}
		$uid = $get['uid'];
		$username = $get['username'];
		$user = $db->get_one("SELECT uid,username,password FROM pv_members WHERE username='$username'");
		if($user)
		{
			header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
			cookie('user', $user['uid'] . "\t" . $user['password']);
		}
	}

	//同步登出
	function synlogout($get, $post)
	{
		if(!API_SYNLOGOUT)
		{
			return API_RETURN_FORBIDDEN;
		}
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
		cookie('user', '', 0);
	}

	function updatepw($get, $post)
	{
		if(!API_UPDATEPW)
		{
			return API_RETURN_FORBIDDEN;
		}
		return API_RETURN_SUCCEED;
	}

	function updatebadwords($get, $post)
	{
		if(!API_UPDATEBADWORDS)
		{
			return API_RETURN_FORBIDDEN;
		}
		$cachefile = PHPVOD_ROOT . './uc_client/data/cache/badwords.php';
		$fp = fopen($cachefile, 'w');
		$data = array();
		if(is_array($post))
		{
			foreach($post as $k => $v)
			{
				$data['findpattern'][$k] = $v['findpattern'];
				$data['replace'][$k] = $v['replacement'];
			}
		}
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'badwords\'] = ' . var_export($data, TRUE) . ";\r\n";
		fwrite($fp, $s);
		fclose($fp);
		return API_RETURN_SUCCEED;
	}

	function updatehosts($get, $post)
	{
		if(!API_UPDATEHOSTS)
		{
			return API_RETURN_FORBIDDEN;
		}
		$cachefile = PHPVOD_ROOT . './uc_client/data/cache/hosts.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'hosts\'] = ' . var_export($post, TRUE) . ";\r\n";
		fwrite($fp, $s);
		fclose($fp);
		return API_RETURN_SUCCEED;
	}

	//应用程序列表变更
	function updateapps($get, $post)
	{
		if(!API_UPDATEAPPS)
		{
			return API_RETURN_FORBIDDEN;
		}
		$UC_API = $post['UC_API'];

		//note 写 app 缓存文件
		$cachefile = PHPVOD_ROOT . './uc_client/data/cache/apps.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'apps\'] = ' . var_export($post, TRUE) . ";\r\n";
		fwrite($fp, $s);
		fclose($fp);

		//note 写配置文件
		if(is_writeable(PHPVOD_ROOT . './data/uc_config.php'))
		{
			$configfile = trim(file_get_contents(PHPVOD_ROOT . './data/uc_config.php'));
			$configfile = substr($configfile, -2) == '?>' ? substr($configfile, 0, -2) : $configfile;
			$configfile = preg_replace("/define\('UC_API',\s*'.*?'\);/i", "define('UC_API', '$UC_API');", $configfile);
			if($fp = @fopen(PHPVOD_ROOT . './data/uc_config.php', 'w'))
			{
				@fwrite($fp, trim($configfile));
				@fclose($fp);
			}
		}

		return API_RETURN_SUCCEED;
	}

	//UCenter基本设置信息变更
	function updateclient($get, $post)
	{
		if(!API_UPDATECLIENT)
		{
			return API_RETURN_FORBIDDEN;
		}
		$cachefile = PHPVOD_ROOT . './uc_client/data/cache/settings.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'settings\'] = ' . var_export($post, TRUE) . ";\r\n";
		fwrite($fp, $s);
		fclose($fp);
		return API_RETURN_SUCCEED;
	}

	//通知被兑换的目的应用程序所需修改的用户积分值
	function updatecredit($get, $post)
	{
		global $db;
		if(!API_UPDATECREDIT)
		{
			return API_RETURN_FORBIDDEN;
		}
		$credit = $get['credit'];
		$amount = $get['amount'];
		$ucuid = $get['uid'];

		$rec = $db->get_one("SELECT uid FROM pv_members WHERE ucuid='$ucuid'");
		$uid = $rec['uid'];

		switch($credit)
		{
			case 1:
				$db->update("UPDATE pv_memberdata SET rvrc=rvrc+'$amount' WHERE uid='$uid'");
				break;
			case 2:
				$db->update("UPDATE pv_memberdata SET money=money+'$amount' WHERE uid='$uid'");
				break;
			default:
				$db->updata("UPDATE pv_membercredit SET value=value+'$amount' WHERE uid='$uid' AND cid='$credit'");
		}
		return API_RETURN_SUCCEED;
	}

	function getcredit($get, $post)
	{
		if(!API_GETCREDIT)
		{
			return API_RETURN_FORBIDDEN;
		}
	}

	//把PHPVOD的积分传递给UCenter，用于在UCenter积分兑换设置中使用
	function getcreditsettings($get, $post)
	{
		if(!API_GETCREDITSETTINGS)
		{
			return API_RETURN_FORBIDDEN;
		}

		$credits = array();
		$credits['1'] = array(lang('rvrc'), '');
		$credits['2'] = array(lang('money'), '');

		include_once PHPVOD_ROOT . './data/cache/creditdb.php';
		foreach($_creditdb as $key => $c)
			$credits[$key] = array($c['name'], '');

		return $this->_serialize($credits);
	}

	//接收UCenter积分兑换设置的参数
	function updatecreditsettings($get, $post)
	{
		if(!API_UPDATECREDITSETTINGS)
		{
			return API_RETURN_FORBIDDEN;
		}

		$outextcredits = array();
		foreach($get['credit'] as $appid => $credititems)
		{
			if($appid == UC_APPID)
			{
				foreach($credititems as $value)
				{
					$outextcredits[$value['appiddesc'] . $value['creditdesc'] . $value['creditsrc']] = array('appiddesc' => $value['appiddesc'], 'creditdesc' => $value['creditdesc'], 'creditsrc' => $value['creditsrc'], 'title' => $value['title'], 'unit' => $value['unit'], 'ratio' => $value['ratio']);
				}
			}
		}

		$filename = PHPVOD_ROOT . './data/cache/outextcredits.php';
		$data = "<?php\r\n\$outextcredits = '" . serialize($outextcredits) . "';\r\n?>";
		writeover($filename, $data);
		return API_RETURN_SUCCEED;
	}
}