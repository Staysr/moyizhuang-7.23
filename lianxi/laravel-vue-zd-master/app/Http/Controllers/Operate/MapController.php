<?php

namespace App\Http\Controllers\Operate;

use App\Http\Controllers\ApiController;
use App\Searchs\Modules\Operate\Map\IndexSearch;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Repositories\Modules\ZdDriver\Interfaces;
use Illuminate\Support\Collection;

class MapController extends ApiController
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 地图界面
     * @method index
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(Request $request)
    {
        $indexSearch = new IndexSearch($request->only(['driver_id']));
        $make = ['position'];
        $withCount = [
            'orders' => function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->whereIn('order_status', [6, 7, 8])->whereBetween(
                    'appointment_time',
                    [
                        Carbon::now()->format('Y-m-d 00:00:00'),
                        Carbon::now()->format('Y-m-d 23:59:59'),
                    ]
                );
            },
            'taskOrders' => function ($query) {
                $query->whereBetween(
                    'arrival_warehouse_time',
                    [
                        Carbon::now()->format('Y-m-d 00:00:00'),
                        Carbon::now()->format('Y-m-d 23:59:59'),
                    ]
                );
            },
        ];

        return $this->respondWithSuccess(
            $this->repo->make($make)->withCount($withCount)->scope(['OnTheJob'])->getWhere(
                $indexSearch->toArray(),
                ['id', 'name', 'phone', 'work_status', 'is_work', 'is_big_work']
            )
        );
    }

    /**
     * 司机详细情况
     * @method show
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function show(Request $request, $id)
    {
        $make = [
            'position',
            'orders' => function ($query) {
                $query->select([
                    'order_no',
                    'driver_id',
                    'appointment_time',
                    'reach_time',
                    'start_time',
                    'start_address',
                    'end_address',
                    'total_fee',
                    'estimate_distance',
                    'order_status',
                ]);
                $query->whereBetween(
                    'appointment_time',
                    [
                        Carbon::now()->format('Y-m-d 00:00:00'),
                        Carbon::now()->format('Y-m-d 23:59:59'),
                    ]
                );
            },
            'taskOrders' => function ($query) {
                $query->select(['arrival_warehouse_time', 'status', 'driver_id', 'merchant_id', 'id']);
                $query->whereBetween(
                    'arrival_warehouse_time',
                    [
                        Carbon::now()->format('Y-m-d 00:00:00'),
                        Carbon::now()->format('Y-m-d 23:59:59'),
                    ]
                );
            },
            'taskOrders.driver:id,name,supervisor_id',
            'taskOrders.driver.supervisor:id,name',
            'taskOrders.merchant:id,short_name'
        ];

        return $this->respondWithSuccess(
            $this->repo->make($make)->scope(['OnTheJob'])->find(
                $id,
                ['id', 'name', 'phone', 'work_status', 'is_work', 'is_big_work', 'car_number']
            )
        );
    }
}
