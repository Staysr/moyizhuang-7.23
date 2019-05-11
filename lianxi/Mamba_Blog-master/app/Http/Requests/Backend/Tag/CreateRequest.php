<?php


namespace App\Http\Requests\Backend\Tag;


use App\Http\Requests\Request;

class CreateRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     * 确定是否授权用户发出此请求。
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
            'name'=>'required|unique:tags,tag_name'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '标签不能为空',
            'name.unique' => '标签名必须唯一'
        ];
    }

}