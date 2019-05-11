<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'module' );
if ( !isset( $_REQUEST['action'] ) ) $_REQUEST['action'] = '';
$modtype = array( '0' => '单内容页', '1' => '单列表页', '2' => '列表+内容' );
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/module.php" );
$data_handler = &saxuemodulehandler :: getinstance( "saxuemodulehandler" );
switch ( $_REQUEST['action'] ) {
		case 'add':
				$row = array();
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$obj = $data_handler -> get( $_REQUEST['id'] );
						if ( !is_object( $obj ) ) {
								saxue_printfail( '模块不存在' );
						}
						$row = $obj -> getvars( "n" );
						if ( $row['issystem'] ) {
								saxue_printfail( '系统模块禁止修改' );
						}
				} 
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['name'] = trim( $_POST['name'] );
						if ( strlen( $_POST['name'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '模块名称不能为空' ) ) );
						}
						$_POST['tablename'] = strtolower( trim( $_POST['tablename'] ) );
						if ( strlen( $_POST['tablename'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '数据表名不能为空' ) ) );
						}
						$_POST['moddir'] = strtolower( trim( $_POST['moddir'] ) );
						if ( strlen( $_POST['moddir'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '模块目录不能为空' ) ) );
						}
						if ( !preg_match( "/^[a-z][a-z0-9]+$/i", $_POST['moddir'] ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '模块目录错误，格式为英文字母开头，只能包含字母和数字' ) ) );
						}
						if ( $_POST['moddir'] != $row['moddir'] && 0 < $data_handler -> getcount( new criteria( 'moddir', $_POST['moddir'] ) ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '模块目录已存在' ) ) );
						}
						$_POST['type'] = intval( $_POST['type'] );
						$_POST['issearch'] = intval( $_POST['issearch'] );
						$_POST['searchfield'] = trim( $_POST['searchfield'] );
						if ( $_POST['issearch'] && empty( $_POST['searchfield'] ) ) $_POST['searchfield'] = 'title';
						if ( isset( $_REQUEST['id'] ) ) {
								$data = $data_handler -> create( false );
						} else {
								$data = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $data ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						cache_module();
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTpl -> assign_by_ref( "modtype", $modtype );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/module_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit;
		case 'delete':
				if ( !isset( $_REQUEST['id'] ) || !is_numeric( $_REQUEST['id'] ) ) {
						saxue_printfail( LANG_ERROR_PARAMETER );
				} 
				$obj = $data_handler -> get( $_REQUEST['id'] );
				if ( !is_object( $obj ) ) {
						saxue_printfail( '模块不存在' );
				} elseif( $obj -> getvar( "issystem" ) == 1 ) {
						saxue_printfail( '系统模块禁止删除' );
				}
				include_once( SAXUE_ROOT_PATH . "/model/column.php" );
				$column_handler = saxuecolumnhandler :: getinstance( "saxuecolumnhandler" );
				if ( 0 < $column_handler -> getcount( new criteria( 'modid', $_REQUEST['id'] ) ) ) {
						saxue_printfail( '请先删除使用该模块的栏目' );
				}
				$data_handler -> db -> query( "DELETE FROM " . saxue_dbprefix( "urlrule" ) . " WHERE modid=" . $_REQUEST['id']  );
				$data_handler -> delete( $_REQUEST['id'] );
				cache_module();
				saxue_jumppage( 'module.php', LANG_DO_SUCCESS );
				break;
		case 'status':
				if ( isset( $_REQUEST['status'] ) && is_numeric( $_REQUEST['status'] ) ) {
						$data_handler -> updatefields( 'status=' . $_REQUEST['status'], 'id=' . $_REQUEST['id'] );
						cache_module();
				}
				saxue_jumppage( 'module.php', LANG_DO_SUCCESS );
				break;
		case 'issearch':
				if ( isset( $_REQUEST['issearch'] ) && is_numeric( $_REQUEST['issearch'] ) ) {
						$data_handler -> updatefields( 'issearch=' . $_REQUEST['issearch'], 'id=' . $_REQUEST['id'] );
						cache_module();
				}
				saxue_jumppage( 'module.php', LANG_DO_SUCCESS );
				break;
		case 'cache':
				cache_module();
				saxue_jumppage( 'module.php', LANG_DO_SUCCESS );
				break;
} 
$data_handler -> queryobjects();
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( "n" );
		$rows[$k]['typename'] = $modtype[$rows[$k]['type']];
		++$k;
}
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "rows", $rows );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/module.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
