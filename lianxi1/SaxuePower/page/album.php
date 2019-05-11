<?php
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/page/album.html';
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
		$pics = array();
		$k = 0;
		if ( is_object( $page ) ) {
				$row = $page -> getvars( 'n' );
				if ( preg_match_all( "/src=([\"|']?)([^ \"'>]+\.(jpg|jpeg|gif|png|bmp)[^ \"'>]*)\\1/i", $row['content'], $matches ) ) {
						foreach( $matches[2] as $url ) {
								$pics[$k]['url'] = $url;
								$tmp = getimagesize( $pics[$k]['url'] );
								$pics[$k]['width'] = $tmp[0];
								$pics[$k]['height'] = $tmp[1];
								++$k;
						}
				}
		} 
		$saxueTpl -> assign_by_ref( "row", $row );
		$saxueTpl -> assign_by_ref( "pics", $pics );
		$saxueTpl -> assign_by_ref( "picnum", count( $pics ) );
}