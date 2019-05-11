<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'column' );
saxue_getconfigs( 'column' );
if ( isset( $_POST['dosubmit'] ) ) {
		include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
		include_once( SAXUE_ROOT_PATH . "/model/column.php" );
		$data_handler = saxuecolumnhandler :: getinstance( "saxuecolumnhandler" );
		foreach( $_POST['cats'] as $catid => $v ) {
				$up = array();
				$up['catname'] = trim( $v['catname'] );
				$up['catdir'] = strtolower( trim( $v['catdir'] ) );
				if ( !$up['catname'] || !$up['catdir'] ) continue;
				if ( $saxueColumn[$catid]['catdir'] != $up['catdir'] && 0 < $data_handler -> getcount( new criteria( 'catdir', $up['catdir'] ) ) ) continue;
				$up['image'] = trim( $v['image'] );
				$up['display'] = intval( $v['display'] );
				$up['setting'] = serialize( $v['setting'] );
				$data_handler -> updatefields( $up, 'catid=' . $catid );
		}
		cache_column();
		saxue_jumppage( 'column.php', LANG_DO_SUCCESS );
} elseif ( isset( $_POST['catids'] ) ) {
		saxue_getconfigs( 'urlrule' );
		saxue_getconfigs( 'module' );
		$cats = array();
		foreach ( $_POST['catids'] as $catid ) {
				if ( $saxueColumn[$catid]['modid'] ) {
						$cats[$catid] = $saxueColumn[$catid];
						$cats[$catid]['modtype'] = $saxueModule[$saxueColumn[$catid]['modid']]['type'];
						$cats[$catid]['modsearch'] = $saxueModule[$saxueColumn[$catid]['modid']]['issearch'];
				}
		}
		if ( empty ( $cats ) ) {
				saxue_printfail( '至少选择一个栏目' );
		}
		$template = $urlrule = array();
		foreach ( $saxueModule as $modid => $mod ) {
				// 模块URL
				foreach ( $saxueUrlrule as $id => $v ) {
						if ( $modid == $v['modid'] || ( !$v['modid'] && $mod['type'] ) ) {
								$urlrule[$modid][$v['type']][$id] = $v['example'];
						}
				}
				// 模块模版
				foreach ( $saxueLanguage as $lang => $v ) {
						if ( empty( $v['theme'] ) ) {
								$path = SAXUE_ROOT_PATH . '/templates/' . $lang . '/' . $mod['moddir'];
						} else {
								$path = SAXUE_ROOT_PATH . '/templates/' . $v['theme'] . '/' . $mod['moddir'];
						}
						$list = glob( $path . '/*.html' );
						foreach( $list as $file ) {
								$filename = basename( $file );
								if ( preg_match( "/^(show|list|column|search)(_[a-z0-9]+)?\.html$/i", $filename, $matchs ) ) {
										$template[$modid][$lang][$matchs[1]][] = $filename;
								}
						}
				}
		}
		$width = count( $cats ) * 280 + 100;
		include_once( SAXUE_ADMIN_PATH . "/header.php" );
		$saxueTpl -> assign_by_ref( "template", $template );
		$saxueTpl -> assign_by_ref( "urlrule", $urlrule );
		$saxueTpl -> assign_by_ref( "language", $saxueLanguage );
		$saxueTpl -> assign_by_ref( "cats", $cats );
		$saxueTpl -> assign( "width", $width );
		$saxueTpl -> setcaching( 0 );
		$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/batch_edit.html";
		include_once( SAXUE_ADMIN_PATH . "/footer.php" );
		exit;
}
$categorys = array();
foreach ( $saxueColumn as $cid => $cat ) {
		if ( !$cat['modid'] && !$cat['child'] ) continue;
		$categorys[$cid] = $cat;
} 
include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
$tree = new tree;
$tree -> icon = array( '&nbsp;&nbsp;│&nbsp;', '&nbsp;&nbsp;├─&nbsp;', '&nbsp;&nbsp;└─&nbsp;' );
$tree -> nbsp = '&nbsp;';
$tree -> mid = 'catid';
$tree -> pid = 'pid';
$tree -> init( $categorys );
$str = "<option value='\$catid'>\$spacer \$catname</option>";
$column = $tree -> get_tree( 0, $str );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "column", $column );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/batch.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
