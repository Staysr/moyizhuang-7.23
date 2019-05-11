<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdTaskChoose extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_task_choose";
    protected $fillable = [
        'id',
        'driver_id',
        'task_id',
        'start_date',
        'end_date',
        'week',
        'start_time',
        'end_time',
        'arrival_warehouse_time',
        'estimate_time',
        'create_time',
        'modify_time'
    ];

}
