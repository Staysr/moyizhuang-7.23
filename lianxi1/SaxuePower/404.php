<?php
@header( "HTTP/1.1 404 Not Found" );
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "core.php";
} 
include_once( SAXUE_WEB_PATH . "/header.php" );
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . "/404.html";
if ( SAXUE_USE_CACHE ) {
		$saxueTpl -> setcaching( 1 );
} else {
		$saxueTpl -> setcaching( 0 );
} 
include_once( SAXUE_WEB_PATH . "/footer.php" );
exit;