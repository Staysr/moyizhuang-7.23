<?php

namespace App\Searchs\Modules\Api\Driver;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class PendingSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => '=',
        'phone' => '=',
        'status' => '=',
        'company_id' => '=',
        'driver_type' => '=',
    ];
}
