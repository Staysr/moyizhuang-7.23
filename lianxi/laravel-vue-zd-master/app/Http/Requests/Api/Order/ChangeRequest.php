<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeRequest extends FormRequest
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
        return
            [
                'arrival_warehouse_time' => [
                    'required',
                    'dateFormat:Y-m-d H:i:s',
                ],
                'unit_price'             => ['between:1,99999'],
            ];
    }

    public function attributes()
    {
        return [
            'unit_price' => '每趟价格',
            'arrival_warehouse_time' => '到仓时间',
        ];
    }


}
