<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ZdPosition extends Eloquent
{
    // 文档
    protected $table = 'driverCarPosition';
    // 连接
    protected $connection = 'mongodb';
    // 时间格式化
    protected $dates = ['createTime'];
    // 时间格式
    protected $dateFormat = 'Y-m-d H:i:s';
    // 不显示字段
    protected $hidden = ['_class','locs','isWork','workStatus'];

}
