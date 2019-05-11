<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'content' );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "admincenter", 1 );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/content.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
