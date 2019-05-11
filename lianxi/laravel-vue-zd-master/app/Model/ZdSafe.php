<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdSafe extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;
    
    protected $table = "zd_safe";
    
    protected $fillable = ['type', 'title', 'safe_fee', 'is_per', 'max_payment', 'status'];
    
    
}
