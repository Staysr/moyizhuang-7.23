<?php
class saxueformselect extends saxueformelement {
		var $_options = array();
		var $_multiple = false;
		var $_size;
		var $_value = array();

		function saxueformselect( $_caption, $_name, $_value = null, $_size = 1, $_multiple = false ) {
				$this -> setcaption( $_caption );
				$this -> setname( $_name );
				$this -> _multiple = $_multiple;
				$this -> _size = intval( $_size );
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

		function ismultiple() {
				return $this -> _multiple;
		} 

		function getsize() {
				return $this -> _size;
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
				$_ret = "<select class=\"select\"  size=\"" . $this -> getsize() . "\"" . $this -> getextra() . "";
				if ( $this -> ismultiple() != false ) {
						$_ret .= " name=\"" . $this -> getname() . "[]\" id=\"" . $this -> getname() . "[]\" multiple=\"multiple\">\n";
				} else {
						$_ret .= " name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\">\n";
				} 
				foreach ( $this -> getoptions() as $_value => $_name ) {
						$_ret .= "<option value=\"" . htmlspecialchars( $_value, ENT_QUOTES ) . "\"";
						if ( 0 < count( $this -> getvalue() ) && in_array( $_value, $this -> getvalue() ) ) {
								$_ret .= " selected=\"selected\"";
						} 
						$_ret .= ">" . $_name . "</option>\n";
				} 
				$_ret .= "</select>";
				return $_ret;
		} 
} 
