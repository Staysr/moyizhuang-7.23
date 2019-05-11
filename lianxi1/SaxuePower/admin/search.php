<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'search' );
include SAXUE_ROOT_PATH . "/model/search.php";
$search_handler = &saxuesearchhandler :: getinstance( "saxuesearchhandler" );
if ( !empty( $_REQUEST['action'] ) && !empty( $_REQUEST['ids'] ) && is_array( $_REQUEST['ids'] ) && count( $_REQUEST['ids'] ) > 0 ) {
		switch ( $_REQUEST['action'] ) {
				case 'delete':
						$search_handler -> db -> query( "DELETE FROM " . saxue_dbprefix( "search" ) . " WHERE searchid IN(" . implode( ',', $_REQUEST['ids'] ) . ")" );
						break;
				case 'cache':
						$search_handler -> updatefields( array( 'searchtime' => 0 ), 'searchid IN(' . implode( ',', $_REQUEST['ids'] ) . ')' );
						break;
		}
		if ( empty( $_REQUEST['jumpurl'] ) ) {
				saxue_jumppage( 'search.php', LANG_DO_SUCCESS );
		} else {
				saxue_jumppage( $_REQUEST['jumpurl'], LANG_DO_SUCCESS );
		}
}
saxue_getconfigs( 'configs', 'content' );
$searchcache = intval( $saxueConfigs['content']['searchcache'] );
if ( empty( $searchcache ) ) {
		$searchcache = 86400;
} 
if ( empty( $_REQUEST['pagesize'] ) || !is_numeric( $_REQUEST['pagesize'] ) || !in_array( $_REQUEST['pagesize'], array( '20', '30', '50', '100' ) ) ) $_REQUEST['pagesize'] = 30;
if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) ) $GLOBALS['_REQUEST']['page'] = 1;
$criteria = new criteriacompo();
if ( !empty( $_REQUEST['keywords'] ) ) {
		$criteria -> add( new criteria( 'keywords', $_REQUEST['keywords'], 'REGEXP' ) );
} 
if ( isset( $_REQUEST['form_sort'] ) && !empty( $_REQUEST['form_sort'] ) ) {
		$criteria -> setsort( $_REQUEST['form_sort'] );
} else {
		$criteria -> setsort( "searchid" );
} 
if ( isset( $_REQUEST['form_order'] ) && !empty( $_REQUEST['form_order'] ) ) {
		$criteria -> setorder( $_REQUEST['form_order'] );
} else {
		$criteria -> setorder( "DESC" );
} 
$criteria -> setlimit( $_REQUEST['pagesize'] );
$criteria -> setstart( ( $_REQUEST['page'] - 1 ) * $_REQUEST['pagesize'] );
$search_handler -> queryobjects( $criteria );
$rows = array();
$k = 0;
saxue_getconfigs( 'module' );
saxue_getconfigs( 'column' );
while ( $v = $search_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( 'n' );
		$rows[$k]['cacheto'] = $rows[$k]['searchtime'] + $searchcache; 
		$rows[$k]['modname'] = $saxueModule[$rows[$k]['modid']]['name'];
		$rows[$k]['url'] = '/search.php?q=' . urlencode( $rows[$k]['keywords'] ); 
		if ( $rows[$k]['catid'] > 0 ) {
				$rows[$k]['catname'] = $saxueColumn[$rows[$k]['catid']]['catname'];
				$rows[$k]['caturl'] = $saxueColumn[$rows[$k]['catid']]['url'];
				$rows[$k]['url'] .= '&catid=' . $rows[$k]['catid'];
		} else {
				$rows[$k]['url'] .= '&modid=' . $rows[$k]['modid'];
		}
		++$k;
} 
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" ); 
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "rows", $rows );
include_once( SAXUE_ROOT_PATH . "/lib/util/page.php" );
$jumppage = new saxuepage( $search_handler -> getcount( $criteria ), $_REQUEST['pagesize'], $_REQUEST['page'] );
$jumppage -> setlink( "", true, true );
$saxueTpl -> assign( "url_jumppage", $jumppage -> whole_bar() );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/search.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );