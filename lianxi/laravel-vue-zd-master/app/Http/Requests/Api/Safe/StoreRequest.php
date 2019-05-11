<?php

namespace App\Http\Requests\Api\Safe;

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
            'type'        => ['required', 'in:1,2'],
            'title'       => ['required', 'string'],
            'safe_fee'    => ['required', 'numeric'],
            'is_per'      => ['required', 'in:0,1'],
            'max_payment' => ['required', 'numeric'],
            'status'      => ['required', 'in:0,1']
        ];
    }
    
    public function attributes()
    {
        return [
            'type'        => '保险类型',
            'title'       => '保险名称',
            'safe_fee'    => '保障服务费',
            'is_per'      => '保障方式',
            'max_payment' => '最高赔付',
            'status'      => '是否启用',
        ];
    }
    
}
