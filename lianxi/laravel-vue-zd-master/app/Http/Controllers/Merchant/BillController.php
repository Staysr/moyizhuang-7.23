<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repositories\Modules\ZdMonthBill\Interfaces;
use App\Repositories\Modules\ZdTaskOrder\Interfaces as ZdTaskOrderInterfaces;
use App\Repositories\Modules\ZdMerchantBill\Interfaces as ZdMerchantBillInterfaces;
use App\Repositories\Modules\ZdMerchantAccount\Interfaces as ZdMerchantAccountInterfaces;
use App\Repositories\Modules\ZdRepayLog\Interfaces as ZdRepayLogInterfaces;
use Illuminate\Http\Request;
use App\Http\Requests\Merchant\Bill\MonthRequest;
use App\Http\Requests\Merchant\Bill\DayRequest;
use App\Http\Requests\Merchant\Bill\LogRequest;
use App\Searchs\Modules\Merchant\MonthSearch;
use App\Searchs\Modules\Merchant\RepaySearch;


/**
 * Class BillController
 * @package App\Http\Controllers\Merchant
 */
class BillController extends Controller
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 已出月账单
     * @param MonthRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/19 16:23
     */
    public function month(MonthRequest $request)
    {
        $search = new MonthSearch($request->only(['bill_time']));
        $month = $this->repo->scope(['orderWith', 'SingleMerchant'])->getWhere(
            $search->toArray(),
            [
                'id',
                'bill_no',
                'bill_time',
                'status',
                'money',
                'repayment_money',
                'last_repayment_time',
            ]
        );
        return $this->respondWithSuccess($month);
    }


    /**
     * 日账单 (未出传当月，已出传自定义)
     * @param DayRequest               $request
     * @param ZdMerchantBillInterfaces $bill
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/19 16:20
     */
    public function day(DayRequest $request, ZdMerchantBillInterfaces $bill)
    {
        $make = [
            'merchant' =>
                function ($query) {
                    $query->select(['id', 'short_name']);
                },
            'order' =>
                function ($query) {
                    $query->select(
                        ['id', 'order_no', 'name', 'unit_price', 'merchant_safe_fee', 'total_fee', 'finish_time']
                    );
                },
        ];
        $result = $bill->scope(['orderWith', 'SingleMerchant','FilterOrder'])->make($make)->getWhere(
            [],
            [
                'driver_id',
                'order_id',
                'merchant_id',
                'charge_type',
                'task_type',
                'merchant_money',
                'money',
                'arrival_warehouse_time',
            ]
        )->sortByDesc(function($item) {
            return $item->order->finish_time;
        })->values();

        return $this->respondWithSuccess($result);
    }


    /**
     * 还款记录
     * @param LogRequest           $request
     * @param ZdRepayLogInterfaces $repayLog
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/19 16:20
     */
    public function log(LogRequest $request, ZdRepayLogInterfaces $repayLog)
    {
        $search = new  RepaySearch($request->only(['create_time']));
        $result = $repayLog->scope(['orderWith', 'SingleMerchant'])->getWhere(
            $search->toArray(),
            ['id', 'merchant_id', 'repay_money', 'remark','create_time']
        )->each(function ($item){
            $item->create_date=date('Y-m-d',strtotime( $item->create_time));
            $item->remark="转账";
        });

        return $this->respondWithSuccess($result);

    }


    /**
     * 我的账户
     * @param Request $request
     * @param ZdMerchantBillInterfaces $bill
     * @param ZdTaskOrderInterfaces $order
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/6/7 12:02
     */
    public function center(Request $request, ZdMerchantBillInterfaces $bill ,ZdTaskOrderInterfaces $order,ZdMerchantAccountInterfaces $account)
    {

        $totalSum= $this->repo->scope(['orderWith', 'SingleMerchant'])->getField(
            'money-repayment_money',
            'diff_money'
        )->sum('diff_money');
        $result['endSum'] = number_format($totalSum,2,".", "");
        $result['pendingSum'] = $bill->scope(['orderWith', 'SingleMerchant'])->getModel()
            ->whereYear('create_time', '=', date('Y'))
            ->whereMonth('create_time', '=', date('m'))
            ->sum('money');
        $result['totalSum']=number_format($result['pendingSum']+$totalSum,2,".", "");
        $result['fiveDaySum'] = $order->scope(['orderWith', 'SingleMerchant'])->getModel()
            ->whereDate('arrival_warehouse_time', '>', date('Y-m-d'))
            ->whereDate('arrival_warehouse_time', '<=', date('Y-m-d',strtotime('+ 5 day')))
            ->sum('total_fee');
        $result['account'] = $account->findValue(['merchant_id' => auth()->user()->merchant_id], 'account');
        if(empty($result['account'])){
            $result['account'] = 0;
        }
        return $this->respondWithSuccess($result);
    }


}

