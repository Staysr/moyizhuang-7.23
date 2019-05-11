<?php
class saxueformtext extends saxueformelement {
		var $_size;
		var $_maxlength;
		var $_value;

		function saxueformtext( $_caption, $_name, $_size, $_maxlength, $_value = "" ) {
				$this -> setcaption( $_caption );
				$this -> setname( $_name );
				$this -> _size = intval( $_size );
				$this -> _maxlength = intval( $_maxlength );
				$this -> _value = $_value;
		} 

		function getsize() {
				return $this -> _size;
		} 

		function getmaxlength() {
				return $this -> _maxlength;
		} 

		function getvalue() {
				return $this -> _value;
		} 

		function render() {
				return "<input type=\"text\" class=\"text\" name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\" size=\"" . $this -> getsize() . "\" maxlength=\"" . $this -> getmaxlength() . "\" value=\"" . $this -> getvalue() . "\"" . $this -> getextra() . " />";
		} 
} 
