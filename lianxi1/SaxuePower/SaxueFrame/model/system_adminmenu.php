<?php
saxue_includedb();
class saxuesystemadminmenu extends saxueobjectdata {
		function saxuesystemadminmenu() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "编号", false, 5 );
				$this -> initvar( "pid", SAXUE_TYPE_INT, 0, "父菜单", false, 5 );
				$this -> initvar( "listorder", SAXUE_TYPE_INT, 0, "菜单排序", false, 5 );
				$this -> initvar( "level", SAXUE_TYPE_INT, 1, "菜单级别", false, 1 );
				$this -> initvar( "node", SAXUE_TYPE_TXTBOX, "", "菜单节点标识", false, 20 );
				$this -> initvar( "caption", SAXUE_TYPE_TXTBOX, "", "菜单标题", false, 30 );
				$this -> initvar( "command", SAXUE_TYPE_TXTBOX, "", "菜单链接", false, 100 );
				$this -> initvar( "display", SAXUE_TYPE_INT, 1, "菜单是否显示", false, 1 );
				$this -> initvar( "issystem", SAXUE_TYPE_INT, 0, "是否系统菜单", false, 1 );
		} 
} 

class saxuesystemadminmenuhandler extends saxueobjecthandler {
		function saxuesystemadminmenuhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "systemadminmenu";
				$this -> autoid = "id";
				$this -> dbname = "system_adminmenu";
		} 
}