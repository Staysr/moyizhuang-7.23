<?php

namespace App\Searchs\Modules\Merchant;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class TaskSearch extends SearchAbstract
{
    protected $filterKey = ['type'];
    protected $relationship = [
        'status' => '=',
        'id' => 'like'
    ];


    public function toArray()
    {
        $new=[];
        $result = parent::toArray();
        foreach ($result as $key => $item) {
            if (!in_array(current($item), $this->filterKey)) {
                $new[]=$item;
            }
        }
        return $new;
    }

    public function getIdAttribute($value)
    {
        return $value.'%';
    }
}
