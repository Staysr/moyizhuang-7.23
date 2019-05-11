<?php
saxue_includedb();
class saxueurlrule extends saxueobjectdata {
		function saxueurlrule() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "编号", false, 4 );
				$this -> initvar( "modid", SAXUE_TYPE_INT, 0, "模块ID", false, 4 );
				$this -> initvar( "name", SAXUE_TYPE_TXTBOX, "", "规则名称", false, 20 );
				$this -> initvar( "type", SAXUE_TYPE_TXTBOX, "", "类型，show内容页，list列表页", false, 10 );
				$this -> initvar( "urlrule", SAXUE_TYPE_TXTBOX, "", "URL规则", false, 255 );
				$this -> initvar( "example", SAXUE_TYPE_TXTBOX, "", "URL示例", false, 255 );
		} 
} 

class saxueurlrulehandler extends saxueobjecthandler {
		function saxueurlrulehandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "urlrule";
				$this -> autoid = "id";
				$this -> dbname = "urlrule";
		} 
}