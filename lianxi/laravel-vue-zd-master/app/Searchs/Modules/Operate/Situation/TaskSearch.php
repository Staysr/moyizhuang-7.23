<?php

namespace App\Searchs\Modules\Operate\Situation;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class TaskSearch extends SearchAbstract
{
    protected $relationship = [
        'date' => '=',
        'merchant_id' => '=',
        'arrival_warehouse_time' => '=',
        'status' => '=',
        'supervisor_id' => '=',
        'driver_id' => '='
    ];

    protected function getArrivalWarehouseTimeAttribute($value, $attribute){
        return function ($query) use ($value, $attribute){
            $query->whereBetween('arrival_warehouse_time', [
                $this->formatDatetime($attribute['date']) . ' '. $value[0],
                $this->formatDatetime($attribute['date']) .  ' '. $value[1],
            ]);
        };
    }

    protected function getDateAttribute($value){
        return function ($query) use ($value){
            $query->whereBetween('arrival_warehouse_time', [
                $this->formatDatetime($value) . ' 00:00:00',
                $this->formatDatetime($value) . ' 23:59:59',
            ]);
        };
    }

    protected function getSupervisorIdAttribute($value){
        return function($query) use ($value) {
            $query->whereIn(
                'driver_id',
                function ($query) use ($value) {
                    $query->from('base_driver_info')->select(['id'])->whereRaw(
                        'find_in_set('.$value.', `supervisors`)'
                    );
                }
            );
        };
    }
}
