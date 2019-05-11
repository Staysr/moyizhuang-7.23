<?php

namespace App\Http\Requests\Operate\Statistics;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'driver_id' => ['required', 'integer'],
            'type' => ['required', 'required', 'in:0,1,2'],
        ];
    }

    /**
     * 字段说明
     * @method attributes
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function attributes()
    {
        return [
            'start_date' => '开始时间',
            'end_date' => '结束时间',
            'driver_id' => '司机ID',
            'type' => '司机类型',
        ];
    }

}
