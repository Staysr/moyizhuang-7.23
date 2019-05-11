<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/hack.php';

initvar('hackname','G');
if(!isset($_hack[$hackname]) || !is_dir(PHPVOD_ROOT . "hack/$hackname") || !file_exists(PHPVOD_ROOT . "hack/$hackname/index.php"))
{
	showmsg("hack_error");
}

define('PHPVOD_HACK_ROOT', PHPVOD_ROOT . 'hack' . DIRECTORY_SEPARATOR . $hackname . DIRECTORY_SEPARATOR);
$basename = "hack.php?hackname=$hackname";
$hkimg = "hack/$hackname/image";

$_hack[$hackname]['hidden'] != '1' && showmsg('hack_hidden');

require_once path_cv(PHPVOD_HACK_ROOT . "index.php");
?>