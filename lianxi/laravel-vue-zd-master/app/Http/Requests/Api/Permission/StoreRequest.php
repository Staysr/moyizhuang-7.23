<?php

namespace App\Http\Requests\Api\Permission;

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
            'name'  => ['required', 'regex:/[a-z]+\.[a-z]+/', 'unique:zd_sys_rule'],
            'title' => ['required', 'string'],
            'sort'  => ['required', 'integer'],
        ];
    }
    
    public function attributes()
    {
        return [
            'name'  => '权限标识',
            'title' => '权限名称',
            'sort'  => '排序',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required'  => '权限标识不能为空',
            'name.regex'     => '权限标识格式为 a-z.a-z',
            'title.required' => '权限名称不能为空',
            'sort.required'  => '排序不能为空',
        ];
    }
}
