<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'roles' );
if ( !isset( $_REQUEST['action'] ) ) $_REQUEST['action'] = '';
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/system_roles.php" );
$data_handler = &saxuesystemroleshandler :: getinstance( "saxuesystemroleshandler" );
switch ( $_REQUEST['action'] ) {
		case 'add':
				$row = array();
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$obj = $data_handler -> get( $_REQUEST['id'] );
						if ( !is_object( $obj ) ) {
								saxue_printfail( LANG_ERROR_PARAMETER );
						} 
						$row = $obj -> getvars( "n" );
				} 
				if ( isset( $_POST['dosubmit'] ) ) {
						if ( isset( $_REQUEST['id'] ) ) {
								$data = $data_handler -> create( false );
						} else {
								$data = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $data ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						cache_roles();
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/roles_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit;
				break;
		case "set" :
				if ( !isset( $_REQUEST['id'] ) || !is_numeric( $_REQUEST['id'] ) ) {
						saxue_printfail( LANG_ERROR_PARAMETER );
				} 
				$obj = $data_handler -> get( $_REQUEST['id'] );
				if ( !is_object( $obj ) ) {
						saxue_printfail( LANG_ERROR_PARAMETER );
				} 
				if ( isset( $_POST['dosubmit'] ) ) {
						$power = array_unique( $_POST['node'] );
						$data_handler -> updatefields( array( 'power' => implode( ',', $power ) ), 'id=' . $_REQUEST['id'] );
						cache_roles();
						exit( json_encode( array( 'flag' => 1 ) ) );
				}
				$row = $obj -> getvars( "n" );
				if ( !empty( $row['power'] ) ) $power = explode( ',', $row['power'] );
				else $power = array();
				include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
				$tree = new tree;
				$tree -> icon = array( '&nbsp;&nbsp;&nbsp;│&nbsp;', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ' );
				$tree -> nbsp = '&nbsp;&nbsp;&nbsp;';
				$tree -> mid = 'id';
				$tree -> pid = 'pid';
				$res = $data_handler -> db -> query( "SELECT * FROM " . saxue_dbprefix( "system_adminmenu" ) . " ORDER BY pid ASC,listorder ASC,id ASC" );
				$menurows = array();
				while ( $v = $data_handler -> getobject( $res ) ) {
						$tmp = $v -> getvars( "n" );
						$tmp['checked'] = ( in_array( $tmp['node'], $power ) ) ? ' checked' : '';
						$tmp['pid_node'] = ( $tmp['pid'] )? ' class="child-of-node-' . $tmp['pid'] . '"' : '';
						$menurows[$tmp['id']] = $tmp;
				} 
				$str = "<tr id='node-\$id'\$pid_node>
							<td style='padding-left:30px;'>\$spacer<input type='checkbox' name='node[]' value='\$node' level='\$level'\$checked onclick='javascript:checknode(this);'> \$caption</td>
						</tr>";
				$tree -> init( $menurows );
				$menus = $tree -> get_tree( 0, $str );
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign( "menus", $menus );
				$saxueTpl -> assign( "id", $_REQUEST['id'] );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/roles_set.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit;
				break;
		case "delete" :
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$data_handler -> delete( $_REQUEST['id'] );
				} 
				cache_roles();
				saxue_jumppage( "roles.php", LANG_DO_SUCCESS );
				break;
		case "status" :
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) && isset( $_REQUEST['status'] ) && is_numeric( $_REQUEST['status'] ) ) {
						$data_handler -> updatefields( 'status=' . $_REQUEST['status'], 'id=' . $_REQUEST['id'] );
				} 
				cache_roles();
				saxue_jumppage( "roles.php", LANG_DO_SUCCESS );
				break;
} 
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
$data_handler -> queryobjects( new criteriacompo() );
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( "n" );
		if ( $rows[$k]['status'] == 1 ) {
				$rows[$k]['str_status'] = "<a href=\"?action=status&status=0&id=" . $rows[$k]['id'] . "\">" . saxue_geticon( 'status', '启用' ) . "</a>";
		} else {
				$rows[$k]['str_status'] = "<a href=\"?action=status&status=1&id=" . $rows[$k]['id'] . "\">" . saxue_geticon( 'status', '禁用', 0 ) . "</a>";
		} 
} 
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "rows", $rows );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/roles.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
