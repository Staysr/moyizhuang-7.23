<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'urlupdate' );
saxue_getconfigs( 'column' );
saxue_getconfigs( 'module' );
$modid = isset( $_REQUEST['modid'] ) ? intval( $_REQUEST['modid'] ) : 0;
if ( isset( $_REQUEST['dosubmit'] ) ) {
		saxue_includedb();
		$query_handler = saxuequeryhandler :: getinstance( 'saxuequeryhandler' );
		$page = isset( $_REQUEST['page'] ) ? intval( $_REQUEST['page'] ) : 1;
		$total = isset( $_REQUEST['total'] ) ? intval( $_REQUEST['total'] ) : 0;
		$pagesize = !empty( $_REQUEST['pagesize'] ) ? intval( $_REQUEST['pagesize'] ) : 100;
		if ( !is_array( $_REQUEST['catids'] ) ) {
				$catids = $_REQUEST['catids'];
		} elseif ( $_REQUEST['catids'][0] > 0 ) {
				$catids = implode( ',', $_REQUEST['catids'] );
		} else {
				$catids = '';
		} 
		if ( $modid ) {
				$table = saxue_dbprefix( $saxueModule[$modid]['tablename'] );
				$sql = $table . " WHERE 1";
				if ( !empty( $catids ) ) $sql .= " AND catid IN(" . $catids . ")";
		} else {
				if ( empty( $catids ) ) {
						$arrcatid = array();
						foreach ( $saxueColumn as $cid => $cat ) {
								if ( $cat['modid'] && $saxueModule[$cat['modid']]['type'] > 1 ) $arrcatid[] = $cid;
						} 
						$catids = implode( ',', $arrcatid );
				}
				$autoid = isset( $_REQUEST['autoid'] ) ? intval( $_REQUEST['autoid'] ) : 0;
				$categorys = explode( ',', $catids );
				// 更新完成
				if ( !isset( $categorys[$autoid] ) ) {
						saxue_jumppage( 'urlupdate.php', 'URL更新完成', 1 );
				} 
				$catid = $categorys[$autoid];
				$table = saxue_dbprefix( $saxueModule[$saxueColumn[$catid]['modid']]['tablename'] );
				$sql = $table . " WHERE catid=" . $catid;
		} 
		$url = '?dosubmit=1&modid=' . $modid . '&catids=' . $catids . '&type=' . $_REQUEST['type'] . '&pagesize=' . $pagesize;
		switch ( $_REQUEST['type'] ) {
				case 'lastinput':
						$sql .= " ORDER BY id DESC";
						break;
				case 'date':
						if ( !empty( $_REQUEST['fromtime'] ) ) {
								$sql .= " AND addtime>=" . strtotime( $_REQUEST['fromtime'] . " 00:00:00" );
								$url .= '&fromtime=' . $_REQUEST['fromtime'];
						}
						if ( !empty( $_REQUEST['totime'] ) ) {
								$sql .= " AND addtime<=" . strtotime( $_REQUEST['totime'] . " 23:59:59" );
								$url .= '&totime=' . $_REQUEST['totime'];
						}
						break;
				case 'id':
						if ( !empty( $_REQUEST['fromid'] ) ) {
								$sql .= " AND id>=" . intval( $_REQUEST['fromid'] );
								$url .= '&fromid=' . $_REQUEST['fromid'];
						}
						if ( !empty( $_REQUEST['toid'] ) ) {
								$sql .= " AND id<=" . intval( $_REQUEST['toid'] );
								$url .= '&toid=' . $_REQUEST['toid'];
						}
						break;
		} 
		if ( empty( $total ) ) {
				$res = $query_handler -> db -> query( "SELECT COUNT(1) FROM " . $sql );
				if ( !$res ) {
						$total = 0;
				} else {
						list( $total ) = $query_handler -> db -> fetchrow( $res );
				} 
		} 
		$pages = ceil( $total / $pagesize );
		$sql .= " LIMIT " . ( ( $page - 1 ) * $pagesize ) . ", " . $pagesize;
		// 更新URL
		$res = $query_handler -> db -> query( "SELECT * FROM " . $sql );
		while ( $v = $query_handler -> getobject( $res ) ) {
				$tmp = $v -> getvars( 'n' );
				if ( !isset( $tmp['islink'] ) || !$tmp['islink'] ) {
						$_url = saxue_geturl( 'column_show', $tmp['catid'], $tmp['id'] );
						$query_handler -> db -> query( "UPDATE " . $table . " SET url='" . $_url . "' WHERE id=" . $tmp['id'] );
				}
		}
		if ( $pages > $page ) {
				++$page;
				if ( $modid ) {
						$msg = '总信息数：' . $total . '，已更新 ' . ( ( $page - 1 ) * $pagesize ) . '条，正在跳转到下一页';
				} else {
						$msg = '【' . $saxueColumn[$catid]['catname'] . '】总信息数：' . $total . '，已更新 ' . ( ( $page - 1 ) * $pagesize ) . '条，正在跳转到下一页';
						$url .= '&autoid=' . $autoid;
				}
		} else {
				if ( $modid ) {
						saxue_jumppage( 'urlupdate.php', 'URL更新完成', 1 );
				} else {
						++$autoid;
						$total = 0;
						$page = 1;
						$msg = '【' . $saxueColumn[$catid]['catname'] . '】更新完成，继续更新其他栏目...';
						$url .= '&autoid=' . $autoid;
				}
		}
		$url .= '&total=' . $total . '&page=' . $page;
		saxue_jumppage( $url, $msg, 1 );
} 
$categorys = array();
foreach ( $saxueColumn as $cid => $cat ) {
		if ( $saxueModule[$cat['modid']]['type'] <= 1 && !$cat['child'] ) continue;
		if ( $modid && $modid != $cat['modid'] && !$cat['child'] ) continue;
		$cat['disabled'] = $cat['child'] ? 'disabled' : '';
		$categorys[$cid] = $cat;
} 
foreach ( $categorys as $cid => $cat ) {
		if ( !empty( $cat['disabled'] ) && $cat['child'] ) {
				$unset = true;
				$childs = explode( ',', $cat['arrchild'] );
				foreach ( $childs as $child ) {
						if ( $child != $cid && isset( $categorys[$child] ) && empty( $categorys[$child]['disabled'] ) ) {
								$unset = false;
								break;
						}
				}
				if ( $unset ) unset( $categorys[$cid] );
		}
} 
include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
$tree = new tree;
$tree -> icon = array( '&nbsp;│&nbsp;', '&nbsp;├─&nbsp;', '&nbsp;└─&nbsp;' );
$tree -> nbsp = '&nbsp;';
$tree -> mid = 'catid';
$tree -> pid = 'pid';
$tree -> init( $categorys );
$str = "<option value='\$catid' \$disabled>\$spacer\$catname</option>";
$column = $tree -> get_tree( 0, $str );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "modid", $modid );
$saxueTpl -> assign( "column", $column );
$saxueTpl -> assign_by_ref( "module", $saxueModule );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/urlupdate.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
