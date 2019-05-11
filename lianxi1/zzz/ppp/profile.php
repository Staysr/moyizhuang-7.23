<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/dbreg.php';
include_once PHPVOD_ROOT . 'data/cache/level.php';

initvar('action');
if($action == "show")
{
	initvar('id','GP',2);

	/* 用户组权限 */
	if($id != $uid && $gp_allowprofile == '0') showmsg('profile_error');
	if($id == '0') showmsg('guest_info');

	$userdb = array();
	$userdb = $db->get_one("SELECT m.*,md.* FROM pv_members m LEFT JOIN pv_memberdata md ON m.uid=md.uid WHERE m.uid='$id'");
	if(!$userdb) showmsg('user_not_exists','','',array($id));

	$logininfo = explode('|', $userdb['onlineip']);
	$userdb['ip'] = $logininfo[0];
	$userdb['lastlogin'] = isset($logininfo[1]) ? get_date($logininfo[1], "Y-m-d") : '';
	$userdb['regdate'] = get_date($userdb['regdate'], "Y-m-d");
	$userdb['grouptitle'] = $ltitle[$userdb['groupid']];
	$userdb['membertitle'] = $ltitle[$userdb['memberid']];
	!preg_match("/^http/i", $userdb['icon']) && $userdb['icon'] = "$imgpath/face/$userdb[icon]";

	$usercredit = array("postnum" => "$userdb[postnum]", "rvrc" => "$userdb[rvrc]", "money" => "$userdb[money]");
	$creditdb = get_custom_credit($id);
	foreach($creditdb as $key => $value)
	{
		$usercredit[$key] = $value[1];
	}
	$upgradeset = unserialize($db_upgrade);
	$userdb['credit'] = calculate_credit($usercredit, $upgradeset);
}
elseif($action == "modify")
{
	initvar('step','GP',2);
	$groupid == 'guest' && showmsg('not_login');
	if($step != 2)
	{
		ifcheck($user['receivemail'], 'receivemail');
		ifcheck($user['gender'], 'gender','select');
		ifcheck($user['publicmail'], 'publicmail');

		$userstyle = getcookie('pv_userstyle', false);
		$style = $userstyle ? $userstyle : $db_defaultstyle;
		$styles = create_style_option($style);

		$delicon = preg_match("/^user\//", $user['icon']) ? '1' : '0';

		$iconurl = $iconpath = '';
		if(preg_match("/^http/i", $user['icon']))
		{
			$iconurl = $user['icon'];
			$iconpath = $user['icon'];
		}
		else
		{
			$iconpath = "$imgpath/face/$user[icon]";
		}

		$filedb = array();
		$img = @opendir("$imgdir/face");
		while($imagearray = @readdir($img))
		{
			$extend = pathinfo($imagearray);
			$extend = strtolower($extend["extension"]);
			if($imagearray != "." && $imagearray != ".." && $imagearray != "" && $imagearray != "none.gif" && in_array($extend, array('jpg', 'jpeg', 'gif', 'png', 'bmp')))
			{
				$filedb[] = $imagearray;
			}
		}
		@closedir($img);
		natcasesort($filedb);
		foreach($filedb as $value)
		{
			$value == $user['icon'] ? $c = 'selected="selected"' : $c = '';
			$imgselect .= "<option value='$value' $c>$value</option>";
		}
	}
	else
	{
		initvar(array('probday','proicon','userstyle'),'GP',0);
		initvar(array('progender','proreceivemail','propublicmail'), 'GP', 2);
		initvar(array('iconurl', 'prohonor', 'prooicq', 'promsn', 'prosite', 'prosign'), 'GP');

		$bday = !empty($probday) && strpos($probday, '_') === false ? $probday : '';

		if(strlen($prohonor) > $rg_regmaxhonor)	showmsg('honor_limit','','goback',array($rg_regmaxhonor));
		if(strlen($prosign) > $rg_regmaxsign) showmsg('sign_limit','','goback',array($rg_regmaxsign));
		if(strpos($proicon, '..') !== false) showmsg('undefined_action','','goback');
		if(preg_match("/^user\//", $user['icon'])) $proicon = $user['icon'];

		if($iconurl)
		{
			if(!preg_match("/^http/i", $iconurl))
			{
				showmsg('illegal_customimg','','goback');
			}
			else
			{
				if(preg_match("/^user\//", $user['icon']) && file_exists($imgdir . '/face/' . $user['icon'])) showmsg('pro_custom_fail','','goback');
				$proicon = $iconurl;
			}
		}

		/* 系统风格 */
		if($userstyle == '')
			cookie('pv_userstyle', '', 0, false);
		else
			cookie('pv_userstyle', $userstyle, 'F', false);

		/* 上传头像 */
		$error = $_FILES['upicon']['error'];
		$img_name = $_FILES['upicon']['name'];
		$img_tmp = $_FILES['upicon']['tmp_name'];
		$img_size = $_FILES['upicon']['size'];
		$image_path = $imgpath . "/face/user/";

		if($error == '0' && $img_size > 0 && $db_iconupload == '1' && $gp_allowupicon == '1')
		{
			$iconsize = $db_iconsize * 1024;
			if($img_size > $iconsize) showmsg('pro_loadimg_limit','','',array($iconsize));
			if(preg_match("/^user\//", $user['icon']) && file_exists($imgdir . '/face/' . $user['icon'])) showmsg('pro_loadimg_fail','','goback');

			$img_ext = strtolower(substr(strrchr($img_name, '.'), 1));
			if($img_ext && in_array($img_ext, array('jpg', 'jpeg', 'png', 'bmp', 'gif')) && !in_blacklist($img_ext))
			{
				$filename = $uid . '.' . $img_ext;
				if(copy($img_tmp, $image_path . $filename))
				{
					$proicon = "user/$filename";
				}
			}
			else
				showmsg('pro_loadimg_ext');
		}
		$db->update("UPDATE pv_members SET publicmail='$propublicmail', receivemail='$proreceivemail', honor='$prohonor', icon='$proicon', gender='$progender', oicq='$prooicq', msn='$promsn', site='$prosite', bday='$bday', signature='$prosign' WHERE uid='$uid'");
		refreshto("./profile.php?action=$action", 'operate_success');
	}
}
elseif($action == "changepass")
{
	initvar('step','GP',2);
	$groupid == 'guest' && showmsg('not_login');
	if($step == 2)
	{
		initvar(array('oldpwd','propwd','check_pwd','proemail'),'GP',0);
		if(!$oldpwd) showmsg('not_oldpwd','','goback');
		if(($propwd || $check_pwd) && ($propwd != $check_pwd)) showmsg('password_confirm','','goback');
		user_edit($username,$oldpwd,$propwd,$proemail);
		refreshto("./profile.php?action=show&id=$uid", 'operate_success');
	}
}
elseif($action == 'permission')
{
    initvar('step', 'GP', 2);
	$groupid == 'guest' && showmsg('not_login');
	if($step == 2)
	{
		initvar('gid', 'GP', 2);
		$r = change_groupid($uid, $gid);
		showmsg('change_groupid_' . $r, '', 'profile.php?action=permission');
	}
	else
	{
	    $groups = array();
	    //扩展组
	    $extgroups = get_extgroups_info($uid);
	    if($extgroups != false) $groups = $extgroups;
	    //当前用户组
	    if(in_array($ltype[$groupid], array('system','special'))) $groups[$groupid] = $user['groupexpiry'];
	    //排序
	    ksort($groups,SORT_NUMERIC);
	    reset($groups);
	}
}
elseif($action == 'buy')
{
	initvar('step', 'GP', 2);
	$groupid == 'guest' && showmsg('not_login');
	if($step == 2 || $step == 3)
	{
		initvar('gid', 'GP', 2);
		$specgroup = $db->get_one("SELECT gid,grouptitle,selltype,sellprice,selllimit,sellinfo FROM pv_usergroups WHERE gid='$gid' AND gptype='special' AND allowbuy='1'");
		if(empty($specgroup)) showmsg('special_group_error');

		if($step == 2)
		{
			$specgroup['selltype_caption'] = get_credit_name($specgroup['selltype']);
		}
		elseif($step == 3)
		{
			initvar(array('selldays','setdefault'), 'P', 2);
			initvar('password', 'P', 0);

			//检测密码
			$md5pass = md5($password);
			$u = $db->get_one("SELECT uid FROM pv_members WHERE uid='$uid' AND password='$md5pass'");
			if(empty($u)) showmsg('buygroup_pwd_error');

			//检测购买天数
			if($selldays < 0 || $selldays < $specgroup['selllimit']) showmsg('buygroup_days_error', '', 'goback', array($specgroup['selllimit']));

			//计算所需积分
			$need_credit = $specgroup['sellprice'] * $selldays;

			//检测积分
			switch($specgroup['selltype'])
			{
				case 'money':
					$n = $user['money'];
					break;
				case 'rvrc':
					$n = $user['rvrc'];
					break;
				default:
					$n = $db->get_value("SELECT value FROM pv_membercredit WHERE uid='$uid' AND cid='$specgroup[selltype]'");
					break;
			}
			if($n == false || (int)$n < (int)$need_credit) showmsg('buygroup_credit_error', '', 'goback');

			//购买用户组
			if($user['groupid'] == $gid)
			{
				if($user['groupexpiry'] == '0') showmsg('buygroup_no_need');
				$groupexpiry = $user['groupexpiry'] > $timestamp ? $user['groupexpiry'] + 86400 * $selldays : $timestamp + 86400 * $selldays;
				$db->update("UPDATE pv_members SET groupexpiry='$groupexpiry' WHERE uid='$uid'");
			}
			else
			{
				$extgroups = get_extgroups_info($uid);
				if(isset($extgroups[$gid]))
					$extgroups[$gid] = $extgroups[$gid] > $timestamp ? $extgroups[$gid] + 86400 * $selldays : $timestamp + 86400 * $selldays;
				else
					$extgroups[$gid] = $timestamp + 86400 * $selldays;

				$groups = serialize($extgroups);
				$db->if_update("SELECT uid FROM pv_extgroups WHERE uid='$uid'",
					"UPDATE pv_extgroups SET groups='$groups' WHERE uid='$uid'",
					"INSERT INTO pv_extgroups(uid,groups) VALUES('$uid','$groups')");
			}

			//扣除积分
			switch($specgroup['selltype'])
			{
				case 'money':
					$db->update("UPDATE pv_memberdata SET money=money-$need_credit WHERE uid='$uid'");
					break;
				case 'rvrc':
					$db->update("UPDATE pv_memberdata SET rvrc=rvrc-$need_credit WHERE uid='$uid'");
					break;
				default:
					$db->update("UPDATE pv_membercredit SET value=value-$need_credit WHERE uid='$uid' AND cid='$specgroup[selltype]'");
					break;
			}

			//切换用户组
			if($setdefault == 1) change_groupid($uid, $gid);

			showmsg('buygroup_success','','profile.php?action=buy');
		}
	}
	else
	{
		$query = $db->query("SELECT gid,grouptitle,selltype,sellprice,selllimit,sellinfo FROM pv_usergroups WHERE gptype='special' AND allowbuy='1'");
		$special_list = array();
		while($row = $db->fetch_array($query))
		{
			$row['selltype_caption'] = get_credit_name($row['selltype']);
			$special_list[] = $row;
		}
		if(empty($special_list)) showmsg('special_group_empty');
	}
}
elseif($action == "myvideo")
{
	initvar(array('type','page'));
	if(empty($type) || !in_array($type, array('post','favorite','buy'))) $type = 'post';
	$groupid == 'guest' && showmsg('not_login');

	(!is_numeric($page) || $page < 1) && $page = 1;
	$limit = "LIMIT " . ($page - 1) * $db_perpage . ",$db_perpage";
	switch ($type)
	{
		case 'post':
			$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_video WHERE authorid='$uid'");
			$video_num = $rt['sum'];
			$sql = "SELECT * FROM pv_video AS v WHERE v.authorid='$uid' ORDER BY postdate DESC $limit";
			break;
		case 'favorite':
			$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_favorite WHERE uid='$uid'");
			$video_num = $rt['sum'];
			$sql = "SELECT v.*,f.timestamp FROM pv_favorite AS f LEFT JOIN pv_video AS v ON f.vid=v.vid WHERE f.uid='$uid' ORDER BY f.fid DESC $limit";
			break;
		case 'buy':
			$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_buy WHERE uid='$uid'");
			$video_num = $rt['sum'];
			$sql = "SELECT v.*,b.timestamp FROM pv_buy AS b LEFT JOIN pv_video AS v ON b.vid=v.vid WHERE b.uid='$uid' ORDER BY b.bid DESC $limit";
			break;
	}
	$pages = numofpage($video_num, $page, $db_perpage, "profile.php?action=myvideo&type={$type}&");
	$videolist = array();
	$query = $db->query($sql);
	while($video = $db->fetch_array($query))
	{
		$video['postdate'] = get_date($video['postdate']);
		$video['lastdate'] = get_date($video['lastdate']);
		$video['timestamp'] = get_date($video['timestamp']);
		$videolist[] = $video;
	}
}
elseif($action == 'outextcredits')
{
	$groupid == 'guest' && showmsg('not_login');
	if($db_mergesystype == 'ucenter') //ucenter
	{
		include_once PHPVOD_ROOT . 'data/cache/outextcredits.php';
		$outextcredits = isset($outextcredits) ? unserialize($outextcredits) : '';
		if(!empty($outextcredits))
		{
			initvar('step','GP',0);
			if($step != '2')
			{
				//PHPVOD 积分列表
				$pv_creditlist['1'] = lang('rvrc');
				$pv_creditlist['2'] = lang('money');
				include_once PHPVOD_ROOT . 'data/cache/creditdb.php';
				foreach($_creditdb as $key => $c)
					$pv_creditlist[$key] = $c['name'];

				//获取允许兑换的积分列表
				$tmp = array(); //同一积分不同兑换方式只显示一次
				$tocreditdb = array();
				$jsarray = '';
				foreach($outextcredits as $value)
				{
					if(!in_array($value['appiddesc'].$value['creditdesc'],$tmp))
					{
						$tocreditdb[] = $value;
						$tmp[] = $value['appiddesc'].$value['creditdesc'];
					}
					$jsarray.=$value['appiddesc'].','.$value['creditdesc'].','.$value['creditsrc'].','.$pv_creditlist[$value[creditsrc]].','.$value['ratio'].';';
				}
				$jsarray = substr($jsarray,0,-1);
			}
			else
			{
				initvar(array('password','srctype','srcnum','totype','tonum'),'GP',0);
				$userinfo = uc_user_login($ucuid, $password, 1);
				if($userinfo[0] <= 0) showmsg('outextcredits_passerror','','goback',array(),9);

				$s = explode('|',$srctype);
				$t = explode('|',$totype);

				if(is_numeric($tonum) && $tonum > 0 && is_numeric($s[0]) && is_numeric($t[0]) && is_numeric($t[1]))
				{
					$key="{$t[0]}{$t[1]}{$s[0]}";
					$ratio = $outextcredits[$key]['ratio'];
					$neednum = ceil($tonum * $ratio);
					$num = 0;

					switch($s[0])
					{
						case 1:
							$rec = $db->get_one("SELECT rvrc FROM pv_memberdata WHERE uid='$uid'");
							$num = $rec['rvrc'];
							$creditname = lang('rvrc');
							break;
						case 2:
							$rec = $db->get_one("SELECT money FROM pv_memberdata WHERE uid='$uid'");
							$num = $rec['money'];
							$creditname = lang('money');
							break;
						default:
							$rec = $db->get_one("SELECT mc.value,c.name FROM pv_membercredit mc LEFT JOIN pv_credits c ON mc.cid=c.cid WHERE mc.uid='$uid' AND mc.cid='$s[0]'");
							$num = $rec['value'];
							$creditname = $rec['name'];
					}

					if($num < $neednum) showmsg('outextcredits_need','','goback',array($creditname,$neednum,$num),10);

					$result = uc_credit_exchange_request($ucuid,$s[0],$t[1],$t[0],$tonum);
					if($result)
					{
						switch($s[0])
						{
							case 1:
								$db->update("UPDATE pv_memberdata SET rvrc=rvrc-'$srcnum' WHERE uid='$uid'");
								break;
							case 2:
								$db->update("UPDATE pv_memberdata SET money=money-'$srcnum' WHERE uid='$uid'");
								break;
							default:
								$db->update("UPDATE pv_membercredit SET value=value-'$srcnum' WHERE uid='$uid' AND cid='$s[0]'");
						}
						showmsg('outextcredits_success','','profile.php?action=outextcredits',array(),9);
					}
					else
					{
						showmsg('outextcredits_fail','','goback');
					}
				}
				else
				{
					showmsg('outextcredits_error','','goback');
				}
			} //step
		}
		else
		{
			showmsg('outextcredits_nodefined','','goback');
		}
	}
	else
	{
		showmsg('outextcredits_nomerge','','goback');
	}
}
elseif($action == 'ads')
{
	$groupid == 'guest' && showmsg('not_login');
	if($db_setads == '0') showmsg('ads_close');
	$creditname = get_credit_name($db_setadstype);
}
elseif($action == 'remove')
{
	initvar('type');
	initvar('vid','GP',2);

	$groupid == 'guest' && showmsg('not_login');
	if($type == 'favorite')
	{
		$db->update("DELETE FROM pv_favorite WHERE uid='$uid' AND vid='$vid'");
	}
	elseif($type == 'buy')
	{
		$db->update("DELETE FROM pv_buy WHERE uid='$uid' AND vid='$vid'");
	}
	refreshto("profile.php?action=myvideo&type=$type", 'operate_success');
}
elseif($action == "delicon")
{
	$groupid == 'guest' && showmsg('not_login');
	if(preg_match("/^user\//", $user['icon']) && file_exists("$imgdir/face/$user[icon]")) delfile("$imgdir/face/$user[icon]");
	$db->query("UPDATE pv_members SET icon='none.gif' WHERE uid='$uid'");
	refreshto('profile.php?action=modify', 'operate_success');
}

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl('profile');
footer();
?>