<?php

namespace App\Services\Api\Task;

use App\Model\ZdDriverSub;
use App\Notifications\Push\Api\Task;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class RescindService
 *
 * @package App\Services\Api\Task
 */
class RescindService extends TaskService
{

    //集合
    protected $orderToday;
    protected $orderAfterToday;
    //接口
    protected $taskOrder;
    protected $orderDelivery;
    protected $content;
    //原有保价
    protected $oldOffer;


    public function __construct($request, $task, $sms,$taskOrder,$orderDelivery)
    {
        parent::__construct($request, $task, $sms);
        $this->setTaskOrder($taskOrder);
        $this->setOrderDelivery($orderDelivery);
        $this->setOrderAfterToday(
            $this->getTask()->orderAfterToday
        );
        $this->setOrderToday(
            $this->getTask()->orderToday
        );
        $this->setOldOffer( $this->getTask()->offer->where('driver_id', $this->getTask()->driver_id )->first());
    }


    /**
     * 验证
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/14 11:55
     */
    public function validator()
    {
        if ($this->getTask()->driver_id == 0) {
            throw new Exception("该司机已被无责任解约");
        }

        if (!empty($this->getOrderToday())) {
            $dispatch = $this->getConfig()[$this->getTaskType()
            .'_driver_task_free_driver_before_warehouse'];
            $less = $this->getTime() - strtotime(
                    $this->getTask()->arrival_warehouse_time
                );
            if ($less > 0 && $less > $dispatch * 3600) {
                throw new Exception("在司机到仓内{$dispatch}小时不允许解约司机");
            }
        }
    }


    /**
     * 处理
     *
     * @param bool $push
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/15 16:40
     */
    public function handle($push = true)
    {
        $this->validator();
        if ($this->getOrderToday()) {
            //将当天变成无责任解约
            $this->getOrderToday()->each(function ($item){
                $item->update(['status' => 5]);
            });
        }
        if ($this->getOrderAfterToday()) {
            //当天以后的出车单，都是未签到的
            $orderIds = $this->getOrderAfterToday()->pluck('id')->toArray();
            //删除当天以后的出车单和相关信息
            if (!empty($orderIds)) {
                $this->getOrderDelivery()->whereIn('order_id', $orderIds)->delete();
                $this->getTaskOrder()->whereIn('id', $orderIds)->delete();
                $this->getOldOffer()->fill(['status' => 2, 'rescind_reason' => $this->getRemark()])->save();
            }
        }

        $driverId=$this->getTask()->driver_id;
        $this->getTask()->driver_status = 0;
        $this->getTask()->rescind_id = $this->getTask()->driver_id;
        $this->getTask()->driver_id = 0;
        $this->getTask()->rescind_time = $this->getCurrent();
        $this->getTask()->remark = $this->getRemark();
        $this->getTask()->save();

        //司机副表
        $DriverSub = ZdDriverSub::firstOrNew(
            ['driver_id' => $driverId],
            ['checked_count'=>0]
        );
        $DriverSub->checked_count--;
        $DriverSub->save();
        if ($push == true) {
            $this->push();
        }
    }

    /**
     * 回调
     *
     * @author Mark
     * @date   2018/8/7 10:51
     */
    public function push()
    {
        $this->setContent(
            "您已经被无责任解约了, 客户：{$this->getMerchant()->short_name}，线路：{$this->getTask()->name}，客户于{$this->getToday()}与司机解约，司机最后配送日期为{$this->getToday()}"
        );
        $this->getDriver()->notify(new Task($this->getContent()));
        $this->getSms()->create(
            [
                'mobile'   => $this->getDriver()->phone,
                'contents' => $this->getContent(),
                'remark'   => '舟到系统无责任解约司机',
            ]
        );

    }

    /**
     * @return mixed
     */
    public function getOrderToday()
    {
        return $this->orderToday;
    }

    /**
     * @param mixed $orderToday
     */
    public function setOrderToday($orderToday)
    {
        $this->orderToday = $orderToday;
    }


    /**
     * @return mixed
     */
    public function getOrderAfterToday()
    {
        return $this->orderAfterToday;
    }

    /**
     * @param mixed $orderAfterToday
     */
    public function setOrderAfterToday($orderAfterToday)
    {
        $this->orderAfterToday = $orderAfterToday;
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

    /**
     * @return mixed
     */
    public function getOrderDelivery()
    {
        return $this->orderDelivery;
    }

    /**
     * @param mixed $orderDelivery
     */
    public function setOrderDelivery($orderDelivery)
    {
        $this->orderDelivery = $orderDelivery;
    }

    /**
     * @return mixed
     */
    public function getTaskOrder()
    {
        return $this->taskOrder;
    }

    /**
     * @param mixed $taskOrder
     */
    public function setTaskOrder($taskOrder)
    {
        $this->taskOrder = $taskOrder;
    }

    /**
     * @return mixed
     */
    public function getOldOffer()
    {
        return $this->oldOffer;
    }

    /**
     * @param mixed $oldOffer
     */
    public function setOldOffer($oldOffer)
    {
        $this->oldOffer = $oldOffer;
    }








}
