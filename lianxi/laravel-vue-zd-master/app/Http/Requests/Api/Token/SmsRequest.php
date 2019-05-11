<?php

namespace App\Http\Requests\Api\Token;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SmsRequest extends FormRequest
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
            'phone' => ['required', 'regex:/^1[34578]\d{9}$/', Rule::exists('zd_sys_user', 'phone')],
        ];
    }
    
    public function attributes()
    {
        return ['phone' => '手机号码'];
    }
    
    public function messages()
    {
        return [
            'phone.regex' => '手机号码格式不正确',
        ];
    }
    
}
