<?php
if ( !isset( $_REQUEST['action'] ) ) {
		$_REQUEST['action'] = "";
}
if ( $_REQUEST['action'] == "login" ) {
		define( "SAXUE_NEED_SESSION", 1 );
} 
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
if ( !empty( $_SESSION['saxueAdminId'] ) ) {
		header( "Location: " . SAXUE_ADMIN_URL );
		exit();
} 
if ( $_REQUEST['action'] == "login" && !empty( $_REQUEST['password'] ) && !empty( $_REQUEST['account'] ) ) {
		include SAXUE_ROOT_PATH . "/model/system_admin.php";
		$admin_handler = &saxuesystemadminhandler :: getinstance( "saxuesystemadminhandler" );
		$criteria = new criteriacompo( new criteria( "account", $_REQUEST['account'] ) );
		$admin_handler -> queryobjects( $criteria );
		$saxueAdmin = $admin_handler -> getobject();
		if ( is_object( $saxueAdmin ) && $saxueAdmin -> getvar( "status", "n" ) == 1 ) {
				$truepass = $saxueAdmin -> getvar( "password", "n" );
				$enpass = $admin_handler -> encryptpass( $_REQUEST['password'] );
				if ( $truepass == $enpass ) {
						$_SESSION['saxueAdminId'] = $saxueAdmin -> getvar( "id", "n" );
						$_SESSION['saxueAdminAccount'] = $saxueAdmin -> getvar( "account", "n" );
						$_SESSION['saxueAdminIsFounder'] = $saxueAdmin -> getvar( "isfounder", "n" );
						$_SESSION['saxueAdminRole'] = $saxueAdmin -> getvar( "role", "n" );
						$admin_handler -> updatefields( array( 'lasttime' => SAXUE_NOW_TIME, 'lastip' => saxue_userip() ), 'id=' . $saxueAdmin -> getvar( "id", "n" ) );
						if ( empty( $_REQUEST['jumpurl'] ) ) {
								$_REQUEST['jumpurl'] = SAXUE_ADMIN_URL;
						}
						header( "Location: " . $_REQUEST['jumpurl'] );
						exit();
				}
		}
} 
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> display( SAXUE_ROOT_PATH . "/templates/admin/login.html" );
