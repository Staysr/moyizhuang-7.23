<?php
set_time_limit(0);
!defined('IN_PHPVOD') && exit('Forbidden');
require_once PHPVOD_HACK_ROOT . 'function.php';

initvar(array('rid', 'days', 'step'), 'GP', 2);

if(empty($step))
{
	$r = request_service('repos', 'get_page_info', array('rid' => $rid, 'days' => $days), 'get', array(CURLOPT_TIMEOUT => 10));
	if($r['errno'] == 0)
	{
		$page = json_decode($r['return'], true);
		adminmsg('collect_page_info', "$basename&action=collect&rid={$rid}&days={$days}&page=1&maxpage={$page[maxpage]}&step=2");
	}
	else
	{
		adminmsg('getdata_fail', "$basename&action=manage", array($r[errno]), 10);
	}
}
elseif($step == 2)
{
	initvar(array('page', 'maxpage'), 'G', 2);
	if($page <= $maxpage)
	{
		$r = request_service('repos', 'get_video_data', array('rid' => $rid, 'days' => $days, 'page' => $page), 'get', array(CURLOPT_TIMEOUT => 10));
		if($r['errno'] == 0)
		{
			$video_list = json_decode($r['return'], true);
			if(!empty($video_list))
			{
				$subject = '<table class="tableborder f-w98 f-m0a">';
				foreach ($video_list as $video)
				{
					$video['rid'] = $rid;
					$r = import($video);
					if($r['key'] == 'import_empty')
						$langkey = 'import_empty';
					else
						$langkey = $r['status'] > 0 ? $r['key'] . '_1' : $r['key'] . '_' . $r['status'];
					$langtext = lang($langkey);
					$subject .= "<tr class=\"f-tac\"><td width=\"68%\">$video[subject]</td><td>$langtext</td></tr>";
				}
				$subject .= '</table>';
				$c_page = $page++;
				save_progress($rid, array('rid'=>$rid, 'days'=>$days, 'page'=>$page, 'maxpage'=>$maxpage)); //保存采集进度			
				adminmsg('collect_video_limit', "$basename&action=collect&rid={$rid}&days={$days}&page={$page}&maxpage={$maxpage}&step=2", array($c_page, $maxpage, "$basename&action=manage", $subject), 2);
			}
		}
		else
		{
			adminmsg('getdata_fail', "$basename&action=manage", array($r[errno]), 10);
		}
	}
	else
	{
		del_progress($rid); //删除进度
		update_siteinfo(array('totalvideo'));
		if($col_downpic_auto == '1')
			$jurl = "$basename&action=downpic&rid=$rid";
		else 
			$jurl = "$basename&action=manage";
		
		adminmsg('collect_success', $jurl);
	}
}

?>