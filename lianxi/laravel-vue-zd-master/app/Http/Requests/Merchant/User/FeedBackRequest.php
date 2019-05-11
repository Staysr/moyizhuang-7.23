<?php

namespace App\Http\Requests\Merchant\User;

use Illuminate\Foundation\Http\FormRequest;


class FeedBackRequest extends FormRequest
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
                'content' => ['required', 'min:15', 'max:200'],
            ];
    }

    public function attributes()
    {
        return  ['content' => '反馈内容'];
    }


}
