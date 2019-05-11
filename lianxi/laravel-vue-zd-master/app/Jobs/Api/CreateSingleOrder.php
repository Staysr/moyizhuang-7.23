<?php

namespace App\Jobs\Api;

use App\Model\ZdOrderDeliveryPoint;
use App\Model\ZdTaskOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;

class CreateSingleOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;
    protected $date;


    /**
     * CreateSingleOrder constructor.
     *
     * @param $task
     * @param $date
     */
    public function __construct($task, $date)
    {
        $this->task = $task;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->insertOrder();
    }


    public function insertOrder()
    {

        $offer = ZdTaskOrder::where('driver_id', $this->task->driver_id)->first(
        );
        //如果是指派
        if ($this->task->assign_status == 1) {
            $exist['is_confirm_posts'] = 1;
        }
        $exist['driver_id'] = $this->task->driver_id;
        $exist['task_id'] = $this->task->id;
        $exist['merchant_id'] = $this->task->merchant_id;
        $exist['name'] = $this->task->name;
        $exist['warehouse_id'] = $this->task->warehouse_id;
        $exist['merchant_safe_id'] = $this->task->merchant_safe_id;
        $exist['delivery_point_remark'] = $this->task->delivery_point_remark;
        $exist['order_no'] = $this->createOrderNo();
        $exist['safe_fee'] = $this->getSafeFee(
            $this->task->safe
        );         //司机保险费
        $exist['merchant_safe_fee'] = $this->getSafeFee(
            $this->task->merchantSafe
        );          //商户保险费
        $exist['car_type_id'] = $this->task->driver->car_type_id;
        $exist['unit_price'] = $offer->unit_price;
        $exist['percentage'] = $offer->percentage;
        $exist['manage_fee'] = $offer->manage_fee;
        $exist['total_fee'] = $exist['unit_price'] - $exist['manage_fee']
            - $exist['safe_fee'];
        $exist['arrival_warehouse_time'] = $this->date." "
            .$this->task->arrival_warehouse_time;
        //生成出车单
        $NewOrder = ZdTaskOrder::create($exist);
        //生成位置
        $delivery = $this->task->delivery;
        if (!empty($delivery)) {
            foreach ($delivery->toArray() as $index => $item) {
                $item['order_id'] = $NewOrder->id;
                $item['is_fixed_point'] = 1;
                unset($item['id']);
                ZdOrderDeliveryPoint::create($item);
            }
        }
    }


    /**
     * 生成出车单编号
     *
     * @return string
     * @author Mark
     * @date   2018/8/14 16:42
     */
    public function createOrderNo()
    {
        $key = 'zhoudao:taskOrderNo:'.$this->task->merchant_id.date("ym");
        $inc = Redis::incr($key);
        if ($inc == 1) {
            Redis::expire($key, 2600600);
        }
        $orderNo = $this->task->merchant_id.date("ym").str_pad(
                $inc,
                4,
                "0",
                STR_PAD_LEFT
            );

        return $orderNo;
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



}
