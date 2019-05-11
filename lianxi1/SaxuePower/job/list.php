<?php
if ( $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['child'] && $saxueColumn[$_REQUEST['catid']]['display'] && ( file_exists( SAXUE_THEME_PATH . '/job/' . $temp_setting['column_template'] ) || file_exists( SAXUE_THEME_PATH . '/job/column.html' ) ) ) {
		$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/job/' . $temp_setting['column_template'];
		if ( !file_exists( $saxueTset['saxue_page_template'] ) ) {
				$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/job/column.html';
		}
		$saxueTset['saxue_page_cacheid'] = $_REQUEST['catid'];
		if ( SAXUE_USE_CACHE ) {
				$saxueTpl -> setcaching( 1 );
		} else {
				$saxueTpl -> setcaching( 0 );
		} 
} else {
		if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) ) $GLOBALS['_REQUEST']['page'] = 1;
		$saxueTset['saxue_page_cacheid'] = $pagecacheid = "c" . $_REQUEST['catid'];
		$saxueTset['saxue_page_cacheid'] .= '_p' . $_REQUEST['page'];
		$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/job/' . $temp_setting['list_template'];
		if ( !file_exists( $saxueTset['saxue_page_template'] ) ) {
				$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/job/list.html';
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
		if ( !$page_used_cache ) {
				include_once( SAXUE_ROOT_PATH . "/model/job.php" );
				$data_handler = saxuejobhandler :: getinstance( "saxuejobhandler" );
				if ( !empty( $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['arrchild'] ) ) {
						$criteria = new criteriacompo( new criteria( 'catid', '(' . $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['arrchild'] . ')', 'IN' ) );
				} else {
						$criteria = new criteriacompo( new criteria( 'catid', $_REQUEST['catid'] ) );
				}
				$criteria -> add( new criteria( 'lang', SAXUE_LANGUAGE ) );
				$criteria -> add( new criteria( 'display', 1 ) );
				$criteria -> setsort( "istop DESC, id" );
				$criteria -> setorder( "DESC" );
				$criteria -> setlimit( $temp_setting['list_pnum'] );
				$criteria -> setstart( ( $_REQUEST['page'] - 1 ) * $temp_setting['list_pnum'] );
				$data_handler -> queryobjects( $criteria );
				$rows = array();
				$k = 0;
				while ( $v = $data_handler -> getobject() ) {
						$rows[$k] = $v -> getvars( 'n' );
						$rows[$k]['catname'] = $saxueMenu[SAXUE_LANGUAGE][$rows[$k]['catid']]['name'];
						$rows[$k]['caturl'] = $saxueMenu[SAXUE_LANGUAGE][$rows[$k]['catid']]['url'];
						$rows[$k]['catdir'] = $saxueColumn[$rows[$k]['catid']]['catdir'];
						++$k;
				}
				if ( !empty( $_REQUEST['ajax_request'] ) ) {
						exit( json_encode( $rows ) );
				}
				$saxueTpl -> assign_by_ref( "rows", $rows );
				// 分页
				include_once( SAXUE_ROOT_PATH . "/lib/util/page.php" );
				if ( SAXUE_USE_CACHE ) {
						saxue_getcachevars( "joblistlog" );
						if ( !is_array( $saxueJoblistlog ) ) {
								$saxueJoblistlog = array();
						} 
						if ( !isset( $saxueJoblistlog[$pagecacheid] ) || SAXUE_CACHE_LIFETIME < SAXUE_NOW_TIME - $saxueJoblistlog[$pagecacheid]['time'] ) {
								$saxueJoblistlog[$pagecacheid] = array( "rows" => $data_handler -> getcount( $criteria ), "time" => SAXUE_NOW_TIME );
								saxue_setcachevars( "joblistlog", $saxueJoblistlog );
						} 
						$listrows = $saxueJoblistlog[$pagecacheid]['rows'];
				} else {
						$listrows = $data_handler -> getcount( $criteria );
				} 
				$jumppage = new saxuepage( $listrows, $temp_setting['list_pnum'], $_REQUEST['page'] );
				$jumppage -> setlink( saxue_geturl( "column_list", $_REQUEST['catid'], '<{$page}>' ) );
				$saxueTpl -> assign( "url_jumppage", $jumppage -> whole_bar() );
				$saxueTpl -> assign( "totalpage", $jumppage -> total_page );
				$saxueTpl -> assign( "totalrows", $listrows );
		}
}