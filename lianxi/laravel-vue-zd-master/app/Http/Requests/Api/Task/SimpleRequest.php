<?php

namespace App\Http\Requests\Api\Task;

use Illuminate\Foundation\Http\FormRequest;

class SimpleRequest extends FormRequest
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
            'remark'       => ['required', 'string','min:5','max:100'],
        ];
    }
    
    public function attributes()
    {
        return [
            'remark'        => '备注原因'
        ];
    }
    
}
