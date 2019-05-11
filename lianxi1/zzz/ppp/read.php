<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/class.php';
include_once PHPVOD_ROOT . 'data/cache/nation.php';
include_once PHPVOD_ROOT . 'data/cache/level.php';
include_once PHPVOD_ROOT . 'data/cache/bwd.php';

initvar('vid', 'GP', 2);
!is_numeric($vid) && showmsg('video_illegal');

$video = get_video_info($vid);
if(empty($video) || ($SYSTEM['allowadminshow'] != '1' && $video['yz'] != '1')) showmsg('video_error');

$cid = $video['cid'];

//用户组权限检测
if($gp_allowread != '1') showmsg('group_read');

//栏目权限检测
$cr = pv_class_allow($cid);
switch($cr['result'])
{
	case '-1':
		showmsg('read_guest');
		break;
	case '-2':
		showmsg('read_visit');
		break;
	case '-3':
		showmsg('read_guestlimit');
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

//导航
$navpath = navpath($video['cid']);

//影片信息处理
$video['picurl'] = get_poster_url($video['picserver'], $video['picfolder'], $video['pic'], 3);

if(!empty($video['tag']))
{
	$tagdb = pv_explode(array(',', '/', ' '), $video['tag']);
	foreach($tagdb as $key)
		$video['tag_link'] .= "<a href=search.php?action=search&field=tag&orderway=postdate&asc=DESC&keyword=" . urlencode($key) . ">$key</a> ";
}

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

$editvideo = $delvideo = '0';
if($groupid != 'guest' && (($video['authorid'] == $uid && $gp_alloweditatc == '1') || $SYSTEM['allowadminedit'] == '1')) $editvideo = '1';
if($groupid != 'guest' && (($video['authorid'] == $uid && $gp_allowdelatc == '1') || $SYSTEM['allowadmindel'] == '1')) $delvideo = '1';

//获取视频播放地址
$urldb = get_urls_info($video['vid'], 0);

//更新视频的点击数
$video['hits'] = update_video_hits($vid, 1);

$top = strpos($_class[$cid]['fathers'], ',') === false ? $_class[$cid]['fathers'] : substr($_class[$cid]['fathers'], 0, strpos($_class[$cid]['fathers'], ',')); //topID
//模板文件
$tplfile = $_class[$cid]['read_tplfile'] != '' ? $_class[$cid]['read_tplfile'] : 'read'; //tplfile

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl($tplfile);
footer();
?>