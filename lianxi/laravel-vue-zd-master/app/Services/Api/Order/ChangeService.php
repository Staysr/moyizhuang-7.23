<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/7/18
 * Time: 14:50
 */

namespace App\Services\Api\Order;

use App\Notifications\Push\Api\Order;
use Exception;

/**
 * Class ChangeService
 *
 * @package App\Services\Api\Order
 */
class ChangeService extends OrderService
{
    protected $content;


    /**
     * 验证
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/3 14:53
     */
    public function validator()
    {
        //设置不配送，运营取消，无责任解约
        if (in_array($this->getOrder()->status, [4, 5, 6])) {
            throw new Exception("司机不处于配送状态");
        }
        if (date(
                'Y-m-d',
                strtotime(
                    $this->getRequest()->input('arrival_warehouse_time')
                )-86400
            )
            != $this->getArrivalWarehouseDate()
            || date(
                'Y-m-d',
                strtotime($this->getRequest()->input('arrival_warehouse_time'))
            ) != $this->getArrivalWarehouseDate()
        ) {
            ;
        } else {
            throw new Exception("只能修改近两天出车单的到仓时间");
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
        $unitPrice = $this->getRequest()->input('unit_price');
        //如果是零，金额全部置零
        if ($unitPrice == 0) {
            $this->getOrder()->fill(
                [
                    'unit_price'        => 0,
                    'safe_fee'          => 0,
                    'merchant_safe_fee' => 0,
                    'total_fee'         => 0,
                    'manage_fee'        => 0
                ]
            )->save();
        } else {
            //到仓时间调整
            if ($this->getOrder()->status == 0) {
                $this->getOrder()->arrival_warehouse_time = $this->getRequest()
                    ->input('arrival_warehouse_time');
            }
            //司机保险费
            $safeFee = $this->getSafeFee($this->getOrder()->safe);
            //商户保险费
            $merchantSafe = $this->getSafeFee($this->getOrder()->merchantSafe);
            //管理费
            $manageFee = $unitPrice * $this->getConfig()['percentage'] * 0.01;

            $this->getOrder()->unit_price = $unitPrice;
            $this->getOrder()->safe_fee = $safeFee;
            $this->getOrder()->merchant_safe_fee = $merchantSafe;
            $this->getOrder()->manage_fee = $manageFee;
            $this->getOrder()->total_fee = $unitPrice - $safeFee - $manageFee;
            $this->getOrder()->remark = $this->getRemark();
            $this->getOrder()->save();

            //账单
            if($this->getOrder()->status==3){
                $this->getBill()->money=$unitPrice - $safeFee - $manageFee;
                $this->getBill()->merchant_money=$unitPrice+$merchantSafe;
                $this->getBill()->save();
            }

        }
        if ($push == true) {
            $this->push();
        }
    }


    /**
     * 回调
     * @author Mark
     * @date   2018/8/7 10:51
     */
    public function push()
    {
        $time=$this->getRequest()->input('arrival_warehouse_time');
        $this->setContent(
            "您有一个出车单,到仓时间已调整,客户：{$this->getMerchant()->short_name}，线路：{$this->getTask()->name}，出车单号：{$this->getOrder()->order_no}，到仓时间调整为 {$time}"
        );
        $this->getDriver()->notify(new Order($this->getContent()));
        $this->getSms()->create(
            [
                'mobile'   => $this->getDriver()->phone,
                'contents' => $this->getContent(),
                'remark'   => '舟到系统修改到仓时间',
            ]
        );

    }


    /**
     * 获取保险费
     *
     * @param $Safe
     *
     * @return float|int
     * @author Mark
     * @date   2018/8/7 10:40
     */
    public function getSafeFee($Safe)
    {
        if (empty($Safe)) {
            $fee = 0;
        } elseif ($Safe->is_per == 0) {
            $fee = $Safe->safe_fee;
        } else {
            $fee = $Safe->safe_fee * $Safe->total_fee * 0.01;
        }

        return $fee;
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

    public function __construct($request, $order, $sms)
    {
        parent::__construct($request, $order, $sms);
    }


}