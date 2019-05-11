<?php
/**
 * 订单时间
 * Order.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Plugins\DateTime;


use Carbon\Carbon;

/**
 * 任务是否有冲突
 * 用法 ：
 *
 *      $a =  \App\Plugins\DateTime\Order::weeksToDateTime([7, 1 ,2 ,4], ['13:47', '12:14']);
 *      $b =  \App\Plugins\DateTime\Order::dateRangeToDateTime('2018-08-16', '2018-09-01',  ['10:47', '13:14']);
 *      foreach ($a as $item){
 *          foreach ($b as $item1){
 *              $res = \App\Plugins\DateTime\Order::intersect($item, $item1);
 *              if($res){
 *                      dd($item, $item1);
*               }
 *      }
 * }
 * Class Order
 * @package App\Plugins\DateTime
 */
class Order
{

    /**
     *  是否有交集
     * @param $dateTimeRange
     * @param $dateTimeRange1
     * @return bool
     */
    public static function intersect($dateTimeRange, $dateTimeRange1)
    {
        if ($dateTimeRange[0]->lt($dateTimeRange1[0])) {
            if ($dateTimeRange1[0]->gte($dateTimeRange[1])) {
                return false;
            }

            return true;
        } else {
            if ($dateTimeRange1[1]->gt($dateTimeRange[0])) {
                return true;
            }

            return false;
        }
    }

    /**
     * 临时任务时间转换
     * @param $startDate
     * @param $endDate
     * @param array $timeRange
     * @return array
     */
    public static function dateRangeToDateTime($startDate, $endDate, array $timeRange)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $diff = $start->diffInDays($end);
        $startTime = $start->copy()->setTimeFromTimeString($timeRange[0]);
        $endTime = $start->copy()->setTimeFromTimeString($timeRange[1]);
        $add = $startTime->gt($endTime) ? 1 : 0;
        $dateTime = [];
        for ($i = 0; $i <= $diff; $i++) {
            $dateTime[] = [
                $start->copy()->addDay($i)->setTimeFromTimeString($timeRange[0]),
                $start->copy()->addDay($i)->addDay($add)->setTimeFromTimeString($timeRange[1]),
            ];
        }

        return $dateTime;
    }

    /**
     * 长期任务时间转换（只转换最近3周的任务）
     * @param array $weeks
     * @param array $timeRange
     * @return array
     */
    public static function weeksToDateTime(array $weeks, array $timeRange)
    {
        $carbon = array_map(
            function ($week) use ($timeRange) {
                $start = self::weekToDate($week)->setTimeFromTimeString($timeRange[0]);
                $end = self::weekToDate($week)->setTimeFromTimeString($timeRange[1]);
                $add = $start->gt($end) ? 1 : 0;

                return [
                    $start,
                    $end->addDay($add),
                ];
            },
            $weeks
        );

        return array_merge($carbon, self::addWeek($carbon), self::addWeek($carbon, 2));
    }

    /**
     * @param array $dates
     * @param int $value
     * @return array
     */
    protected static function addWeek(array $dates, $value = 1)
    {
        $double = [];
        foreach ($dates as $item) {
            $double[] = [
                $item[0]->copy()->addWeek($value),
                $item[1]->copy()->addWeek($value),
            ];
        }

        return $double;
    }

    /**
     * @param $week
     * @return Carbon
     */
    protected static function weekToDate($week)
    {
        $now = Carbon::now();
        if ($now->dayOfWeekIso > $week) {
            return $now->addDay(7 - ($now->dayOfWeekIso - $week));
        } elseif ($now->dayOfWeekIso < $week) {
            return $now->addDay($week - $now->dayOfWeekIso);
        } else {
            return $now;
        }
    }


    /**
     * 计算两个时间段是否有交集(主任务和主任务 或者 临时任务和主任务)
     * @method cross
     *
     * @static
     * @param $beginTime
     * @param $endTime
     * @param $beginTime1
     * @param $endTime1
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    protected static function crossOfWeek($beginTime, $endTime, $beginTime1, $endTime1)
    {
        $time = self::convert($beginTime, $endTime);
        $time1 = self::convert($beginTime1, $endTime1);
        foreach ($time as $item) {
            foreach ($time1 as $item1) {
                if (self::cross($item[0], $item[1], $item1[0], $item1[1])) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * 时间转换
     * @method convert
     *
     * @static
     * @param $startTime
     * @param $endTime
     * @return array
     * @author luffyzhao@vip.126.com
     */
    protected static function convert($startTime, $endTime)
    {
        $startTime = self::toCarbon($startTime);
        $endTime = self::toCarbon($endTime);

        // 如果是周未跨天
        if (!($startTime->isSameDay($endTime)) && $startTime->dayOfWeek === 0) {
            return [
                [
                    self::formatTimeOfWeek($startTime),
                    self::formatTimeOfWeek($startTime->copy()->setTime(23, 59, 59)),
                ],
                [
                    0,
                    self::formatTimeOfWeek($endTime),
                ],
            ];
        }

        return [
            [
                self::formatTimeOfWeek($startTime),
                self::formatTimeOfWeek($endTime),
            ],
        ];
    }

    /**
     * 把时间转换成周时间戳
     * @method formatTimeOfWeek
     * @param Carbon $dateTime
     * @return float|int
     * @author luffyzhao@vip.126.com
     */
    protected static function formatTimeOfWeek(Carbon $dateTime)
    {
        $week = $dateTime->dayOfWeekIso;

        return $dateTime->copy()->setDate('1970', '01', '01')->timestamp + (($week - 1) * 86400);
    }

    /**
     * 转成Carbon对象
     * @method toCarbon
     *
     * @static
     * @param $dateTime
     * @return Carbon
     * @author luffyzhao@vip.126.com
     */
    protected static function toCarbon($dateTime)
    {
        if (!($dateTime instanceof Carbon)) {
            $dateTime = new Carbon($dateTime);
        }

        return $dateTime;
    }

    /**
     * 是否没有交集
     * @method crosss
     *
     * @static
     * @param string $beginTime1
     * @param string $endTime1
     * @param string $beginTime2
     * @param string $endTime2
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    protected static function cross($beginTime1, $endTime1, $beginTime2, $endTime2)
    {
        if ($beginTime2 > $beginTime1) {
            if ($beginTime2 >= $endTime1) {
                return false;
            } else {
                return true;
            }
        } else {
            if ($endTime2 > $beginTime1) {
                return true;
            } else {
                return false;
            }
        }
    }
}