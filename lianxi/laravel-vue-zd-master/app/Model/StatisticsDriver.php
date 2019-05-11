<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatisticsDriver extends Model
{
    protected $table = 'statistics_driver_info';

    protected $fillable = ['date', 'driver_id', 'big_id', 'small_id', 'order_complete_fee', 'order_complete_total', 'order_cancel_total', 'work_time', 'task_order_total', 'task_order_fee'];
}
