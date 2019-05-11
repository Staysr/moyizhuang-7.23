<?php

namespace App\Searchs\Modules\Api\Account;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class MerchantDetailSearch extends SearchAbstract
{
    protected $relationship = [
        'merchant_id' => '=',
        'driver_id' => '=',
        'create_time'=>'between'
    ];





}
