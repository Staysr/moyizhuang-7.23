<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if($action == 'shift')
{
	initvar(array('urla','urlb'),'P');
	$count = 0;
	$query = $db->query("SELECT uid,url FROM pv_urls");
	while($rt = $db->fetch_array($query))
	{
		$rt['url'] = str_replace($urla, $urlb, $rt['url'],$n);
		$db->update("UPDATE pv_urls SET url='$rt[url]' WHERE uid='$rt[uid]'");
		$count+=$n;
	}
	adminmsg('repeat_success','',array($count));
}

include gettpl('editurl');
?>