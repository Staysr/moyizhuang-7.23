<?php
require_once 'global.php';

initvar(array('vid','step'),'GP',2);
initvar(array('type','reason'));

!is_numeric($vid) && showmsg('video_illegal');
$groupid == 'guest' && showmsg('not_login');

$video = get_video_info($vid);
if(empty($video)) showmsg('video_error');

$rt = $db->get_one("SELECT vid FROM pv_report WHERE uid='$uid' AND vid='$vid'");
if($rt) showmsg('have_report');
if($step == 2)
{
	$db->update("INSERT INTO pv_report(vid,uid,type,reason) VALUES('$vid','$uid','$type','$reason')");
	refreshto("read.php?vid=$vid", 'operate_success');
}

require_once (PHPVOD_ROOT . 'require/header.php');
require_once gettpl('report');
footer();
?>