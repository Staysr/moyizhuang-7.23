<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'status' => ['nullable', 'array'],
            'status.*' => ['nullable', 'integer'],
            'merchant_id' => ['nullable', 'integer'],
            'task_id' => ['nullable', 'integer'],
            'warehouse_id' => ['nullable', 'integer'],
            'order_no' => ['nullable'],
            'arrival_warehouse_time' => ['nullable', 'array', 'size:2'],
            'arrival_warehouse_time.*' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }
}
