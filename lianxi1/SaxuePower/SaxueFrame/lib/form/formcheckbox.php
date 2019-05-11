<?php
class saxueformcheckbox extends saxueformelement {
		var $_options = array();
		var $_value = array();

		function saxueformcheckbox( $_caption, $_name, $_value = null ) {
				$this -> setcaption( $_caption );
				$this -> setname( $_name );
				if ( isset( $_value ) ) {
						if ( is_array( $_value ) ) {
								foreach ( $_value as $_v ) {
										$this -> _value[] = $_v;
								} 
						} else {
								$this -> _value[] = $_value;
						} 
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
				if ( 1 < count( $this -> getoptions() ) && substr( $this -> getname(), -2, 2 ) != "[]" ) {
						$_box = $this -> getname() . "[]";
						$this -> setname( $_box );
				} 
				foreach ( $this -> getoptions() as $_value => $_name ) {
						$_ret .= "<input type=\"checkbox\" class=\"checkbox\" name=\"" . $this -> getname() . "\" value=\"" . $_value . "\"";
						if ( 0 < count( $this -> getvalue() ) && in_array( $_value, $this -> getvalue() ) ) {
								$_ret .= " checked=\"checked\"";
						} 
						$_ret .= $this -> getextra() . " />" . $_name . "\n";
				} 
				return $_ret;
		} 
} 
