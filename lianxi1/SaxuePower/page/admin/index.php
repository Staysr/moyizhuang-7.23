<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../../core.php";
} 
saxue_checkpower( 'content' );
saxue_getconfigs( 'column' );
$catid = intval( $_REQUEST['catid'] );
if ( !isset( $saxueColumn[$catid] ) ) {
		saxue_printfail( '栏目不存在' );
}
include_once( SAXUE_ROOT_PATH . "/model/page.php" );
$data_handler = saxuepagehandler :: getinstance( "saxuepagehandler" );
if ( isset( $_POST['dosubmit'] ) ) {
		$_POST['lang'] = trim( $_POST['lang'] );
		if ( !isset( $saxueLanguage[$_POST['lang']] ) ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => '语言不存在' ) ) );
		}
		$_POST['content'] = $_POST['content_' . $_POST['lang']];
		if ( strlen( $_POST['content'] ) == 0 ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => '内容不能为空' ) ) );
		} 
		$_POST['title'] = trim( $_POST['title_' . $_POST['lang']] );
		if ( isset( $_POST['id'] ) ) {
				$_POST['updatetime'] = SAXUE_NOW_TIME;
				$content = $data_handler -> create( false );
		} else {
				$_POST['addtime'] = $_POST['updatetime'] = SAXUE_NOW_TIME;
				$content = $data_handler -> create();
		}
		if ( !$data_handler -> insert( $content ) ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
		} 
		// 文章缓存处理
		if ( SAXUE_USE_CACHE && isset( $_POST['id'] ) ) {
				if ( !isset( $saxueTpl ) ) {
						include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
						$saxueTpl = &saxuetpl :: getinstance();
				}
				if ( empty( $saxueLanguage[$_POST['lang']]['theme'] ) ) {
						$saxueTpl -> clear_cache( SAXUE_ROOT_PATH . '/templates/' . $_POST['lang'] . '/page/' . $saxueColumn[$catid]['setting'][$_POST['lang']]['show_template'], $_POST['id'] );
				} else {
						$saxueTpl -> clear_cache( SAXUE_ROOT_PATH . '/templates/' . $saxueLanguage[$_POST['lang']]['theme'] . '/page/' . $saxueColumn[$catid]['setting'][$_POST['lang']]['show_template'], $_POST['id'] );
				}
		}
		exit( json_encode( array( 'flag' => 1 ) ) );
}
$data_handler -> queryobjects( new criteria( 'catid', $catid ) );
$rows = array();
while ( $v = $data_handler -> getobject() ) {
		$k = $v -> getvar( 'lang' );
		$rows[$k] = $v -> getvars( 'n' );
}
$k = 0;
$pages = array();
foreach ( $saxueLanguage as $lang => $v ) {
		if ( empty( $saxueColumn[$catid]['langset'][$lang]['ishide'] ) ) {
				$pages[$lang] = $rows[$lang];
				$pages[$lang]['name'] = $v['name'];
				$pages[$lang]['editorname'] = 'content_' . $lang;
				++$k;
		}
}
$pagecount = $k;
include_once( SAXUE_ROOT_PATH . "/common/funpost.php" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "pages", $pages );
$saxueTpl -> assign( "catid", $catid );
$saxueTpl -> assign( "pagecount", $pagecount );
$saxueTpl -> assign( "admincenter", 1 );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/page/templates/index.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );