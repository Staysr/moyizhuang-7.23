<?php
function saxue_fetchtablelist( $_tablepre = "" ) {
		global $query_handler;
		$_arr = explode( ".", $_tablepre );
		$_dbname = !empty( $_arr[1] ) ? $_arr[0] : "";
		$_dbfrom = $_dbname ? " FROM " . $_dbname . " LIKE '{$_arr['1']}%'" : "LIKE '" . $_tablepre . "%'";
		if ( !$_tablepre ) {
				$_tablepre = "*";
		} 
		$_tables = $_table = array();
		$_query = $query_handler -> db -> query( "SHOW TABLE STATUS " . $_dbfrom );
		while ( $_table = $query_handler -> db -> fetcharray( $_query ) ) {
				$_table['Name'] = ( $_dbname ? "{$_dbname}." : "" ) . $_table['Name'];
				$_tables[] = $_table;
		} 
		return $_tables;
} 

function saxue_syntablestruct( $_sql, $_version, $_dbcharset ) {
		if ( strpos( trim( substr( $_sql, 0, 18 ) ), "CREATE TABLE" ) === false ) {
				return $_sql;
		} 
		$_sqlversion = strpos( $_sql, "ENGINE=" ) === false ? false : true;
		if ( $_sqlversion === $_version ) {
				if ( $_sqlversion && $_dbcharset ) {
						return preg_replace( array( "/ character set \\w+/i",
										"/ collate \\w+/i",
										"/DEFAULT CHARSET=\\w+/is" 
										), array( "",
										"",
										"DEFAULT CHARSET=" . $_dbcharset 
										), $_sql );
				} 
				return $_sql;
		} 
		if ( $_version ) {
				return preg_replace( array( "/TYPE=HEAP/i",
								"/TYPE=(\\w+)/is" 
								), array( "ENGINE=MEMORY DEFAULT CHARSET=" . $_dbcharset,
								"ENGINE=\\1 DEFAULT CHARSET=" . $_dbcharset 
								), $_sql );
		} 
		return preg_replace( array( "/character set \\w+/i", "/collate \\w+/i", "/ENGINE=MEMORY/i", "/\\s*DEFAULT CHARSET=\\w+/is", "/\\s*COLLATE=\\w+/is", "/ENGINE=(\\w+)(.*)/is" ), array( "", "", "ENGINE=HEAP", "", "", "TYPE=\\1\\2" ), $_sql );
} 

function saxue_sqldumptable( $_table, $_startfrom = 0, $_currsize = 0 ) {
		global $query_handler;
		global $sizelimit;
		global $startrow;
		global $extendins;
		global $sqlcompat;
		global $sqlcharset;
		global $dumpcharset;
		global $usehex;
		global $complete;
		$_offset = 300;
		$_tabledump = "";
		$_tablefields = array();
		$_query = $query_handler -> db -> query( "SHOW FULL COLUMNS FROM " . $_table );
		if ( !$_query ) {
				$usehex = false;
		} else {
				while ( $_rs = $query_handler -> db -> fetcharray( $_query ) ) {
						$_tablefields[] = $_rs;
				} 
		} 
		if ( !$_startfrom ) {
				$_createtable = $query_handler -> db -> query( "SHOW CREATE TABLE " . $_table );
				if ( $_createtable ) {
						$_tabledump = "DROP TABLE IF EXISTS `" . $_table . "`;\n";
				} else {
						return "";
				} 
				$_create = $query_handler -> db -> fetcharray( $_createtable );
				if ( strpos( $_table, "." ) !== false ) {
						$_create_table = substr( $_table, strpos( $_table, "." ) + 1 );
						$_create['Create Table'] = str_replace( "CREATE TABLE `" . $_create_table . "`", "CREATE TABLE `" . $_table . "`", $_create['Create Table'] );
				} 
				$_tabledump .= $_create['Create Table'];
				if ( MYSQL_SERVER_INFO < "4.1" && $sqlcompat == "MYSQL41" ) {
						$_tabledump = preg_replace( "/TYPE\\=(.+)/", "ENGINE=\\1 DEFAULT CHARSET=" . $dumpcharset, $_tabledump );
				} 
				if ( "4.1" < MYSQL_SERVER_INFO && $sqlcharset ) {
						$_tabledump = preg_replace( "/(DEFAULT)*\\s*CHARSET=.+/", "DEFAULT CHARSET=" . $sqlcharset, $_tabledump );
				} 
				$_tablestatus = $query_handler -> db -> query( "SHOW TABLE STATUS LIKE '" . $_table . "'" );
				$_tablestatus = $query_handler -> db -> fetcharray( $_tablestatus );
				$_tabledump .= ";\n\n";
				if ( $sqlcompat == "MYSQL40" && "4.1" <= MYSQL_SERVER_INFO && MYSQL_SERVER_INFO < "5.1" && $_tablestatus['Engine'] == "MEMORY" ) {
						$_tabledump = str_replace( "TYPE=MEMORY", "TYPE=HEAP", $_tabledump );
				} 
		} 
		$_tabledumped = 0;
		$_numrows = $_offset;
		$_firstfield = $_tablefields[0];
		if ( $extendins == "0" ) {
				while ( $_currsize + strlen( $_tabledump ) < $sizelimit * 1000 && $_numrows == $_offset ) {
						if ( $_firstfield['Extra'] == "auto_increment" ) {
								$_selectsql = "SELECT * FROM " . $_table . " WHERE {$_firstfield['Field']}>{$_startfrom} LIMIT {$_offset}";
						} else {
								$_selectsql = "SELECT * FROM " . $_table . " LIMIT {$_startfrom}, {$_offset}";
						} 
						$_tabledumped = 1;
						$_query = $query_handler -> db -> query( $_selectsql );
						$_numfields = mysql_num_fields( $_query );
						$_numrows = $query_handler -> db -> getrowsnum( $_query );
						if ( $_numrows = $query_handler -> db -> getrowsnum( $_query ) ) {
								while ( $_row = $query_handler -> db -> fetchrow( $_query ) ) {
										$_comma = $_dumpsql = "";
										$_i = 0;
										for ( ; $_i < $_numfields; ++$_i ) {
												$_dumpsql .= $_comma . ( $usehex && !empty( $_row[$_i] ) && ( saxue_strexists( $_tablefields[$_i]['Type'], "char" ) || saxue_strexists( $_tablefields[$_i]['Type'], "text" ) ) ? "0x" . bin2hex( $_row[$_i] ) : "'" . mysql_escape_string( $_row[$_i] ) . "'" );
												$_comma = ",";
										} 
										if ( strlen( $_dumpsql ) + $_currsize + strlen( $_tabledump ) < $sizelimit * 1000 ) {
												if ( $_firstfield['Extra'] == "auto_increment" ) {
														$_startfrom = $_row[0];
												} else {
														++$_startfrom;
												} 
												$_tabledump .= "INSERT INTO " . $_table . " VALUES ({$_dumpsql});\n";
										} else {
												$complete = false;
												break 2;
										} 
								} 
						} 
				} 
		} else {
				while ( $_currsize + strlen( $_tabledump ) < $sizelimit * 1000 && $_numrows == $_offset ) {
						if ( $_firstfield['Extra'] == "auto_increment" ) {
								$_selectsql = "SELECT * FROM " . $_table . " WHERE {$_firstfield['Field']}>{$_startfrom} LIMIT {$_offset}";
						} else {
								$_selectsql = "SELECT * FROM " . $_table . " LIMIT {$_startfrom}, {$_offset}";
						} 
						$_tabledumped = 1;
						$_query = $query_handler -> db -> query( $_selectsql );
						$_numfields = mysql_num_fields( $_query );
						if ( $_numrows = $query_handler -> db -> getrowsnum( $_query ) ) {
								$_extdumpsql = $_extcomma = "";
								while ( $_row = $query_handler -> db -> fetchrow( $_query ) ) {
										$_dumpsql = $_comma = "";
										$_i = 0;
										for ( ; $_i < $_numfields; ++$_i ) {
												$_dumpsql .= $_comma . ( $usehex && !empty( $_row[$_i] ) && ( saxue_strexists( $_tablefields[$_i]['Type'], "char" ) || saxue_strexists( $_tablefields[$_i]['Type'], "text" ) ) ? "0x" . bin2hex( $_row[$_i] ) : "'" . mysql_escape_string( $_row[$_i] ) . "'" );
												$_comma = ",";
										} 
										if ( strlen( $_extdumpsql ) + $_currsize + strlen( $_tabledump ) < $sizelimit * 1000 ) {
												if ( $_firstfield['Extra'] == "auto_increment" ) {
														$_startfrom = $_row[0];
												} else {
														++$_startfrom;
												} 
												$_extdumpsql .= "{$_extcomma} ({$_dumpsql})";
												$_extcomma = ",";
										} else {
												$_tabledump .= "INSERT INTO " . $_table . " VALUES {$_extdumpsql};\n";
												$complete = false;
												break;
										} 
								} 
								$_tabledump .= "INSERT INTO " . $_table . " VALUES {$_extdumpsql};\n";
						} 
				} 
		} 
		$startrow = $_startfrom;
		$_tabledump .= "\n";
		return $_tabledump;
} 

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

function saxue_strexists( $_haystack, $_needle ) {
		return !( strpos( $_haystack, $_needle ) === false );
} 

function saxue_random( $_length, $_numeric = 0 ) {
		if ( PHP_VERSION < "4.2.0" ) {
				mt_srand( ( double )microtime() * 1000000 );
		} 
		if ( $_numeric ) {
				$_hash = sprintf( "%0" . $_length . "d", mt_rand( 0, pow( 10, $_length ) - 1 ) );
				return $_hash;
		} 
		$_hash = "";
		$_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$_max = strlen( $_chars ) - 1;
		$_i = 0;
		for ( ; $_i < $_length; ++$_i ) {
				$_hash .= $_chars[mt_rand( 0, $_max )];
		} 
		return $_hash;
} 

function saxue_arraykeys2( $_array, $_key2 ) {
		$_return = array();
		foreach ( $_array as $_val ) {
				$_return[] = $_val[$_key2];
		} 
		return $_return;
} 

function saxue_getfilesarray( $_basename ) {
		$_filesarray = array();
		$_dp = dir( MYSQL_BACKUP_PATH );
		while ( false !== ( $_file = $_dp -> read() ) ) {
				$_tmp_basename = substr( basename( $_file ), 0, strpos( basename( $_file ), "." ) );
				$_tmp_basename = substr( $_tmp_basename, 0, strpos( $_tmp_basename, "-" ) );
				if ( $_basename == $_tmp_basename ) {
						$_filesarray[] = $_file;
				} 
		} 
		$_dp -> close();
		if ( is_array( $_filesarray ) && 0 < count( $_filesarray ) ) {
				$_i = 0;
				for ( ; $_i < count( $_filesarray ); ++$_i ) {
						if ( file_exists( ( MYSQL_BACKUP_PATH . "/" . $_basename . "-" . ( $_i + 1 ) ) . substr( $_filesarray[$_i], strrpos( $_filesarray[$_i], "." ) ) ) ) {
								continue;
						} 
						return false;
				} 
				return $_filesarray;
		} 
		return false;
} 

function saxue_getbackuplog() {
		$_dbfile_list = array();
		$_handle = opendir( MYSQL_BACKUP_PATH );
		while ( $_file = @readdir( $_handle ) ) {
				if ( substr( $_file, -4 ) == ".sql" ) {
						$_dbfile_list[] = $_file;
				} 
		} 
		sort( $_dbfile_list );
		$_backuplog = array();
		$_basename = "";
		$_k = 0;
		foreach ( $_dbfile_list as $_v ) {
				$_tmparr = explode( "-", $_v );
				$_tmp_basename = $_tmparr[0];
				if ( $_tmp_basename != $_basename ) {
						$_basename = $_tmp_basename;
						$_backuplog[$_k]['name'] = $_basename;
						$_backuplog[$_k]['time'] = filemtime( MYSQL_BACKUP_PATH . "/" . $_v );
						if ( 1 < count( $_tmparr ) ) {
								$_backuplog[$_k]['num'] = 1;
						} else {
								$_backuplog[$_k]['num'] = 0;
						} 
						++$_k;
				} else {
						++$_backuplog[$_k]['num'];
				} 
		} 
		return $_backuplog;
} 

if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'dbmanage' );
if ( empty( $_SESSION['saxueDbLogin'] ) ) {
		header( "Location: " . SAXUE_ADMIN_URL . "/dblogin.php?jumpurl=".urlencode( saxue_addurlvars( array( ) ) ) );
		exit( );
}
@set_time_limit( 0 );
@session_write_close();
saxue_loadlang( "database" );
saxue_includedb();
$query_handler = saxuequeryhandler :: getinstance( "SaxueQueryHandler" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
include_once( SAXUE_ROOT_PATH . "/lib/form/formloader.php" );
if ( !defined( "MYSQL_BACKUP_PATH" ) ) {
		define( "MYSQL_BACKUP_PATH", SAXUE_DATA_PATH . "/dbbackup" );
} 
if ( !saxue_checkdir( MYSQL_BACKUP_PATH, true ) ) {
		saxue_createdir( MYSQL_BACKUP_PATH, 511, true );
} 
$query_handler -> db -> connect();
define( "MYSQL_SERVER_INFO", mysql_get_server_info() );
if ( $_REQUEST['option'] == "export" ) {
		if ( isset( $_REQUEST['method'] ) && $_REQUEST['method'] == "backup" ) {
				$exporttype = $_REQUEST['exporttype'] == "select" ? "select" : "all";
				$exporttables = $_REQUEST['tablearray'];
				$exportmode = $_REQUEST['exportmode'] == "mysqldump" ? "mysqldump" : "multivol";
				$sqlcompat = $_REQUEST['exportversion'] ? $_REQUEST['exportversion'] == "MYSQL40" ? "MYSQL40" : "MYSQL41" : "";
				$sqlcharset = in_array( $_REQUEST['exportcharset'], array( "gbk", "big5", "utf8" ) ) ? $_REQUEST['exportcharset'] : "";
				$dumpcharset = $sqlcharset ? $sqlcharset : str_replace( "-", "", SAXUE_CHAR_SET );
				$extendins = $_REQUEST['exportinsert'] == 1 ? 1 : 0;
				$sizelimit = intval( trim( $_REQUEST['exportsize'] ) );
				if ( $sizelimit < 100 ) {
						$sizelimit = 100;
				} 
				$usehex = $_REQUEST['exporthexcode'] == 1 ? 1 : "";
				$filename = trim( $_REQUEST['exportfile'] );
				$errtext = "";
				if ( empty( $sizelimit ) || intval( $sizelimit ) < 100 ) {
						$errtext .= $saxueLang['database']['need_size_limit'] . "<br />";
				} 
				if ( empty( $filename ) || !preg_match( "/[A-Za-z0-9_]+\$/", $filename ) ) {
						$errtext .= $saxueLang['database']['need_file_name'] . "<br />";
				} 
				$tables = array();
				if ( $exporttype == "all" ) {
						$tables = saxue_arraykeys2( saxue_fetchtablelist( SAXUE_DB_PREFIX ), "Name" );
				} else if ( $exporttype == "select" && is_array( $exporttables ) && 0 < count( $exporttables ) ) {
						foreach ( $exporttables as $value ) {
								$tables[] = $value;
						} 
				} 
				if ( !is_array( $tables ) || empty( $tables ) ) {
						$errtext .= $saxueLang['database']['need_export_table'] . "<br />";
				} 
				$exporttime = gmdate( "Y-m-d H:i:s", SAXUE_NOW_TIME );
				if ( empty( $errtext ) ) {
						$idstring = "# Identify: " . base64_encode( "{$exporttime}, {$exporttype}, {$exportmode}" ) . "\n";
						$setnames = $sqlcharset && "4.1" < MYSQL_SERVER_INFO && ( !$sqlcompat || $sqlcompat == "MYSQL41" ) ? "SET NAMES '" . $dumpcharset . "';\n\n" : "";
						if ( "4.1" < MYSQL_SERVER_INFO ) {
								if ( $sqlcharset ) {
										$query_handler -> db -> query( "SET NAMES '" . $sqlcharset . "';\n\n" );
								} 
								if ( $sqlcompat == "MYSQL40" ) {
										$query_handler -> db -> query( "SET SQL_MODE='MYSQL40'" );
								} else if ( $sqlcompat == "MYSQL41" ) {
										$query_handler -> db -> query( "SET SQL_MODE=''" );
								} 
						} 
						$backupfilename = MYSQL_BACKUP_PATH . "/" . str_replace( array( "/", "\\", "." ), "", $filename );
						if ( $exportmode == "multivol" ) {
								header( "Content-type: text/html; charset=" . SAXUE_SYSTEM_CHARSET );
								echo "                                                                                                                                                                                                                                                                                                            ";
								echo $saxueLang['database']['export_file_start'] . "<br />";
								ob_flush();
								flush();
								do {
										$sqldump = "";
										$complete = true;
										$volume = intval( $volume ) + 1;
										$tableid = intval( $tableid );
										$startfrom = intval( $startrow );
										for ( ; $complete && $tableid < count( $tables ) && strlen( $sqldump ) < $sizelimit * 1000; ++$tableid ) {
												$sqldump .= saxue_sqldumptable( $tables[$tableid], $startfrom, strlen( $sqldump ) );
												if ( $complete ) {
														$startfrom = 0;
												} 
										} 
										$dumpfile = $backupfilename . "-%s.sql";
										if ( !$complete ) {
												$tableid--;
										} 
										if ( !trim( $sqldump ) ) {
												break;
										} else {
												$sqldump = "{$idstring}" . "# <?php exit();?>\n" . ( "# SaxueFrame Multi-Volume Data Dump Vol." . $volume . "\n" ) . "# Version: SaxueFrame " . SAXUE_VERSION . "\n" . ( "# Time: " . $exporttime . "\n" ) . ( "# Type: " . $exportmode . "\n" ) . "# Table Prefix: " . SAXUE_DB_PREFIX . "\n#\n# SaxueFrame Homepage: http://www.saxue.com\n# Please visit our website for newest infomation about SaxueFrame\n# --------------------------------------------------------\n\n\n" . "{$setnames}" . $sqldump;
												$dumpfilename = sprintf( $dumpfile, $volume );
												$fp = @fopen( $dumpfilename, "wb" );
												@flock( $fp, 2 );
										} 
										if ( !@fwrite( $fp, $sqldump ) ) {
												@fclose( $fp );
												saxue_printfail( $saxueLang['database']['write_file_failure'] );
										} else {
												@fclose( $fp );
												unset( $sqldump );
												echo sprintf( $saxueLang['database']['export_file_name'], basename( $dumpfilename ) ) . "<br />";
												ob_flush();
												flush();
										} 
								} while ( 1 );
								$saxueTpl -> assign( "option", 3 );
								$saxueTpl -> assign( "backup_info", $saxueLang['database']['export_mysql_success'] );
								saxue_getconfigs( "backuplog", "admin" );
								if ( @file_exists( MYSQL_BACKUP_PATH ) ) {
										$dh = @opendir( MYSQL_BACKUP_PATH );
										while ( $files = @readdir( $dh ) ) {
												if ( strpos( $files, $filename ) === 0 ) {
														$saxueBackuplog[] = array( "name" => $files,
																"version" => $sqlcompat ? $sqlcompat : MYSQL_SERVER_INFO,
																"time" => filemtime( MYSQL_BACKUP_PATH . "/" . $files ),
																"mode" => $saxueLang['database']['export_multivol'],
																"size" => filesize( MYSQL_BACKUP_PATH . "/" . $files ),
																"type" => $exporttype == "all" ? $saxueLang['database']['export_all_data'] : $saxueLang['database']['export_custom_data'],
																"volume" => intval( substr( basename( $files ), strrpos( basename( $files ), "-" ) + 1 ) ) 
																);
												} 
										} 
										@closedir( $dh );
								} 
								saxue_setconfigs( "backuplog", $saxueBackuplog, "admin" );
						} else if ( $exportmode == "mysqldump" ) {
								$volume = 1;
								$tablesstr = "";
								$filestring = "<li>" . $saxueLang['database']['export_status_title'] . "</li>";
								foreach ( $tables as $t ) {
										$tablesstr .= "\"" . $t . "\" ";
								} 
								list( $dbhost, $dbport ) = explode( ":", SAXUE_DB_HOST );
								$result = $query_handler -> db -> query( "SHOW VARIABLES LIKE 'basedir'" );
								list( , $mysql_base ) = mysql_fetch_array( $result, MYSQL_NUM );
								$dumpfile = $backupfilename . "-" . $volume . ".sql";
								saxue_delfile( $dumpfile );
								$mysqlbin = $mysql_base == "/" ? "" : saxue_setslashes( $mysql_base ) . "bin/";
								@shell_exec( $mysqlbin . "mysqldump --force --quick " . ( "4.1" < MYSQL_SERVER_INFO ? "--skip-opt --create-options" : "-all" ) . " --add-drop-table" . ( SAXUE_DB_CHARSET ? " --default-character-set=\"" . SAXUE_DB_CHARSET . "\"" : "" ) . ( $extendins == 1 ? " --extended-insert" : "" ) . "" . ( "4.1" < MYSQL_SERVER_INFO && $sqlcompat == "MYSQL40" ? " --compatible=mysql40" : "" ) . " --host=\"" . $dbhost . "\"" . ( $dbport ? @is_numeric( $dbport ) ? " --port=\"" . $dbport . "\"" : " --socket=\"" . $dbport . "\"" : "" ) . " --user=\"" . SAXUE_DB_USER . "\" --password=\"" . SAXUE_DB_PASS . "\" \"" . SAXUE_DB_NAME . "\" " . $tablesstr . " > " . $dumpfile );
								if ( @file_exists( $dumpfile ) ) {
										if ( @is_writeable( $dumpfile ) ) {
												$fp = @fopen( $dumpfile, "rb+" );
												@fwrite( $fp, $idstring . "\r\n# <?php exit();?>\r\n" . $setnames . "\r\n# " );
												@fclose( $fp );
										} 
										$saxueTpl -> assign( "option", 3 );
										$filestring .= "<li>-" . sprintf( $saxueLang['database']['export_file_name'], basename( $dumpfile ) ) . "</li>";
										$filestring .= "<li>" . $saxueLang['database']['export_mysql_success'] . "</li>";
										$saxueTpl -> assign( "backup_info", $filestring );
										unset( $filestring );
										saxue_getconfigs( "backuplog", "admin" );
										if ( @file_exists( MYSQL_BACKUP_PATH ) ) {
												$dh = @opendir( MYSQL_BACKUP_PATH );
												while ( $files = @readdir( $dh ) ) {
														if ( strpos( $files, $filename ) === 0 ) {
																$saxueBackuplog[] = array( "name" => $files,
																		"version" => $sqlcompat ? $sqlcompat : MYSQL_SERVER_INFO,
																		"time" => filemtime( MYSQL_BACKUP_PATH . "/" . $files ),
																		"mode" => $saxueLang['database']['export_mysqldump'],
																		"size" => filesize( MYSQL_BACKUP_PATH . "/" . $files ),
																		"type" => $exporttype == "all" ? $saxueLang['database']['export_all_data'] : $saxueLang['database']['export_custom_data'],
																		"volume" => 0 
																		);
														} 
												} 
												@closedir( $dh );
										} 
										saxue_setconfigs( "backuplog", $saxueBackuplog, "admin" );
								} else {
										saxue_printfail( $saxueLang['database']['create_file_failure'] );
								} 
						} 
				} else {
						saxue_printfail( $errtext );
				} 
		} else {
				$saxueTpl -> assign( "option", 1 );
				$shelldisabled = function_exists( "shell_exec" ) ? "" : "disabled";
				$defaultfilename = date( "ymd" ) . "_" . saxue_random( 8 );
				$num = 0;
				$tablestring = "<div id=\"tablelist\" style=\"display:none;\"><table border=\"0\"><tr>";
				foreach ( saxue_fetchtablelist( SAXUE_DB_PREFIX ) as $table ) {
						$tablestring .= $num % 3 == 0 ? "</tr><tr><td style=\"text-align:left;font-size:12px;font-weight:normal;\"><input type=\"checkbox\" name=\"tablearray[]\" id=\"tablearray[]\" value=\"" . $table['Name'] . "\" />" . $table['Name'] . "</td>" : "<td style=\"text-align:left;font-size:12px;font-weight:normal;\"><input type=\"checkbox\" name=\"tablearray[]\" id=\"tablearray[]\" value=\"" . $table['Name'] . "\" />" . $table['Name'] . "</td>";
						++$num;
				} 
				$tablestring .= "</tr></table></div>";
				$export_form = new saxuethemeform( $saxueLang['database']['db_export'], "dbexport", SAXUE_ADMIN_URL . "/dbmanage.php" );
				$export_type = new saxueformradio( $saxueLang['database']['export_type'], "exporttype", "all" );
				$export_type -> setextra( "onClick='javascript:if(this.value==\"select\"){document.getElementById(\"tablelist\").style.display=\"block\";}else{document.getElementById(\"tablelist\").style.display=\"none\";}'" );
				$export_type -> addoption( "all", $saxueLang['database']['export_all_table'] );
				$export_type -> addoption( "select", $saxueLang['database']['export_select_table'] );
				$export_form -> addelement( $export_type );
				$export_form -> addelement( new saxueformlabel( $saxueLang['database']['export_talbe_list'], $tablestring ) );
				$export_mode = new saxueformradio( $saxueLang['database']['export_mode'], "exportmode", "multivol" );
				$export_mode -> setextra( $shelldisabled );
				$export_mode -> addoption( "multivol", $saxueLang['database']['export_partition'] );
				$export_mode -> addoption( "mysqldump", $saxueLang['database']['export_dump'] );
				$export_form -> addelement( $export_mode );
				$export_size = new saxueformtext( $saxueLang['database']['export_size_limit'], "exportsize", 6, 4, "2048" );
				$export_size -> setdescription( $saxueLang['database']['export_file_unit'] );
				$export_form -> addelement( $export_size, true );
				$export_extend = new saxueformradio( $saxueLang['database']['export_extend_insert'], "exportinsert", "" );
				$export_extend -> setextra( "onClick=''" );
				$export_extend -> addoption( "1", $saxueLang['database']['radio_checked_yes'] );
				$export_extend -> addoption( "0", $saxueLang['database']['radio_checked_no'] );
				$export_form -> addelement( $export_extend );
				$export_version = new saxueformradio( $saxueLang['database']['export_version'], "exportversion", "" );
				$export_version -> setextra( "onClick=''" );
				$export_version -> addoption( "", $saxueLang['database']['export_mysql_default'] );
				$export_version -> addoption( "MYSQL40", $saxueLang['database']['export_mysql_low'] );
				$export_version -> addoption( "MYSQL41", $saxueLang['database']['export_mysql_high'] );
				$export_form -> addelement( $export_version );
				$export_charset = new saxueformradio( $saxueLang['database']['export_charset'], "exportcharset", "" );
				$export_charset -> setextra( "onClick=''" );
				$export_charset -> addoption( "", $saxueLang['database']['export_charset_default'] );
				SAXUE_DB_CHARSET && "4.1" < MYSQL_SERVER_INFO ? $export_charset -> addoption( SAXUE_DB_CHARSET, strtoupper( SAXUE_DB_CHARSET ) ) : "";
				SAXUE_DB_CHARSET != "utf8" && "4.1" < MYSQL_SERVER_INFO ? $export_charset -> addoption( "utf8", "UTF-8" ) : "";
				$export_form -> addelement( $export_charset );
				$export_hexcode = new saxueformradio( $saxueLang['database']['export_hexcode'], "exporthexcode", "" );
				$export_hexcode -> setextra( "onClick=''" );
				$export_hexcode -> addoption( "1", $saxueLang['database']['radio_checked_yes'] );
				$export_hexcode -> addoption( "", $saxueLang['database']['radio_checked_no'] );
				$export_form -> addelement( $export_hexcode );
				$export_file = new saxueformtext( $saxueLang['database']['export_file'], "exportfile", 20, 250, $defaultfilename );
				$export_file -> setdescription( $saxueLang['database']['export_file_format'] );
				$export_form -> addelement( $export_file, true );
				$export_form -> addelement( new saxueformhidden( "method", "backup" ) );
				$export_form -> addelement( new saxueformhidden( "option", "export" ) );
				$on_submit = new saxueformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" );
				$on_submit -> setextra( "onclick=\"\"" );
				$export_form -> addelement( $on_submit );
				$saxueTpl -> assign( "dbmanage_form", $export_form -> render( ) );
		} 
} else if ( $_REQUEST['option'] == "import" ) {
		if ( isset( $_REQUEST['method'] ) && $_REQUEST['method'] == "cover" ) {
				$filename = $_REQUEST['importfile'];
				$errtext = "";
				if ( !empty( $filename ) ) {
						$filename = trim( $filename );
						$filename = strpos( $filename, "." ) ? substr( $filename, 0, strpos( $filename, "." ) ) : $filename;
						$filename = strpos( $filename, "-" ) ? substr( $filename, 0, strpos( $filename, "-" ) ) : $filename;
						if ( !preg_match( "/[A-Za-z0-9_]+\$/", $filename ) ) {
								$errtext .= $saxueLang['database']['need_file_name'] . "<br />";
						} 
				} else {
						$errtext .= $saxueLang['database']['need_file_name'] . "<br />";
				} 
				if ( empty( $errtext ) ) {
						$db_query = saxuequeryhandler :: getinstance( "SaxueQueryHandler" );
						$sqlfilearray = saxue_getfilesarray( $filename );
						if ( is_array( $sqlfilearray ) && 0 < count( $sqlfilearray ) ) {
								foreach ( $sqlfilearray as $v ) {
										$sqlfilecontent = saxue_readfile( MYSQL_BACKUP_PATH . "/" . $v );
										$sqlary = array();
										$sqlerr = array();
										saxue_splitsqlfile( $sqlary, str_replace( " saxue", " " . SAXUE_DB_PREFIX, $sqlfilecontent ) );
										foreach ( $sqlary as $s ) {
												$s = trim( $s );
												if ( empty( $s ) || !( 5 < strlen( $s ) ) ) {
														continue;
												} 
												$retflag = $db_query -> execute( saxue_syntablestruct( $s, "4.1" < MYSQL_SERVER_INFO, SAXUE_DB_CHARSET ) );
												if ( $retflag ) {
														continue;
												} 
												$sqlerr[] = array( "sql" => $s,
														"error" => $db_query -> db -> error() 
														);
												saxue_printfail( sprintf( $saxueLang['database']['print_sql_error'], saxue_htmlstr( $s ), saxue_htmlstr( $db_query -> db -> error() ) ) );
												break;
										} 
								} 
								saxue_jumppage( "dbmanage.php?option=import", $saxueLang['database']['import_mysql_success'] );
						} else {
								saxue_printfail( $saxueLang['database']['import_file_error'] );
						} 
				} else {
						saxue_printfail( $errtext );
				} 
		} else {
				$saxueTpl -> assign( "option", 2 );
				$import_form = new saxuethemeform( $saxueLang['database']['db_import'], "dbimport", SAXUE_ADMIN_URL . "/dbmanage.php" );
				$import_file = new saxueformtext( $saxueLang['database']['import_file'], "importfile", 20, 250 );
				$import_file -> setdescription( $saxueLang['database']['import_file_format'] );
				$import_form -> addelement( $import_file, true );
				$import_form -> addelement( new saxueformhidden( "method", "cover" ) );
				$import_form -> addelement( new saxueformhidden( "option", "import" ) );
				$on_submit = new saxueformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" );
				$on_submit -> setextra( "onclick=\"\"" );
				$import_form -> addelement( $on_submit );
				$saxueTpl -> assign( "dbmanage_form", $import_form -> render( ) );
				if ( isset( $_POST['checkaction'] ) && $_POST['checkaction'] == 1 && is_array( $_POST['checkid'] ) && 0 < count( $_POST['checkid'] ) ) {
						foreach ( $GLOBALS['_POST']['checkid'] as $v ) {
								saxue_getconfigs( "backuplog", "admin" );
								$backfile = MYSQL_BACKUP_PATH . "/" . $saxueBackuplog[$v]['name'];
								if ( @file_exists( $backfile ) ) {
										saxue_delfile( $backfile );
								} 
								unset( $saxueBackuplog[$v] );
								saxue_setconfigs( "backuplog", $saxueBackuplog, "admin" );
						} 
						saxue_jumppage( "dbmanage.php?option=import", $saxueLang['database']['log_del_success'] );
				} 
				$logfileisarray = false;
				saxue_getconfigs( "backuplog", "admin" );
				if ( is_array( $saxueBackuplog ) && 0 < count( $saxueBackuplog ) ) {
						foreach ( $saxueBackuplog as $k => $v ) {
								if ( !@file_exists( MYSQL_BACKUP_PATH . "/" . $v['name'] ) ) {
										unset( $saxueBackuplog -> $k );
								} 
						} 
						$logfileisarray = true;
				} 
				saxue_setconfigs( "backuplog", $saxueBackuplog, "admin" );
				if ( $logfileisarray ) {
						$log_array = array();
						$i = 0;
						foreach ( $saxueBackuplog as $k => $v ) {
								$log_array[$i]['id'] = $k;
								$log_array[$i]['name'] = $v['name'];
								$log_array[$i]['version'] = $v['version'];
								$log_array[$i]['time'] = date( "Y-m-d H:i:s", $v['time'] );
								$log_array[$i]['mode'] = $v['mode'];
								$log_array[$i]['size'] = round( $v['size'] / 1024, 2 ) . "K";
								$log_array[$i]['type'] = $v['type'];
								$log_array[$i]['volume'] = $v['volume'];
								$log_array[$i]['checkbox'] = "<input type=\"checkbox\" id=\"checkid[]\" name=\"checkid[]\" value=\"" . $k . "\" />";
								$log_array[$i]['importurl'] = substr( $v['name'], strpos( $v['name'], "." ) ) == ".sql" ? "./dbmanage.php?option=import&method=cover&importfile=" . substr( basename( $v['name'] ), 0, strpos( basename( $v['name'] ), "-" ) ) : "#";
								++$i;
						} 
						$saxueTpl -> assign( "log_list", $log_array );
				} 
		} 
} else {
		saxue_printfail( LANG_ERROR_PARAMETER );
} 
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/dbmanage.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
