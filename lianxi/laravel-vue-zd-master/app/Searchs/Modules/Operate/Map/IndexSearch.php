<?php

namespace App\Searchs\Modules\Operate\Map;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'driver_id' => '='
    ];

    /**
     * 司机
     * @method getDriverIdAttribute
     * @param $value
     * @param $attributes
     * @return \Closure
     * @author luffyzhao@vip.126.com
     */
    protected function getDriverIdAttribute($value, $attributes){
        return function (Builder $query) use ($value){
            $query->whereRaw('FIND_IN_SET('.$value.', `supervisors`)');
        };
    }
}
