<?php
class saxueformlabel extends saxueformelement {
		var $_value;

		function saxueformlabel( $_caption = "", $_value = "" ) {
				$this -> setcaption( $_caption );
				$this -> _value = $_value;
		} 

		function getvalue() {
				return $this -> _value;
		} 

		function render() {
				return $this -> getvalue();
		} 
} 
