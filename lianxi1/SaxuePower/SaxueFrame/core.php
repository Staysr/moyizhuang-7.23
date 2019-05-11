<?php
class saxueobject {
		var $vars = array();
		var $errors = array();

		function saxueobject() {
		} 

		function &getinstance( $_classname, $_classparam = "" ) {
				static $instance;
				if ( !isset( $_instance ) ) {
						if ( class_exists( $_classname ) ) {
								if ( $_classparam == "" ) {
										$instance = new $_classname();
										return $instance;
								} 
								if ( is_array( $_classparam ) ) {
										$instance = new $_classname( implode( ", ", $_classparam ) );
										return $instance;
								} 
								$instance = new $_classname( $_classparam );
								return $instance;
						} 
						return false;
				} 
				return $instance;
		} 

		function getvar( $_key, $_quotestyle = "s" ) {
				if ( isset( $this -> vars[$_key] ) ) {
						if ( is_string( $this -> vars[$_key] ) ) {
								switch ( strtolower( $_quotestyle ) ) {
										case "s" :
												return saxue_htmlstr( $this -> vars[$_key] );
										case "e" :
												return htmlspecialchars( $this -> vars[$_key], ENT_QUOTES );
										case "q" :
												return saxue_dbslashes( $this -> vars[$_key] );
										case "n" :
												return $this -> vars[$_key];
								} 
						} 
						return $this -> vars[$_key];
				} 
				return false;
		} 

		function getvars() {
				return $this -> vars;
		} 

		function setvar( $_key, $_value ) {
				$this -> vars[$_key] = $_value;
		} 

		function setvars( $_vars ) {
				foreach ( $_vars as $_key => $_value ) {
						$this -> setvar( $_key, $_value );
				} 
		} 

		function clearvars() {
				$this -> vars = array();
		} 

		function raiseerror( $_message = "unknown error!", $_mode = SAXUE_ERROR_DIE ) {
				switch ( $_mode ) {
						case SAXUE_ERROR_DIE :
								saxue_printfail( $_message, 0 );
								return;
						case SAXUE_ERROR_RETURN :
						case SAXUE_ERROR_PRINT :
								$this -> errors[$_mode][] = $_message;
								return;
				} 
				$this -> errors[SAXUE_ERROR_RETURN][] = $_message;
		} 

		function iserror( $_mode = 0 ) {
				if ( $_mode == 0 || strlen( $_mode ) == 0 ) {
						return count( $this -> errors );
				} 
				if ( isset( $this -> errors[$_mode] ) ) {
						return count( $this -> errors[$_mode] );
				} 
				return 0;
		} 

		function geterrors( $_mode = "" ) {
				if ( $_mode == 0 || strlen( $_mode ) == 0 ) {
						return $this -> errors;
				} 
				return $this -> errors[$_mode];
		} 

		function clearerrors( $_mode = "" ) {
				if ( $_mode == 0 || strlen( $_mode ) == 0 ) {
						$this -> errors = array();
				} else {
						$this -> errors[$_mode] = array();
				} 
		} 
} 

class saxueblock extends saxueobject {
		var $vars = array();
		var $errors = array();
		var $blockvars = array();
		var $template = "";
		var $cachetime = SAXUE_CACHE_LIFETIME;

		function saxueblock( &$vars ) {
				global $saxueTpl;
				$this -> blockvars = $vars; 
				if ( empty( $this -> blockvars['template'] ) ) {
						$this -> blockvars['template'] = $this -> template;
				} 
				if ( !empty( $this -> blockvars['template'] ) ) {
						$this -> blockvars['tlpfile'] = SAXUE_THEME_PATH . '/blocks/' . $this -> blockvars['template'];
				} else {
						$this -> blockvars['tlpfile'] = "";
				} 
				if ( $this -> cachetime == 0 ) {
						$this -> cachetime = SAXUE_CACHE_LIFETIME;
				} 
				if ( empty( $this -> blockvars['cachetime'] ) ) {
						$this -> blockvars['cachetime'] = $this -> cachetime;
				} 
				if ( empty( $this -> blockvars['overtime'] ) ) {
						$this -> blockvars['overtime'] = 0;
				} 
				if ( empty( $this -> blockvars['cacheid'] ) ) {
						$this -> blockvars['cacheid'] = null;
				} 
				if ( empty( $this -> blockvars['compileid'] ) ) {
						$this -> blockvars['compileid'] = null;
				} 
				if ( !empty( $this -> blockvars['template'] ) ) {
						$this -> template = $this -> blockvars['template'];
				} 
				if ( !is_object( $saxueTpl ) && !empty( $this -> blockvars['tlpfile'] ) ) {
						include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
						$saxueTpl = &saxuetpl :: getinstance();
				} 
				$saxueTpl -> setcachtype( 0 );
		} 

		function gettitle() {
				if ( isset( $this -> blockvars['title'] ) ) {
						return $this -> blockvars['title'];
				} 
				return "";
		} 

		function getcontent() {
				global $saxueTpl;
				if ( SAXUE_USE_CACHE && !empty( $this -> blockvars['tlpfile'] ) && 0 < $this -> blockvars['cachetime'] && $saxueTpl -> is_cached( $this -> blockvars['tlpfile'], $this -> blockvars['cacheid'], $this -> blockvars['compileid'], $this -> blockvars['cachetime'], $this -> blockvars['overtime'] ) ) {
						$saxueTpl -> setcaching( 1 );
						$saxueTpl -> setcachtype( 0 );
						return $saxueTpl -> fetch( $this -> blockvars['tlpfile'], $this -> blockvars['cacheid'], $this -> blockvars['compileid'], $this -> blockvars['cachetime'], $this -> blockvars['overtime'], false );
				} 
				return $this -> updatecontent( true );
		} 

		function updatecontent( $_isreturn = false ) {
				global $saxueTpl;
				$this -> setcontent();
				if ( !empty( $this -> blockvars['tlpfile'] ) ) {
						if ( SAXUE_USE_CACHE && 0 < $this -> blockvars['cachetime'] ) {
								$saxueTpl -> setcaching( 2 );
								$saxueTpl -> setcachtype( 0 );
						} else {
								$saxueTpl -> setcaching( 0 );
						} 
						$_tmpval = $saxueTpl -> fetch( $this -> blockvars['tlpfile'], $this -> blockvars['cacheid'], $this -> blockvars['compileid'], $this -> blockvars['cachetime'], $this -> blockvars['overtime'], false );
						if ( $_isreturn ) {
								return $_tmpval;
						} 
				} 
		} 

		function setcontent( $_isreturn = false ) {
		} 
} 

class saxuecache extends saxueobject {
		var $vars = array();
		var $errors = array();

		function &getinstance( $_type = false, $_options = array() ) {
				if ( in_array( strtolower( $_type ), array( "file", "memcached" ) ) ) {
						$_type = strtolower( $_type );
				} else {
						$_type = "file";
				} 
				$_class = "SaxueCache" . ucfirst( $_type );
				$_instance = &saxuecache :: retinstance();
				$_sign = md5( $_class . "::" . serialize( $_options ) );
				if ( !isset( $_instance[$_sign] ) ) {
						$_instance[$_sign] = new $_class( $_options );
						if ( $_type != "file" && $_instance[$_sign] === false ) {
								$_instance[$_sign] = new saxuecachefile( $_options );
						} 
				} 
				if ( !defined( "SAXUE_CACHE_CONNECTED" ) ) {
						@define( "SAXUE_CACHE_CONNECTED", true );
				} 
				return $_instance[$_sign];
		} 

		function &retinstance() {
				static $instance = array();
				return $instance;
		} 

		function close( $_cache = null ) {
				if ( is_object( $_cache ) ) {
						$_cache -> close();
				} else {
						$_instance = &saxuecache :: retinstance();
						if ( !empty( $_instance ) ) {
								foreach ( $_instance as $_cache ) {
										$_cache -> close();
								} 
						} 
				} 
		} 
} 

class saxuecachefile extends saxuecache {
		var $vars = array();
		var $errors = array();

		function close( $_cache = null ) {
				return true;
		} 

		function saxuecachefile() {
				return true;
		} 

		function iscached( $_name, $_life_time = 0, $_over_time = 0 ) {
				if ( $_life_time == 0 && $_over_time == 0 ) {
						return is_file( $_name );
				} 
				$_file_time = @filemtime( $_name );
				if ( !$_file_time ) {
						return false;
				} 
				if ( ( 0 < $_life_time && $_life_time < SAXUE_NOW_TIME - $_file_time ) || ( 0 < $_over_time && $_file_time < $_over_time ) ) {
						saxue_delfile( $_name );
						return false;
				} 
				return true;
		} 

		function cachedtime( $_name ) {
				if ( file_exists( $_name ) ) {
						return filemtime( $_name );
				} 
				return 0;
		} 

		function uptime( $_name ) {
				@touch( $_name, @time() );
				@clearstatcache();
		} 

		function get( $_name, $_life_time = 0, $_over_time = 0 ) {
				if ( $_life_time == 0 && $_over_time == 0 ) {
						return saxue_readfile( $_name );
				} 
				$_file_time = @filemtime( $_name );
				if ( !$_file_time ) {
						return false;
				} 
				if ( ( 0 < $_life_time && $_life_time < SAXUE_NOW_TIME - $_file_time ) || ( 0 < $_over_time && $_file_time < $_over_time ) ) {
						saxue_delfile( $_name );
						return false;
				} 
				return saxue_readfile( $_name );
		} 

		function set( $_name, $_value, $_life_time = 0, $_over_time = 0 ) {
				if ( saxue_checkdir( dirname( $_name ), true ) ) {
						return saxue_writefile( $_name, $_value );
				} 
				return false;
		} 

		function delete( $_name ) {
				return saxue_delfile( $_name );
		} 

		function clear( $_path = "" ) {
				if ( 0 < strlen( $_path ) && is_dir( $_path ) ) {
						saxue_delfolder( $_path );
				} 
		} 
} 

class saxuecachememcached extends saxuecache {
		var $vars = array();
		var $errors = array();
		var $_connected;
		var $_mc;
		var $_md5key = true;
		var $_keyext = ".mt";

		function close( $_cache = null ) {
				if ( is_object( $this -> _mc ) ) {
						return $this -> _mc -> close();
				} 
				return true;
		} 

		function saxuecachememcached( $_options ) {
				if ( !class_exists( "Memcache" ) ) {
						exit( "Memcache class not exists" );
				} 
				if ( !isset( $_options['host'] ) ) {
						$_options['host'] = "127.0.0.1";
				} 
				if ( !isset( $_options['port'] ) ) {
						$_options['port'] = 11211;
				} 
				if ( !isset( $_options['timeout'] ) ) {
						$_options['timeout'] = false;
				} 
				if ( !isset( $_options['persistent'] ) ) {
						$_options['persistent'] = false;
				} 
				$_function = $_options['persistent'] ? "pconnect" : "connect";
				if ( !is_a( $this -> _mc, "Memcache" ) ) {
						$this -> _mc = new memcache();
				} 
				$this -> _connected = $_options['timeout'] === false ? $this -> _mc -> $_function( $_options['host'], $_options['port'] ) : $this -> _mc -> func( $_options['host'], $_options['port'], $_options['timeout'] );
				if ( !$this -> _connected && 0 < SAXUE_ERROR_MODE ) {
						echo "Could not connect to memcache and try to use file cache now!<br />";
				} 
				return $this -> _connected;
		} 

		function iscached( $_name, $_life_time = 0, $_over_time = 0 ) {
				if ( $this -> get( $_name, $_life_time, $_over_time ) === false ) {
						return false;
				} 
				return true;
		} 

		function cachedtime( $_name ) {
				if ( $this -> _md5key ) {
						$_name = md5( $_name );
				} 
				return intval( $this -> _mc -> get( $_name . $this -> _keyext ) );
		} 

		function uptime( $_name ) {
				if ( $this -> _md5key ) {
						$_name = md5( $_name );
				} 
				return $this -> _mc -> set( $_name . $this -> _keyext, time(), 0, 0 );
		} 

		function get( $_name, $_life_time = 0, $_over_time = 0 ) {
				$_key = $this -> _md5key == true ? md5( $_name ) : $_name;
				$_ret = $this -> _mc -> get( $_key );
				if ( $_ret === false || ( $_life_time == 0 && $_over_time == 0 ) ) {
						return $_ret;
				} 
				$_cached_time = $this -> cachedtime( $_name );
				if ( ( 0 < $_life_time && $_life_time < SAXUE_NOW_TIME - $_cached_time ) || ( 0 < $_over_time && $_cached_time < $_over_time ) ) {
						$this -> delete( $_name );
						return false;
				} 
				return $_ret;
		} 

		function set( $_name, $_value, $_life_time = 0, $_over_time = 0 ) {
				if ( 2592000 < $_life_time ) {
						$_life_time = 0;
				} 
				if ( $this -> _md5key ) {
						$_name = md5( $_name );
				} 
				if ( SAXUE_NOW_TIME < $_over_time && $_over_time - SAXUE_NOW_TIME < $_life_time ) {
						$_life_time = $_over_time - SAXUE_NOW_TIME;
				} 
				return $this -> _mc -> set( $_name . $this -> _keyext, time(), 0, $_life_time ) && $this -> _mc -> set( $_name, $_value, 0, $_life_time );
		} 

		function delete( $_name ) {
				if ( $this -> _md5key ) {
						$_name = md5( $_name );
				} 
				return $this -> _mc -> delete( $_name . $this -> _keyext ) && $this -> _mc -> delete( $_name );
		} 

		function clear() {
				return $this -> _mc -> flush();
		} 
} 

class saxuepluginmanager {
		private $_listeners = array();
		public function __construct() {
				$plugins = saxue_get_plugins();
				if ( $plugins ) {
						foreach( $plugins as $plugin ) {
								if ( @file_exists( SAXUE_WEB_PATH . $plugin['path'] . '/hooks.php' ) ) {
										include_once( SAXUE_WEB_PATH . $plugin['path'] . '/hooks.php' );
										$class = $plugin['identifier'] . '_hooks';
										if ( class_exists( $class ) ) {
												new $class( $this );
										} 
								} 
						} 
				} 
		} 

		function register( $hook, &$reference, $method ) {
				$key = get_class( $reference ) . '->' . $method; 
				$this -> _listeners[$hook][$key] = array( &$reference, $method );
		} 

		function trigger( $hook, $data = '' ) {
				$result = ''; 
				if ( isset( $this -> _listeners[$hook] ) && is_array( $this -> _listeners[$hook] ) && count( $this -> _listeners[$hook] ) > 0 ) {
						foreach ( $this -> _listeners[$hook] as $listener ) {
								$class = &$listener[0];
								$method = $listener[1];
								if ( method_exists( $class, $method ) ) {
										$result .= $class -> $method( $data );
								} 
						} 
				}
				return $result;
		} 
} 

function saxue_get_plugins() {
		global $saxuePlugin;
		$plunins = array();
		if ( empty( $saxuePlugin ) ) return $plunins;
		foreach ( $saxuePlugin as $k => $v ) {
				if ( $v['status'] == 1 ) $plunins[] = $v;
		}
		return $plunins;
}

function saxue_dbprefix( $_table, $_noprefix = false ) {
		if ( SAXUE_DB_PREFIX == "" || $_noprefix ) {
				return $_table;
		} 
		return SAXUE_DB_PREFIX . "_" . $_table;
} 

function saxue_includedb() {
		if ( !defined( "SAXUE_DBCLASS_INCLUDE" ) ) {
				include_once( SAXUE_ROOT_PATH . "/lib/database/database.php" );
				define( "SAXUE_DBCLASS_INCLUDE", true );
		} 
} 

function saxue_closedb( $_db = null ) {
		if ( defined( "SAXUE_DB_CONNECTED" ) && !defined( "SAXUE_DB_NOTCLOSE" ) && SAXUE_DB_PCONNECT == false ) {
				saxuedatabase :: close( $_db );
		} 
} 

function saxue_closeftp( $_ftp = null ) {
		if ( defined( "SAXUE_FTP_CONNECTED" ) && !defined( "SAXUE_FTP_NOTCLOSE" ) ) {
				saxueftp :: close( $_ftp );
		} 
} 

function &saxue_initcache() {
		if ( strtolower( substr( trim( SAXUE_CACHE_DIR ), 0, 12 ) ) != "memcached://" ) {
				$_cache_instance = &saxuecache :: getinstance( "file" );
				return $_cache_instance;
		} 
		$_params = @parse_url( @trim( SAXUE_CACHE_DIR ) );
		$_cache_instance = &saxuecache :: getinstance( "memcached", array( "host" => strval( $_params['host'] ), "port" => intval( $_params['port'] ) ) );
		return $_cache_instance;
} 

function saxue_closecache( $_cache = null ) {
		if ( defined( "SAXUE_CACHE_CONNECTED" ) && !defined( "SAXUE_CACHE_NOTCLOSE" ) ) {
				saxuecache :: close( $_cache );
		} 
} 

function saxue_freeresource() {
		saxue_closedb();
		saxue_closeftp();
		saxue_closecache();
} 

function saxue_jumppage( $url, $content = "", $time = 2, $direct = false ) {
		if ( strlen( $content ) > 0 && !$direct ) {
				include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
				$url = saxue_htmlstr( $url );
				$content = saxue_htmlstr( $content );
				$saxueTpl = &saxuetpl :: getinstance();
				$saxueTpl -> assign( array( "title" => LANG_NOTICE, "time" => $time, "content" => $content, "url" => $url ) );
				$saxueTpl -> setcaching( 0 );
				if ( empty( $_SESSION['saxueAdminId'] ) ) $saxueTpl -> display( SAXUE_THEME_PATH . '/jumppage.html' );
				else $saxueTpl -> display( SAXUE_ROOT_PATH . '/templates/admin/jumppage.html' );
		} else if ( strlen( $content ) == 0 && !headers_sent() ) {
				header( "Location: " . $url );
		} else {
				echo $content . "<script language=\"JavaScript\" type=\"text/javascript\">window.location='" . $url . "';</script>";
		} 
		saxue_freeresource();
		exit();
}  

function saxue_printfail( $errorinfo ) {
		$debuginfo = "";
		if ( defined( "SAXUE_DEBUG_MODE" ) && 0 < SAXUE_DEBUG_MODE ) {
				$trace = debug_backtrace();
				$debuginfo = "FILE: " . saxue_htmlstr( $trace[0]['file'] ) . " LINE:" . saxue_htmlstr( $trace[0]['line'] );
		} 
		include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
		$saxueTpl = &saxuetpl :: getinstance();
		$saxueTpl -> assign( array( "errorinfo" => $errorinfo, "debuginfo" => $debuginfo ) );
		$saxueTpl -> setcaching( 0 );
		if ( !empty( $_SESSION['saxueAdminId'] ) || defined( "SAXUE_INSTALL_MODE" ) ) $saxueTpl -> display( SAXUE_ROOT_PATH . '/templates/admin/msgerr.html' );
		else $saxueTpl -> display( SAXUE_THEME_PATH . '/msgerr.html' );
		saxue_freeresource();
		exit();
} 

function saxue_msgwin( $title = '', $content = '', $status = 'success' ) {
		include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
		$title = saxue_htmlstr( $title );
		if ( empty( $content ) ) {
				$content = $title;
				$title = LANG_NOTICE;
		}
		$saxueTpl = &saxuetpl :: getinstance();
		$saxueTpl -> assign( array( "status" => $status, "title" => $title, "content" => $content ) );
		$saxueTpl -> setcaching( 0 );
		if ( empty( $_SESSION['saxueAdminId'] ) ) $saxueTpl -> display( SAXUE_THEME_PATH . "/msgwin.html" );
		else $saxueTpl -> display( SAXUE_ROOT_PATH . '/templates/admin/msgwin.html' );
		saxue_freeresource();
		exit();
}

function saxue_flush() {
		if ( function_exists( "apache_setenv" ) ) {
				@apache_setenv( "no-gzip", 1 );
		} 
		@ini_set( "output_buffering", 0 );
		@ini_set( "zlib.output_compression", 0 );
		@ini_set( "implicit_flush", 1 );
		for ( $_i = 0; $_i < @ob_get_level(); ++$_i ) {
				@ob_end_flush();
		} 
		@ob_implicit_flush( 1 );
		echo str_repeat( " ", 4096 );
		return true;
} 

function saxue_obflush( $msg ) {
		echo "                                                                                                                                                                                                                                                                ";
		echo sprintf( $msg );
		ob_flush( );
		flush( );
} 

function saxue_userip() {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
				$_ip = $_SERVER['HTTP_CLIENT_IP'];
		} else if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
				$_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
				$_ip = $_SERVER['REMOTE_ADDR'];
		} 
		$_ip = trim( $_ip );
		if ( !is_numeric( str_replace( ".", "", $_ip ) ) ) {
				$_ip = "";
		} 
		return $_ip;
} 

function saxue_getsubdir( $_id, $_sub_num = 1000 ) {
		return "/" . floor( intval( $_id ) / $_sub_num );
} 

function saxue_geturl( $target ) {
		$funname = "saxue_url_" . $target;
		if ( !function_exists( $funname ) && is_file( SAXUE_ROOT_PATH . "/common/funurl.php" ) ) {
				include_once( SAXUE_ROOT_PATH . "/common/funurl.php" );
		} 
		if ( function_exists( $funname ) ) {
				$numargs = func_num_args();
				$args = func_get_args();
				switch ( $numargs ) {
						case 0 :
						case 1 :
								return $funname();
						case 2 :
								return $funname( $args[1] );
						case 3 :
								return $funname( $args[1], $args[2] );
						case 4 :
								return $funname( $args[1], $args[2], $args[3] );
						case 5 :
								return $funname( $args[1], $args[2], $args[3], $args[4] );
				} 
				return $funname( $args[1], $args[2], $args[3], $args[4], $args[5] );
		} 
		return false;
} 

function saxue_uploadpath( $_dir = "", $_root_path = "" ) {
		if ( $_root_path == "" ) {
				if ( SAXUE_ATTACHS_PATH == "" ) {
						$_path = "attachs";
				} else {
						$_path = SAXUE_ATTACHS_PATH;
				}
				if ( strpos( $_path, "/" ) === false && strpos( $_path, "\\" ) === false ) {
						$_root_path = SAXUE_WEB_PATH . "/" . $_path;
				} elseif ( substr( $_path, 0, 1 ) === '/' ) {
						$_root_path = SAXUE_WEB_PATH . $_path;
				} else {
						$_root_path = $_path;
				}
		} 
		if ( $_dir == "" ) {
				return $_root_path;
		} 
		return $_root_path . "/" . $_dir;
} 

function saxue_uploadurl( $_dir = "", $_root_url = "" ) {
		if ( $_root_url == "" ) {
				if ( SAXUE_ATTACHS_URL != '' ) {
						$_root_url = SAXUE_ATTACHS_URL;
				} else {
						$_root_url = SAXUE_URL;
						if ( SAXUE_ATTACHS_PATH == "" ) {
								$_root_url .= "/attachs";
						} elseif ( substr( SAXUE_ATTACHS_PATH, 0, 1 ) === '/' ) {
								$_root_url .= SAXUE_ATTACHS_PATH;
						} else {
								$_root_url .= "/" . SAXUE_ATTACHS_PATH;
						}
				} 
		} 
		if ( $_dir == "" ) {
				return $_root_url;
		} 
		return $_root_url . "/" . $_dir;
} 

function saxue_checkpower( $_node = '', $_isreturn = false ) { 
		if ( empty( $_SESSION['saxueAdminId'] ) ) {
				if ( false === stripos( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], SAXUE_ADMIN_URL ) ) {
						header( "Location: " . SAXUE_URL );
						exit();
				}
				if ( $_isreturn ) {
						return false;
				}
				header( "Location: " . SAXUE_ADMIN_URL . "/login.php" );
				exit();
		}
		if ( !empty( $_node ) && SAXUE_CHECK_ROLE == 1 && $_SESSION['saxueAdminIsFounder'] != 1 ) {
				$permission = false;
				if ( !empty( $_SESSION['saxueAdminRole'] ) ) {
						global $saxueRoles;
						if ( !isset( $saxueRoles ) ) {
								saxue_getconfigs( "roles", "admin" );
						}
						if ( isset( $saxueRoles[$_SESSION['saxueAdminRole']] ) && $saxueRoles[$_SESSION['saxueAdminRole']]['status'] == 1 && false !== strpos( ',' . $saxueRoles[$_SESSION['saxueAdminRole']]['power'] . ',', ',' . $_node . ',' ) ) {
								$permission = true;	
						}
				}
				if ( !$permission ) {
						if ( $_isreturn ) {
								return false;
						}
						saxue_printfail( LANG_NO_PERMISSION );
				}
		}
		return true;
}

function saxue_addurlvars( $_arrvars, $_method_get = true, $_method_post = false, $_special = "" ) {
		if ( !empty( $_SERVER['PHP_SELF'] ) ) {
				$_ret = $_SERVER['PHP_SELF'];
		} else if ( !empty( $_SERVER['SCRIPT_NAME'] ) && substr( $_SERVER['SCRIPT_NAME'], -4 ) == ".php" ) {
				$_ret = $_SERVER['SCRIPT_NAME'];
		} else {
				$_ret = "";
		} 
		$_start = 0;
		if ( !is_array( $_special ) ) {
				$_special = array();
		} 
		if ( $_method_get ) {
				foreach ( $GLOBALS['_GET'] as $_k => $_v ) {
						if ( !array_key_exists( $_k, $_arrvars ) && !in_array( $_k, $_special ) ) {
								if ( is_string( $_v ) && $_v != '') {
										$_ret .= 0 < $_start++ ? "&" . $_k . "=" . urlencode( $_v ) : "?" . $_k . "=" . urlencode( $_v );
								} elseif ( is_array( $_v ) ) {
										$_ret .= 0 < $_start++ ? "&" . $_k . "=" . urlencode( implode( ",", $_v ) ) : "?" . $_k . "=" . urlencode( implode( ",", $_v ) );
								}
						} 
				} 
		} 
		if ( $_method_post ) {
				foreach ( $GLOBALS['_POST'] as $_k => $_v ) {
						if ( !array_key_exists( $_k, $_arrvars ) && !in_array( $_k, $_special ) ) {
								if ( is_string( $_v ) && $_v != '' ) {
										$_ret .= 0 < $_start++ ? "&" . $_k . "=" . urlencode( $_v ) : "?" . $_k . "=" . urlencode( $_v );
								} elseif ( is_array( $_v ) ) {
										$_ret .= 0 < $_start++ ? "&" . $_k . "=" . urlencode( implode( ",", $_v ) ) : "?" . $_k . "=" . urlencode( implode( ",", $_v ) );
								}
						} 
				} 
		} 
		if ( is_array( $_arrvars ) ) {
				foreach ( $_arrvars as $_k => $_v ) {
						$_ret .= 0 < $_start++ ? "&" . $_k . "=" . $_v : "?" . $_k . "=" . $_v;
				} 
		} 
		return $_ret;
} 

function saxue_loadlang( $fname ) {
		global $saxueLang;
		if ( empty( $saxueLang[$fname]['load'] ) ) {
				$file = SAXUE_ROOT_PATH . "/lang/lang_" . $fname . ".php";
				$file = @realpath( $file );
				if ( is_file( $file ) && preg_match( "/\\.php\$/i", $file ) ) {
						include_once( $file );
						return true;
				} 
				return false;
		} 
}

function saxue_htmlstr( $_str, $_quotestyle = ENT_QUOTES ) {
		$_str = htmlspecialchars( $_str, $_quotestyle );
		$_str = nl2br( $_str );
		$_str = str_replace( "  ", "&nbsp;&nbsp;", $_str );
		$_str = preg_replace( "/&amp;#(\\d+);/isU", "&#\\1;", $_str );
		return $_str;
} 

function saxue_substr( $_str, $_start, $_length, $_ellipsis = "" ) {
		$_length -= strlen( $_ellipsis );
		$_len = strlen( $_str );
		$_ret = "";
		$_i = 0;
		$_j = 0;
		$_k = 0;
		while ( $_i < $_len && $_k < $_length ) {
				$_l1 = 1;
				$_l2 = 1;
				$_ord = ord( $_str[$_i] );
				if ( 192 <= $_ord && $_ord <= 223 ) {
						$_l1 = 2;
						$_l2 = 2;
				} else if ( 224 <= $_ord && $_ord <= 239 ) {
						$_l1 = 3;
						$_l2 = 2;
				} else if ( 240 <= $_ord && $_ord <= 247 ) {
						$_l1 = 4;
						$_l2 = 2;
				} 
				if ( $_start <= $_j ) {
						$_ret .= substr( $_str, $_i, $_l1 );
						$_k += $_l2;
				} 
				$_i += $_l1;
				$_j += $_l2;
		} 
		if ( $_i < $_len ) {
				$_ret .= $_ellipsis;
		} 
		return $_ret;
} 

function saxue_funtoarray( $_funname, $_res ) {
		if ( is_array( $_res ) ) {
				foreach ( $_res as $_k => $_v ) {
						if ( is_string( $_v ) ) {
								$_res[$_k] = $_funname( $_v );
						} else if ( is_array( $_v ) ) {
								$_res[$_k] = saxue_funtoarray( $_funname, $_v );
						} 
				} 
				return $_res;
		} 
		$_res = $_funname( $_res );
		return $_res;
} 

function saxue_setslashes( $_str, $_special = "" ) {
		if ( $_special == "\"" ) {
				return str_replace( array( "\\", "'" ), array( "\\\\", "\\'" ), $_str );
		} 
		if ( $_special == "'" ) {
				return str_replace( array( "\\", "\"" ), array( "\\\\", "\\\"" ), $_str );
		} 
		return addslashes( $_str );
} 

function saxue_dbslashes( $_str, $_nodbslashes = false ) {
		if ( $_nodbslashes ) {
				return $_str;
		} 
		return addslashes( $_str );
} 

function saxue_sarytostr( $_res, $_joiner = "=", $_delimiter = "," ) {
		$_ret = "";
		foreach ( $_res as $_k => $_v ) {
				if ( !empty( $_ret ) ) {
						$_ret .= $_delimiter;
				} 
				$_ret .= $_k . $_joiner . $_v;
		} 
		return $_ret;
} 

function saxue_strtosary( $_str, $_joiner = "=", $_delimiter = "," ) {
		$_ret = array();
		$_tmparr = explode( $_delimiter, $_str );
		foreach ( $_tmparr as $_v ) {
				$_idx = strpos( $_v, $_joiner );
				if ( 0 < $_idx ) {
						$_ret[substr( $_v, 0, $_idx )] = substr( $_v, $_idx + 1 );
				} 
		} 
		return $_ret;
} 

function saxue_readfile( $_fileurl ) {
		if ( function_exists( "file_get_contents" ) ) {
				return file_get_contents( $_fileurl );
		} 
		$_fileopen = @fopen( $_fileurl, "rb" );
		@flock( $_fileopen, LOCK_SH );
		$_tmp_content = @fread( $_fileopen, @filesize( $_fileurl ) );
		@flock( $_fileopen, LOCK_UN );
		@fclose( $_fileopen );
		return $_tmp_content;
} 

function saxue_writefile( $_fileurl, &$_data, $_method = "wb" ) {
		$_fileopen = @fopen( $_fileurl, $_method );
		if ( !$_fileopen ) {
				return false;
		} 
		@flock( $_fileopen, LOCK_EX );
		$_ret = @fwrite( $_fileopen, $_data );
		@flock( $_fileopen, LOCK_UN );
		@fclose( $_fileopen );
		@chmod( $_fileurl, 511 );
		return $_ret;
} 

function saxue_delfile( $file_name ) {
		$file_name = trim( $file_name );
		$matches = array();
		if ( !preg_match( "/^(ftps?):\\/\\/([^:\\/]+):([^:\\/]*)@([0-9a-z\\-\\.]+)(:(\\d+))?([0-9a-z_\\-\\/\\.]*)/is", $file_name, $matches ) ) {
				if ( is_file( $file_name ) ) {
						return unlink( $file_name );
				} 
				return false;
		} 
		include_once( SAXUE_ROOT_PATH . "/lib/util/ftp.php" );
		$ftpssl = strtolower( $matches[1] ) == "ftps" ? 1 : 0;
		$matches[6] = intval( trim( $matches[6] ) );
		$ftpport = 0 < $matches[6] ? $matches[6] : 21;
		$ftp = &saxueftp :: getinstance( $matches[4], $matches[2], $matches[3], ".", $ftpport, 0, $ftpssl );
		if ( !$ftp ) {
				return false;
		} 
		$matches[7] = trim( $matches[7] );
		return $ftp -> ftp_delete( $matches[7] );
} 

function saxue_downfile( $_filename, $_contenttype = "application/octet-stream" ) {
		if ( file_exists( $_filename ) ) {
				header( "Content-type: " . $_contenttype );
				header( "Accept-Ranges: bytes" );
				header( "Content-Disposition: attachment; filename=" . basename( $_filename ) );
				echo saxue_readfile( $_filename );
				return true;
		} 
		return false;
} 

function saxue_copyfile( $from_file, $to_file, $mode = 511, $move = false ) {
		$from_file = trim( $from_file );
		if ( !is_file( $from_file ) ) {
				return false;
		} 
		$to_file = trim( $to_file );
		$matches = array();
		if ( !preg_match( "/^(ftps?):\\/\\/([^:\\/]+):([^:\\/]*)@([0-9a-z\\-\\.]+)(:(\\d+))?([0-9a-z_\\-\\/\\.]*)/is", $to_file, $matches ) ) {
				saxue_checkdir( dirname( $to_file ), true );
				if ( is_file( $to_file ) ) {
						@unlink( $to_file );
				} 
				if ( $move ) {
						$ret = rename( $from_file, $to_file );
				} else {
						$ret = copy( $from_file, $to_file );
				} 
				if ( $ret && $mode ) {
						@chmod( $to_file, $mode );
				} 
				return $ret;
		} 
		include_once( SAXUE_ROOT_PATH . "/lib/util/ftp.php" );
		$ftpssl = strtolower( $matches[1] ) == "ftps" ? 1 : 0;
		$matches[6] = intval( trim( $matches[6] ) );
		$ftpport = 0 < $matches[6] ? $matches[6] : 21;
		$ftp = &saxueftp :: getinstance( $matches[4], $matches[2], $matches[3], ".", $ftpport, 0, $ftpssl );
		if ( !$ftp ) {
				return false;
		} 
		$matches[7] = trim( $matches[7] );
		if ( !$ftp -> ftp_chdir( dirname( $matches[7] ) ) ) {
				if ( substr( $matches[7], 0, 1 ) == "/" ) {
						$matches[7] = substr( $matches[7], 1 );
				} 
				$pathary = explode( "/", dirname( $matches[7] ) );
				foreach ( $pathary as $v ) {
						$v = trim( $v );
						if ( 0 < strlen( $v ) ) {
								if ( $ftp -> ftp_mkdir( $v ) !== false && $mode ) {
										$ftp -> ftp_chmod( $mode, $v );
								} 
								$ftp -> ftp_chdir( $v );
						} 
				} 
		} 
		$ret = $ftp -> ftp_put( basename( $matches[7] ), $from_file );
		if ( $ret && $mode ) {
				$ftp -> ftp_chmod( $mode, basename( $matches[7] ) );
		} 
		if ( $move ) {
				@unlink( $from_file );
		} 
		return $ret;
}

function saxue_delfolder( $dirname, $flag = true ) {
		$dirname = trim( $dirname );
		$matches = array();
		if ( !preg_match( "/^(ftps?):\\/\\/([^:\\/]+):([^:\\/]*)@([0-9a-z\\-\\.]+)(:(\\d+))?([0-9a-z_\\-\\/\\.]*)/is", $dirname, $matches ) ) {
				$handle = @opendir( $dirname );
				while ( ( $file = @readdir( $handle ) ) !== false ) {
						if ( $file != "." && $file != ".." ) {
								if ( is_dir( $dirname . DIRECTORY_SEPARATOR . $file ) ) {
										saxue_delfolder( $dirname . DIRECTORY_SEPARATOR . $file, true );
								} else {
										@unlink( $dirname . DIRECTORY_SEPARATOR . $file );
								} 
						} 
				} 
				@closedir( $handle );
				if ( $flag ) {
						@rmdir( $dirname );
				} 
				return true;
		} 
		include_once( SAXUE_ROOT_PATH . "/lib/util/ftp.php" );
		$ftpssl = strtolower( $matches[1] ) == "ftps" ? 1 : 0;
		$matches[6] = intval( trim( $matches[6] ) );
		$ftpport = 0 < $matches[6] ? $matches[6] : 21;
		$ftp = &saxueftp :: getinstance( $matches[4], $matches[2], $matches[3], ".", $ftpport, 0, $ftpssl );
		if ( !$ftp ) {
				return false;
		} 
		$matches[7] = trim( $matches[7] );
		return $ftp -> ftp_delfolder( $matches[7], $flag );
} 

function saxue_createdir( $_dirname, $_mode = 511 ) {
		if ( is_dir( $_dirname ) ) {
				return true;
		} 
		if ( saxue_createdir( dirname( $_dirname ), $_mode ) ) {
				$_ret = @mkdir( $_dirname, $_mode );
				if ( $_ret ) {
						@chmod( $_dirname, $_mode );
				} 
				return $_ret;
		} 
		return false;
} 

function saxue_checkdir( $_dirname, $_createdir = false ) {
		if ( is_dir( $_dirname ) ) {
				return true;
		} 
		if ( !$_createdir ) {
				return false;
		} 
		return saxue_createdir( $_dirname, 511 );
}  

function saxue_strip_nr( $string, $all = false ) {
		if ( $all ) {
				$string = str_replace( array( chr( 13 ), chr( 10 ), "\n", "\r", "\t", '  ' ), array( '', '', '', '', '', '' ), $string );
		} else {
				$string = preg_replace( array( "~>(\s+|\n|\r|\t)~", "~(\s+|\n|\r|\t)<~" ), array( ">", "<" ), $string );
		} 
		return $string;
} 

function saxue_extractvars( $_varname, &$_vars ) {
		$_extractvars_arr = "";
		if ( is_array( $_vars ) ) {
				foreach ( $_vars as $_key => $_val ) {
						if ( is_array( $_val ) ) {
								$_extractvars_arr .= saxue_extractvars( $_varname . "['" . saxue_setslashes( $_key, "\"" ) . "']", $_vars[$_key] );
						} else {
								$_extractvars_arr .= "\$" . $_varname . "['" . saxue_setslashes( $_key, "\"" ) . "'] = '" . saxue_setslashes( $_val, "\"" ) . "';\n";
						} 
				} 
				return $_extractvars_arr;
		} 
		$_extractvars_arr .= "\$" . $_varname . " = '" . saxue_setslashes( $_vars, "\"" ) . "';\n";
		return $_extractvars_arr;
} 

function saxue_setconfigs( $_fname, &$_vars, $_dir = "", $_varname = "", $_export = false ) {
		if ( !preg_match( "/^\\w*$/", $_fname ) ) {
				return false;
		} 
		$_savefile = SAXUE_DATA_PATH . "/configs";
		if ( $_dir != "" && $_dir != "system" ) {
				$_savefile .= "/" . $_dir;
		} 
		saxue_checkdir( $_savefile, true );
		$_savefile .= "/" . $_fname . ".php";
		if ( $_varname == "" ) {
				$_varname = "saxue" . ucfirst( $_fname );
		} 
		if ( $_export ) {
				$_setcontent = "<?php \$" . $_varname . " = " . saxue_strip_nr( var_export( $_vars, true ), true ) . ";";
		} else {
				$_setcontent = "<?php\n" . saxue_extractvars( $_varname, $_vars );
		} 
		return saxue_writefile( $_savefile, $_setcontent );
} 

function saxue_getconfigs( $_fname, $_dir = "", $_varname = "" ) {
		if ( !preg_match( "/^\\w*$/", $_fname ) ) {
				return false;
		} 
		if ( $_varname !== false ) {
				if ( $_varname == "" ) {
						$_varname = "saxue" . ucfirst( $_fname );
				} 
				global $$_varname;
		} 
		if ( $_dir == "" || $_dir == "system" ) {
				$file = SAXUE_DATA_PATH . "/configs/" . $_fname . ".php";
		} else {
				$file = SAXUE_DATA_PATH . "/configs/" . $_dir . "/" . $_fname . ".php";
		} 
		$file = @realpath( $file );
		if ( preg_match( "/\\.php\$/i", $file ) ) {
				include_once( $file );
				return true;
		} 
		return false;
} 

function saxue_setcachevars( $_fname, &$_vars, $_dir = "", $_varname = "", $_subdir = 0 ) {
		global $saxueCache;
		if ( empty( $_fname ) ) {
				return false;
		} 
		$_cached_file = SAXUE_CACHE_PATH . "/cachevars";
		if ( $_dir != "" ) {
				$_cached_file .= "/" . $_dir;
		} 
		if ( empty( $_subdir ) ) {
				$_cached_file .= "/" . $_fname . ".php";
		} else {
				$_subdir = intval( $_subdir );
				$_cached_file .= "/" . $_fname . saxue_getsubdir( $_subdir ) . "/" . $_subdir . ".php";
		} 
		if ( is_a( $saxueCache, "SaxueCacheMemcached" ) ) {
				return $saxueCache -> set( $_cached_file, $_vars );
		} 
		if ( $_varname == "" ) {
				$_varname = "saxue" . ucfirst( $_fname );
		} 
		$_setcontent = "<?php\n" . saxue_extractvars( $_varname, $_vars );
		return $saxueCache -> set( $_cached_file, $_setcontent );
} 

function saxue_getcachevars( $_fname, $_dir = "", $_varname = "", $_cacheid = 0 ) {
		global $saxueCache;
		if ( empty( $_fname ) ) {
				return false;
		} 
		if ( $_varname !== false ) {
				if ( $_varname == "" ) {
						$_varname = "saxue" . ucfirst( $_fname );
				} 
				global $$_varname;
		} 
		$cachefile = SAXUE_CACHE_PATH . "/cachevars";
		if ( $_dir != "" ) {
				$cachefile .= "/" . $_dir;
		} 
		if ( empty( $_cacheid ) ) {
				$cachefile .= "/" . $_fname . ".php";
		} else {
				$_cacheid = intval( $_cacheid );
				$cachefile .= "/" . $_fname . saxue_getsubdir( $_cacheid ) . "/" . $_cacheid . ".php";
		} 
		if ( is_a( $saxueCache, "SaxueCacheMemcached" ) ) {
				$$_varname = $saxueCache -> get( $cachefile );
				return true;
		} else {
				$cachefile = @realpath( $cachefile );
				if ( is_file( $cachefile ) && preg_match( "/\\.php\$/i", $cachefile ) ) {
						include_once( $cachefile );
						return true;
				} 
		} 
		return false;
} 

function saxue_getvarstr( $str = '' ) {
		global $saxueTpl;
		if ( !empty( $str ) && is_object( $saxueTpl ) ) {
				$str = preg_replace( '/{ *[\\\$]([a-zA-Z_0-9]+.*) *}/ieU', "\$saxueTpl->get_assign('\\1')", $str );
		}
		return $str;
} 

function saxue_setcookie( $var, $value = '', $time = 0 ) {
		$time = $time > 0 ? $time : ( empty( $value ) ? SAXUE_NOW_TIME - 3600 : 0 );
		$port = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		$key = md5( SAXUE_COOKIE_DOMAIN . '_' . $var );
		header( 'P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"' );
		return setcookie( $key, $value, $time, '/', SAXUE_COOKIE_DOMAIN, $port );
} 

function saxue_getcookie( $var ) {
		$key = md5( SAXUE_COOKIE_DOMAIN . '_' . $var );
		return isset( $_COOKIE[$key] ) ? $_COOKIE[$key] : '';
} 

function saxue_dround( $var, $precision = 2, $sprinft = false ) {
		$var = round( floatval( $var ), $precision );
		if ( $sprinft ) $var = sprintf( '%.' . $precision . 'f', $var );
		return $var;
}  
// 时区和初始时间设置
if ( function_exists( 'date_default_timezone_set' ) ) date_default_timezone_set( 'Etc/GMT-8' );
$tmpvar = explode( " ", microtime() );
define( "SAXUE_START_TIME", $tmpvar[1] + $tmpvar[0] );
// 框架目录设置
$GLOBALS['_SERVER']['PHP_SELF'] = htmlspecialchars( $_SERVER['PHP_SELF'], ENT_QUOTES );
if ( !defined( "SAXUE_ROOT_PATH" ) ) {
		define( "SAXUE_ROOT_PATH", @str_replace( array( "\\\\", "\\" ), "/", @dirname( __FILE__ ) ) );
}
// WEB目录设置
if ( !defined( "SAXUE_WEB_PATH" ) ) {
		define( "SAXUE_WEB_PATH", SAXUE_ROOT_PATH );
} 
// DATA目录设置
define( "SAXUE_DATA_PATH", SAXUE_ROOT_PATH . '/data' );
// 引入系统参数
include SAXUE_DATA_PATH . '/configs/db.php';
include SAXUE_DATA_PATH . '/configs/define.php';
// 定义系统常量
define( "SAXUE_VERSION", '1.0' );
define( "SAXUE_SYSTEM_CHARSET", 'utf-8' );
define( "SAXUE_CORE_INCLUDE", true );
define( "SAXUE_NOW_TIME", time() );
define( "SAXUE_ERROR_RETURN", 1 );
define( "SAXUE_ERROR_PRINT", 2 );
define( "SAXUE_ERROR_DIE", 4 );
define( "SAXUE_TYPE_TXTBOX", 1 );
define( "SAXUE_TYPE_TXTAREA", 2 );
define( "SAXUE_TYPE_INT", 3 );
define( "SAXUE_TYPE_NUM", 4 );
define( "SAXUE_TYPE_PASSWORD", 5 );
define( "SAXUE_TYPE_HIDDEN", 6 );
define( "SAXUE_TYPE_SELECT", 7 );
define( "SAXUE_TYPE_MULSELECT", 8 );
define( "SAXUE_TYPE_RADIO", 9 );
define( "SAXUE_TYPE_CHECKBOX", 10 );
define( "SAXUE_TYPE_LABEL", 11 );
define( "SAXUE_TYPE_FILE", 12 );
define( "SAXUE_TYPE_DATE", 13 );
define( "SAXUE_TYPE_UBB", 14 );
define( "SAXUE_TYPE_HTML", 15 );
define( "SAXUE_TYPE_CODE", 16 );
define( "SAXUE_TYPE_SCRIPT", 17 );
define( "SAXUE_TYPE_OTHER", 20 );
define( "SAXUE_CONTENT_TXT", 0 );
define( "SAXUE_CONTENT_HTML", 1 );
define( "SAXUE_CONTENT_JS", 2 );
define( "SAXUE_CONTENT_MIX", 3 );
define( "SAXUE_CONTENT_PHP", 4 );
@set_magic_quotes_runtime( 0 );
// 错误显示设置
if ( SAXUE_ERROR_MODE == 0 ) {
		@ini_set( "display_errors", 0 );
		@error_reporting( 0 );
} else if ( SAXUE_ERROR_MODE == 1 ) {
		@ini_set( "display_errors", 1 );
		@error_reporting( E_ALL & ~E_NOTICE );
} else if ( SAXUE_ERROR_MODE == 2 ) {
		@ini_set( "display_errors", 1 );
		@error_reporting( E_ALL );
} 
// COOKIE有效域名
if ( !defined( "SAXUE_COOKIE_DOMAIN" ) ) {
		define( "SAXUE_COOKIE_DOMAIN", strval( @ini_get( "session.cookie_domain" ) ) );
} else if ( SAXUE_COOKIE_DOMAIN != "" ) {
		@ini_set( "session.cookie_domain", SAXUE_COOKIE_DOMAIN );
} 
// 后台访问URL设置
if ( !defined( "SAXUE_ADMIN_DIR" ) || SAXUE_ADMIN_DIR == '' ) {
		define( 'SAXUE_ADMIN_PATH', SAXUE_WEB_PATH . "/admin" );
		define( 'SAXUE_ADMIN_URL', SAXUE_URL . "/admin" );
} else {
		define( 'SAXUE_ADMIN_PATH', SAXUE_WEB_PATH . "/" . SAXUE_ADMIN_DIR );
		define( 'SAXUE_ADMIN_URL', SAXUE_URL . "/" . SAXUE_ADMIN_DIR );
} 
// 风格文件服务器设置
if ( !defined( "SAXUE_SKIN_SERVERSET" ) || SAXUE_SKIN_SERVERSET == '' ) {
		define( "SAXUE_SKIN_SERVER", SAXUE_URL . '/public' );
} else {
		define( "SAXUE_SKIN_SERVER", SAXUE_SKIN_SERVERSET );
}
// 缓存设置
if ( SAXUE_ENABLE_CACHE ) {
		define( "SAXUE_USE_CACHE", true );
} else {
		define( "SAXUE_USE_CACHE", false );
}  
// 缓存目录设置
if ( !defined( "SAXUE_CACHE_DIR" ) || SAXUE_CACHE_DIR == "" || strtolower( substr( trim( SAXUE_CACHE_DIR ), 0, 12 ) ) == 'memcached://' ) {
		$tmpvar = SAXUE_DATA_PATH . '/cache';
} else if ( strpos( SAXUE_CACHE_DIR, '/' ) === false && strpos( SAXUE_CACHE_DIR, '\\' ) === false ) {
		$tmpvar = SAXUE_DATA_PATH . '/' . SAXUE_CACHE_DIR;
} else if ( substr( SAXUE_CACHE_DIR, 0, 1 ) === '/' ) {
		$tmpvar = SAXUE_ROOT_PATH . SAXUE_CACHE_DIR;
} else {
		$tmpvar = SAXUE_CACHE_DIR;
} 
if ( !is_dir( $tmpvar ) ) {
		saxue_createdir( $tmpvar );
} 
define( "SAXUE_CACHE_PATH", $tmpvar );
// 编译文件目录设置
if ( !defined( "SAXUE_COMPILED_DIR" ) || SAXUE_COMPILED_DIR == "" ) {
		define( "SAXUE_COMPILED_PATH", SAXUE_DATA_PATH . '/compiled' );
} else if ( strpos( SAXUE_COMPILED_DIR, '/' ) === false && strpos( SAXUE_COMPILED_DIR, '\\' ) === false ) {
		define( "SAXUE_COMPILED_PATH", SAXUE_DATA_PATH . '/' . SAXUE_COMPILED_DIR );
} else if ( substr( SAXUE_COMPILED_DIR, 0, 1 ) === '/' ) {
		define( "SAXUE_COMPILED_PATH", SAXUE_ROOT_PATH  . SAXUE_COMPILED_DIR );
} else {
		define( "SAXUE_COMPILED_PATH", SAXUE_COMPILED_DIR );
} 
// GZIP压缩设置
if ( SAXUE_USE_GZIP && !@ini_get( "zlib.output_compression" ) ) {
		@ob_start( "ob_gzhandler" );
} 
// SESSION相关设置
if ( isset( $_COOKIE[session_name()] ) && strlen( $_COOKIE[session_name()] ) < 16 ) {
		unset( $_COOKIE[session_name()] );
} 
if ( !empty( $_COOKIE[session_name()] ) || defined( "SAXUE_NEED_SESSION" ) ) {
		if ( 0 < SAXUE_SESSION_EXPRIE ) {
				@ini_set( "session.gc_maxlifetime", SAXUE_SESSION_EXPRIE );
		} 
		@session_cache_limiter( "private, must-revalidate" );
		if ( SAXUE_SESSION_STORAGE == 'db' ) {
				include_once( SAXUE_ROOT_PATH . '/common/session.php' );
				$sess_handler = &saxuesessionhandler :: getinstance( "SaxueSessionHandler" );
				@session_set_save_handler( @array( $sess_handler, "open" ), @array( $sess_handler, "close" ), @array( $sess_handler, "read" ), @array( $sess_handler, "write" ), @array( $sess_handler, "destroy" ), @array( $sess_handler, "gc" ) );
		} else if ( SAXUE_SESSION_SAVEPATH != "" && is_dir( SAXUE_SESSION_SAVEPATH ) ) {
				session_save_path( SAXUE_SESSION_SAVEPATH );
		} 
		if ( !empty( $_COOKIE[session_name()] ) ) {
				session_id( $_COOKIE[session_name()] );
		} 
		@session_start();
} 
// PATH_INFO解析
if ( isset( $_SERVER['PATH_INFO'] ) && defined( "SAXUE_PATH_INFO" ) && 0 < SAXUE_PATH_INFO ) {
		$tmpary = explode( "/", str_replace( array( "'", "\"", ".htm", ".html" ), "", substr( $_SERVER['PATH_INFO'], 1 ) ) );
		$tmpcot = count( $tmpary );
		for ( $i = 0; $i < $tmpcot; $i += 2 ) {
				if ( !isset( $tmpary[$i + 1] ) && is_numeric( $tmpary[$i] ) ) {
						$GLOBALS['_GET'][$tmpary[$i]] = $tmpary[$i + 1];
						$GLOBALS['_REQUEST'][$tmpary[$i]] = $tmpary[$i + 1];
				} 
		} 
} 
// 变量处理
$magic_quotes_gpc = get_magic_quotes_gpc();
$register_globals = @ini_get( "register_globals" );
if ( $magic_quotes_gpc ) {
		$GLOBALS['_GET'] = saxue_funtoarray( "stripslashes", $_GET );
		$GLOBALS['_POST'] = saxue_funtoarray( "stripslashes", $_POST );
		$GLOBALS['_COOKIE'] = saxue_funtoarray( "stripslashes", $_COOKIE );
} 
if ( $magic_quotes_gpc || !empty( $_REQUEST['ajax_request'] ) ) {
		$GLOBALS['_REQUEST'] = array_merge( $_REQUEST, $_GET, $_POST, $_COOKIE );
} 
// 列表最大页处理
if ( defined( "SAXUE_MAX_PAGES" ) && 0 < SAXUE_MAX_PAGES && is_numeric( $_REQUEST['page'] ) && SAXUE_MAX_PAGES < $_REQUEST['page'] ) {
		$GLOBALS['_REQUEST']['page'] = intval( SAXUE_MAX_PAGES );
} 
// 定义缓存对象
$saxueCache = &saxue_initcache();
// 网站访问限制处理
if ( defined( "SAXUE_IS_OPEN" ) && SAXUE_IS_OPEN == 0 && empty( $_SESSION['saxueAdminId'] ) ) {
		header( "Content-type:text/html;charset=" . SAXUE_SYSTEM_CHARSET );
		echo nl2br( SAXUE_CLOSE_INFO );
		saxue_freeresource();
		exit();
} 
if ( defined( "SAXUE_IS_OPEN" ) && SAXUE_IS_OPEN == 2 && empty( $_SESSION['saxueAdminId'] ) && 0 < count( $_POST ) ) {
		header( "Content-type:text/html;charset=" . SAXUE_SYSTEM_CHARSET );
		echo LANG_DENY_POST;
		saxue_freeresource();
		exit();
} 
if ( defined( "SAXUE_PROXY_DENIED" ) && SAXUE_PROXY_DENIED != 1 && ( $_SERVER['HTTP_X_FORWARDED_FOR'] || $_SERVER['HTTP_VIA'] || $_SERVER['HTTP_PROXY_CONNECTION'] || $_SERVER['HTTP_USER_AGENT_VIA'] || $_SERVER['HTTP_PROXY_CONNECTION'] ) ) {
		header( "Content-type:text/html;charset=" . SAXUE_SYSTEM_CHARSET );
		echo LANG_DENY_PROXY;
		saxue_freeresource();
		exit();
}
// 多语言缓存文件
include SAXUE_DATA_PATH . '/configs/language.php';
// 插件处理
saxue_getconfigs( 'plugin' );
$saxuepluginmanager = new saxuepluginmanager();
$saxuepluginmanager -> trigger( 'global' );