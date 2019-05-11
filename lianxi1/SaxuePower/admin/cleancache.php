<?php
function saxue_clean_cache() {
		global $saxueCache;
		$saxueCache -> clear( SAXUE_CACHE_PATH );
} 

function saxue_clean_compiled() {
		saxue_delfolder( SAXUE_COMPILED_PATH, false );
} 

function saxue_clean_block() {
		global $saxueCache;
		if ( is_a( $saxueCache, "SaxueCacheMemcached" ) ) {
				$saxueCache -> clear( SAXUE_CACHE_PATH );
		} else {
				foreach ( $saxueLang as $lang => $v ) {
						if ( empty( $v['theme'] ) ) {
								$_dirname = SAXUE_CACHE_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . 'blocks';
						} else {
								$_dirname = SAXUE_CACHE_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $v['theme'] . DIRECTORY_SEPARATOR . 'blocks';
						}
						if ( is_dir( $_dirname ) ) {
								saxue_delfolder( $_dirname, true );
						} 
				}
		} 
} 

function saxue_clean_html() {
		global $saxueCache;
		if ( is_a( $saxueCache, "SaxueCacheMemcached" ) ) {
				$saxueCache -> clear( SAXUE_CACHE_PATH );
		} else {
				foreach ( $saxueLang as $lang => $v ) {
						if ( empty( $v['theme'] ) ) {
								$_dirname = SAXUE_CACHE_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $lang;
						} else {
								$_dirname = SAXUE_CACHE_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $v['theme'];
						}
						$_handle = @opendir( $_dirname );
						while ( $_file = @readdir( $_handle ) ) {
								if ( $_file != "." && $_file != ".." && $_file != "blocks" ) {
										if ( is_dir( $_dirname . DIRECTORY_SEPARATOR . $_file ) ) {
												saxue_delfolder( $_dirname . DIRECTORY_SEPARATOR . $_file, true );
										} elseif ( is_file( $_dirname . DIRECTORY_SEPARATOR . $_file ) ) {
												@unlink( $_dirname . DIRECTORY_SEPARATOR . $_file );
										} 
								} 
						} 
						@closedir( $_handle );
				}
		} 
} 

if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'cleancache' );
@set_time_limit( 600 );
@session_write_close();
saxue_loadlang( "cache", SAXUE_MODULE_NAME );
if ( empty( $_REQUEST['target'] ) ) {
		saxue_printfail( LANG_ERROR_PARAMETER );
} else if ( $_REQUEST['confirm'] != 1 ) {
		saxue_msgwin( LANG_NOTICE, sprintf( $saxueLang['cache']['cache_' . $_REQUEST['target'] . '_notice'], saxue_addurlvars( array( "confirm" => 1 ) ) ) );
} 
if ( $_REQUEST['target'] == "all" ) {
		echo "                                                                                                                                                                                                                                                                ";
		echo $saxueLang['cache']['start_clean_cache'];
		ob_flush();
		flush();
		saxue_clean_html();
		echo $saxueLang['cache']['start_clean_blockcache'];
		ob_flush();
		flush();
		saxue_clean_block();
		echo $saxueLang['cache']['start_clean_compiled'];
		ob_flush();
		flush();
		saxue_clean_compiled();
		saxue_msgwin( LANG_DO_SUCCESS, $saxueLang['cache']['cache_clean_success'] );
} else if ( $_REQUEST['target'] == "html" ) {
		echo "                                                                                                                                                                                                                                                                ";
		echo $saxueLang['cache']['start_clean_html'];
		ob_flush();
		flush();
		saxue_clean_html();
		saxue_msgwin( LANG_DO_SUCCESS, $saxueLang['cache']['cache_clean_success'] );
} else if ( $_REQUEST['target'] == "block" ) {
		echo "                                                                                                                                                                                                                                                                ";
		echo $saxueLang['cache']['start_clean_block'];
		ob_flush();
		flush();
		saxue_clean_block();
		saxue_msgwin( LANG_DO_SUCCESS, $saxueLang['cache']['cache_clean_success'] );
} else if ( $_REQUEST['target'] == "compiled" ) {
		echo "                                                                                                                                                                                                                                                                ";
		echo $saxueLang['cache']['start_clean_compiled'];
		ob_flush();
		flush();
		saxue_clean_compiled();
		saxue_msgwin( LANG_DO_SUCCESS, $saxueLang['cache']['cache_clean_success'] );
} else {
		saxue_printfail( LANG_ERROR_PARAMETER );
} 
