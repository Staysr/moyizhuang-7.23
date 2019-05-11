<?php

namespace App\Http\Requests\Api\Award;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateRequest extends FormRequest
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
            'type'=> ['required', 'in:1,2'],
            'fee'=> ['required', 'money','between:0,99999.99'],
            'reason'=> ['required', 'min:1','max:300']
        ];
    }
    
    public function attributes()
    {
        return [
            'type'      => '奖惩类型',
            'fee' => '金额',
            'reason'      => '原因',
        ];
    }
    
}
