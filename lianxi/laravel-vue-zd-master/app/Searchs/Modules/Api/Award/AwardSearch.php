<?php

namespace App\Searchs\Modules\Api\Award;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class AwardSearch extends SearchAbstract
{

    protected $relationship
        = [
            'driver_id' => '=',
            'merchant_id'     => '=',
            'type' => '=',
            'create_time' => 'between',
        ];
}
