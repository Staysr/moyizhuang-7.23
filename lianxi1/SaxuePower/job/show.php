<?php
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/job/' . $temp_setting['show_template'];
if ( !file_exists( $saxueTset['saxue_page_template'] ) ) {
		$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/job/show.html';
}
$saxueTset['saxue_page_cacheid'] = $_REQUEST['id'];
if ( SAXUE_USE_CACHE ) {
		$saxueTpl -> setcaching( 1 );
} else {
		$saxueTpl -> setcaching( 0 );
} 
if ( !SAXUE_USE_CACHE || !$saxueTpl -> is_cached( $saxueTset['saxue_page_template'], $saxueTset['saxue_page_cacheid'] ) ) {
		include_once( SAXUE_ROOT_PATH . "/model/job.php" );
		$job_handler = saxuejobhandler :: getinstance( "saxuejobhandler" );
		$job = $job_handler -> get( $_REQUEST['id'] );
		if ( !is_object( $job ) ) {
				include SAXUE_WEB_PATH . "/404.php";
		} 
		$row = $job -> getvars( 'n' );
		if ( $row['islink'] || !$row['display'] || $row['catid'] != $_REQUEST['catid'] || $row['lang'] != SAXUE_LANGUAGE ) {
				include SAXUE_WEB_PATH . "/404.php";
		} 
		$saxueTpl -> assign_by_ref( "row", $row );
}
include( SAXUE_ROOT_PATH . "/common/funstat.php" );
saxue_visit_stat( $_REQUEST['id'], 'job', 'views', 'id' );