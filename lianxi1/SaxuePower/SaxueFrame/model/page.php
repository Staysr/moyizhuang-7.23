<?php
saxue_includedb();
class saxuepage extends saxueobjectdata {
		function saxuepage() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "catid", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "lang", SAXUE_TYPE_TXTBOX, "", "", false, 5 );
				$this -> initvar( "title", SAXUE_TYPE_TXTBOX, "", "", false, 100 );
				$this -> initvar( "content", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "addtime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "updatetime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "display", SAXUE_TYPE_INT, 1, "", false, 1 );
				$this -> initvar( "iswap", SAXUE_TYPE_INT, 1, "", false, 1 );
		} 
} 

class saxuepagehandler extends saxueobjecthandler {
		function saxuepagehandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "page";
				$this -> autoid = "id";
				$this -> dbname = "page";
		} 

		function deletebycat( $_catid = 0 ) {
				if ( !is_numeric( $_catid ) || empty( $_catid ) ) {
						return false;
				} 
				$this -> db -> query( "DELETE FROM " . saxue_dbprefix( $this -> dbname ) . " WHERE catid=" . $_catid  );
		}
}