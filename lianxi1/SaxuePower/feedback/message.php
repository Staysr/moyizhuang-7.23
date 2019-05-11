<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
include_once( SAXUE_WEB_PATH . "/header.php" );
saxue_getconfigs( "configs", 'content' );
if ( isset( $_POST['dosubmit'] ) ) {
		if ( !$saxueConfigs['content']['allowmessage'] ) {
				// 留言关闭
				exit( json_encode( array( 'flag' => 101 ) ) );
		}
		$_POST['checkcode'] = trim( $_POST['checkcode'] );
		if ( $_POST['checkcode'] != $_SESSION['saxueCheckCode'] ) {
				// 验证码错误
				exit( json_encode( array( 'flag' => 102 ) ) );
		} 
		$_POST['content'] = saxue_htmlstr( trim( $_POST['content'] ) );
		if ( empty( $_POST['content'] ) ) {
				// 留言内容为空
				exit( json_encode( array( 'flag' => 103 ) ) );
		}
		$_POST['tel'] = saxue_htmlstr( trim( $_POST['tel'] ) );
		$_POST['name'] = saxue_htmlstr( trim( $_POST['name'] ) );
		$_POST['email'] = saxue_htmlstr( trim( $_POST['email'] ) );
		include_once( SAXUE_ROOT_PATH . "/model/feedback.php" );
		$data_handler = saxuefeedbackhandler :: getinstance( "saxuefeedbackhandler" );
		$message = $data_handler -> create();
		$message -> setvar( 'lang', SAXUE_LANGUAGE );
		$message -> setvar( 'ip', saxue_userip() );
		$message -> setvar( 'addtime', SAXUE_NOW_TIME );
		$message -> setvar( 'display', $saxueConfigs['content']['msgdispaly'] );
		if ( !$data_handler -> insert( $message ) ) {
				// 数据库错误
				exit( json_encode( array( 'flag' => 104 ) ) );
		}
		exit( json_encode( array( 'flag' => 1 ) ) );
}
if ( !$saxueConfigs['content']['allowmessage'] ) {
		include SAXUE_WEB_PATH . "/404.php";
}
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/feedback/message.html';
include_once( SAXUE_WEB_PATH . "/footer.php" );