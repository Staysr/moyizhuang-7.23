<?php
saxue_includedb();
class saxuemodule extends saxueobjectdata {
		function saxuemodule() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "编号", false, 4 );
				$this -> initvar( "name", SAXUE_TYPE_TXTBOX, "", "模型名称", false, 10 );
				$this -> initvar( "type", SAXUE_TYPE_INT, 0, "类型，0单页内容，1单列表页，2列表+内容", false, 1 );
				$this -> initvar( "status", SAXUE_TYPE_INT, 1, "状态，0禁用，1启用", false, 1 );
				$this -> initvar( "issystem", SAXUE_TYPE_INT, 0, "是否系统模型，1是0否", false, 1 );
				$this -> initvar( "moddir", SAXUE_TYPE_TXTBOX, "", "模块目录", false, 20 );
				$this -> initvar( "tablename", SAXUE_TYPE_TXTBOX, "", "数据表名，不带前缀", false, 20 );
				$this -> initvar( "issearch", SAXUE_TYPE_INT, 0, "是否允许搜索，1是0否", false, 1 );
				$this -> initvar( "searchfield", SAXUE_TYPE_TXTBOX, "title", "搜索字段", false, 20 );
		} 
} 

class saxuemodulehandler extends saxueobjecthandler {
		function saxuemodulehandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "module";
				$this -> autoid = "id";
				$this -> dbname = "module";
		} 
}