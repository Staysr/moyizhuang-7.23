<?php
/**
 * Created by PhpStorm.
 * User: Frank
 * Date: 2018-09-19
 * Time: 12:05
 */

namespace App\Searchs\Modules\Api\Point;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class tasklineSearch extends SearchAbstract
{
    protected $relationship = [
        'arrival_time' => 'closure',
    ];
    
    protected function getArrivalTimeAttribute($value)
    {
        return function ($query) use ($value) {
            if (empty($value[0]) || empty($value[1]))
                return false;
            $query->whereRaw("CONCAT(arrival_warehouse_day, ' ', arrival_warehouse_time) >= '" . $value[0] . "'")
                ->whereRaw("CONCAT(arrival_warehouse_day, ' ', arrival_warehouse_time) <= '" . $value[1] . "'");
        };
    }
}