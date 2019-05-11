<?php

namespace App\Http\Requests\Merchant\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SmsRequest extends FormRequest
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
        return
            [
                'phone' => ['required', 'phone', Rule::exists('zd_merchant_user', 'phone')],
            ];
    }

    public function attributes()
    {
        return ['phone' => '帐号'];
    }


}
