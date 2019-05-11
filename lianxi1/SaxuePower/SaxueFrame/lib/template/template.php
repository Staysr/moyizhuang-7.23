<?php
class saxuetpl {
		var $template_dir = "templates";
		var $compile_dir = "compiled";
		var $compile_check = true;
		var $force_compile = false;
		var $caching = 0;
		var $cache_type = 0;
		var $cache_dir = "cache";
		var $cache_lifetime = 3600;
		var $cache_overtime = 0;
		var $left_delimiter = "{\\?";
		var $right_delimiter = "\\?}";
		var $left_comments = "{\\*";
		var $right_comments = "\\*}";
		var $compile_id = null;
		var $_tpl_vars = array();
		var $_tmp_vars = array();
		var $_file_perms = 511;
		var $_dir_perms = 511;
		var $_compile_prefix = ".php";
		var $_include_prefix = ".inc.php";

		function saxuetpl() {
				$this -> template_dir = SAXUE_THEME_PATH;
				$this -> cache_dir = SAXUE_CACHE_PATH;
				$this -> compile_dir = SAXUE_COMPILED_PATH;
				if ( SAXUE_USE_CACHE ) {
						$this -> caching = 1;
				} else {
						$this -> caching = 0;
				} 
				$this -> cache_lifetime = SAXUE_CACHE_LIFETIME;
				$this -> assign( array( 
						"saxue_url" => SAXUE_URL,
						"saxue_admin_url" => SAXUE_ADMIN_URL,
						"saxue_skin_server" => SAXUE_SKIN_SERVER,
						"saxue_sitename" => SAXUE_SITE_NAME,
						"saxue_charset" => SAXUE_SYSTEM_CHARSET,
						"saxue_version" => SAXUE_VERSION,
						"saxue_time" => SAXUE_NOW_TIME,
						"fun" => null 
				) );
				if ( isset( $_SESSION ) ) {
						$this -> assign( "saxue_sessid", @session_id() );
				} 
		} 

		function &getinstance() {
				static $instance;
				if ( !isset( $_instance ) ) {
						$instance = new saxuetpl();
				} 
				return $instance;
		} 

		function getcachtype() {
				return $this -> cache_type;
		} 

		function setcachtype( $_num = 0 ) {
				$this -> cache_type = ( integer )$_num;
		} 

		function getcaching() {
				return $this -> caching;
		} 

		function setcaching( $_num = 0 ) {
				$this -> caching = ( integer )$_num;
		} 

		function getcachetime() {
				return $this -> cache_lifetime;
		} 

		function setcachetime( $_num = 0 ) {
				$this -> cache_lifetime = ( integer )$_num;
		} 

		function getovertime() {
				return $this -> cache_overtime;
		} 

		function setovertime( $_num = 0 ) {
				$this -> cache_overtime = ( integer )$_num;
		} 

		function assign( $_tpl_vals, $_value = null ) {
				if ( is_array( $_tpl_vals ) ) {
						foreach ( $_tpl_vals as $_key => $_val ) {
								if ( $_key != "" ) {
										$this -> _tpl_vars[$_key] = $_val;
								} 
						} 
				} else if ( $_tpl_vals != "" ) {
						$this -> _tpl_vars[$_tpl_vals] = $_value;
				} 
		} 

		function assign_by_ref( $_tpl_vals, &$_value ) {
				if ( $_tpl_vals != "" ) {
						$this -> _tpl_vars[$_tpl_vals] = &$_value;
				} 
		} 

		function clear_assign( $_tpl_vals ) {
				if ( is_array( $_tpl_vals ) ) {
						foreach ( $_tpl_vals as $_tpl_val ) {
								unset( $this -> $this -> _tpl_vars -> $_tpl_val );
						} 
				} else {
						unset( $this -> $this -> _tpl_vars -> $_tpl_vals );
				} 
		} 

		function clear_all_assign() {
				$this -> _tpl_vars = array();
		} 

		function get_assign( $_tmpname ) {
				$_arrtmpname = explode( ".", $_tmpname );
				$_ret = false;
				$_isbase = true;
				foreach ( $_arrtmpname as $_key ) {
						if ( $_isbase ) {
								$_ret = $this -> _tpl_vars[$_key];
						} else {
								$_ret = $_ret[$_key];
						} 
						$_isbase = false;
				} 
				return $_ret;
		} 

		function get_all_assign() {
				return $this -> _tpl_vars;
		} 

		function set_all_assign( $_vars ) {
				$this -> _tpl_vars = $_vars;
		} 

		function clear_cache( $_resource_name = null, $_cache_id = null, $_compile_id = null ) {
				global $saxueCache;
				if ( !isset( $_compile_id ) ) {
						$_compile_id = $this -> compile_id;
				} 
				if ( !isset( $_resource_name ) ) {
						$_compile_id = null;
				} 
				$_auto_id = $this -> _get_auto_id( $_cache_id, $_compile_id );
				$_cache_file = $this -> _get_auto_filename( $this -> cache_dir, $_resource_name, $_auto_id );
				$saxueCache -> delete( $_cache_file );
		} 

		function clear_all_cache() {
				global $saxueCache;
				$saxueCache -> clear();
		} 

		function is_cached( $_resource_name, $_cache_id = null, $_compile_id = null, $_cache_time = null, $_over_time = null, $_return_value = false ) {
				global $saxueCache;
				if ( !SAXUE_USE_CACHE ) {
						return false;
				} 
				if ( $this -> force_compile ) {
						return false;
				} 
				if ( !isset( $_compile_id ) ) {
						$_compile_id = $this -> compile_id;
				} 
				$_auto_id = $this -> _get_auto_id( $_cache_id, $_compile_id );
				$_cache_file = $this -> _get_auto_filename( $this -> cache_dir, $_resource_name, $_auto_id );
				if ( is_null( $_cache_time ) ) {
						$_cache_time = $this -> cache_lifetime;
				} 
				if ( is_null( $_over_time ) ) {
						$_over_time = $this -> cache_overtime;
				} 
				if ( empty( $_over_time ) && file_exists( $_resource_name ) ) {
						$_over_time = filemtime( $_resource_name );
				} 
				if ( !$_return_value ) {
						return $saxueCache -> iscached( $_cache_file, $_cache_time, $_over_time );
				} 
				$_cache_data = $saxueCache -> get( $_cache_file, $cache_time, $over_time );
				if ( $this -> cache_type == 1 && $_cache_data != false ) {
						@eval( "\$_temp_vars = " . @trim( $_cache_data ) . ";" );
						if ( is_array( $_temp_vars ) ) {
								foreach ( $_temp_vars as $k => $v ) {
										if ( isset( $this -> _tpl_vars[$k] ) ) {
												$this -> _tpl_vars[$k] = $v;
										} 
								} 
						} 
						unset( $_temp_vars );
				} 
				return $_cache_data;
		} 

		function get_cachekey( $_resource_name, $_cache_id = null, $_compile_id = null ) {
				return $this -> _get_auto_filename( $this -> cache_dir, $_resource_name, $this -> _get_auto_id( $_cache_id, $_compile_id ) );
		} 

		function get_cachedtime( $_resource_name, $_cache_id = null, $_compile_id = null ) {
				global $saxueCache;
				$_cached_file = $this -> _get_auto_filename( $this -> cache_dir, $_resource_name, $this -> _get_auto_id( $_cache_id, $_compile_id ) );
				return $saxueCache -> cachedtime( $_cached_file );
		} 

		function update_cachedtime( $_resource_name, $_cache_id = null, $_compile_id = null ) {
				global $saxueCache;
				$_cached_file = $this -> _get_auto_filename( $this -> cache_dir, $_resource_name, $this -> _get_auto_id( $_cache_id, $_compile_id ) );
				return $saxueCache -> uptime( $_cached_file );
		} 

		function clear_compiled_tpl( $_resource_name = null, $_compile_id = null ) {
				if ( !isset( $_compile_id ) ) {
						$_compile_id = $this -> compile_id;
				} 
				$_cache_file = $this -> _get_auto_filename( $this -> compile_dir, $_resource_name, $_compile_id );
				@unlink( $_cache_file . ".php" );
				@unlink( $_cache_file . ".inc.php" );
		} 

		function template_exists( $_resource_name ) {
				return is_file( $_resource_name );
		} 

		function &get_template_vars( $_name = null ) {
				if ( !isset( $_name ) ) {
						return $this -> _tpl_vars;
				} 
				if ( isset( $this -> _tpl_vars[$_name] ) ) {
						return $this -> _tpl_vars[$_name];
				} 
		} 

		function get_compiled_inc( $_compiled_file, $_compile_id = null ) {
				$_compiled_dir = dirname( $_compiled_file );
				if ( empty( $_compiled_dir ) || $_compiled_dir == "." ) {
						$_compiled_file = $this -> template_dir . "/" . $_compiled_file;
				} 
				if ( !isset( $_compile_id ) ) {
						$_compile_id = $this -> compile_id;
				} 
				$_compiled_path = $this -> _get_compile_path( $_compiled_file );
				if ( $this -> _is_compiled( $_compiled_file, $_compiled_path ) || $this -> _compile_resource( $_compiled_file, $_compiled_path ) ) {
						$_compiled_inc = $_compiled_path . $this -> _include_prefix;
						if ( is_file( $_compiled_inc ) ) {
								return $_compiled_inc;
						} 
						return false;
				} 
		} 

		function include_compiled_inc( $resource_name, $compile_id = null ) {
				$incfile = $this -> get_compiled_inc( $resource_name, $compile_id );
				if ( !empty( $incfile ) ) {
						include_once( $incfile );
				} 
		} 

		function display( $_compiled_file, $_cache_id = null, $_compile_id = null, $_cache_time = null, $_over_time = null ) {
				$this -> fetch( $_compiled_file, $_cache_id, $_compile_id, $_cache_time, $_over_time, true );
		} 

		function fetch( $resource_name, $cache_id = null, $compile_id = null, $cache_time = null, $over_time = null, $display = false ) {
				global $saxueCache;
				$resource_dir = dirname( $resource_name );
				if ( empty( $resource_dir ) || $resource_dir == "." ) {
						$resource_name = $this -> template_dir . "/" . $resource_name;
				} 
				if ( !isset( $compile_id ) ) {
						$compile_id = $this -> compile_id;
				} 
				$_template_compile_path = $this -> _get_compile_path( $resource_name );
				if ( is_null( $cache_time ) ) {
						$cache_time = $this -> cache_lifetime;
				} 
				if ( is_null( $over_time ) ) {
						$over_time = $this -> cache_overtime;
				} 
				$save_cachevars = false;
				if ( $this -> caching == 1 ) {
						if ( $this -> cache_type == 1 ) {
								if ( $this -> is_cached( $resource_name, $cache_id, $compile_id, $cache_time, $over_time, true ) !== false ) {
										$save_cachevars = true;
								} 
						} else {
								$_template_results = $this -> is_cached( $resource_name, $cache_id, $compile_id, $cache_time, $over_time, true );
								if ( false !== $_template_results ) {
										$this -> include_compiled_inc( $resource_name, $compile_id );
										if ( $display ) {
												echo $_template_results;
												return true;
										} 
										return $_template_results;
								} 
								if ( $display ) {
										header( "Last-Modified: " . date( "D, d M Y H:i:s", SAXUE_NOW_TIME ) . " GMT" );
								} 
						} 
				} else if ( 0 < $this -> caching && $this -> cache_type == 1 ) {
						$save_cachevars = $this -> is_cached( $resource_name, $cache_id, $compile_id, $cache_time, $over_time, false );
				} 
				ob_start();
				if ( $this -> _is_compiled( $resource_name, $_template_compile_path ) || $this -> _compile_resource( $resource_name, $_template_compile_path ) ) {
						include( $_template_compile_path . $this -> _compile_prefix );
				} 
				if ( !defined( "SAXUE_COMPRESS_MODE" ) || SAXUE_COMPRESS_MODE == 0 ) {
						$_template_results = ob_get_contents();
				} elseif ( SAXUE_COMPRESS_MODE == 1 ) {
						$_template_results = saxue_strip_nr( ob_get_contents() );
				} else {
						$_template_results = saxue_strip_nr( ob_get_contents(), true );
				}
				ob_end_clean();
				if ( 0 < $this -> caching ) {
						$_auto_id = $this -> _get_auto_id( $cache_id, $compile_id );
						$_cache_file = $this -> _get_auto_filename( $this -> cache_dir, $resource_name, $_auto_id );
						if ( $this -> cache_type == 1 ) {
								if ( $save_cachevars ) {
										$_template_vars = var_export( $this -> _tpl_vars, true );
										$saxueCache -> set( $_cache_file, $_template_vars, $cache_time, $over_time );
								} 
						} else {
								$saxueCache -> set( $_cache_file, $_template_results, $cache_time, $over_time );
						} 
				} 
				if ( $display ) {
						if ( isset( $_template_results ) ) {
								echo $_template_results;
						} 
						return true;
				} 
				if ( isset( $_template_results ) ) {
						return $_template_results;
				} 
		} 

		function parse_string( $str, $retcode = false ) {
				include_once( TEMPLATE_DIR . "compiler.php" );
				$template_compiler = &saxuecompiler :: getinstance();
				$template_compiler -> _init_template_vars( $this );
				$compiled_content = $template_compiler -> _compile_file( $str, false );
				if ( $retcode ) {
						return $compiled_content;
				} 
				ob_start();
				eval( $compiled_content );
				$results = ob_get_contents();
				ob_end_clean();
				return $results;
		} 

		function _is_compiled( $_compiled_file, $_compiled_name ) {
				$_compiled_name .= $this -> _compile_prefix;
				if ( !$this -> force_compile || file_exists( $_compiled_name ) ) {
						if ( !$this -> compile_check ) {
								return true;
						} 
						if ( !is_file( $_compiled_file ) ) {
								return false;
						} 
						if ( filemtime( $_compiled_file ) <= filemtime( $_compiled_name ) ) {
								return true;
						} 
						return false;
				} 
				return false;
		} 

		function _compile_resource( $_compiled_file, $_compiled_name ) {
				if ( !is_file( $_compiled_file ) ) {
						echo "Template file (" . str_replace( SAXUE_ROOT_PATH, "", $_compiled_file ) . ") is not exists!";
						return false;
				} 
				$_compiled_cache_time = filemtime( $_compiled_file );
				$this -> _compile_source( $_compiled_file, $_compiled_content, $_compiled_include );
				$_compiled_cache_file = $_compiled_name . $this -> _compile_prefix;
				if ( saxue_checkdir( dirname( $_compiled_cache_file ), true ) ) {
						$_ret = saxue_writefile( $_compiled_cache_file, $_compiled_content );
						if ( $_ret && $_compiled_cache_time ) {
								@touch( $_compiled_cache_file, $_compiled_cache_time );
						} 
				} 
				if ( 0 < strlen( $_compiled_include ) ) {
						$_compiled_inc_file = $_compiled_name . $this -> _include_prefix;
						if ( saxue_checkdir( dirname( $_compiled_inc_file ), true ) ) {
								$_ret_inc = saxue_writefile( $_compiled_inc_file, $_compiled_include );
								if ( $_ret_inc && $_compiled_cache_time ) {
										@touch( $_compiled_inc_file, $_compiled_cache_time );
								} 
						} 
				} else {
						$this -> _unlink( $_compiled_name . $this -> _include_prefix );
				} 
				if ( $_ret && $_compiled_cache_time ) {
						@clearstatcache();
				} 
				return $_ret;
		} 

		function _compile_source( $resource_name, &$compiled_content, &$compiled_include ) {
				include_once( TEMPLATE_DIR . "compiler.php" );
				$template_compiler = &saxuecompiler :: getinstance();
				$template_compiler -> _init_template_vars( $this );
				$compiled_content = "<?php\r\n" . $template_compiler -> _compile_file( $resource_name ) . "\r\n?>";
				$compiled_include = strlen( $template_compiler -> tplinc ) == "" ? "" : "<?php\r\n" . $template_compiler -> tplinc . "\r\n?>";
				return true;
		} 

		function _get_compile_path( $_compiled_file ) {
				return $this -> _get_auto_filename( $this -> compile_dir, $_compiled_file, $this -> compile_id );
		} 

		function _get_auto_filename( $_compile_dir, $_file_resource = null, $_file_id = null ) {
				$_file_basename = basename( $_file_resource );
				$_file_dir = dirname( $_file_resource );
				$_auto_filename = str_replace( SAXUE_ROOT_PATH, $_compile_dir, $_file_dir );
				// 新增兼容前后台模版不再同一目录
				if ( $_auto_filename == $_file_dir ) $_auto_filename = str_replace( SAXUE_WEB_PATH, $_compile_dir, $_file_dir );
				if ( $_auto_filename == $_file_dir ) {
						$_file_dir = trim( str_replace( array( "\\", ":" ), array( "/", "" ), $_file_dir ) );
						if ( $_file_dir[0] != "/" ) {
								$_auto_filename = $_compile_dir . "/" . $_file_dir;
						} else {
								$_auto_filename = $_compile_dir . $_file_dir;
						} 
				} 
				if ( isset( $_file_id ) && 0 < strlen( $_file_id ) ) {
						$_auto_filename .= "/" . $_file_basename;
						if ( is_numeric( $_file_id ) ) {
								$_auto_filename .= saxue_getsubdir( intval( $_file_id ) ) . "/" . $_file_id;
						} else if ( preg_match( "/^[\w\/\|]+\$/", $_file_id ) ) {
								if ( preg_match( "/^[\w][\w\/\|]*[\w]\$/", $_file_id ) ) {
										$_auto_filename .= "/" . str_replace( "|", "-", $_file_id );
								} else {
										$_auto_filename .= "/" . str_replace( array( "/", "|" ), array( "-", "-" ), $_file_id );
								}
						} else {
								$_auto_filename .= "/" . md5( $_file_id );
						} 
						$_auto_filename .= strrchr( $_file_basename, "." );
						return $_auto_filename;
				} 
				$_auto_filename .= "/" . $_file_basename;
				return $_auto_filename;
		} 

		function _get_auto_id( $_cache_id = null, $_compile_id = null ) {
				if ( isset( $_cache_id ) || isset( $_compile_id ) ) {
						if ( isset( $_cache_id, $_compile_id ) ) {
								return $_cache_id . "|" . $_compile_id;
						} 
						return $_cache_id;
				} 
				if ( isset( $_compile_id ) ) {
						return $_compile_id;
				} 
				return null;
		} 

		function _unlink( $_unlink_file, $_unlink_life = null ) {
				if ( !is_file( $_unlink_file ) ) return;
				if ( isset( $_unlink_life ) ) {
						if ( $_unlink_life <= SAXUE_NOW_TIME - @filemtime( $_unlink_file ) ) {
								return unlink( $_unlink_file );
						} 
				} else {
						return unlink( $_unlink_file );
				} 
		} 

		function _template_include( $params ) {
				$this -> _tpl_vars = array_merge( $this -> _tpl_vars, $params['template_include_vars'] );
				$params['template_include_tpl_file'] = trim( $params['template_include_tpl_file'] );
				if ( $params['template_include_tpl_file'][0] != "/" && $params['template_include_tpl_file'][1] != ":" ) {
						$params['template_include_tpl_file'] = $this -> template_dir . "/" . $params['template_include_tpl_file'];
				} else {
						$params['template_include_tpl_file'] = SAXUE_ROOT_PATH . $params['template_include_tpl_file'];
				} 
				$_template_compile_path = $this -> _get_compile_path( $params['template_include_tpl_file'] );
				if ( $this -> _is_compiled( $params['template_include_tpl_file'], $_template_compile_path ) || $this -> _compile_resource( $params['template_include_tpl_file'], $_template_compile_path ) ) {
						include( $_template_compile_path . $this -> _compile_prefix );
				} 
		} 
} 

function cutstr( $_str, $_length = 10, $_ellipsis = "", $_format = 1 ) {
		$_start = 0;
		if ( $_format && ( strpos( $_str, "<" ) !== false || strpos( $_str, "&" ) !== false ) ) {
				$_length -= strlen( $_ellipsis );
				$_len = strlen( $_str );
				$_ret = "";
				$_i = 0;
				$_j = 0;
				$A = 0;
				$_tmp_str = "";
				$_format_mode = 1;
				$_utf8 = SAXUE_SYSTEM_CHARSET == "utf-8" ? true : false;
				while ( $_i < $_len && $A < $_length ) {
						$_l1 = 1;
						$_l2 = 1;
						if ( $_str[$_i] == "<" ) {
								$_format_mode = 1;
						} else if ( $_str[$_i] == "&" ) {
								$_format_mode = 2;
						} 
						if ( 0 < $_format_mode ) {
								$_tmp_str .= $_str[$_i];
								if ( ( $_format_mode == 1 && $_str[$_i] == ">" ) || ( $_format_mode == 2 && $_str[$_i] == ";" ) ) {
										if ( $_start <= $_j ) {
												$_ret .= $_tmp_str;
										} 
										$_format_mode = 0;
										$_tmp_str = "";
								} 
						} else {
								$_ord = ord( $_str[$_i] );
								if ( 128 < $_ord ) {
										if ( !$_utf8 ) {
												$_l1 = 2;
												$_l2 = 2;
										} else if ( 192 <= $_ord && $_ord <= 223 ) {
												$_l1 = 2;
												$_l2 = 2;
										} else if ( 224 <= $_ord && $_ord <= 239 ) {
												$_l1 = 3;
												$_l2 = 2;
										} else if ( 240 <= $_ord && $_ord <= 247 ) {
												$_l1 = 4;
												$_l2 = 2;
										} 
								} 
								if ( $_start <= $_j ) {
										$_ret .= substr( $_str, $_i, $_l1 );
										$A += $_l2;
								} 
						} 
						$_i += $_l1;
						$_j += $_l2;
				} 
				if ( $_i < $_len ) {
						$_ret .= $_ellipsis;
				} 
				return $_ret;
		} 
		return saxue_substr( $_str, $_start, $_length, $_ellipsis );
} 

function arithmetic( $str, $opt = "", $val = 0, $front = 0 ) {
		$optary = array( "+", "-", "*", "/", "%" );
		if ( is_numeric( $str ) && is_numeric( $val ) && in_array( $opt, $optary ) ) {
				if ( !$front ) {
						eval( "\$ret = \$str " . $opt . " \$val;" );
						return $ret;
				} 
				eval( "\$ret = \$val " . $opt . " \$str;" );
				return $ret;
		} 
		return $str;
} 

function subdirectory( $_id ) {
		return saxue_getsubdir( $_id );
} 

function defaultval( $_str, $_val ) {
		if ( !isset( $_str, $_str ) || ( is_array( $_str ) && count( $_str ) == 0 ) ) {
				$_str = $_val;
		} 
		return $_str;
} 

function saxue_banner( $id ) {
		include_once SAXUE_ROOT_PATH . "/common/banner.php";
		return get_banner( $id );
}

function saxue_get_block( $blockconfig, $retflag = 0 ) {
		global $saxueTpl;
		global $saxueCache;
		if ( !is_object( $saxueTpl ) ) {
				include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
				$saxueTpl = &saxuetpl :: getinstance();
		}
		$blockret = array();
		if ( 'BlockSystemCustom' == $blockconfig['classname'] ) {
				$blockfile = SAXUE_ROOT_PATH . "/blocks/block_custom.php";
				$blockconfig['custom'] = 1;
				$blockconfig['contenttype'] = SAXUE_CONTENT_HTML;
				$blockconfig['hasvars'] = 0;
		} elseif ( 'BlockSystemSql' == $blockconfig['classname'] ) {
				$blockfile = SAXUE_ROOT_PATH . "/blocks/block_sql.php";
				$blockconfig['custom'] = 0;
				$blockconfig['contenttype'] = SAXUE_CONTENT_PHP;
				$blockconfig['hasvars'] = 1;
		} else {
				$blockfile = SAXUE_ROOT_PATH . "/blocks/" . trim( $blockconfig['filename'] ) . ".php";
				$blockconfig['custom'] = 0;
				$blockconfig['contenttype'] = SAXUE_CONTENT_PHP;
				$blockconfig['hasvars'] = 1;
		} 
		$usecache = false;
		if ( $blockconfig['contenttype'] != SAXUE_CONTENT_PHP && empty( $blockconfig['hasvars'] ) ) {
				if ( 0 < $blockconfig['custom'] ) {
						$templatefile = empty( $blockconfig['bid'] ) ? $blockconfig['filename'] . ".html" : "block_custom" . $blockconfig['bid'] . ".html";
				} else {
						$templatefile = empty( $blockconfig['template'] ) ? $blockconfig['filename'] . ".html" : $blockconfig['template'];
				} 
				$templatefile = SAXUE_THEME_PATH . "/blocks/" . $templatefile;
				$cachefile = str_replace( SAXUE_ROOT_PATH, SAXUE_CACHE_PATH, $templatefile );
				if ( $saxueCache -> iscached( $cachefile ) ) {
						$usecache = true;
				} 
		} 
		if ( $usecache ) {
				$blockret = array( "title" => $blockconfig['title'], "content" => $saxueCache -> get( $cachefile ) );
		} else {
				$blockfile = @realpath( $blockfile );
				if ( is_file( $blockfile ) && preg_match( "/blocks[\\/\\\\]block_\\w+\\.php\$/i", $blockfile ) ) {
						$tpl_bak_vars = $saxueTpl -> get_all_assign();
						$tpl_bak_caching = $saxueTpl -> getcaching();
						$tpl_bak_cachetime = $saxueTpl -> getcachetime();
						$tpl_bak_overtime = $saxueTpl -> getovertime();
						include_once( $blockfile );
						$saxueBlock = new $blockconfig['classname']( $blockconfig );
						$blockret = array( "title" => $saxueBlock -> gettitle(), "content" => $saxueBlock -> getcontent() );
						$saxueTpl -> set_all_assign( $tpl_bak_vars );
						$saxueTpl -> setcaching( $tpl_bak_caching );
						$saxueTpl -> setcachetime( $tpl_bak_cachetime );
						$saxueTpl -> setovertime( $tpl_bak_overtime );
				} else {
						return false;
				} 
		} 
		if ( $retflag == 1 ) {
				return $blockret['content'];
		} 
		if ( $retflag == 2 ) {
				return $blockret['title'];
		} 
		return $blockret;
}

if ( !defined( "TEMPLATE_DIR" ) ) {
		define( "TEMPLATE_DIR", dirname( __FILE__ ) . "/" );
} 
$saxueTset = array();
