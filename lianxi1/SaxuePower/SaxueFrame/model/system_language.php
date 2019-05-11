<?php
saxue_includedb();
class saxuesystemlanguage extends saxueobjectdata {
		function saxuesystemlanguage() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "编号", false, 2 );
				$this -> initvar( "name", SAXUE_TYPE_TXTBOX, "", "显示名称", false, 20 );
				$this -> initvar( "lang", SAXUE_TYPE_TXTBOX, "", "英文标识", false, 5 );
				$this -> initvar( "sitename", SAXUE_TYPE_TXTBOX, "", "网站名称", false, 100 );
				$this -> initvar( "display", SAXUE_TYPE_INT, 1, "是否显示", false, 1 );
				$this -> initvar( "issystem", SAXUE_TYPE_INT, 0, "是否系统语言", false, 1 );
				$this -> initvar( "isdefault", SAXUE_TYPE_INT, 0, "是否默认语言", false, 1 );
				$this -> initvar( "listorder", SAXUE_TYPE_INT, 0, "排序", false, 2 );
				$this -> initvar( "theme", SAXUE_TYPE_TXTBOX, "", "模版目录", false, 20 );
				$this -> initvar( "skin", SAXUE_TYPE_TXTBOX, "", "风格目录", false, 20 );
				$this -> initvar( "style", SAXUE_TYPE_TXTBOX, "", "颜色风格", false, 20 );
				$this -> initvar( "seo", SAXUE_TYPE_TXTAREA, "", "SEO设置", false, null );
		} 
} 

class saxuesystemlanguagehandler extends saxueobjecthandler {
		function saxuesystemlanguagehandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "systemlanguage";
				$this -> autoid = "id";
				$this -> dbname = "system_language";
		} 
}