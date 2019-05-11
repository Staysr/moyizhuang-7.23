<?php

namespace App\Searchs\Modules\Api\Role;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => 'like',
    ];
    
    public function getNameAttribute($value)
    {
        return '%' . $value . '%';
    }
    
}
