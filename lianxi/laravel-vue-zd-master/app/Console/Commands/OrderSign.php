<?php

namespace App\Console\Commands;

use App\Model\ZdSysUser;
use App\Model\ZdTask;
use App\Model\ZdTaskOrder;
use App\Notifications\Push\Api\Task;
use App\Repositories\Modules\ZdSms\Interfaces as ZdSmsInterfaces;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class OrderSign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zhoudao:sign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zhoudao sign';

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
     * 发送提醒短信
     *
     * @param ZdSmsInterfaces $sms
     *
     * @author Mark
     * @date   2018/8/22 15:57
     */
    public function handle(ZdSmsInterfaces $sms)
    {
        $config = json_decode(Redis::get("zhoudao:sysconfig"), true);
        $smsBefore = $config['sms_before_warehouse_time'];
        $taskIds = ZdTask::where('status', 2)->pluck('id');
        if (!empty($taskIds)) {
            ZdTaskOrder::where(['remind_status' => 0, 'status' => 0])
                ->whereIn(
                    'task_id',
                    $taskIds
                )->whereRaw(
                    "arrival_warehouse_time <= (CURRENT_TIMESTAMP + INTERVAL {$smsBefore} MINUTE)"
                )->get()->each(
                    function ($order) use ($config, $sms) {
                        $order->remind_status = 1;
                        $driver = $order->driver;
                        $merchant = $order->merchant;
                        $quality = ZdSysUser::find($merchant->quality_id);
                        $supervisor = $driver->supervisor;
                        if ($driver) {
                            $content = "您有一个出车单还未签到，请尽快去签到吧；出车单号："
                                .$order['order_no']
                                ."，到仓时间：".$order['arrival_warehouse_time'];
                            $order->driver->notify(new Task($content));
                            $this->sendSms($sms, $driver->phone, $content);
                            //推送给岗控
                            if ($merchant && $quality) {
                                $remark = $driver->name.",".$driver->phone
                                    ." ,出车单号："
                                    .$order->order_no."，到仓时间："
                                    .$order->arrival_warehouse_time."未签到，请联系司机";
                                $this->sendSms($sms, $quality->phone, $remark);
                                if ($config['is_send_leader'] == 1
                                    && $supervisor
                                ) {
                                    $this->sendSms(
                                        $sms,
                                        $supervisor->phone,
                                        $remark
                                    );
                                }
                            }
                        }
                        $order->save();
                    }
                );
        }
    }


    /**
     * 出车单
     *
     * @param $sms
     * @param $phone
     * @param $content
     *
     * @return mixed
     * @author Mark
     * @date   2018/8/22 15:50
     */
    public function sendSms($sms, $phone, $content)
    {
        return $sms->create(
            [
                'mobile'   => $phone,
                'contents' => $content,
                'remark'   => '舟到系统提示签到',
            ]
        );
    }
}
