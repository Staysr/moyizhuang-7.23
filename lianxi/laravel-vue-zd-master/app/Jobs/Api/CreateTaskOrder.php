<?php

namespace App\Jobs\Api;

use App\Facades\Util;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateTaskOrder extends CreateSingleOrder
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;


    /**
     * CreateTaskOrder constructor.
     *
     * @param $task
     * @param $date
     */
    public function __construct($task,$date=null)
    {
       parent::__construct($task,$date);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->makeTaskOrder();
    }


    /**
     * 循环生成出车单
     *
     * @author Mark
     * @date   2018/8/15 9:45
     */
    public function makeTaskOrder()
    {
        if ($this->task->type == 1) {
            $date = Util::getDateFromWeek(
                $this->task->arrival_date,
                $this->task->send_time
            );
        } else {
            $date = Util::getDateFromRange(
                $this->task->temp_start_date,
                $this->task->temp_end_date
            );
        }
        //生出出车单
        foreach ($date as $index => $item) {
            $this->setDate($item);
            $this->insertOrder();
        }
    }
}
