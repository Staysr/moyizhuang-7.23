<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'urlrule' );
if ( !isset( $_REQUEST['action'] ) ) $_REQUEST['action'] = '';
$urltype = array( 'show' => '内容页', 'list' => '列表页' );
saxue_getconfigs( 'module' );
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/urlrule.php" );
$data_handler = &saxueurlrulehandler :: getinstance( "saxueurlrulehandler" );
switch ( $_REQUEST['action'] ) {
		case 'add':
				$row = array();
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$obj = $data_handler -> get( $_REQUEST['id'] );
						if ( !is_object( $obj ) ) {
								saxue_printfail( '规则不存在' );
						}
						$row = $obj -> getvars( "n" );
				} 
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['name'] = trim( $_POST['name'] );
						if ( strlen( $_POST['name'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '规则名称不能为空' ) ) );
						}
						$_POST['example'] = strtolower( trim( $_POST['example'] ) );
						if ( strlen( $_POST['example'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => 'URL示例不能为空' ) ) );
						}
						$_POST['urlrule'] = strtolower( trim( $_POST['urlrule'] ) );
						if ( strlen( $_POST['urlrule'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => 'URL规则不能为空' ) ) );
						}
						if ( isset( $_REQUEST['id'] ) ) {
								$data = $data_handler -> create( false );
						} else {
								$data = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $data ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						cache_urlrule();
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTpl -> assign_by_ref( "urltype", $urltype );
				$saxueTpl -> assign_by_ref( "modules", $saxueModule );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/urlrule_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit;
		case 'delete':
				if ( !isset( $_REQUEST['id'] ) || !is_numeric( $_REQUEST['id'] ) ) {
						$data_handler -> delete( $_REQUEST['id'] );
						cache_urlrule();
				} 
				saxue_jumppage( 'urlrule.php', LANG_DO_SUCCESS );
				break;
} 
$data_handler -> queryobjects();
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( "n" );
		if ( $rows[$k]['modid'] ) $rows[$k]['modname'] = $saxueModule[$rows[$k]['modid']]['name'];
		$rows[$k]['typename'] = $urltype[$rows[$k]['type']];
		++$k;
}
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "rows", $rows );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/urlrule.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
