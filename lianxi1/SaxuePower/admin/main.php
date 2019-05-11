<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower();
include_once( SAXUE_DATA_PATH . "/version.php" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
mysql_connect( SAXUE_DB_HOST, SAXUE_DB_USER, SAXUE_DB_PASS );
$sysinfo = $license = array();
if ( SAXUE_LICENSE != '' ) {
		$_license = explode( '|', base64_decode( SAXUE_LICENSE ) );
		if ( is_array( $_license ) && count( $_license ) == 2 ) {
				$_types = array( 'licensed' => '授权型', 'standard' => '标准型', 'enterprise' => '企业型', 'supreme' => '至尊型' );
				$license['type'] = $_types[$_license[0]];
				$license['code'] = $_license[1];
		}
}
$sysinfo['os'] = PHP_OS;
$sysinfo['soft'] = $_SERVER['SERVER_SOFTWARE'];
$sysinfo['verphp'] = PHP_VERSION;
$sysinfo['vermysql'] = mysql_get_server_info();
$sysinfo['domain'] = $_SERVER['SERVER_NAME'];
$sysinfo['webdir'] = SAXUE_WEB_PATH;
$sysinfo['rootdir'] = SAXUE_ROOT_PATH;
$sysinfo['time'] = date( "Y-m-d H:i:s" );
$saxueTpl -> assign_by_ref( "sysinfo", $sysinfo );
$saxueTpl -> assign_by_ref( "license", $license );
$saxueTpl -> assign_by_ref( "ver", $saxueVersion );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/main.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
