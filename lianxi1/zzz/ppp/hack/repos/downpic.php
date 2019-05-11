<?php
!defined('IN_PHPVOD') && exit('Forbidden');
require_once PHPVOD_HACK_ROOT . "function.php";

initvar(array('rid','step'), 'GP', 2);
if(!is_numeric($col_downpic_step) || $col_downpic_step < 1)
	$col_downpic_step = 1;

if($step != 2)
{
	$r = $db->get_one("SELECT COUNT(*) AS c FROM pv_repos WHERE rid='$rid' AND downpic='0'");
	if($r['c'] > 0)
	{
		$maxpage = ceil($r['c'] / $col_downpic_step);
		adminmsg('downpic_cache', "$basename&action=downpic&rid=$rid&page=1&maxpage=$maxpage&step=2");
	}
	else 
	{
		adminmsg('downpic_success', "$basename&action=manage");
	}
}
else 
{
	initvar(array('page','maxpage'), 'G', 2);
	$result = $db->query("SELECT r.id,r.vid,v.subject,v.pic FROM pv_repos AS r LEFT JOIN pv_video AS v ON r.vid=v.vid WHERE r.rid='$rid' AND r.downpic='0' ORDER BY r.lasttime DESC LIMIT $col_downpic_step");
	$n = $db->num_rows($result);
	if($n > 0)
	{
		$subject = '<table class="tableborder f-w98 f-m0a">';
		while($row = $db->fetch_array($result))
		{
			$langkey = 'downpic_0';
			if(!empty($row['pic']))
			{
				$r = import_video_pic($row['vid'], $row['pic']);
				if($r)
				{
					$db->update("UPDATE pv_repos SET downpic='1' WHERE id='$row[id]'");
					$langkey = 'downpic_1';
				}
				else 
				{
					$db->update("UPDATE pv_repos SET downpic='2' WHERE id='$row[id]'"); //downpic设置为2，防止重复下载
				}
			}
			else 
			{
				$db->update("UPDATE pv_repos SET downpic='2' WHERE id='$row[id]'"); //downpic设置为2，防止重复下载
			}
			$langtext = lang($langkey);
			$subject .= "<tr class=\"f-tac\"><td width=\"68%\">{$row[subject]}</td><td>$langtext</td></tr>";
		}
		$subject .= '</table>';
		$c_page = $page++;
		adminmsg('downpic_running',"$basename&action=downpic&rid=$rid&page=$page&maxpage=$maxpage&step=2", array($c_page, $maxpage, "$basename&action=manage", $subject), 1);
	}
	else 
	{
		adminmsg('downpic_success', "$basename&action=manage");
	}
}


?>