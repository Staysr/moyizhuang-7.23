<?php


namespace App\Http\Requests\Backend\Navigation;


use App\Http\Requests\Request;

class UpdateRequest extends Request
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
            'name'  => 'required',
            'url'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请输入导航名',
            'url.reqiured' => '请输入URL',
        ];
    }

}