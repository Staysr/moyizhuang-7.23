<?php

namespace App\Http\Requests\Merchant\Token;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class LoginRequest extends FormRequest
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
                'phone'        => [
                    'required',
                    'phone',
                    Rule::exists('zd_merchant_user', 'phone'),
                ],
                'password'     => ['required', 'string', 'between:6,16'],
                'device_token' => ['max:100'],
                'os'           => ['min:3', 'max:50'],
                'os_version'   => ['min:3', 'max:50'],
                'model'        => ['min:3', 'max:50'],
                'app_version'  => ['min:3', 'max:50'],
                'resolution'   => ['min:3', 'max:50'],
            ];

    }

    public function attributes()
    {
        return [
            'phone'        => '帐号',
            'password'     => '登录密码',
            'device_token' => '设备Token',
            'os'           => '手机操作系统',
            'os_version'   => '操作系统版本',
            'model'        => '手机型号',
            'app_version'  => '手机App版本号',
            'resolution'   => '分辨率',
        ];
    }

    public function messages()
    {
        return [
            'phone.required'    => '请输入正确的手机号',
            'phone.phone'       => '请输入正确的手机号',
            'password.required' => '请输入6-16位数字或字母',
            'password.between'  => '请输入6-16位数字或字母',
        ];
    }
}
