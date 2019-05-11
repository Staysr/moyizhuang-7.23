<?php
class saxuecompiler extends saxuetpl {
		var $unite = false;
		var $tplinc = "";
		var $functions = array ( 
				"noparam" => array ( 
						0 => "addslashes",
						1 => "htmlspecialchars",
						2 => "htmlentities",
						3 => "nl2br",
						4 => "rawurlencode",
						5 => "rawurldecode",
						6 => "bin2hex",
						7 => "strip_tags",
						8 => "stripslashes",
						9 => "strlen",
						10 => "strtolower",
						11 => "strtoupper",
						12 => "trim",
						13 => "ucfirst",
						14 => "ucwords",
						15 => "sizeof",
						16 => "basename",
						17 => "dirname",
						18 => "base64_encode",
						19 => "base64_decode",
						20 => "empty",
						21 => "is_array",
						22 => "isset",
						23 => "getdate",
						24 => "crc32",
						25 => "md5",
						26 => "count",
						27 => "ceil",
						28 => "floor",
						29 => "round",
						30 => "abs",
						31 => "urlencode",
						32 => "urldecode",
						33 => "intval",
						34 => "strval",
						35 => "serialize",
						36 => "unserialize",
						37 => "subdirectory",
						38 => "is_array" 
						),
				"right" => array ( 0 => "strrchr",
						1 => "strstr",
						2 => "strpos",
						3 => "str_pad",
						4 => "number_format",
						5 => "substr",
						6 => "wordwrap",
						7 => "cutstr",
						8 => "arithmetic",
						9 => "defaultval",
						10 => "saxue_geturl",
						11 => "in_array" 
						),
				"left" => array ( 0 => "date",
						1 => "implode",
						2 => "sprintf",
						3 => "str_replace",
						4 => "str_repeat" 
						) 
				);
		var $regexp = array ( "sqstr" => "\"[^\"\\\\]*(?:\\\\.[^\"\\\\]*)*\"",
				"dqstr" => "'[^'\\\\]*(?:\\\\.[^'\\\\]*)*'",
				"qstr" => "(?:\"[^\"\\\\]*(?:\\\\.[^\"\\\\]*)*\"|'[^'\\\\]*(?:\\\\.[^'\\\\]*)*')",
				"set" => " *set +([\\\$a-zA-Z_0-9]+) *= *['\"]?([^'\"]*)['\"]? *",
				"block" => " *block (.*)",
				"var" => " *[\\\$]([a-zA-Z_0-9]+.*) *",
				"loop" => " *section +name *=(.*)loop *=(.*)(columns *=(.*))?",
				"if" => " *(else if|elseif|if)(.*)(!=|>=|<=|==|>|<)(.*)",
				"include" => " *include +file *=(.*)",
				"function" => " *function ([a-zA-Z_0-9]+.*) *" 
				);

		function &getinstance() {
				static $instance;
				if ( !isset( $_instance ) ) {
						$instance = new saxuecompiler();
				} 
				return $instance;
		} 

		function _addslashes( $_str ) {
				return str_replace( array( "\\", "'" ), array( "\\\\", "\\'" ), $_str );
		} 

		function _init_template_vars( &$_template ) {
				$this -> template_dir = $_template -> template_dir;
				$this -> compile_dir = $_template -> compile_dir;
				$this -> force_compile = $_template -> force_compile;
				$this -> caching = $_template -> caching;
				$this -> left_delimiter = $_template -> left_delimiter;
				$this -> right_delimiter = $_template -> right_delimiter;
				$this -> left_comments = $_template -> left_comments;
				$this -> right_comments = $_template -> right_comments;
				$this -> _tpl_vars = &$_template -> _tpl_vars;
				$this -> compile_id = $_template -> compile_id;
		} 

		function _compile_file( &$_compiled_file, $_readfile = true ) {
				$this -> tplinc = "";
				if ( $_readfile ) {
						$_str = saxue_readfile( $_compiled_file );
				} else {
						$_str = &$_compiled_file;
				} 
				$_preg_from = array( "/" . $this -> left_comments . ".*" . $this -> right_comments . "/isU",
						"/<\\?.*\\?>/isU",
						"/<%.*%>/isU",
						"/<\\s*script[^>]+language\\s*=\\s*['\"]?php['\"]?.*>.*<\\/\\s*script\\s*>/isU" 
						);
				$_preg_to = array( "", "", "", "" );
				$_str = preg_replace( $_preg_from, $_preg_to, $_str );
				$_unit_arr = preg_split( "/(" . $this -> left_delimiter . ".*" . $this -> right_delimiter . ")/isU", $_str, -1, PREG_SPLIT_DELIM_CAPTURE );
				$_str = "";
				$p = count( $_unit_arr );
				$this -> unite = false;
				for ( $_i = 0; $_i < $p; ++$_i ) {
						if ( 0 < strlen( $_unit_arr[$_i] ) ) {
								if ( $this -> unite ) {
										$_str .= ".'" . $this -> _addslashes( $_unit_arr[$_i] ) . "'";
								} else {
										$_str .= "echo '" . $this -> _addslashes( $_unit_arr[$_i] ) . "'";
								} 
								$this -> unite = true;
						} 
						++$_i;
						if ( $_i < $p ) {
								$_unite = $this -> unite;
								$_tmpval = strval( $this -> gettplstr( $_unit_arr[$_i] ) );
								if ( $_unite == true && $this -> unite == true ) {
										$_str .= "." . $_tmpval;
								} else if ( $_unite == true && $this -> unite == false ) {
										$_str .= ";\r\n" . $_tmpval;
								} else if ( $_unite == false && $this -> unite == true ) {
										$_str .= "echo " . $_tmpval;
								} else if ( $_unite == false && $this -> unite == false ) {
										$_str .= $_tmpval;
								} 
						} 
				} 
				if ( $this -> unite ) {
						$_str .= ";";
				} 
				unset( $_tplvars );
				unset( $_unit_arr );
				return $_str;
		} 

		function gettplstr( $_tpl_content ) {
				$_tplvars = array();
				if ( 0 < preg_match( "/" . $this -> left_delimiter . " *\\/(if|section) *" . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
						$_ret = "}\r\n";
						$this -> unite = false;
				} else {
						if ( 0 < preg_match( "/" . $this -> left_delimiter . " *else *" . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
								$_ret = "}else{\r\n";
								$this -> unite = false;
						} else if ( 0 < preg_match( "/" . $this -> left_delimiter . $this -> regexp['var'] . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
								return $this -> getvar( $_tplvars );
						} else if ( 0 < preg_match( "/" . $this -> left_delimiter . $this -> regexp['set'] . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
								$_ret = $this -> getset( $_tplvars );
						} else if ( 0 < preg_match( "/" . $this -> left_delimiter . $this -> regexp['block'] . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
								return $this -> getblock( $_tplvars );
						} else if ( 0 < preg_match( "/" . $this -> left_delimiter . $this -> regexp['loop'] . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
								return $this -> getloop( $_tplvars );
						} else if ( 0 < preg_match( "/" . $this -> left_delimiter . $this -> regexp['if'] . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
								return $this -> getif( $_tplvars );
						} else if ( 0 < preg_match( "/" . $this -> left_delimiter . $this -> regexp['include'] . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
								return $this -> getinclude( $_tplvars );
						} else if ( 0 < preg_match( "/" . $this -> left_delimiter . $this -> regexp['function'] . $this -> right_delimiter . "/isU", $_tpl_content, $_tplvars ) ) {
								return $this -> getfunction( $_tplvars );
						} 
				} 
				if ( $_ret === false ) {
						$this -> unite = true;
						return "'" . $this -> _addslashes( $_tpl_content ) . "'";
				} 
				return $_ret;
		} 

		function getset( $_tplvars ) {
				$_set = isset( $_tplvars[1] ) ? $_tplvars[1] : "";
				$_value = isset( $_tplvars[2] ) ? $_tplvars[2] : "";
				$_params = array();
				preg_match_all( "/[\$][^!=<>\\)\\s\\?]+/i", $_set, $_params, PREG_SET_ORDER );
				$_set_from = array();
				$_set_to = array();
				foreach ( $_params as $_k => $_v ) {
						$_set_from[$_k] = $_v[0];
						$_set_to[$_k] = $this -> getvarstr( $_v[0] );
				} 
				$_params = array();
				preg_match_all( "/[\$][^!=<>\\)\\s\\.\\?]+/i", $_value, $_params, PREG_SET_ORDER );
				$_value_from = array();
				$_value_to = array();
				foreach ( $_params as $_k => $_v ) {
						$_value_from[$_k] = $_v[0];
						$_value_to[$_k] = $this -> getvarstr( $_v[0] );
				} 
				if ( 0 < strlen( $_set ) ) {
						$this -> unite = false;
						$_ret_tmp = empty( $_value_from ) ? "'" . $this -> _addslashes( stripslashes( $_value ) ) . "'" : "\"" . preg_replace( "/\\\$([a-zA-Z_0-9->'\\[\\]])+/i", "{\$0}", str_replace( $_value_from, $_value_to, $_value ) ) . "\"";
						$_ret_tmp = preg_replace( array( '/}\\s*\\./isU', '/\\.\\s*{/isU' ), array( '}', '{' ), $_ret_tmp );
						if ( empty( $_set_from ) ) {
								$_ret = "\$GLOBALS['saxueTset']['" . $this -> _addslashes( stripslashes( $_set ) ) . "'] = " . $_ret_tmp . ";\r\n";
								$this -> tplinc .= $_ret;
								return $_ret;
						} 
						$_ret = str_replace( $_set_from, $_set_to, $_set ) . " = " . $_ret_tmp . ";\r\n";
						$this -> tplinc .= $_ret;
						return $_ret;
				} 
				return false;
		} 

		function getblock( $_tplvars ) {
				$_block_content = isset( $_tplvars[1] ) ? trim( $_tplvars[1] ) : "";
				if ( 0 < strlen( $_block_content ) ) {
						preg_match_all( "/([a-zA-Z_0-9]+) *= *['\"]([^'\"]*)['\"]/isU", $_block_content, $_ary, PREG_SET_ORDER );
						$_temp = "";
						foreach ( $_ary as $_A ) {
								if ( !empty( $_temp ) ) {
										$_temp .= ", ";
								} 
								$_temp .= "'" . $_A[1] . "'=>'" . $this -> _addslashes( stripslashes( $_A[2] ) ) . "'";
						} 
						$this -> unite = true;
						$_ret = "saxue_get_block(array(" . $_temp . "), 1)";
						return $_ret;
				} 
				return false;
		} 

		function getfunction( $_ret_str ) {
				$_function = isset( $_ret_str[1] ) ? trim( $_ret_str[1] ) : "";
				if ( !empty( $_function ) ) {
						return $this -> getfunctionstr( $_function );
				} 
				return false;
		} 

		function getfunctionstr( $_function, $_ret_str = "" ) {
				if ( !empty( $_function ) ) {
						$_function = str_replace( chr( 0 ), "", $_function );
						$_func_arr = array();
						preg_match_all( "/" . $this -> regexp['qstr'] . "/i", $_function, $_func_arr );
						if ( !empty( $_func_arr ) ) {
								$_function = preg_replace( "/" . $this -> regexp['qstr'] . "/i", chr( 0 ), $_function );
						} 
						$_function = explode( "|", $_function );
						$_p = 0;
						$_i = 0;
						$p = count( $_function );
						for ( ; $_i < $p; ++$_i ) {
								$_func_list = explode( ":", $_function[$_i] );
								$_func_base = trim( $_func_list[0] );
								if ( 0 < strlen( $_func_base ) ) {
										$_func_param = array();
										$_j = 1;
										$_k = count( $_func_list );
										for ( ; $_j < $_k; ++$_j ) {
												$_func_var = array();
												if ( strpos( $_func_list[$_j], chr( 0 ) ) !== false ) {
														$_tmp_0 = 0;
														$_tmp_1 = strlen( $_func_list[$_j] );
														$_tmp_2 = "";
														$_f = 0;
														for ( ; $_f < $_tmp_1; ++$_f ) {
																if ( 0 < ord( $_func_list[$_j][$_f] ) ) {
																		$_tmp_2 .= $_func_list[$_j][$_f];
																} else {
																		$_tmp_2 .= "'" . $this -> _addslashes( stripslashes( substr( $_func_arr[0][$_p], 1, -1 ) ) ) . "'";
																		++$_p;
																} 
														} 
														if ( !preg_match( "/^\\\$([a-zA-Z_0-9]+.*)/is", $_tmp_2, $_func_var ) ) {
																$_func_param[] = trim( $_tmp_2 );
														} else {
																$_func_param[] = trim( $this -> getvarstr( $_func_var[1] ) );
														} 
												} else {
														$_func_list[$_j] = trim( $_func_list[$_j] );
														if ( !preg_match( "/^\\\$([a-zA-Z_0-9]+.*)/is", $_func_list[$_j], $_func_var ) ) {
																$_func_param[] = "'" . $this -> _addslashes( $_func_list[$_j] ) . "'";
														} else {
																$_func_param[] = $this -> getvarstr( $_func_var[1] );
														} 
												} 
										} 
										if ( in_array( $_func_base, $this -> functions['noparam'] ) ) {
												$_ret_str = $_func_base . ( "(" . $_ret_str . ")" );
										} else if ( in_array( $_func_base, $this -> functions['right'] ) ) {
												$_ret_str = $_ret_str != "" ? $_func_base . "(" . $_ret_str . "," . implode( ",", $_func_param ) . ")" : $_func_base . "(" . implode( ",", $_func_param ) . ")";
										} else if ( in_array( $_func_base, $this -> functions['left'] ) ) {
												if ( $_func_base != "date" ) {
														$_ret_str = $_ret_str != "" ? $_func_base . "(" . implode( ",", $_func_param ) . "," . $_ret_str . ")" : $_func_base . "(" . implode( ",", $_func_param ) . ")";
												} else {
														$_ret_str = $_ret_str != "" ? $_func_base . "('" . str_replace( "'", "", implode( ":", $_func_param ) ) . "'," . $_ret_str . ")" : $_func_base . "('" . str_replace( "'", "", implode( ":", $_func_param ) ) . ")";
												} 
										} else {
												$_ret_str = $_func_base . "(" . implode( ",", $_func_param ) . ")";
										} 
								} 
						} 
						return $_ret_str;
				} 
				return false;
		} 

		function getvar( $_tplvars ) {
				$_name = isset( $_tplvars[1] ) ? trim( $_tplvars[1] ) : "";
				$_r = $this -> getvarstr( $_name );
				if ( $_r !== false ) {
						$this -> unite = true;
						return $_r;
				} 
				return false;
		} 

		function getvarstr( $_str, $re = false ) {
				preg_match( "/([a-zA-Z_0-9]+) *(\\[[^\\|]*\\])*((\\.[a-zA-Z_0-9]+)*)( *\\|.*)*/is", $_str, $_tplvars );
				$_name = isset( $_tplvars[1] ) ? $_tplvars[1] : "";
				$_var = isset( $_tplvars[2] ) ? $_tplvars[2] : "";
				$_subvar = isset( $_tplvars[3] ) ? $_tplvars[3] : "";
				$_function = isset( $_tplvars[5] ) ? trim( $_tplvars[5] ) : "";
				$_ret_str = '';
				if ( $_name == 'Saxue' && !empty( $_subvar ) ) {
						$_ret_str = $this -> getconst( $_tplvars[3] );
				} 
				if ( empty( $_ret_str ) ) {
						$_var = preg_replace( "/\\[\\\$([a-zA-Z_0-9]+)/i", "[\$this->_tpl_vars['\$1']", $_var );
						$_var = preg_replace( "/\\.([a-zA-Z_0-9]+)/i", "['\$1']", $_var );
						$_var = preg_replace( "/\\[([^'\"\\[\\]]*)\\]/i", "[\$this->_tpl_vars['\$1']['key']]", $_var );
						$_ret_str = "\$this->_tpl_vars['" . $_name . "']" . $_var;
						if ( !empty( $_subvar ) ) {
								$_ret_str .= preg_replace( "/\\.([a-zA-Z_0-9]+)/i", "['\$1']", trim( $_subvar ) );
						} 
				} 
				if ( !empty( $_function ) ) {
						return $this -> getfunctionstr( $_function, $_ret_str );
				} 
				if ( $re ) {
						$_ret_str = str_replace( '$'.$_tplvars[0], "'.".$_ret_str.".'", $_str );
				} 
				unset( $_tplvars );
				return $_ret_str;
		} 
		function getconst( $_str ) {
				$_vars = explode( '.', $_str );
				$_vars[1] = strtoupper( trim( $_vars[1] ) );
				$_parseStr = '';
				if ( count( $_vars ) >= 3 ) {
						$_vars[2] = trim( $_vars[2] );
						switch ( $_vars[1] ) {
								case 'SERVER':
										$_parseStr = '$_SERVER[\'' . strtoupper( $_vars[2] ) . '\']';
										break;
								case 'GET':
										$_parseStr = '$_GET[\'' . $_vars[2] . '\']';
										break;
								case 'POST':
										$_parseStr = '$_POST[\'' . $_vars[2] . '\']';
										break;
								case 'REQUEST':
										$_parseStr = '$_REQUEST[\'' . $_vars[2] . '\']';
										break;
								case 'CONST':
										$_parseStr = strtoupper( $_vars[2] );
										break;
								case 'ENV':
										$_parseStr = '$_ENV[\'' . strtoupper( $_vars[2] ) . '\']';
										break;
								case 'COOKIE':
										if ( isset( $_vars[3] ) ) {
												$_parseStr = '$_COOKIE[\'' . $_vars[2] . '\'][\'' . $_vars[3] . '\']';
										} else {
												$_parseStr = '$_COOKIE[\'' . $_vars[2] . '\']';
										} 
										break;
								case 'SESSION':
										if ( isset( $vars[3] ) ) {
												$_parseStr = '$_SESSION[\'' . $_vars[2] . '\'][\'' . $_vars[3] . '\']';
										} else {
												$_parseStr = '$_SESSION[\'' . $_vars[2] . '\']';
										} 
										break;
								default:break;
						} 
				} else if ( count( $_vars ) == 2 && defined( $_vars[1] ) ) {
						$_parseStr = $_vars[1];
				} 
				return $_parseStr;
		} 

		function getloop( $_tplvars ) {
				$_name = isset( $_tplvars[1] ) ? trim( $_tplvars[1] ) : "";
				$_data = isset( $_tplvars[2] ) ? trim( $_tplvars[2] ) : "";
				$_columns = isset( $_tplvars[4] ) ? intval( trim( $_tplvars[4] ) ) : 1;
				if ( $_columns < 1 ) {
						$_columns = 1;
				} 
				$_loop_arr = $this -> getvarstr( $_data );
				$this -> unite = false;
				return "if (empty(" . $_loop_arr . ")) {$_loop_arr} = array();\r\nelseif (!is_array({$_loop_arr})) {$_loop_arr} = (array){$_loop_arr};\r\n\$this->_tpl_vars['{$_name}']=array();\r\n\$this->_tpl_vars['{$_name}']['columns'] = {$_columns};\r\n\$this->_tpl_vars['{$_name}']['count'] = count({$_loop_arr});\r\n\$this->_tpl_vars['{$_name}']['addrows'] = count({$_loop_arr}) % \$this->_tpl_vars['{$_name}']['columns'] == 0 ? 0 : \$this->_tpl_vars['{$_name}']['columns'] - count({$_loop_arr}) % \$this->_tpl_vars['{$_name}']['columns'];\r\n\$this->_tpl_vars['{$_name}']['loops'] = \$this->_tpl_vars['{$_name}']['count'] + \$this->_tpl_vars['{$_name}']['addrows'];\r\nreset({$_loop_arr});\r\nfor(\$this->_tpl_vars['{$_name}']['index'] = 0; \$this->_tpl_vars['{$_name}']['index'] < \$this->_tpl_vars['{$_name}']['loops']; \$this->_tpl_vars['{$_name}']['index']++){\r\n\t\$this->_tpl_vars['{$_name}']['order'] = \$this->_tpl_vars['{$_name}']['index'] + 1;\r\n\t\$this->_tpl_vars['{$_name}']['row'] = ceil(\$this->_tpl_vars['{$_name}']['order'] / \$this->_tpl_vars['{$_name}']['columns']);\r\n\t\$this->_tpl_vars['{$_name}']['column'] = \$this->_tpl_vars['{$_name}']['order'] % \$this->_tpl_vars['{$_name}']['columns'];\r\n\tif(\$this->_tpl_vars['{$_name}']['column'] == 0) \$this->_tpl_vars['{$_name}']['column'] = \$this->_tpl_vars['{$_name}']['columns'];\r\n\tif(\$this->_tpl_vars['{$_name}']['index'] < \$this->_tpl_vars['{$_name}']['count']){\r\n\t\tlist(\$this->_tpl_vars['{$_name}']['key'], \$this->_tpl_vars['{$_name}']['value']) = each({$_loop_arr});\r\n\t\t\$this->_tpl_vars['{$_name}']['append'] = 0;\r\n\t}else{\r\n\t\t\$this->_tpl_vars['{$_name}']['key'] = '';\r\n\t\t\$this->_tpl_vars['{$_name}']['value'] = '';\r\n\t\t\$this->_tpl_vars['{$_name}']['append'] = 1;\r\n\t}\r\n\t";
		} 

		function getif( $_tplvars ) {
				$_if_content = isset( $_tplvars[0] ) ? $_tplvars[0] : "";
				preg_match_all( "/[\$][^!=<>\\)\\s\\?]+/i", $_if_content, $_params, PREG_SET_ORDER );
				$_if_from = array();
				$_if_to = array();
				foreach ( $_params as $_k => $_v ) {
						$_if_from[$_k] = $_v[0];
						$_if_to[$_k] = $this -> getvarstr( $_v[0] );
				} 
				$_if_tmp = isset( $_tplvars[1] ) ? $_tplvars[1] : "";
				$_if_var = isset( $_tplvars[2] ) ? $_tplvars[2] : "";
				$_operator = isset( $_tplvars[3] ) ? $_tplvars[3] : "";
				$_if_val = isset( $_tplvars[4] ) ? $_tplvars[4] : "";
				$_if_str = "";
				if ( strtolower( $_if_tmp ) == "if" ) {
						$_if_str .= $_if_tmp;
				} else {
						$_if_str .= "}" . $_if_tmp;
				} 
				$_if_str .= "(" . str_replace( $_if_from, $_if_to, trim( $_if_var . $_operator . $_if_val ) ) . "){\r\n";
				$this -> unite = false;
				return $_if_str;
		} 

		function getinclude( $_tplvars ) {
				$_file = isset( $_tplvars[1] ) ? trim( $_tplvars[1] ) : "";
				if ( preg_match( "/^['\"].*['\"]\$/", $_file ) ) {
						$_file = substr( $_file, 1, -1 );
				} 
				if ( preg_match_all( "/\\\$([a-zA-Z_0-9]+) *(\\[[^\\|]*\\])*((\\.[a-zA-Z_0-9]+)*)( *\\|.*)*/is", $_file, $_filevars ) ) {
						foreach ( $_filevars[0] as $_var) {
								$_file = str_replace( $_var, "'.".$this -> getvarstr( $_var ).".'", $_file );
						}
				}
				$_inc_temp = explode( "?", $_file );
				$_fileName = &$_inc_temp[0];
				$_inc_vars = "";
				if ( isset( $_inc_temp[1] ) ) {
						$_inc_params = explode( "&", trim( $_inc_temp[1] ) );
						foreach ( $_inc_params as $_val ) {
								if ( !empty( $_val ) ) {
										$_inc_param = explode( "=", $_val );
										if ( !empty( $_inc_vars ) ) {
												$_inc_vars .= ",";
										} 
										$_inc_vars .= "'" . str_replace( "'", "\"", $_inc_param[0] ) . "'=>'" . str_replace( "'", "\"", $_inc_param[1] ) . "'";
								} 
						} 
				} 
				$_inc_vars = "array(" . $_inc_vars . ")";
				$this -> unite = false;
				return "\$_template_tpl_vars = \$this->_tpl_vars;\r\n \$this->_template_include(array('template_include_tpl_file' => '" . $_fileName . "', 'template_include_vars' => " . $_inc_vars . "));\r\n \$this->_tpl_vars = \$_template_tpl_vars;\r\n unset(\$_template_tpl_vars);\r\n";
		} 
} 
