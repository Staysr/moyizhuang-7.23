<?php

namespace App\Http\Requests\Api\Point;

use Illuminate\Validation\Rule;
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
            'name'        => ['required', 'string'],
            'lng'         => ['required', 'position'],
            'lat'         => ['required', 'position'],
            'contacts'    => ['required', 'string', 'min:1', 'max:10'],
            'contact_way' => ['required', 'phone'],
        ];
    }

    public function attributes()
    {
        return [
            'name'        => '配送点地址',
            'lng'         => '经度',
            'lat'         => '纬度',
            'contacts'    => '联系人',
            'contact_way' => '联系方式',
        ];
    }

}
