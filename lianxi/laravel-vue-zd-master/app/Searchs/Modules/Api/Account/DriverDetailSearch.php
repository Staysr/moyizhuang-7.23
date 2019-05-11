<?php

namespace App\Searchs\Modules\Api\Account;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class DriverDetailSearch extends SearchAbstract
{
    protected $relationship = [
        'driver_id' => '=',
        'merchant_id' => '=',
        'create_time'=>'between'
    ];




}
