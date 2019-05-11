<?php
class blockproductlist extends saxueblock {
		var $template = "block_productlist.html";
		var $exevars = array( 'listnum' => 10, 'catid' => '0', 'isthumb' => '0', 'field' => 'id' );
		function blockproductlist( &$_vars ) {
				global $saxueTpl;
				$this -> saxueblock( $_vars );
				if ( !empty( $this -> blockvars['vars'] ) ) {
						$_fieldarr = explode( ",", trim( $this -> blockvars['vars'] ) );
						$_fieldcount = count( $_fieldarr );
						if ( 0 < $_fieldcount ) {
								$_fieldarr[0] = trim( $_fieldarr[0] );
								if ( is_numeric( $_fieldarr[0] ) && 0 < $_fieldarr[0] ) {
										$this -> exevars['listnum'] = intval( $_fieldarr[0] );
								} else if ( substr( $_fieldarr[0], 0, 1 ) == "\$" ) {
										$_listnumvar = $saxueTpl -> get_assign( substr( $_fieldarr[0], 1 ) );
										if ( is_numeric( $_listnumvar ) ) {
												$this -> exevars['listnum'] = $_listnumvar;
										} 
								} else if ( isset( $_REQUEST[$_fieldarr[0]] ) && is_numeric( $_REQUEST[$_fieldarr[0]] ) ) {
										$this -> exevars['listnum'] = $_REQUEST[$_fieldarr[0]];
								} 
						}  
						if ( 1 < $_fieldcount ) {
								$_fieldarr[1] = trim( $_fieldarr[1] );
								$_catid = str_replace( "|", "", $_fieldarr[1] );
								if ( is_numeric( $_catid ) ) {
										$this -> exevars['catid'] = $_fieldarr[1];
								} else if ( substr( $_fieldarr[1], 0, 1 ) == "\$" ) {
										$_catidvar = $saxueTpl -> get_assign( substr( $_fieldarr[1], 1 ) );
										if ( is_numeric( str_replace( "|", "", $_catidvar ) ) ) {
												$this -> exevars['catid'] = $_catidvar;
										} 
								} else if ( isset( $_REQUEST[$_catid] ) && is_numeric( $_REQUEST[$_catid] ) ) {
										$this -> exevars['catid'] = $_REQUEST[$_catid];
								} 
						}
						if ( 2 < $_fieldcount ) {
								$_fieldarr[2] = trim( $_fieldarr[2] );
								if ( is_numeric( $_fieldarr[2] ) && in_array( $_fieldarr[2], array( 0, 1 ) ) ) {
										$this -> exevars['isthumb'] = $_fieldarr[2];
								} 
						} 
						if ( 3 < $_fieldcount ) {
								$_fieldarr[3] = trim( $_fieldarr[3] );
								if ( in_array( $_fieldarr[3], array( "views", "istop", "id", "addtime" ) ) ) {
										$this -> exevars['field'] = $_fieldarr[3];
								} 
						} 
				} 
				$this -> blockvars['cacheid'] = md5( serialize( $this -> exevars ) . "|" . $this -> blockvars['template'] );
		} 
		function setcontent( $isreturn = false ) {
				global $saxueTpl;
				global $saxueMenu;
				global $data_handler;
				if ( !is_object( $data_handler ) ) {
						include_once( SAXUE_ROOT_PATH . "/model/product.php" );
						$data_handler = saxueproducthandler :: getinstance( "saxueproducthandler" );
				}
				$sql = 'SELECT * FROM ' . saxue_dbprefix( "product" ) . ' WHERE 1';
				if ( !empty( $this -> exevars['catid'] ) ) {
						$catidstr = "";
						$catidnum = 0;
						$catidary = explode( "|", $this -> exevars['catid'] );
						foreach ( $catidary as $v ) {
								if ( is_numeric( $v ) && !empty( $v ) ) {
										if ( !empty( $catidstr ) ) {
												$catidstr .= ' OR ';
										} 
										if ( $saxueMenu[SAXUE_LANGUAGE][$v]['child'] ) {
												$catidstr .= "catid IN(" . $saxueMenu[SAXUE_LANGUAGE][$v]['arrchild'] . ")";
										} else {
												$catidstr .= "catid=" . intval( $v );
										} 
										++$catidnum;
								} 
						} 
						if ( $catidnum == 1 ) {
								$sql .= ' AND ' . $catidstr;
						} else if ( 1 < $catidnum ) {
								$sql .= ' AND (' . $catidstr . ')';
						} 
				} 
				$sql .= " AND lang='" . SAXUE_LANGUAGE . "' AND display=1";
				if ( $this -> exevars['isthumb'] ) {
						$sql .= " AND thumb!=''";
				} 
				$sql .= " ORDER BY istop DESC";
				if ( $this -> exevars['field'] != 'top' ) {
						$sql .= ',' . $this -> exevars['field'] . ' DESC';
				}
				if ( $this -> exevars['field'] != 'id' ) {
						$sql .= ',id DESC';
				}
				$sql .= ' LIMIT 0, ' . $this -> exevars['listnum'];
				$res = $data_handler -> db -> query( $sql );
				$rows = array();
				$k = 0;
				while ( $v = $data_handler -> getobject( $res ) ) {
						$rows[$k] = $v -> getvars( 'n' );
						$rows[$k]['catname'] = $saxueMenu[SAXUE_LANGUAGE][$rows[$k]['catid']]['name'];
						$rows[$k]['caturl'] = $saxueMenu[SAXUE_LANGUAGE][$rows[$k]['catid']]['url'];
						++$k;
				} 
				$saxueTpl -> assign_by_ref( "rows", $rows );
		} 
} 
