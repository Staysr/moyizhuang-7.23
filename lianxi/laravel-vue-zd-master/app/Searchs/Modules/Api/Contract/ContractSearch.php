<?php

namespace App\Searchs\Modules\Api\Contract;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class ContractSearch extends SearchAbstract
{

    protected $relationship
        = [
            'merchant_id' => '=',
        ];
}
