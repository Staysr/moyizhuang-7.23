<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
include_once( SAXUE_WEB_PATH . "/header.php" );
if ( isset( $_POST['dosubmit'] ) ) {
		if ( !defined( "SAXUE_EMAIL" ) || SAXUE_EMAIL == '' ) {
				// 收件邮箱为空
				exit( json_encode( array( 'flag' => 101 ) ) );
		}
		$_POST['checkcode'] = trim( $_POST['checkcode'] );
		if ( $_POST['checkcode'] != $_SESSION['saxueCheckCode'] ) {
				// 验证码错误
				exit( json_encode( array( 'flag' => 102 ) ) );
		} 
		$_POST['sendfrom'] = trim( $_POST['sendfrom'] );
		$_POST['subject'] = trim( $_POST['subject'] );
		$_POST['content'] = trim( $_POST['content'] );
		$_POST['content'] .= '<br><br>----------------------------------------------------------------<br><br>Send From: ' . $_POST['sendfrom'];
		saxue_getconfigs( "configs" );
		//$saxueConfigs['system']['mailfrom'] = $_POST['sendfrom'];
		include( SAXUE_ROOT_PATH . "/common/function.php" );
		$ret = saxue_sendmail( SAXUE_EMAIL, $_POST['subject'], $_POST['content'] );
		if ( !$ret['flag'] ) {
				// 发送失败
				exit( json_encode( array( 'flag' => 103, 'msg' => $ret['msg'] ) ) );
		}
		exit( json_encode( array( 'flag' => 1 ) ) );
}
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/extend/email.html';
if ( SAXUE_USE_CACHE ) {
		$saxueTpl -> setcaching( 1 );
} else {
		$saxueTpl -> setcaching( 0 );
} 
if ( !SAXUE_USE_CACHE || !$saxueTpl -> is_cached( $saxueTset['saxue_page_template'] ) ) {
} 
include( SAXUE_WEB_PATH . "/footer.php" );