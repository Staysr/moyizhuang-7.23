<?php
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/article/' . $temp_setting['show_template'];
if ( !file_exists( $saxueTset['saxue_page_template'] ) ) {
		$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/article/show.html';
}
$saxueTset['saxue_page_cacheid'] = $_REQUEST['id'];
if ( SAXUE_USE_CACHE ) {
		$saxueTpl -> setcaching( 1 );
} else {
		$saxueTpl -> setcaching( 0 );
} 
if ( !SAXUE_USE_CACHE || !$saxueTpl -> is_cached( $saxueTset['saxue_page_template'], $saxueTset['saxue_page_cacheid'] ) ) {
		include_once( SAXUE_ROOT_PATH . "/model/article.php" );
		$article_handler = saxuearticlehandler :: getinstance( "saxuearticlehandler" );
		$article = $article_handler -> get( $_REQUEST['id'] );
		if ( !is_object( $article ) ) {
				include SAXUE_WEB_PATH . "/404.php";
		} 
		$row = $article -> getvars( 'n' );
		if ( $row['islink'] || !$row['display'] || $row['catid'] != $_REQUEST['catid'] || $row['lang'] != SAXUE_LANGUAGE ) {
				include SAXUE_WEB_PATH . "/404.php";
		} 
		include SAXUE_ROOT_PATH . "/model/article_data.php";
		$data_handler = saxuearticledatahandler :: getinstance( "saxuearticledatahandler" );
		$data = $data_handler -> get( $_REQUEST['id'] );
		$row['content'] = $data -> getvar( 'content', 'n' );
		$pics = array();
		$k = 0;
		if ( preg_match_all( "/src=([\"|']?)([^ \"'>]+\.(jpg|jpeg|gif|png|bmp)[^ \"'>]*)\\1/i", $row['content'], $matches ) ) {
				foreach( $matches[2] as $url ) {
						$pics[$k]['url'] = $url;
						$tmp = getimagesize( $pics[$k]['url'] );
						$pics[$k]['width'] = $tmp[0];
						$pics[$k]['height'] = $tmp[1];
						++$k;
				}
		}
		$saxueTpl -> assign_by_ref( "row", $row );
		$saxueTpl -> assign_by_ref( "pics", $pics );
		$saxueTpl -> assign_by_ref( "picnum", count( $pics ) );
}