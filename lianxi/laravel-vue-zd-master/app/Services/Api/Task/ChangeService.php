<?php

namespace App\Services\Api\Task;

use Exception;

/**
 * Class ChangeService
 *
 * @package App\Services\Api\Task
 */
class ChangeService extends TaskService
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
        if (!in_array($this->getTask()->getOriginal('driver_status'), [0, 1, 2])) {
            throw new Exception("该任务已经完成或取消");
        }
        if ($this->getTask()->driver_id == 0) {
            throw new Exception("该任务没有司机");
        }
        if (!in_array($this->getTask()->status, [0, 1, 2])) {
            throw new Exception("该任务已经完成或取消");
        }

        if ($this->getTaskType() == 2
            && strtotime($this->getToday()) > $this->getTask()->temp_end_date
        ) {
            throw new Exception("该临时任务已经结束，无法变更司机");
        }
    }

    /**
     * 处理
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/14 14:35
     */
    public function handle()
    {
        $this->validator();
        $this->setRemark("舟到系统变更司机");

        if ($this->getTaskType() == 1
            && strtotime($this->getToday()) > strtotime(
                $this->getTask()->arrival_date
            )
        ) {
            $this->getTask()->arrival_date = $this->getToday();
        }
        if ($this->getTaskType() == 2
            && strtotime($this->getToday()) > $this->getTask()->temp_start_date
        ) {
            $this->getTask()->temp_start_date = $this->getToday();
        }

        $service = new RescindService(
            $this->getRequest(),
            $this->getTask(),
            $this->getSms(),
            $this->getTaskOrder(),
            $this->getOrderDelivery()

        );
        $service->handle(true);


        $AssignedService = new AssignedService(
            $this->getRequest(),
            $this->getTask(),
            $this->getSms(),
            $this->getTaskOrder(),
            $this->getTaskDelivery(),
            $this->getOrderDelivery(),
            $this->getNewDriver()
        );
        $AssignedService->setDriver(NULL);
        $AssignedService->handle(true);
    }


    /**
     * @return mixed
     * @author Mark
     * @date   2018/8/16 17:06
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
