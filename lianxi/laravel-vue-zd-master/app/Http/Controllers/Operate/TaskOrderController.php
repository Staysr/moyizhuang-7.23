<?php

namespace App\Http\Controllers\Operate;

use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdTaskOrder\Interfaces;

class TaskOrderController extends ApiController
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $make = [
            'driver' => function ($query) {
                $query->select(['id', 'name', 'phone', 'car_number', 'car_type_id']);
            },
            'warehouse' => function ($query) {
                $query->select(['id', 'title']);
            },
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'task' => function ($query) {
                $query->select(['id', 'type', 'name']);
            },
            'carType' => function($query){
                $query->select(['id', 'name']);
            }
        ];

        return $this->respondWithSuccess(
            $this->repo->with($make)->find($id,
                [
                    'id',
                    'order_no',
                    'merchant_id',
                    'task_id',
                    'name',
                    'warehouse_id',
                    'driver_id',
                    'car_type_id',
                    'unit_price',
                    'status',
                    'arrival_warehouse_time',
                    'punch_time',
                    'leaves_warehouse_time',
                    'finish_time',
                    'point_count',
                    'delivery_point_remark',
                ]
            )
        );
    }
}
