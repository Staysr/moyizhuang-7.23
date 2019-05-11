<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'lang' );
if ( !isset( $_REQUEST['action'] ) ) $_REQUEST['action'] = '';
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/lang.php" );
$data_handler = &saxuelanghandler :: getinstance( "saxuelanghandler" );
switch ( $_REQUEST['action'] ) {
		case "add" :
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$lang = $data_handler -> get( $_REQUEST['id'] );
						if ( !$lang ) {
								saxue_printfail( '语言项不存在' );
						} 
						$row = $lang -> getvars( 'n' );
						if ( $row['issystem'] ) {
								saxue_printfail( '系统语言项禁止修改' );
						} 
				}
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['name'] = strtolower( trim( $_POST['name'] ) );
						if ( strlen( $_POST['name'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '语言项不能为空' ) ) );
						}
						$_POST['title'] = trim( $_POST['title'] );
						if ( strlen( $_POST['title'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '语言项名称不能为空' ) ) );
						}
						if ( $_POST['name'] != $row['name'] && 0 < $data_handler -> getcount( new criteria( 'name', $_POST['name'] ) ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '语言项已存在' ) ) );
						} 
						if ( isset( $_REQUEST['id'] ) ) {
								$data = $data_handler -> create( false );
						} else {
								$data = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $data ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						exit( json_encode( array( 'flag' => 1 ) ) );
				}
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTpl -> setcaching( 0 );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/lang_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit();
		case "update" :
				foreach ( $_POST['setting'] as $id => $v ) {
						$data_handler -> updatefields( array( 'setting' => serialize( $v ) ), 'id=' . $id );
				}
				cache_lang();
				if ( empty( $_REQUEST['jumpurl'] ) ) {
						saxue_jumppage( 'lang.php', LANG_DO_SUCCESS );
				} else {
						saxue_jumppage( $_REQUEST['jumpurl'], LANG_DO_SUCCESS );
				}
		case "delete" :
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$data_handler -> db -> query( "DELETE FROM " . saxue_dbprefix( 'lang' ) . " WHERE issystem=1 AND id=" . $_REQUEST['catid']  );
				} 
				cache_lang();
				if ( empty( $_REQUEST['jumpurl'] ) ) {
						saxue_jumppage( 'lang.php', LANG_DO_SUCCESS );
				} else {
						saxue_jumppage( $_REQUEST['jumpurl'], LANG_DO_SUCCESS );
				}
		case "cache" :
				cache_lang();
				saxue_jumppage( 'lang.php', LANG_DO_SUCCESS );
				break;
}
if ( empty( $_REQUEST['pagesize'] ) || !is_numeric( $_REQUEST['pagesize'] ) || !in_array( $_REQUEST['pagesize'], array( '10', '30', '50', '100' ) ) ) $_REQUEST['pagesize'] = 30;
if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) ) $GLOBALS['_REQUEST']['page'] = 1;
$criteria = new criteriacompo();
$criteria -> setlimit( $_REQUEST['pagesize'] );
$criteria -> setstart( ( $_REQUEST['page'] - 1 ) * $_REQUEST['pagesize'] );
$data_handler -> queryobjects( $criteria );
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( "n" );
		$rows[$k]['setting'] = unserialize( $rows[$k]['setting'] );
		++$k;
}
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "rows", $rows );
$saxueTpl -> assign( "lang", $saxueLanguage );
include_once( SAXUE_ROOT_PATH . "/lib/util/page.php" );
$jumppage = new saxuepage( $data_handler -> getcount( $criteria ), $_REQUEST['pagesize'], $_REQUEST['page'] );
$jumppage -> setlink( "", true, true );
$saxueTpl -> assign( "url_jumppage", $jumppage -> whole_bar() );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/lang.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
