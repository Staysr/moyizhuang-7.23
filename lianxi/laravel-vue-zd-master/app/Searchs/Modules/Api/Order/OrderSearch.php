<?php

namespace App\Searchs\Modules\Api\Order;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class OrderSearch extends SearchAbstract
{
    protected $relationship
        = [
            'arrival_warehouse_time' => 'closure',
            'merchant_id'            => '=',
            'order_no'               => 'like',
            'task_id'                => '=',
            'warehouse_id'           => '=',
            'name'                   => 'like',
            'driver_id'              => '=',
            'exception_count'        => 'closure',
            'is_agent'               => '=',
            'is_one_step_finish'     => '=',
            'is_reassigned'          => '=',
            'status'                 => 'in',
        ];

    /**
     * @param $value
     *
     * @return string
     */
    protected function getOrderNoAttribute($value)
    {
        return '%'.$value.'%';
    }

    /**
     * @param $value
     *
     * @return string
     */
    protected function getNameAttribute($value)
    {
        return '%'.$value.'%';
    }

    /**
     * 异常
     *
     * @param $value
     *
     * @return \Closure
     */
    protected function getExceptionCountAttribute($value)
    {
        return function (Builder $query) use ($value) {
            if ($value) {
                $query->where('exception_count', '>', 0);
            } else {
                $query->where('exception_count', '=', 0);
            }
        };
    }

    public function getArrivalWarehouseTimeAttribute($value)
    {
        return function ($query) use ($value) {
            if (empty($value[0]) || empty($value[1])) {
                return false;
            }
            $query->where('arrival_warehouse_time', '>=', $value[0])->where('arrival_warehouse_time', '<=', $value[1]);
        };
    }

}
