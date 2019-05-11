<?php

namespace App\Searchs\Modules\Merchant;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class RepaySearch extends SearchAbstract
{
    protected $relationship = [
        'create_time'=>'closure'
    ];

    public function getCreateTimeAttribute($value)
    {
        return function ($query) use ($value) {
            if (empty($value[0]) || empty($value[1])) {
                return false;
            }
            $query->where('create_time', '>=', $value[0])->where('create_time', '<', $value[1]);
        };
    }






}
