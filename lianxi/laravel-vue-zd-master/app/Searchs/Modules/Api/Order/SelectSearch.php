<?php

namespace App\Searchs\Modules\Api\Order;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SelectSearch extends SearchAbstract
{
    protected $relationship
        = [
            'order_no' => 'like',
        ];

    /**
     * @param $value
     *
     * @return string
     */
    protected function getOrderNoAttribute($value)
    {
        return '%'.$value.'%';
    }

}
