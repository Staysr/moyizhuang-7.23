<?php
/**
 * 配送点观察模型类
 */

namespace App\Observers\Model;


use App\Model\ZdOrderDeliveryPoint;

class ZdOrderDeliveryPointObserver
{
    public function creating(ZdOrderDeliveryPoint $point)
    {
        $order=$point->order;
        $point->task_id=$order->task_id;
        $max = $order->delivery->max('sort');
        $point->sort = (int)$max + 1;
    }

    public function created(ZdOrderDeliveryPoint $point)
    {
        $point->order->point_count++;
        $point->order->save();
    }

    public function deleted(ZdOrderDeliveryPoint $point){
        $point->order->point_count--;
        if( $point->order->status==2){
            $point->order->exception_count--;
        }
        $point->order->save();
    }

}