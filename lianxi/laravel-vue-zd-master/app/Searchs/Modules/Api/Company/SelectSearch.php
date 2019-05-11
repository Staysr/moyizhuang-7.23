<?php

namespace App\Searchs\Modules\Api\Company;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SelectSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => 'like'
    ];

    protected function getNameAttribute($value, $data){
        return '%'.$value.'%';
    }
}
