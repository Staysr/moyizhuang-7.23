<?php
!defined('IN_PHPVOD') && exit('Forbidden');

$tabledb=array(
	'pv_advert',
	'pv_artclass',
	'pv_article',
	'pv_buy',
	'pv_class',
	'pv_config',
	'pv_credits',
	'pv_extgroups',
	'pv_favorite',
	'pv_hack',
	'pv_hackvar',
	'pv_listener',
	'pv_membercredit',
	'pv_memberdata',
	'pv_memberinfo',
	'pv_members',
	'pv_msg',
	'pv_nations',
	'pv_player',
	'pv_reply',
	'pv_report',
	'pv_sharelinks',
	'pv_styles',
	'pv_urls',
	'pv_usergroups',
	'pv_video',
	'pv_videodata',
);

if($dbpre!='pv_')
{
	foreach($tabledb as $key=>$value)
	{
		$tabledb[$key] = str_replace('pv_',$dbpre,$value);
	}
}

?>