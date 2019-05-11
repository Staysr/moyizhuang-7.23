<?php

namespace App\Services\Api\Task;
use App\Model\ZdTask;
use App\Model\ZdTaskOrder;
use App\Plugins\DateTime\Order as OrderPlugin;

use Illuminate\Support\Facades\Redis;

/**
 * Class TaskService
 *
 * @package App\Services\Api\Task
 */
class TaskService
{

    protected $task;
    protected $sms;
    protected $request;
    protected $remark;
    protected $driver;
    protected $driver_id; //新司机ID
    protected $offer;
    protected $merchant;
    protected $time;
    protected $today;
    protected $current;
    protected $config;
    protected $taskType;
    protected $setting;
    protected $taskDeliveryPoint;

    public function __construct($request, $task, $sms)
    {
        $this->setTask($task);
        $this->setSms($sms);
        $this->setRequest($request);
        $this->setRemark($request->input('remark'));
        $this->setDriverId($request->input('driver_id'));
        $this->setDriver($task->driver);
        $this->setOffer(
            $task->offer->where('driver_id', $this->getDriverId())->first()
        );
        $this->setTime(time());
        $this->setToday(date('Y-m-d'));
        $this->setCurrent(date('Y-m-d H:i:s'));
        $this->setMerchant($task->merchant);
        $this->setConfig(json_decode(Redis::get("zhoudao:sysconfig"), true));
        $this->setSetting($task->setting);
        $this->setTaskDeliveryPoint($task->delivery);
    }


    public function taskConflict()
    {
        //非自己的任务
        $others = ZdTask::where(
            [
                'id' <> $this->getTask()->id,
                'status' => [0, 1, 2],
                'driver_status' => [1, 2],
                'driver_id'=> $this->getTask()->driver_id,
            ]
        )->append(
            ['ArrivalWarehouseTimeBefore', 'EstimateTimeAfter']
        )->get();
        $task = $this->getRealRange($this->getTask());
        foreach ($others as $i => $other) {
            $value = $this->getRealRange($other);
            foreach ($task as $j => $item) {
                foreach ($value as $key => $miss) {
                    $res = OrderPlugin::intersect(
                        $item,
                        $miss
                    );
                    if ($res) {
                        return false;
                    }
                }
            }
        }
    }


    /**
     * 实际范围时间
     * @param $task
     *
     * @return array
     * @author Mark
     * @date   2018/8/20 12:20
     */
    public function getRealRange($task){
        if ($task->type == 1) {
            $target = OrderPlugin::weeksToDateTime(
                $task->send_time,
                [
                    $task->ArrivalWarehouseTimeBefore,
                    $task->EstimateTimeAfter,
                ]
            );
        }else{
            $target = OrderPlugin::dateRangeToDateTime(
                $task->temp_start_date,
                $task->temp_end_date,
                [
                    $task->ArrivalWarehouseTimeBefore,
                    $task->EstimateTimeAfter,
                ]
            );
        }
        return $target;
    }

    public function isExceptCancel($task,$value){
        $cancel=[];
        //排除特定时间段的出车单时间
        ZdTaskOrder::where(
            [
                'id' => $task->id,
                'status' => [3,4,5,6],
            ]
        )->get()->each(function ($item) use ($cancel,$task){
            array_push($cancel,$item->arrival_warehouse_time);
            array_push($cancel,date("Y-m-d",strtotime($task->arrival_warehouse_time))." ".$task->estimate_time);
        });
        $diff = array_diff(array_map('json_encode', $value), array_map('json_encode', $cancel));
        $result= array_map('json_decode', $diff);
        return $result;
    }





    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param mixed $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getSms()
    {
        return $this->sms;
    }

    /**
     * @param mixed $sms
     */
    public function setSms($sms)
    {
        $this->sms = $sms;
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

    /**
     * @return mixed
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param mixed $remark
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param mixed $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->driver_id;
    }

    /**
     * @param mixed $driver_id
     */
    public function setDriverId($driver_id)
    {
        $this->driver_id = $driver_id;
    }

    /**
     * @return mixed
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param mixed $offer
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getToday()
    {
        return $this->today;
    }

    /**
     * @param mixed $today
     */
    public function setToday($today)
    {
        $this->today = $today;
    }

    /**
     * @return mixed
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param mixed $current
     */
    public function setCurrent($current)
    {
        $this->current = $current;
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
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getTaskType()
    {
        return $this->task->type == 1 ? 'master' : 'temp';
    }

    /**
     * @return mixed
     */
    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * @param mixed $setting
     */
    public function setSetting($setting)
    {
        $this->setting = $setting;
    }

    /**
     * @return mixed
     */
    public function getTaskDeliveryPoint()
    {
        return $this->taskDeliveryPoint;
    }

    /**
     * @param mixed $taskDeliveryPoint
     */
    public function setTaskDeliveryPoint($taskDeliveryPoint)
    {
        $this->taskDeliveryPoint = $taskDeliveryPoint;
    }


}
