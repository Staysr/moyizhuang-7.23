<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/7/18
 * Time: 14:50
 */

namespace App\Services\Api\Order;

use Illuminate\Support\Facades\Redis;

class OrderService
{
    protected $order;
    protected $task;
    protected $driver;
    protected $merchant;
    protected $time;
    protected $today;
    protected $current;
    protected $config;
    protected $taskType;
    protected $orderAll;
    protected $sms;
    protected $remark;
    protected $arrival_warehouse_time;
    protected $arrival_warehouse_date;
    protected $bill;
    protected $request;


    public function __construct($request,$order,$sms)
    {
        $this->setOrder($order);
        $this->setDriver($order->driver);
        $this->setTask($order->task);
        $this->setTime(time());
        $this->setMerchant($order->merchant);
        $this->setBill($order->bill);
        $this->setToday(date('Y-m-d'));
        $this->setCurrent(date('Y-m-d H:i:s'));
        $this->setConfig(json_decode(Redis::get("zhoudao:sysconfig"), true));
        $this->setSms($sms);
        $this->setRemark($request->input("remark"));
        $this->setRequest($request);
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
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
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
        return $this->getTask()->type == 1 ? 'master' : "temp";
    }

    /**
     * @param mixed $taskType
     */
    public function setTaskType($taskType)
    {
        $this->taskType = $taskType;
    }

    /**
     * @return mixed
     */
    public function getOrderAll()
    {
        return $this->getTask()->order;
    }

    /**
     * @param mixed $orderAll
     */
    public function setOrderAll($orderAll)
    {
        $this->orderAll = $orderAll;
    }

    /**
     * @return mixed
     */
    public function getArrivalWarehouseTime()
    {
        return $this->getOrder()->arrival_warehouse_time;
    }

    /**
     * @param mixed $arrival_warehouse_time
     */
    public function setArrivalWarehouseTime($arrival_warehouse_time)
    {
        $this->arrival_warehouse_time = $arrival_warehouse_time;
    }

    /**
     * @return mixed
     */
    public function getArrivalWarehouseDate()
    {
        return date(
            "Y-m-d",
            strtotime($this->getOrder()->arrival_warehouse_time)
        );
    }

    /**
     * @param mixed $arrival_warehouse_date
     */
    public function setArrivalWarehouseDate($arrival_warehouse_date)
    {
        $this->arrival_warehouse_date = $arrival_warehouse_date;
    }


    /**
     * @return mixed
     */
    public function getBill()
    {
        return $this->bill;
    }

    /**
     * @param mixed $bill
     */
    public function setBill($bill)
    {
        $this->bill = $bill;
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