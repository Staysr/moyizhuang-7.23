<?php

namespace App\Searchs\Modules\Operate\Merchant;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
    ];

    protected function defaultArray()
    {
        return [
            ['zd_merchant_user.status', '=', 1]
        ];
    }
}
