<?php

namespace App\Searchs\Modules\Api\Index;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{

    protected $filterKey = ['status'];
    protected $relationship
        = [
            'arrival_warehouse_time' => 'closure',
            'status'                 => '=',
        ];


    public function getArrivalWarehouseTimeAttribute($value)
    {
        return function ($query) use ($value) {
            if (empty($value)) {
                return date("Y-m-d");
            }
            $query->whereDate('arrival_warehouse_time', '=', $value);
        };
    }


    /**
     * 过滤某些条件
     *
     * @return array
     * @author Mark
     * @date   2018/9/7 17:13
     */
    public function toFilterArray()
    {
        $new = [];
        $result = parent::toArray();
        foreach ($result as $key => $item) {
            if (!in_array(current($item), $this->filterKey)) {
                $new[] = $item;
            }
        }

        return $new;
    }


}
