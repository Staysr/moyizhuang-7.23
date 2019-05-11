<?php

namespace App\Searchs\Modules\Merchant;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class MonthSearch extends SearchAbstract
{
    protected $relationship = [
        'bill_time' => 'closure',
    ];

    public function getBillTimeAttribute($value)
    {
        return function ($query) use ($value) {
            if (empty($value[0]) || empty($value[1])) {
                return false;
            }
            $query->where('bill_time', '>=', $value[0])->where('bill_time', '<=', $value[1]);
        };
    }


}
