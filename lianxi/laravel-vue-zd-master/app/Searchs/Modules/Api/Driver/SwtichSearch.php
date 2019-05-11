<?php

namespace App\Searchs\Modules\Api\Driver;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class SwtichSearch extends SearchAbstract
{
    protected $relationship
        = [
            'id'            => '<>',
            'driver_type'   => '=',
            'identity_type' => '=',
            'car_type_id' => 'in',
        ];


}
