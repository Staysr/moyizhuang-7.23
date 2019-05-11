<?php
class saxueformradio extends saxueformelement {
		var $_options = array();
		var $_value;

		function saxueformradio( $_caption, $_name, $_value = null ) {
				$this -> setcaption( $_caption );
				$this -> setname( $_name );
				if ( isset( $_value ) ) {
						$this -> _value = $_value;
				} 
		} 

		function getvalue() {
				return $this -> _value;
		} 

		function addoption( $_value, $_name = "" ) {
				if ( $_name != "" ) {
						$this -> _options[$_value] = $_name;
				} else {
						$this -> _options[$_value] = $_value;
				} 
		} 

		function addoptionarray( $_options ) {
				if ( is_array( $_options ) ) {
						foreach ( $_options as $_k => $_v ) {
								$this -> addoption( $_k, $_v );
						} 
				} 
		} 

		function getoptions() {
				return $this -> _options;
		} 

		function render() {
				$_ret = "";
				foreach ( $this -> getoptions() as $_value => $_name ) {
						$_ret .= "<input type=\"radio\" class=\"radio\" name=\"" . $this -> getname() . "\" value=\"" . $_value . "\"";
						$_chkValue = $this -> getvalue();
						if ( isset( $_chkValue ) && $_value == $_chkValue ) {
								$_ret .= " checked=\"checked\"";
						} 
						$_ret .= $this -> getextra() . " />" . $_name . "\n";
				} 
				return $_ret;
		} 
} 
