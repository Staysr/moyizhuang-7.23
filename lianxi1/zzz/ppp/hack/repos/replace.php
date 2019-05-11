<?php
! defined('IN_PHPVOD') && exit('Forbidden');
initvar('rid', 'GP', 2);
initvar('type', 'GP', 0);

if(! IS_POST)
{
	$item_list = array();
	if(in_array($type, array('class', 'nation', 'player')))
	{
		$r = request_service('repos', "get_{$type}_list", array('rid' => $rid));
		if($r['errno'] == 0) $item_list = json_decode($r['return'], true);

		$replace_list = array();
		$replace_list_file = PHPVOD_HACK_ROOT . 'cache' . DIRECTORY_SEPARATOR . 'r' . $rid . '_replace' . $type . '.php';
		if(is_file($replace_list_file))
		{
			include $replace_list_file;
		}
		include_once get_hack_tpl('replace');
	}
}
else
{
	initvar(array('search', 'replace'), 'P', 0);
	$replace_list = array();
	foreach($replace as $key => $value)
	{
		if(empty($value)) continue;
		$replace_list[] = array('str1' => $search[$key], 'str2' => $value);
	}
	$replace_list_file = PHPVOD_HACK_ROOT . 'cache' . DIRECTORY_SEPARATOR . 'r' . $rid . '_replace' . $type . '.php';
	$replace_list = '$replace_list = ' . pv_var_export($replace_list) . ";\r\n";
	writeover($replace_list_file, "<?php\r\n" . $replace_list . "?>");
	adminmsg('operate_success',"{$basename}&action=manage",array(),10);
}

?>