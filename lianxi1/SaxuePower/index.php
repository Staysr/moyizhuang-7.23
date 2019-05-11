<?php
include "core.php";
include( SAXUE_WEB_PATH . "/header.php" );
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . "/index.html";
if ( SAXUE_USE_CACHE ) {
		$saxueTpl -> setcaching( 1 );
} else {
		$saxueTpl -> setcaching( 0 );
} 
if ( !SAXUE_USE_CACHE || !$saxueTpl -> is_cached( $saxueTset['saxue_page_template'] ) ) {
} 
include( SAXUE_WEB_PATH . "/footer.php" );