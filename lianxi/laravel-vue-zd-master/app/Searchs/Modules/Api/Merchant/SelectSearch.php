<?php

namespace App\Searchs\Modules\Api\Merchant;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SelectSearch extends SearchAbstract
{
    protected $relationship = [
        'title' => 'like'
    ];

    protected function getTitleAttribute($value, $data){
        return '%'.$value.'%';
    }
}
