<?php
saxue_includedb();
class saxuesystemblocks extends saxueobjectdata {
		function saxuesystemblocks() {
				$this -> initvar( "bid", SAXUE_TYPE_INT, 0, "序号", false, 4 );
				$this -> initvar( "blockname", SAXUE_TYPE_TXTBOX, "", "区块名称", true, 50 );
				$this -> initvar( "filename", SAXUE_TYPE_TXTBOX, "", "文件名称", false, 50 );
				$this -> initvar( "classname", SAXUE_TYPE_TXTBOX, "", "类名称", true, 50 );
				$this -> initvar( "title", SAXUE_TYPE_TXTAREA, "", "区块标题", false, null );
				$this -> initvar( "description", SAXUE_TYPE_TXTAREA, "", "区块描述", false, null );
				$this -> initvar( "content", SAXUE_TYPE_TXTAREA, "", "区块内容", false, null );
				$this -> initvar( "vars", SAXUE_TYPE_TXTBOX, "", "区块参数", false, 255 );
				$this -> initvar( "template", SAXUE_TYPE_TXTBOX, "", "模板文件名称", false, 50 );
				$this -> initvar( "cachetime", SAXUE_TYPE_INT, 0, "缓存时间", false, 11 );
				$this -> initvar( "contenttype", SAXUE_TYPE_INT, 0, "内容类型", false, 3 );
				$this -> initvar( "custom", SAXUE_TYPE_INT, 0, "是否自定义区块", false, 1 );
				$this -> initvar( "canedit", SAXUE_TYPE_INT, 0, "可否编辑", false, 1 );
				$this -> initvar( "hasvars", SAXUE_TYPE_INT, 0, "是否支持参数", false, 1 );
		} 
} 

class saxuesystemblockshandler extends saxueobjecthandler {
		var $contentary = array();

		function saxuesystemblockshandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "systemblocks";
				$this -> autoid = "bid";
				$this -> dbname = "system_blocks";
				$this -> contentary = array( "纯文本", "纯HTML", "纯JAVASCRIPT", "HTML和SCRIPT混合", "PHP代码" );
		}

		function getcontentary( $_getcont = true ) {
				return $this -> contentary;
		} 

		function getcontenttype( $_type ) {
				if ( isset( $this -> contentary[$_type] ) ) {
						return $this -> contentary[$_type];
				} 
				return "未知";
		} 

		function savecontent( $_bid, $_contenttype, &$_content ) {
				global $saxueCache;
				$_ret = false;
				if ( 0 < strlen( $_bid ) ) {
						$_val = "";
						$_item = "";
						switch ( $_contenttype ) {
								case SAXUE_CONTENT_TXT :
										$_val = saxue_htmlstr( $_content );
										$_item = ".html";
										break;
								case SAXUE_CONTENT_HTML :
										$_val = $_content;
										$_item = ".html";
										break;
								case SAXUE_CONTENT_JS :
										$_val = $_content;
										$_item = ".html";
										break;
								case SAXUE_CONTENT_MIX :
										$_val = $_content;
										$_item = ".html";
						} 
						if ( 0 < strlen( $_item ) ) {
								$_cache_path = SAXUE_CACHE_PATH;
								if ( is_numeric( $_bid ) ) {
										$_cache_path .= '/blocks/block_custom' . $_bid . $_item;
								} else {
										$_cache_path .= '/blocks/' . $_bid . '.html';
								} 
								if ( $_item != ".php" ) {
										$saxueCache -> set( $_cache_path, $_val );
								} else {
										saxue_checkdir( dirname( $_cache_path ), true );
										saxue_writefile( $_cache_path, $_val );
								} 
								$_ret = true;
						} 
				} 
				return $_ret;
		} 
} 
