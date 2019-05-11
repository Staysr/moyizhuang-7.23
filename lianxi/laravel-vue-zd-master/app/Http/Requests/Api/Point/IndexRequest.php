<?php
/**
 * Created by PhpStorm.
 * User: Blake.song<214112331@qq.com>
 * Date: 2018/8/24
 * Time: 12:23
 */

namespace App\Http\Requests\Api\Point;


use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fixed_name' => ['required', 'string'],
            'lng' => ['required', 'numeric'],
            'lat' => ['required_with:lng', 'numeric']
        ];
    }

}