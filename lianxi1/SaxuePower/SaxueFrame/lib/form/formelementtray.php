<?php
class saxueformelementtray extends saxueformelement {
		var $_elements = array();
		var $_delimeter;

		function saxueformelementtray( $_caption, $_delimeter = "&nbsp;" ) {
				$this -> setcaption( $_caption );
				$this -> _delimeter = $_delimeter;
		} 

		function addelement( $_element ) {
				$this -> _elements[] = $_element;
		} 

		function getelements() {
				return $this -> _elements;
		} 

		function getdelimeter() {
				return $this -> _delimeter;
		} 

		function render() {
				$_count = 0;
				$_ret = "";
				foreach ( $this -> getelements() as $_ele ) {
						if ( 0 < $_count ) {
								$_ret .= $this -> getdelimeter();
						} 
						$_ret .= $_ele -> render() . "\n";
						if ( !$_ele -> ishidden() ) {
								++$_count;
						} 
				} 
				return $_ret;
		} 
} 
