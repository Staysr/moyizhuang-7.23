<?php

namespace App\Services\Api\Task;

use App\Model\ZdTask;
use App\Model\ZdTaskOrder;
use App\Plugins\DateTime\Order as OrderPlugin;

/**
 * Class TaskConflictService
 *
 * @package App\Services\Api\Task
 */
class TaskConflictService
{

    protected $task;

    public function __construct($task)
    {
        $this->setTask($task);
    }


    public function taskConflict()
    {
        //非自己的任务
        $others = ZdTask::where('id', '<>', $this->getTask()->id)->whereIn(
            'status',
            [0, 1, 2]
        )->whereIn('driver_status', [1, 2])->where(
            'driver_id',
            request()->input('driver_id')
        )->get()->each(
            function ($item) {
                $item->append(
                    ['ArrivalWarehouseTimeBefore', 'EstimateTimeAfter']
                );
            }
        );
        //选中任务天数
        $task = $this->getRealRange($this->getTask(), true);
        $cancel=$this->getCancelOrder();
        foreach ($others as $i => $other) {
            $value = $this->getRealRange($other);
            $less = $this->isExceptCancel($value, $cancel);
            foreach ($task as $j => $item) {
                foreach ($less as $key => $miss) {
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

        return true;
    }

    /**
     * 实际范围时间
     *
     * @param $task
     * @param $turn
     *
     * @return array
     * @author Mark
     * @date   2018/8/20 12:20
     */
    public function getRealRange($task, $turn = false)
    {
        if ($task->type == 1) {
            $target = OrderPlugin::weeksToDateTime(
                $task->send_time,
                [
                    $task->ArrivalWarehouseTimeBefore,
                    $task->EstimateTimeAfter,
                ]
            );
        } else {
            $target = OrderPlugin::dateRangeToDateTime(
                $task->temp_start_date,
                $task->temp_end_date,
                [
                    $task->ArrivalWarehouseTimeBefore,
                    $task->EstimateTimeAfter,
                ]
            );
        }

        if ($turn == true) {
            array_map(
                function ($item) use ($task) {
                    if ($task->BeforeCrossDay) {
                        $item->subDay(1);
                    }
                    if ($task->AfterCrossDay) {
                        $item->addDay(1);
                    }

                    return $item;
                },
                $target
            );

            return $target;
        }

        return $target;
    }


    public function getCancelOrder()
    {
        $cancel = ZdTaskOrder::where('driver_id', request()->driver_id)
            ->whereIn(
                'status',
                [3, 4, 5, 6]
            )->get()->each(
            function ($item) {

                $now = $after=date(
                    "Y-m-d",
                    strtotime($item->arrival_warehouse_time)
                );

                if (strtotime($item->task->arrival_warehouse_time) > strtotime(
                        $item->task->estimate_time
                    )
                ) {
                    $after = date(
                        "Y-m-d",
                        strtotime($item->arrival_warehouse_time) + 86400
                    );
                }

                $item->ArrivalWarehouseTimeBefore = $now." "
                    .$item->task->ArrivalWarehouseTimeBefore.":00";
                $item->finishTimeCal = $after." "
                    .$item->task->EstimateTimeAfter
                    .":00";
            }
        )->toArray();

        return $cancel;
    }


    /**
     * 排除特定状态的出车单时间范围
     *
     * @param $value
     * @param $cancel
     *
     * @return array
     * @author Mark
     * @date   2018/8/20 14:39
     */
    public function isExceptCancel($value, $cancel)
    {

        if (empty($cancel)) {
            return $value;
        }
        foreach ($value as $index => $item) {
            foreach ($cancel as $j => $fish) {
                if (strtotime($item[0]->toDateTimeString()) >= strtotime(
                        $fish['ArrivalWarehouseTimeBefore']
                    )
                    && strtotime($item[1]->toDateTimeString())
                    <= strtotime($fish['finishTimeCal'])
                ) {
                    unset($value[$index]);
                }
            }
        }
        sort($value);

         return $value;


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


}
