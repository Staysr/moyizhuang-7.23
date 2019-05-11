<?php

namespace App\Console\Commands;

use App\Jobs\Api\CreateSingleOrder;
use App\Jobs\Api\CreateTaskOrder;
use App\Model\ZdTask;
use App\Model\ZdTaskOffer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class NewOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zhoudao:NewOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'NewOrder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $nextWeekDay = date("Y-m-d", strtotime("+7 day"));
        ZdTask::where(['generated' => 1, 'status' => 2, 'type' => 1])->each(
                function ($item) use ($nextWeekDay) {
                    //如果是主任务，符合星期几条件，添加一条新任务
                    $week = date('w', strtotime($nextWeekDay));
                    $week == "0" ? $week = "7" : $week;
                    if (in_array($week, $item->send_time)) {
                        $offer = ZdTaskOffer::where(
                            [
                                'task_id'   => $item->id,
                                'driver_id' => $item->driver_id,
                            ]
                        )->first();
                        if ($offer['status'] == 1) {  //如果不是无责任解约,生成出车单
                            Bus::dispatch((new CreateSingleOrder($item,$nextWeekDay)));
                        }
                    }
                }
            );
    }
}
