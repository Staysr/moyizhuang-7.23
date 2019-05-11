<?php
session_start();
require dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)) . '/ValidateCode.class.php';
$_vc = new ValidateCode();
$_vc -> doimg();
$_SESSION['authnum_session'] = $_vc -> getCode();
