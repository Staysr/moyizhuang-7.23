<?php
include_once( SAXUE_ROOT_PATH . "/lib/form/formtextarea.php" );
class saxueformdhtmltextarea extends saxueformtextarea {
		var $_hiddenText;

		function saxueformdhtmltextarea( $_caption, $_name, $_value, $_rows = 10, $_cols = 50, $_hiddenText = "saxueHiddenText" ) {
				$this -> saxueformtextarea( $_caption, $_name, $_value, $_rows, $_cols );
				$this -> _hiddenText = $_hiddenText;
		} 

		function render() {
				$_ret = "<textarea class=\"textarea\" name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\" rows=\"" . $this -> getrows() . "\" cols=\"" . $this -> getcols() . "\"" . $this -> getextra() . ">" . $this -> getvalue() . "</textarea>";
				$_js = SAXUE_URL . "/files/scripts/ubbeditor.js";
				$_ret .= "<script language=\"javascript\">loadJs(\"" . $_js . "\", function(){UBBEditor.Create(\"" . $this -> getname() . "\");});</script>";
				return $_ret;
		} 
} 
