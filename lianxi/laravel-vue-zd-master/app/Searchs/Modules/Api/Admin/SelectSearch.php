<?php

namespace App\Searchs\Modules\Api\Admin;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SelectSearch extends SearchAbstract
{
    protected $relationship = [
        'authority_level' => '=',
        'name' => 'like'
    ];

    protected function getNameAttribute($value, $data){
        return '%'.$value.'%';
    }
}
