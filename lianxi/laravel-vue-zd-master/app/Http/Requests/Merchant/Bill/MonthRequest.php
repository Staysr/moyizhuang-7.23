<?php

namespace App\Http\Requests\Merchant\Bill;

use Illuminate\Foundation\Http\FormRequest;

class MonthRequest extends FormRequest
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
            'bill_time' => ['nullable', 'array'],
        ];


    }

    public function attributes()
    {
        return ['bill_time' => '账单时间'];
    }
}
