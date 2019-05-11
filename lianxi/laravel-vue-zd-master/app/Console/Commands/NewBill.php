<?php

namespace App\Console\Commands;

use App\Model\ZdMerchant;
use App\Model\ZdMerchantBill;
use App\Model\ZdMonthBill;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class NewBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zhoudao:NewBill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'NewBill';

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
        $start = strtotime("-1 month");
        $merchant = ZdMerchant::get();
        foreach ($merchant as $index => $item) {
            $bill = [];
            $total = ZdMerchantBill::where('merchant_id', $item->id)->whereYear(
                'arrival_warehouse_time',
                '=',
                date('Y')
            )
                ->whereMonth('arrival_warehouse_time', '=', date('m', $start))
                ->sum('merchant_money');
            $bill['merchant_id'] = $item->id;
            $bill['bill_time'] = date('Y-m', $start);
            $bill['bill_no'] = $this->createBillNo($start);
            $bill['money'] = $total;
            $bill['repayment_money'] = 0;
            $bill['status'] = $total == 0 ? 3 : 0;
            ZdMonthBill::create($bill);
        }
    }


    /**
     * 生成订单号
     * @param $start
     *
     * @return string
     * @author Mark
     * @date   2018/8/21 17:12
     */
    public function createBillNo($start)
    {
        $key = 'zhoudao:billNo:'.date("Ym", strtotime("-1 month"));
        $inc = Redis::incr($key);
        if ($inc == 1) {
            Redis::expire($key, 2600600);
        }

        return date("Ym", $start).str_pad($inc, 2, "0", STR_PAD_LEFT);
    }
}
