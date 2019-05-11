<?php

namespace App\Http\Requests\Merchant\Bill;

use Illuminate\Foundation\Http\FormRequest;

class DayRequest extends FormRequest
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
            'finish_time'   => ['nullable', 'array'],
            'finish_time.*' => ['date'],
        ];


    }

    public function attributes()
    {
        return ['finish_time' => '账单时间', 'finish_time.*' => '账单时间'];
    }
}
