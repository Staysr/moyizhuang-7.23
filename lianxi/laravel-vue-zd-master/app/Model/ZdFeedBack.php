<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdFeedBack extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_feedback";
    protected $fillable=['id','merchant_id','content','create_time','modify_time'];

}
