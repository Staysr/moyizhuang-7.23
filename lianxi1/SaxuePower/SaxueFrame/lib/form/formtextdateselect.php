<?php
class saxueformtextdateselect extends saxueformtext {
		function saxueformtextdateselect( $_caption, $_name, $_size = 18, $_value = "" ) {
				if ( is_numeric( $_value ) ) {
						if ( $_value == 0 ) {
								$_value = date( SAXUE_DATE_FORMAT, SAXUE_NOW_TIME );
						} else {
								$_value = date( SAXUE_DATE_FORMAT, $_value );
						} 
				} 
				$this -> saxueformtext( $_caption, $_name, $_size, 10, $_value );
		} 

		function render() {
				$_ret = "<input type=\"text\" class=\"text\" name=\"" . $this -> getname() . "\" id=\"" . $this -> getname() . "\" size=\"" . $this -> getsize() . "\" maxlength=\"" . $this -> getmaxlength() . "\" value=\"" . $this -> getvalue() . "\"" . $this -> getextra() . " onfocus=\"showCalendar(this,event)\" onclick=\"showCalendar(this,event)\" />";
				if ( !defined( "SAXUE_CALENDAR_INCLUDE" ) ) {
						define( "SAXUE_CALENDAR_INCLUDE", true );
						$_ret = "<script src=\"" . SAXUE_SKIN_SERVER . "/calendar/calendar.js\"></script><script src=\"" . SAXUE_SKIN_SERVER . "/calendar/calendar.css\"></script>" . $_ret;
				} 
				return $_ret;
		} 
} 
