<?php

namespace App\Searchs\Modules\Api\Warehouse;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class WarehouseSearch extends SearchAbstract
{

    protected $relationship
        = [
            'merchant_id' => '=',
            'id' => '=',
            'title' => '=',
            'status' => '=',
            'category_position' => 'like',
            'create_time' => 'between',
        ];
}
