<?php 
// 栏目列表
function saxue_url_column_list( $_catid = 0, $_page = "0" ) {
		global $saxueColumn;
		global $saxueUrlrule;
		global $saxueModule;
		if ( !isset( $saxueColumn ) ) {
				saxue_getconfigs( 'column' );
		} 
		if ( !isset( $saxueUrlrule ) ) {
				saxue_getconfigs( 'urlrule' );
		} 
		if ( !isset( $saxueModule ) ) {
				saxue_getconfigs( 'module' );
		} 
		if ( empty( $saxueColumn[$_catid]['setting']['list_ruleid'] ) ) {
				$url = '/' . $saxueModule[$saxueColumn[$_catid]['modid']]['moddir'] . '/list.php?catid=' . $_catid;
				if ( !empty( $_page ) && $_page != 1 ) $url .= '&page=' . $_page;
		} else {
				$str = explode( '|', $saxueUrlrule[$saxueColumn[$_catid]['setting']['list_ruleid']]['urlrule'] );
				$url = $str[0];
				if ( ( empty( $_page ) || $_page == 1 ) && !empty( $str[1] ) ) $url = $str[1];
				if ( false !== strpos( $url, '<{$parentdir}>' ) ) $_parent = get_parentdir( $_catid, $saxueColumn );
				else $_parent = '';
				$_from = array( "<{\$catdir}>", "<{\$catid}>", "<{\$page}>", "<{\$parentdir}>" );
				$_to = array( $saxueColumn[$_catid]['catdir'], $_catid, $_page, $_parent );
				$url = '/' . trim( str_replace( $_from, $_to, $url ) );
		} 
		return $url;
} 
// 栏目内容
function saxue_url_column_show( $_catid = 0, $_id = 0 ) {
		global $saxueColumn;
		global $saxueUrlrule;
		global $saxueModule;
		if ( !isset( $saxueColumn ) ) {
				saxue_getconfigs( 'column' );
		} 
		if ( !isset( $saxueUrlrule ) ) {
				saxue_getconfigs( 'urlrule' );
		} 
		if ( !isset( $saxueModule ) ) {
				saxue_getconfigs( 'module' );
		} 
		if ( empty( $saxueColumn[$_catid]['setting']['show_ruleid'] ) ) {
				$url = '/' . $saxueModule[$saxueColumn[$_catid]['modid']]['moddir'] . '/show.php?catid=' . $_catid;
				if ( !empty( $_id ) ) $url .= '&id=' . $_id;
		} else {
				if ( false !== strpos( $saxueUrlrule[$saxueColumn[$_catid]['setting']['show_ruleid']]['urlrule'], '<{$parentdir}>' ) ) $_parent = get_parentdir( $_catid, $saxueColumn );
				else $_parent = '';
				$_from = array( "<{\$catdir}>", "<{\$catid}>", "<{\$id}>", "<{\$parentdir}>" );
				$_to = array( $saxueColumn[$_catid]['catdir'], $_catid, $_id, $_parent );
				$url = '/' . trim( str_replace( $_from, $_to, $saxueUrlrule[$saxueColumn[$_catid]['setting']['show_ruleid']]['urlrule'] ) );
		} 
		return $url;
} 
function saxue_url_custom( $_catid = 0, $_ruleid = 0 ) {
		global $saxueColumn;
		global $saxueUrlrule;
		if ( !isset( $saxueColumn ) ) {
				saxue_getconfigs( 'column' );
		} 
		if ( !isset( $saxueUrlrule ) ) {
				saxue_getconfigs( 'urlrule' );
		} 
		if ( false !== strpos( $saxueUrlrule[$_ruleid]['urlrule'], '<{$parentdir}>' ) ) $_parent = get_parentdir( $_catid, $saxueColumn );
		else $_parent = '';
		$_from = array( "<{\$catdir}>", "<{\$catid}>", "<{\$id}>", "<{\$parentdir}>" );
		$_to = array( $saxueColumn[$_catid]['catdir'], $_catid, $_id, $_parent );
		$url = '/' . trim( str_replace( $_from, $_to, $saxueUrlrule[$_ruleid]['urlrule'] ) );
		return $url;
} 
// 栏目内容管理
function saxue_url_column_admin( $_catid = 0 ) {
		global $saxueColumn;
		global $saxueModule;
		if ( !isset( $saxueColumn ) ) {
				saxue_getconfigs( 'column' );
		} 
		if ( !isset( $saxueModule ) ) {
				saxue_getconfigs( 'module' );
		} 
		if ( $saxueColumn[$_catid]['modid'] > 0 && !empty( $saxueModule[$saxueColumn[$_catid]['modid']]['moddir'] ) ) {
				return SAXUE_URL . '/' . $saxueModule[$saxueColumn[$_catid]['modid']]['moddir'] . '/admin/?catid=' . $_catid;
		} else {
				return $saxueColumn[$_catid]['url'];
		} 
} 
function get_parentdir( $_catid = 0, $_catarr ) {
		if ( !$_catid || !is_array( $_catarr ) || empty( $_catarr ) ) return;
		$p = '';
		while ( $_catarr[$_catid]['pid'] > 0 ) {
				$p = $_catarr[$_catarr[$_catid]['pid']]['catdir'] . '/' . $p;
				$_catid = $_catarr[$_catid]['pid'];
		} 
		return $p;
}
