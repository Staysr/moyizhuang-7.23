<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../../core.php";
} 
saxue_checkpower( 'content' );
$_REQUEST['id'] = intval( $_REQUEST['id'] );
if ( empty( $_REQUEST['id'] ) ) {
		saxue_printfail( LANG_ERROR_PARAMETER );
}
include_once( SAXUE_ROOT_PATH . "/model/feedback.php" );
$data_handler = saxuefeedbackhandler :: getinstance( "saxuefeedbackhandler" );
$feedback = $data_handler -> get( $_REQUEST['id'] );
if ( isset( $_POST['dosubmit'] ) ) {
		$_POST['reply'] = trim( $_POST['reply'] );
		$_POST['display'] = intval( $_POST['display'] );
		$feedback -> setvar( 'display', $_POST['display'] );
		$feedback -> setvar( 'reply', $_POST['reply'] );
		$feedback -> setvar( 'updatetime', SAXUE_NOW_TIME );
		if ( !$data_handler -> insert( $feedback ) ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
		}
		if ( isset( $_POST['sendemail'] ) && !empty( $_POST['reply'] ) ) {
				$lang = $feedback -> getvar( "lang" );
				$email = $feedback -> getvar( "email" );
				$content = $feedback -> getvar( "content", 'n' );
				saxue_getconfigs( "configs" );
				saxue_getconfigs( $lang, 'lang', 'Lang' );
				$title = SAXUE_SITE_NAME . $Lang['feedback_title'];
				$content = sprintf( $Lang['feedback_content'], $email, nl2br( $content ), nl2br( $_POST['reply'] ) );
				$content .= '<br><br>----------------------------------------------------------------<br><br><a href="' . $saxueLanguage[$lang]['url'] . '" target="_blank">' . $saxueLanguage[$lang]['url'] . '</a>';
				include( SAXUE_ROOT_PATH . "/common/function.php" );
				saxue_sendmail( $email, $title, $content );
		}
		exit( json_encode( array( 'flag' => 1 ) ) );
}
if ( !is_object( $feedback ) ) {
		saxue_printfail( '留言不存在' );
} 
$row = $feedback -> getvars( 'n' );
if ( !$row['isread'] ) {
		$feedback -> setvar( 'isread', 1 );
		$data_handler -> insert( $feedback );
} 
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "row", $row );
$saxueTpl -> assign( "admincenter", 1 );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/feedback/templates/detail.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );