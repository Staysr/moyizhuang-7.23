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
$modid = $saxueColumn[$catid]['modid'];
if ( isset( $_POST['dosubmit'] ) ) {
		$tocatid = intval( $_POST['tocatid'] );
		if ( !isset( $saxueColumn[$tocatid] ) ) {
				saxue_printfail( '目标栏目不存在' );
		} 
		if ( $modid != $saxueColumn[$tocatid]['modid'] ) {
				saxue_printfail( '不能跨模块移动内容' );
		} 
		include_once( SAXUE_ROOT_PATH . "/model/product.php" );
		$data_handler = saxueproducthandler :: getinstance( "saxueproducthandler" );
		if ( $_POST['fromtype'] == 0 ) {
				if ( $_POST['ids'] == '' ) {
						saxue_printfail( '请选择源栏目或者指定内容ID' );
				} 
				$ids = array_filter( explode( ',', $_POST['ids'] ), "intval" );
				$data_handler -> updatefields( array( 'catid' => $tocatid ), 'id IN(' . implode( ',', $ids ) . ')' );
		} else {
				if ( !is_array( $_POST['fromcatid'] ) || $_POST['fromcatid'][0] == 0 ) {
						saxue_printfail( '请选择源栏目或者指定内容ID' );
				} 
				$fromcatid = array_filter( $_POST['fromcatid'], "intval" );
				$data_handler -> updatefields( array( 'catid' => $tocatid ), 'catid IN(' . implode( ',', $fromcatid ) . ')' );
		} 
		if ( empty( $_REQUEST['jumpurl'] ) ) {
				saxue_jumppage( saxue_geturl( 'column_admin', $catid ), LANG_DO_SUCCESS );
		} else {
				saxue_jumppage( $_REQUEST['jumpurl'], LANG_DO_SUCCESS );
		}
} 
$categorys = array();
foreach ( $saxueColumn as $cid => $cat ) {
		if ( $modid != $cat['modid'] && !$cat['child'] ) continue;
		$cat['disabled'] = $cat['child'] ? 'disabled' : '';
		$cat['selected'] = $cid == $catid ? 'selected' : '';
		$categorys[$cid] = $cat;
} 
foreach ( $categorys as $cid => $cat ) {
		if ( !empty( $cat['disabled'] ) && $cat['child'] ) {
				$unset = true;
				$childs = explode( ',', $cat['arrchild'] );
				foreach ( $childs as $child ) {
						if ( $child != $cid && isset( $categorys[$child] ) ) {
								$unset = false;
								break;
						}
				}
				if ( $unset ) unset( $categorys[$cid] );
		}
} 
$ids = empty( $_POST['ids'] ) ? '' : implode( ',', $_POST['ids'] );
include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
$tree = new tree;
$tree -> icon = array( '&nbsp;│&nbsp;', '&nbsp;├─&nbsp;', '&nbsp;└─&nbsp;' );
$tree -> nbsp = '&nbsp;';
$tree -> mid = 'catid';
$tree -> pid = 'pid';
$tree -> init( $categorys );
$str = "<option value='\$catid' \$disabled>\$spacer\$catname</option>";
$target_column = $tree -> get_tree( 0, $str );
$tree -> init( $categorys );
$str = "<option value='\$catid' \$disabled \$selected>\$spacer\$catname</option>";
$source_column = $tree -> get_tree( 0, $str );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "catid", $catid );
$saxueTpl -> assign( "ids", $ids );
$saxueTpl -> assign( "source_column", $source_column );
$saxueTpl -> assign( "target_column", $target_column );
$saxueTpl -> assign( "admincenter", 1 );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/product/templates/move.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
