<?php
saxue_includedb();
class saxuelang extends saxueobjectdata {
		function saxuelang() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "编号", false, 8 );
				$this -> initvar( "title", SAXUE_TYPE_TXTBOX, "", "语言项名称", false, 20 );
				$this -> initvar( "name", SAXUE_TYPE_TXTBOX, "", "标识", false, 30 );
				$this -> initvar( "setting", SAXUE_TYPE_TXTAREA, "", "设置", false, null );
				$this -> initvar( "issystem", SAXUE_TYPE_INT, 0, "是否系统", false, 1 );
		} 
} 

class saxuelanghandler extends saxueobjecthandler {
		function saxuelanghandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "lang";
				$this -> autoid = "id";
				$this -> dbname = "lang";
		} 
}