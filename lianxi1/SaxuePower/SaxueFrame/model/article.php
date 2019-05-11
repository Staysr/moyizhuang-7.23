<?php
saxue_includedb();
class saxuearticle extends saxueobjectdata {
		function saxuearticle() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 8 );
				$this -> initvar( "catid", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "lang", SAXUE_TYPE_TXTBOX, "", "", false, 5 );
				$this -> initvar( "title", SAXUE_TYPE_TXTBOX, "", "", false, 100 );
				$this -> initvar( "thumb", SAXUE_TYPE_TXTBOX, "", "", false, 100 );
				$this -> initvar( "intro", SAXUE_TYPE_TXTBOX, "", "", false, 255 );
				$this -> initvar( "url", SAXUE_TYPE_TXTBOX, "", "", false, 100 );
				$this -> initvar( "display", SAXUE_TYPE_INT, 1, "", false, 1 );
				$this -> initvar( "iswap", SAXUE_TYPE_INT, 1, "", false, 1 );
				$this -> initvar( "istop", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "islink", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "addtime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "updatetime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "views", SAXUE_TYPE_INT, 0, "", false, 8 );
		} 
} 

class saxuearticlehandler extends saxueobjecthandler {
		function saxuearticlehandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "article";
				$this -> autoid = "id";
				$this -> dbname = "article";
		} 

		function deletebycat( $_catid = 0 ) {
				if ( !is_numeric( $_catid ) || empty( $_catid ) ) {
						return false;
				} 
				$this -> db -> query( "DELETE a,b FROM " . saxue_dbprefix( $this -> dbname ) . " a," . saxue_dbprefix( $this -> dbname ) . "_data b WHERE a.id=b.id AND a.catid=" . $_catid  );
		}
}