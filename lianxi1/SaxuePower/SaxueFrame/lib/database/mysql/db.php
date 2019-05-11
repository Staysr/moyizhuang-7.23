<?php
class saxuemysqldatabase extends saxueobject {
		var $conn;
		var $conn_m;
		var $conn_s;
		var $dbset;
		var $hosts;
		var $hnum;

		function saxuemysqldatabase( $_db = "" ) {
				$this -> saxueobject();
		} 

		function setdbset( $_dbset ) {
				$this -> dbset = $_dbset;
				$_hosts = explode( ",", $_dbset['dbhost'] );
				$this -> hnum = count( $_hosts );
				if ( 1 < $this -> hnum ) {
						$_dbusers = explode( ",", $_dbset['dbuser'] );
						$_dbpasses = explode( ",", $_dbset['dbpass'] );
						$_dbnames = explode( ",", $_dbset['dbname'] );
						$this -> hosts = array();
						foreach ( $_hosts as $_k => $_v ) {
								$this -> hosts[$_k]['dbhost'] = $_v;
								$this -> hosts[$_k]['dbuser'] = isset( $_dbusers[$_k] ) ? $_dbusers[$_k] : $_dbusers[0];
								$this -> hosts[$_k]['dbpass'] = isset( $_dbpasses[$_k] ) ? $_dbpasses[$_k] : $_dbpasses[0];
								$this -> hosts[$_k]['dbname'] = isset( $_dbnames[$_k] ) ? $_dbnames[$_k] : $_dbnames[0];
						} 
				} else {
						$this -> hosts = array();
						$this -> hosts[0] = array( "dbhost" => $this -> dbset['dbhost'],
								"dbuser" => $this -> dbset['dbuser'],
								"dbpass" => $this -> dbset['dbpass'],
								"dbname" => $this -> dbset['dbname'] 
								);
				} 
				if ( !empty( $this -> dbset['dbusage'] ) || !isset( $this -> hosts[$this -> dbset['dbusage'] - 1] ) ) {
						$this -> dbset['dbusage'] = 1;
				} 
				return true;
		} 

		function connect( $_multidb = false ) {
				if ( empty( $this -> dbset['dbusage'] ) ) {
						if ( $_multidb ) {
								$_dbnum = 0;
						} else {
								$_dbnum = -1;
						} 
				} else {
						$_dbnum = $this -> dbset['dbusage'] - 1;
						if ( $_dbnum == 0 ) {
								$_multidb = true;
						} 
				} 
				if ( $_multidb && is_resource( $this -> conn_m ) ) {
						$this -> conn = &$this -> conn_m;
						return true;
				} 
				if ( !$_multidb || is_resource( $this -> conn_s ) ) {
						$this -> conn = &$this -> conn_s;
						return true;
				} 
				if ( $_dbnum == -1 ) {
						$_dbnum = mt_rand( 0, $this -> hnum - 1 );
				} 
				if ( $this -> dbset['dbpconnect'] == 1 ) {
						if ( $_multidb ) {
								$this -> conn_m = @mysql_pconnect( $this -> hosts[$_dbnum]['dbhost'], $this -> hosts[$_dbnum]['dbuser'], $this -> hosts[$_dbnum]['dbpass'] );
								$this -> conn = &$this -> conn_m;
						} else {
								$this -> conn_s = @mysql_pconnect( $this -> hosts[$_dbnum]['dbhost'], $this -> hosts[$_dbnum]['dbuser'], $this -> hosts[$_dbnum]['dbpass'] );
								$this -> conn = &$this -> conn_s;
						} 
				} else if ( $_multidb ) {
						$this -> conn_m = @mysql_connect( $this -> hosts[$_dbnum]['dbhost'], $this -> hosts[$_dbnum]['dbuser'], $this -> hosts[$_dbnum]['dbpass'] );
						$this -> conn = &$this -> conn_m;
				} else {
						$this -> conn_s = @mysql_connect( $this -> hosts[$_dbnum]['dbhost'], $this -> hosts[$_dbnum]['dbuser'], $this -> hosts[$_dbnum]['dbpass'] );
						$this -> conn = &$this -> conn_s;
				} 
				if ( !$this -> conn ) {
						saxue_printfail( "Can not connect to database!<br /><br />error: " . mysql_error(), 0 );
				} 
				$this -> connectcharset();
				if ( 0 < strlen( $this -> hosts[$_dbnum]['dbname'] ) && !mysql_select_db( $this -> hosts[$_dbnum]['dbname'], $this -> conn ) ) {
						saxue_printfail( "Can not select database!<br /><br />error: " . mysql_error(), 0 );
				} 
				if ( !defined( "SAXUE_DB_CONNECTED" ) ) {
						@define( "SAXUE_DB_CONNECTED", true );
				} 
				return true;
		} 

		function reconnect() {
				if ( !mysql_ping( $this -> conn ) ) {
						$this -> close();
						return $this -> connect();
				} 
				$this -> connectcharset();
				return true;
		} 

		function connectcharset() {
				$_mysql_version = mysql_get_server_info();
				if ( "4.1" < $_mysql_version ) {
						if ( isset( $this -> dbset['dbcharset'] ) ) {
								if ( $this -> dbset['dbcharset'] != "default" ) {
										@mysql_query( "SET character_set_connection=" . $this -> dbset['dbcharset'] . ", character_set_results=" . $this -> dbset['dbcharset'] . ", character_set_client=binary", $this -> conn );
								} 
						} else {
								@mysql_query( "SET character_set_connection=" . SAXUE_SYSTEM_CHARSET . ", character_set_results=" . SAXUE_SYSTEM_CHARSET . ", character_set_client=binary", $this -> conn );
						} 
				} 
				if ( "5.0" < $_mysql_version ) {
						@mysql_query( "SET sql_mode=''", $this -> conn );
				} 
		} 

		function genid( $_genid = "" ) {
				return 0;
		} 

		function fetchrow( $_result ) {
				return mysql_fetch_row( $_result );
		} 

		function fetcharray( $_result ) {
				return mysql_fetch_array( $_result, MYSQL_ASSOC );
		} 

		function getinsertid() {
				return mysql_insert_id( $this -> conn );
		} 

		function getrowsnum( $_result ) {
				return mysql_num_rows( $_result );
		} 

		function getaffectedrows() {
				return mysql_affected_rows( $this -> conn );
		} 

		function close() {
				@mysql_close( $this -> conn );
		} 

		function freerecordset( $_result ) {
				return mysql_free_result( $_result );
		} 

		function error() {
				return mysql_error();
		} 

		function errno() {
				return mysql_errno();
		} 

		function quotestring( $_str ) {
				return "'" . saxue_dbslashes( $_str ) . "'";
		} 

		function sqllog( $_op = "add", $_sql = "" ) {
				static $sqllog = array();
				switch ( $_op ) {
						case "add" :
								if ( empty( $_sql ) ) {
										break;
								} 
								$sqllog[] = $_sql;
								break;
						case "ret" :
								return $sqllog;
						case "count" :
								return count( $sqllog );
						case "show" :
								echo "<br />queries: " . count( $sqllog );
								foreach ( $sqllog as $_sql ) {
										echo "<br />" . saxue_htmlstr( $_sql );
								} 
				} 
		} 

		function query( $_sql, $_limit = 0, $_start = 0, $_unbuffered = false ) {
				if ( !empty( $this -> dbset['dbusage'] ) ) {
						$this -> connect();
				} else if ( strtoupper( substr( ltrim( $_sql ), 0, 6 ) ) == "SELECT" ) {
						$this -> connect( false );
				} else {
						$this -> connect( true );
				} 
				if ( !empty( $_limit ) ) {
						if ( empty( $_start ) ) {
								$_start = 0;
						} 
						$_sql .= " LIMIT " . ( integer )$_start . ", " . ( integer )$_limit;
				} 
				if ( defined( "SAXUE_DEBUG_MODE" ) && 0 < SAXUE_DEBUG_MODE ) {
						$this -> sqllog( "add", $_sql );
				} 
				if ( $_unbuffered ) {
						$_result = mysql_unbuffered_query( $_sql, $this -> conn );
				} else {
						$_result = mysql_query( $_sql, $this -> conn );
				} 
				if ( $_result ) {
						return $_result;
				} 
				$_errno = mysql_errno( $this -> conn );
				if ( $_errno == 2013 || $_errno == 2006 ) {
						$this -> reconnect();
						if ( $_unbuffered ) {
								$_result = mysql_unbuffered_query( $_sql, $this -> conn );
						} else {
								$_result = mysql_query( $_sql, $this -> conn );
						} 
						if ( $_result ) {
								return $_result;
						} 
				} 
				if ( defined( "SAXUE_DEBUG_MODE" ) && 0 < SAXUE_DEBUG_MODE ) {
						saxue_printfail( "SQL: " . saxue_htmlstr( $_sql ) . "<br /><br />ERROR: " . mysql_error( $this -> conn ) . "(" . mysql_errno( $this -> conn ) . ")", 0 );
				} 
				return false;
		} 
} 
