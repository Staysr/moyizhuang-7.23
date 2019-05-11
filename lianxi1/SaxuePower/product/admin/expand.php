<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../../core.php";
} 
saxue_checkpower( 'content' );
saxue_getconfigs( 'column' );
saxue_getconfigs( 'module' );
$column = array();
foreach ( $saxueColumn as $catid => $v ) {
		if ( !$v['child'] && $saxueModule[$v['modid']]['tablename'] == 'product' ) {
				$column[$catid] = $v;
		}
}
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/product_expand.php" );
$data_handler = saxueproductexpandhandler :: getinstance( "saxueproductexpandhandler" );
switch ( $_REQUEST['action'] ) {
		case "add" :
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['names'] = trim( $_POST['names'] );
						if ( strlen( $_POST['names'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '请输入属性名称' ) ) );
						} 
						$names = explode( "\n", $_POST['names'] );
						foreach( $names as $name ) {
								$_POST['name'] = trim( $name );
								if ( !$_POST['name'] ) continue;
								$newexp = $data_handler -> create();
								$data_handler -> insert( $newexp );
						} 
						cache_product_expand();
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign( "column", $column );
				$saxueTpl -> assign_by_ref( "lang", $saxueLanguage );
				$saxueTpl -> setcaching( 0 );
				$saxueTpl -> assign( "admincenter", 1 );
				$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/product/templates/expand_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit();
		case "update" :
				if ( !empty( $_POST['ids'] ) && is_array( $_POST['ids'] ) && count( $_POST['ids'] ) > 0 ) {
						foreach ( $_POST['ids'] as $id ) {
								$data_handler -> updatefields( array( 'name' => trim( $_POST['expands'][$id]['name'] ), 'listorder' => intval( $_POST['expands'][$id]['listorder'] ) ), 'id=' . $id );
						}
						cache_product_expand();
				}
				saxue_jumppage( 'expand.php', LANG_DO_SUCCESS );
				break;
		case "delete" :
				if ( !empty( $_POST['ids'] ) && is_array( $_POST['ids'] ) && count( $_POST['ids'] ) > 0 ) {
						$data_handler -> db -> query( "DELETE FROM " . saxue_dbprefix( "product_expand" ) . " WHERE id IN(" . implode( ',', $_POST['ids'] ) . ")" );
						cache_product_expand();
				}
				saxue_jumppage( 'expand.php', LANG_DO_SUCCESS );
				break;
}
if ( empty( $_REQUEST['pagesize'] ) || !is_numeric( $_REQUEST['pagesize'] ) || !in_array( $_REQUEST['pagesize'], array( '10', '30', '50', '100' ) ) ) $_REQUEST['pagesize'] = 30;
if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) ) $GLOBALS['_REQUEST']['page'] = 1;
$criteria = new criteriacompo();
if ( !empty( $_REQUEST['catid'] ) ) {
		$criteria -> add( new criteria( 'catid', $_REQUEST['catid'] ) );
} 
if ( !empty( $_REQUEST['lang'] ) ) {
		$criteria -> add( new criteria( 'lang', $_REQUEST['lang'] ) );
} 
$criteria -> setsort( "listorder" );
$criteria -> setorder( "ASC" );
$criteria -> setlimit( $_REQUEST['pagesize'] );
$criteria -> setstart( ( $_REQUEST['page'] - 1 ) * $_REQUEST['pagesize'] );
$data_handler -> queryobjects( $criteria );
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( 'n' );
		$rows[$k]['langname'] = $saxueLanguage[$rows[$k]['lang']]['name'];
		if ( $rows[$k]['catid'] ) {
				$rows[$k]['catname'] = $saxueColumn[$rows[$k]['catid']]['catname'];
		}
		++$k;
}
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "rows", $rows );
$saxueTpl -> assign_by_ref( "column", $column );
$saxueTpl -> assign_by_ref( "lang", $saxueLanguage );
$saxueTpl -> assign( "admincenter", 1 );
include_once( SAXUE_ROOT_PATH . "/lib/util/page.php" );
$jumppage = new saxuepage( $data_handler -> getcount( $criteria ), $_REQUEST['pagesize'], $_REQUEST['page'] );
$jumppage -> setlink( "", true, true );
$saxueTpl -> assign( "url_jumppage", $jumppage -> whole_bar() );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/product/templates/expand.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );