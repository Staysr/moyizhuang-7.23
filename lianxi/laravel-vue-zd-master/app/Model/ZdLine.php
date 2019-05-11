<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ZdLine
 * @package App\Model
 *
 * @property integer $id
 * @property string $title
 * @property integer $point_time_id
 */

class ZdLine extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_line";

    public function linePoint()
    {
        return $this->hasMany(ZdLinePoint::class, 'line_id', 'id');
    }

    public function pointTime()
    {
        return $this->belongsTo(ZdPointTime::class, 'point_time_id', 'id');
    }
}
