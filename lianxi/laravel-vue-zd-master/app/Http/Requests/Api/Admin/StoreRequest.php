<?php

namespace App\Http\Requests\Api\Admin;

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
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'           => ['required', 'regex:/^1[34578]\d{9}$/', 'unique:zd_sys_user'],
            'password'        => [
                'required',
                'string',
                'between:6,16',
                'required_with:password_confirmation',
                'confirmed'
            ],
            'role'            => ['required', 'integer'],
            'manager'         => ['required', 'in:0,1'],
            'name'            => ['required', 'string'],
            'sex'             => ['nullable', 'in:0,1,2'],
            'authority_level' => ['required', 'in:0,1,2,3,4'],
            'job_number'      => ['nullable', 'string'],
            'contact'         => ['nullable', 'string'],
            'birthday'        => ['nullable', 'date'],
            'status'          => ['required', 'in:0,1'],
        ];
    }
    
    public function attributes()
    {
        return [
            'phone'           => '手机号码',
            'password'        => '密码',
            'role'            => '用户角色',
            'manager'         => '是否部门管理者',
            'name'            => '姓名',
            'sex'             => '性别',
            'authority_level' => '权限等级',
            'job_number'      => '工号',
            'contact'         => '联系电话',
            'birthday'        => '生日',
            'status'          => '用户状态',
        ];
    }
    
    public function messages()
    {
        return [
            'phone.required'     => '手机号码不能为空',
            'phone.regex'        => '请输入正确的手机号码',
            'password.required'  => '密码不能为空',
            'password.between'   => '请输入6-16位密码',
            'password.confirmed' => '两次密码输入不一致',
        ];
    }
}
