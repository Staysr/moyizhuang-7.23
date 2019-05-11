<?php
saxue_includedb();
class saxueplugin extends saxueobjectdata {
		function saxueplugin() {
				$this -> initvar( "pluginid", SAXUE_TYPE_INT, 0, "", false, 6 );
				$this -> initvar( "status", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "name", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "identifier", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "intro", SAXUE_TYPE_TXTBOX, "", "", false, 255 );
				$this -> initvar( "dir", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "author", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "version", SAXUE_TYPE_TXTBOX, "", "", false, 5 );
				$this -> initvar( "releases", SAXUE_TYPE_INT, 0, "", false, 8 );
				$this -> initvar( "menu", SAXUE_TYPE_TXTAREA, "", "", false, null );
		} 
} 

class saxuepluginhandler extends saxueobjecthandler {
		function saxuepluginhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "plugin";
				$this -> autoid = "pluginid";
				$this -> dbname = "plugin";
		} 
}