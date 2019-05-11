<?php

namespace App\Http\Requests\Api\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
                'title' => ['required', 'min:1', 'max:10'],
                'category_zone' => ['required', 'min:1', 'max:100'],
                'merchant_id' => ['required'],
                'contacts' => ['required', 'min:1', 'max:50'],
                'contacts_phone' => ['required', 'phone'],
                'backup_contacts' => ['array'],
                'backup_contacts.*.name' => ['string', 'min:1', 'max:10'],
                'backup_contacts.*.phone' => ['string', 'phone'],
                'address' => ['required', 'string', 'min:1', 'max:300'],
                'description' => ['min:0', 'max:100'],
                'instruction' => ['min:0', 'max:100'],
                'longitude' => ['required', 'numeric'],
                'latitude' => ['required_with:longitude', 'numeric'],
                'remark' => ['min:0', 'max:100'],
            ];
    }

    public function attributes()
    {
        return  [
            'title' => '仓库名称',
            'category_zone' => '省市区',
            'contacts' => '联系人',
            "contacts_phone" => '联系人手机',
            'backup_contacts' => '备用联系人',
            'backup_contacts.*.name' => '备用联系人姓名',
            'backup_contacts.*.phone' => '备用联系人手机',
            'address' => '详细地址',
            'description' => '位置描述',
            'instruction' => '行车指引',
            'longitude' => '经度',
            'latitude' => '维度',
            'remark' => '司机类型',
            'merchant_id' => '商户简称'
        ];
    }
}
