<?php
saxue_includedb();
class saxuebanner extends saxueobjectdata {
		function saxuebanner() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "title", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "type", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "width", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "height", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "pics", SAXUE_TYPE_INT, 0, "", false, 2 );
		} 
} 

class saxuebannerhandler extends saxueobjecthandler {
		function saxuebannerhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "banner";
				$this -> autoid = "id";
				$this -> dbname = "banner";
		} 
}