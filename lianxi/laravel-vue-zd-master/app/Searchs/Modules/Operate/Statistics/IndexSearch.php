<?php

namespace App\Searchs\Modules\Operate\Statistics;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'start_date' => '<=',
        'driver_id' => '='
    ];

    /**
     * 时间过滤
     * @method getStartDateAttribute
     * @param $value
     * @param $attributes
     * @return \Closure
     * @author luffyzhao@vip.126.com
     */
    protected function getStartDateAttribute($value, $attributes){
        return function ($query) use ($attributes) {
            $query->whereBetween('date', [
                $attributes['start_date'],
                $attributes['end_date']
            ]);
        };
    }

    /**
     * 数据过滤
     * @method getDriverIdAttribute
     * @param $value
     * @param $attributes
     * @return \Closure
     * @author luffyzhao@vip.126.com
     */
    protected function getDriverIdAttribute($value, $attributes){
        return function ($query) use ($attributes, $value) {
            switch ($attributes['type']){
                case 0:
                    $query->where('driver_id', '=', $value);
                    break;
                case 1:
                    $query->where('small_id', '=', $value);
                    break;
                case 2:
                    $query->where('big_id', '=', $value);
                    break;
            }

        };
    }
}
