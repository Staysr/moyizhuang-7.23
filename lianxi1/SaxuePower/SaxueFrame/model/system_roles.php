<?php
saxue_includedb();
class saxuesystemroles extends saxueobjectdata {
		function saxuesystemroles() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "rolename", SAXUE_TYPE_TXTBOX, "", "", false, 30 );
				$this -> initvar( "status", SAXUE_TYPE_INT, 1, "", false, 1 );
				$this -> initvar( "note", SAXUE_TYPE_TXTBOX, "", "", false, 200 );
				$this -> initvar( "power", SAXUE_TYPE_TXTAREA, "", "", false, null );
		} 
} 

class saxuesystemroleshandler extends saxueobjecthandler {
		function saxuesystemroleshandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "systemroles";
				$this -> autoid = "id";
				$this -> dbname = "system_roles";
		} 
}