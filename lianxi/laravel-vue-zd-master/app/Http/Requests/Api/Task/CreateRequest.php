<?php

namespace App\Http\Requests\Api\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Redis;

class CreateRequest extends FormRequest
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
            'type'                         => ['required', 'in:1,2'],
            'merchant_id'                  => ['required', 'integer', Rule::exists('zd_merchant', 'id')],
            'warehouse_id'                 => ['required', 'integer', Rule::exists('zd_warehouse', 'id'),],
            'name'                         => ['required', 'string', 'max:20'],
            'is_fixed_point'               => ['required', 'in:0,1'],
            'delivery_point'               => ['array'],
            'delivery_point.*.name'        => ['required_if:is_fixed_point,1', 'string'],
            'delivery_point.*.lng'         => ['required_if:is_fixed_point,1', 'position'],
            'delivery_point.*.lat'         => ['required_if:is_fixed_point,1', 'position'],
            'delivery_point.*.contacts'    => ['required_if:is_fixed_point,1', 'string'],
            'delivery_point.*.contact_way' => ['required_if:is_fixed_point,1', 'regex:/^1[34578]\d{9}$/'],
            'delivery_point_remark'        => ['required_if:is_fixed_point,0,1', 'string', 'max:300'],
            'unfixed_json'                 => ['required_if:is_fixed_point,0', 'nullable', 'ValidJson'],
            'is_back'                      => ['required', 'in:0,1'],
            'distance_json'                => ['required', 'ValidJson'],
            'arrival_date'                 => ['required_if:type,1', 'date'],
            'send_time'                    => ['array'],
            'send_time.*'                  => ['required_if:type,1', 'in:1,2,3,4,5,6,7'],
            'temp_start_date'              => ['required_if:type,2', 'date', 'before_or_equal:temp_end_date'],
            'temp_end_date'                => ['required_if:type,2', 'date', 'after_or_equal:temp_start_date'],
            'arrival_warehouse_time'       => ['required', 'dateFormat:H:i'],
            'estimate_time'                => ['required', 'dateFormat:H:i', 'different:arrival_warehouse_time'],
            'car_type_ids'                 => ['array'],
            'car_type_ids.*'               => ['required', Rule::exists('sys_car_type', 'id')],
            'merchant_safe_id'             => ['nullable'],
            'goods_remark'                 => ['required', 'string'],
            'goods_volume'                 => ['required', 'ValidJson'],
            'goods_weight'                 => ['required', 'ValidJson'],
            'goods_num'                    => ['nullable'],
            'back_bill'                    => ['required', 'in:0,1'],
            'receipt'                      => ['array'],
            'receipt.type'                 => ['required_if:back_bill,1', 'nullable', 'in:1,2,3,4'],
            'receipt.recipient'            => ['required_if:back_bill,1', 'nullable', 'string'],
            'receipt.phone'                => ['required_if:receipt.type,1,2,4', 'nullable', 'regex:/^1[34578]\d{9}$/'],
            'receipt.address'              => ['required_if:receipt.type,3', 'nullable', 'string'],
            'receipt.express'              => ['required_if:receipt.type,3', 'nullable', 'in:1,2'],
            'unit_price'                   => ['nullable'],
            'price_remark'                 => ['nullable', 'string', 'max:20'],
            'is_delivery'                  => ['required', 'in:0,1'],
            'dispatching'                  => ['array'],
            'dispatching.*'                => ['required_if:is_delivery,1', 'string'],
            'offer_end_time'               => ['required', 'date'],
            'choose_driver_end_time'       => ['required', 'date'],
            'carry_type'                   => ['required', 'in:0,1,2,3'],
            'carry'                        => ['array'],
            'carry.textarea'               => ['nullable', 'string', 'max:300'],
            'carry.is_worker'              => ['required', 'in:0,1'],
            'carry.is_loading'             => ['required', 'in:0,1'],
            'carry.is_unloading'           => ['required', 'in:0,1'],
            'other'                        => ['array'],
            'other.is_remove_seat'         => ['required', 'in:0,1'],
            'other.is_trolley'             => ['required', 'in:0,1'],
            'other.is_tail_plate'          => ['required', 'in:0,1'],
            'other.is_extinguisher'        => ['required', 'in:0,1'],
            'other.is_lock'                => ['required', 'in:0,1'],
            'other.other_require'          => ['nullable', 'string', 'max:300'],
            'supply'                       => ['array'],
            'supply.*'                     => ['nullable', 'string', 'max:300'],
            'welfare'                      => ['array'],
            'welfare.*'                    => ['nullable', 'string', 'max:300'],
            'is_show'                      => ['required', 'in:0,1'],
        ];
    }
    
    public function attributes()
    {
        return [
            'type'                         => '司机类型',
            'merchant_id'                  => '商户',
            'warehouse_id'                 => '仓库',
            'name'                         => '线路名称',
            'is_fixed_point'               => '配送点是否固定',
            'delivery_point.name.*'        => '配送点地址',
            'delivery_point.lng.*'         => '配送点地址经度',
            'delivery_point.lat.*'         => '配送点地址纬度',
            'delivery_point.contacts.*'    => '配送点联系人',
            'delivery_point.contact_way.*' => '配送点联系方式',
            'delivery_point_remark'        => '配送点描述',
            'unfixed_json'                 => '配送点数量',
            'is_back'                      => '是否需要返仓',
            'distance_json'                => '配送总里程',
            'arrival_date'                 => '司机上岗日期',
            'send_time.*'                  => '配送时间',
            'temp_start_date'              => '配送开始时间',
            'temp_end_date'                => '配送结束时间',
            'arrival_warehouse_time'       => '到仓时间',
            'estimate_time'                => '预计完成时间',
            'car_type_ids.*'               => '车型',
            'merchant_safe_id'             => '保价服务',
            'goods_remark'                 => '货物类型',
            'goods_volume'                 => '货物体积',
            'goods_weight'                 => '货物总重量',
            'goods_num'                    => '货物件数',
            'back_bill'                    => '是否需要回单',
            'receipt.type'                 => '回单方式',
            'receipt.recipient'            => '回单接收人',
            'receipt.phone'                => '回单联系方式',
            'receipt.address'              => '回单收件地址',
            'receipt.express'              => '回单快递费',
            'unit_price'                   => '预期单趟价格',
            'price_remark'                 => '报价说明',
            'is_delivery'                  => '配送经验要求',
            'dispatching.*'                => '配送要求',
            'offer_end_time'               => '司机报价截止时间',
            'choose_driver_end_time'       => '选司机截止时间',
            'carry_type'                   => '搬运说明',
            'carry.textarea'               => '搬运说明描述',
            'carry.is_worker'              => '是否自带小工',
            'carry.is_loading'             => '是否帮忙装货',
            'carry.is_unloading'           => '是否帮忙卸货',
            'other.is_remove_seat'         => '是否需要拆后座',
            'other.is_trolley'             => '是否需要小推车',
            'other.is_tail_plate'          => '是否需要带尾板',
            'other.is_extinguisher'        => '是否需要配备双灭火器',
            'other.is_lock'                => '是否需要配备明锁/暗锁',
            'other.other_require'          => '其他上岗要求',
            'supply.*'                     => '任务补充说明',
            'welfare.*'                    => '司机福利补贴奖励',
            'is_show'                      => '是否显示',
        ];
    }
    
    public function messages()
    {
        return [
        
        ];
    }
    
    public function withValidator(Validator $validator)
    {
        $validator->after(
            function (Validator $validator) {
                $message = $this->ArrivalDate();
                if ($message !== true) {
                    $validator->errors()->add('arrival_date', $message);
                }
                $message = $this->SendTimeWeek();
                if ($message !== true) {
                    $validator->errors()->add('send_time_week', $message);
                }
                $message = $this->TempStartDate();
                if ($message !== true) {
                    $validator->errors()->add('temp_start_date_v', $message);
                }
                $message = $this->TimeQuantum();
                if ($message !== true) {
                    $validator->errors()->add('Time_quantum', $message);
                }
            }
        );
    }
    
    /**
     * 司机上岗日期
     *
     * @return bool
     * @author Mark
     * @date   2018/7/18 16:33
     */
    public function ArrivalDate()
    {
        if ($this->input('type') == 1) {
            $arrivalDate = strtotime($this->input('arrival_date'));
            $time        = strtotime(date('Y-m-d 00:00:00'));
            if (($arrivalDate - $time) > 691200) {
                return '司机上岗日期范围只能在7天内！';
            }
        }
        
        return true;
    }
    
    /**
     * 验证星期几
     *
     * @return bool
     * @author Mark
     * @date   2018/7/18 16:40
     */
    public function SendTimeWeek()
    {
        
        if ($this->input('type') == 1) {
            $week = date('w', strtotime($this->input('arrival_date'))) != 0
                ? date(
                    'w',
                    strtotime($this->input('arrival_date'))
                ) : 7;
            
            $endTimeArr = (array) $this->input('send_time');
            if (!in_array($week, $endTimeArr) && !empty($endTimeArr)) {
                $weekstr = '';
                foreach ($endTimeArr as $val) {
                    $w       = [
                        1 => '一',
                        2 => '二',
                        3 => '三',
                        4 => '四',
                        5 => '五',
                        6 => '六',
                        7 => '日',
                    ];
                    $weekstr .= '星期' . $w[$val] . ',';
                }
                
                return '您设置的【配送时间】为' . $weekstr . '上岗日期不在配送时间内，请重新设置';
                
            }
            else {
                return true;
            }
        }
        else {
            return true;
        }
    }
    
    
    /**
     * 临时任务时间段
     *
     * @return bool
     * @author Mark
     * @date   2018/7/18 16:37
     */
    public function TempStartDate()
    {
        if ($this->input('type') == 2) {
            $time      = strtotime(date('Y-m-d 00:00:00'));
            $startTime = strtotime($this->input('temp_start_date'));
            $endTime   = strtotime($this->input('temp_end_date'));
            if ($startTime < $time) {
                return '开始时间不能小于当前时间';
            }
            if (($startTime - $time) > 691200) {
                return '开始时间不能大于7天';
            }
            if (($endTime - $startTime) >= 864000) {
                return '最多只能发布10天的任务';
            }
        }
        
        return true;
    }
    
    
    /**
     * 时间段验证
     *
     * @return bool
     * @author Mark
     * @date   2018/7/18 16:47
     */
    public function TimeQuantum()
    {
        $time           = strtotime($this->input('timestamp'));
        $offer_end_time = $this->DefaultTime($time);
        
        $type   = ($this->input('type') == 1) ? '主' : '临时';
        $config = json_decode(Redis::get("zhoudao:sysconfig"), true);
        // 报价
        $offerArr = [
            'min' => ($this->input(
                    'type'
                ) == 1) ? $config['master_driver_quote_latest_time'] * 3600
                : $config['temp_driver_quote_earliest_time'] * 3600,
            'max' => ($this->input(
                    'type'
                ) == 1) ? $config['master_driver_quote_lastest_time'] * 3600
                : $config['temp_driver_quote_lastest_time'] * 3600,
        ];
        
        // 最早到仓
        $earliest = ($this->input(
                'type'
            ) == 1) ? $config['master_driver_reach_earliest_time'] * 3600
            : $config['temp_driver_reach_earliest_time'] * 3600;
        
        // 到仓时间
        $arrival = ($this->input('type') == 1)
            ? strtotime(
                $this->input('arrival_date') . ' ' . $this->input(
                    'arrival_warehouse_time'
                ) . ':59'
            )
            : strtotime(
                $this->input('temp_start_date') . ' ' . $this->input(
                    'arrival_warehouse_time'
                ) . ':59'
            );
        // 报价截止时间
        $offer = strtotime($offer_end_time);
        
        if (($offer - $time) < $offerArr['min']) {
            return '报价截止时间距现在太近,请将您截止时间设置在' . date(
                    'm月d日 H:i',
                    ($time + $offerArr['min'])
                ) . '之后【' . $type . '任务发布后至少预留' . ($offerArr['min'] / 60) . '分钟过行司机报价】';
        }
        
        if ($offer - $time > $offerArr['max']) {
            return '报价截止时间应当在' . ($offerArr['max'] / 3600) . '小时之内';
        }
        
        if (($arrival - $offer) < ($earliest - $offerArr['min'])) {
            return '报价截止时间距上岗时间太近,请将您把上岗时间设置在' . date(
                    'm月d日 H:i',
                    ($offer + ($earliest - $offerArr['min']))
                ) . '之后【' . $type . '任务发布后至少预留' . (($earliest - $offerArr['min'])
                                                   / 3600) . '小时】';
        }
        
        if ($arrival - $time < $earliest) {
            return '您设置的到仓时间距现在太近, 请您将到仓时间设置在' . date(
                    'm月d日 H:i',
                    $time + $earliest
                ) . '之后。【' . $type . '任务到仓前至少预留' . ($earliest / 3600) . '小时】';
        }
        
        return true;
    }
    
    
    /**
     * 报价截至时间
     *
     * @param $time
     *
     * @return false|string
     * @author Mark
     * @date   xxx
     */
    public function DefaultTime($time)
    {
        $config   = json_decode(Redis::get("zhoudao:sysconfig"), true);
        $offerArr = [
            'min' => ($this->input(
                    'type'
                ) == 1) ? $config['master_driver_quote_latest_time'] * 3600
                : $config['temp_driver_quote_earliest_time'] * 3600,
            'max' => ($this->input(
                    'type'
                ) == 1) ? $config['master_driver_quote_lastest_time'] * 3600
                : $config['temp_driver_quote_lastest_time'] * 3600,
        ];
        
        return date('Y-m-d H:i:s', $time + $offerArr['min']);
    }
    
    
    /**
     * 选司机截至时间
     *
     * @return false|string
     * @author Mark
     * @date   2018/7/19 13:54
     */
    public function DefaultChooseTime($time)
    {
        $config   = json_decode(Redis::get("zhoudao:sysconfig"), true);
        $offerArr = [
            'min' => $this->input('type') == 1
                ? $config['master_driver_quote_latest_time'] * 3600
                : $config['temp_driver_quote_earliest_time'] * 3600,
            'max' => $this->input('type') == 1
                ? $config['master_driver_quote_lastest_time'] * 3600
                : $config['temp_driver_quote_lastest_time'] * 3600,
        ];
        $timeDiff = $this->input('type') == 1
            ? $config['change_master_driver_latest_time_before_work'] * 3600
            : $config['change_temp_driver_latest_time_before_work'] * 3600;
        
        if ($this->input('type') == 1) {
            $arrival_date_timestamp = strtotime(
                $this->input('arrival_date') . " " . $this->input(
                    'arrival_warehouse_time'
                )
            );
            if ($arrival_date_timestamp - time() > $config['master_driver_quote_time_more_now'] * 3600) {
                return date('Y-m-d H:i:s', time() + $config['master_driver_quote_time_add'] * 3600);
            }
            else {
                return date('Y-m-d H:i:s', $arrival_date_timestamp - $timeDiff);
            }
        }
        else {
            $arrival_date_timestamp = strtotime(
                $this->input('temp_start_date') . " 00:00:00"
            );
            if ($arrival_date_timestamp - time() > $config['temp_driver_quote_time_more_now'] * 3600) {
                return date('Y-m-d H:i:s', time() + $config['temp_driver_quote_time_more_add'] * 3600);
            }
            else {
                return date(
                    'Y-m-d H:i:s',
                    $time + $offerArr['min'] + $timeDiff
                );
            }
        }
    }
    
    
    /**
     * 默认值
     *
     * @return mixed
     * @author Mark
     * @date   2018/7/20 13:19
     */
    public function DefaultValue($post, $time)
    {
        $post['offer_end_time']         = $this->DefaultTime($time);
        $post['choose_driver_end_time'] = $this->DefaultChooseTime($time);
        
        return $post;
    }
    
}
