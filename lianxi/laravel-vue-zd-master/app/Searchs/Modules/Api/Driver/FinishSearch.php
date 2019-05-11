<?php

namespace App\Searchs\Modules\Api\Driver;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class FinishSearch extends SearchAbstract
{
    protected $relationship = [
        
        'name'                => '=',
        'phone'               => '=',
        'company_id'          => '=',
        'car_number'          => '=',
        'assess_score'        => 'closure',
        'type'                => '=',
        'extend_id'           => '=',
        'app_status'          => '=',
        'car_type_id'         => '=',
        'is_plat_service_fee' => '=',
        'deposit_status'      => '='
    ];
    
    
    public function getAssessScoreAttribute($value)
    {
        return function ($query) use ($value) {
            $arr = json_decode($value, true);
            if (empty($arr["min"]) || empty($arr["max"]))
                return false;
            $query->whereRaw(
                'assess_score between ' . $arr["min"] . ' and ' . $arr["max"] .
                ($arr["max"] == 5 ? ' or assess_score is null' : '')
            );
        };
    }
    
}
