<?php
class saxueformtextarea extends saxueformelement {
		var $_cols;
		var $_rows;
		var $_value;

		function saxueformtextarea( $_caption, $_name, $_value = "", $_rows = 5, $_cols = 50 ) {
				$this -> setcaption( $_caption );
				$this -> setname( $_name );
				$this -> _rows = intval( $_rows );
				$this -> _cols = intval( $_cols );
				$this -> _value = $_value;
		} 

		function getrows() {
				return $this -> _rows;
		} 

		function getcols() {
				return $this -> _cols;
		} 

		function getvalue() {
				return $this -> _value;
		} 

		function render() {
				return "<textarea class=\"textarea\" name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\" rows=\"" . $this -> getrows() . "\" cols=\"" . $this -> getcols() . "\"" . $this -> getextra() . ">" . $this -> getvalue() . "</textarea>";
		} 
} 
