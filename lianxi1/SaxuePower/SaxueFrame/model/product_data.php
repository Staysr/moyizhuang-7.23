<?php
saxue_includedb();
class saxueproductdata extends saxueobjectdata {
		function saxueproductdata() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 8 );
				$this -> initvar( "content", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "pics", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "expand", SAXUE_TYPE_TXTAREA, "", "", false, null );
		} 
} 

class saxueproductdatahandler extends saxueobjecthandler {
		function saxueproductdatahandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "productdata";
				$this -> autoid = "id";
				$this -> dbname = "product_data";
		} 
}