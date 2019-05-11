<?php
//应用入口文件

//设置编码
header("Content-type: text/html; charset=utf-8");

//定义版本号
define('VER', '3.0');

//定义应用目录
define('PATH', __DIR__ . '/');

//检测是否已安装
if(!file_exists(PATH.'Install/install.lock')) {
    exit("<script language='javascript'>alert('你还未进行安装');window.location.href='/Install';</script>");
}

//引入核心文件
require_once(PATH.'Common/common.php');
require_once(PATH.'Common/mod.php');

//亲^_^ 后面不需要任何代码了 就是如此简单
