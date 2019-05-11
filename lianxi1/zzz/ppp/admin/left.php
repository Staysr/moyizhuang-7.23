<?php
!defined('IN_PHPVOD') && exit('Forbidden');
$lang = require getlang('left');

$leftdb = $lang;
unset($lang);
$leftinfo = '';
$i = 3;

$imgtype = $styletype = array();
list($imgtype[a0], $styletype[a0]) = GetDeploy('a0');
list($imgtype[a1], $styletype[a1]) = GetDeploy('a1');

if($admin['groupid'] != '3')
{
	$permissions = unserialize($admin['permissions']);
}

foreach($leftdb as $key => $left)
{
	$id = 'a' . $i;
	list($imgname, $style) = GetDeploy($id);
	
	$left && $output1 = "<table class=\"left f-w173px f-m0a f-mb8\">
		<tr><th><a class=\"f-fr\" href=\"javascript:;\" onclick=\"return IndexDeploy('$id',1)\"><img id=\"img_$id\" src=\"$imgpath/admin/cate_$imgname.gif\"></a>
		<b>$key</b></th></tr>
		<tbody id=\"cate_$id\" style=\"$style\">
		";
	$output2 = '';
	foreach($left as $key => $value)
	{
		if(is_array($value))
		{
			foreach($value as $k => $v)
			{
				if($admin['groupid'] == '3' || $permissions[$key . '.' . $k] == '1')
					$output2 .= "<tr><td><a href=\"{$admin_file}?adminjob={$key}&admintype={$k}\" target=\"main\">{$v}</a></td>";
			}
		}
		else
		{
			if($admin['groupid'] == '3' || $permissions[$key] == '1')
				$output2 .= "<tr><td><a href=\"{$admin_file}?adminjob={$key}\" target=\"main\">{$value}</a></td>";
		}
	}
	if($output2)
	{
		$output1 .= $output2 . "</tr></td></tr></tbody></table>";
	}
	else
	{
		unset($output1);
	}
	$leftinfo .= $output1;
	$i++;
}
function GetDeploy($name)
{
	global $_COOKIE;
	if(strpos($_COOKIE['deploy'], "\t" . $name . "\t") === false)
	{
		$type = 'fold';
	}
	else
	{
		$type = 'open';
		$style = 'display:none;';
	}
	return array($type, $style);
}

include gettpl('adminleft');
exit();
?>