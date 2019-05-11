<?php

namespace App\Searchs\Modules\Api\Warehouse;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SelectSearch extends SearchAbstract
{
    protected $relationship = [
        'title'       => 'like',
        'merchant_id' => '='
    ];
    
    protected function getTitleAttribute($value, $attributes)
    {
        return '%' . $value . '%';
    }
}
