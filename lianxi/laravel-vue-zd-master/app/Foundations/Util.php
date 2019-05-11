<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/23
 * Time: 10:27
 */

namespace App\Foundations;

class Util
{

    /**
     * 生成N位数字随机数
     *
     * @param int $length
     *
     * @return int
     */
    public static function RandomCode($length = 6)
    {
        $min = pow(10, ($length - 1));
        $max = pow(10, $length) - 1;

        return mt_rand($min, $max);
    }

    public static function ArrayFormComplex(array $array)
    {
        $data = [];
        $current = next($array);
        reset($array);
        foreach ($current as $key => $value) {
            foreach ($array as $k => $val) {
                $data[$key][$k] = $array[$k][$key];
            }
        }

        return $data;
    }


    /**
     * 定制列表输出
     *
     * @param $temp
     *
     * @return mixed
     * @author Mark
     * @date   2018/7/12 15:22
     */
    public static function TaskFilter($tempArray)
    {
        if (!empty($tempArray)) {
            foreach ($tempArray as $index => $item) {
                if (empty($item['driver']) && !empty($item['rescind'])) {
                    $tempArray[$index]['driver'] = $item['rescind'];
                    $tempArray[$index]['driver_id']
                        = $tempArray[$index]['rescind_id'];  //删除
                }
                unset($tempArray[$index]['rescind']);
                unset($tempArray[$index]['rescind_id']);
                if (($item['status'] == 0 && $item['driver_status'] == 2)
                    || ($item['status'] == 1 && $item['driver_status'] == 2)
                    || ($item['status'] == 2 && $item['driver_status'] == 2)
                    || ($item['status'] == 2 && $item['rescind_id'] <> 0)
                    || ($item['driver_status'] == 3)
                    || ($item['driver_status'] == 4)
                ) {
                    ;
                } else {
                    $tempArray[$index]['driver'] = null;
                    $tempArray[$index]['driver_id'] = 0;
                }
            }

            return $tempArray;
        }
    }


    public static function OfferFilter($resultArray)
    {
        if (!empty($resultArray)) {
            foreach ($resultArray as $index => $item) {
                if (($item['task']['status'] == 0
                        && $item['task']['driver_status'] == 2)
                    || ($item['task']['status'] == 1
                        && $item['task']['driver_status'] == 2)
                    || ($item['task']['status'] == 1
                        && $item['task']['rescind_id'] <> 0)
                    || ($item['task']['status'] == 2
                        && $item['task']['driver_status'] == 2)
                    || ($item['task']['status'] == 2
                        && $item['task']['rescind_id'] <> 0)
                    || ($item['task']['status'] == 4
                        && $item['task']['rescind_id'] <> 0)
                    || ($item['task']['driver_status'] == 3)
                    || ($item['task']['driver_status'] == 4)
                ) {
                    ;
                } else {
                    $resultArray[$index]['driver'] = null;
                    $resultArray[$index]['driver_id'] = 0;
                }
                unset($resultArray[$index]['task']['rescind_id']);
            }

            return $resultArray;
        }
    }


    /**
     * 秒转时分秒
     *
     * @param $time
     *
     * @return array|bool
     * @author Mark
     * @date   2018/8/7 15:30
     */
    public static function Sec2Time($time)
    {
        if (is_numeric($time)) {
            $value = array(
                "years" => 0,
                "days" => 0,
                "hours" => 0,
                "minutes" => 0,
                "seconds" => 0,
            );
            if ($time >= 31556926) {
                $value["years"] = floor($time / 31556926);
                $time = ($time % 31556926);
            }
            if ($time >= 86400) {
                $value["days"] = floor($time / 86400);
                $time = ($time % 86400);
            }
            if ($time >= 3600) {
                $value["hours"] = floor($time / 3600);
                $time = ($time % 3600);
            }
            if ($time >= 60) {
                $value["minutes"] = floor($time / 60);
                $time = ($time % 60);
            }
            $value["seconds"] = floor($time);

            return (array)$value;
        } else {
            return (bool)false;
        }
    }


    /**
     * 获取两个日期之间的日期
     *
     * @param $startdate
     * @param $enddate
     *
     * @return array
     * @author Mark
     * @date   2018/8/14 16:21
     */
    public static function getDateFromRange($startdate, $enddate)
    {
        $stimestamp = strtotime($startdate);
        $etimestamp = strtotime($enddate);
        // 计算日期段内有多少天
        $days = ($etimestamp - $stimestamp) / 86400 + 1;
        // 保存每天日期
        $date = array();
        for ($i = 0; $i < $days; $i++) {
            $date[] = date('Y-m-d', $stimestamp + (86400 * $i));
        }

        return $date;
    }


    /**
     * 获取周里面的之内的几天
     * @param       $start
     * @param array $week
     *
     * @return array
     * @author Mark
     * @date   2018/8/14 16:25
     */
    public static function getDateFromWeek($start, array $week)
    {
        $date = array();
        for ($i = 0; $i < 7; $i++) {
            //后六天
            $next_day = date('Y-m-d', strtotime('+'.$i.' day '.$start));
            $next_day_week = date('w', strtotime('+'.$i.' day '.$start));
            if ($next_day_week == 0) {
                $next_day_week = 7;
            }
            if (in_array($next_day_week, $week)) {
                array_push($date, $next_day);
            }
        }

        return $date;
    }


}