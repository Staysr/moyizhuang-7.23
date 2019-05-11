<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'banner' );
saxue_getconfigs( 'bannertype', 'banner' );
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/banner.php" );
$data_handler = saxuebannerhandler :: getinstance( "saxuebannerhandler" );
switch ( $_REQUEST['action'] ) {
		case "add" :
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$banner = $data_handler -> get( $_REQUEST['id'] );
						if ( !$banner ) {
								saxue_printfail( 'Banner不存在' );
						} 
						$row = $banner -> getvars( 'n' );
				}
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['title'] = strtolower( trim( $_POST['title'] ) );
						if ( strlen( $_POST['title'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => 'Banner名称不能为空' ) ) );
						}
						if ( isset( $_REQUEST['id'] ) ) {
								$data = $data_handler -> create( false );
						} else {
								$data = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $data ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						cache_banner();
						exit( json_encode( array( 'flag' => 1 ) ) );
				}
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTpl -> assign_by_ref( "type", $saxueBannertype );
				$saxueTpl -> setcaching( 0 );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/banner_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit();
		case 'delete':
				if ( !isset( $_REQUEST['id'] ) || !is_numeric( $_REQUEST['id'] ) ) {
						$data_handler -> db -> query( "DELETE FROM " . saxue_dbprefix( 'banner_pic' ) . " WHERE bid=" . $_REQUEST['id']  );
						$data_handler -> delete( $_REQUEST['id'] );
						cache_banner();
				} 
				saxue_jumppage( "banner.php", LANG_DO_SUCCESS );
				break;
		case 'update':
				foreach( $_POST['banners'] as $k => $v ) {
						$data_handler -> updatefields( array( 'type' => $v['type'], 'width' => $v['width'], 'height' => $v['height'] ), 'id=' . $k );
				} 
				cache_banner();
				saxue_jumppage( "banner.php", LANG_DO_SUCCESS );
				break;
		case 'cache':
				cache_banner();
				saxue_jumppage( "banner.php", LANG_DO_SUCCESS );
				break;
}
$data_handler -> queryobjects();
$rows = array();
$k = 0;
while ( $v = $data_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( 'n' );
		++$k;
}
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "rows", $rows );
$saxueTpl -> assign_by_ref( "type", $saxueBannertype );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/banner.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
