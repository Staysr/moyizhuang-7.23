<?php
class saxueform {
		var $_action;
		var $_method;
		var $_name;
		var $_title;
		var $_elements = array();
		var $_extra;
		var $_required = array();

		function saxueform( $_title, $_name, $_action, $_method = "post" ) {
				$this -> _title = $_title;
				$this -> _name = $_name;
				$this -> _action = $_action;
				$this -> _method = $_method;
		} 

		function gettitle() {
				return $this -> _title;
		} 

		function getname() {
				return $this -> _name;
		} 

		function getaction() {
				if ( strstr( $this -> _action, "?" ) ) {
						return $this -> _action . "&do=submit";
				} 
				return $this -> _action . "?do=submit";
		} 

		function getmethod() {
				return $this -> _method;
		} 

		function addelement( &$_element, $_required = false ) {
				$this -> _elements[] = &$_element;
				if ( $_required ) {
						$this -> _required[] = &$_element;
				} 
		} 

		function getelements() {
				return $this -> _elements;
		} 

		function setextra( $_extra ) {
				$this -> _extra = " " . $_extra;
		} 

		function getextra() {
				if ( isset( $this -> _extra ) ) {
						return $this -> _extra;
				} 
		} 

		function setrequired( &$_element ) {
				$this -> _required[] = &$_element;
		} 

		function getrequired() {
				return $this -> _required;
		} 

		function insertbreak( $_extra = null ) {
		} 

		function render() {
		} 

		function display() {
				echo $this -> render();
		} 

		function assign( &$_ass ) {
				$_i = 0;
				foreach ( $this -> getelements() as $_ele ) {
						if ( !$_ele -> ishidden() ) {
								$_elements[$_i]['caption'] = $_ele -> getcaption();
								$_elements[$_i]['body'] = $_ele -> render();
								$_elements[$_i]['hidden'] = false;
						} else {
								$_elements[$_i]['caption'] = "";
								$_elements[$_i]['body'] = $_ele -> render();
								$_elements[$_i]['hidden'] = true;
						} 
						++$_i;
				} 
				$_js = "\r\n\t\t<!-- Start Form Vaidation JavaScript //-->\r\n\t\t<script type='text/javascript'>\r\n\t\t<!--//\r\n\t\tfunction saxueFormValidate_" . $this -> getname() . "(){\r\n\t\t";
				$_required = &$this -> getrequired();
				$_requirenum = count( $_required );
				$_i = 0;
				for ( ; $_i < $_requirenum; ++$_i ) {
						$_js .= "if ( window.document." . $this -> getname() . "." . $_required[$_i] -> getname() . ".value == \"\" ) {alert( \"" . sprintf( LANG_PLEASE_ENTER, $_required[$_i] -> getcaption() ) . "\" );window.document." . $this -> getname() . "." . $_required[$_i] -> getname() . ".focus();return false;\n}\r\n\t\t\t\t";
				} 
				$_js .= "}\r\n\t\t//-->\r\n\t\t</script>\r\n\t\t<!-- End Form Vaidation JavaScript //-->\r\n\t\t";
				$_ass -> assign( $this -> getname(), array( "title" => $this -> gettitle(),
								"name" => $this -> getname(),
								"action" => $this -> getaction(),
								"method" => $this -> getmethod(),
								"extra" => "onsubmit=\"return saxueFormValidate_" . $this -> getname() . "();\"" . $this -> getextra(),
								"javascript" => $_js,
								"elements" => $_elements 
								) );
		} 
} 
