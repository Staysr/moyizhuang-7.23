<?php
class saxueformfile extends saxueformelement {
		var $_size;

		function saxueformfile( $_caption, $_name, $_size ) {
				$this -> setcaption( $_caption );
				$this -> setname( $_name );
				$this -> _size = intval( $_size );
		} 

		function getsize() {
				return $this -> _size;
		} 

		function render() {
				return "<input type=\"file\" class=\"text\" size=\"" . $this -> getsize() . "\" name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\"" . $this -> getextra() . " />";
		} 
} 
