<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdVersion extends Model
{

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "sys_app_version";

    protected $fillable=[
        'id','version_no','app_os','app_type','downloads','download_url','download_channel','version_desc','status','force_update','package_size'
    ];



}
