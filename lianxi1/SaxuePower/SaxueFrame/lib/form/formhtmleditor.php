<?php
class saxueformhtmleditor extends saxueformelement {
		var $_width;
		var $_height;
		var $_value;
		var $_tool;
		var $_emin;
		var $_filemanager;
		var $_forbidupload;

		function saxueformhtmleditor( $_caption, $_name, $_value = "", $_width = 600, $_height = 400, $_tool = 'default', $_filemanager = true, $_forbidupload = array(), $_emin = true ) {
				$this -> setcaption( $_caption );
				$this -> setname( $_name );
				$this -> _width = intval( $_width );
				$this -> _height = intval( $_height );
				$this -> _value = $_value;
				$this -> _tool = $_tool;
				$this -> _emin = $_emin;
				$this -> _filemanager = $_filemanager;
				$this -> _forbidupload = $_forbidupload;
		} 

		function getwidth() {
				return $this -> _width;
		} 

		function getheight() {
				return $this -> _height;
		} 

		function getvalue() {
				return $this -> _value;
		} 

		function gettool() {
				return $this -> _tool;
		} 

		function getemin() {
				return $this -> _emin;
		} 

		function getfilemanager() {
				return $this -> _filemanager;
		} 

		function getforbidupload() {
				return $this -> _forbidupload;
		} 

		function render() {
				include_once( SAXUE_ROOT_PATH . "/include/function.php" );
				$_ret = saxue_geteditor( $this -> getname(), $this -> getwidth(), $this -> getheight(), $this -> gettool(), $this -> getfilemanager(), $this -> getforbidupload(), $this -> getemin() );
				$_ret .= '<textarea name="' . $this -> getname() . '" style="width:' . $this -> getwidth() . 'px;height:' . $this -> getheight() . 'px;visibility:hidden;">' . $this -> getvalue() . '</textarea>';
				return $_ret;
		} 
} 
