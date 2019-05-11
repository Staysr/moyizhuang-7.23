<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'configs' );
saxue_loadlang( "configs" );
if ( empty( $_REQUEST['gname'] ) ) {
		$GLOBALS['_REQUEST']['gname'] = 'system';
}
include_once( SAXUE_ROOT_PATH . "/model/system_configs.php" );
$data_handler = &saxuesystemconfigshandler :: getinstance( "saxuesystemconfigshandler" );
$criteria = new criteriacompo( new criteria( "gname", $_REQUEST['gname'], "=" ) );
if ( !isset( $_REQUEST['define'] ) || $_REQUEST['define'] != 1 ) {
		$GLOBALS['_REQUEST']['define'] = 0;
}
$criteria -> add( new criteria( "cdefine", $_REQUEST['define'], "=" ) );
$criteria -> setsort( "catorder ASC, cid" );
$criteria -> setorder( "ASC" );
$data_handler -> queryobjects( $criteria );
$v = $data_handler -> getobject();
if ( $v ) {
		if ( isset( $_POST['action'] ) && $_POST['action'] == "update" ) {
				$cfgarray = array();
				$cfgdefine = "";
				do {
						$tmpkey = $v -> getvar( "cname", "n" );
						switch ( $v -> getvar( "ctype" ) ) {
								case SAXUE_TYPE_TXTBOX :
								case SAXUE_TYPE_TXTAREA :
								case SAXUE_TYPE_HIDDEN :
										if ( !isset( $_POST[$tmpkey] ) ) {
												$tmpval = $v -> getvar( "cvalue" );
										} else {
												$tmpval = $_POST[$tmpkey];
										} 
										break;
								case SAXUE_TYPE_INT :
										if ( !isset( $_POST[$tmpkey] ) || !is_numeric( $_POST[$tmpkey] ) ) {
												$tmpval = $v -> getvar( "cvalue" );
										} else {
												$tmpval = $_POST[$tmpkey];
										} 
										$tmpval = intval( $tmpval );
										break;
								case SAXUE_TYPE_NUM :
										if ( !isset( $_POST[$tmpkey] ) || !is_numeric( $_POST[$tmpkey] ) ) {
												$tmpval = $v -> getvar( "cvalue" );
										} else {
												$tmpval = $_POST[$tmpkey];
										} 
										break;
								case SAXUE_TYPE_PASSWORD :
										if ( !isset( $_POST[$tmpkey] ) || strlen( $_POST[$tmpkey] ) == 0 ) {
												$tmpval = $v -> getvar( "cvalue" );
										} else {
												$tmpval = $_POST[$tmpkey];
										} 
										break;
								case SAXUE_TYPE_SELECT :
								case SAXUE_TYPE_RADIO :
										$selectary = @unserialize( @$v -> getvar( "options", "n" ) );
										if ( !is_array( $selectary ) ) {
												$selectary = array();
										} 
										if ( !isset( $_POST[$tmpkey], $selectary[$_POST[$tmpkey]] ) ) {
												$tmpval = $v -> getvar( "cvalue" );
										} else {
												$tmpval = $_POST[$tmpkey];
										} 
										break;
								case SAXUE_TYPE_MULSELECT :
								case SAXUE_TYPE_CHECKBOX :
										$selectary = @unserialize( @$v -> getvar( "options", "n" ) );
										if ( !is_array( $selectary ) ) {
												$selectary = array();
										} 
										$tmparray = is_array( $_POST[$tmpkey] ) ? $_POST[$tmpkey] : array(); 
										// $tmpval = 0;
										$tmpval = '';
										foreach ( $tmparray as $tmpv ) {
												if ( isset( $selectary[$tmpv] ) ) {
														// $tmpval |= intval( $tmpv );
														$tmpval .= $tmpv . ',';
												} 
										} 
										break;
								default :
										if ( !isset( $_POST[$tmpkey] ) ) {
												$tmpval = $v -> getvar( "cvalue" );
										} else {
												$tmpval = $_POST[$tmpkey];
										} 
						} 
						if ( $tmpval != $v -> getvar( "cvalue", "n" ) ) {
								$v -> setvar( "cvalue", $tmpval );
								$data_handler -> insert( $v );
						} 
						if ( $v -> getvar( "cdefine" ) == "1" ) {
								$cfgdefine .= "@define('" . $tmpkey . "','" . saxue_setslashes( $tmpval, "\"" ) . "');\n";
						} else {
								$cfgarray[$_REQUEST['gname']][$tmpkey] = $tmpval;
						} 
				} while ( $v = $data_handler -> getobject() );
				if ( 0 < count( $cfgarray ) ) {
						saxue_setconfigs( "configs", $cfgarray, $_REQUEST['gname'] );
				} 
				if ( !empty( $cfgdefine ) ) {
						$isdefine = 1;
						$dir = SAXUE_DATA_PATH . "/configs";
						if ( !file_exists( $dir ) ) {
								@mkdir( $dir, 511 );
						} 
						@chmod( $dir, 511 );
						if ( $_REQUEST['gname'] != "system" ) {
								$dir .= "/" . $_REQUEST['gname'];
								if ( !file_exists( $dir ) ) {
										@mkdir( $dir, 511 );
								} 
								@chmod( $dir, 511 );
						} 
						$dir .= "/system.php";
						if ( file_exists( $dir ) ) {
								@chmod( $dir, 511 );
						} 
						$cfgdefine = "<?php\n" . $cfgdefine;
						saxue_writefile( $dir, $cfgdefine );
						$publicdata = $cfgdefine . str_replace( '<?php', '', saxue_readfile( SAXUE_ROOT_PATH . "/lang/lang_system.php" ) );
						saxue_writefile( SAXUE_DATA_PATH . "/configs/define.php", $publicdata );
				} else {
						$isdefine = 0;
				}
				saxue_msgwin( LANG_DO_SUCCESS, $saxueLang['configs']['edit_config_success'] );
		} else {
				include_once( SAXUE_ADMIN_PATH . "/header.php" );
				include_once( SAXUE_ROOT_PATH . "/lib/form/formloader.php" );
				$config_form = new saxuethemeform( '', "config", SAXUE_ADMIN_URL . "/configs.php" );
				$catname = "";
				$catorder = 0;
				$cattab = array();
				do {
						$tmpvar = $v -> getvar( "catname" );
						if ( $catname != $tmpvar ) {
								$catname = $tmpvar;
								++$catorder;
								if ( $catorder == 1 ) {
										${ "catele".$catorder } = new saxueformhtml( "<tbody id=\"div_setting_" . $catorder . "\" class=\"contentList\">" );
								} else {
										${ "catele".$catorder } = new saxueformhtml( "</tbody><tbody id=\"div_setting_" . $catorder . "\" class=\"contentList\" style=\"display:none;\">" );
								}
								$config_form -> addelement( ${ "catele".$catorder }, false );
								$cattab[$catorder] = $catname;
						} 
						switch ( $v -> getvar( "ctype" ) ) {
								case SAXUE_TYPE_INT :
								case SAXUE_TYPE_NUM :
										$tmpvar = $v -> getvar( "cname" );
										$$tmpvar = new saxueformtext( $v -> getvar( "ctitle" ), $v -> getvar( "cname" ), 20, 100, $v -> getvar( "cvalue", "e" ) );
										$$tmpvar -> setdescription( $v -> getvar( "cdescription" ) );
										$config_form -> addelement( $$tmpvar, false );
										break;
								case SAXUE_TYPE_TXTAREA :
										$tmpvar = $v -> getvar( "cname" );
										$$tmpvar = new saxueformtextarea( $v -> getvar( "ctitle" ), $v -> getvar( "cname" ), $v -> getvar( "cvalue", "e" ), 5, 50 );
										$$tmpvar -> setdescription( $v -> getvar( "cdescription" ) );
										$config_form -> addelement( $$tmpvar, false );
										break;
								case SAXUE_TYPE_SELECT :
										$tmpvar = $v -> getvar( "cname" );
										$$tmpvar = new saxueformselect( $v -> getvar( "ctitle" ), $v -> getvar( "cname" ), $v -> getvar( "cvalue", "e" ) );
										$$tmpvar -> setdescription( $v -> getvar( "cdescription" ) );
										$selectary = @unserialize( @$v -> getvar( "options", "n" ) );
										if ( !is_array( $selectary ) ) {
												$selectary = array();
										} 
										foreach ( $selectary as $val => $cap ) {
												$$tmpvar -> addoption( $val, $cap );
										} 
										$config_form -> addelement( $$tmpvar, false );
										break;
								case SAXUE_TYPE_RADIO :
										$tmpvar = $v -> getvar( "cname" );
										$$tmpvar = new saxueformradio( $v -> getvar( "ctitle" ), $v -> getvar( "cname" ), $v -> getvar( "cvalue", "e" ) );
										$$tmpvar -> setdescription( $v -> getvar( "cdescription" ) );
										$selectary = @unserialize( @$v -> getvar( "options", "n" ) );
										if ( !is_array( $selectary ) ) {
												$selectary = array();
										} 
										foreach ( $selectary as $val => $cap ) {
												$$tmpvar -> addoption( $val, $cap );
										} 
										$config_form -> addelement( $$tmpvar, false );
										break;
								case SAXUE_TYPE_CHECKBOX :
										$tmpvar = $v -> getvar( "cname" );
										$tmpvalue = $v -> getvar( "cvalue", "n" );
										$tmpvalue = explode( ',', $tmpvalue );
										$tmparray = array();
										if ( !empty( $tmpvalue ) && is_array( $tmpvalue ) ) {
												foreach( $tmpvalue as $val ) {
														if ( !empty( $val ) ) $tmparray[] = $val;
												} 
										} 
										$$tmpvar = new saxueformcheckbox( $v -> getvar( "ctitle" ), $v -> getvar( "cname" ), $tmparray );
										$$tmpvar -> setdescription( $v -> getvar( "cdescription" ) );
										$selectary = @unserialize( @$v -> getvar( "options", "n" ) );
										if ( !is_array( $selectary ) ) {
												$selectary = array();
										} 
										foreach ( $selectary as $val => $cap ) {
												$$tmpvar -> addoption( $val, $cap );
										} 
										$config_form -> addelement( $$tmpvar, false );
										break;
								case SAXUE_TYPE_LABEL :
										$tmpvar = $v -> getvar( "cname" );
										$$tmpvar = new saxueformlabel( $v -> getvar( "ctitle" ), $v -> getvar( "cvalue" ) );
										$$tmpvar -> setdescription( $v -> getvar( "cdescription" ) );
										$config_form -> addelement( $$tmpvar, false );
										break;
								case SAXUE_TYPE_PASSWORD :
										$tmpvar = $v -> getvar( "cname" );
										$$tmpvar = new saxueformpassword( $v -> getvar( "ctitle" ), $v -> getvar( "cname" ), 25, 30, "" );
										$$tmpvar -> setdescription( $v -> getvar( "cdescription" ) );
										$config_form -> addelement( $$tmpvar, false );
										break;
								case SAXUE_TYPE_TXTBOX :
										$tmpvar = $v -> getvar( "cname" );
										$$tmpvar = new saxueformtext( $v -> getvar( "ctitle" ), $v -> getvar( "cname" ), 50, 200, $v -> getvar( "cvalue", "e" ) );
										$$tmpvar -> setdescription( $v -> getvar( "cdescription" ) );
										$config_form -> addelement( $$tmpvar, false );
						} 
				} while ( $v = $data_handler -> getobject() );
				$config_form -> addelement( new saxueformhtml( "</tbody>" ), false );
				$tabhtml = '';
				if ( count( $cattab ) > 0 ) {
						$tabcount = count( $cattab );
						$tabhtml .= '<ul class="tabBut">';
						foreach ( $cattab as $k => $v ) {
								if ( $k == 1 ) $tabhtml .= '<li id="tab_setting_' . $k . '" class="on" onclick="swapTab(' . $tabcount . ',' . $k . ');">' . $v . '</li>';
								else $tabhtml .= '<li id="tab_setting_' . $k . '" onclick="swapTab(' . $tabcount . ',' . $k . ');">' . $v . '</li>';
						}
						$tabhtml .= '</ul>';
				}
				$config_form -> addelement( new saxueformhidden( "gname", $_REQUEST['gname'] ) );
				$config_form -> addelement( new saxueformhidden( "define", $_REQUEST['define'] ) );
				$config_form -> addelement( new saxueformhidden( "action", "update" ) );
				$config_form -> addelement( new saxueformbutton( "&nbsp;", "submit", $saxueLang['configs']['save_config'], "submit" ) );
				$saxueTpl -> assign( "saxue_contents", $tabhtml . $config_form -> render(  ) . "<br />" );
				include_once( SAXUE_ADMIN_PATH . "/footer.php" );
		} 
} else {
		saxue_msgwin( LANG_NOTICE, $saxueLang['configs']['no_usage_config'] );
} 
