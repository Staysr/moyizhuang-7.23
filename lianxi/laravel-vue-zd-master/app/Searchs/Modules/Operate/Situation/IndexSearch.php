<?php

namespace App\Searchs\Modules\Operate\Situation;

use Illuminate\Database\Query\Builder;
use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'is_work' => '=',
        'work_status' => '=',
        'supervisor_id' => '=',
        'last_end_work' => 'like',
        'id' => '='
    ];

    public function getSupervisorIdAttribute($value){
        return function ($query) use ($value){
            $query->whereRaw('find_in_set(\''.$value.'\', `supervisors`)');
        };
    }

    public function getIsWorkAttribute($value){
        return function ($query) use ($value){
            $query->where('is_work', '=', $value)->where('is_big_work', '=', 0);
        };
    }

    public function getWorkStatusAttribute($value){
        return function ($query) use ($value) {
            if($value == 0){
                $query->where('is_work', '=', 1)->where('is_big_work', '=', 0)->where('work_status', '=', 0);
            }else if($value == 1){
                $query->where('is_work', '=', 1)->where('is_big_work', '=', 0)->where('work_status', '=', 1);
            }else if($value == 2){
                $query->where('is_big_work', '=', 1);
            }
        };
    }

    public function getLastEndWorkAttribute($value){
        return function (Builder $query) use ($value){
            if($value === '其他'){
                $query->where('last_end_work', 'not regexp', '下班|吃饭|休息会儿|请假|管理|充电');
            }else {
                $query->where('is_work', '=', 0)->where('is_big_work', '=', 0)->where('last_end_work', 'like' ,'%'. $value .'%');
            }

        };
    }
}
