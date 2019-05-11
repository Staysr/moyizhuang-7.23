<?php

namespace App\Http\Requests\Api\Config;

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
        return [
            'driver_sign_before_time'                         => ['required', 'numeric'],
            'driver_sign_after_time'                          => ['required', 'numeric'],
            'driver_sign_radius'                              => ['required', 'numeric'],
            'driver_dispatch_after_warehouse'                 => ['required', 'numeric'],
            'master_driver_not_dispatch_before_warehouse'     => ['required', 'numeric'],
            'temp_driver_not_dispatch_before_warehouse'       => ['required', 'numeric'],
            'master_driver_task_free_driver_before_warehouse' => ['required', 'numeric'],
            'temp_driver_task_free_driver_before_warehouse'   => ['required', 'numeric'],
            'master_driver_quote_latest_time'                 => ['required', 'numeric'],
            'master_driver_reach_earliest_time'               => ['required', 'numeric'],
            'change_master_driver_latest_time_before_work'    => ['required', 'numeric'],
            'master_driver_quote_lastest_time'                => ['required', 'numeric'],
            'master_driver_quote_time_more_now'               => ['required', 'numeric'],
            'master_driver_quote_time_add'                    => ['required', 'numeric'],
            'master_driver_quote_time_sub'                    => ['required', 'numeric'],
            'temp_driver_quote_earliest_time'                 => ['required', 'numeric'],
            'temp_driver_reach_earliest_time'                 => ['required', 'numeric'],
            'change_temp_driver_latest_time_before_work'      => ['required', 'numeric'],
            'temp_driver_quote_lastest_time'                  => ['required', 'numeric'],
            'temp_driver_quote_time_more_now'                 => ['required', 'numeric'],
            'temp_driver_quote_time_more_add'                 => ['required', 'numeric'],
            'temp_driver_quote_time_more_sub'                 => ['required', 'numeric'],
            'task_conflict_time'                              => ['required', 'numeric'],
            'percentage'                                      => ['required', 'numeric'],
            'update_offer_count'                              => ['required', 'numeric'],
            'cancel_offer_count'                              => ['required', 'numeric'],
            'cancel_offer_frozen_time'                        => ['required', 'numeric'],
            'is_send_leader'                                  => ['required', 'in:0,1'],
            'sms_before_warehouse_time'                       => ['required', 'numeric'],
        ];
    }
    
    public function attributes()
    {
        return [
            'driver_sign_before_time'                         => '允许司机签到时间为到仓前',
            'driver_sign_after_time'                          => '允许司机签到时间为到仓后',
            'driver_sign_radius'                              => '允许司机签到范围为仓库半径',
            'driver_dispatch_after_warehouse'                 => '允许司机操作配送完成为离仓后',
            'master_driver_not_dispatch_before_warehouse'     => '主司机设置不配送需要在到仓前',
            'temp_driver_not_dispatch_before_warehouse'       => '临时司机设置不配送需要在到仓前',
            'master_driver_task_free_driver_before_warehouse' => '主司机任务无责任解约司机需要在到仓前',
            'temp_driver_task_free_driver_before_warehouse'   => '临时司机任务无责任解约司机需要在到仓前',
            'master_driver_quote_latest_time'                 => '最早报价截止时间',
            'master_driver_reach_earliest_time'               => '最早到仓时间',
            'change_master_driver_latest_time_before_work'    => '选司机截止时间为上岗前',
            'master_driver_quote_lastest_time'                => '司机报价最晚截止时间',
            'master_driver_quote_time_more_now'               => '默认司机报价截止时间，如果到仓时间距离现在时间大于',
            'master_driver_quote_time_add'                    => '则现在时间加',
            'master_driver_quote_time_sub'                    => '如果小于，则到仓时间减',
            'temp_driver_quote_earliest_time'                 => '最早报价截止时间',
            'temp_driver_reach_earliest_time'                 => '最早到仓时间',
            'change_temp_driver_latest_time_before_work'      => '选司机截止时间为司机报价截止后',
            'temp_driver_quote_lastest_time'                  => '司机报价最晚截止时间',
            'temp_driver_quote_time_more_now'                 => '默认司机报价截止时间，如果到仓时间距离现在时间大于几小时',
            'temp_driver_quote_time_more_add'                 => '则现在时间加几小时',
            'temp_driver_quote_time_more_sub'                 => '如果小于，则到仓时间减几小时',
            'task_conflict_time'                              => '任务冲突时间',
            'percentage'                                      => '管理费提成比率(报价的X%)',
            'update_offer_count'                              => '司机报价可修改次数',
            'cancel_offer_count'                              => '司机第几次取消后',
            'cancel_offer_frozen_time'                        => '会被加入黑名单几天内不能报价',
            'is_send_leader'                                  => '是否给所属队长发送未签到短信',
            'sms_before_warehouse_time'                       => '司机在到仓时间前(负数为后)几分钟未签到发送短信提醒',
        ];
    }
    
}
