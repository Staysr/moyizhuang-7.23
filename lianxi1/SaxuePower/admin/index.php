<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower();
saxue_getconfigs( "roles", "admin" );
saxue_getconfigs( "adminmenu", "admin" );
saxue_getconfigs( "groupmenu", "admin" );
$adminmenus = $groupmenus = array();
if ( $_SESSION['saxueAdminIsFounder'] == 1 ) {
		$adminmenus = $saxueAdminmenu;
		$groupmenus = $saxueGroupmenu;
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
		foreach ( $saxueGroupmenu as $g1 => $v1 ) {
				if ( false === strpos( ',' . $saxueRoles[$_SESSION['saxueAdminRole']]['power'] . ',', ',' . $g1 . ',' ) ) continue;
				foreach ( $v1['subs'] as $g2 => $v2 ) {
						if ( false !== strpos( ',' . $saxueRoles[$_SESSION['saxueAdminRole']]['power'] . ',', ',' . $g2 . ',' ) ) {
								$groupmenus[$g1]['name'] = $v1['name'];
								$groupmenus[$g1]['subs'][$g2] = $v2;
						}
				}
		}
}
if ( count( $adminmenus ) == 0 ) {
		saxue_printfail( LANG_NO_PERMISSION );
}
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "saxue_adminleft", SAXUE_ADMIN_URL . "/left.php" );
$saxueTpl -> assign( "saxue_adminmain", SAXUE_ADMIN_URL . "/main.php" );
$saxueTpl -> assign( "account", saxue_htmlstr( $_SESSION['saxueAdminAccount'] ) );
$saxueTpl -> assign( "isfounder", $_SESSION['saxueAdminIsFounder'] );
$saxueTpl -> assign( "rolename", $saxueRoles[$_SESSION['saxueAdminRole']]['rolename'] );
$saxueTpl -> assign_by_ref( "adminmenus", $adminmenus );
$saxueTpl -> assign_by_ref( "groupmenus", $groupmenus );
$saxueTpl -> display( SAXUE_ROOT_PATH . "/templates/admin/index.html" );