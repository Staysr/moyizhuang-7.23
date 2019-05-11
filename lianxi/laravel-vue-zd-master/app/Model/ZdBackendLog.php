<?php

namespace App\Model;

use Illuminate\Support\Facades\Log;
use Jenssegers\Mongodb\Eloquent\Model;

class ZdBackendLog extends Model
{

    // 文档
    protected $table = 'backend_log';
    // 连接
    protected $connection = 'mongodb';
    // 时间格式化
    protected $dates = ['createTime'];
    // 时间格式
    protected $dateFormat = 'Y-m-d H:i:s';
    // 不显示字段
    protected $hidden = ['_class'];



}
