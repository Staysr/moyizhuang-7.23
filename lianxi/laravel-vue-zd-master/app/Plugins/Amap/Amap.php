<?php
/**
 * Created by PhpStorm.
 * User: blake.Song
 * Date: 2018/8/20
 * Time: 10:50
 */

namespace App\Plugins\Amap;


use luffyzhao\amapWeb\Georegeo;

class Amap
{
    protected static $const = [
        // 高德地图访问Key
        'restapi_api_key' => '4778b595132655bed9bc540605f5df76',
        'restapi_url' => "http://restapi.amap.com/v3",
    ];

    /**
     * 获取坐标
     * @param $data
     * @param $config
     * @return mixed
     */
    public static function getGeoLocation($data, $config)
    {
        $geore = new Georegeo($data, $config);
        $geore->setAmapKey(self::$const['restapi_api_key'])->setCity('')->solve();
        return $geore->toArray();
    }
}