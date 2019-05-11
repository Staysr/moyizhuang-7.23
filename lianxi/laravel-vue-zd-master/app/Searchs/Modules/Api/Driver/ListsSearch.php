<?php

namespace App\Searchs\Modules\Api\Driver;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class ListsSearch extends SearchAbstract
{
    protected $relationship = [
        'id' => '=',
        'driver_type' => '=',
        'identity_type' => '=',
        'car_type_id' => 'in',
        'n_id' => '<>',
    ];

    /**
     * 不包含ID
     * @param $value
     * @param $data
     * @return \Closure
     */
    protected function getNIdAttribute($value, $data)
    {
        return function (Builder $query) use ($value) {
            return $query->where('id', '<>', $value);
        };
    }

    /**
     * @param $value
     * @param $data
     * @return string
     */
    protected function getCarTypeIdAttribute($value, $data)
    {
        if (is_string($value)) {
            return explode(',', $value);
        }
        return $value;
    }

}
