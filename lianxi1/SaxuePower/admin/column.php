<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'column' );
if ( !isset( $_REQUEST['action'] ) ) $_REQUEST['action'] = '';
if ( !isset( $_REQUEST['pid'] ) || !is_numeric( $_REQUEST['pid'] ) ) $_REQUEST['pid'] = 0;
saxue_getconfigs( 'column' );
saxue_getconfigs( 'module' );
saxue_getconfigs( 'urlrule' );
include_once( SAXUE_ROOT_PATH . "/common/funadmin.php" );
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/model/column.php" );
$data_handler = saxuecolumnhandler :: getinstance( "saxuecolumnhandler" );
switch ( $_REQUEST['action'] ) {
		case "add" :
				if ( isset( $_REQUEST['catid'] ) && is_numeric( $_REQUEST['catid'] ) ) {
						$cate = $data_handler -> get( $_REQUEST['catid'] );
						if ( !$cate ) {
								saxue_printfail( '栏目不存在' );
						} 
						$row = $cate -> getvars( 'n' );
						$row['setting'] = unserialize( $row['setting'] );
						$row['seo'] = unserialize( $row['seo'] );
						if ( $row['modid'] > 0 ) {
								$_res = $data_handler -> db -> query( "SELECT COUNT(1) FROM " . saxue_dbprefix( $saxueModule[$row['modid']]['tablename'] ) . " WHERE catid=" . $row['catid'] );
								if ( !$_res ) {
										$resrows = 0;
								} else {
										list( $resrows ) = $data_handler -> db -> fetchrow( $_res );
								}
								if ( $resrows > 0 ) $row['modforbid'] = 1;
						}
				} elseif ( !empty( $_REQUEST['pid'] ) ) {
						if ( !isset( $saxueColumn[$_REQUEST['pid']] ) ) {
								saxue_printfail( '上级栏目不存在' );
						}
						$row['modid'] = $saxueColumn[$_REQUEST['pid']]['modid'];
						$row['catid'] = 0;
				} 
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['catdir'] = strtolower( trim( $_POST['catdir'] ) );
						if ( !preg_match( "/^[a-z][a-z0-9]+$/i", $_POST['catdir'] ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '英文目录/标识必须以英文字母开始' ) ) );
						}
						if ( $_POST['catdir'] != $row['catdir'] && 0 < $data_handler -> getcount( new criteria( 'catdir', $_POST['catdir'] ) ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '英文目录/标识已存在' ) ) );
						} 
						$_POST['setting'] = serialize( $_POST['setting'] );
						$_POST['seo'] = serialize( $_POST['seo'] );
						if ( isset( $_REQUEST['catid'] ) ) {
								if ( $_REQUEST['catid'] == $_POST['pid'] ) {
										exit( json_encode( array( 'flag' => 0, 'msg' => '自己不能作为自己的上级栏目' ) ) );
								}
								$newcate = $data_handler -> create( false );
						} else {
								$_langset = array();
								$_langset['zh']['ishide'] = 0;
								$_langset['zh']['showname'] = $_POST['catname'];
								$_POST['langset'] = serialize( $_langset );
								$newcate = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $newcate ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						cache_column();
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
				$tree = new tree;
				$tree -> icon = array( '&nbsp;│&nbsp;', '&nbsp;├&nbsp;', '&nbsp;└&nbsp;' );
				$tree -> nbsp = '&nbsp;';
				$tree -> mid = 'catid';
				$tree -> pid = 'pid';
				$tree -> init( $saxueColumn );
				$str = "<option value=\$catid \$selected>\$spacer\$catname</option>";
				if ( isset( $_REQUEST['catid'] ) ) {
						$column = $tree -> get_tree( 0, $str, $saxueColumn[$_REQUEST['catid']]['pid'] );
				} else {
						$column = $tree -> get_tree( 0, $str, $_REQUEST['pid'] );
				}
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign( "column", $column );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTpl -> assign_by_ref( "urlrule", $saxueUrlrule );
				$saxueTpl -> assign_by_ref( "modules", $saxueModule );
				$saxueTpl -> assign_by_ref( "lang", $saxueLanguage );
				$saxueTpl -> setcaching( 0 );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/column_add.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit();
		case "addlink" :
				if ( isset( $_REQUEST['catid'] ) && is_numeric( $_REQUEST['catid'] ) ) {
						$cate = $data_handler -> get( $_REQUEST['catid'] );
						if ( !$cate ) {
								saxue_printfail( '栏目不存在' );
						} 
						$row = $cate -> getvars( 'n' );
						if ( $row['custom'] == '' ) $row['custom'] = $row['url'];
				} elseif ( !empty( $_REQUEST['pid'] ) && !isset( $saxueColumn[$_REQUEST['pid']] ) ) {
						saxue_printfail( '上级栏目不存在' );
				} 
				if ( isset( $_POST['dosubmit'] ) ) {
						$_POST['custom'] = strtolower( trim( $_POST['custom'] ) );
						if ( 0 !== strpos( $_POST['custom'], 'http://' ) && 0 !== strpos( $_POST['custom'], '/' ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => '格式错误' ) ) );
						}
						if ( 0 === strpos( $_POST['custom'], 'http://' ) ) {
								$_POST['url'] = $_POST['custom'];
								$_POST['custom'] = '';
								$_POST['ismenu'] = 1;
						} else {
								$_POST['url'] = '';
						}
						if ( isset( $_REQUEST['catid'] ) ) {
								if ( $_REQUEST['catid'] == $_POST['pid'] ) {
										exit( json_encode( array( 'flag' => 0, 'msg' => '自己不能作为自己的上级栏目' ) ) );
								}
								if ( empty( $_POST['url'] ) ) $_POST['url'] = saxue_geturl( 'custom', $_REQUEST['catid'], $_POST['ruleid'] );
								$newcate = $data_handler -> create( false );
						} else {
								$_langset = array();
								$_langset['zh']['ishide'] = 0;
								$_langset['zh']['showname'] = $_POST['catname'];
								$_POST['langset'] = serialize( $_langset );
								$newcate = $data_handler -> create();
						} 
						if ( !$data_handler -> insert( $newcate ) ) {
								exit( json_encode( array( 'flag' => 0, 'msg' => LANG_ERROR_DATABASE ) ) );
						} 
						if ( empty( $_POST['url'] ) ) {
								$cid = $newcate -> getvar( 'catid' );
								$url = saxue_geturl( 'custom', $cid, $_POST['ruleid'] );
								$data_handler -> updatefields( array( 'url' => $url ), 'catid=' . $cid );
						}
						cache_column();
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				$urlrule = array();
				foreach ( $saxueUrlrule as $id => $v ) {
						if ( 1 == $v['modid'] ) {
								$urlrule[$id] = $v['example'];
						}
				}
				include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
				$tree = new tree;
				$tree -> icon = array( '&nbsp;│&nbsp;', '&nbsp;├&nbsp;', '&nbsp;└&nbsp;' );
				$tree -> nbsp = '&nbsp;';
				$tree -> mid = 'catid';
				$tree -> pid = 'pid';
				$tree -> init( $saxueColumn );
				$str = "<option value=\$catid \$selected>\$spacer\$catname</option>";
				if ( isset( $_REQUEST['catid'] ) ) {
						$column = $tree -> get_tree( 0, $str, $saxueColumn[$_REQUEST['catid']]['pid'] );
				} else {
						$column = $tree -> get_tree( 0, $str, $_REQUEST['pid'] );
				}
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign( "column", $column );
				$saxueTpl -> assign_by_ref( "row", $row );
				$saxueTpl -> assign_by_ref( "urlrule", $urlrule );
				$saxueTpl -> setcaching( 0 );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/column_addlink.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit();
		case "langset" :
				if ( isset( $_POST['dosubmit'] ) ) {
						foreach( $_POST['langset'] as $k => $v ) {
								$_langset = serialize( $v );
								$data_handler -> updatefields( array( 'langset' => $_langset ), 'catid=' . $k );
						} 
						cache_column();
						exit( json_encode( array( 'flag' => 1 ) ) );
				} 
				include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
				$tree = new tree;
				$tree -> icon = array( '&nbsp;│&nbsp;', '&nbsp;├─&nbsp;', '&nbsp;└─&nbsp;' );
				$tree -> nbsp = '&nbsp;';
				$tree -> mid = 'catid';
				$tree -> pid = 'pid';
				$column = array();
				foreach ( $saxueLanguage as $lang => $v ) {
						$str = "";
						foreach ( $saxueColumn as $catid => $cat ) {
								$saxueColumn[$catid][$lang . '_showname'] = isset( $cat['langset'][$lang] ) ? $cat['langset'][$lang]['showname'] : $cat['catdir'];
								if ( 1 == $cat['langset'][$lang]['ishide'] ) {
										$saxueColumn[$catid][$lang . '_hide'] = ' selected';
										$saxueColumn[$catid][$lang . '_forbid'] = '';
										$saxueColumn[$catid][$lang . '_color'] = 'color:blue';
										$saxueColumn[$catid][$lang . '_seoclass'] = 'setseo';
										$saxueColumn[$catid][$lang . '_seoicon'] = saxue_geticon( 'set', 'SEO设置', 0 );
								} elseif ( 2 == $cat['langset'][$lang]['ishide'] ) {
										$saxueColumn[$catid][$lang . '_hide'] = '';
										$saxueColumn[$catid][$lang . '_forbid'] = ' selected';
										$saxueColumn[$catid][$lang . '_color'] = 'color:red';
										$saxueColumn[$catid][$lang . '_seoclass'] = '';
										$saxueColumn[$catid][$lang . '_seoicon'] = saxue_geticon( 'set', '禁止访问', 0 );
								} else {
										$saxueColumn[$catid][$lang . '_hide'] = '';
										$saxueColumn[$catid][$lang . '_forbid'] = '';
										$saxueColumn[$catid][$lang . '_color'] = '';
										$saxueColumn[$catid][$lang . '_seoclass'] = 'setseo';
										$saxueColumn[$catid][$lang . '_seoicon'] = saxue_geticon( 'set', 'SEO设置' );
								}
								if ( empty( $cat['modid'] ) && empty( $cat['custom'] ) ) {
										$saxueColumn[$catid][$lang . '_seoclass'] = '';
										$saxueColumn[$catid][$lang . '_seoicon'] = saxue_geticon( 'set', '外部链接', 0 );
								} 
						}
						$str = "<tr class='rowbg'><td>\$spacer\$catname</td>";
						$str .= "<td><select style='\$" . $lang . "_color' name='langset[\$catid][" . $lang . "][ishide]'><option value='0'>显示</option><option value='1'\$" . $lang . "_hide>隐藏</option><option value='2'\$" . $lang . "_forbid>禁止访问</option></select></td>";
						$str .= "<td><input name='langset[\$catid][" . $lang . "][showname]' type='text' size='50' value='\$" . $lang . "_showname' class='text'></td>";
						$str .= "<td><a href='javascript:' class='\$" . $lang . "_seoclass' catid='\$catid' lang='" . $lang . "'>\$" . $lang . "_seoicon</a></td>";
						$str .= "</tr>";
						$tree -> init( $saxueColumn );
						$column[$lang] = $tree -> get_tree( 0, $str );
				}
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "column", $column );
				$saxueTpl -> assign_by_ref( "lang", $saxueLanguage );
				$saxueTpl -> setcaching( 0 );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/column_langset.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit();
		case "cache" :
		case "repair" :
				//$data_handler -> queryobjects();
				$criteria = new criteriacompo();
				$criteria -> setsort( "listorder" );
				$criteria -> setorder( "ASC" );
				$data_handler -> queryobjects( $criteria );
				$CATEGORY = array();
				while ( $v = $data_handler -> getobject() ) {
						$CATEGORY[$v -> getvar( "catid" )] = $v -> getvars( "n" );
				} 
				if ( is_array( $CATEGORY ) ) {
						foreach( $CATEGORY as $cid => $cate ) {
								$arrpid = cache_get_arrpid( $cid, $CATEGORY );
								$arrchild = cache_get_arrchild( $cid, $CATEGORY );
								$arrchild = rtrim( $arrchild, "," );
								$child = is_numeric( $arrchild ) ? 0 : 1;
								if ( $CATEGORY[$cid]['modid'] == 0 ) {
										$url = $CATEGORY[$cid]['url'];
								} elseif ( $saxueModule[$CATEGORY[$cid]['modid']]['type'] == 0 ) {
										$url = saxue_geturl( 'column_show', $cid );
								} else {
										$url = saxue_geturl( 'column_list', $cid );
								}
								if ( $CATEGORY[$cid]['arrpid'] != $arrpid || $CATEGORY[$cid]['arrchild'] != $arrchild || $CATEGORY[$cid]['child'] != $child || $CATEGORY[$cid]['url'] != $url ) {
										$data_handler -> updatefields( array( 'arrpid' => $arrpid, 'arrchild' => $arrchild, 'child' => $child, 'url' => $url ), 'catid=' . $cid );
								} 
						} 
				} 
				foreach( $CATEGORY as $cid => $cate ) {
						if ( $cate['pid'] != 0 && !isset( $CATEGORY[$cate['pid']] ) ) {
								$data_handler -> delete( $cid );
						}
				} 
				cache_column();
				saxue_jumppage( 'column.php', LANG_DO_SUCCESS );
				break;
		case "listorder" :
				foreach( $_POST['listorder'] as $k => $v ) {
						$v = intval( $v );
						$data_handler -> updatefields( array( 'listorder' => $v ), 'catid=' . $k );
				} 
				cache_column();
				saxue_jumppage( 'column.php', LANG_DO_SUCCESS );
				break;
		case "seoset" :
				$catid = intval( $_REQUEST['catid'] );
				$lang = trim( $_REQUEST['lang'] );
				if ( empty( $catid ) || !isset( $saxueLanguage[$lang] ) ) {
						saxue_printfail( LANG_ERROR_PARAMETER );
				} 
				$cate = $data_handler -> get( $catid );
				if ( !$cate ) {
						saxue_printfail( '栏目不存在' );
				} 
				$seo = $cate -> getvar( "seo", 'n' );
				$seo = unserialize( $seo );
				if ( isset( $_POST['dosubmit'] ) ) {
						$seo[$lang] = $_POST['seo'];
						$seo = serialize( $seo );
						$data_handler -> updatefields( array( 'seo' => $seo ), 'catid=' . $catid );
						cache_column();
						exit( json_encode( array( 'flag' => 1 ) ) );
				}
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				$saxueTpl -> assign_by_ref( "seo", $seo[$lang] );
				$saxueTpl -> assign( "catid", $catid );
				$saxueTpl -> assign( "lang", $lang );
				$saxueTpl -> setcaching( 0 );
				$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/column_seoset.html";
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
				exit;
		case "delete" :
				if ( !isset( $_REQUEST['catid'] ) || !is_numeric( $_REQUEST['catid'] ) ) {
						saxue_printfail( LANG_ERROR_PARAMETER );
				} 
				$cate = $data_handler -> get( $_REQUEST['catid'] );
				if ( !$cate ) {
						saxue_printfail( '栏目不存在' );
				} 
				if ( $cate -> getvar( "child" ) == 1 ) {
						saxue_printfail( '请先删除子栏目' );
				} 
				$modid = $cate -> getvar( "modid" );
				if ( $modid > 0 && isset( $saxueModule[$modid] ) ) {
						$_class = 'saxue' . str_replace( '_', '', $saxueModule[$modid]['tablename'] ) . 'handler';
						include_once( SAXUE_ROOT_PATH . "/model/" . $saxueModule[$modid]['tablename'] . ".php" );
						$del_handler = call_user_func( array( $_class, 'getinstance' ), $_class );
						$del_handler -> deletebycat( $_REQUEST['catid'] );
				}
				$data_handler -> delete( $_REQUEST['catid'] );
				saxue_jumppage( '?action=repair' );
				break;
} 
$criteria = new criteriacompo();
$criteria -> setsort( "listorder" );
$criteria -> setorder( "ASC" );
$data_handler -> queryobjects( $criteria );
$rows = array();
while ( $v = $data_handler -> getobject() ) {
		$k = $v -> getvar( "catid" );
		$rows[$k]['pid'] = $v -> getvar( "pid" );
		$rows[$k]['catid'] = $v -> getvar( "catid" );
		$rows[$k]['catname'] = $v -> getvar( "catname" );
		$rows[$k]['listorder'] = $v -> getvar( "listorder" );
		$rows[$k]['url'] = $v -> getvar( "url" );
		$rows[$k]['modid'] = $v -> getvar( "modid" );
		$rows[$k]['custom'] = $v -> getvar( "custom" );
		$rows[$k]['str_manage'] = '';
		if ( $rows[$k]['modid'] > 0 ) {
				$rows[$k]['modname'] = $saxueModule[$rows[$k]['modid']]['name'];
				$rows[$k]['str_manage'] = '<a href="?action=add&pid=' . $k . '">' . saxue_geticon( 'add', '添加子栏目' ) . '</a>&nbsp;&nbsp;';
				$rows[$k]['str_manage'] .= '<a href="?action=add&catid=' . $k . '">' . saxue_geticon( 'edit', '修改栏目' ) . '</a>&nbsp;&nbsp;';
		} else {
				if ( $rows[$k]['custom'] !='' ) $rows[$k]['modname'] = '<span class="blue">自定义文件</span>';
				else  $rows[$k]['modname'] = '<span class="red">外部链接</span>';
				$rows[$k]['str_manage'] = '<a href="javascript:doDialog(\'' . SAXUE_ADMIN_URL . '/column.php?action=addlink&pid=' . $k . '\',\'添加子栏目\',\'500\',\'240\')">' . saxue_geticon( 'add', '添加子栏目' ) . '</a>&nbsp;&nbsp;';
				$rows[$k]['str_manage'] .= '<a href="javascript:doDialog(\'' . SAXUE_ADMIN_URL . '/column.php?action=addlink&catid=' . $k . '\',\'修改栏目\',\'500\',\'240\')">' . saxue_geticon( 'edit', '修改栏目' ) . '</a>&nbsp;&nbsp;';
		}
		$rows[$k]['str_manage'] .= '<a href="?action=delete&catid=' . $k . '" onclick="return confirm(\'你确定要删除『' . $rows[$k]['catname'] . '』吗？\')">' . saxue_geticon( 'del', '删除栏目' ) . '</a>';
} 
include_once( SAXUE_ROOT_PATH . "/lib/util/tree.php" );
$tree = new tree;
$tree -> icon = array( '&nbsp;&nbsp;&nbsp;<span class="f_tree">│</span>&nbsp;', '&nbsp;&nbsp;&nbsp;<span class="f_tree">├─</span>&nbsp;', '&nbsp;&nbsp;&nbsp;<span class="f_tree">└─</span>&nbsp;' );
$tree -> nbsp = '&nbsp;&nbsp;&nbsp;';
$tree -> mid = 'catid';
$tree -> pid = 'pid';
$tree -> init( $rows );
$str = "<tr class='rowbg'>
			<td><input name='listorder[\$catid]' type='text' size='3' value='\$listorder' class='text'></td>
			<td>\$catid</td>
			<td>\$spacer\$catname</td>
			<td>\$modname</td>
			<td><a href='\$url' target='_blank'>访问</a></td>
			<td>\$str_manage</td>
		</tr>";
$column = $tree -> get_tree( 0, $str );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "column", $column );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/column.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
