<?php

namespace App\Http\Controllers\Api;

use App\Excels\Modules\DriverAccountExcel;
use App\Excels\Modules\DriverDetailExcel;
use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdDriverSub\Interfaces as ZdDriverSubInterfaces;
use App\Repositories\Modules\ZdMerchantBill\Interfaces as ZdMerchantBillInterfaces;
use App\Searchs\Modules\Api\Account\DriverAccountSearch;
use App\Searchs\Modules\Api\Account\DriverDetailSearch;
use Illuminate\Http\Request;


/**
 * Class DriverAccountController
 *
 * @package App\Http\Controllers\Api
 */
class DriverAccountController extends ApiController
{

    protected $repo = null;

    public function __construct(ZdDriverSubInterfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 司机账户
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/13 11:06
     */
    public function driver(Request $request)
    {
        $search = new DriverAccountSearch(
            $request->only(
                [
                    'driver_id',
                ]
            )
        );
        $make = [
            'driver'            => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                        'phone',
                        'supervisor_id',
                        'car_type_id',
                        'car_number',
                        'category_id'
                    ]
                );
            },
            'driver.supervisor' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone']
                );
            },
            'driver.carType'    => function ($query) {
                $query->select(
                    ['id', 'name']
                );
            },
            'order'             => function ($query) {
                $query->select("driver_id", "total_fee");
            },
        ];

        $result = $this->repo->scope(['orderWith','RelatedDriver'])->make($make)->paginate(
            $search->toArray(),
            20,
            [
                'driver_id',
                'complete_count',
                'work_count',
            ]
        );
        $result->map(
            function ($item) {
                foreach ($item->order as $index => $value) {
                    $item->sum_total_fee += $value->total_fee;
                }
            }
        );

        return $this->respondWithSuccess($result);
    }


    /**
     * 司机账单详情
     *
     * @param ZdMerchantBillInterfaces $bill
     * @param Request                  $request
     * @param                          $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/29 18:07
     */
    public function single(
        ZdMerchantBillInterfaces $bill,
        Request $request,
        $id
    ) {

        $request->merge(['driver_id' => $id]);

        $search = new DriverDetailSearch(
            $request->only(
                [
                    'driver_id',
                    'merchant_id',
                    'create_time',
                ]
            )
        );
        $make = [
            'driver'               => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                        'phone',
                        'supervisor_id',
                        'car_type_id',
                        'car_number',
                    ]
                );
            },
            'merchant'             => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'order'                => function ($query) {
                if (!empty(request()->input('create_time'))) {
                    $query->whereBetween(
                        'create_time',
                        request()->input('create_time')
                    );
                }
                $query->select(
                    [
                        'id',
                        'task_id',
                        'finish_time',
                        'total_fee',
                        'arrival_warehouse_time',
                        'order_no',
                    ]
                );
            },
            'order.task'           => function ($query) {
                $query->select(
                    ['id', 'name', 'type', 'warehouse_id']
                );
            },
            'order.task.warehouse' => function ($query) {
                $query->select(
                    [
                        'id',
                        'title',
                    ]
                );
            },
        ];

        $result = $bill->scope(['orderWith'])->make($make)->paginate(
            $search->toArray(),
            20,
            [
                'driver_id',
                'merchant_id',
                'order_id',
                'create_time',
            ]
        );

        return $this->respondWithSuccess($result);
    }


    /**
     * 单个司机统计
     *
     * @param ZdMerchantBillInterfaces $bill
     * @param Request                  $request
     * @param                          $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/9/3 11:37
     */
    public function statistics(
        ZdMerchantBillInterfaces $bill,
        Request $request,
        $id
    ) {
        $request->merge(['driver_id' => $id]);
        $search = new DriverDetailSearch(
            $request->only(
                [
                    'driver_id',
                    'merchant_id',
                    'create_time',
                ]
            )
        );
        $day = $bill->getWhere(
            $search->toArray(),
            [
                'driver_id',
                'merchant_id',
                'order_id',
                'charge_type',
                'task_type',
                'merchant_money',
                'money',
                'create_time',
            ]
        );
        $total = [count($day), 0];
        $day->each(
            function ($item) use (&$total) {
                if (!empty($item->order)) {
                    $total[1] += $item->money;
                }
            }
        );

        return $this->respondWithSuccess($total);
    }


    /**
     * 导出
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Mark
     * @date   2018/8/11 11:50
     */
    public function export()
    {
        $make = [
            'driver'            => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                        'phone',
                        'supervisor_id',
                        'car_type_id',
                        'car_number',
                    ]
                );
            },
            'driver.supervisor' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone']
                );
            },
            'driver.carType'    => function ($query) {
                $query->select(
                    ['id', 'name']
                );
            },
            'order'             => function ($query) {
                $query->select("driver_id", "total_fee");
            },
        ];
        $export = new DriverAccountExcel(
            $this->repo->scope(['orderWith','RelatedDriver'])->make($make)
        );

        return $export->download("司机账户列表.xlsx");
    }


    /**
     * 导出单个
     *
     * @param ZdMerchantBillInterfaces $bill
     * @param Request                  $request
     * @param                          $id
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Mark
     * @date   2018/8/29 18:10
     */
    public function download(
        ZdMerchantBillInterfaces $bill,
        Request $request,
        $id
    ) {
        $request->merge(['driver_id' => $id]);
        $make = [
            'merchant'             => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'order'                => function ($query) {
                if (!empty(request()->input('create_time'))) {
                    $query->whereBetween(
                        'create_time',
                        request()->input('create_time')
                    );
                }
                $query->select(
                    [
                        'id',
                        'task_id',
                        'finish_time',
                        'total_fee',
                        'arrival_warehouse_time',
                        'order_no',
                        'total_fee',
                    ]
                );
            },
            'order.task'           => function ($query) {
                $query->select(
                    ['id', 'name', 'type', 'warehouse_id']
                );
            },
            'order.task.warehouse' => function ($query) {
                $query->select(
                    [
                        'id',
                        'title',
                    ]
                );
            },
        ];

        $export = new DriverDetailExcel(
            $bill->scope(['orderWith'])->make($make)
        );

        return $export->download("单个司机账户列表.xlsx");
    }


}

