<?php
saxue_includedb();
class saxuejob extends saxueobjectdata {
		function saxuejob() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 8 );
				$this -> initvar( "catid", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "lang", SAXUE_TYPE_TXTBOX, "", "", false, 5 );
				$this -> initvar( "title", SAXUE_TYPE_TXTBOX, "", "", false, 50 );
				$this -> initvar( "count", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "place", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "deal", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "content", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "lifedays", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "url", SAXUE_TYPE_TXTBOX, "", "", false, 100 );
				$this -> initvar( "addtime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "updatetime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "display", SAXUE_TYPE_INT, 1, "", false, 1 );
				$this -> initvar( "iswap", SAXUE_TYPE_INT, 1, "", false, 1 );
				$this -> initvar( "istop", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "islink", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "views", SAXUE_TYPE_INT, 0, "", false, 8 );
		} 
} 

class saxuejobhandler extends saxueobjecthandler {
		function saxuejobhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "job";
				$this -> autoid = "id";
				$this -> dbname = "job";
		} 

		function deletebycat( $_catid = 0 ) {
				if ( !is_numeric( $_catid ) || empty( $_catid ) ) {
						return false;
				} 
				$this -> db -> query( "DELETE FROM " . saxue_dbprefix( $this -> dbname ) . " WHERE catid=" . $_catid  );
		}
}