<?php
include "core.php";
include SAXUE_WEB_PATH . "/header.php";
// 别名处理
if ( isset( $_REQUEST['alias'] ) ) {
		$_REQUEST['alias'] = trim( $_REQUEST['alias'] );
		saxue_getconfigs( 'alias' );
		if ( isset( $saxueAlias[$_REQUEST['alias']] ) ) {
				$GLOBALS['_REQUEST']['catid'] = intval( $saxueAlias[$_REQUEST['alias']] );
		} 
} 
// 栏目错误
if ( !isset( $_REQUEST['catid'] ) ) {
		include SAXUE_WEB_PATH . "/404.php";
} 
// 栏目禁止访问
if ( $saxueColumn[$_REQUEST['catid']]['langset'][SAXUE_LANGUAGE]['ishide'] == 2 ) {
		include SAXUE_WEB_PATH . "/404.php";
} 
// 模块检测
$modid = $saxueColumn[$_REQUEST['catid']]['modid'];
if ( $modid && ( !isset( $saxueModule[$modid] ) || !$saxueModule[$modid]['status'] ) ) {
		include SAXUE_WEB_PATH . "/404.php";
} 
$saxuepluginmanager -> trigger( 'content' );
// 栏目属性赋值
$saxueTpl -> assign( "catid", $_REQUEST['catid'] );
$saxueTpl -> assign( "catname", $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['name'] );
$saxueTpl -> assign( "catdir", $saxueColumn[$_REQUEST['catid']]['catdir'] );
$saxueTpl -> assign( "caturl", $saxueColumn[$_REQUEST['catid']]['url'] );
$saxueTpl -> assign( "catimage", $saxueColumn[$_REQUEST['catid']]['image'] );
$saxueTpl -> assign( "catpid", $saxueColumn[$_REQUEST['catid']]['pid'] );
$saxueTpl -> assign( "catpname", $saxueMenu[SAXUE_LANGUAGE][$saxueColumn[$_REQUEST['catid']]['pid']]['name'] );
$saxueTpl -> assign( "catpurl", $saxueColumn[$saxueColumn[$_REQUEST['catid']]['pid']]['url'] ); 
// 父栏目定位
$catpos = array();
if ( !empty( $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['arrpid'] ) ) {
		$pids = explode( ',', $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['arrpid'] );
		foreach ( $pids as $pid ) {
				if ( $pid > 0 ) $catpos[$pid] = $saxueMenu[SAXUE_LANGUAGE][$pid];
		} 
} 
$catpos[$_REQUEST['catid']] = $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']];
$saxueTpl -> assign_by_ref( "catpos", $catpos );
// 子栏目或同级栏目
$subcat = array();
if ( $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['child'] ) {
		// 子栏目列表
		$childs = $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['subcat'];
		foreach ( $childs as $child ) {
				if ( $child != $_REQUEST['catid'] && $saxueMenu[SAXUE_LANGUAGE][$child]['pid'] == $_REQUEST['catid'] ) $subcat[$child] = $saxueMenu[SAXUE_LANGUAGE][$child];
		} 
} elseif ( $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['pid'] > 0 ) {
		// 同级栏目列表，当上级栏目隐藏时无法获取同级栏目
		$childs = $saxueMenu[SAXUE_LANGUAGE][$saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['pid']]['subcat'];
		foreach ( $childs as $child ) {
				if ( $child != $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['pid'] ) $subcat[$child] = $saxueMenu[SAXUE_LANGUAGE][$child];
		} 
} 
$saxueTpl -> assign_by_ref( "subcat", $subcat );
// 栏目模版设置
$temp_setting = $saxueColumn[$_REQUEST['catid']]['setting'][SAXUE_LANGUAGE];
if ( empty( $temp_setting['list_pnum'] ) ) $temp_setting['list_pnum'] = 10;
// 栏目SEO设置
$seo = $saxueColumn[$_REQUEST['catid']]['seo'][SAXUE_LANGUAGE];
if ( !is_array( $seo ) ) $seo = array();
if ( empty( $seo['meta_title'] ) ) $seo['meta_title'] = $saxueColumn[$_REQUEST['catid']]['langset'][SAXUE_LANGUAGE]['showname'];
$saxueTpl -> assign_by_ref( "saxue_seo", $seo );
// 导入模块文件
if ( !$modid && $saxueColumn[$_REQUEST['catid']]['custom'] != '' ) {
		include SAXUE_WEB_PATH . $saxueColumn[$_REQUEST['catid']]['custom'];
} elseif ( !empty( $_REQUEST['show'] ) ) {
		include SAXUE_WEB_PATH . '/' . $saxueModule[$modid]['moddir'] . '/' . $_REQUEST['show'] . '.php';
} elseif ( $saxueModule[$modid]['type'] && !isset( $_REQUEST['id'] ) ) {
		include SAXUE_WEB_PATH . '/' . $saxueModule[$modid]['moddir'] . '/list.php';
} else {
		include SAXUE_WEB_PATH . '/' . $saxueModule[$modid]['moddir'] . '/show.php';
} 
include_once( SAXUE_WEB_PATH . "/footer.php" );
