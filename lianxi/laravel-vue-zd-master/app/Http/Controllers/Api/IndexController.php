<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdTaskOrder\Interfaces;
use App\Searchs\Modules\Api\Index\IndexSearch;
use Illuminate\Http\Request;

class IndexController extends ApiController
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 首页
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/23 17:01
     */
    public function index(Request $request)
    {

        $post = $request->only(
            [
                'driver',
                'merchant',
                'task',
                'arrival_warehouse_time',
                'status',
            ]
        );
        $search = new IndexSearch($post);
        $make = [
            'merchant'  => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'task'      => function ($query) {
                $query->select(
                    ['id', 'name', 'type', 'car_type_ids', 'is_fixed_point']
                );
            },
            'warehouse' => function ($query) {
                $query->select(
                    [
                        'id',
                        'title',
                        'address',
                        'contacts',
                        'contacts_phone',
                        'longitude',
                        'latitude',
                    ]
                );
            },
            'driver'    => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number', 'supervisor_id']
                );
            },
            'carType'   => function ($query) {
                $query->select(['id', 'name']);
            },
            'position'  => function ($query) {
                $query->select(['id', 'address', 'lng', 'lat', 'createTime']);
            },
            'delivery'  => function ($query) {
                $query->select(
                    [
                        'id',
                        'order_id',
                        'name',
                        'lng',
                        'lat',
                        'order_id',
                        'is_fixed_point',
                        'put_lng',
                        'put_lat',
                        'contacts',
                        'contact_way',
                        'sort',
                        'status',
                        'finish_time',
                        'reason',
                        'img_one',
                        'img_two',
                        'img_three',
                    ]
                );
            },
        ];
        $status = [0, 0, 0, 0, 0, 0,0];
        $points = [0, 0, 0];
        //统计总数
        $this->repo->scope(['IndexFilter'])->make($make)->getWhere(
            $search->toFilterArray(),
            [
                'id',
                'status',
                'merchant_id',
                'task_id',
                'name',
                'warehouse_id',
                'driver_id',
                'car_type_id',
            ]
        )->each(
            function ($item) use (&$status, &$points) {
                $status[$item->status]++;
                $item->delivery->each(
                    function ($value) use (&$points) {
                        $points[$value->status]++;
                    }
                );
            }
        );
        //分页
        $resultArr = $this->repo->scope(['IndexFilter'])->make($make)->paginate(
            $search->toArray(),
            3,
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
                'merchant_safe_fee',
                'total_fee',
                'manage_fee',
                'arrival_warehouse_time',
                'punch_time',
                'leaves_warehouse_time',
                'finish_time',
                'status',
                'point_count',
                'cancel_time',
                'rescind_time',
                'undo_time',
                'create_time',
            ]
        );
        $resultArr->map(
            function ($item) {
                $item->append(['late']);
                $is_fixed_point = $item->task->is_fixed_point;
                if(!empty( $item->delivery)){
                    $item->delivery->each(
                        function ($value) use ($is_fixed_point,$item) {
                            if ($is_fixed_point == 0) {
                                $value->lng = $value->put_lng;
                                $value->lat = $value->put_lat;
                            }
                            $value->location=[$value->lng,  $value->lat];
                            $value->setHidden(['is_fixed_point', 'put_lng', 'put_lat']);
                            if ($is_fixed_point == 0) {
                                $value->delivery->sortByDesc('finish_time');
                            }
                            $value->task=$item->task;
                            $value->driver=$item->driver;
                        }
                    );
                }
                if(!empty($item->warehouse)) {
                    $item->warehouse->location = [
                        $item->warehouse->longitude,
                        $item->warehouse->latitude
                    ];
                }
                if(!empty($item->position)) {
                    $item->position->location=[$item->position->lng,$item->position->lat];
                }
                if (in_array($item->status, [3, 4, 5, 6])|| strtotime($item->arrival_warehouse_time) > time() + 3600) {
                    $item->position= null;
                }

            }
        );

        return $this->respondWithSuccess(
            ['status' => $status, 'point' => $points, 'data' => $resultArr]
        );
    }


}
