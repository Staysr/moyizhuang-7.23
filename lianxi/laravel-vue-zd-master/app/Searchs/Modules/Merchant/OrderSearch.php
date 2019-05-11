<?php

namespace App\Searchs\Modules\Merchant;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class OrderSearch extends SearchAbstract
{
    protected $filterKey = ['type'];
    protected $relationship = [
        'arrival_warehouse_time' => 'between',
        'type' => '=',
        'status' => '=',
        'id' => '=',
    ];


    /**
     * 配送完成时间
     * @param $value
     * @return array|bool
     * @author Mark
     * @date 2018/5/25 12:27
     */
    public function getArrivalWarehouseTimeAttribute($value)
    {
        if (empty($value[0]) || empty($value[1])) {
            return false;
        }

        return [
            $this->formatDatetime($value[0]).' 00:00:00',
            $this->formatDatetime($value[1]).' 23:59:59',
        ];
    }

    /**
     * 为了过滤部分值，暂时不用于Where条件
     * @return array
     * @author Mark
     * @date 2018/6/26 17:04
     */
    public function toArray()
    {
        $new=[];
        $result = parent::toArray();
        foreach ($result as $key => $item) {
            if (!in_array(current($item), $this->filterKey)) {
                $new[]=$item;
            }
        }
        return $new;
    }
}
