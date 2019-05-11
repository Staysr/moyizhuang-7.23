<?php

namespace App\Searchs\Modules\Api\Merchant;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class MerchantSearch extends SearchAbstract
{

    protected $relationship
        = [
            'id' => '=',
            'merchant_id' => '=',
            'company_id' => '=',
            'create_time' => 'closure',
            'quality_id' => '=',
            'advice_id' => '=',
            'running_id' => '=',
            'status' => '='
        ];


    public function getCreateTimeAttribute($value)
    {
        return function (Builder $query) use ($value) {
            if($value[0] && $value[1]){
                $query->whereBetween('zd_merchant.create_time', $value);
            }
        };
    }

    public function getIdAttribute($value)
    {
        return function (Builder $query) use ($value) {
            $query->where('zd_merchant.id', '=', $value);
        };
    }
}
