<?php

namespace App\Searchs\Modules\Api\Account;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class MerchantAccountSearch extends SearchAbstract
{
    protected $relationship = [
        'merchant_id' => '='
    ];





}
