<?php
include_once( SAXUE_ROOT_PATH . "/lib/form/form.php" );
class saxuethemeform extends saxueform {
		function insertbreak( $_extra = null ) {
				if ( !isset( $_extra ) ) {
						$_extra = "<tr><td colspan=\"2\"></td></tr>";
						$this -> addelement( $_extra );
				} else {
						$_extra = "<tr><td colspan=\"2\">" . $_extra . "</td></tr>";
						$this -> addelement( $_extra );
				} 
		} 

		function render( $_width = "100%" ) {
				$_required = $this -> getrequired();
				$_ret = "\n<form name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\" action=\"" . $this -> getaction() . "\" method=\"" . $this -> getmethod() . "\" onsubmit=\"return saxueFormValidate_" . $this -> getname() . "();\"" . $this -> getextra() . ">\n<table width=\"" . $_width . "\" class=\"grid\" cellspacing=\"1\" align=\"center\">\n";
				if ( $this -> gettitle() != '' ) $_ret .= "<caption>" . $this -> gettitle() . "</caption>\n";
				foreach ( $this -> getelements() as $_ele ) {
						if ( !is_object( $_ele ) ) {
								$_ret .= $_ele;
						} else if ( !$_ele -> ishidden() ) {
								$_caption = $_ele -> getcaption();
								if ( empty( $_caption ) ) {
										$_ret .= "<tr>\n<td colspan=\"2\" class=\"head\">" . $_ele -> render() . "</td>\n</tr>\n";
								} else {
										$_ret .= "<tr>\n  <td width=\"200\" class=\"tdleft\">" . $_caption;
										if ( $_caption != "&nbsp;" ) $_ret .= "：";
										if ( $_ele -> getintro() != "" ) {
												$_ret .= "<br /><span class=\"hottext\">" . $_ele -> getintro() . "</span>";
										} 
										$_ret .= "</td>\n<td>" . $_ele -> render();
										if ( $_ele -> getdescription() != "" ) {
												$_ret .= "&nbsp;<span class=\"hottext\">" . $_ele -> getdescription() . "</span>";
										} 
										$_ret .= "</td>\n</tr>\n";
								} 
						} else {
								$_ret .= $_ele -> render();
						} 
				} 
				$_js = "\r\n<script language=\"javascript\" type=\"text/javascript\">\r\n<!--\r\nfunction saxueFormValidate_" . $this -> getname() . "(){\r\n";
				$_required = $this -> getrequired();
				$_requirenum = count( $_required );
				if ( !defined( "LANG_PLEASE_ENTER" ) ) {
						$_tips = "请输入%s";
				} else {
						$_tips = LANG_PLEASE_ENTER;
				} 
				$_i = 0;
				for ( ; $_i < $_requirenum; ++$_i ) {
						$_js .= "  if(document." . $this -> getname() . "." . $_required[$_i] -> getname() . ".value == \"\"){\r\n    alert(\"" . sprintf( $_tips, preg_replace( array( "/\\<span[^\\<\\>]*\\>[^\\<\\>]*\\<\\/span\\>/is", "/\\<div[^\\<\\>]*\\>[^\\<\\>]*\\<\\/div\\>/is", "/\\<font[^\\<\\>]*\\>[^\\<\\>]*\\<\\/font\\>/is" ), "", str_replace( array( "\\", "\"" ), array( "\\\\", "\\\"" ), $_required[$_i] -> getcaption() ) ) ) . "\");\r\n    document." . $this -> getname() . "." . $_required[$_i] -> getname() . ".focus();\r\n    return false;\r\n  }\r\n";
				} 
				$_js .= "}\r\n//-->\r\n</script>\n";
				$_ret .= "</table>\n</form>\n";
				$_ret .= $_js;
				return $_ret;
		} 
} 
