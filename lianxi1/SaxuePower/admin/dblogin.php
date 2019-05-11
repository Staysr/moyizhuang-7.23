<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower();
saxue_loadlang( "database" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
if ( $_POST['action'] == "login" ) {
		if ( trim( $_POST['dbuser'] ) != trim( SAXUE_DB_USER ) || trim( $_POST['dbpass'] ) != trim( SAXUE_DB_PASS ) ) {
				saxue_printfail( $saxueLang['database']['db_error_userpass'], 0 );
		} 
		$GLOBALS['_SESSION']['saxueDbLogin'] = 1;
		if ( empty( $_REQUEST['jumpurl'] ) ) {
				$GLOBALS['_REQUEST']['jumpurl'] = SAXUE_ADMIN_URL . "/dboptimize.php?option=optimize";
		} 
		header( "Location: " . $_REQUEST['jumpurl'] );
		exit();
} 
$self_fname = $_SERVER['PHP_SELF'] ? basename( $_SERVER['PHP_SELF'] ) : basename( $_SERVER['SCRIPT_NAME'] );
if ( !empty( $_REQUEST['jumpurl'] ) ) {
		$saxueTpl -> assign( "url_dblogin", SAXUE_ADMIN_URL . "/" . $self_fname . "?do=submit&jumpurl=" . urlencode( $_REQUEST['jumpurl'] ) );
} else {
		$saxueTpl -> assign( "url_dblogin", SAXUE_ADMIN_URL . "/" . $self_fname . "?do=submit" );
} 
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/dblogin.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );