<?php
// auth-generated by RootConfigHandler
// date: 01/10/2019 17:27:55

self::$handlers['config/autoload.ini'] = new AutoloadConfigHandler();
self::$handlers['config/databases.ini'] = new DatabaseConfigHandler();
self::$handlers['config/settings.ini'] = new DefineConfigHandler();
self::$handlers['config/settings.ini']->initialize(array('prefix' => 'MO_'));
self::$handlers['factories.ini'] = new FactoryConfigHandler();
self::$handlers['compile.conf'] = new CompileConfigHandler();
self::$handlers['filters.ini'] = new FilterConfigHandler();
self::$handlers['logging.ini'] = new LoggingConfigHandler();
self::$handlers['modules/*/config/module.ini'] = new ModuleConfigHandler();
self::$handlers['modules/*/validate/*.ini'] = new ValidatorConfigHandler();
?>