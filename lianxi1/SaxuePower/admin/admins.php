<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'admins' );
if ( !isset( $_REQUEST['action'] ) ) $_REQUEST['action'] = '';
include_once( SAXUE_ROOT_PATH . "/model/system_admin.php" );
$data_handler = &saxuesystemadminhandler :: getinstance( "saxuesystemadminhandler" );
saxue_getconfigs( "roles", "admin" );
switch ( $_REQUEST['action'] ) {
		case 'add':
				$row = array();
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$obj = $data_handler -> get( $_REQUEST['id'] );
						if ( !is_object( $obj ) ) {
								saxue_printfail( LANG_NO_USER );
						} elseif( $obj -> getvar( "isfounder" ) == 1 ) {
								saxue_printfail( LANG_NO_PERMISSION );
						}
						$row = $obj -> getvars( "n" );
				} 
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['account'] = trim( $_POST['account'] );
						if ( $_POST['account'] != $row['account'] && 0 < $data_handler -> getcount( new criteria( 'account', $_POST['account'] ) ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '该管理员账号已存在' ) ) );
						}
						if ( isset( $_REQUEST['id'] ) ) {
								$_POST['password'] = trim( $_POST['password'] );
								if ( !empty( $_POST['password'] ) ) {
										$_POST['password'] = $data_handler -> encryptpass( $_POST['password'] );
								} else {
										$_POST['password'] = $row['password'];
								}
								$data = $data_handler -> create( false );
						} else {
								$_POST['password'] = $data_handler -> encryptpass( trim( $_POST['password'] ) );
								$data = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $data ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTpl -> assign_by_ref( "roles", $saxueRoles );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/admins_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit;
				break;
		case "delete" :
		case "status" :
				if ( !isset( $_REQUEST['id'] ) || !is_numeric( $_REQUEST['id'] ) ) {
						saxue_printfail( LANG_ERROR_PARAMETER );
				} 
				$obj = $data_handler -> get( $_REQUEST['id'] );
				if ( !is_object( $obj ) ) {
						saxue_printfail( LANG_NO_USER );
				} elseif( $obj -> getvar( "isfounder" ) == 1 ) {
						saxue_printfail( LANG_NO_PERMISSION );
				}
				if ( $_REQUEST['action'] == 'delete' ) {
						$data_handler -> delete( $_REQUEST['id'] );
				} elseif ( isset( $_REQUEST['status'] ) && is_numeric( $_REQUEST['status'] ) ) {
						$data_handler -> updatefields( 'status=' . $_REQUEST['status'], 'id=' . $_REQUEST['id'] );
				}
				saxue_jumppage( "admins.php", LANG_DO_SUCCESS );
				break;
} 
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
$data_handler -> queryobjects( new criteriacompo() );
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( "n" );
		$rows[$k]['rolename'] = $saxueRoles[$rows[$k]['role']]['rolename'];
		if ( $rows[$k]['status'] == 1 ) {
				$rows[$k]['str_status'] = "<a href=\"?action=status&status=0&id=" . $rows[$k]['id'] . "\">" . saxue_geticon( 'status', '启用' ) . "</a>";
		} else {
				$rows[$k]['str_status'] = "<a href=\"?action=status&status=1&id=" . $rows[$k]['id'] . "\">" . saxue_geticon( 'status', '禁用', 0 ) . "</a>";
		} 
		++$k;
}
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "rows", $rows );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/admins.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
