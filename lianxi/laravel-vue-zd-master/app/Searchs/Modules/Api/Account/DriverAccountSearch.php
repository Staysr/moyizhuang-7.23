<?php

namespace App\Searchs\Modules\Api\Account;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class DriverAccountSearch extends SearchAbstract
{
    protected $relationship = [
        'driver_id' => '='
    ];





}
