<?php

namespace App\Http\Requests\Api\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SafeRequest extends FormRequest
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
            'merchant_safe_id' => [
                'required', Rule::exists('zd_safe', 'id'),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'merchant_safe_id' => '商户险ID',
        ];
    }

}
