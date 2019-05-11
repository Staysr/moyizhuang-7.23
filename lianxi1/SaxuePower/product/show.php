<?php
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/product/' . $temp_setting['show_template'];
if ( !file_exists( $saxueTset['saxue_page_template'] ) ) {
		$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/product/show.html';
}
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
		foreach ( $row['pics'] as $k => $v ) {
				$row['pics'][$k]['url'] = $accatchurl . $v['url'];
		}
		$row['haspics'] = count( $row['pics'] );
		$row['expand'] = $data -> getvar( 'expand', 'n' );
		$row['expand'] = unserialize( $row['expand'] );
		if ( count( $row['expand'] ) > 0 ) $row['hasexpand'] = 1;
		$saxueTpl -> assign_by_ref( "row", $row );
}
include( SAXUE_ROOT_PATH . "/common/funstat.php" );
saxue_visit_stat( $_REQUEST['id'], 'product', 'views', 'id' );