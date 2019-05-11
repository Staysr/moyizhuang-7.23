<?php

namespace App\Searchs\Modules\Api\Task;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SelectSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => 'like'
    ];

    /**
     * @param $value
     * @param $attribute
     * @return string
     */
    public function getNameAttribute($value, $attribute){
        return '%'. $value . '%';
    }
}
