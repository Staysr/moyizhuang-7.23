<?php
class blocksystemsql extends saxueblock {
		var $template = "block_system_sql.html";
		var $sqlvars = array( 'sql' => '', 'pagenum' => 10, 'page' => 1 );
		function blocksystemsql( &$_vars ) {
				$this -> saxueblock( $_vars );
				if ( !empty( $this -> blockvars['sql'] ) ) {
						$_sql = trim( $this -> blockvars['sql'] );
						if ( preg_match_all( "/\\\$([a-zA-Z_0-9]+)/i", $_sql, $_matches ) ) {
								global $saxueTpl;
								$_from = $_matches[0];
								$_to = array();
								foreach ( $_matches[1] as $_var ) {
										$_to[] = $saxueTpl -> get_assign( $_var );
								}
								$_sql = str_replace( $_from, $_to, $_sql );
						}
						$this -> sqlvars['sql'] = $_sql;
				}
				if ( !empty( $this -> blockvars['pagenum'] ) ) {
						$_pagenum = intval( $_pagenum );
						if ( $_pagenum > 0 ) {
								$this -> sqlvars['pagenum'] = $_pagenum;
						}
				}
				if ( !empty( $this -> blockvars['page'] ) ) {
						$_page = intval( $_page );
						if ( $_page > 0 ) {
								$this -> sqlvars['page'] = $_page;
						}
				}
				$this -> blockvars['cacheid'] = md5( serialize( $this -> sqlvars ) . "|" . $this -> blockvars['template'] );
		}
		function setcontent( $isreturn = false ) {
				global $saxueTpl;
				$rows = array();
				if ( !empty( $this -> sqlvars['sql'] ) ) {
						saxue_includedb();
						$query_handler = saxuequeryhandler :: getinstance( 'saxuequeryhandler' );
						$sql = $this -> sqlvars['sql'] . ' LIMIT ' . ( $this -> sqlvars['page'] - 1 ) * $this -> sqlvars['pagenum'] . ', ' . $this -> sqlvars['pagenum'];
						$res = $query_handler -> db -> query( $sql );
						$k = 0;
						while ( $v = $query_handler -> getobject( $res ) ) {
								$rows[$k] = $v -> getvars( 'n' );
								++$k;
						}
				}
				$saxueTpl -> assign_by_ref( "rows", $rows );
				$saxueTpl -> assign( "page", $this -> sqlvars['page'] );
				$saxueTpl -> assign( "pagenum", $this -> sqlvars['pagenum'] );
		}
}