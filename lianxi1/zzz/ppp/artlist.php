<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/artclass.php';
initvar(array('classid','page'),'G',2);
if(!is_numeric($classid) || !isset($_artclass[$classid])) showmsg('class_illegal');
if(!is_numeric($page) || $page < 1) $page = 1;
require_once PHPVOD_ROOT.'require/header.php';
require_once gettpl('artlist');footer();
?>