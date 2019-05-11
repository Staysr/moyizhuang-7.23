<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'content' );
saxue_getconfigs( 'column' );
saxue_getconfigs( 'module' );
if ( empty( $saxueColumn ) ) exit('Empty column!');
$category = array();
foreach ( $saxueColumn as $catid => $v ) {
		if ( $v['modid'] || $v['child'] ) {
				$v['adminurl'] = saxue_geturl( 'column_admin', $catid );
				$category[$catid] = $v;
		}
}
include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
$tree = new tree;
$tree -> mid = 'catid';
$tree -> pid = 'pid';
$tree -> init( $category );
$strs = "<span class='add'><a href='\$adminurl' target='mainframe'>\$catname</a></span>";
$strs2 = "<span class='folder'>\$catname</span>";
$columnmenu = $tree -> get_treeview( 0, 'column_tree', $strs, $strs2 );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "admincenter", 1 );
$saxueTpl -> assign( "columnmenu", $columnmenu );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/content_menu.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );

