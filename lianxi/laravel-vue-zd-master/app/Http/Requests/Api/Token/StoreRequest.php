<?php
/**
 * new-zhoudao
 * StoreRequest.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Requests\Api\Token;


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
    
    public function rules()
    {
        return [
            'phone'    => ['required', 'phone',],
            'password' => ['required', 'string', 'between:6,16'],
        ];
    }
    
    public function messages()
    {
        return [
            'phone.required'    => '手机号不能为空',
            'phone.phone'       => '请输入正确的手机号',
            'password.required' => '密码不能为空',
            'password.between'  => '请输入6-16位数字或字母',
        ];
    }
}