<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$advertdb = array();
	$query = $db->query("SELECT a.*,m.username FROM pv_advert AS a LEFT JOIN pv_members AS m ON a.uid=m.uid WHERE 1 ORDER BY id ASC");
	while($rt = $db->fetch_array($query))
	{
		$config = unserialize($rt['config']);
		$config['stime'] = get_date($config['stime'], 'Y-m-d H:i');
		$config['etime'] = get_date($config['etime'], 'Y-m-d H:i');
		$rt['config'] = $config;
		$advertdb[] = $rt;
	}
}
elseif($action == 'add' || $action == 'edit')
{
	initvar('step','P',2);
	if(!$step)
	{
		if($action == 'edit')
		{
			initvar('id','GP',2);
			@extract($db->get_one("SELECT * FROM pv_advert WHERE id='$id'"));

			$config = unserialize($config);
			$config['stime'] = get_date($config['stime'], 'Y-m-d H:i');
			$config['etime'] = get_date($config['etime'], 'Y-m-d H:i');

			switch($ckey)
			{
				case 'header':
				case 'footer':
				case 'nav':
					$vars = explode(',', $config['adarea']);
					foreach($vars as $v)
					{
						$v == '-1' && $v = 'all';
						ifcheck($v, 'adarea');
					}
					ifcheck($ckey, 'ckey', 'select');
					break;
				case 'index':
				case 'class':
				case 'read':
				case 'play':
					ifcheck($ckey, 'ckey', 'select');
					break;
				default:
					if(!empty($ckey) && substr($ckey, 0, 1) == '_')
					{
						$ckey_self = 'selected="selected"';
						$keyname = $ckey;
					}
					break;
			}
		}
	}
	elseif($step == '2')
	{
		initvar(array('descrip','code','ckey','stime','etime'),'P',0);
		$cfg = array();
		if(!$descrip || !$code || !$ckey || !$stime || !$etime || strpos($stime, '_') !== false || strpos($etime, '_') !== false) adminmsg('operate_fail','goback');
		switch($ckey)
		{
			case 'header':
			case 'footer':
			case 'nav':
				initvar('adarea','P');
				empty($adarea) && adminmsg('operate_fail');
				$cfg['adarea'] = implode(',', $adarea);
				break;
			case 'index':
			case 'class':
			case 'read':
			case 'play':
				initvar('pos','P',2);
				$cfg['pos'] = $pos;
				break;
			case 'self':
				initvar('keyname','P');
				if(!$keyname || substr($keyname, 0, 1) != '_')
					adminmsg('operate_fail');
				else
					$ckey = $keyname;
				break;
		}

		
		$stime = pv_strtotime($stime);
		$etime = pv_strtotime($etime);		
		if($stime == false || $stime == -1 || $etime == false || $etime == -1) adminmsg('operate_fail');
		$cfg['stime'] = $stime;
		$cfg['etime'] = $etime;
		$cfg['code'] = stripslashes($code);
		$config = addslashes(serialize($cfg));

		if($action == 'add')
		{
			$db->update("INSERT INTO pv_advert(uid,ckey,descrip,config) VALUES('$admin[uid]','$ckey','$descrip','$config')");
		}
		else
		{
			initvar('id','P',2);
			if($action == 'edit') $db->update("UPDATE pv_advert SET uid='$admin[uid]',ckey='$ckey',descrip='$descrip',config='$config' WHERE id='$id'");
		}
		updatecache_advert();
		adminmsg('operate_success');
	}
}
elseif($action == 'del')
{
	initvar('selid','P',2);
	if(!$selid = checkselid($selid))
	{
		adminmsg('operate_error');
	}
	$db->update("DELETE FROM pv_advert WHERE id IN($selid)");
	updatecache_advert();
	adminmsg('operate_success');
}

include gettpl('advert');
?>