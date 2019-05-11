<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if($action == 'add_board')
{
	initvar('name','P');
	$db->update("INSERT INTO pv_class(caption) VALUES('$name')");
	updatecache_class();
	adminmsg('operate_success');
}
elseif($action == 'add_sub')
{
	initvar('caption','P');
	initvar('cup','P',2);
	$lv = 0;
	$fathers = '';
	if($cup != 0)
	{
		$up = $db->get_one("SELECT * FROM pv_class WHERE cid='$cup'");
		$lv = $up['lv'] + 1;
		$fathers = empty($up['fathers']) ? $up['cid'] : $up['fathers'] . ',' . $up['cid'];
	}
	$db->update("INSERT INTO pv_class(cup,lv,fathers,caption) VALUES('$cup','$lv','$fathers','$caption')");
	updatecache_class();
	adminmsg('operate_success');
}
elseif($action == 'edit_board')
{
	initvar('step');
	if($step == 2)
	{
		initvar(array('cid','vieworder'),'P',2);
		initvar(array('caption','link','tplfile','title','keywords','description'),'P');
		$basename = "$admin_file?adminjob=class&action=edit_board&cid=$cid";
		$db->update("UPDATE pv_class SET vieworder='$vieworder',caption='$caption',link='$link',tplfile='$tplfile',title='$title',keywords='$keywords',description='$description' WHERE cid='$cid'");
		updatecache_class();
		adminmsg('operate_success');
	}
	else 
	{
		initvar('cid','G',2);
	}
}
elseif($action == 'edit_sub')
{
	initvar('step');
	if($step != 2)
	{
		initvar('cid','G',2);
		$_class_opt = create_class_option(array('select'=>$_class[$cid][cup]));
		
		ifcheck($_class[$cid]['type'], 'classtype', 'select');
		ifcheck($_class[$cid]['orderway'], 'orderway', 'select');
		ifcheck($_class[$cid]['orderasc'], 'orderasc', 'select');
		ifcheck($_class[$cid]['atccheck'], 'atccheck', 'select');
		
		$lsarray = array('allowvisit','allowplay','allowpost','allowrp');
		foreach($lsarray as $value)
		{
			$gidarray =explode(",", $_class[$cid][$value]);
			${$value} = '<ul class="list">';
			foreach($ltitle as $key => $val) //循环缺省和游客之外的所有用户组
			{
				if($key == 1 || $key == 2)
					continue;
				$num++;
				$cflag = in_array($key, $gidarray) ? ' checked="checked"' : '';
				${$value} .= "<li><label><input type='checkbox' name='{$value}[]' value='$key'{$cflag}> $val</label></li>";
			}
			${$value} .= "</ul>";			
		}
	}
	else
	{
		initvar(array('cid','cup','vieworder','orderasc','atccheck','rvrcneed','moneyneed','postneed','allowvisit','allowplay','allowpost','allowrp'),'P',2);
		initvar(array('caption','type','orderway','link','tplfile','read_tplfile','play_tplfile','password','title','keywords','description'),'P');
		$basename = "$admin_file?adminjob=class&action=edit_sub&cid=$cid";
		
		$cup == $cid && adminmsg('board_fupsame');
		$up = $db->get_one("SELECT * FROM pv_class WHERE cid='$cup'");
		if(strpos(','.$up['fathers'].',', ','.$cid.',') !== false)
			adminmsg('board_fupsub');
		if($type == 'hidden' && $allowvisit == '')
			adminmsg('board_hidden');
		
		$lv = 0;
		$fathers = '';
		if($cup != 0)
		{
			$lv = $up['lv'] + 1;
			$fathers = empty($up['fathers']) ? $up['cid'] : $up['fathers'] . ',' . $up['cid'];
		}

		$allowvisit && $allowvisit = ',' . implode(",", $allowvisit) . ',';
		$allowplay && $allowplay = ',' . implode(",", $allowplay) . ',';
		$allowpost && $allowpost = ',' . implode(",", $allowpost) . ',';
		$allowrp && $allowrp = ',' . implode(",", $allowrp) . ',';
		
		$db->update("UPDATE pv_class SET cup='$cup',lv='$lv',fathers='$fathers',vieworder='$vieworder',caption='$caption',type='$type',orderway='$orderway',orderasc='$orderasc',link='$link',tplfile='$tplfile',read_tplfile='$read_tplfile',play_tplfile='$play_tplfile',atccheck='$atccheck',rvrcneed='$rvrcneed',moneyneed='$moneyneed',postneed='$postneed',password='$password',allowvisit='$allowvisit',allowplay='$allowplay',allowpost='$allowpost',allowrp='$allowrp',title='$title',keywords='$keywords',description='$description' WHERE cid='$cid'");
		
		$sub = $db->query("SELECT * FROM pv_class WHERE CONCAT(',',fathers,',') LIKE '%,$cid,%'"); //get subclass
		while($row = $db->fetch_array($sub))
		{
			$f = substr(','.$row['fathers'].',', strpos(','.$row['fathers'].',', ','.$cid.',') + strlen($cid)+2);
			$f = empty($fathers) ? $cid .','. $f : $fathers . ',' . $cid .','. $f;
			$f = substr($f,-1)==',' ? substr($f,0,strlen($f)-1) : $f;
			$l = substr_count($f, ',') + 1;
			$db->update("UPDATE pv_class SET lv='$l',fathers='$f' WHERE cid='$row[cid]'");
		}
		updatecache_class();
		adminmsg('operate_success');
	}
}
elseif($action == 'update')
{
	initvar('selid','P',2);
	foreach($selid as $key => $value)
	{
		$value != $_class[$key]['vieworder'] && is_numeric($value) && $db->update("UPDATE pv_class SET vieworder='$value' WHERE cid='$key'");
	}
	updatecache_class();
	adminmsg('operate_success');
}
elseif($action == 'delete')
{
	initvar('cid','G',2);
	$result = $db->query("SELECT cid FROM pv_class WHERE cup='$cid'");
	$num = $db->num_rows($result);
	if($num > 0)
		adminmsg('board_havesub');
	
	$result = $db->query("SELECT vid FROM pv_video WHERE cid='$cid'");
	$vnum = $db->num_rows($result);
	if($vnum > 0)
		adminmsg('board_havevod');
	
	$db->update("DELETE FROM pv_class WHERE cid='$cid'");
	updatecache_class();
	adminmsg('operate_success');
}
else
{
	$listdb = array();
	foreach($_class as $value)
	{
		$pre = '';
		for($i = 0; $i < $value['lv']; $i++)
			$pre .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		
		$value['caption'] = $pre . $value['caption'];
		$listdb[] = $value;
	}
	$_class_opt = create_class_option();
}
include gettpl('class');
?>