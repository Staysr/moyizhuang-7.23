<?php
define( "SAXUE_WEB_PATH", @str_replace( array( "\\\\", "\\" ), "/", @dirname( __FILE__ ) ) );
// SaxueFrame文件夹可放同服务器任何位置，当不在网站根目录时，需要手动更改SAXUE_ROOT_PATH真实路径，如"F:/SaxueFrame"
define( "SAXUE_ROOT_PATH", SAXUE_WEB_PATH . "/SaxueFrame" );
include( SAXUE_ROOT_PATH . '/core.php' );