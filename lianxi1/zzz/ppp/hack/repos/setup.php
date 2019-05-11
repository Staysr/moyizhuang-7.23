<?php
!defined('IN_PHPVOD') && exit('Forbidden');
require_once PHPVOD_HACK_ROOT . 'function.php';

initvar('step', 'GP', 2);
if(!$step)
{
	if(isset($col_samename) && is_numeric($col_samename) && $col_samename >= 1 && $col_samename <= 4)
		${col_samename_ . $col_samename} = 'checked="checked"';
	else
		$col_samename_1 = 'checked="checked"';
	
	!empty($col_random_postdate_start) && $col_random_postdate_start = get_date($col_random_postdate_start, 'Y-m-d H:i');
	!empty($col_random_postdate_end) && $col_random_postdate_end = get_date($col_random_postdate_end, 'Y-m-d H:i');

	if(isset($col_downpic_auto) && is_numeric($col_downpic_auto) && $col_samename >= 1 && $col_samename <= 4)
		${col_samename_ . $col_samename} = 'checked="checked"';
	else
		$col_samename_1 = 'checked="checked"';
	
	ifcheck($col_downpic_auto, 'col_downpic_auto');
	if(!isset($col_downpic_step) || !is_numeric($col_downpic_step) || $col_downpic_step <= 0) $col_downpic_step = 1;
		
	include_once get_hack_tpl('setup');
}
elseif($step == '2')
{
	initvar('collect','GP',0);

	$collect['col_update_subject'] != 1 && $collect['col_update_subject'] = 0;
	$collect['col_update_pic'] != 1 && $collect['col_update_pic'] = 0;
	$collect['col_update_playactor'] != 1 && $collect['col_update_playactor'] = 0;
	$collect['col_update_director'] != 1 && $collect['col_update_director'] = 0;
	$collect['col_update_year'] != 1 && $collect['col_update_year'] = 0;
	$collect['col_update_memo'] != 1 && $collect['col_update_memo'] = 0;
	$collect['col_update_content'] != 1 && $collect['col_update_content'] = 0;
	
	$collect['col_compare_cid'] != 1 && $collect['col_compare_cid'] = 0;
	$collect['col_compare_nid'] != 1 && $collect['col_compare_nid'] = 0;
	$collect['col_compare_director'] != 1 && $collect['col_compare_director'] = 0;
	$collect['col_compare_playactor'] != 1 && $collect['col_compare_playactor'] = 0;
	$collect['col_compare_year'] != 1 && $collect['col_compare_year'] = 0;
	$collect['col_compare_memo'] != 1 && $collect['col_compare_memo'] = 0;


	//随机用户名
	$collect['col_random_userinfo'] = '';
	if(!empty($collect['col_random_username']))
	{
		$userlist = explode(',', $collect['col_random_username']);
		$sqlwhere = '';
		foreach ($userlist as $value)
		{
			$sqlwhere .= empty($sqlwhere) ? "username='$value'" : " OR username='$value'";
		}
		
		$userinfo = array();
		$result = $db->query("SELECT uid,username FROM pv_members WHERE $sqlwhere");
		while($row = $db->fetch_array($result))
		{
			$userinfo[] = $row;
		}
		$collect['col_random_userinfo'] = serialize($userinfo);
	}

	//随机发布时间
	if(!empty($collect['col_random_postdate_start']) && strpos($collect['col_random_postdate_start'], '_') === false) 
		$collect['col_random_postdate_start'] = pv_strtotime($collect['col_random_postdate_start']);
	else 
		$collect['col_random_postdate_start'] = '';
	
	if(!empty($collect['col_random_postdate_end']) && strpos($collect['col_random_postdate_end'], '_') === false)
		 $collect['col_random_postdate_end'] = pv_strtotime($collect['col_random_postdate_end']);
	else 
		$collect['col_random_postdate_end'] = '';
	
	//图片下载步长
	if(!is_numeric($collect['col_downpic_step']) || $collect['col_downpic_step'] <= 0) $collect['col_downpic_step'] = 1;
	
	foreach($collect as $key => $value)
	{
		$rt = $db->get_one("SELECT hk_name FROM pv_hackvar WHERE hk_name='$key'");
		if($rt)
			$db->update("UPDATE pv_hackvar SET hk_value='$value' WHERE hk_name='$key'");
		else
			$db->update("INSERT INTO pv_hackvar(hk_name,hk_value) VALUES ('$key','$value')");
	}

	updatecache_collect();
	adminmsg('operate_success');
}

?>