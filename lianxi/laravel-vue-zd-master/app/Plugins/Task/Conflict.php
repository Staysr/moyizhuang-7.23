<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2018/9/4
 * Time: 11:54
 */

namespace App\Plugins\Task;


use App\Model\ZdTask;
use App\Plugins\DateTime\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Conflict
{
    /**
     * 检测是否冲突
     * @param Collection $collection
     * @param ZdTask $task
     * @param Collection $cancelOrders
     */
    public static function validator(Collection $collection, ZdTask $task, Collection $cancelOrders)
    {
        $collection->each(
            function ($item) use ($task, $cancelOrders) {
                $dateTimeRange = self::convertDateTimeRange($item);
                $dateTimeRange1 = self::convertDateTimeRange($task);

                foreach ($dateTimeRange as $val){
                    foreach ($dateTimeRange1 as $val1){
                        if(Order::intersect($val, $val1)){
                            $conflict = true;

                            // 是否冲突的这个出车单是取消状态
                            $filtered = $cancelOrders->where('task_id', $item['id']);
                            if($filtered->isNotEmpty()){
                                $filtered->each(function ($item) use ($val, &$conflict){
                                    $arrivalWarehouseTime = Carbon::parse($item['arrival_warehouse_time']);
                                    if($arrivalWarehouseTime->gt($val[0]) && $arrivalWarehouseTime->lt($val[1])){
                                        $conflict = false;
                                        return false;
                                    }
                                });
                            }

                            if($conflict){
                                throw new \Exception('任务冲突, 冲突ID:' . $item['id']);
                            }
                        }
                    }
                }
            }
        );
    }

    /**
     * 任务时间转换
     * @param ZdTask $item
     * @return array
     */
    protected static function convertDateTimeRange(ZdTask $item)
    {
        return ($item->type === 1) ? Order::weeksToDateTime(
            $item->send_time,
            [
                $item->arrival_warehouse_time,
                $item->estimate_time,
            ]
        ) : Order::dateRangeToDateTime(
            $item->temp_start_date,
            $item->temp_end_date,
            [
                $item->arrival_warehouse_time,
                $item->estimate_time,
            ]
        );
    }
}