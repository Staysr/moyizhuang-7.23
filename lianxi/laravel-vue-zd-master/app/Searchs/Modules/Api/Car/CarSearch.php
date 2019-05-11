<?php

namespace App\Searchs\Modules\Api\Car;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class CarSearch extends SearchAbstract
{

    protected $relationship
        = [
            'driver_id' => '=',
            'number'     => 'like',
            'company_id' => '=',
            'created_at' => 'between',
        ];
}
