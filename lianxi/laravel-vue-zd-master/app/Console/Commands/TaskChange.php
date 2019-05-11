<?php

namespace App\Console\Commands;

use App\Model\ZdTask;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class TaskChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zhoudao:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ZdTask Change';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        ZdTask::whereRaw("NOW()> offer_end_time")->where('status', 0)
            ->whereExists(
                function ($query) {
                    $query->select(DB::raw(1))
                        ->from('zd_task_offer')
                        ->whereRaw('zd_task.id=zd_task_offer.task_id')
                        ->where('status', 1);
                }
            )->update(['status' => 1]);

        ZdTask::whereRaw("NOW()> offer_end_time")->where('status', 0)
            ->whereNotExists(
                function ($query) {
                    $query->select(DB::raw(1))
                        ->from('zd_task_offer')
                        ->whereRaw('zd_task.id=zd_task_offer.task_id')
                        ->where('status', 1);
                }
            )->update(['status' => 5]);

        ZdTask::whereRaw("NOW()> choose_driver_end_time")->where(
            [['status', '=', 1], ['driver_id', '<>', 0]]
        )->update(['status' => 2, 'generated' => 1]);
        ZdTask::whereRaw("NOW()> choose_driver_end_time")->where(
            [['status', '=', 1], ['driver_id', '=', 0]]
        )->update(
            ['status' => 4]
        );
    }
}
