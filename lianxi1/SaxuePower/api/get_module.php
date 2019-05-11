<?php
include "../core.php";
$modid = intval( $_GET['modid'] );
$catid = intval( $_GET['catid'] );
saxue_getconfigs( 'column' );
saxue_getconfigs( 'urlrule' );
saxue_getconfigs( 'module' );
$urlrule = array( 'show' => '', 'list' => '' );
foreach ( $saxueUrlrule as $id => $v ) {
		if ( $modid == $v['modid'] || ( !$v['modid'] && $saxueModule[$modid]['type'] ) ) {
				if ( $id == $saxueColumn[$catid]['setting'][$v['type'] . '_ruleid'] ) {
						$urlrule[$v['type']] .= '<option value="' . $id . '" selected>' . $v['example'] . '</option>';
				} else {
						$urlrule[$v['type']] .= '<option value="' . $id . '">' . $v['example'] . '</option>';
				}
		}
}
$template = array();
foreach ( $saxueLanguage as $lang => $v ) {
		$template[$lang] = array( 'show' => '', 'list' => '', 'column' => '', 'search' => '' );
		if ( empty( $v['theme'] ) ) {
				$path = SAXUE_ROOT_PATH . '/templates/' . $lang . '/' . $saxueModule[$modid]['moddir'];
		} else {
				$path = SAXUE_ROOT_PATH . '/templates/' . $v['theme'] . '/' . $saxueModule[$modid]['moddir'];
		}
		$list = glob( $path . '/*.html' );
		foreach( $list as $file ) {
				$filename = basename( $file );
				if ( preg_match( "/^(show|list|column|search)(_[a-z0-9]+)?\.html$/i", $filename, $matchs ) ) {
						if ( $filename == $saxueColumn[$catid]['setting'][$lang][$matchs[1].'_template'] ) {
								$template[$lang][$matchs[1]] .= '<option value="' . $filename . '" selected>' . $filename . '</option>';
						} else {
								$template[$lang][$matchs[1]] .= '<option value="' . $filename . '">' . $filename . '</option>';
						}
				}
		}
}
exit( json_encode( array( 'modtype' => $saxueModule[$modid]['type'], 'issearch' => $saxueModule[$modid]['issearch'], 'urlrule' => $urlrule, 'template' => $template ) ) );