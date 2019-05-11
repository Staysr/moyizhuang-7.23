<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if($action == 'search')
{
	initvar(array('author','content','postdate','yz','orderway','asc','lines','page'),'GP');
	initvar(array('author_s'),'GP',2);

	$sql = '1';
	if($author != '')
	{
		$author = str_replace('*', '%', $author);
		$sql .= $author_s == 1 ? " AND r.author LIKE '$author'" : " AND (r.author LIKE '%$author%')";
	}
	if($content != '')
	{
		$content = str_replace('*', '%', $content);
		$sql .= " AND (r.content LIKE '%$content%')";
	}
	if($postdate != 'all' && is_numeric($postdate))
	{
		$schtime = $timestamp - $postdate;
		$sql .= " AND r.postdate<'$schtime'";
	}
	if($yz != 'all' && is_numeric($yz))
	{
		$sql .= " AND r.yz=$yz";
	}
	if($orderway)
	{
		$order = "ORDER BY $orderway";
		$asc && $order .= " $asc";
	}
	$rs = $db->get_one("SELECT COUNT(*) AS count FROM pv_reply r WHERE $sql");
	$count = $rs['count'];
	if(!is_numeric($lines)) $lines = 100;
	(!is_numeric($page) || $page < 1) && $page = 1;

	$pages = page_format(numofpage($count, $page, $lines, "$admin_file?adminjob=reply&action=$action&author=" . urlencode($author) . "&author_s=$author_s&content=" . urlencode($content) . "&postdate=$postdate&yz=$yz&orderway=$orderway&asc=$asc&lines=$lines&"));
	$start = ($page - 1) * $lines;
	$limit = "LIMIT $start,$lines";

	$schdb = array();

	$query = $db->query("SELECT r.*,v.subject FROM pv_reply r LEFT JOIN pv_video v ON r.vid=v.vid WHERE $sql $order $limit");
	while($sch = $db->fetch_array($query))
	{
		$sch['postdate'] = get_date($sch['postdate']);
		$sch['content'] = strip_tags($sch['content'],'<img>');
		$schdb[] = $sch;
	}
}
elseif($action == 'read')
{
	initvar('id','GP',2);
	@extract($db->get_one("SELECT content FROM pv_reply WHERE id='$id'"));
	$content = ieconvert($content);
}
elseif($action == 'check')
{
	initvar(array('selid','donotupdatecredit'),'P',2);
	initvar('type','P');
	!$selid && adminmsg('operate_error');
	$vids = array();
	foreach($selid as $id)
	{
		$reply = $db->get_one("SELECT vid,yz,authorid FROM pv_reply WHERE id='$id'");
		if(empty($reply)) continue;
		if($type == 'pass')
		{
			if($reply['yz'] == 1) continue;
			$vids[] = $reply['vid'];
			$db->update("UPDATE pv_video SET reply=reply+1 WHERE vid='$reply[vid]'");
			$db->update("UPDATE pv_reply SET yz='1' WHERE id='$id'");
			if($reply['authorid'] != '0')
			{
				update_member_data($reply['authorid'], 'Reply');
			}
		}
		else
		{
			$vids[] = $reply['vid'];
			$db->update("DELETE FROM pv_reply WHERE id='$id'");
			if($reply['yz'] == 0) continue;
			$db->update("UPDATE pv_video SET reply=reply-1 WHERE vid='$reply[vid]'");
			if($reply['authorid'] != '0' && $donotupdatecredit != '1')
			{
				update_member_data($reply['authorid'], 'Deleterp');
			}
		}
	}
	
	$vids = array_unique($vids);
	$cd->refresh_depend_lasttime('reply', $vids);
	adminmsg('operate_success');
}

include gettpl('reply');
?>