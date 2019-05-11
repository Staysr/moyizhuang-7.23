<?php

namespace App\Http\Controllers\Api;

use App\Excels\Modules\MerchantAccountExcel;
use App\Excels\Modules\MerchantDetailExcel;
use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdMerchantAccount\Interfaces as Interfaces;
use App\Repositories\Modules\ZdMerchantBill\Interfaces as ZdMerchantBillInterfaces;
use App\Searchs\Modules\Api\Account\MerchantAccountSearch;
use App\Searchs\Modules\Api\Account\MerchantDetailSearch;
use Illuminate\Http\Request;


/**
 * Class MerchantAccountController
 *
 * @package App\Http\Controllers\Api
 */
class MerchantAccountController extends ApiController
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 商户账户
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/13 14:05
     */
    public function merchant(Request $request)
    {
        $search = new MerchantAccountSearch(
            $request->only(
                [
                    'merchant_id',
                ]
            )
        );
        $make = [
            'merchant'    => function ($query) {
                $query->select(['id', 'short_name', 'repayment_day']);
            },
            'orderFinish' => function ($query) {
                $query->select(
                    "driver_id",
                    "merchant_id",
                    "unit_price",
                    "merchant_safe_fee",
                    'total_fee'
                );
            },
            'month'       => function ($query) {
                $query->select(
                    [
                        'id',
                        'merchant_id',
                        'bill_no',
                        'bill_time',
                        'money',
                        'repayment_money',
                        'status'
                    ]
                );
            },
            'merchantUser' => function ($query) {
                $query->select(
                    ['id', 'merchant_id', 'phone']
                );
            }
        ];

        $result = $this->repo->scope(['orderWith','RelatedMerchant'])->make($make)->paginate(
            $search->toArray(),
            20,
            [
                'account',
                'merchant_id',
                'latest_repayment_time',
            ]
        );
        $result->map(function ($item) {
            $left = $total_fee = $result = 0;
            foreach ($item->orderFinish as $key => $cast) {
                $total_fee += $cast->unit_price + $cast->merchant_safe_fee;
            }
            foreach ($item->month as $index => $value) {
                $left += $value->money - $value->repayment_money;
            }

            foreach ($item->month as $index => $value) {
                $less = $value->money - $value->repayment_money;
                if (time() - strtotime($value->bill_time) > 86400
                    * $value->merchant->repayment_day
                ) {
                    $result += $less;
                }
            }
            $item->borrow = $total_fee + $left;
            $item->overdue = $result;
        });
        return $this->respondWithSuccess($result);
    }


    /**
     * 商户账单详情
     * @param ZdMerchantBillInterfaces $bill
     * @param Request                  $request
     * @param                          $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/29 17:51
     */
    public function single(ZdMerchantBillInterfaces $bill, Request $request,$id)
    {
        $request->merge(['merchant_id'=>$id]);
        $search = new MerchantDetailSearch(
            $request->only(
                [
                    'driver_id',
                    'merchant_id',
                    'create_time'
                ]
            )
        );

        $make = [
            'merchant'             => function ($query) {
                $query->select(['id', 'short_name', 'repayment_day']);
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
                        'merchant_safe_fee',
                        'unit_price',
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
            'driver'               => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
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
            ]
        );

        return $this->respondWithSuccess($result);
    }


    /**
     * 单个商户统计
     * @param ZdMerchantBillInterfaces $bill
     * @param Request                  $request
     * @param                          $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/9/3 11:38
     */
    public function statistics(ZdMerchantBillInterfaces $bill, Request $request,$id){
        $request->merge(['merchant_id'=>$id]);
        $search = new MerchantDetailSearch(
            $request->only(
                [
                    'driver_id',
                    'merchant_id',
                    'create_time'
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
        $total=[count($day),0];
        $day->each(function ($item) use (&$total){
            if(!empty($item->order)){
                $total[1]+=$item->merchant_money;
            }
        });
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
            'merchant'     => function ($query) {
                $query->select(['id', 'short_name', 'repayment_day']);
            },
            'orderFinish'  => function ($query) {
                $query->select(
                    "driver_id",
                    "merchant_id",
                    "unit_price",
                    "merchant_safe_fee"
                );
            },
            'month'        => function ($query) {
                $query->select(
                    [
                        'id',
                        'merchant_id',
                        'bill_no',
                        'bill_time',
                        'money',
                        'repayment_money',
                        'status'
                    ]
                );
            },
            'merchantUser' => function ($query) {
                $query->select(
                    ['id', 'merchant_id', 'phone']
                );
            },
        ];
        $export = new MerchantAccountExcel(
            $this->repo->scope(['orderWith','RelatedMerchant'])->make($make)
        );

        return $export->download("商户账户列表.xlsx");
    }


    /**
     * 导出单个
     * @param ZdMerchantBillInterfaces $bill
     * @param Request                  $request
     * @param                          $id
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Mark
     * @date   2018/8/29 18:10
     */
    public function download(ZdMerchantBillInterfaces $bill,Request $request,$id)
    {
        $request->merge(['merchant_id'=>$id]);

        $make = [
            'merchant'             => function ($query) {
                $query->select(['id', 'short_name', 'repayment_day']);
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
                        'merchant_safe_fee',
                        'unit_price',
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
            'driver'               => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                    ]
                );
            }
        ];

        $export = new MerchantDetailExcel(
            $bill->scope(['orderWith'])->make($make)
        );
        return $export->download("单个商户账户列表.xlsx");
    }


}

