<?php

return array(
    /* 数据库配置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'zisheng', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => 'root', // 密码
    'DB_PORT' => 3306, // 端口USER_SET_MENU
    'DB_PREFIX' => 'zs_', // 数据库表前缀
    'DB_CHARSET' => 'utf8', // 字符集
    /* 系统配置 */
    'URL_MODEL' => '2',
    'MODULE_ALLOW_LIST' => array('Applets'),
    'DEFAULT_MODULE' => 'Applets', // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称


    /* 微信小程序支付配置 */
    'WXCX' => array(
        'appid' => '',
        'mch_id' => '',
        'key' => '',
        'appsecret' => '',
        'notify_url' => '',
        'trade_type' => 'JSAPI'
    ),

);
