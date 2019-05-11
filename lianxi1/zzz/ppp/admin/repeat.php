<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$repeatdb = array();
	$result = $db->query("SELECT subject,count(*) count FROM pv_video GROUP BY subject HAVING count>1");
	while($row = $db->fetch_array($result))
		$repeatdb[] = $row;
}
elseif($action == 'show')
{
	initvar('subject','G');
	$videodb = array();
	$result = $db->query("SELECT * FROM pv_video WHERE subject='$subject' ORDER BY vid");
	while($row = $db->fetch_array($result))
	{
		$row['postdate'] = get_date($row['postdate']);
		$row['lastdate'] = get_date($row['lastdate']);
		$videodb[] = $row;
	}
}
elseif($action == 'delvideo')
{
	initvar('selid','P',2);
	empty($selid) && adminmsg('operate_error');
	if(is_array($selid))
	{
		foreach($selid as $vid)
		{
			$t = $db->get_one("SELECT yz FROM pv_video WHERE vid='$vid'");
			$uflag = $t['yz'] == '1' ? true : false;
			del_video($vid,$uflag);
		}
		update_siteinfo(array('totalvideo'));
	}
	adminmsg('operate_success');
}

include gettpl('repeat');
?>