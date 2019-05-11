<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdDriverDays extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_driver_days";

    protected $fillable=['id','driver_id','finish_date','times'];

}
