<?php
saxue_getconfigs( "configs", 'content' );
if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) ) $GLOBALS['_REQUEST']['page'] = 1;
$saxueTset['saxue_page_cacheid'] = $pagecacheid = $_REQUEST['page'];
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/feedback/' . $temp_setting['list_template'];
if ( !file_exists( $saxueTset['saxue_page_template'] ) ) {
		$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/feedback/list.html';
}
$page_used_cache = false;
if ( SAXUE_USE_CACHE ) {
		$cachedtime = $saxueTpl -> get_cachedtime( $saxueTset['saxue_page_template'], $saxueTset['saxue_page_cacheid'] );
		if ( 0 < $cachedtime && SAXUE_NOW_TIME - $cachedtime < SAXUE_CACHE_LIFETIME ) {
				$page_used_cache = true;
		} 
		if ( !$page_used_cache ) {
				$saxueTpl -> update_cachedtime( $saxueTset['saxue_page_template'], $saxueTset['saxue_page_cacheid'] );
				$saxueTpl -> setcaching( 2 );
		} else {
				$saxueTpl -> setcaching( 1 );
		} 
		$saxueTpl -> setcachetime( 99999999 );
} else {
		$saxueTpl -> setcaching( 0 );
} 
if ( !$page_used_cache && $saxueConfigs['content']['allowviewmsg'] ) {
		include_once( SAXUE_ROOT_PATH . "/model/feedback.php" );
		$data_handler = saxuefeedbackhandler :: getinstance( "saxuefeedbackhandler" );
		$criteria = new criteriacompo( new criteria( 'catid', $_REQUEST['catid'] ) );
		$criteria -> add( new criteria( 'lang', SAXUE_LANGUAGE ) );
		$criteria -> add( new criteria( 'display', 1 ) );
		$criteria -> setsort( "id" );
		$criteria -> setorder( "DESC" );
		$criteria -> setlimit( $temp_setting['list_pnum'] );
		$criteria -> setstart( ( $_REQUEST['page'] - 1 ) * $temp_setting['list_pnum'] );
		$data_handler -> queryobjects( $criteria );
		$rows = array();
		$k = 0;
		while ( $v = $data_handler -> getobject() ) {
				$rows[$k] = $v -> getvars( 'n' );
				++$k;
		} 
		if ( !empty( $_REQUEST['ajax_request'] ) ) {
				exit( json_encode( $rows ) );
		}
		$saxueTpl -> assign_by_ref( "rows", $rows ); 
		// 分页
		include_once( SAXUE_ROOT_PATH . "/lib/util/page.php" );
		if ( SAXUE_USE_CACHE ) {
				saxue_getcachevars( "feedbacklistlog" );
				if ( !is_array( $saxueFeedbacklistlog ) ) {
						$saxueFeedbacklistlog = array();
				} 
				if ( !isset( $saxueFeedbacklistlog[$pagecacheid] ) || SAXUE_CACHE_LIFETIME < SAXUE_NOW_TIME - $saxueFeedbacklistlog[$pagecacheid]['time'] ) {
						$saxueFeedbacklistlog[$pagecacheid] = array( "rows" => $data_handler -> getcount( $criteria ), "time" => SAXUE_NOW_TIME );
						saxue_setcachevars( "feedbacklistlog", $saxueFeedbacklistlog );
				} 
				$listrows = $saxueFeedbacklistlog[$pagecacheid]['rows'];
		} else {
				$listrows = $data_handler -> getcount( $criteria );
		} 
		$jumppage = new saxuepage( $listrows, $temp_setting['list_pnum'], $_REQUEST['page'] );
		$jumppage -> setlink( saxue_geturl( "column_list", $_REQUEST['catid'], '<{$page}>' ) );
		$saxueTpl -> assign( "url_jumppage", $jumppage -> whole_bar() );
		$saxueTpl -> assign( "totalpage", $jumppage -> total_page );
		$saxueTpl -> assign( "totalrows", $listrows );
} 
$saxueTpl -> assign( "allowviewmsg", $saxueConfigs['content']['allowviewmsg'] );
$saxueTpl -> assign( "allowmessage", $saxueConfigs['content']['allowmessage'] );
