<?php
function saxue_splitsqlfile( &$_ret, $_sql, $_volume = 32270 ) {
		$_sql = rtrim( $_sql, "\n\r" );
		$_sql_len = strlen( $_sql );
		$_char = "";
		$_string_start = "";
		$_in_string = false;
		$_i = 0;
		for ( ; $_i < $_sql_len; ++$_i ) {
				$_char = $_sql[$_i];
				if ( $_in_string ) {
						do {
								$_i = strpos( $_sql, $_string_start, $_i );
								if ( !$_i ) {
										$_ret[] = $_sql;
										return true;
								} elseif ( $_string_start == "`" || $_sql[$_i - 1] != "\\" ) {
										$_string_start = "";
										$_in_string = false;
										break;
								} else {
										$_j = 2;
										$_escaped_backslash = false;
										while ( 0 < $_i - $_j && $_sql[$_i - $_j] == "\\" ) {
												$_escaped_backslash = !$_escaped_backslash;
												++$_j;
										} 
										if ( $_escaped_backslash ) {
												$_string_start = "";
												$_in_string = false;
												break;
										} else {
												++$_i;
										} 
								} 
						} while ( 1 );
				} elseif ( $_char == ";" ) {
						$_ret[] = substr( $_sql, 0, $_i );
						$_sql = ltrim( substr( $_sql, min( $_i + 1, $_sql_len ) ) );
						$_sql_len = strlen( $_sql );
						if ( $_sql_len ) {
								$_i = -1;
						} else {
								return true;
						} 
				} elseif ( $_char == "\"" || $_char == "'" || $_char == "`" ) {
						$_in_string = true;
						$_string_start = $_char;
				} else if ( $_char == "#" || ( $_char == "-" && 0 < $_i && $_sql[$_i - 1] == "-" ) ) {
						$_start_of_comment = $_sql[$_i] == "#" ? $_i : $_i - 1;
						$_end_of_comment = strpos( " " . $_sql, "\n", $_i + 1 ) ? strpos( " " . $_sql, "\n", $_i + 1 ) : strpos( " " . $_sql, "\r", $_i + 1 );
						if ( !$_end_of_comment ) {
								if ( 0 < $_start_of_comment ) {
										$_ret[] = trim( substr( $_sql, 0, $_start_of_comment ) );
								} 
								return true;
						} else {
								$_sql = substr( $_sql, 0, $_start_of_comment ) . ltrim( substr( $_sql, $_end_of_comment ) );
								$_sql_len = strlen( $_sql );
								--$_i;
						} 
				} else if ( $_char == "!" && 1 < $_i && $_sql[$_i - 2] . $_sql[$_i - 1] == "/*" ) {
						$_start_of_comment = $_i-2;
						$_end_of_comment = strpos( " " . $_sql, "\n", $_i + 1 ) ? strpos( " " . $_sql, "\n", $_i + 1 ) : strpos( " " . $_sql, "\r", $_i + 1 );
						if ( !$_end_of_comment ) {
								if ( 0 < $_start_of_comment ) {
										$_ret[] = trim( substr( $_sql, 0, $_start_of_comment ) );
								} 
								return true;
						} else {
								$_sql = substr( $_sql, 0, $_start_of_comment ) . ltrim( substr( $_sql, $_end_of_comment ) );
								$_sql_len = strlen( $_sql );
								$_i -= 2;
						} 
						// $_sql[$_i] = " ";
				} 
		} 
		if ( !empty( $_sql ) && ereg( "[^[:space:]]+", $_sql ) ) {
				$_ret[] = $_sql;
		} 
		return true;
} 

if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'dbquery' );
if ( empty( $_SESSION['saxueDbLogin'] ) ) {
		header( "Location: " . SAXUE_ADMIN_URL . "/dblogin.php?jumpurl=".urlencode( saxue_addurlvars( array( ) ) ) );
		exit( );
}
@set_time_limit( 3600 );
@session_write_close();
saxue_loadlang( "database", SAXUE_MODULE_NAME );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
if ( $_POST['action'] == "execute" ) {
		if ( !isset( $_POST['action'], $_POST['sqldata'] ) ) {
				saxue_printfail( $saxueLang['database']['need_sql_data'], 0 );
		} else if ( preg_match( "/(into\\s+outfile|load_file\\s*\\([^\\)]*\\)|load\\s+data)/is", $_POST['sqldata'] ) ) {
				saxue_printfail( $saxueLang['database']['deny_sql_data'], 0 );
		} 
		saxue_includedb();
		$db_query = saxuequeryhandler :: getinstance( "SaxueQueryHandler" );
		saxue_splitsqlfile( $sqlary, str_replace( " saxue_", " " . SAXUE_DB_PREFIX . "_", $_POST['sqldata'] ) );
		$sqlerr = array();
		foreach ( $sqlary as $v ) {
				$v = trim( $v );
				if ( empty( $v ) || !( 5 < strlen( $v ) ) ) {
						continue;
				} 
				$retflag = $db_query -> execute( $v );
				if ( $retflag ) {
						continue;
				} 
				$sqlerr[] = array( "sql" => $v,
						"error" => $db_query -> db -> error() 
						);
				if ( !$_POST['errorstop'] ) {
						continue;
				} 
				saxue_printfail( sprintf( $saxueLang['database']['print_sql_error'], saxue_htmlstr( $v ), saxue_htmlstr( $db_query -> db -> error() ) ), 0 );
				break;
		} 
		if ( !empty( $sqlerr ) && $_POST['showerror'] ) {
				$errorinfo = "";
				foreach ( $sqlerr as $v ) {
						$errorinfo .= sprintf( $saxueLang['database']['show_error_format'], saxue_htmlstr( $v['sql'] ), saxue_htmlstr( $v['error'] ) );
				} 
				saxue_msgwin( LANG_DO_SUCCESS, sprintf( $saxueLang['database']['sql_some_error'], $errorinfo ), 0 );
		} else {
				saxue_msgwin( LANG_DO_SUCCESS, $saxueLang['database']['execute_sql_success'], 0 );
		} 
} else {
		$saxueTpl -> setcaching( 0 );
		$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/dbquery.html";
} 
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
