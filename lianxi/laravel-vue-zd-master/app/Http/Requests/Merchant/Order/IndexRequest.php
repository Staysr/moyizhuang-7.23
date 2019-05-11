<?php

namespace App\Http\Requests\Merchant\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'arrival_warehouse_time' => ['nullable','array'],
            'arrival_warehouse_time.*' => ['date'],
            'type' => ['in:1,2'],
            'status' => ['in:0,1,2,3,4,5,6'],
            'id' => ['int', Rule::exists('zd_task_order', 'id')],
        ];
    }

    public function attributes()
    {
        return ['arrival_warehouse_time' => '配送时间', 'arrival_warehouse_time.*' => '配送时间','type' => '司机类型', 'status' => '记录类型','id'=>'任务ID'];
    }
}
