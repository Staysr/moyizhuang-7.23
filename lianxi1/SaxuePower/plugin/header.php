<?php 
saxue_checkpower( 'plugin' );
$identifier = trim( $_REQUEST['identifier'] );
$pmod = trim( $_REQUEST['pmod'] );
if ( !isset( $saxuePlugin[$identifier] ) ) {
		saxue_printfail( '插件不存在' );
}
if ( !$saxuePlugin[$identifier]['status'] ) {
		saxue_printfail( '您的站点未开启此插件，请开启相应插件' );
}
$plugin = $saxuePlugin[$identifier];
$saxue_thisurl = saxue_addurlvars( array( 'identifier' => $identifier, 'pmod' => $pmod ), false );
include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
$saxueTpl = &saxuetpl :: getinstance();
$saxueTpl -> setcaching( 0 );
$saxueTpl -> assign( "saxue_thisurl", $saxue_thisurl );
$saxueTpl -> assign( "saxue_pagetitle", SAXUE_SITE_NAME );
$saxueTpl -> assign( "identifier", $identifier );
$saxueTpl -> assign( "pmod", $pmod );
$saxueTpl -> assign( "plugin", $plugin );
define( "SAXUE_PLUGIN_PATH", SAXUE_WEB_PATH . $plugin['path'] );
define( "SAXUE_IN_PLUGIN", 1 );