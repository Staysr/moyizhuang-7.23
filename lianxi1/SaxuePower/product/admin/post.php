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
include_once( SAXUE_ROOT_PATH . "/model/product.php" );
$product_handler = saxueproducthandler :: getinstance( "saxueproducthandler" );
include SAXUE_ROOT_PATH . "/model/product_data.php";
$data_handler = saxueproductdatahandler :: getinstance( "saxueproductdatahandler" );
$row = array();
if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
		$product = $product_handler -> get( $_REQUEST['id'] );
		if ( !is_object( $product ) ) {
				saxue_printfail( "产品不存在" );
		}
		$row = $product -> getvars( 'n' );
		$data = $data_handler -> get( $_REQUEST['id'] );
} 
include_once( SAXUE_ROOT_PATH . "/common/funpost.php" );
if ( isset( $_POST['dosubmit'] ) ) {
		@set_time_limit( 0 );
		$_POST['islink'] = intval( $_POST['islink'] );
		$_POST['istop'] = intval( $_POST['istop'] );
		$_POST['display'] = intval( $_POST['display'] );
		$_POST['title'] = trim( $_POST['title'] );
		// 内容相关处理
		if ( !empty( $_POST['content'] ) ) {
				// 格式化文章内容
				$_POST['content'] = saxue_setcontent( $_POST['content'] );
				// 清除非本站链接 
				if ( isset( $_POST['auto_link'] ) ) {
						$_POST['content'] = clear_link( $_POST['content'] ); 
				}
				// 下载文章内图片 
				if ( isset( $_POST['auto_remote'] ) ) {
						$_POST['content'] = save_remote( $_POST['content'] ); 
				}
				// 处理文章简介
				if ( isset( $_POST['auto_intro'] ) && empty( $_POST['intro'] ) ) {
						if ( empty( $_POST['intro_length'] ) || !is_numeric( $_POST['intro_length'] ) || $_POST['intro_length'] > 240 || $_POST['intro_length'] < 30 ) $_POST['introduce_length'] = 240;
						$_POST['intro'] = saxue_substr( strip_tags( $_POST['content'] ), 0, $_POST['intro_length'] );
				}
		} 
		// 图片处理
		$_POST['thumb'] = '';
		$_POST['pic'] = trim( $_POST['pic'] );
		$_POST['pictag'] = trim( $_POST['pictag'] );
		$_POST['pics'] = array();
		if ( !empty( $_POST['pic'] ) ) {
				$_pics = explode( '|', $_POST['pic'] );
				$_tags = explode( '|', $_POST['pictag'] );
				foreach ( $_pics as $k => $_pic ) {
						if ( empty( $_POST['thumb'] ) ) $_POST['thumb'] = saxue_uploadurl() . $_pic;
						$_POST['pics'][$k]['url'] = $_pic;
						$_POST['pics'][$k]['tag'] = $_tags[$k];
						$_POST['pics'][$k]['desc'] = trim( $_POST['picdesc' . $k] );
				}
		}
		$_POST['pics'] = serialize( $_POST['pics'] );
		// 扩展属性处理
		$_POST['expand'] = array();
		if ( !empty( $_POST['expands'] ) ) {
				foreach ( $_POST['expands']['name'] as $k => $_name ) {
						if ( !empty( $_name ) && !empty( $_POST['expands']['value'][$k] ) ) {
								$_POST['expand'][$k]['name'] = $_name;
								$_POST['expand'][$k]['value'] = $_POST['expands']['value'][$k];
						}
				}
		}
		$_POST['expand'] = serialize( $_POST['expand'] );
		// 转向链接处理
		$_POST['linkurl'] = trim( $_POST['linkurl'] );
		if ( !empty( $_POST['islink'] ) && !empty( $_POST['linkurl'] ) ) {
				$_POST['url'] = $_POST['linkurl'];
		} elseif ( $row['islink'] == 0 ) {
				$_POST['url'] = $row['url'];
		} else {
				$_POST['url'] = '';
		}
		$_POST['buylink'] = trim( $_POST['buylink'] );
		// 数据入库
		if ( isset( $_REQUEST['id'] ) ) {
				$_POST['updatetime'] = SAXUE_NOW_TIME;
				$newproduct = $product_handler -> create( false );
		} else {
				$_POST['addtime'] = $_POST['updatetime'] = SAXUE_NOW_TIME;
				$newproduct = $product_handler -> create();
		}
		if ( !$product_handler -> insert( $newproduct ) ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => '产品保存失败' ) ) );
		} 
		$id = $newproduct -> getvar( 'id' );
		if ( isset( $_REQUEST['id'] ) ) {
				$data -> setvar( "content", $_POST['content'] );
				$data -> setvar( "pics", $_POST['pics'] );
				$data -> setvar( "expand", $_POST['expand'] );
				$data_handler -> insert( $data );
				// 文章缓存处理
				if ( SAXUE_USE_CACHE && $newproduct -> getvar( 'display' ) == 1 ) {
						if ( !isset( $saxueTpl ) ) {
								include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
								$saxueTpl = &saxuetpl :: getinstance();
						}
						if ( empty( $saxueLanguage[$_POST['lang']]['theme'] ) ) {
								$saxueTpl -> clear_cache( SAXUE_ROOT_PATH . '/templates/' . $_POST['lang'] . '/product/' . $saxueColumn[$catid]['setting'][$_POST['lang']]['show_template'], $id );
						} else {
								$saxueTpl -> clear_cache( SAXUE_ROOT_PATH . '/templates/' . $saxueLanguage[$_POST['lang']]['theme'] . '/product/' . $saxueColumn[$catid]['setting'][$_POST['lang']]['show_template'], $id );
						}
				}
		} else {
				$data = $data_handler -> create();
				$data -> setvar( 'id', $id );
				$data_handler -> insert( $data );
		}
		// 文章URL处理
		if ( empty( $_POST['url'] ) ) {
				$url = saxue_geturl( 'column_show', $catid, $id );
				$product_handler -> updatefields( array( 'url' => $url ), 'id=' . $id );
		} 
		exit( json_encode( array( 'flag' => 1 ) ) );
}
$expands = array();
if ( is_object( $data ) ) {
		$row['content'] = $data -> getvar( 'content' );
		$row['pics'] = $data -> getvar( 'pics', 'n' );
		$row['pics'] = unserialize( $row['pics'] );
		$row['expand'] = $data -> getvar( 'expand', 'n' );
		$row['expand'] = unserialize( $row['expand'] );
		if ( count( $row['expand'] ) > 0 ) $row['hasexpand'] = 1;
		saxue_getconfigs( 'expand', 'content' );
		foreach ( $saxueExpand as $v ) {
				if ( $row['lang'] == $v['lang'] && ( empty( $v['catid'] ) || $row['catid'] == $v['catid'] ) ) $expands[] = $v['name'];
		}
}
$langs = array();
foreach ( $saxueLanguage as $lang => $v ) {
		if ( empty( $saxueColumn[$catid]['langset'][$lang]['ishide'] ) ) {
				$langs[$lang] = $v;
		}
}
$configs = array();
saxue_getconfigs( 'configs', 'content' );
if ( empty( $saxueConfigs['content']['maxfilesize'] ) ) {
		$configs['maxfilesize'] = 1024;
} else {
		$configs['maxfilesize'] = $saxueConfigs['content']['maxfilesize'];
}
if ( empty( $saxueConfigs['content']['maxitem'] ) ) {
		$configs['maxitem'] = 3;
} else {
		$configs['maxitem'] = $saxueConfigs['content']['maxitem'];
}
$configs['attachsurl'] = saxue_uploadurl();
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "row", $row );
$saxueTpl -> assign_by_ref( "lang", $langs );
$saxueTpl -> assign_by_ref( "expands", $expands );
$saxueTpl -> assign_by_ref( "configs", $configs );
$saxueTpl -> assign( "catid", $catid );
$saxueTpl -> assign( "admincenter", 1 );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/product/templates/post.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );