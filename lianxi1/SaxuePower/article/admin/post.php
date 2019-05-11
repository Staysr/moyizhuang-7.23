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
include_once( SAXUE_ROOT_PATH . "/model/article.php" );
$article_handler = saxuearticlehandler :: getinstance( "saxuearticlehandler" );
include SAXUE_ROOT_PATH . "/model/article_data.php";
$data_handler = saxuearticledatahandler :: getinstance( "saxuearticledatahandler" );
$row = array();
if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
		$article = $article_handler -> get( $_REQUEST['id'] );
		if ( !is_object( $article ) ) {
				saxue_printfail( "文章不存在" );
		}
		$row = $article -> getvars( 'n' );
		$data = $data_handler -> get( $_REQUEST['id'] );
		$row['content'] = $data -> getvar( 'content' );
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
				// 处理标题图片
				if ( isset( $_POST['auto_thumb'] ) && empty( $_POST['thumb'] ) ) {
						$_POST['thumb_no'] = intval( $_POST['thumb_no'] ) - 1;
						if ( $_POST['thumb_no'] < 0 ) $_POST['thumb_no'] = 0;
						if ( preg_match_all( "/src=([\"|']?)([^ \"'>]+\.(jpg|jpeg|gif|png|bmp))\\1/i", $_POST['content'], $matches ) && !empty( $matches[2][$_POST['thumb_no']] ) && is_image( $matches[2][$_POST['thumb_no']] ) ) {
								$_POST['thumb'] = $matches[2][$_POST['thumb_no']];
						} 
				} 
				// 处理文章简介
				if ( isset( $_POST['auto_intro'] ) && empty( $_POST['intro'] ) ) {
						if ( empty( $_POST['intro_length'] ) || !is_numeric( $_POST['intro_length'] ) || $_POST['intro_length'] > 240 || $_POST['intro_length'] < 30 ) $_POST['introduce_length'] = 240;
						$_POST['intro'] = saxue_substr( strip_tags( $_POST['content'] ), 0, $_POST['intro_length'] );
				}
		} 
		// 转向链接处理
		$_POST['linkurl'] = trim( $_POST['linkurl'] );
		if ( !empty( $_POST['islink'] ) && !empty( $_POST['linkurl'] ) ) {
				$_POST['url'] = $_POST['linkurl'];
		} elseif ( $row['islink'] == 0 ) {
				$_POST['url'] = $row['url'];
		} else {
				$_POST['url'] = '';
		}
		if ( isset( $_REQUEST['id'] ) ) {
				$_POST['updatetime'] = SAXUE_NOW_TIME;
				$newarticle = $article_handler -> create( false );
		} else {
				$_POST['addtime'] = $_POST['updatetime'] = SAXUE_NOW_TIME;
				$newarticle = $article_handler -> create();
		}
		if ( !$article_handler -> insert( $newarticle ) ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => '文章保存失败' ) ) );
		} 
		$id = $newarticle -> getvar( 'id' );
		if ( isset( $_REQUEST['id'] ) ) {
				$data -> setvar( "content", $_POST['content'] );
				$data_handler -> insert( $data );
				// 文章缓存处理
				if ( SAXUE_USE_CACHE && $newarticle -> getvar( 'display' ) == 1 ) {
						if ( !isset( $saxueTpl ) ) {
								include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
								$saxueTpl = &saxuetpl :: getinstance();
						}
						if ( empty( $saxueLanguage[$_POST['lang']]['theme'] ) ) {
								$saxueTpl -> clear_cache( SAXUE_ROOT_PATH . '/templates/' . $_POST['lang'] . '/article/' . $saxueColumn[$catid]['setting'][$_POST['lang']]['show_template'], $id );
						} else {
								$saxueTpl -> clear_cache( SAXUE_ROOT_PATH . '/templates/' . $saxueLanguage[$_POST['lang']]['theme'] . '/article/' . $saxueColumn[$catid]['setting'][$_POST['lang']]['show_template'], $id );
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
				$article_handler -> updatefields( array( 'url' => $url ), 'id=' . $id );
		} 
		exit( json_encode( array( 'flag' => 1 ) ) );
}
$langs = array();
foreach ( $saxueLanguage as $lang => $v ) {
		if ( empty( $saxueColumn[$catid]['langset'][$lang]['ishide'] ) ) {
				$langs[$lang] = $v;
		}
}
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign_by_ref( "row", $row );
$saxueTpl -> assign_by_ref( "lang", $langs );
$saxueTpl -> assign( "catid", $catid );
$saxueTpl -> assign( "admincenter", 1 );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/article/templates/post.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );