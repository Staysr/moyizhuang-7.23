<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ZdSysRule extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;
    
    protected $table = "zd_sys_rule1";
    
    protected $fillable = ['name', 'title', 'parent_id', 'sort', 'icon', 'islink'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function(Builder $builder) {
            $builder->orderBy('sort');
        });
    }
}
