<?php

namespace App\Searchs\Modules\Api\Driver;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SelectSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => 'like',
        'phone'=>'like',
        'car_number' => 'like',
        'company_id' => '='
    ];

    protected function getNameAttribute($value)
    {
        return function (Builder $query) use ($value){
            $query->where('name', 'like', '%'. $value .'%')->orWhere('phone', 'like', '%'. $value .'%');
        };
    }

    protected function getPhoneAttribute($value)
    {
        return '%' . $value . '%';
    }

    protected function getCarNumberAttribute($value)
    {
        return '%' . $value . '%';
    }
}
