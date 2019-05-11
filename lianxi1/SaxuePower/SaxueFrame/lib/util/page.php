<?php
class saxuepage extends saxueobject {
		var $total;
		var $onepage;
		var $num;
		var $page;
		var $total_page;
		var $linkhead;
		var $pagevar;
		var $L;

		function saxuepage( $_totalrows, $_pagenum, $_page = 1, $_num = 10, $_pagevar = "page" ) {
				global $Lang;
				if ( !isset( $Lang ) ) {
						saxue_getconfigs( 'zh', 'lang', 'Lang' );
				}
				$this -> L = $Lang;
				$this -> total = &$_totalrows;
				$this -> onepage = &$_pagenum;
				$this -> total_page = @ceil( $_totalrows / $_pagenum );
				if ( defined( "SAXUE_MAX_PAGES" ) && 0 < SAXUE_MAX_PAGES && SAXUE_MAX_PAGES < $this -> total_page ) {
						$this -> total_page = intval( SAXUE_MAX_PAGES );
				} 
				if ( $this -> total_page <= 1 ) {
						$this -> total_page = 1;
				} 
				$this -> page = &$_page;
				$this -> num = &$_num;
				$this -> pagevar = $_pagevar;
				$this -> linkhead = saxue_addurlvars( array( $this -> pagevar => "" ), true, false );
		} 

		function setlink( $_linkhead = "", $_method_get = true, $_method_post = false ) {
				if ( !empty( $_linkhead ) ) {
						$this -> linkhead = $_linkhead;
				} else {
						$this -> linkhead = saxue_addurlvars( array( $this -> pagevar => "" ), $_method_get, $_method_post );
				} 
		} 

		function pageurl( $_page ) {
				if ( strpos( $this -> linkhead, "<{\$page" ) === false ) {
						$_url = $this -> linkhead . $_page;
				} else {
						$_url = str_replace( array( "<{\$page|subdirectory}>", "<{\$page}>" ), array( saxue_getsubdir( $_page ), $_page ), $this -> linkhead );
				} 
				return $_url;
		} 

		function pagelink( $_page, $_char, $_class = "" ) {
				$_pageurl = $this -> pageurl( $_page );
				if ( empty( $_class ) ) {
						return "<a href=\"" . $_pageurl . "\">" . $_char . "</a>";
				} 
				return "<a href=\"" . $_pageurl . "\" class=\"" . $_class . "\">" . $_char . "</a>";
		} 

		function first_page( $_linkhead = 1, $_char = "" ) {
				if ( $_char == "" ) {
						$_char = "1...";
				} 
				if ( $_linkhead == 1 ) {
						return $this -> pagelink( 1, $_char, "first" );
				} 
				return 1;
		} 

		function total_page( $_linkhead = 1, $_char = "" ) {
				if ( $_char == "" ) {
						$_char = '...' . $this -> total_page;
				} 
				if ( $_linkhead == 1 ) {
						return $this -> pagelink( $this -> total_page, $_char, "last" );
				} 
				return $this -> total_page;
		} 

		function pre_page( $_char = "" ) {
				if ( $_char == "" ) {
						$_char = $this -> L['prepage'];
				} 
				if ( 1 < $this -> page ) {
						return $this -> pagelink( $this -> page - 1, $_char, "prev" );
				} 
				return "";
		} 

		function next_page( $_char = "" ) {
				if ( $_char == "" ) {
						$_char = $this -> L['nextpage'];
				} 
				if ( $this -> page < $this -> total_page ) {
						return $this -> pagelink( $this -> page + 1, $_char, "next" );
				} 
				return "";
		} 

		function num_bar() {
				$_num = &$this -> num;
				$_pagegroup = floor( $_num / 2 );
				$_barnum = $_num - 1;
				$_page = &$this -> page;
				$_totalpage = &$this -> total_page;
				$_pagehead = &$this -> linkhead;
				$_pagestart = $_page - $_pagegroup < 1 ? 1 : $_page - $_pagegroup;
				$_pageend = $_pagestart + $_barnum;
				if ( $_totalpage < $_pageend ) {
						$_pageend = &$_totalpage;
						$_pagestart = $_pageend - $_barnum;
						$_pagestart = $_pagestart < 1 ? 1 : $_pagestart;
				} 
				$_barstr = "";
				for ( $_i = $_pagestart; $_i <= $_pageend; ++$_i ) {
						$_char = $_i;
						if ( $_i == $_page ) {
								$_bartmp = "<strong>" . $_char . "</strong>";
						} else {
								$_bartmp = $this -> pagelink( $_i, $_char );
						} 
						$_barstr .= $_bartmp;
				} 
				return $_barstr;
		} 

		function pre_group( $_char = "" ) {
				$_page = &$this -> page;
				$_pagehead = &$this -> linkhead;
				$_num = &$this -> num;
				$_pagegroup = floor( $_num / 2 );
				$_pagestart = $_page - $_pagegroup < 1 ? 1 : $_page - $_pagegroup;
				$_pregroup = $_num < $_pagestart ? $_pagestart - $_pagegroup : 1;
				$_char = $_char == '' ? sprintf( $this -> L['pregrouppage'], $_pregroup ) : $_char;
				return $this -> pagelink( $_pregroup, $_char, "pgroup" );
		} 

		function next_group( $_char = "" ) {
				$_page = &$this -> page;
				$_pagehead = &$this -> linkhead;
				$_totalpage = &$this -> total_page;
				$_num = &$this -> num;
				$_pagegroup = floor( $_num / 2 );
				$_barnum = $_num;
				$_pagestart = $_page - $_pagegroup < 1 ? 1 : $_page - $_pagegroup;
				$_pageend = $_pagestart + $_barnum;
				if ( $_totalpage < $_pageend ) {
						$_pageend = &$_totalpage;
						$_pagestart = $_pageend - $_barnum;
						$_pagestart = $_pagestart < 1 ? 1 : $_pagestart;
				} 
				$_nextgroup = $_pageend + $_barnum < $_totalpage ? $_pageend + $_pagegroup : $_totalpage;
				$_char = $_char == '' ? sprintf( $this -> L['nextgrouppage'], $_nextgroup ) : $_char;
				return $this -> pagelink( $_nextgroup, $_char, "ngroup" );
		} 

		function whole_num_bar() {
				$_pagebar = $this -> num_bar();
				return $this -> first_page( 1, $this -> L['firstpage'] ) . $this -> pre_page() . $_pagebar . $this -> next_page() . $this -> total_page( 1, $this -> L['lastpage'] );
		} 

		function whole_bar() {
				return '<div class="pagelink" id="pagelink">' . $this->whole_num_bar( ) . '<em id="pagestats">' . sprintf( $this -> L['totalpage'], $this -> total, $this -> total_page ) . $this->jump_form( ) . '</em></div>';
		} 

		function jump_form() {
				$_jumphead = $this -> linkhead;
				$_pos = strpos( $_jumphead, "<{\$page" );
				if ( $_pos === false ) {
						$_jumpurl = "'" . $_jumphead . "'+this.value";
				} else {
						$_jumpurl = "'" . $_jumphead . "'.replace('<{\$page|subdirectory}>', '/' + Math.floor(this.value / 1000)).replace('<{\$page}>', this.value)";
				} 
				$_jumpstr = "<kbd>&nbsp;<input name=\"page\" type=\"text\" size=\"3\" maxlength=\"6\" onkeydown=\"if(event.keyCode==13){window.location=" . $_jumpurl . "; return false;}\" /></kbd>";
				return $_jumpstr;
		} 
} 
