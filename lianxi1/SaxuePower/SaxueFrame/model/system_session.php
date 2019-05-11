<?php
saxue_includedb();
class saxuesystemsession extends saxueobjectdata {
		function saxuesystemsession() {
				$this -> initvar( "sess_id", SAXUE_TYPE_TXTBOX, "", "", false, 32 );
				$this -> initvar( "sess_updated", SAXUE_TYPE_INT, 0, "", false, 11 );
				$this -> initvar( "sess_data", SAXUE_TYPE_TXTAREA, "", "", false, null );
		} 
} 

class saxuesystemsessionhandler extends saxueobjecthandler {
		function saxuesystemsessionhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "systemsession";
				$this -> autoid = "sess_id";
				$this -> dbname = "system_session";
		} 
}