<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower();
saxue_getconfigs( "roles", "admin" );
saxue_getconfigs( "adminmenu", "admin" );
$adminmenus = array();
if ( $_SESSION['saxueAdminIsFounder'] == 1 ) {
		$adminmenus = $saxueAdminmenu;
} elseif ( isset( $saxueRoles[$_SESSION['saxueAdminRole']] ) && $saxueRoles[$_SESSION['saxueAdminRole']]['status'] == 1 ) {
		foreach ( $saxueAdminmenu as $g1 => $v1 ) {
				foreach ( $v1 as $g2 => $v2 ) {
						foreach ( $v2 as $v ) {
								if ( false !== strpos( ',' . $saxueRoles[$_SESSION['saxueAdminRole']]['power'] . ',', ',' . $v['node'] . ',' ) ) {
										$adminmenus[$g1][$g2][] = $v;
								}
						}
				}
		}
}
if ( count( $adminmenus ) == 0 ) {
		saxue_printfail( LANG_NO_PERMISSION );
}
include_once( SAXUE_ADMIN_PATH . "/header.php" );
saxue_getconfigs( "groupmenu", "admin" );
$saxueTpl -> assign_by_ref( "adminmenus", $adminmenus );
$saxueTpl -> assign_by_ref( "groupmenus", $saxueGroupmenu );
$saxueTpl -> display( SAXUE_ROOT_PATH . "/templates/admin/left.html" );
