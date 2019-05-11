<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower();
if ( isset( $_POST['dosubmit'] ) ) {
		include_once( SAXUE_ROOT_PATH . "/model/system_admin.php" );
		$data_handler = &saxuesystemadminhandler :: getinstance( "saxuesystemadminhandler" );
		$obj = $data_handler -> get( $_SESSION['saxueAdminId'] );
		if ( !is_object( $obj ) ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => LANG_NO_USER ) ) );
		}
		$_POST['oldpassword'] = trim( $_POST['oldpassword'] );
		if ( $obj -> getvar( "password" ) != $data_handler -> encryptpass( $_POST['oldpassword'] ) ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => '旧密码错误' ) ) );
		}
		$_POST['password'] = $data_handler -> encryptpass( trim( $_POST['password'] ) );
		$data_handler -> updatefields( array( 'password' => $_POST['password'] ), 'id=' . $_SESSION['saxueAdminId'] );
		exit( json_encode( array( 'flag' => 1 ) ) );
}
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/editpass.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );