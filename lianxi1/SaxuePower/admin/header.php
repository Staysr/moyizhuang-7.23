<?php 
include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
$saxueTpl = &saxuetpl :: getinstance();
$saxueTpl -> setcaching( 0 );
$saxueTpl -> assign( "saxue_thisurl", saxue_addurlvars( array( 'page' => $_REQUEST['page'] ), true, true ) );
if ( empty( $saxue_pagetitle ) ) {
		$saxue_pagetitle = SAXUE_SITE_NAME;
} 
$saxueTpl -> assign( "saxue_pagetitle", $saxue_pagetitle );