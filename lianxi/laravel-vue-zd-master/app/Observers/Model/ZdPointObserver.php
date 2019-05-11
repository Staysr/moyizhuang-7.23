<?php
/**
 * Created by PhpStorm.
 * User: blake.Song
 * Date: 2018/8/21
 * Time: 14:59
 */

namespace App\Observers\Model;


use App\Model\ZdPoint;
use Illuminate\Support\Facades\DB;

class ZdPointObserver
{

    /**
     * 创建事件
     * @param ZdPoint $point
     */
    public function created(ZdPoint $point)
    {
        $point->pointTime()->update([
            'total_count' => DB::Raw('total_count+1')
        ]);
    }

    /**
     * 删除事件
     * @param ZdPoint $point
     */
    public function deleted(ZdPoint $point)
    {
        $point->pointTime()->update([
            'total_count' => DB::Raw('total_count-1')
        ]);
    }

}