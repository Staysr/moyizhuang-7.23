<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/7/18
 * Time: 14:50
 */

namespace App\Services\Api\Bill;


/**
 * Class RepayService
 *
 * @package App\Services\Api\Bill
 */
class RepayService
{
    protected $request;
    protected $merchant;

    public function __construct($request, $merchant)
    {
        $this->setRequest($request);
        $this->setMerchant($merchant);
    }


    /**
     * 处理
     * @author Mark
     * @date   2018/8/9 12:10
     */
    public function handle()
    {
        $money = $this->getRequest()->input('money');

        //该商户待还款，和部分还款的数据
        $wait = $this->getMerchant()->checkedWaitBill()->get();
        foreach ($wait as $index => $item) {
            $left = $item->money - $item->repayment_money;
            $temp = $money;
            $money = $money - $left;
            if ($money >= 0) {
                $this->repayBill($item, 2, $left); //已经还款
            } else {
                $this->repayBill($item, 1, $temp); //部分还款
                break;
            }
        }

        //添加还款记录
        $this->getMerchant()->RepayLog()->create(
            [
                'repay_money' => $this->getRequest()->input('money'),
                'type'        => 1,
                'remark'      => $this->getRequest()->input('remark'),
            ]
        );

        //更新商户最近还款记录,还有钱
        $account = $this->getMerchant()->account()->first();
        if ($money > 0) {
            $account->account = $account->account + $money;
        }
        $account->latest_repayment_time = date('Y-m-d H:i:s');
        $account->save();

    }


    /**
     * 还款操作
     * @param $bill
     * @param $status
     * @param $money
     *
     * @author Mark
     * @date   2018/8/9 12:10
     */
    public function repayBill($bill, $status, $money)
    {
        $bill->status = $status;
        $bill->repayment_money = $bill->repayment_money + $money;
        $bill->last_repayment_time = date('Y-m-d H:i:s');
        $bill->save();

    }


    /**
     * @return mixed
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param mixed $merchant
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
    }


    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }


}