<?php
/**
 * Created by PhpStorm.
 * User: Blake.song<214112331@qq.com>
 * Date: 2018/9/6
 * Time: 10:44
 */

namespace App\Searchs\Modules\Api\Point;


use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class PointSearch extends SearchAbstract
{
    protected $relationship = [
        'point_time_id' => '=',
    ];
}