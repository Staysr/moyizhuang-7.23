<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/7/18
 * Time: 14:50
 */

namespace App\Services\Api\Order;

use App\Model\ZdDriverDays;
use App\Model\ZdDriverSub;
use App\Model\ZdMerchantBill;
use Exception;

/**
 * Class FinishService
 *
 * @package App\Services\Api\Order
 */
class FinishService extends OrderService
{
    protected $content;

    public function __construct($request, $order, $sms)
    {
        parent::__construct($request, $order, $sms);
    }


    /**
     * 验证
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/3 14:53
     */
    public function validator()
    {
        if (in_array($this->getOrder()->status, [3, 4, 5, 6])) {
            throw new Exception("司机必须处于未签到,已签到或配送中状态");
        }


    }

    /**
     * 处理
     *
     * @param bool $push 是否推送
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/3 15:01
     */
    public function handle($push = true)
    {
        $this->validator();
        $this->getOrder()->status = 3;
        $this->getOrder()->punch_time = $this->getOrder()->punch_time
            ? $this->getOrder()->punch_time : $this->getCurrent();
        $this->getOrder()->leaves_warehouse_time = $this->getOrder(
        )->leaves_warehouse_time ? $this->getOrder()->leaves_warehouse_time
            : $this->getCurrent();
        $this->getOrder()->finish_time = $this->getCurrent();
        $this->getOrder()->is_one_step_finish = 1;
        $this->getOrder()->remark = $this->getRemark();
        $this->getOrder()->save();

        //更新大B状态
        $this->getDriver()->is_big_work=0;
        $this->getDriver()->save();

        $this->callback();
    }


    /**
     * 回调
     *
     * @author Mark
     * @date   2018/8/3 15:34
     */
    public function callback()
    {
        //一键完成更新 未操作的妥投点
        $PendingDelivery = $this->getOrder()->PendingDelivery();
        if (!empty($PendingDelivery)) {
            $PendingDelivery->update(
                [
                    'status'      => 1,
                    'reason'      => $this->getRemark(),
                    'finish_time' => $this->getCurrent(),
                ]
            );
        }
        ///临时任务且是最后一个出车单
        if ($this->getTask()->type == 2
            && $this->getTask()->temp_end_date
            == $this->getArrivalWarehouseDate()
        ) {
            $this->getTask()->fill(['driver_status' => 3])->save();
        }
        //添加账单
        $this->insertBill();

        //每天配送次数+1,配送完成次数+1
        $DriverDay = ZdDriverDays::firstOrNew(
            [
                'driver_id'   => $this->getOrder()->driver_id,
                'finish_date' => $this->getToday(),
            ],
            [
                'times'=>0
            ]
        );
        $DriverDay->times++;
        $DriverDay->save();
        $DriverSub = ZdDriverSub::firstOrNew(
            ['driver_id' => $this->getOrder()->driver_id],
            [
                'complete_count'=>0
            ]
        );
        $DriverSub->complete_count++;
        $DriverSub->save();
    }


    public function insertBill()
    {
        $Bill = new ZdMerchantBill();
        $Bill->order_id = $this->getOrder()->id;
        $Bill->driver_id = $this->getOrder()->driver_id;
        $Bill->merchant_id = $this->getOrder()->merchant_id;
        $Bill->charge_type = 1;
        $Bill->charge_type = $this->getTask()->type;
        $Bill->money = $this->getOrder()->total_fee;
        $Bill->merchant_money = $this->getOrder()->merchant_safe_fee
            + $this->getOrder()->unit_price;
        $Bill->arrival_warehouse_time
            = $this->getArrivalWarehouseTime();
        $Bill->save();
    }


    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


}