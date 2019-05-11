<?php
saxue_includedb();
class saxuesystemconfigs extends saxueobjectdata {
		function saxuesystemconfigs() {
				$this -> initvar( "cid", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "gname", SAXUE_TYPE_TXTBOX, "system", "", false, 20 );
				$this -> initvar( "cname", SAXUE_TYPE_TXTBOX, "", "", false, 30 );
				$this -> initvar( "ctitle", SAXUE_TYPE_TXTBOX, "", "", false, 50 );
				$this -> initvar( "cvalue", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "cdescription", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "cdefine", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "ctype", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "options", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "catorder", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "catname", SAXUE_TYPE_TXTBOX, "", "", false, 50 );
		} 
} 

class saxuesystemconfigshandler extends saxueobjecthandler {
		function saxuesystemconfigshandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "systemconfigs";
				$this -> autoid = "cid";
				$this -> dbname = "system_configs";
		} 
}