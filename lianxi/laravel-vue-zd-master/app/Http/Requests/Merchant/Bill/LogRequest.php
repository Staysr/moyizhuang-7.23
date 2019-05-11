<?php

namespace App\Http\Requests\Merchant\Bill;

use Illuminate\Foundation\Http\FormRequest;

class LogRequest extends FormRequest
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
            'create_time' => ['nullable','array'],
            'create_time.*' => ['date'],
        ];
    }

    public function attributes()
    {
        return  ['create_time' => '还款时间','create_time.*'=>'还款时间'];
    }
}
