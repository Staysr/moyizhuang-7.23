<?php
class saxueformhidden extends saxueformelement {
		var $_value;

		function saxueformhidden( $_name, $_value ) {
				$this -> setname( $_name );
				$this -> sethidden();
				$this -> _value = $_value;
				$this -> setcaption( "" );
		} 

		function getvalue() {
				return $this -> _value;
		} 

		function render() {
				return "<input type=\"hidden\" name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\" value=\"" . $this -> getvalue() . "\" />";
		} 
} 
