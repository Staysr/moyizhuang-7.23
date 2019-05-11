<?php
saxue_includedb();
class saxueproductexpand extends saxueobjectdata {
		function saxueproductexpand() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "catid", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "listorder", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "name", SAXUE_TYPE_TXTBOX, "", "", false, 30 );
				$this -> initvar( "lang", SAXUE_TYPE_TXTBOX, "", "", false, 5 );
		} 
} 

class saxueproductexpandhandler extends saxueobjecthandler {
		function saxueproductexpandhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "productexpand";
				$this -> autoid = "id";
				$this -> dbname = "product_expand";
		} 
}