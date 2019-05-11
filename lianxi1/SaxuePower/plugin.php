<?php
include "core.php";
$identifier = trim( $_REQUEST['identifier'] );
if ( !isset( $saxuePlugin[$identifier] ) || !$saxuePlugin[$identifier]['status'] ) {
		saxue_printfail( '插件不存在' );
}
$do = trim( $_REQUEST['do'] );
if ( empty( $do ) || !file_exists( SAXUE_WEB_PATH . $saxuePlugin[$identifier]['path'] . '/' . $do . '.php' ) ) {
		saxue_printfail( '参数错误' );
}
include "header.php";
$plugin = $saxuePlugin[$identifier];
$saxue_thisurl = saxue_addurlvars( array( 'identifier' => $identifier ), false );
$saxueTpl -> assign( "saxue_thisurl", $saxue_thisurl );
$saxueTpl -> assign( "identifier", $identifier );
$saxueTpl -> assign( "plugin", $plugin );
define( "SAXUE_PLUGIN_PATH", SAXUE_WEB_PATH . $plugin['path'] );
include SAXUE_PLUGIN_PATH . '/' . $do . '.php';
include "footer.php";