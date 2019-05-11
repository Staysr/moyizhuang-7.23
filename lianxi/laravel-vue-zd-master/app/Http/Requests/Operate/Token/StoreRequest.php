<?php

namespace App\Http\Requests\Operate\Token;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    public function rules(){
        return [
            'phone' => ['required',  'phone',],
            'password' => ['required', 'string', 'between:6,16'],
        ];
    }

    public function attributes()
    {
        return [
            'phone' => '手机号码',
            'password' => '密码'
        ];
    }

}
