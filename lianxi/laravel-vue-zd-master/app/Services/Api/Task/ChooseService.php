<?php

namespace App\Services\Api\Task;

use App\Facades\Util;
use App\Jobs\Api\CreateTaskOrder;
use App\Model\ZdDriverSub;
use App\Notifications\Push\Api\Task;
use Exception;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Redis;

/**
 * Class ChooseService
 *
 * @package App\Services\Api\Task
 */
class ChooseService extends TaskService
{
    //接口
    protected $taskOrder;
    protected $taskDelivery;
    protected $orderDelivery;
    protected $newDriver;
    //内容
    protected $content;
    //布尔值
    protected $ignore;

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
        if (!in_array($this->getTask()->status, [0, 1])) {
            throw new Exception("任务状态必须是司机报价中，选择司机中");
        }
        if ($this->getTask()->getOriginal('driver_status') == 5) {
            throw new Exception("司机状态已无责任解约");
        }
        if (empty($this->getOffer())) {
            throw new Exception("该司机没有报价");
        }
        if ($this->getOffer()->status != 1) {
            throw new Exception("司机{$this->getDriver()->name}已取消报价");
        }

        //任务冲突
        $Conflict=new TaskConflictService($this->getTask());
        if ($Conflict->taskConflict()===false){
            throw new Exception("任务".$this->getTask()->id."与现有任务冲突");
        }

    }


    /**
     * 处理
     *
     * @param bool $ignore true为选择，false为指派
     * @param bool $push
     * @param      $offer
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/14 15:48
     */
    public function handle($ignore = true, $push = true, $offer = null)
    {
        $this->setIgnore($ignore);
        if ($ignore == true) {
            $this->validator();
            $this->getTask()->driver_id = $this->getDriverId();
            $this->getTask()->rescind_id = 0;
            $this->getTask()->driver_status = 1;
            $this->getTask()->rescind_time = null;
            $this->getTask()->choose_driver_time = $this->getCurrent();
            $this->getTask()->save();
        }
        //指派需要更新Offer对象
        if ($ignore == false && $offer != null) {
            $this->setOffer($offer);
        }
        //生成出车单
        Bus::dispatch((new CreateTaskOrder($this->getTask())));
        //司机副表
        $DriverSub = ZdDriverSub::firstOrNew(
            ['driver_id' => $this->getDriverId()],
            ['checked_count'=>0]
        );
        $DriverSub->checked_count++;
        $DriverSub->save();
        if ($push == true) {
            $this->push();
        }
    }

    /**
     * 推送
     *
     * @author Mark
     * @date   2018/8/3 15:35
     */
    public function push()
    {
        $this->setContent(
            "您已被选中，请尽快确认上岗 ;报价任务：{$this->getTask()->id},客户:{$this->getMerchant()->short_name},上岗时间：{$this->getTask()->arrival_date} {$this->getTask()->arrival_warehouse_time}, 预计完成时间 {$this->getTask()->estimate_time}"
        );
        $this->getNewDriver()->notify(new Task($this->getContent()));
        $this->getSms()->create(
            [
                'mobile' => $this->getNewDriver()->phone,
                'contents' => $this->getContent(),
                'remark' => '舟到系统选择司机',
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

    /**
     * @return mixed
     */
    public function getIgnore()
    {
        return $this->ignore;
    }

    /**
     * @param mixed $ignore
     */
    public function setIgnore($ignore)
    {
        $this->ignore = $ignore;
    }


}
