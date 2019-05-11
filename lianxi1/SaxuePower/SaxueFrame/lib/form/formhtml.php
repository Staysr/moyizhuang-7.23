<?php
class saxueformhtml extends saxueformelement {
		var $_value;

		function saxueformhtml( $_value = "" ) {
				$this -> sethidden();
				$this -> setcaption( "" );
				$this -> _value = $_value;
		} 

		function getvalue() {
				return $this -> _value;
		} 

		function render() {
				return $this -> getvalue();
		} 
} 
