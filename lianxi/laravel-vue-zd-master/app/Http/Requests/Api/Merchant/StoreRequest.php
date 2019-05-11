<?php

namespace App\Http\Requests\Api\Merchant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return
            [
                'title' => ['required', 'min:1', 'max:20'],
                'short_name' => ['required', 'min:1', 'max:20'],
                'city' => ['required', 'min:1', 'max:10'],
                'trade' => ['min:0', 'max:20'],
                'bank' => ['min:0', 'max:20'],
                'bank_no' => ['min:0', 'max:30'],
                'telephone' => ['nullable', 'min:6', 'max:20'],
                'agreement_start_time' => [
                    'required',
                    'dateFormat:Y-m-d',
                    'before_or_equal:agreement_end_time',
                ],
                'agreement_end_time' => [
                    'required',
                    'dateFormat:Y-m-d',
                    'after_or_equal:agreement_start_time',
                ],
                'invoice' => ['required', 'in:0,1'],
                'repayment' => ['in:0,1'],
                'repayment_day' => ['between:1,999'],
                // 业务信息
                'quality_id' => [
                    'required',
                    'integer',
                    Rule::exists('zd_sys_user', 'id')->where(
                        'authority_level',
                        4
                    ),
                ],
                'advice_id' => [
                    'required',
                    'integer',
                    Rule::exists('zd_sys_user', 'id')->where(
                        'authority_level',
                        1
                    ),
                ],
                'running_id' => [
                    'nullable',
                    'integer',
                ],
                'sop' => ['required', 'in:0,1'],
                // 联系方式
                'content' => ['array'],
                'content.contacts' => ['required', 'min:0', 'max:10'],
                'content.contacts_phone' => ['required', 'phone'],
                'content.back_phone' => ['nullable', 'phone'],
                'content.address' => ['required', 'min:0', 'max:100'],
                //商户用户信息
                'user.phone' => ['required', Rule::unique('zd_merchant_user', 'phone')],
                'user.password' => ['required', 'min:6', 'max:20', 'confirmed'],
                'user.status' => ['in:0,1,2'],
            ];
    }


    public function attributes()
    {
        return [
            'quality_id' => '品质经理',
            'advice_id' => '客户顾问',
            'running_id' => '运行经理',
            'title' => '商户名称',
            'short_name' => '商户简称',
            'city' => '所属城市',
            'trade' => '行业',
            'bank' => '开户银行',
            'bank_no' => '银行卡号',
            'telephone' => '电话号码',
            'agreement_start_time' => '合同开始时间',
            'agreement_end_time' => '合同结束时间',
            'invoice' => '需要发票',
            'repayment' => '结算方式',
            'repayment_day' => '承诺回款天数',
            'sop' => '启用SOP服务',
            'content.contacts' => '联系人',
            'content.contacts_phone' => '联系手机号',
            'content.back_phone' => '备用电话',
            'content.address' => '收件地址',
            'user.password' => '账号密码',
            'user.status' => '账号状态',
        ];
    }


}
