<?php
saxue_includedb();
class saxuesearch extends saxueobjectdata {
		function saxuesearch() {
				$this -> initvar( "searchid", SAXUE_TYPE_INT, 0, "", false, 11 );
				$this -> initvar( "searchtime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "searchtimes", SAXUE_TYPE_INT, 1, "", false, 10 );
				$this -> initvar( "lang", SAXUE_TYPE_TXTBOX, "", "", false, 5 );
				$this -> initvar( "hashid", SAXUE_TYPE_TXTBOX, "0", "", false, 32 );
				$this -> initvar( "modid", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "catid", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "keywords", SAXUE_TYPE_TXTBOX, "", "", false, 60 );
				$this -> initvar( "results", SAXUE_TYPE_INT, 0, "", false, 11 );
				$this -> initvar( "ids", SAXUE_TYPE_TXTAREA, "", "", false, null );
		} 
} 

class saxuesearchhandler extends saxueobjecthandler {
		function saxuesearchhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "search";
				$this -> autoid = "searchid";
				$this -> dbname = "search";
		} 
}