<?php

namespace App\Searchs\Modules\Api\Task;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'merchant_id' => '=',
        'task_id'  => '=',
        'warehouse_id'  => '=',
        'driver_id'=>'=',
        'type'=>'=',
        'create_time'=>'between',
        'driver_status'=>'closure',
        'name' => 'like'
    ];

    public function getNameAttribute($value){
        return '%' . $value .'%';
    }

    /**
     * 司机状态
     * @param $value
     * @return \Closure
     */
    public function getDriverStatusAttribute($value)
    {
        return function ($query) use ($value) {
            switch ($value) {
                case 1:
                    $query->where('driver_status', 1)->where('rescind_id',0);
                    break;
                case 2:
                    $query->where('driver_status', 2)->where('rescind_id',0);
                    break;
                case 3:
                    $query->where('rescind_id','<>',0);
                    break;
            }
        };
    }
}
