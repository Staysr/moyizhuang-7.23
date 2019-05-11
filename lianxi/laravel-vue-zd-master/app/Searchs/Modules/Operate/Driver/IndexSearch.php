<?php

namespace App\Searchs\Modules\Operate\Driver;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => 'like',
        'supervisor' => '='
    ];

    /**
     * @param $value
     * @param $attribute
     * @return string
     */
    protected function getNameAttribute($value, $attribute){
        return "%{$value}%";
    }

    /**
     * @param $value
     * @param $attribute
     * @return \Closure
     */
    protected function getSupervisorAttribute($value, $attribute){
        return function (Builder $query) use ($value){
            $query->whereRaw("FIND_IN_SET('{$value}', `supervisors`)");
        };
    }

    protected function defaultArray()
    {
        return [
            'status'=> 1,
            'app_status' => 1
        ];
    }
}
