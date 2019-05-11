<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/class.php';

initvar('cid', 'GP', 2);
if(!is_numeric($cid) || !isset($_class[$cid])) showmsg('class_illegal');

$_class[$cid]['link'] != '' && obheader($_class[$cid]['link']);
$tplfile = $_class[$cid]['tplfile'] != '' ? $_class[$cid]['tplfile'] : 'category';

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl($tplfile); footer();

?>