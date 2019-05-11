<?php

namespace App\Http\Requests\Merchant\User;

use Illuminate\Foundation\Http\FormRequest;


class ForgetRequest extends FormRequest
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
                'phone' => ['required', 'phone'],
                'code' => ['required', 'code:forget'],
                'password' => ['required', 'min:6', 'max:20'],
            ];

    }

    public function attributes()
    {
        return[ 'phone' => '手机','code' => '验证码', 'password' => '新密码'];
    }


}
