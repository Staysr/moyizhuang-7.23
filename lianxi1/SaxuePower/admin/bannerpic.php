<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'banner' );
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/banner.php" );
$data_handler = saxuebannerhandler :: getinstance( "saxuebannerhandler" );
$_REQUEST['bid'] = intval( $_REQUEST['bid'] );
$banner_obj = $data_handler -> get( $_REQUEST['bid'] );
if ( !$banner_obj ) {
		saxue_printfail( 'Banner不存在' );
} 
$banner = $banner_obj -> getvars( 'n' );
include_once( SAXUE_ROOT_PATH . "/model/banner_pic.php" );
$pic_handler = saxuebannerpichandler :: getinstance( "saxuebannerpichandler" );
switch ( $_REQUEST['action'] ) {
		case "add" :
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$pic = $pic_handler -> get( $_REQUEST['id'] );
						if ( !$pic ) {
								saxue_printfail( '图片不存在' );
						} 
						$row = $pic -> getvars( 'n' );
				}
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['url'] = trim( $_POST['url'] );
						if ( strlen( $_POST['url'] ) == 0 ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '图片地址不能为空' ) ) );
						}
						$_POST['link'] = trim( $_POST['link'] );
						if ( strlen( $_POST['link'] ) == 0 ) {
								$_POST['link'] = '#';
						}
						if ( isset( $_REQUEST['id'] ) ) {
								$newpic = $pic_handler -> create( false );
						} else {
								$newpic = $pic_handler -> create();
						} 
						if ( !$pic_handler -> insert( $newpic ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						cache_banner();
						exit( json_encode( array( 'flag' => 1 ) ) );
				}
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTpl -> assign_by_ref( "banner", $banner );
				$saxueTpl -> setcaching( 0 );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/bannerpic_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit();
		case "listorder" :
				foreach( $_POST['listorder'] as $k => $v ) {
						$v = intval( $v );
						$pic_handler -> updatefields( array( 'listorder' => $v ), 'id=' . $k );
				} 
				cache_banner();
				saxue_jumppage( "bannerpic.php?bid=" . $_REQUEST['bid'], LANG_DO_SUCCESS );
				break;
		case 'status':
				if ( isset( $_REQUEST['status'] ) && is_numeric( $_REQUEST['status'] ) ) {
						$pic_handler -> updatefields( 'status=' . $_REQUEST['status'], 'id=' . $_REQUEST['id'] );
						cache_banner();
				}
				saxue_jumppage( "bannerpic.php?bid=" . $_REQUEST['bid'], LANG_DO_SUCCESS );
				break;
		case 'delete':
				if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
						$pic_handler -> delete( $_REQUEST['id'] );
						cache_banner();
				} 
				saxue_jumppage( "bannerpic.php?bid=" . $_REQUEST['bid'], LANG_DO_SUCCESS );
				break;
}
$criteria = new criteriacompo( new criteria( 'bid', $_REQUEST['bid'] ) );
$criteria -> setsort( "listorder" );
$criteria -> setorder( "ASC" );
$pic_handler -> queryobjects( $criteria );
$rows = array();
$k = 0;
while ( $v = $pic_handler -> getobject() ) {
		$rows[$k] = $v -> getvars( "n" );
		++$k;
} 
if ( $k != $banner['pics'] ) {
		$data_handler -> updatefields( array( 'pics' => $k ), 'id=' . $banner['id'] );
}
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "banner", $banner );
$saxueTpl -> assign_by_ref( "rows", $rows );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/bannerpic.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
