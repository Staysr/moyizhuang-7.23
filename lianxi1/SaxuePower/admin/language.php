<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'language' );
if ( !isset( $_REQUEST['action'] ) ) $_REQUEST['action'] = '';
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/system_language.php" );
$data_handler = &saxuesystemlanguagehandler :: getinstance( "saxuesystemlanguagehandler" );
switch ( $_REQUEST['action'] ) {
		case 'add':
				$row = array();
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$obj = $data_handler -> get( $_REQUEST['id'] );
						if ( !is_object( $obj ) ) {
								saxue_printfail( '语言不存在' );
						}
						$row = $obj -> getvars( "n" );
						$row['seo'] = unserialize( $row['seo'] );
				} 
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['name'] = trim( $_POST['name'] );
						if ( strlen( $_POST['name'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '语言名称不能为空' ) ) );
						}
						$_POST['sitename'] = trim( $_POST['sitename'] );
						if ( strlen( $_POST['sitename'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '网站名称不能为空' ) ) );
						}
						$_POST['theme'] = trim( $_POST['theme'] );
						$_POST['skin'] = trim( $_POST['skin'] );
						$_POST['style'] = trim( $_POST['style'] );
						$_POST['seo'] = serialize( $_POST['seo'] );
						if ( isset( $_REQUEST['id'] ) ) {
								if ( strlen( $_POST['theme'] ) == 0 ) {
										$_POST['theme'] = $row['lang'];
								}
								if ( strlen( $_POST['skin'] ) == 0 ) {
										$_POST['skin'] = $row['lang'];
								}
								$data = $data_handler -> create( false );
						} else {
								$_POST['lang'] = trim( $_POST['lang'] );
								if ( strlen( $_POST['lang'] ) == 0 ) {
										exit( json_encode( array( 'flag' => 0, 'msg' => '英文标识不能为空' ) ) );
								}
								if ( 0 < $data_handler -> getcount( new criteria( 'lang', $_POST['lang'] ) ) ) {
										exit( json_encode( array( 'flag' => 0, 'msg' => '该语言标识已存在' ) ) );
								}
								if ( strlen( $_POST['theme'] ) == 0 ) {
										$_POST['theme'] = $_POST['lang'];
								}
								if ( strlen( $_POST['skin'] ) == 0 ) {
										$_POST['skin'] = $_POST['lang'];
								}
								$data = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $data ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						cache_language();
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/language_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit;
		case 'delete':
				if ( !isset( $_REQUEST['id'] ) || !is_numeric( $_REQUEST['id'] ) ) {
						saxue_printfail( LANG_ERROR_PARAMETER );
				} 
				$obj = $data_handler -> get( $_REQUEST['id'] );
				if ( !is_object( $obj ) ) {
						saxue_printfail( '语言不存在' );
				} elseif( $obj -> getvar( "issystem" ) == 1 ) {
						saxue_printfail( '系统保留语言禁止删除' );
				} elseif( $obj -> getvar( "isdefault" ) == 1 ) {
						saxue_printfail( '默认语言禁止删除' );
				}
				$data_handler -> delete( $_REQUEST['id'] );
				cache_language();
				saxue_jumppage( 'language.php', LANG_DO_SUCCESS );
				break;
		case 'display':
				if ( isset( $_REQUEST['display'] ) && is_numeric( $_REQUEST['display'] ) ) {
						$data_handler -> updatefields( 'display=' . $_REQUEST['display'], 'isdefault=0 AND id=' . $_REQUEST['id'] );
						cache_language();
				}
				saxue_jumppage( 'language.php', LANG_DO_SUCCESS );
				break;
		case 'setdefault':
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$data_handler -> updatefields( 'isdefault=0' );
						$data_handler -> updatefields( 'isdefault=1', 'id=' . $_REQUEST['id'] );
						cache_language();
				}
				saxue_jumppage( 'language.php', LANG_DO_SUCCESS );
				break;
		case 'cache':
				cache_language();
				saxue_jumppage( 'language.php', LANG_DO_SUCCESS );
				break;
} 
$criteria = new criteriacompo();
$criteria -> setsort( "listorder" );
$criteria -> setorder( "ASC" );
$data_handler -> queryobjects( $criteria );
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( "n" );
		++$k;
}
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "rows", $rows );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/language.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
