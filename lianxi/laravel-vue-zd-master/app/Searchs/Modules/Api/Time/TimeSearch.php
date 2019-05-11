<?php

namespace App\Searchs\Modules\Api\Time;

use App\Model\ZdWarehouse;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class TimeSearch extends SearchAbstract
{

    protected $relationship
        = [
            'merchant_id' => 'raw',
            'date' => 'between'
        ];


    public function getDateAttribute($value)
    {
        if (!empty($value[0]) && !empty($value[1])) {
            return function ($query) use ($value) {
                $query->where([
                    ['create_time', '>=', $value[0].' 00:00:00'],
                    ['create_time', '<=', $value[1].' 23:59:59']
                ]);
            };
        }

        return false;
    }

    public function getMerchantIdAttribute($value)
    {
        return 'warehouse_id IN '.'(SELECT id from zd_warehouse WHERE merchant_id = '.$value.')';
    }

}
