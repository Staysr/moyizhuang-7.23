<?php
saxue_includedb();
class saxuecolumn extends saxueobjectdata {
		function saxuecolumn() {
				$this -> initvar( "catid", SAXUE_TYPE_INT, 0, "栏目编号", false, 4 );
				$this -> initvar( "modid", SAXUE_TYPE_INT, 0, "模块ID", false, 4 );
				$this -> initvar( "catname", SAXUE_TYPE_TXTBOX, "", "栏目名称", false, 30 );
				$this -> initvar( "catdir", SAXUE_TYPE_TXTBOX, "", "栏目目录", false, 30 );
				$this -> initvar( "pid", SAXUE_TYPE_INT, 0, "父栏目", false, 5 );
				$this -> initvar( "arrpid", SAXUE_TYPE_TXTBOX, "", "父栏目列", false, 255 );
				$this -> initvar( "child", SAXUE_TYPE_INT, 0, "子栏目", false, 1 );
				$this -> initvar( "arrchild", SAXUE_TYPE_TXTBOX, "", "子栏目列", false, 255 );
				$this -> initvar( "listorder", SAXUE_TYPE_INT, 0, "排序", false, 4 );
				$this -> initvar( "ismenu", SAXUE_TYPE_INT, 0, "是否链接，1是0否", false, 1 );
				$this -> initvar( "image", SAXUE_TYPE_TXTBOX, "", "栏目图片", false, 100 );
				$this -> initvar( "custom", SAXUE_TYPE_TXTBOX, "", "自定义文件", false, 100 );
				$this -> initvar( "url", SAXUE_TYPE_TXTBOX, "", "URL", false, 100 );
				$this -> initvar( "display", SAXUE_TYPE_INT, 0, "显示模式，1栏目首页0栏目列表", false, 1 );
				$this -> initvar( "setting", SAXUE_TYPE_TXTAREA, "", "扩展设置", false, null );
				$this -> initvar( "langset", SAXUE_TYPE_TXTAREA, "", "多语言显示设置", false, null );
				$this -> initvar( "seo", SAXUE_TYPE_TXTAREA, "", "SEO设置", false, null );
		} 
} 

class saxuecolumnhandler extends saxueobjecthandler {
		function saxuecolumnhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "column";
				$this -> autoid = "catid";
				$this -> dbname = "column";
		} 
}