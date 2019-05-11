<?php
!defined('IN_PHPVOD') && exit('Forbidden');

$hackdb = array();
if(is_array($_hack) && !empty($_hack))
{
	foreach($_hack as $value)
	{
		if(file_exists(PHPVOD_ROOT."hack/{$value[directory]}/index.php") && $value['hidden']=='1' && $value['spos']!='0') $hackdb[$value[spos]][]=$value;
	}
}

call_listener('run_header'); //监听器
require_once gettpl('header');
?>