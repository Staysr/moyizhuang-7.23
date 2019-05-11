<?php

namespace App\Searchs\Modules\Api\Admin;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'phone' => 'like',
        'name'  => 'like',
    ];
    
    public function getPhoneAttribute($value)
    {
        return '%' . $value . '%';
    }
    
    public function getNameAttribute($value)
    {
        return '%' . $value . '%';
    }
    
}
