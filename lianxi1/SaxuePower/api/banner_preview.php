<?php
include "../core.php";
include SAXUE_ROOT_PATH . "/common/banner.php";
$id = intval( $_GET['id'] );
$type = intval( $_GET['type'] );
echo '<script type="text/javascript" src="' . SAXUE_SKIN_SERVER . '/lib/jquery1.7.2.js"></script>' . get_banner( $id, $type );