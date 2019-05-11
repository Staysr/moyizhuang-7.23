<?php

namespace  App\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * Class Util
 * @package App\Facades
 */
class Util extends Facade
{
    /**
     * Util实例
     * @return string
     * @author Mark
     * @date 2018/5/24 14:31
     */
    protected static function getFacadeAccessor()
    {
        return 'util';
    }
}