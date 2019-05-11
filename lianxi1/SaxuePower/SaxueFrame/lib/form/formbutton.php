<?php
class saxueformbutton extends saxueformelement {
		var $_value;
		var $_type;

		function saxueformbutton( $_caption, $_name, $_value = "", $_type = "button" ) {
				$this -> setcaption( $_caption );
				$this -> setname( $_name );
				$this -> _type = $_type;
				$this -> _value = $_value;
		} 

		function getvalue() {
				return $this -> _value;
		} 

		function gettype() {
				return $this -> _type;
		} 

		function render() {
				return "<input type=\"" . $this -> gettype() . "\" class=\"button\" name=\"" . $this -> getname() . "\"  id=\"" . $this -> getname() . "\" value=\"" . $this -> getvalue() . "\"" . $this -> getextra() . " />";
		} 
} 
