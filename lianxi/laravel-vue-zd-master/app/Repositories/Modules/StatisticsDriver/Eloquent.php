<?php

namespace App\Repositories\Modules\StatisticsDriver;

use App\Plugins\Statistics\DriverInfo;
use Illuminate\Support\Facades\DB;
use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 统计
     * @method total
     * @param $attributes
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function total($attributes){
        $data = $this->model
            ->select([
                'driver_id',
                DB::Raw('SUM(`order_complete_fee`) as order_complete_fee'),
                DB::Raw('SUM(`order_complete_total`) as order_complete_total'),
                DB::Raw('SUM(`order_cancel_total`) as order_cancel_total'),
                DB::Raw('SUM(`work_time`) as work_time'),
                DB::Raw('SUM(`task_order_total`) as task_order_total'),
                DB::Raw('SUM(`task_order_fee`) as task_order_fee'),
            ])->where($attributes->toArray())
            ->groupBy('driver_id')->get();

        $drivers = DB::table('base_driver_info')->select(
            [
                'id as driver_id',
                'name',
                'type as driver_type',
                'category_code',
                DB::Raw('SUBSTRING_INDEX(`supervisors`,\',\', 1) AS big_id'),
                DB::Raw('SUBSTRING_INDEX(SUBSTRING_INDEX (`supervisors`,\',\', 2), \',\', -1) AS small_id'),
            ]
        )->whereIn('id', array_column($data->toArray(), 'driver_id'))->get();

        return $data->map(function($item) use($drivers) {
            return array_merge(
                $item->toArray(),
                (array)$drivers->where('driver_id', $item['driver_id'])->first()
            );
        });
    }
}
