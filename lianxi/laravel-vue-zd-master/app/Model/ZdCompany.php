<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class ZdCompany extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "sys_car_company";
}