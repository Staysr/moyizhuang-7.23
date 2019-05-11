<?php

namespace App\Http\Requests\Operate\Situation;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'is_work' => ['nullable', 'in:0,1'],
            'work_status' => ['nullable', 'in:0,1,2'],
            'supervisor_id' => ['nullable', 'integer'],
            'last_end_work' => ['nullable'],
            'id' => ['nullable', 'integer']
        ];
    }

    public function attributes()
    {
        return [
            'is_work' => '出车状态',
            'work_status' => '空闲状态',
            'supervisor_id' => '小队长',
            'last_end_work' => '收车原因',
            'id'=>'司机ID'
        ];
    }
}
