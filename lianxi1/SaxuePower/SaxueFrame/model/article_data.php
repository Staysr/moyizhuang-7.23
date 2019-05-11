<?php
saxue_includedb();
class saxuearticledata extends saxueobjectdata {
		function saxuearticledata() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 8 );
				$this -> initvar( "content", SAXUE_TYPE_TXTAREA, "", "", false, null );
		} 
} 

class saxuearticledatahandler extends saxueobjecthandler {
		function saxuearticledatahandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "articledata";
				$this -> autoid = "id";
				$this -> dbname = "article_data";
		} 
}