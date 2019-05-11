<?php

namespace App\Http\Requests\Api\Token;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'phone'    => [
                'required',
                'regex:/^1[34578][0-9]{9}$/',
                Rule::exists('zd_sys_user', 'phone')
            ],
            'code'     => ['required', 'code:forget'],
            'password' => [
                'nullable',
                'string',
                'between:6,16',
                'required_with:password_confirmation',
                'confirmed',
            ]
        ];
    }
    
    public function attributes()
    {
        return [
            'phone'    => '手机号码',
            'code'     => '验证码',
            'password' => '密码',
        ];
    }
    
    public function messages()
    {
        return [
            'phone.required'     => '手机号码不能为空',
            'phone.regex'        => '手机号码格式不正确',
            'password.confirmed' => '两次密码输入不一致',
            'password.between'   => '请输入6-16位密码',
        ];
    }
    
}
