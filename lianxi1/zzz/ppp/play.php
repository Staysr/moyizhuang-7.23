<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/class.php';
include_once PHPVOD_ROOT . 'data/cache/nation.php';
include_once PHPVOD_ROOT . 'data/cache/bwd.php';
initvar(array('vid', 'playgroup', 'index'), 'GP', 2);

$video = get_video_info($vid);
if(empty($video) || ($SYSTEM['allowadminshow'] != '1' && $video['yz'] != '1')) showmsg('data_error');
$cid = $video['cid'];

//用户组权限检测
if($gp_allowplay != '1') showmsg('group_play');

//栏目权限检测
$cr = pv_class_allow($cid);
switch($cr['result'])
{
	case '-1':
		showmsg('play_guest');
		break;
	case '-2':
		showmsg('play_noper');
		break;
	case '-3':
		showmsg('play_guestlimit');
		break;
	case '-4':
		showmsg('class_creditlimit','','',array($cr['data']['class_rvrcneed'],$cr['data']['user_rvrc'],$cr['data']['class_moneyneed'],$cr['data']['user_money'],$cr['data']['class_postneed'],$cr['data']['user_postnum']),30);
		break;
	case '-5':
		showmsg('classpw_guest');
		break;
	case '-6':
		$cid = $cr['data']['cid'];
		$forward = $cr['data']['forward'];
		require_once PHPVOD_ROOT . 'require/header.php';
		require_once gettpl('classpw');
		footer();
		break;
}

//视频权限检测
$vr = pv_video_allow($video);
if($vr['result'] != '1') showmsg('play_credit_buy');

//获取视频播放地址的相关信息
$urldb = get_urls_info($video['vid'], 0);

//获取视频播放器
$player = get_video_player($urldb, $playgroup, $index);

//导航
$urlcaption = $urldb[$playgroup]['urls'][$index]['caption'];
$navpath = navpath($video['cid']);

//影片信息处理
$video['picurl'] = get_poster_url($video['picserver'], $video['picfolder'], $video['pic'], 3);

if(!empty($video['playactor']))
{
	$playdb = pv_explode(array(',', '/', ' '), $video['playactor']);
	foreach($playdb as $key)
		$video['playactor_link'] .= "<a href=search.php?action=search&field=playactor&orderway=postdate&asc=DESC&keyword=" . urlencode($key) . ">$key</a> ";
}

if(!empty($video['director']))
{
	$diredb = pv_explode(array(',', '/', ' '), $video['director']);
	foreach($diredb as $key)
		$video['director_link'] .= "<a href=search.php?action=search&field=director&orderway=postdate&asc=DESC&keyword=" . urlencode($key) . ">$key</a> ";
}

$video['class_name'] = $_class[$video['cid']]['caption'];
$video['nation_name'] = $_nation[$video['nid']];
$video['synopsis'] = ieconvert($video['synopsis']);
$video['subject'] = str_replace($_bwddb, '*', $video['subject']);
$video['synopsis'] = str_replace($_bwddb, '*', $video['synopsis']);


//添加事件
if($db_mergesystype == 'ucenter' && ($db_mergefeed & 4))
{
	$data = array(
					'title_template' => lang('uchomefeed_playvideo_title_template'),
					'class_id' => $cid,
					'class_caption' => $_class[$cid]['caption'],
					'video_id' => $video['vid'],
					'video_subject' => $video['subject'],
					'playgroup' => $playgroup,
					'url_index' => $index,
					'url_caption' => $urlcaption
				);
	$n = pv_feed_add('playvideo', $data);
}

//模板文件
$tplfile = $_class[$cid]['play_tplfile'] != '' ? $_class[$cid]['play_tplfile'] : 'play'; //tplfile

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl($tplfile);
footer();
?>