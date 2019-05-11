<?php
include_once( SAXUE_ROOT_PATH . "/lib/form/form.php" );
class saxuetableform extends saxueform {
		function render() {
				$_ret = $this -> gettitle() . "\n<form name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\" action=\"" . $this -> getaction() . "\" method=\"" . $this -> getmethod() . "\"" . $this -> getextra() . ">\n<table border=\"0\" width=\"100%\">\n";
				foreach ( $this -> getelements() as $_ele ) {
						if ( !$_ele -> ishidden() ) {
								$_caption = $_ele -> getcaption();
								if ( empty( $_caption ) ) {
										$_ret .= "<tr><td valign=\"top\" colspan=\"2\" align=\"center\">" . $_ele -> render() . "</td></tr>";
								} else {
										$_ret .= "<tr valign=\"top\" align=\"left\"><td>" . $_caption;
										if ( $_ele -> getdescription() != "" ) {
												$_ret .= "<br /><br /><span style=\"font-weight: normal;\">" . $_ele -> getdescription() . "</span>";
										} 
										$_ret .= "</td><td>" . $_ele -> render() . "</td></tr>";
								} 
						} else {
								$_ret .= $_ele -> render() . "\n";
						} 
				} 
				$_ret .= "</table>\n</form>\n";
				return $_ret;
		} 
} 
