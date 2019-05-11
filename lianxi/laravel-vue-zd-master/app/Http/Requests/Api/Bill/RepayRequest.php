<?php

namespace App\Http\Requests\Api\Bill;

use Illuminate\Foundation\Http\FormRequest;

class RepayRequest extends FormRequest
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
            'money'   => ['required', 'money'],
            'remark' => ['min:0','max:100'],
        ];


    }

    public function attributes()
    {
        return ['money' => '还款金额', 'remark' => '还款备注'];
    }
}
