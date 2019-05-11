<?php
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/page/' . $temp_setting['show_template'];
if ( !file_exists( $saxueTset['saxue_page_template'] ) ) {
		$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/page/show.html';
}
$saxueTset['saxue_page_cacheid'] = $_REQUEST['catid'];
if ( SAXUE_USE_CACHE ) {
		$saxueTpl -> setcaching( 1 );
} else {
		$saxueTpl -> setcaching( 0 );
} 
if ( !SAXUE_USE_CACHE || !$saxueTpl -> is_cached( $saxueTset['saxue_page_template'], $saxueTset['saxue_page_cacheid'] ) ) {
		include_once( SAXUE_ROOT_PATH . "/model/page.php" );
		$data_handler = saxuepagehandler :: getinstance( "saxuepagehandler" );
		$criteria = new criteriacompo( new criteria( 'catid', $_REQUEST['catid'] ) );
		$criteria -> add( new criteria( "lang", SAXUE_LANGUAGE ) );
		$data_handler -> queryobjects( $criteria );
		$page = $data_handler -> getobject();
		if ( is_object( $page ) ) {
				$saxueTpl -> assign( "id", $page -> getvar( 'id' ) );
				$saxueTpl -> assign( "title", $page -> getvar( 'title', 'n' ) );
				$saxueTpl -> assign( "content", $page -> getvar( 'content', 'n' ) );
		} 
}