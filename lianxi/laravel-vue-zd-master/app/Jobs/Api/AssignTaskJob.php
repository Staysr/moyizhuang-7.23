<?php

namespace App\Jobs\Api;

use App\Model\ZdTask;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\Modules\ZdTask\Interfaces as ZdTaskRepo;
use App\Repositories\Modules\ZdTaskOffer\Interfaces as ZdTaskOfferRepo;
use Illuminate\Support\Facades\Bus;

class AssignTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $task;
    /**
     * @var
     */
    protected $request;

    /**
     * Create a new job instance.
     *
     * @param ZdTask $task
     * @param array $request
     */
    public function __construct(ZdTask $task, array $request)
    {
        $this->task = $task;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->replicate();
    }

    /**
     * 复制一个任务
     * replicate
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function replicate()
    {
       $drivers = $this->request['drivers'];
       $unitPrice = $this->request['unit_price'];

        $taskArr = [];
        $orderRepo = app(ZdTaskRepo::class);
        $offerRepo = app(ZdTaskOfferRepo::class);
        $task = $this->task;
        $task->status = 2;
        $task->driver_status = 2;

        foreach ($drivers as $driver){
            $task->driver_id = $driver;
            $newTask = $orderRepo->replicate($task);
            $offerRepo->create([
                'task_id' => $newTask->id,
                'driver_id' => $driver,
                'unit_price' => $unitPrice
            ]);
            dispatch((new CreateTaskOrder($newTask)));
        }

        return $taskArr;
    }


}
