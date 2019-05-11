<?php
include "core.php";
// 查询关键字
if ( isset( $_REQUEST['q'] ) ) $_REQUEST['q'] = saxue_htmlstr( trim( $_REQUEST['q'] ) );
if ( empty( $_REQUEST['q'] ) ) header( 'Location: /' );
// 包含配置参数
saxue_getconfigs( 'configs', 'content' );
include( SAXUE_WEB_PATH . "/header.php" );
// 查询模块或栏目
$_REQUEST['modid'] = intval( $_REQUEST['modid'] );
$_REQUEST['catid'] = intval( $_REQUEST['catid'] );
if ( empty( $_REQUEST['modid'] ) && empty( $_REQUEST['catid'] ) ) header( 'Location: /' );
// 检查关键字长度
if ( !empty( $saxueConfigs['content']['minsearchlen'] ) && mb_strlen( $_REQUEST['q'], 'utf8' ) < intval( $saxueConfigs['content']['minsearchlen'] ) ) {
		if ( !empty( $_REQUEST['ajax_request'] ) ) exit( json_encode( array( 'flag' => 0, 'msg' => sprintf( $Lang['minsearchlen'], $saxueConfigs['content']['minsearchlen'] ) ) ) );
		else saxue_printfail( sprintf( $Lang['minsearchlen'], $saxueConfigs['content']['minsearchlen'] ) );
} 
// 检查时间，是否允许搜索
if ( !empty( $saxueConfigs['content']['minsearchtime'] ) && empty( $_REQUEST['page'] ) ) {
		$saxue_visit_time = saxue_strtosary( saxue_getcookie( 'saxueVisitTime' ) );
		if ( !empty( $_SESSION['saxueSearchTime'] ) ) $logtime = $_SESSION['saxueSearchTime'];
		elseif ( !empty( $saxue_visit_time['saxueSearchTime'] ) ) $logtime = $saxue_visit_time['saxueSearchTime'];
		else $logtime = 0;
		if ( ( $logtime > 0 ) && SAXUE_NOW_TIME - $logtime < intval( $saxueConfigs['content']['minsearchtime'] ) ) {
				if ( !empty( $_REQUEST['ajax_request'] ) ) exit( json_encode( array( 'flag' => 0, 'msg' => sprintf( $Lang['minsearchtime'], $saxueConfigs['content']['minsearchtime'] ) ) ) );
				else saxue_printfail( sprintf( $Lang['minsearchtime'], $saxueConfigs['content']['minsearchtime'] ) );
		} 
		$_SESSION['saxueSearchTime'] = SAXUE_NOW_TIME;
		$saxue_visit_time['saxueSearchTime'] = SAXUE_NOW_TIME;
		saxue_setcookie( 'saxueVisitTime', saxue_sarytostr( $saxue_visit_time ), SAXUE_NOW_TIME + 3600 );
} 
// 模块检查
saxue_getconfigs( 'module' );
if ( isset( $saxueColumn[$_REQUEST['catid']] ) ) $_REQUEST['modid'] = $saxueColumn[$_REQUEST['catid']]['modid'];
if ( !isset( $saxueModule[$_REQUEST['modid']] ) || !$saxueModule[$_REQUEST['modid']]['status'] || !$saxueModule[$_REQUEST['modid']]['issearch'] || $saxueModule[$_REQUEST['modid']]['searchfield'] == '' ) {
		if ( !empty( $_REQUEST['ajax_request'] ) ) exit( json_encode( array( 'flag' => 0, 'msg' => $Lang['moduleclose'] ) ) );
		else saxue_printfail( $Lang['moduleclose'] );
}
$saxuepluginmanager -> trigger( 'content' );
// 模版和每页显示
$temp_setting = $saxueColumn[$_REQUEST['catid']]['setting'][SAXUE_LANGUAGE];
if ( isset( $_REQUEST['catid'] ) ) {
		$pnum = intval( $temp_setting['search_pnum'] );
}
if ( empty( $pnum ) ) $pnum = intval( $saxueConfigs['content']['searchpnum'] );
if ( empty( $temp_setting['search_template'] ) ) $template = $saxueModule[$_REQUEST['modid']]['moddir'] . '/search.html';
else $template = $saxueModule[$_REQUEST['modid']]['moddir'] . '/' . $temp_setting['search_template'];
// 页码
if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) ) $_REQUEST['page'] = 1;
// 搜索字段
$_REQUEST['q'] = str_replace( '&', ' ', $_REQUEST['q'] );
// 生成唯一HASH
$hashid = md5( SAXUE_LANGUAGE . "&&" . $_REQUEST['q'] . "&&" . $_REQUEST['modid'] . "&&" . $_REQUEST['catid'] );
// 检查搜索缓存
include SAXUE_ROOT_PATH . "/model/search.php";
$search_handler = &saxuesearchhandler :: getinstance( "saxuesearchhandler" );
$query_handler = saxuequeryhandler :: getinstance( 'saxuequeryhandler' );
$criteria = new criteriacompo( new criteria( 'hashid', $hashid, '=' ) );
$criteria -> setlimit( 1 );
$criteria -> setstart( 0 );
$search_handler -> queryobjects( $criteria );
$search = $search_handler -> getobject();
// 是否使用cache
$usecache = false;
// 有搜索缓存
if ( is_object( $search ) ) {
		$searchcache = intval( $saxueConfigs['content']['searchcache'] );
		if ( empty( $searchcache ) ) $searchcache = 86400;
		if ( SAXUE_NOW_TIME - $search -> getvar( 'searchtime' ) < $searchcache ) $usecache = true;
} 
// 使用缓存
if ( $usecache ) {
		$allresults = $search -> getvar( 'results', 'n' );
		$ids = $search -> getvar( 'ids', 'n' );
		if ( empty( $ids ) ) $ids = 0;
		elseif ( $allresults == 1 ) $ids = intval( $ids );
		else $ids = trim( $ids );
		if ( $allresults > $pnum ) {
				$idary = explode( ',', $ids );
				$search_resultnum = count( $idary );
				$maxpage = ceil( $search_resultnum / $pnum );
				if ( $_REQUEST['page'] > $maxpage ) $_REQUEST['page'] = $maxpage;
				$startid = ( $_REQUEST['page']-1 ) * $pnum;
				$ids = '';
				$i = $startid;
				$j = 0;
				while ( $i < $search_resultnum && $j < $pnum ) {
						if ( !empty( $ids ) ) $ids .= ',';
						$ids .= intval( $idary[$i] );
						++$i;
						++$j;
				} 
				$rescount = $j;
		} else {
				$startid = 0;
				$_REQUEST['page'] = 1;
				$rescount = $allresults;
		} 
		$sql = "SELECT * FROM " . saxue_dbprefix( $saxueModule[$_REQUEST['modid']]['tablename'] ) . " WHERE id IN (" . saxue_dbslashes( $ids ) . ") ORDER BY id DESC LIMIT 0, " . $pnum;
		$res = $query_handler -> execute( $sql );
		$truecount = $query_handler -> db -> getrowsnum( $res );
		if ( $truecount != $rescount ) $usecache = false;
} 
// 搜索字段
$fields = explode( ',', $saxueModule[$_REQUEST['modid']]['searchfield'] );
// 不使用缓存
if ( !$usecache ) {
		if ( empty( $_REQUEST['catid'] ) ) {
				$sql = "SELECT * FROM " . saxue_dbprefix( $saxueModule[$_REQUEST['modid']]['tablename'] ) . " WHERE display=1";
		} elseif ( empty( $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['arrchild'] ) ) {
				$sql = "SELECT * FROM " . saxue_dbprefix( $saxueModule[$_REQUEST['modid']]['tablename'] ) . " WHERE catid=" . $_REQUEST['catid'] . " AND display=1";
		} else {
				$sql = "SELECT * FROM " . saxue_dbprefix( $saxueModule[$_REQUEST['modid']]['tablename'] ) . " WHERE catid IN (" . $saxueMenu[SAXUE_LANGUAGE][$_REQUEST['catid']]['arrchild'] . ") AND display=1";
		}
		$_field = '';
		foreach ( $fields as $field ) {
				if ( !empty( $_field ) ) $_field .= ' OR ';
				$_field .= $field . " REGEXP '" . $_REQUEST['q'] . "'";
		}
		$sql .= " AND (" . $_field . ") ORDER BY id DESC";
		if ( !empty( $saxueConfigs['content']['maxsearchres'] ) ) {
				$sql .= " LIMIT 0, " . $saxueConfigs['content']['maxsearchres'];
		} 
		$res = $query_handler -> execute( $sql );
		$allresults = $query_handler -> db -> getrowsnum( $res );
		if ( $allresults <= $pnum ) $rescount = $allresults;
		else $rescount = $pnum;
		$_REQUEST['page'] = 1;
} 
// 读取数据
$rows = array();
$k = 0;
$ids = '';
while ( $v = $query_handler -> getobject() ) {
		if ( !$usecache ) {
				if ( !empty( $ids ) ) $ids .= ',';
				$ids .= $v -> getvar( 'id' );
		} 
		$rows[$k] = $v -> getvars( "n" );
		$rows[$k]['catname'] = $saxueMenu[SAXUE_LANGUAGE][$rows[$k]['catid']]['name'];
		$rows[$k]['caturl'] = $saxueMenu[SAXUE_LANGUAGE][$rows[$k]['catid']]['url'];
		$rows[$k]['catdir'] = $saxueColumn[$rows[$k]['catid']]['catdir'];
		// 替换搜索关键词
		foreach ( $fields as $field ) {
				$rows[$k]['q_' . $field] = str_replace( $_REQUEST['q'], '<i>' . $_REQUEST['q'] . '</i>', $rows[$k][$field] );
		}
		++$k;
		if ( $k >= $pnum ) break;
} 
// 处理剩余的结果，用于缓存
if ( !$usecache ) {
		while ( $v = $query_handler -> getobject() ) {
				if ( !empty( $ids ) ) $ids .= ',';
				$ids .= $v -> getvar( 'id' );
		} 
		if ( is_object( $search ) ) {
				// 以前有缓存，更新
				$searchtimes = $search -> getvar( 'searchtimes' ) + 1;
				$search -> setvar( 'searchtimes', $searchtimes );
		} else {
				// 以前没缓存，增加
				$search = $search_handler -> create();
				$search -> setvar( 'hashid', $hashid );
				$search -> setvar( 'keywords', $_REQUEST['q'] );
				$search -> setvar( 'lang', SAXUE_LANGUAGE );
				$search -> setvar( 'modid', $_REQUEST['modid'] );
				$search -> setvar( 'catid', $_REQUEST['catid'] );
		} 
		$search -> setvar( 'searchtime', SAXUE_NOW_TIME );
		$search -> setvar( 'results', $allresults );
		$search -> setvar( 'ids', $ids );
		$search_handler -> insert( $search );
} 
if ( !empty( $_REQUEST['ajax_request'] ) && $_REQUEST['page'] > 1 ) {
		exit( json_encode( array( 'flag' => 1, 'page' => $_REQUEST['page'], 'data' => $rows ) ) );
}
// 模版显示
$saxueTpl -> assign_by_ref( 'rows', $rows ); 
$saxueTpl -> assign( 'q', $_REQUEST['q'] );
$saxueTpl -> assign( 'allresults', $allresults );
include_once( SAXUE_ROOT_PATH . '/lib/util/page.php' ); 
$jumppage = new saxuepage( $allresults, $pnum, $_REQUEST['page'] );
if ( !empty( $_REQUEST['ajax_request'] ) ) {
		exit( json_encode( array( 'flag' => 1, 'page' => $_REQUEST['page'], 'totalpage' => $jumppage -> total_page, 'data' => $rows ) ) );
}
$jumppage -> setlink( '', true, true );
$saxueTpl -> assign( 'url_jumppage', $jumppage -> whole_bar() );
$saxueTpl -> assign( "totalpage", $jumppage -> total_page );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_page_template'] = SAXUE_THEME_PATH . '/' . $template;
include_once( SAXUE_WEB_PATH . '/footer.php' );