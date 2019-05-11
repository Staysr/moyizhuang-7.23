<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/class.php';

initvar('action', 'GP');
if($action == 'confirm_classpw')
{
	initvar(array('forward','classpass','cid'), 'GP', 0);
	if($classpass == $_class[$cid]['password'])
	{
		cookie("classpass_$cid", md5($_class[$cid]['password']));
		obheader($forward);
	}
	else
	{
		showmsg('classpw_pwd_error','',$forward);
	}
}
elseif($action == 'del_video')
{
	initvar('vid', 'GP', 2);
	
	$video = $db->get_one("SELECT cid,authorid,yz FROM pv_video WHERE vid='$vid'");
	if(!$video) showmsg('video_illegal');
	
	//权限检查
	if($SYSTEM['allowadmindel'] != '1')
	{
		if($video['authorid'] != $uid || $gp_allowdelatc != '1') showmsg('delete_vod_error');
	}
	
	$uflag = $video['yz'] == '1' ? true : false;
	del_video($vid, $uflag);
	update_siteinfo(array('totalvideo'));
	
	//删除缓存
	$cs->delete('videoinfo_' . $vid);
	$cs->delete('videourl_' . $vid);
	
	refreshto("class.php?cid=$video[cid]", 'operate_success');	
}
?>