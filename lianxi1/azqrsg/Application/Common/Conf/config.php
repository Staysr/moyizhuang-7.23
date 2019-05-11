<?php
return array(
	//'配置项'=>'配置值'
    //设置一个入口文件访问两个模块
    'MODULE_ALLOW_LIST' => array('Personnelsystem',),
    'DEFAULT_MODULE'=>'Personnelsystem', //设置默认访问模块
    //URL不区分大小写
    'URL_CASE_INSENSITIVE' =>true,
    
    'URL_MODEL'          => '2', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session
    'DEFAULT_THEME'    =>    'Theme1',  //设置默认主题（View）
    
    //修改THINKPHP定界符
    'TMPL_L_DELIM'=>'<{',
    'TMPL_R_DELIM'=>'}>',
    
    //进行数据库的配置
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'default', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'renshi_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    //此配置是为了区分数据库字段大小写的，不配置则自动转化为小写
    'DB_PARAMS'    =>    array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
);
