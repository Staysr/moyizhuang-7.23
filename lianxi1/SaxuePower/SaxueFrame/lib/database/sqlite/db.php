<?php
class saxuesqlitedatabase extends saxueobject {
		var $conn;

		function saxuesqlitedatabase( $_db = "" ) {
				$this -> saxueobject();
		} 

		function connect( $_sqlite_host = "", $_sqlite_user = "", $_sqlite_pass = "", $_sqlite_db = "", $_sqlite_multi = true ) {
				if ( SAXUE_DB_PCONNECT == 1 ) {
						$this -> conn = @sqlite_open( $_sqlite_db, 438, $_sqlite_error );
				} else {
						$this -> conn = @sqlite_popen( $_sqlite_db, 438, $_sqlite_error );
				} 
				if ( !$this -> conn ) {
						return false;
				} 
				return true;
		} 

		function genid( $_genid = "" ) {
				return 0;
		} 

		function fetchrow( $_result ) {
				return sqlite_fetch_array( $_result, SQLITE_NUM );
		} 

		function fetcharray( $_result ) {
				return sqlite_fetch_array( $_result, SQLITE_ASSOC );
		} 

		function getinsertid() {
				return sqlite_last_insert_rowid( $this -> conn );
		} 

		function getrowsnum( $_result ) {
				return sqlite_num_rows( $_result );
		} 

		function getaffectedrows() {
				return sqlite_changes( $this -> conn );
		} 

		function close() {
				@sqlite_close( $this -> conn );
		} 

		function freerecordset( $_result ) {
				return true;
		} 

		function error() {
				$_errno = @sqlite_last_error( $this -> conn );
				if ( !empty( $_errno ) ) {
						return sqlite_error_string( $_errno );
				} 
				return "";
		} 

		function errno() {
				return sqlite_last_error( $this -> conn );
		} 

		function quotestring( $_str ) {
				return "'" . saxue_dbslashes( $_str ) . "'";
		} 

		function query( $_sql, $_limit = 0, $_start = 0, $_unbuffered = false ) {
				if ( !empty( $_limit ) ) {
						if ( empty( $_start ) ) {
								$_start = 0;
						} 
						$_sql = $_sql . " LIMIT " . ( integer )$_start . ", " . ( integer )$_limit;
				} 
				$_sql = str_replace( array( "\\'", "\\\"", "\\\\" ), array( "''", "\"", "\\" ), $_sql );
				if ( $_unbuffered ) {
						$_result = sqlite_unbuffered_query( $_sql, $this -> conn );
				} else {
						$_result = sqlite_query( $_sql, $this -> conn );
				} 
				if ( $_result ) {
						if ( !$_result ) {
								$this -> raiseerror( "SQL: " . $_sql, SAXUE_ERROR_RETURN );
						} 
						return $_result;
				} 
				$this -> raiseerror( "SQL: " . $_sql, SAXUE_ERROR_RETURN );
				return false;
		} 

		function list_tables() {
				if ( function_exists( "sqlite_list_tables" ) ) {
						return sqlite_list_tables();
				} 
				$_tables = array();
				$_sql = "SELECT name FROM sqlite_master WHERE (type = 'table')";
				while ( ( $_ret = sqlite_query( $this -> conn, $_sql ) ) && sqlite_has_more( $_ret ) ) {
						$_tables[] = sqlite_fetch_single( $_ret );
				} 
				return $_tables;
		} 

		function table_exists( $_tablename ) {
				if ( function_exists( "sqlite_table_exists" ) ) {
						return sqlite_table_exists( $this -> conn, $_tablename );
				} 
				$_sql = "SELECT count(name) FROM sqlite_master WHERE ((type = 'table') and (name = '" . $_tablename . "'))";
				if ( $_ret = sqlite_query( $this -> conn, $_sql ) ) {
						return 0 < sqlite_fetch_single( $_ret );
				} 
				return false;
		} 
} 
