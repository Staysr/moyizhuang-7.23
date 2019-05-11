<?php
!defined('IN_PHPVOD') && exit('Forbidden');
if(!$action)
{
	$_class_opt = create_class_option();
	$_nation_opt = create_nation_option();
	include gettpl('setvideo');
	exit();
}
elseif($action == 'search')
{
	initvar(array('author_s', 'subject_s', 'bj', 'hits', 'lines','page'), 'GP', 2);
	initvar(array('cid', 'nid', 'author', 'subject', 'synopsis', 'playactor', 'director', 'best', 'serialise', 'postdate', 'orderway', 'asc'), 'GP', 0);
	$_class_opt = create_class_option(array('optgroup'=>TRUE));

	$sql = '1';
	$author = trim($author);
	$subject = trim($subject);
	$synopsis = trim($synopsis);
	$playactor = trim($playactor);
	$director = trim($director);
	if($cid != 'all')
	{
		if($_class[$cid]['cup'] == '0')
		{
			$subcid = '';
			foreach($_class as $svalue)
			{
				$fathers = explode(',', $svalue['fathers']);
				if(in_array($cid, $fathers))
				{
					if($subcid == '')
						$subcid .= $svalue['cid'];
					else
						$subcid .= ',' . $svalue['cid'];
				}
			}
			$sql .= $subcid != '' ? " AND m.cid IN($subcid)" : " AND m.cid IN(-1)";
		}
		else
			$sql .= " AND (m.cid='$cid')";
	}
	if($nid != 'all')
	{
		$sql .= " AND (m.nid='$nid')";
	}
	if($author != '')
	{
		$author = addslashes(str_replace('*', '%', $author));
		$sql .= $author_s == 1 ? " AND m.author LIKE '$author'" : " AND (m.author LIKE '%$author%')";
	}
	if($subject != '')
	{
		$subject = addslashes(str_replace('*', '%', $subject));
		$sql .= $subject_s == 1 ? " AND m.subject LIKE '$subject'" : " AND (m.subject LIKE '%$subject%')";
	}
	if($synopsis != '')
	{
		$synopsis = str_replace('*', '%', $synopsis);
		$sql .= " AND (md.synopsis LIKE '%$synopsis%')";
	}
	if($playactor != '')
	{
		$playactor = str_replace('*', '%', $playactor);
		$sql .= " AND (m.playactor LIKE '%$playactor%')";
	}
	if($director != '')
	{
		$director = str_replace('*', '%', $director);
		$sql .= " AND (m.director LIKE '%$director%')";
	}
	if($hits != '')
	{
		if($bj == '0')
			$sql .= " AND m.hits <'$hits'";
		elseif($bj == '1')
			$sql .= " AND m.hits >'$hits'";
	}
	if($best != 'all')
	{
		$sql .= " AND m.best='$best'";
	}
	if($serialise != 'all')
	{
		if($serialise == '1')
			$sql .= " AND m.serialise>'0'";
		else
			$sql .= " AND m.serialise='0'";
	}
	if($postdate != 'all' && is_numeric($postdate))
	{
		$schtime = $timestamp - $postdate;
		$sql .= " AND m.postdate<'$schtime'";
	}
	if($orderway)
	{
		$order = "ORDER BY $orderway $asc";
	}

	$rs = $db->get_one("SELECT COUNT(*) AS count FROM pv_video m LEFT JOIN pv_videodata md ON md.vid=m.vid WHERE $sql");
	$count = $rs['count'];
	if(!is_numeric($lines)) $lines = 100;
	(!is_numeric($page) || $page < 1) && $page = 1;

	$url = "$admin_file?adminjob=setvideo&action=$action&author=" . urlencode($author) . "&author_s=$author_s&cid=$cid&nid=$nid&subject=" . urlencode($subject) . "&subject_s=$subject_s&synopsis=" . urlencode($synopsis) . "&playactor=" . urlencode($playactor) . "&director=" . urlencode($director) . "&hits=$hits&best=$best&serialise=$serialise&postdate=$postdate&orderway=$orderway&asc=$asc&lines=$lines&";
	$pages = page_format(numofpage($count, $page, $lines, $url));
	$start = ($page - 1) * $lines;
	$limit = "LIMIT $start,$lines";
	$videodb = array();
	$query = $db->query("
		SELECT
			m.vid,m.author,m.authorid,m.subject,m.serialise,m.hits,m.postdate,m.best,c.caption
		FROM
			pv_video m LEFT JOIN pv_videodata md ON md.vid=m.vid LEFT JOIN pv_class c ON m.cid=c.cid
		WHERE
			$sql $order $limit
	");
	while($rt = $db->fetch_array($query))
	{
		$rt['postdate'] = get_date($rt['postdate']);
		$rt['best_'.$rt['best']] = 'selected = "selected"';
		$videodb[] = $rt;
	}
	include gettpl('setvideo');
	exit();
}
elseif($action == 'setvideo')
{
	initvar(array('best','selid','donotupdatecredit','movclass'),'P',2);
	initvar(array('oper','pageurl'),'P');
	foreach($best as $key => $value)
	{
		$db->update("UPDATE pv_video SET best='$value' WHERE vid='$key'");
	}
	$cd->refresh_depend_lasttime('best'); //刷新缓存依赖
	
	if(is_array($selid))
	{
		if($oper == 'del')
		{
			foreach($selid as $vid)
			{
				$t = $db->get_one("SELECT yz FROM pv_video WHERE vid='$vid'");
				$uflag = ($t['yz'] == '1' && $donotupdatecredit != '1') ? true : false;
				del_video($vid,$uflag);
			}
			update_siteinfo(array('totalvideo'));
		}
		elseif($oper == 'move')
		{
			if($_class[$movclass]['cup'] == 0) adminmsg('board_selerror');
			$selid = checkselid($selid);
			
			//获取移动之前的栏目ID
			$cids = array();
			$query = $db->query("SELECT cid FROM pv_video WHERE vid IN ($selid)");
			while($row = $db->fetch_array($query))
			{
				$cids[] = $row['cid'];
			}
			
			//移动
			$db->update("UPDATE pv_video SET cid='$movclass' WHERE vid IN ($selid)");
			
			//刷新依赖
			$cids[] = $movclass;
			$cids = array_unique($cids);
			$cd->refresh_depend_lasttime('cid', $cids);			
		}
	}
	adminmsg('operate_success',$pageurl);
}
?>