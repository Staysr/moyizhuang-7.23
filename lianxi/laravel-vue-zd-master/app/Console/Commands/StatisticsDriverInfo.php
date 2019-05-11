<?php

namespace App\Console\Commands;

use App\Plugins\Statistics\DriverInfo;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Model\StatisticsDriver;

class StatisticsDriverInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics:driver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '司机数据汇总数据';

    protected $defaultDate;
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $driver = new DriverInfo();
        $driver->setDate($this->getDate());
        $this->insert($driver->merge());
    }

    /**
     * 插入
     * @method insert
     * @param $data
     * @author luffyzhao@vip.126.com
     */
    protected function insert(Collection $data){
        DB::table('statistics_driver_info')->insert(
            $data->map(function ($item){
                return collect($item)->only([
                    'date', 'driver_id', 'big_id', 'small_id', 'order_complete_fee', 'order_complete_total', 'order_cancel_total', 'work_time', 'task_order_total', 'task_order_fee'
                ])->toArray();
            })->toArray()
        );
    }
    /**
     * 获取操作日期
     * @method getDate
     * @return string
     * @author luffyzhao@vip.126.com
     */
    protected function getDate(){
        if($this->hasArgument('date') && $this->validateDateFormat($date = $this->argument('date'))){
            return $date;
        }else{
            return Carbon::now()->subDay(2)->format('Y-m-d');
        }
    }
    /**
     * 验证是否时间格式
     * @method validateDateFormat
     * @param $value
     * @param string $format
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    private function validateDateFormat($value, $format = 'Y-m-d')
    {
        if (! is_string($value) && ! is_numeric($value)) {
            return false;
        }
        $date = DateTime::createFromFormat('!'.$format, $value);

        return $date && $date->format($format) == $value;
    }
}
