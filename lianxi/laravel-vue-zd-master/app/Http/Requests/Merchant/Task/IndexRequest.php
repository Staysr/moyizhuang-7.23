<?php

namespace App\Http\Requests\Merchant\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


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
            'status' => ['in:0,1,2,3,4,5,6']
        ];
    }

    public function attributes()
    {
        return ['id' => '任务ID', 'status' => '任务状态'];
    }
}
