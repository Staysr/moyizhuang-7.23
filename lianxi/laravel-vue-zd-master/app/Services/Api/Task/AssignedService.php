<?php

namespace App\Services\Api\Task;

use App\Model\ZdDriverSub;
use App\Model\ZdTaskOffer;
use App\Notifications\Push\Api\Task;
use Exception;
use Illuminate\Support\Facades\Redis;

/**
 * Class AssignedService
 *
 * @package App\Services\Api\Task
 */
class AssignedService extends TaskService
{
    //接口
    protected $taskOrder;
    protected $taskDelivery;
    protected $orderDelivery;
    protected $newDriver;
    //内容
    protected $content;

    public function __construct(
        $request,
        $task,
        $sms,
        $taskOrder,
        $taskDelivery,
        $orderDelivery,
        $newDriver
    ) {
        parent::__construct($request, $task, $sms);
        //接口
        $this->setTaskOrder($taskOrder);
        $this->setTaskDelivery($taskDelivery);
        $this->setOrderDelivery($orderDelivery);
        //新司机信息
        $this->setNewDriver($newDriver->find($this->getDriverId()));
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
        if ($this->getDriver()) {
            throw new Exception("已有司机被选中");
        }
        if ($this->getTask()->getOriginal('driver_status') == 5) {
            throw new Exception("司机状态已无责任解约");
        }
    }


    /**
     * 处理
     *
     * @param bool $push
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/16 14:58
     */
    public function handle($push = true)
    {
        $this->validator();
        $offer=$this->addTaskOffer();
        $ChooseService = new ChooseService(
            $this->getRequest(),
            $this->getTask(),
            $this->getSms(),
            $this->getTaskOrder(),
            $this->getTaskDelivery(),
            $this->getOrderDelivery(),
            $this->getNewDriver()
        );
        $ChooseService->handle(false , false,$offer);
        //保存
        $this->getTask()->rescind_id = 0;
        $this->getTask()->rescind_time = NULL;
        $this->getTask()->choose_driver_time = $this->getCurrent();
        $this->getTask()->driver_id = $this->getDriverId();
        $this->getTask()->offer_count++;
        $this->getTask()->driver_status = 2;
        $this->getTask()->assign_status = 1;
        $this->getTask()->work_time = $this->getCurrent();
        $this->getTask()->save();
        //推送
        if ($push = true) {
            $this->push();
        }
    }


    /**
     * 添加或更新保价
     * @author Mark
     * @date   2018/8/16 16:23
     */
    public function addTaskOffer()
    {
        $DriverSub = ZdDriverSub::firstOrNew(
            ['driver_id' => $this->getDriverId()],
            [
                'offer_count'=>0,
                'work_count'=>0,
            ]
        );
        //如果之前没有保价
        if (empty($this->getOffer())) {
            $DriverSub->offer_count++;
        }
        $DriverSub->work_count++;
        $DriverSub->save();

        $fee = $this->getRequest()->unit_price * $this->getConfig()['percentage']
            * 0.01;
        $offer=ZdTaskOffer::updateOrCreate(
            [
                'driver_id' => $this->getDriverId(),
                'task_id'   => $this->getTask()->id,
            ],
            [
                'driver_id'         => $this->getDriverId(),
                'unit_price'        => $this->getRequest()->unit_price,
                'percentage'        => $this->getConfig()['percentage'],
                'manage_fee'        => $fee,
                'driver_income_fee' => $this->getRequest()->unit_price - $fee,
                'status'            => 1,
                'remark'            => '舟到系统指派司机',
            ]
        );
        $this->setOffer($offer);
        return $offer;
     }

    /**
     * 推送
     *
     * @author Mark
     * @date   2018/8/3 15:35
     */
    public function push()
    {
        $price = $this->getRequest()->unit_price - $this->getOffer(
            )->manage_fee;
        $this->setContent(
            "您有一个指派任务; 每趟价格：{$price} 元,客户:{$this->getMerchant()->short_name},上岗时间：{$this->getTask()->arrival_date} {$this->getTask()->arrival_warehouse_time}, 预计完成时间 {$this->getTask()->estimate_time}"
        );
        $this->getNewDriver()->notify(new Task($this->getContent()));
        $this->getSms()->create(
            [
                'mobile'   => $this->getNewDriver()->phone,
                'contents' => $this->getContent(),
                'remark'   => '舟到系统指派司机',
            ]
        );
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
    public function getNewDriver()
    {
        return $this->newDriver;
    }

    /**
     * @param mixed $newDriver
     */
    public function setNewDriver($newDriver)
    {
        $this->newDriver = $newDriver;
    }

    /**
     * @return mixed
     */
    public function getTaskDelivery()
    {
        return $this->taskDelivery;
    }

    /**
     * @param mixed $taskDelivery
     */
    public function setTaskDelivery($taskDelivery)
    {
        $this->taskDelivery = $taskDelivery;
    }


}
