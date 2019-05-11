<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
$GLOBALS['_SESSION'] = array();
@session_destroy();
header( "Location: " . SAXUE_ADMIN_URL );
