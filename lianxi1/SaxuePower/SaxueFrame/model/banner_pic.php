<?php
saxue_includedb();
class saxuebannerpic extends saxueobjectdata {
		function saxuebannerpic() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "bid", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "url", SAXUE_TYPE_TXTBOX, "", "", false, 100 );
				$this -> initvar( "title", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "link", SAXUE_TYPE_TXTBOX, "#", "", false, 100 );
				$this -> initvar( "listorder", SAXUE_TYPE_INT, 0, "", false, 2 );
				$this -> initvar( "status", SAXUE_TYPE_INT, 1, "", false, 1 );
		} 
} 

class saxuebannerpichandler extends saxueobjecthandler {
		function saxuebannerpichandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "bannerpic";
				$this -> autoid = "id";
				$this -> dbname = "banner_pic";
		} 
}