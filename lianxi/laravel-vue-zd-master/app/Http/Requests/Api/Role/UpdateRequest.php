<?php

namespace App\Http\Requests\Api\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name'      => [
                'required',
                'string',
                Rule::unique('zd_sys_role')->ignore(request()->route('role')),
            ],
            'is_admin'  => ['required', 'integer'],
            'authority' => ['required', 'integer'],
        ];
    }
    
    public function attributes()
    {
        return [
            'name'      => '角色名称',
            'is_admin'  => '是否超级管理员',
            'authority' => '数据权限',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required'      => '角色名称不能为空',
            'is_admin.required'  => '是否超级管理员不能为空',
            'authority.required' => '数据权限不能为空',
        ];
    }
}
