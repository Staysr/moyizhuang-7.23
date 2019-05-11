<?php
class saxueformelement {
		var $_name;
		var $_caption;
		var $_hidden = false;
		var $_extra;
		var $_required = false;
		var $_description = "";
		var $_intro = "";

		function saxueformelement() {
		} 

		function setname( $_name ) {
				$this -> _name = trim( $_name );
		} 

		function getname( $_format = true ) {
				if ( false != $_format ) {
						return str_replace( "&amp;", "&", str_replace( "'", "&#039;", htmlspecialchars( $this -> _name ) ) );
				} 
				return $this -> _name;
		} 

		function setcaption( $_caption ) {
				$this -> _caption = trim( $_caption );
		} 

		function getcaption() {
				return $this -> _caption;
		} 

		function setdescription( $_description ) {
				$this -> _description = trim( $_description );
		} 

		function getdescription() {
				return $this -> _description;
		} 

		function setintro( $_intro ) {
				$this -> _intro = trim( $_intro );
		} 

		function getintro() {
				return $this -> _intro;
		} 

		function sethidden() {
				$this -> _hidden = true;
		} 

		function ishidden() {
				return $this -> _hidden;
		} 

		function setextra( $_extra ) {
				$this -> _extra = " " . trim( $_extra );
		} 

		function getextra() {
				if ( isset( $this -> _extra ) ) {
						return $this -> _extra;
				} 
		} 

		function render() {
		} 
} 
