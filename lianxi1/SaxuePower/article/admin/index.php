<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../../core.php";
} 
saxue_checkpower( 'content' );
saxue_getconfigs( 'column' );
$catid = intval( $_REQUEST['catid'] );
if ( !isset( $saxueColumn[$catid] ) ) {
		saxue_printfail( '栏目不存在' );
}
include_once( SAXUE_ROOT_PATH . "/model/article.php" );
$data_handler = saxuearticlehandler :: getinstance( "saxuearticlehandler" );
if ( !empty( $_REQUEST['batchaction'] ) && !empty( $_REQUEST['ids'] ) && is_array( $_REQUEST['ids'] ) && count( $_REQUEST['ids'] ) > 0 ) {
		switch ( $_REQUEST['batchaction'] ) {
				case 'delete':
						$data_handler -> db -> query( "DELETE FROM " . saxue_dbprefix( "article_data" ) . " WHERE id IN(" . implode( ',', $_REQUEST['ids'] ) . ")" );
						$data_handler -> db -> query( "DELETE FROM " . saxue_dbprefix( "article" ) . " WHERE id IN(" . implode( ',', $_REQUEST['ids'] ) . ")" );
						break;
				case 'nodisplay':
						$data_handler -> updatefields( array( 'display' => 0 ), 'id IN(' . implode( ',', $_POST['ids'] ) . ')' );
						break;
				case 'display':
						$data_handler -> updatefields( array( 'display' => 1 ), 'id IN(' . implode( ',', $_POST['ids'] ) . ')' );
						break;
				case 'istop':
						$data_handler -> updatefields( array( 'istop' => 1 ), 'id IN(' . implode( ',', $_POST['ids'] ) . ')' );
						break;
				case 'caceltop':
						$data_handler -> updatefields( array( 'istop' => 0 ), 'id IN(' . implode( ',', $_POST['ids'] ) . ')' );
						break;
		}
		if ( empty( $_REQUEST['jumpurl'] ) ) {
				saxue_jumppage( 'index.php?catid=' . $catid, LANG_DO_SUCCESS );
		} else {
				saxue_jumppage( $_REQUEST['jumpurl'], LANG_DO_SUCCESS );
		}
}
if ( empty( $_REQUEST['pagesize'] ) || !is_numeric( $_REQUEST['pagesize'] ) || !in_array( $_REQUEST['pagesize'], array( '10', '30', '50', '100' ) ) ) $_REQUEST['pagesize'] = 30;
if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) ) $GLOBALS['_REQUEST']['page'] = 1;
$criteria = new criteriacompo( new criteria( 'catid', $catid ) );
if ( !empty( $_REQUEST['lang'] ) ) {
		$criteria -> add( new criteria( 'lang', $_REQUEST['lang'] ) );
} 
if ( isset( $_REQUEST['display'] ) && $_REQUEST['display'] != '' ) {
		$criteria -> add( new criteria( 'display', $_REQUEST['display'] ) );
}
if ( isset( $_REQUEST['istop'] ) && $_REQUEST['istop'] != '' ) {
		$criteria -> add( new criteria( 'istop', $_REQUEST['istop'] ) );
}
if ( isset( $_REQUEST['islink'] ) && $_REQUEST['islink'] != '' ) {
		$criteria -> add( new criteria( 'islink', $_REQUEST['islink'] ) );
}
if ( !empty( $_REQUEST['fromtime'] ) ) {
		$criteria -> add( new criteria( $_REQUEST['mtype'], strtotime( $_REQUEST['fromtime'] . " 00:00:00" ), '>=' ) );
} 
if ( !empty( $_REQUEST['totime'] ) ) {
		$criteria -> add( new criteria( $_REQUEST['mtype'], strtotime( $_REQUEST['totime'] . " 23:59:59" ), '<=' ) );
} 
if ( !empty( $_REQUEST['keytype'] ) && !empty( $_REQUEST['keyword'] ) ) {
		$criteria -> add( new criteria( $_REQUEST['keytype'], $_REQUEST['keyword'], 'REGEXP' ) );
} 
$criteria -> setsort( "id" );
$criteria -> setorder( "DESC" );
$criteria -> setlimit( $_REQUEST['pagesize'] );
$criteria -> setstart( ( $_REQUEST['page'] - 1 ) * $_REQUEST['pagesize'] );
$data_handler -> queryobjects( $criteria );
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( 'n' );
		$rows[$k]['langname'] = $saxueLanguage[$rows[$k]['lang']]['name'];
		++$k;
}
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "rows", $rows );
$saxueTpl -> assign_by_ref( "lang", $saxueLanguage );
$saxueTpl -> assign( "catid", $catid );
$saxueTpl -> assign( "admincenter", 1 );
include_once( SAXUE_ROOT_PATH . "/lib/util/page.php" );
$jumppage = new saxuepage( $data_handler -> getcount( $criteria ), $_REQUEST['pagesize'], $_REQUEST['page'] );
$jumppage -> setlink( "", true, true );
$saxueTpl -> assign( "url_jumppage", $jumppage -> whole_bar() );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/article/templates/index.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );