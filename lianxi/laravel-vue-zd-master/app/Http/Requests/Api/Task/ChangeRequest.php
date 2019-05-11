<?php

namespace App\Http\Requests\Api\Task;

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
        return [
            'driver_id'  => [
                'required',
                'integer',
                Rule::exists('base_driver_info', 'id'),
            ],
            'unit_price' => [
                'required',
                'money',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'driver_id'  => '司机ID',
            'unit_price' => '司机保价',
        ];
    }

}
