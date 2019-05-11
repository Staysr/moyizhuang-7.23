<?php
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/product/album.html';
$saxueTset['saxue_page_cacheid'] = $_REQUEST['id'];
if ( SAXUE_USE_CACHE ) {
		$saxueTpl -> setcaching( 1 );
} else {
		$saxueTpl -> setcaching( 0 );
} 
if ( !SAXUE_USE_CACHE || !$saxueTpl -> is_cached( $saxueTset['saxue_page_template'], $saxueTset['saxue_page_cacheid'] ) ) {
		include_once( SAXUE_ROOT_PATH . "/model/product.php" );
		$product_handler = saxueproducthandler :: getinstance( "saxueproducthandler" );
		$product = $product_handler -> get( $_REQUEST['id'] );
		if ( !is_object( $product ) ) {
				include SAXUE_WEB_PATH . "/404.php";
		} 
		$row = $product -> getvars( 'n' );
		if ( $row['islink'] || !$row['display'] || $row['catid'] != $_REQUEST['catid'] || $row['lang'] != SAXUE_LANGUAGE ) {
				include SAXUE_WEB_PATH . "/404.php";
		} 
		include SAXUE_ROOT_PATH . "/model/product_data.php";
		$data_handler = saxueproductdatahandler :: getinstance( "saxueproductdatahandler" );
		$data = $data_handler -> get( $_REQUEST['id'] );
		$row['content'] = $data -> getvar( 'content', 'n' );
		$row['pics'] = $data -> getvar( 'pics', 'n' );
		$row['pics'] = unserialize( $row['pics'] );
		$accatchurl = saxue_uploadurl();
		$pics = array();
		$k = 0;
		foreach ( $row['pics'] as $v ) {
				$pics[$k]['url'] = $accatchurl . $v['url'];
				$tmp = getimagesize( $pics[$k]['url'] );
				$pics[$k]['width'] = $tmp[0];
				$pics[$k]['height'] = $tmp[1];
				++$k;
		}
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