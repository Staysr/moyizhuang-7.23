<?php

namespace App\Http\Requests\Operate\Situation;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'merchant_id' => ['nullable'],
            'arrival_warehouse_time' => ['nullable', 'array'],
            'status' => ['nullable', 'integer'],
            'supervisor_id' => ['required', 'integer']
        ];
    }
}
