<?php


namespace App\Http\Requests\Backend\Category;


use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Determind if the user is authorized to make this request
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'请填写分类名称'
        ];
    }

}