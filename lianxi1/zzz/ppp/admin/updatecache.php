<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(is_array($action))
{
	foreach ($action as $act)
	{
		if($act == 'cache')
		{
			updatecache();
		}
		elseif($act == 'template_cache')
		{
			updatecache_template();
		}
		elseif($act == 'data_cache')
		{
			$cs->clear();
		}
		elseif($act == 'siteinfo')
		{
			update_siteinfo(array('newmember','totalmember','totalvideo'));
		}
		elseif($act == 'memberid_cache')
		{
			updatecache_memberid();
		}
		elseif($act == 'video_count')
		{
			update_video_count();
		}
	}
	adminmsg('operate_success');
}

include gettpl('updatecache');
?>