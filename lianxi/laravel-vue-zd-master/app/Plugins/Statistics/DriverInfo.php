<?php
/**
 * zdapp
 * DriverInfo.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Plugins\Statistics;


use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DriverInfo
{
    /**
     * 日期
     * @var string
     * @author luffyzhao@vip.126.com
     */
    protected $date = '';

    /**
     * 上级
     * @var int
     * @author luffyzhao@vip.126.com
     */
    protected $supervisorId = 0;

    /**
     * 所统一的司机IDs
     * @var array
     * @author luffyzhao@vip.126.com
     */
    protected $driverIds = [];
    /**
     * @var array
     * @author luffyzhao@vip.126.com
     */
    protected $driverInfo = [];

    /**
     * 在线时长
     * @method workTime
     * @author luffyzhao@vip.126.com
     */
    public function workTime(): Collection
    {
        if ($this->isToDay()) {
            $startTime = '06:00:00';
            $endTiem = '20:00:00';

            return DB::table('base_driver_work_time')
                ->select(
                    [
                        'driver_id',
                        DB::Raw(
                            'SUM(
                    UNIX_TIMESTAMP(IF(FROM_UNIXTIME(UNIX_TIMESTAMP(end_time),\'%H:%s:%i\')  >= \''.$endTiem.'\',FROM_UNIXTIME(UNIX_TIMESTAMP(end_time),FROM_UNIXTIME(UNIX_TIMESTAMP(end_time),\'%Y:%m:%d '.$endTiem.'\')),end_time)) - 
                    UNIX_TIMESTAMP(IF(FROM_UNIXTIME(UNIX_TIMESTAMP(start_time),\'%H:%s:%i\') <= \''.$startTime.'\',FROM_UNIXTIME(UNIX_TIMESTAMP(start_time),FROM_UNIXTIME(UNIX_TIMESTAMP(start_time),\'%Y:%m:%d '.$startTime.'\')),start_time))) as work_time'
                        ),
                    ]
                )
                ->where('work_date', '=', $this->getDate())
                ->whereRaw("FROM_UNIXTIME(UNIX_TIMESTAMP(end_time),'%H:%s:%i') > '{$startTime}'")
                ->whereRaw("FROM_UNIXTIME(UNIX_TIMESTAMP(start_time),'%H:%s:%i') <  '{$endTiem}'")
                ->whereIn('driver_id', $this->getDriverIds())
                ->groupBy('driver_id')->get();
        } else {
            return DB::table('base_driver_info_work_time')
                ->select(['driver_id', 'valid_work_time as work_time'])
                ->whereIn('driver_id', $this->getDriverIds())
                ->where('work_date', $this->getDate())
                ->get();
        }
    }

    /**
     * 小B订单数据
     * @method order
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function order()
    {
        return DB::table('order_details')
            ->select(
                [
                    'driver_id',
                    DB::Raw(
                        'SUM(CASE WHEN order_status IN (6, 7, 8) THEN `total_fee` ELSE 0 END) as `order_complete_fee`'
                    ),
                    DB::Raw('SUM(CASE WHEN order_status IN (6, 7, 8) THEN 1 ELSE 0 END) as order_complete_total'),
                    DB::Raw('SUM(CASE WHEN order_status IN (4,5,10,11) THEN 1 ELSE 0 END) as order_cancel_total'),
                ]
            )
            ->whereIn('driver_id', $this->getDriverIds())->groupBy(['driver_id'])
            ->whereBetween('appointment_time', $this->getBetweenDateTime())->get();
    }

    /**
     * 出车单统计
     * @method taskOrder
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function taskOrder()
    {
        return DB::table('zd_task_order')
            ->select(
                [
                    'driver_id',
                    DB::Raw('COUNT(1) as task_order_total'),
                    DB::Raw('SUM(total_fee) as task_order_fee'),
                ]
            )
            ->whereIn('driver_id', $this->getDriverIds())
            ->where('status', '=', 3)
            ->groupBy(['driver_id'])
            ->whereBetween('punch_time', $this->getBetweenDateTime())->get();
    }

    /**
     * 大B接单人数
     * @method taskOrderNumber
     * @author luffyzhao@vip.126.com
     */
    public function taskOrderNumber(){
        return (int) DB::table('zd_task_order')->whereIn('driver_id', $this->getDriverIds())
            ->where('status', '=', 3)
            ->whereBetween('punch_time', $this->getBetweenDateTime())->count();
    }

    /**
     * 大B接单人数
     * @method orderNumber
     * @author luffyzhao@vip.126.com
     */
    public function orderNumber(){
        return (int) DB::table('order_details')->whereIn('order_status', [6, 7, 8])->whereIn('driver_id', $this->getDriverIds())
            ->whereBetween('appointment_time', $this->getBetweenDateTime())->count();
    }

    /**
     * 小队人数
     * @method number
     * @return int
     * @author luffyzhao@vip.126.com
     */
    public function number(){
        return count($this->getDriverIds());
    }
    /**
     * @param int $supervisorId
     * @return DriverInfo
     */
    public function setSupervisorId(int $supervisorId): DriverInfo
    {
        $this->supervisorId = $supervisorId;
        $this->driverIds = [];
        $this->driverInfo = [];

        return $this;
    }

    /**
     * @param array $driverIds
     * @return DriverInfo
     */
    public function setDriverIds(array $driverIds): DriverInfo
    {
        $this->driverIds = $driverIds;

        return $this;
    }

    /**
     * @return int
     */
    public function getSupervisorId(): int
    {
        return $this->supervisorId;
    }

    /**
     * @return array
     */
    public function getDriverInfo()
    {
        if (empty($this->driverInfo)) {
            if ($this->isNowData()) {
                $query = DB::table('base_driver_info')
                    ->select(
                        [
                            'id as driver_id',
                            'name',
                            'type as driver_type',
                            'category_code',
                            DB::Raw('SUBSTRING_INDEX(`supervisors`,\',\', 1) AS big_id'),
                            DB::Raw('SUBSTRING_INDEX(SUBSTRING_INDEX (`supervisors`,\',\', 2), \',\', -1) AS small_id'),
                        ]
                    )
                    ->where('app_status', '=', 1)->where('status', '=', 1);
            } else {
                $query = DB::table('base_driver_incumbency')
                    ->join('base_driver_info', 'base_driver_incumbency.driver_id', '=', 'base_driver_info.id')
                    ->select(
                        [
                            'base_driver_incumbency.driver_id',
                            'base_driver_info.name',
                            'base_driver_incumbency.driver_type',
                            'base_driver_incumbency.category_code',
                            DB::Raw('SUBSTRING_INDEX(`base_driver_incumbency`.`supervisors`,\',\', 1) AS big_id'),
                            DB::Raw(
                                'SUBSTRING_INDEX(SUBSTRING_INDEX (`base_driver_incumbency`.`supervisors`,\',\', 2), \',\', -1) AS small_id'
                            ),
                        ]
                    )->where('base_driver_incumbency.date', '=', $this->getDate());
            }
            if ($this->getSupervisorId()) {
                $query->whereRaw('FIND_IN_SET('.$this->getSupervisorId().', `base_driver_info`.`supervisors`)');
            }
            $this->driverInfo = $query->get()->map(
                function ($item) {
                    $item = (array) $item;
                    $item['date'] = $this->getDate();
                    return $item;
                }
            );
        }

        return $this->driverInfo;
    }


    /**
     * @return array
     */
    public function getDriverIds(): callable
    {
        return function (Builder $query){
            if ($this->isNowData()) {
                $query->from('base_driver_info')
                    ->select(['id as driver_id'])
                    ->where('app_status', '=', 1)
                    ->where('status', '=', 1);
            }else{
                $query->from('base_driver_incumbency')->select(['driver_id'])
                    ->where('date', '=', $this->getDate());
            }
            if ($this->getSupervisorId()) {
                $query->whereRaw('FIND_IN_SET('.$this->getSupervisorId().', `base_driver_info`.`supervisors`)');
            }
        };
    }

    /**
     * @param string $date
     * @return DriverInfo
     */
    public function setDate(string $date): DriverInfo
    {
        $this->date = $date;
        $this->driverIds = [];
        $this->driverInfo = [];

        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }


    /**
     * 获取小队长
     * @method smallDrivers
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function smallDrivers(): array
    {
        return collect($this->getDriverInfo())->where('driver_type', '=',  1)->values()->toArray();
    }
    /**
     * 是否是获取今天的数据
     * @method isToDay
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    public function isToDay()
    {
        $date = Carbon::parse($this->getDate());

        return $date->isToday();
    }

    /**
     * 是否实时数据
     * @method isNowData
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    public function isNowData()
    {
        $date = Carbon::parse($this->getDate());

        return $date->isToday() || $date->isYesterday();
    }

    /**
     * 返回合并数据
     * @method merge
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function merge(){
        $order = $this->order();
        $taskOrder = $this->taskOrder();
        $workTime = $this->workTime();

        return $this->getDriverInfo()->map(function ($item) use ($order, $taskOrder, $workTime){
            $value = (array)$workTime->firstWhere('driver_id', '=',  $item['driver_id'] );
            $item['work_time'] = $value['work_time'] ?? 0;
            //
            $value = (array)$order->firstWhere('driver_id', '=',  $item['driver_id'] );
            $item['order_complete_fee'] = $value['order_complete_fee'] ?? 0;
            $item['order_complete_total'] = $value['order_complete_total'] ?? 0;
            $item['order_cancel_total'] = $value['order_cancel_total'] ?? 0;
            //
            $value = (array)$taskOrder->firstWhere('driver_id', '=',  $item['driver_id'] );
            $item['task_order_total'] = $value['task_order_total'] ?? 0;
            $item['task_order_fee'] = $value['task_order_fee'] ?? 0;

            return $item;
        });
    }
    /**
     * 获取时间段，用于whereBetween
     * @method getBetweenDateTime
     * @return array
     * @author luffyzhao@vip.126.com
     */
    protected function getBetweenDateTime(): array
    {
        return [
            $this->getDate().' 00:00:00',
            $this->getDate().' 23:59:59',
        ];
    }

}