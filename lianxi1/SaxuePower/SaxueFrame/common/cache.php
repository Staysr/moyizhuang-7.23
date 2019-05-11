<?php
if ( !is_object( $query_handler ) ) {
		saxue_includedb();
		$query_handler = saxuequeryhandler :: getinstance( 'saxuequeryhandler' );
}
function cache_roles() {
		global $query_handler;
		$sql = "SELECT id,rolename,power,status FROM " . saxue_dbprefix( 'system_roles' ) . " ORDER BY id ASC";
		$_result = $query_handler -> db -> query( $sql );
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$k = $v -> getvar( 'id' );
				$rows[$k] = $v -> getvars( 'n' );
		}
		saxue_setconfigs( "roles", $rows, "admin" );
}
function cache_language() {
		global $query_handler;
		$sql = "SELECT * FROM " . saxue_dbprefix( 'system_language' ) . " ORDER BY listorder ASC";
		$_result = $query_handler -> db -> query( $sql );
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$k = $v -> getvar( 'lang' );
				$rows[$k] = $v -> getvars( 'n' );
				$rows[$k]['seo'] = unserialize( $rows[$k]['seo'] );
				if ( SAXUE_LANGUAGE_TYPE && SAXUE_COOKIE_DOMAIN != '' ) {
						if ( $rows[$k]['isdefault'] ) $rows[$k]['url'] = SAXUE_URL;
						else $rows[$k]['url'] = 'http://' . $k . '.' . SAXUE_COOKIE_DOMAIN;
				}
				else $rows[$k]['url'] = SAXUE_URL . '/?l=' . $k;
		}
		saxue_setconfigs( "language", $rows, "system", "saxueLanguage", true );
}
function cache_module() {
		global $query_handler;
		$sql = "SELECT * FROM " . saxue_dbprefix( 'module' ) . " ORDER BY id ASC";
		$_result = $query_handler -> db -> query( $sql );
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$k = $v -> getvar( 'id' );
				$rows[$k] = $v -> getvars( 'n' );
		}
		saxue_setconfigs( "module", $rows, "system", "saxueModule", true );
}
function cache_urlrule() {
		global $query_handler;
		$sql = "SELECT * FROM " . saxue_dbprefix( 'urlrule' ) . " ORDER BY id ASC";
		$_result = $query_handler -> db -> query( $sql );
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$k = $v -> getvar( 'id' );
				$rows[$k] = $v -> getvars( 'n' );
		}
		saxue_setconfigs( "urlrule", $rows, "system", "saxueUrlrule", true );
}
function cache_column() {
		global $query_handler;
		$sql = "SELECT * FROM " . saxue_dbprefix( 'column' ) . " ORDER BY listorder ASC";
		$_result = $query_handler -> db -> query( $sql );
		$rows = $aliasrows = array();
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$catid = $v -> getvar( 'catid' );
				$rows[$catid] = $v -> getvars( 'n' );
				$rows[$catid]['setting'] = unserialize( $rows[$catid]['setting'] );
				$rows[$catid]['langset'] = unserialize( $rows[$catid]['langset'] );
				$rows[$catid]['seo'] = unserialize( $rows[$catid]['seo'] );
				if ( !empty( $rows[$catid]['catdir'] ) ) {
						$aliasrows[$rows[$catid]['catdir']] = $catid;
				}
		}
		saxue_setconfigs( "column", $rows, "system", "saxueColumn", true );
		saxue_setconfigs( "alias", $aliasrows );
		cache_column_menu( $rows );
		cache_wap_menu( $rows );
}
function cache_column_menu( $CATEGORY ) {
		global $saxueLanguage;
		global $saxueModule;
		if ( !isset( $saxueLanguage ) ) {
				saxue_getconfigs( 'language' );
		}
		if ( !isset( $saxueModule ) ) {
				saxue_getconfigs( 'module' );
		}
		$menus = array();
		foreach ( $saxueLanguage as $lang => $v ) {
				$menu = array();
				foreach( $CATEGORY as $cid => $cat ) {
						if ( empty( $cat['langset'][$lang]['ishide'] ) ) {
								if ( !isset( $cat['langset'][$lang] ) ) $menu[$cid]['name'] = $cat['catdir'];
								else $menu[$cid]['name'] = $cat['langset'][$lang]['showname'];
								$menu[$cid]['image'] = $cat['image'];
								$menu[$cid]['catdir'] = $cat['catdir'];
								$menu[$cid]['pid'] = $cat['pid'];
								$menu[$cid]['arrpid'] = $cat['arrpid'];
								$subcat = array();
								if ( $cat['child'] ) {
										$childs = explode( ',', $cat['arrchild'] );
										foreach ( $childs as $childid ) {
												if ( $childid != $cid && $CATEGORY[$childid]['pid'] == $cid && empty( $CATEGORY[$childid]['langset'][$lang]['ishide'] ) ) {
														$subcat[$childid] = $childid;
														if ( empty( $menu[$cid]['first'] ) ) $menu[$cid]['first'] = $childid;
												}
										}
								}
								$menu[$cid]['subcat'] = $subcat;
								$menu[$cid]['child'] = count( $subcat );
								$menu[$cid]['arrchild'] = cache_get_langchild( $cid, $CATEGORY, $lang );
								if ( $menu[$cid]['child'] && $cat['modid'] && empty( $saxueModule[$cat['modid']]['type'] ) ) {
										$menu[$cid]['url'] = $CATEGORY[$menu[$cid]['first']]['url'];
								} else {
										$menu[$cid]['url'] = $cat['url'];
								}
								$menu[$cid]['ismenu'] = $cat['ismenu'];
						} 
				} 
				$menus[$lang] = $menu;
		}
		saxue_setconfigs( "menu", $menus, "system", "saxueMenu", true );
}
function cache_get_langchild( $id, $CATEGORY, $lang ) {
		$arrchild = $id;
		if ( is_array( $CATEGORY ) ) {
				foreach( $CATEGORY as $cid => $cat ) {
						if ( $cat['pid'] == $id && $cid != $id && empty( $cat['langset'][$lang]['ishide'] ) ) {
								$arrchild .= ',' . cache_get_langchild( $cid, $CATEGORY, $lang );
						} 
				} 
		} 
		return $arrchild;
} 
function cache_wap_menu( $CATEGORY ) {
		if( !file_exists( SAXUE_DATA_PATH . '/configs/wap/wapset.php' ) ) {
				return false;
		}
		global $saxueWapset;
		global $saxueLanguage;
		global $saxueModule;
		if ( !isset( $saxueWapset ) ) {
				saxue_getconfigs( 'wapset', 'wap' );
		}
		if ( !isset( $saxueLanguage ) ) {
				saxue_getconfigs( 'language' );
		}
		if ( !isset( $saxueModule ) ) {
				saxue_getconfigs( 'module' );
		}
		$menus = $columns = array();
		foreach ( $saxueLanguage as $lang => $v ) {
				$menu = array();
				foreach( $CATEGORY as $cid => $cat ) {
						if ( !isset( $columns[$cid] ) ) $columns[$cid] = $cat;
						$columns[$cid]['langset'][$lang]['ishide'] = $saxueWapset[$lang][$cid]['ishide'];
						$columns[$cid]['setting'][$lang]['list_pnum'] = intval( $saxueWapset[$lang][$cid]['list_pnum'] );
						$columns[$cid]['setting'][$lang]['search_pnum'] = intval( $saxueWapset[$lang][$cid]['search_pnum'] );
						if ( empty( $saxueWapset[$lang][$cid]['ishide'] ) ) {
								if ( !isset( $cat['langset'][$lang] ) ) $menu[$cid]['name'] = $cat['catdir'];
								else $menu[$cid]['name'] = $cat['langset'][$lang]['showname'];
								$menu[$cid]['catdir'] = $cat['catdir'];
								$menu[$cid]['pid'] = $cat['pid'];
								$menu[$cid]['arrpid'] = $cat['arrpid'];
								$subcat = array();
								if ( $cat['child'] ) {
										$childs = explode( ',', $cat['arrchild'] );
										foreach ( $childs as $childid ) {
												if ( $childid != $cid && $CATEGORY[$childid]['pid'] == $cid && empty( $saxueWapset[$lang][$childid]['ishide'] ) ) {
														$subcat[$childid] = $childid;
														if ( empty( $menu[$cid]['first'] ) ) $menu[$cid]['first'] = $childid;
												}
										}
								}
								$menu[$cid]['subcat'] = $subcat;
								$menu[$cid]['child'] = count( $subcat );
								$menu[$cid]['arrchild'] = cache_get_wapchild( $cid, $CATEGORY, $lang, $saxueWapset );
								if ( $menu[$cid]['child'] && $cat['modid'] && empty( $saxueModule[$cat['modid']]['type'] ) ) {
										$menu[$cid]['url'] = $CATEGORY[$menu[$cid]['first']]['url'];
								} else {
										$menu[$cid]['url'] = $cat['url'];
								}
								$menu[$cid]['ismenu'] = $cat['ismenu'];
						} 
				} 
				$menus[$lang] = $menu;
		}
		saxue_setconfigs( "menu", $menus, "wap", "saxueMenu", true );
		saxue_setconfigs( "column", $columns, "wap", "saxueColumn", true );
}
function cache_get_wapchild( $id, $CATEGORY, $lang, $saxueWapset ) {
		$arrchild = $id;
		if ( is_array( $CATEGORY ) ) {
				foreach( $CATEGORY as $cid => $cat ) {
						if ( $cat['pid'] == $id && $cid != $id && empty( $saxueWapset[$lang][$cid]['ishide'] ) ) {
								$arrchild .= ',' . cache_get_wapchild( $cid, $CATEGORY, $lang, $saxueWapset );
						} 
				} 
		} 
		return $arrchild;
} 
function cache_get_arrpid( $id, $CATEGORY, $arrpid = '' ) {
		if ( !is_array( $CATEGORY ) || !isset( $CATEGORY[$id] ) ) return false;
		$pid = $CATEGORY[$id]['pid'];
		$arrpid = $arrpid ? $pid . ',' . $arrpid : $pid;
		if ( $pid ) {
				$arrpid = cache_get_arrpid( $pid, $CATEGORY, $arrpid );
		} else {
				$CATEGORY[$id]['arrpid'] = $arrpid;
		} 
		$pid = $CATEGORY[$id]['pid'];
		return $arrpid;
} 
function cache_get_arrchild( $id, $CATEGORY ) {
		$arrchild = $id;
		if ( is_array( $CATEGORY ) ) {
				foreach( $CATEGORY as $cid => $cat ) {
						if ( $cat['pid'] && $cid != $id && $cat['pid'] == $id ) {
								$arrchild .= ',' . cache_get_arrchild( $cid, $CATEGORY );
						} 
				} 
		} 
		return $arrchild;
} 
function cache_product_expand() {
		global $query_handler;
		$sql = "SELECT * FROM " . saxue_dbprefix( 'product_expand' ) . " ORDER BY listorder ASC";
		$_result = $query_handler -> db -> query( $sql );
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$k = $v -> getvar( 'id' );
				$rows[$k] = $v -> getvars( 'n' );
		}
		saxue_setconfigs( "expand", $rows, "content", "saxueExpand", true );
}
function cache_lang() {
		global $query_handler;
		$sql = "SELECT * FROM " . saxue_dbprefix( 'lang' );
		$_result = $query_handler -> db -> query( $sql );
		$rows = array();
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$name = $v -> getvar( 'name' );
				$setting = $v -> getvar( 'setting', 'n' );
				$setting = unserialize( $setting );
				foreach ( $setting as $lang => $v ) {
						$rows[$lang][$name] = trim( $v );
				}
		}
		foreach ( $rows as $lang => $v ) {
				saxue_setconfigs( $lang, $v, "lang", "Lang" );
		}
}
function cache_banner() {
		global $query_handler;
		$sql = "SELECT a.*,b.title as name,b.pics as piccount,b.type,b.width,b.height FROM " . saxue_dbprefix( 'banner_pic' ) . " a LEFT JOIN " . saxue_dbprefix( 'banner' ) . " b ON a.bid=b.id WHERE a.status=1 ORDER BY a.listorder ASC";
		$_result = $query_handler -> db -> query( $sql );
		$rows = array();
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$bid = $v -> getvar( 'bid' );
				if ( !isset( $rows[$bid] ) ) {
						$rows[$bid]['name'] = $v -> getvar( 'name' );
						$rows[$bid]['type'] = $v -> getvar( 'type' );
						$rows[$bid]['width'] = $v -> getvar( 'width' );
						$rows[$bid]['height'] = $v -> getvar( 'height' );
						$rows[$bid]['piccount'] = $v -> getvar( 'piccount' );
						$rows[$bid]['pics'] = array();
				}
				$tmp = array();
				$tmp['url'] = $v -> getvar( 'url' );
				$tmp['title'] = $v -> getvar( 'title' );
				$tmp['link'] = $v -> getvar( 'link' );
				$rows[$bid]['pics'][] = $tmp;
		}
		saxue_setconfigs( "banner", $rows, "banner", "saxueBanner", true );
}
function cache_plugin() {
		global $query_handler;
		$sql = "SELECT * FROM " . saxue_dbprefix( 'plugin' );
		$_result = $query_handler -> db -> query( $sql );
		while ( $v = $query_handler -> getobject( $_result ) ) {
				$k = $v -> getvar( 'identifier' );
				$rows[$k] = $v -> getvars( 'n' );
				$rows[$k]['path'] = '/plugin/' . $rows[$k]['dir'];
				if ( !empty( $rows[$k]['menu'] ) ) {
						$rows[$k]['menu'] = unserialize( $rows[$k]['menu'] );
						foreach ( $rows[$k]['menu'] as $pmod => $v ) {
								if ( false === strpos( $v['url'], 'http://' ) ) {
										$rows[$k]['menu'][$pmod]['url'] = $rows[$k]['path'] . '/' . $v['url'];
								}
								if ( false === strpos( $v['url'], '?' ) ) {
										$rows[$k]['menu'][$pmod]['url'] .= '?identifier=' . $k . '&pmod=' . $pmod;
								} else {
										$rows[$k]['menu'][$pmod]['url'] .= '&identifier=' . $k . '&pmod=' . $pmod;
								}
						}
				}
				if ( is_array( $rows[$k]['menu'] ) && count( $rows[$k]['menu'] ) > 0 ) {
						$rows[$k]['hasmenu'] = 1;
				} else {
						$rows[$k]['hasmenu'] = 0;
				}
		}
		saxue_setconfigs( "plugin", $rows, "system", "saxuePlugin", true );
}