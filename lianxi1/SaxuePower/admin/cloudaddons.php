<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'cloudaddons' );

define( 'CLOUDADDONS_WEBSITE_URL', 'http://addon.saxue.com' );
if ( !isset( $_REQUEST['action'] ) ) {
		$_REQUEST['action'] = '';
} 
include_once( SAXUE_DATA_PATH . "/version.php" );
include_once( SAXUE_ROOT_PATH . "/common/funaddon.php" );
$param = array();
$param['siteurl'] = rawurlencode( SAXUE_ADMIN_URL );
$param['version'] = $saxueVersion['edition'];
$param['release'] = $saxueVersion['release'];
if ( SAXUE_LICENSE != '' ) {
		$_license = explode( '|', base64_decode( SAXUE_LICENSE ) );
		if ( is_array( $_license ) && count( $_license ) == 2 ) {
				$param['licensecode'] = $_license[1];
		}
}
$param = http_build_query( $param );
$sitehash = md5( $param );

if ( empty( $_REQUEST['action'] ) ) {
		$url = CLOUDADDONS_WEBSITE_URL . '/?' . $param . '&sitehash=' . $sitehash;
		if ( !empty( $_GET['id'] ) ) {
				$url .= '&id=' . $_GET['id'];
		}
		echo '<script type="text/javascript">location.href=\'' . $url . '\';</script>';
} elseif ( $_REQUEST['action'] == 'download' ) {
		if ( !$_GET['sitehash'] || $_GET['sitehash'] != $sitehash ) {
				saxue_printfail( '校验失败，您无法下载此应用' );
		}
		$key = trim( $_GET['key'] );
		if ( empty( $key ) ) {
				saxue_printfail( '应用标识错误' );
		}
		$step = intval( $_GET['step'] );
		@set_time_limit( 0 );
		if ( $step == 0 ) {
				$id = intval( $_GET['id'] );
				saxue_run( '应用 ' . $key . '.' . $_GET['type'] . ' 下载中，请稍候 ......', '?action=download&key=' . $key . '&type=' . $_GET['type'] . '&id=' . $id . '&sitehash=' . $sitehash );
				$url = CLOUDADDONS_WEBSITE_URL . '/download.php?' . $param . '&sitehash=' . $sitehash . '&id=' . $id;
				$data = saxue_sockopen( $url, 999 );
				if ( empty( $data ) || strlen( $data ) < 20 ) {
						ob_clean();
						saxue_printfail( '应用下载错误（' . $data . '）' );
				}
				$zipfile = SAXUE_DATA_PATH . '/download/addon/';
				saxue_checkdir( $zipfile, true );
				$zipfile .= $key . '.zip';
				saxue_writefile( $zipfile, $data );
				saxue_jumppage( '?action=download&step=1&key=' . $key . '&type=' . $_GET['type'] . '&sitehash=' . $sitehash );
		} elseif ( $step == 1 ) {
				saxue_run( '应用 ' . $key . '.' . $_GET['type'] . ' 解压中，请稍候 ......', '?action=download&step=1&key=' . $key . '&type=' . $_GET['type'] . '&sitehash=' . $sitehash );
				include_once( SAXUE_ROOT_PATH . "/lib/util/pclzip.php" );
				$zipfile = SAXUE_DATA_PATH . '/download/addon/' . $key . '.zip';
				$unzipto = SAXUE_DATA_PATH . '/download/addon/' . $key;
				saxue_checkdir( $unzipto, true );
				$archive = new PclZip( $zipfile );
				if ( $archive -> extract( PCLZIP_OPT_PATH, $unzipto, PCLZIP_OPT_REPLACE_NEWER ) == 0 ) {
						saxue_delfile( $zipfile );
						ob_clean();
						saxue_printfail( '应用解压错误：<br>' . $archive -> errorInfo( true ) );
				}
				saxue_delfile( $zipfile );
				saxue_jumppage( '?action=download&step=2&key=' . $key . '&type=' . $_GET['type'] . '&sitehash=' . $sitehash );
		} elseif ( $step == 2 ) {
				saxue_run( '应用 ' . $key . '.' . $_GET['type'] . ' 正在复制文件，请稍候 ......', '?action=download&step=2&key=' . $key . '&type=' . $_GET['type'] . '&sitehash=' . $sitehash );
				$cache_path = SAXUE_DATA_PATH . '/download/addon/' . $key;
				if ( $_GET['type'] == 'templates' ) {
						if ( !is_dir( $cache_path . '/public' ) || !is_dir( $cache_path . '/SaxueFrame' ) ) {
								saxue_delfolder( $cache_path );
								ob_clean();
								saxue_printfail( '复制模板文件失败：文件目录错误' );
						}
						saxue_copyaddon( $cache_path . '/public', SAXUE_WEB_PATH . '/public' );
						saxue_copyaddon( $cache_path . '/SaxueFrame', SAXUE_ROOT_PATH ); 
						ob_clean();
						saxue_jumppage( 'plugin.php?action=tempinstall&dir=' . $key, '开始安装模板，请稍候 ......', 1 );
				} else {
						if ( is_dir( $cache_path . '/public' ) || is_dir( $cache_path . '/SaxueFrame' ) ) {
								saxue_delfolder( $cache_path );
								ob_clean();
								saxue_printfail( '复制应用文件失败：文件目录错误' );
						}
						saxue_copyaddon( $cache_path, SAXUE_WEB_PATH . '/plugin' );
						saxue_delfolder( $cache_path );
						ob_clean();
						if ( isset( $saxuePlugin[$key] ) ) {
								saxue_jumppage( 'plugin.php?action=update&identifier=' . $key, '开始升级应用，请稍候 ......', 1 );
						}
						saxue_jumppage( 'plugin.php?action=install&dir=' . $key, '开始安装应用，请稍候 ......', 1 );
				}
		}
}