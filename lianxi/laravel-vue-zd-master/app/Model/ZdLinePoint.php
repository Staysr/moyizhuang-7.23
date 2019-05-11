<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ZdLinePoint
 * @package App\Model
 *
 * @property integer $id
 * @property integer $line_id
 * @property integer $point_id
 * @property integer $sort
 */
class ZdLinePoint extends Model
{

    public $timestamps = false;

    protected $table = "zd_line_point";

    public function line()
    {
        return $this->hasOne(ZdLine::class, 'id', 'line_id');
    }
}
