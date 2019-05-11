<?php
!defined('IN_PHPVOD') && exit('Forbidden');
$repos_list = array();
$r = request_service('repos', 'get_repos_list');
if($r['errno'] == 0)
{
	$repos_list = json_decode($r['return'], true);
}
include_once get_hack_tpl('manage');
?>