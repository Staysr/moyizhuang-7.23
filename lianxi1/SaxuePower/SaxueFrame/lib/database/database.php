<?php
class saxuedatabase extends saxueobject {
		function saxuedatabase() {
				$this -> saxueobject();
		} 

		function &retinstance() {
				static $instance = array();
				return $instance;
		} 

		function close( $_db = null ) {
				if ( is_object( $_db ) ) {
						$_db -> close();
				} else {
						$_instance = &saxuedatabase :: retinstance();
						if ( !empty( $_instance ) ) {
								foreach ( $_instance as $_db ) {
										$_db -> close();
								} 
						} 
				} 
		} 

		function &getinstance( $dbset = array() ) {
				$instance = &saxuedatabase :: retinstance();
				if ( !is_array( $dbset ) ) {
						$dbset = array();
				} 
				if ( !isset( $dbset['dbtype'] ) ) {
						$dbset['dbtype'] = SAXUE_DB_TYPE;
				} 
				if ( !isset( $dbset['dbhost'] ) ) {
						$dbset['dbhost'] = SAXUE_DB_HOST;
				} 
				if ( !isset( $dbset['dbuser'] ) ) {
						$dbset['dbuser'] = SAXUE_DB_USER;
				} 
				if ( !isset( $dbset['dbpass'] ) ) {
						$dbset['dbpass'] = SAXUE_DB_PASS;
				} 
				if ( !isset( $dbset['dbname'] ) ) {
						$dbset['dbname'] = SAXUE_DB_NAME;
				} 
				if ( !isset( $dbset['dbpconnect'] ) ) {
						$dbset['dbpconnect'] = SAXUE_DB_PCONNECT;
				} 
				if ( !isset( $dbset['dbcharset'] ) || defined( "SAXUE_DB_CHARSET" ) ) {
						$dbset['dbcharset'] = SAXUE_DB_CHARSET;
				} 
				if ( !isset( $dbset['dbusage'] ) ) {
						$dbset['dbusage'] = 0;
				} else {
						$dbset['dbusage'] = intval( $dbset['dbusage'] );
				} 
				$inskey = md5( implode( "|", $dbset ) );
				if ( !isset( $instance[$inskey] ) ) {
						switch ( $dbset['dbtype'] ) {
								case "mysql" :
										require_once( SAXUE_ROOT_PATH . "/lib/database/mysql/db.php" );
										$instance[$inskey] = new saxuemysqldatabase();
										break;
								case "sqlite" :
										require_once( "sqlite/db.php" );
										$instance[$inskey] = new saxuesqlitedatabase();
										break;
								default :
										saxue_printfail( "The database type (" . $dbset['dbtype'] . ") is not exists!", 0 );
										return false;
						} 
						$instance[$inskey] -> setdbset( $dbset );
				} 
				return $instance[$inskey];
		} 
} 

class saxueobjectdata extends saxueobject {
		var $_isNew = false;

		function saxueobjectdata() {
				$this -> saxueobject();
		} 

		function setnew() {
				$this -> _isNew = true;
		} 

		function unsetnew() {
				$this -> _isNew = false;
		} 

		function isnew() {
				return $this -> _isNew;
		} 

		function initvar( $_key, $_type, $_value = null, $_caption = "", $_required = false, $_maxlength = null, $_isdirty = false ) {
				$this -> vars[$_key] = array( "type" => $_type, "value" => $_value, "caption" => $_caption, "required" => $_required, "maxlength" => $_maxlength, "isdirty" => $_isdirty, "default" => "", "options" => "" );
		} 

		function setoptions( $_key, $_options ) {
				$this -> vars[$_key]['options'] = $_options;
		} 

		function setvar( $_key, $_value, $_isdirty = true ) {
				if ( !empty( $_key ) && isset( $_value ) ) {
						if ( !isset( $this -> vars[$_key] ) ) {
								$this -> initvar( $_key, SAXUE_TYPE_TXTBOX );
						} 
						$this -> vars[$_key]['value'] = $_value;
						$this -> vars[$_key]['isdirty'] = $_isdirty;
				} 
		} 

		function setvars( $_vars, $_isdirty = false ) {
				if ( is_array( $_vars ) ) {
						foreach ( $_vars as $_key => $_value ) {
								$this -> setvar( $_key, $_value, $_isdirty );
						} 
				} 
		} 

		function getvars( $_quotestyle = "" ) {
				if ( in_array( $_quotestyle, array( "s", "e", "q", "t", "o", "n" ) ) ) {
						$_ret = array();
						foreach ( $this -> vars as $_k => $_v ) {
								$_ret[$_k] = $this -> getvar( $_k, $_quotestyle );
						} 
						return $_ret;
				} 
				return $this -> vars;
		} 

		function getvar( $_key, $_quotestyle = "s" ) {
				if ( isset( $this -> vars[$_key]['value'] ) ) {
						if ( is_string( $this -> vars[$_key]['value'] ) ) {
								switch ( strtolower( $_quotestyle ) ) {
										case "s" :
												return saxue_htmlstr( $this -> vars[$_key]['value'] );
										case "e" :
												return preg_replace( "/&amp;#(\\d+);/isU", "&#\\1;", htmlspecialchars( $this -> vars[$_key]['value'], ENT_QUOTES ) );
										case "q" :
												return saxue_dbslashes( $this -> vars[$_key]['value'] );
										case "t" :
												return $this -> vars[$_key]['caption'];
										case "o" :
												return !empty( $this -> vars[$_key]['options'][$this -> vars[$_key]['value']] ) ? $this -> vars[$_key]['options'][$this -> vars[$_key]['value']] : "";
										case "n" :
												return $this -> vars[$_key]['value'];
								} 
						} 
						return $this -> vars[$_key]['value'];
				} 
				return false;
		} 
} 

class saxuequeryhandler extends saxueobject {
		var $db;
		var $sqlres;

		function saxuequeryhandler( $_db = "" ) {
				$this -> saxueobject();
				if ( empty( $_db ) || !is_object( $_db ) ) {
						$this -> db = &saxuedatabase :: getinstance();
				} elseif ( !empty( $_db ) && is_string( $_db ) ) {
						saxue_getconfigs( 'dbset' );
						$this -> db = &saxuedatabase :: getinstance( $saxueDbset[$_db] );
				} else {
						$this -> db = &$_db;
				} 
		} 

		function setdb( $_db ) {
				$this -> db = &$_db;
		} 

		function getdb() {
				return $this -> db;
		} 

		function execute( $_criteria = null, $_render = false, $_unbuffered = false ) {
				if ( is_object( $_criteria ) ) {
						$_sql = $_criteria -> getsql();
						if ( !$_render ) {
								$_sql .= " " . $_criteria -> renderwhere();
						} 
						$this -> sqlres = $this -> db -> query( $_sql, 0, 0, $_unbuffered );
						return $this -> sqlres;
				} 
				if ( !empty( $_criteria ) ) {
						$this -> sqlres = $this -> db -> query( $_criteria, 0, 0, $_unbuffered );
						return $this -> sqlres;
				} 
				return false;
		} 

		function queryobjects( $_criteria = null, $_unbuffered = false ) {
				$_limit = $_start = 0;
				$_sql = "SELECT " . $_criteria -> getfields() . " FROM " . $_criteria -> gettables() . " " . $_criteria -> renderwhere();
				if ( $_criteria -> getgroupby() != "" ) {
						$_sql .= " GROUP BY " . $_criteria -> getgroupby();
				} 
				if ( $_criteria -> getsort() != "" ) {
						$_sql .= " ORDER BY " . $_criteria -> getsort() . " " . $_criteria -> getorder();
				} 
				$_limit = $_criteria -> getlimit();
				$_start = $_criteria -> getstart();
				$this -> sqlres = $this -> db -> query( $_sql, $_limit, $_start, $_unbuffered );
				return $this -> sqlres;
		} 

		function getobject( $_result = "" ) {
				if ( $_result == "" ) {
						$_result = $this -> sqlres;
				} 
				if ( !$_result ) {
						return false;
				} 
				$_row = $this -> db -> fetcharray( $_result );
				if ( !$_row ) {
						return false;
				} 
				$_dbrowobj = new saxueobjectdata();
				$_dbrowobj -> setvars( $_row );
				return $_dbrowobj;
		} 

		function getrow( $_result = "" ) {
				if ( $_result == "" ) {
						$_result = $this -> sqlres;
				} 
				if ( !$_result ) {
						return false;
				} 
				$_row = $this -> db -> fetcharray( $_result );
				if ( !$_row ) {
						return false;
				} 
				return $_row;
		} 

		function getcount( $_criteria = null ) {
				if ( is_object( $_criteria ) ) {
						if ( $_criteria -> getgroupby() == "" ) {
								$_sql = "SELECT COUNT(*) FROM " . $_criteria -> gettables() . " " . $_criteria -> renderwhere();
								$_unbuffered = true;
						} else {
								$_sql = "SELECT COUNT(" . $_criteria -> getgroupby() . ") FROM " . $_criteria -> gettables() . " " . $_criteria -> renderwhere() . " GROUP BY " . $_criteria -> getgroupby();
								$_unbuffered = false;
						} 
						$_result = $this -> db -> query( $_sql, 0, 0, $_unbuffered );
						if ( !$_result ) {
								return 0;
						} 
						if ( $_criteria -> getgroupby() == "" ) {
								list( $_count ) = $this -> db -> fetchrow( $_result );
								return $_count;
						} 
						$_count = $this -> db -> getrowsnum( $_result );
						return $_count;
				} 
				return 0;
		} 

		function getsum( $_field = '', $_criteria = null ) {
				if ( empty( $_field ) ) return 0;
				if ( is_object( $_criteria ) ) {
						$_sql = "SELECT SUM(" . $_field . ") AS sum FROM " . $_criteria -> gettables() . " " . $_criteria -> renderwhere();
						$_unbuffered = true;
						$_result = $this -> db -> query( $_sql, 0, 0, $_unbuffered );
						if ( !$_result ) {
								return 0;
						} 
						list( $_sum ) = $this -> db -> fetchrow( $_result );
						return $_sum;
				} 
		} 

		function updatefields( $_tablename, $_fields, $_criteria = null ) {
				$_sql = "UPDATE " . $_tablename . " SET ";
				$_start = true;
				if ( is_array( $_fields ) ) {
						foreach ( $_fields as $_k => $_v ) {
								if ( !$_start ) {
										$_sql .= ", ";
								} else {
										$_start = false;
								} 
								if ( is_numeric( $_v ) ) {
										$_sql .= $_k . "=" . $this -> db -> quotestring( $_v );
								} else {
										$_sql .= $_k . "=" . $this -> db -> quotestring( $_v );
								} 
						} 
				} else {
						$_sql .= $_fields;
				} 
				if ( isset( $_criteria ) && !is_object( $_criteria ) ) {
						$_sql .= " WHERE " . $_criteria;
				} elseif ( isset( $_criteria ) && is_subclass_of( $_criteria, "criteriaelement" ) ) {
						$_sql .= " " . $_criteria -> renderwhere();
				} 
				if ( !( $_result = $this -> db -> query( $_sql ) ) ) {
						return false;
				} 
				return true;
		} 
} 

class saxueobjecthandler extends saxuequeryhandler {
		var $basename;
		var $autoid;
		var $dbname;
		var $fullname = false;

		function saxueobjecthandler( $_db = "" ) {
				$this -> saxuequeryhandler( $_db );
		} 

		function create( $isNew = true, $data = '' ) {
				$tmpvar = "Saxue" . ucfirst( $this -> basename );
				${$this->basename} = new $tmpvar();
				if ( $isNew ) {
						${$this->basename} -> setnew();
				} 
				if ( false !== $data ){
						if ( empty( $data ) ) {
								$data = $_POST;
						} elseif ( is_object( $data ) ) {
								$data = get_object_vars( $data );
						} 
						foreach( ${$this->basename} -> vars as $key => $val ) {
								if ( isset ( $data[$key] ) ) {
										${$this->basename} -> setvar( $key, $data[$key] );
								} 
						} 
				}
				return ${$this->basename};
		} 

		function get( $id ) {
				if ( is_numeric( $id ) && 0 < intval( $id ) ) {
						$id = intval( $id );
						$sql = "SELECT * FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname ) . " WHERE " . $this -> autoid . "=" . $id;
						if ( !( $result = $this -> db -> query( $sql, 1, 0, true ) ) ) {
								return false;
						} 
						$datarow = $this -> db -> fetcharray( $result );
						if ( is_array( $datarow ) ) {
								$tmpvar = "Saxue" . ucfirst( $this -> basename );
								${$this->basename} = new $tmpvar();
								${$this->basename} -> setvars( $datarow );
								return ${$this->basename};
						} 
				} 
				return false;
		} 

		function insert( &$baseobj ) {
				if ( strcasecmp( get_class( $baseobj ), "saxue" . $this -> basename ) != 0 ) {
						return false;
				} 
				if ( $baseobj -> isnew() ) {
						if ( is_numeric( $baseobj -> getvar( $this -> autoid, "n" ) ) ) {
								${$this->autoid} = intval( $baseobj -> getvar( $this -> autoid, "n" ) );
						} else {
								${$this->autoid} = $this -> db -> genid( $this -> dbname . "_" . $this -> autoid . "_seq" );
						} 
						$sql = "INSERT INTO " . saxue_dbprefix( $this -> dbname, $this -> fullname ) . " (";
						$values = ") VALUES (";
						$start = true;
						foreach ( $baseobj -> vars as $k => $v ) {
								if ( !$start ) {
										$sql .= ", ";
										$values .= ", ";
								} else {
										$start = false;
								} 
								$sql .= $k;
								if ( $v['type'] == SAXUE_TYPE_INT ) {
										if ( $k != $this -> autoid ) {
												if ( !is_numeric( $v['value'] ) ) {
														$v['value'] = @intval( $v['value'] );
												} 
												$values .= $this -> db -> quotestring( $v['value'] );
										} else {
												$values .= ${$this->autoid};
										} 
								} else {
										$values .= $this -> db -> quotestring( $v['value'] );
								} 
						} 
						$sql .= $values . ")";
						unset( $values );
				} else {
						$sql = "UPDATE " . saxue_dbprefix( $this -> dbname, $this -> fullname ) . " SET ";
						$start = true;
						foreach ( $baseobj -> vars as $k => $v ) {
								if ( $k != $this -> autoid && $v['isdirty'] ) {
										if ( !$start ) {
												$sql .= ", ";
										} else {
												$start = false;
										} 
										if ( $v['type'] == SAXUE_TYPE_INT ) {
												if ( !is_numeric( $v['value'] ) ) {
														$v['value'] = @intval( $v['value'] );
												} 
												$sql .= $k . "=" . $this -> db -> quotestring( $v['value'] );
										} else {
												$sql .= $k . "=" . $this -> db -> quotestring( $v['value'] );
										} 
								} 
						} 
						if ( $start ) {
								return true;
						} 
						$sql .= " WHERE " . $this -> autoid . "=" . intval( $baseobj -> vars[$this -> autoid]['value'] );
				} 
				$result = $this -> db -> query( $sql );
				if ( !$result ) {
						return false;
				} 
				if ( $baseobj -> isnew() ) {
						$baseobj -> setvar( $this -> autoid, $this -> db -> getinsertid() );
				} 
				return true;
		} 

		function delete( $_criteria = 0 ) {
				$_sql = "";
				if ( is_numeric( $_criteria ) ) {
						$_criteria = intval( $_criteria );
						$_sql = "DELETE FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname ) . " WHERE " . $this -> autoid . "=" . $_criteria;
				} else if ( is_object( $_criteria ) && is_subclass_of( $_criteria, "criteriaelement" ) ) {
						$_tmpstr = $_criteria -> renderwhere();
						if ( !empty( $_tmpstr ) ) {
								$_sql = "DELETE FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname ) . " " . $_tmpstr;
						} 
				} else {
						$_sql = "DELETE FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname ) . " WHERE " . $_criteria;
				}
				if ( empty( $_sql ) ) {
						return false;
				} 
				$_result = $this -> db -> query( $_sql );
				if ( !$_result ) {
						return false;
				} 
				return true;
		} 

		function queryobjects( $_criteria = null, $_unbuffered = false ) {
				$_limit = $_start = 0;
				if ( is_null( $_criteria ) ) {
						$_sql = "SELECT * FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname );
				} else {
						$_sql = "SELECT " . $_criteria -> getfields() . " FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname );
				}
				if ( isset( $_criteria ) && is_subclass_of( $_criteria, "criteriaelement" ) ) {
						$_sql .= " " . $_criteria -> renderwhere();
						if ( $_criteria -> getgroupby() != "" ) {
								$_sql .= " GROUP BY " . $_criteria -> getgroupby();
						} 
						if ( $_criteria -> getsort() != "" ) {
								$_sql .= " ORDER BY " . $_criteria -> getsort() . " " . $_criteria -> getorder();
						} 
						$_limit = $_criteria -> getlimit();
						$_start = $_criteria -> getstart();
				} 
				$this -> sqlres = $this -> db -> query( $_sql, $_limit, $_start, $_unbuffered );
				return $this -> sqlres;
		} 

		function getobject( $_result = "" ) {
				if ( $_result == "" ) {
						$_result = $this -> sqlres;
				} 
				if ( !$_result ) {
						return false;
				} 
				$_tmpval = "Saxue" . ucfirst( $this -> basename );
				$_row = $this -> db -> fetcharray( $_result );
				if ( !$_row ) {
						return false;
				} 
				$_dbrowobj = new $_tmpval();
				$_dbrowobj -> setvars( $_row );
				return $_dbrowobj;
		} 

		function getcount( $_criteria = null ) {
				$_sql = "SELECT COUNT(*) FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname );
				$_unbuffered = true;
				if ( isset( $_criteria ) && is_subclass_of( $_criteria, "criteriaelement" ) ) {
						$_sql .= " " . $_criteria -> renderwhere();
						if ( $_criteria -> getgroupby() != "" ) {
								$_sql = "SELECT COUNT(" . $_criteria -> getgroupby() . ") FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname ) . " " . $_criteria -> renderwhere() . " GROUP BY " . $_criteria -> getgroupby();
								$_unbuffered = false;
						} 
				} 
				$_result = $this -> db -> query( $_sql, 0, 0, $_unbuffered );
				if ( !$_result ) {
						return 0;
				} 
				if ( isset( $_criteria ) && is_subclass_of( $_criteria, "criteriaelement" ) && $_criteria -> getgroupby() != "" ) {
						$_count = $this -> db -> getrowsnum( $_result );
						return $_count;
				} 
				list( $_count ) = $this -> db -> fetchrow( $_result );
				return $_count;
		} 

		function getsum( $_field = '', $_criteria = null ) {
				if ( empty( $_field ) ) return 0;
				$_sql = "SELECT SUM(". $_field .") sum FROM " . saxue_dbprefix( $this -> dbname, $this -> fullname );
				$_unbuffered = true;
				if ( isset( $_criteria ) && is_subclass_of( $_criteria, "criteriaelement" ) ) {
						$_sql .= " " . $_criteria -> renderwhere();
				} 
				$_result = $this -> db -> query( $_sql, 0, 0, $_unbuffered );
				if ( !$_result ) {
						return 0;
				} 
				list( $_sum ) = $this -> db -> fetchrow( $_result );
				return $_sum;
		} 

		function updatefields( $_fields, $_criteria = null ) {
				$_sql = "UPDATE " . saxue_dbprefix( $this -> dbname, $this -> fullname ) . " SET ";
				$_start = true;
				if ( is_array( $_fields ) ) {
						foreach ( $_fields as $_k => $_v ) {
								if ( !$_start ) {
										$_sql .= ", ";
								} else {
										$_start = false;
								} 
								if ( is_numeric( $_v ) ) {
										$_sql .= $_k . "=" . $this -> db -> quotestring( $_v );
								} else {
										$_sql .= $_k . "=" . $this -> db -> quotestring( $_v );
								} 
						} 
				} else {
						$_sql .= $_fields;
				} 
				if ( isset( $_criteria ) && !is_object( $_criteria ) ) {
						$_sql .= " WHERE " . $_criteria;
				} elseif ( isset( $_criteria ) && is_subclass_of( $_criteria, "criteriaelement" ) ) {
						$_sql .= " " . $_criteria -> renderwhere();
				} 
				if ( !( $_result = $this -> db -> query( $_sql ) ) ) {
						return false;
				} 
				return true;
		} 
} 

class criteriaelement extends saxueobject {
		var $order = "ASC";
		var $sort = "";
		var $limit = 0;
		var $start = 0;
		var $groupby = "";
		var $sql = "";
		var $fields = "*";
		var $tables = "";

		function criteriaelement() {
				$this -> saxueobject();
		} 

		function setsql( $_sql ) {
				$this -> sql = $_sql;
		} 

		function getsql() {
				return $this -> sql;
		} 

		function setfields( $_fields ) {
				$this -> fields = $_fields;
		} 

		function getfields() {
				return $this -> fields;
		} 

		function settables( $_tables ) {
				$this -> tables = $_tables;
		} 

		function gettables() {
				return $this -> tables;
		} 

		function setsort( $_sort ) {
				$this -> sort = $_sort;
		} 

		function getsort() {
				return $this -> sort;
		} 

		function setorder( $_order ) {
				if ( "DESC" == strtoupper( $_order ) ) {
						$this -> order = "DESC";
				} 
		} 

		function getorder() {
				return $this -> order;
		} 

		function setlimit( $_limit = 0 ) {
				if ( isset( $_limit ) && is_numeric( $_limit ) ) {
						$this -> limit = intval( $_limit );
				} else {
						$this -> limit = 1;
				} 
		} 

		function getlimit() {
				return $this -> limit;
		} 

		function setstart( $_start = 0 ) {
				$this -> start = intval( $_start );
		} 

		function getstart() {
				return $this -> start;
		} 

		function setgroupby( $_groupby ) {
				$this -> groupby = $_groupby;
		} 

		function getgroupby() {
				return $this -> groupby;
		} 
} 

class criteriacompo extends criteriaelement {
		var $criteriaElements = array();
		var $conditions = array();

		function criteriacompo( $_ele = null, $_condition = "AND" ) {
				if ( isset( $_ele ) && is_object( $_ele ) ) {
						$this -> add( $_ele, $_condition );
				} 
		} 

		function add( &$_criteriaElement, $_condition = "AND" ) {
				$this -> criteriaElements[] = &$_criteriaElement;
				$this -> conditions[] = $_condition;
				return $this;
		} 

		function render() {
				$_ret = "";
				$_count = count( $this -> criteriaElements );
				if ( 0 < $_count ) {
						$_ret = "(" . $this -> criteriaElements[0] -> render();
						for ( $_i = 1; $_i < $_count; ++$_i ) {
								$_ret .= " " . $this -> conditions[$_i] . " " . $this -> criteriaElements[$_i] -> render();
						} 
						$_ret .= ")";
				} 
				return $_ret;
		} 

		function renderwhere() {
				$_ret = $this -> render();
				$_ret = $_ret != "" ? "WHERE " . $_ret : $_ret;
				return $_ret;
		} 
} 

class criteria extends criteriaelement {
		var $column;
		var $operator;
		var $value;

		function criteria( $_column, $_value = "", $_operator = "=" ) {
				$this -> column = $_column;
				$this -> value = $_value;
				$this -> operator = $_operator;
		} 

		function render() {
				if ( !empty( $this -> column ) ) {
						$_renderstr = $this -> column . " " . $this -> operator;
				} else {
						$_renderstr = "";
				} 
				if ( isset( $this -> value ) ) {
						if ( $this -> column == "" && $this -> operator == "" ) {
								$_renderstr .= " " . trim( $this -> value );
								return $_renderstr;
						} 
						if ( strtoupper( $this -> operator ) == "IN" ) {
								$_renderstr .= " " . $this -> value;
								return $_renderstr;
						} 
						$_renderstr .= " '" . saxue_dbslashes( trim( $this -> value ) ) . "'";
				} 
				return $_renderstr;
		} 

		function renderwhere() {
				$_ret = $this -> render();
				$_ret = $_ret != "" ? "WHERE " . $_ret : $_ret;
				return $_ret;
		} 
} 
