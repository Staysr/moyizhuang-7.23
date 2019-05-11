<?php
// 导入配置缓存
saxue_getconfigs( 'module' );
saxue_getconfigs( 'column' );
saxue_getconfigs( 'menu' );
$saxuepluginmanager -> trigger( 'header' );
if( empty( $saxue_language ) ) {
		// 定义使用语言
		if ( isset( $_REQUEST['pl'] ) ) {
				$saxue_language = $_REQUEST['pl'];
		} elseif ( SAXUE_LANGUAGE_TYPE ) {
				$saxue_language = strtolower( str_replace( array( '.' . SAXUE_COOKIE_DOMAIN, SAXUE_COOKIE_DOMAIN ), '', $_SERVER['HTTP_HOST'] ) );
				if ( $saxue_language == 'www' ) $saxue_language = '';
		} elseif ( isset( $_REQUEST['l'] ) ) {
				$saxue_language = $_REQUEST['l'];
				saxue_setcookie( 'saxueLanguage', $saxue_language, SAXUE_NOW_TIME + 365 * 86400 );
		} else {
				$saxue_language = saxue_getcookie( 'saxueLanguage' );
		}
		// 使用默认语言
		if ( empty( $saxue_language ) || !isset( $saxueLanguage[$saxue_language] ) || !$saxueLanguage[$saxue_language]['display'] ) {
				foreach ( $saxueLanguage as $lang => $v ) {
						if ( $v['isdefault'] ) {
								$saxue_language = $lang;
								break;
						}
				}
				if ( !SAXUE_LANGUAGE_TYPE ) {
						saxue_setcookie( 'saxueLanguage', $saxue_language, SAXUE_NOW_TIME + 365 * 86400 );
				}
		}
}
define( "SAXUE_LANGUAGE", $saxue_language );
// ETag
if ( !empty( $_SERVER['HTTP_IF_NONE_MATCH'] ) ) {
		$etag = explode( "|", $_SERVER['HTTP_IF_NONE_MATCH'] );
		if ( 1 < count( $etag ) && is_numeric( $etag[0] ) && SAXUE_LANGUAGE == $etag[1] && ( SAXUE_NOW_TIME - $etag[0] < 3 ) ) {
				header( "ETag:" . SAXUE_NOW_TIME . "|" . SAXUE_LANGUAGE, true, 304 );
				saxue_freeresource();
				exit();
		} 
} 
@header( "ETag:" . SAXUE_NOW_TIME . "|" . SAXUE_LANGUAGE );
// 模版目录设置
define( "SAXUE_THEME_PATH", SAXUE_ROOT_PATH . '/templates/' . $saxueLanguage[SAXUE_LANGUAGE]['theme'] );
// 定义模版对象
include( SAXUE_ROOT_PATH . "/lib/template/template.php" );
$saxueTpl = &saxuetpl :: getinstance();
// 网站基础参数赋值
$saxueTpl -> assign( array( 
		"saxue_style" => $saxueLanguage[SAXUE_LANGUAGE]['style'],
		"saxue_tel" => SAXUE_TEL,
		"saxue_fax" => SAXUE_FAX,
		"saxue_email" => SAXUE_EMAIL,
		"saxue_qq" => SAXUE_QQ,
		"saxue_beian" => SAXUE_BEIAN,
		"saxue_tongji" => SAXUE_TONGJI,
		"saxue_exp1" => SAXUE_EXP1,
		"saxue_exp2" => SAXUE_EXP2,
		"saxue_exp3" => SAXUE_EXP3
) );
$saxueTpl -> assign( "saxue_sitename", $saxueLanguage[SAXUE_LANGUAGE]['sitename'] );
$saxueTpl -> assign( "saxue_language", SAXUE_LANGUAGE );
$saxueTpl -> assign_by_ref( "saxue_menu", $saxueMenu[SAXUE_LANGUAGE] );
$saxueTpl -> assign_by_ref( "saxue_column", $saxueColumn );
$saxueTpl -> assign_by_ref( "saxue_module", $saxueModule );
// 风格URL赋值
$saxueTpl -> assign( "saxue_skin_url", SAXUE_SKIN_SERVER . '/' . $saxueLanguage[SAXUE_LANGUAGE]['skin'] );
// 语言包赋值
saxue_getconfigs( SAXUE_LANGUAGE, 'lang', 'Lang' );
if ( file_exists( SAXUE_THEME_PATH . '/lang/' . SAXUE_LANGUAGE . '.php' ) ) {
		include( SAXUE_THEME_PATH . '/lang/' . SAXUE_LANGUAGE . '.php' );
}
$saxueTpl -> assign_by_ref( "l", $Lang );
// 多语言菜单赋值
$saxue_langs = array();
foreach ( $saxueLanguage as $lang => $v ) {
		if ( $v['display'] ) {
				$saxue_langs[$lang]['name'] = $v['name'];
				$saxue_langs[$lang]['url'] = $v['url'];
				$saxue_langs[$lang]['url2'] = $v['url2'];
		}
}
$saxueTpl -> assign_by_ref( "saxue_langs", $saxue_langs );
// SEO赋值
$seo = $saxueLanguage[SAXUE_LANGUAGE]['seo'];
if ( empty( $seo['meta_title'] ) ) $seo['meta_title'] = $saxueLanguage[SAXUE_LANGUAGE]['sitename'];
$saxueTpl -> assign_by_ref( "saxue_seo", $seo );
// 参数赋值
saxue_getconfigs( 'configs', 'content' );
$saxueTpl -> assign_by_ref( "config", $saxueConfigs['content'] ); 