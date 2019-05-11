<?php

namespace App\Http\Requests\Api\Role;

use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
            'rule_id'   => ['required', 'array'],
            'rule_id.*' => ['required', 'numeric'],
        ];
    }
    
    public function attributes()
    {
        return [
            'rule_id'   => '权限',
            'rule_id.*' => '权限'
        ];
    }
    
    public function messages()
    {
        return [
            'rule_id.required'   => '选择所要分配的权限',
            'rule_id.*.required' => '选择所要分配的权限',
        ];
    }
}
