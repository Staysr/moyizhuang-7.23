<?php

namespace App\Http\Controllers\Api;

use App\Excels\Modules\MonthBillExcel;
use App\Excels\Modules\WaitBillExcel;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Bill\RepayRequest;
use App\Repositories\Modules\ZdMonthBill\Interfaces;
use App\Repositories\Modules\ZdMerchantBill\Interfaces as ZdMerchantBillInterfaces;
use App\Repositories\Modules\ZdRepayLog\Interfaces as ZdRepayLogInterfaces;
use App\Repositories\Modules\ZdMerchant\Interfaces as ZdMerchantInterfaces;
use App\Http\Requests\Api\Bill\MonthRequest;
use App\Http\Requests\Api\Bill\DayRequest;
use App\Http\Requests\Api\Bill\LogRequest;
use App\Searchs\Modules\Api\Bill\MonthSearch;
use App\Searchs\Modules\Api\Bill\DaySearch;
use App\Searchs\Modules\Api\Bill\RepaySearch;
use Illuminate\Http\Request;


/**
 * Class BillController
 *
 * @package App\Http\Controllers\Api
 */
class BillController extends ApiController
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 已出月账单
     *
     * @param MonthRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/19 16:23
     */
    public function month(MonthRequest $request)
    {
        $search = new MonthSearch(
            $request->only(['bill_time', 'merchant_id', 'status', 'overdue'])
        );
        $make = [
            'merchant' =>
                function ($query) {
                    $query->select(['id', 'short_name','repayment_day']);
                },
        ];
        $month = $this->repo->scope(['orderWith','RelatedMerchant'])->make($make)->paginate(
            $search->toArray(),
            20,
            [
                'id',
                'merchant_id',
                'bill_no',
                'bill_time',
                'status',
                'money',
                'repayment_money',
                'last_repayment_time',
            ]
        );
        $month->each(
            function ($item) {
                $item->append(['overdue']);
            }
        );

        return $this->respondWithSuccess($month);
    }


    /**
     * 统计Banner
     * @param MonthRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/31 17:07
     */
    public function statistics(MonthRequest $request){
        $search = new MonthSearch(
            $request->only(['bill_time', 'merchant_id', 'status', 'overdue'])
        );
        $month=$this->repo->scope(['RelatedMerchant'])->getWhere(
            $search->toArray(),
            [
                'money',
                'repayment_money',
            ]
        );
        $sum=$month->sum('money');
        $repayment=$month->sum('repayment_money');
        return $this->respondWithSuccess([$sum,$repayment,$sum-$repayment]);
    }

    /**
     * 日账单 (未出传当月，已出传自定义)
     *
     * @param DayRequest $request
     * @param ZdMerchantBillInterfaces $bill
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/8 17:27
     */
    public function day(DayRequest $request, ZdMerchantBillInterfaces $bill)
    {
        $search = new DaySearch($request->only(['merchant_id', 'create_time']));
        $make = [
            'driver' =>
                function ($query) {
                    $query->select(['id', 'name']);
                },
            'merchant' =>
                function ($query) {
                    $query->select(['id', 'short_name']);
                },
            'order' =>
                function ($query) {
                    $query->select(
                        [
                            'id',
                            'driver_id',
                            'task_id',
                            'merchant_id',
                            'order_no',
                            'name',
                            'unit_price',
                            'merchant_safe_fee',
                            'total_fee',
                            'finish_time',
                            'arrival_warehouse_time',
                        ]
                    );
                },
            'order.task' => function ($query) {
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
        $result = $bill->scope(['orderWithDesc','RelatedMerchant'])->make($make)
            ->paginate(
                $search->toArray(),
                20,
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

        return $this->respondWithSuccess($result);
    }


    /**
     * 日统计
     * @param DayRequest               $request
     * @param ZdMerchantBillInterfaces $bill
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/9/3 10:22
     */
    public function analysis(
        DayRequest $request,
        ZdMerchantBillInterfaces $bill
    ) {
        $search = new DaySearch($request->only(['merchant_id', 'create_time']));
        $day = $bill->scope(['RelatedMerchant'])->getWhere(
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
        $total=[count($day),0,0];
        $day->each(function ($item) use (&$total){
            if(!empty($item->order)){
                $total[1]+=$item->merchant_money;
                $total[2]+=$item->money;
            }
        });
        return $this->respondWithSuccess($total);
    }



    /**
     * 还款记录
     *
     * @param LogRequest $request
     * @param ZdRepayLogInterfaces $repayLog
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/19 16:20
     */
    public function log(LogRequest $request, ZdRepayLogInterfaces $repayLog)
    {
        $search = new RepaySearch(
            $request->only(['merchant_id', 'create_time'])
        );
        $make = [
            'merchant' =>
                function ($query) {
                    $query->select(['id', 'short_name']);
                },
        ];
        $result = $repayLog->scope(['orderWith'])->make($make)->paginate(
            $search->toArray(),
            20,
            ['id', 'merchant_id', 'repay_money', 'remark', 'create_time']
        );

        return $this->respondWithSuccess($result);

    }


    /**
     * 商户还款总金额
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/29 10:10
     */
    public function total(Request $request, $id)
    {
        $sum = 0;
        $result = $this->repo->getWhere(
            ['merchant_id' => $id],
            ['money', 'repayment_money', 'status']
        )->toArray();
        foreach ($result as $index => $item) {
            $sum += $item['money'] - $item['repayment_money'];
        }

        return $this->respondWithSuccess($sum);
    }


    /**
     * 还款
     *
     * @param RepayRequest $request
     * @param ZdMerchantInterfaces $merchant
     * @param                      $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/9 14:04
     */

    public function repay(
        RepayRequest $request,
        ZdMerchantInterfaces $merchant,
        $id
    ) {
        return $this->respondWithSuccess(
            $merchant->repay(
                $merchant->find($id),
                $request->only(['money', 'remark'])
            )
            ,
            '还款成功'
        );
    }

    /**
     * 导出已出账单
     *
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/30 12:20
     */
    public function export()
    {
        $make = [
            'merchant' =>
                function ($query) {
                    $query->select(['id', 'short_name','repayment_day']);
                }
        ];
        $export = new MonthBillExcel(
            $this->repo->scope(['orderWith','RelatedMerchant'])->make($make)
        );
        return  $export->download("已出账单.xlsx");
    }


    public function download(DayRequest $request, ZdMerchantBillInterfaces $bill)
    {
        $make = [
            'driver'               =>
                function ($query) {
                    $query->select(['id', 'name']);
                },
            'merchant'             =>
                function ($query) {
                    $query->select(['id', 'short_name']);
                },
            'order'                =>
                function ($query) {
                    $query->select(
                        [
                            'id',
                            'driver_id',
                            'task_id',
                            'merchant_id',
                            'order_no',
                            'name',
                            'unit_price',
                            'merchant_safe_fee',
                            'total_fee',
                            'finish_time',
                            'arrival_warehouse_time',
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
        $export = new WaitBillExcel(
            $bill->scope(['orderWithDesc','RelatedMerchant'])->make($make)
        );
        return  $export->download("未出账单.xlsx");

    }


}

