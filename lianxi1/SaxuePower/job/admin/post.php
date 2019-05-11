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
include_once( SAXUE_ROOT_PATH . "/model/job.php" );
$job_handler = saxuejobhandler :: getinstance( "saxuejobhandler" );
$row = array();
if ( isset( $_REQUEST['id'] ) && is_numeric( $_REQUEST['id'] ) ) {
		$job = $job_handler -> get( $_REQUEST['id'] );
		if ( !is_object( $job ) ) {
				saxue_printfail( "招聘职位不存在" );
		}
		$row = $job -> getvars( 'n' );
		$row['content'] = $job -> getvar( 'content' );
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
				$newjob = $job_handler -> create( false );
		} else {
				$_POST['addtime'] = $_POST['updatetime'] = SAXUE_NOW_TIME;
				$newjob = $job_handler -> create();
		}
		if ( !$job_handler -> insert( $newjob ) ) {
				exit( json_encode( array( 'flag' => 0, 'msg' => '内容保存失败' ) ) );
		} 
		$id = $newjob -> getvar( 'id' );
		if ( isset( $_REQUEST['id'] ) ) {
				// 文章缓存处理
				if ( SAXUE_USE_CACHE && $newjob -> getvar( 'display' ) == 1 ) {
						if ( !isset( $saxueTpl ) ) {
								include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
								$saxueTpl = &saxuetpl :: getinstance();
						}
						if ( empty( $saxueLanguage[$_POST['lang']]['theme'] ) ) {
								$saxueTpl -> clear_cache( SAXUE_ROOT_PATH . '/templates/' . $_POST['lang'] . '/job/' . $saxueColumn[$catid]['setting'][$_POST['lang']]['show_template'], $id );
						} else {
								$saxueTpl -> clear_cache( SAXUE_ROOT_PATH . '/templates/' . $saxueLanguage[$_POST['lang']]['theme'] . '/job/' . $saxueColumn[$catid]['setting'][$_POST['lang']]['show_template'], $id );
						}
				}
		}
		// 文章URL处理
		if ( empty( $_POST['url'] ) ) {
				$url = saxue_geturl( 'column_show', $catid, $id );
				$job_handler -> updatefields( array( 'url' => $url ), 'id=' . $id );
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
$saxueTset['saxue_contents_template'] = SAXUE_WEB_PATH . "/job/templates/post.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );