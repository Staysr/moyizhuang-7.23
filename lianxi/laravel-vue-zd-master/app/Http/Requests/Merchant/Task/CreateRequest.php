<?php

namespace App\Http\Requests\Merchant\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;
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
            'warehouse_id'                 => [
                'required',
                Rule::exists('zd_warehouse', 'id'),
            ],
            'is_fixed_point'               => ['required', 'in:0,1'],
            'delivery_point'               => [
                'required_if:is_fixed_point,1',
                'array',
            ],
            'delivery_point.*.name'        => [
                'required_if:is_fixed_point,1',
                'min:3',
                'max:100',
            ],
            'delivery_point.*.location'    => [
                'required_if:is_fixed_point,1',
                'location',
            ],
            'delivery_point.*.contacts'    => ['required_if:is_fixed_point,1'],
            'delivery_point.*.contact_way' => [
                'required_if:is_fixed_point,1',
                'phone',
            ],
            'unfixed_json'                 => [
                'required_if:is_fixed_point,0',
                'ValidJson',
            ],
            'delivery_point_remark'        => ['required', 'max:300'],
            'arrival_date'                 => [
                'required_if:type,1',
                'dateFormat:Y-m-d',
            ],
            'send_time'                    => ['required_if:type,1', 'array'],
            'temp_start_date'              => [
                'required_if:type,2',
                'dateFormat:Y-m-d',
                'before_or_equal:temp_end_date',
            ],
            'temp_end_date'                => [
                'required_if:type,2',
                'dateFormat:Y-m-d',
                'after_or_equal:temp_start_date',
            ],
            'arrival_warehouse_time'       => ['required', 'dateFormat:H:i'],
            'estimate_time'                => [
                'required',
                'dateFormat:H:i',
                'different:arrival_warehouse_time',
            ],
            'car_type_ids'                 => ['required', 'array'],
            'carry_type'                   => ['required', 'in:0,1,2,3'],
            'carry'                        => ['array'],
            'carry.textarea'               => [
                'required_with:carry',
                'max:300',
            ],
            'carry.is_worker'              => ['required_with:carry', 'in:0,1'],
            'carry.is_loading'             => ['required_with:carry', 'in:0,1'],
            'carry.is_unloading'           => ['required_with:carry', 'in:0,1'],
            'other'                        => ['array'],
            'other.is_remove_seat'         => ['required_with:other', 'in:0,1'],
            'other.is_trolley'             => ['required_with:other', 'in:0,1'],
            'other.is_tail_plate'          => ['required_with:other', 'in:0,1'],
            'other.is_extinguisher'        => ['required_with:other', 'in:0,1'],
            'other.is_lock'                => ['required_with:other', 'in:0,1'],
            'other.other_require'          => ['max:300'],
            'supply'                       => ['array'],
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
            $time = strtotime(date('Y-m-d 00:00:00'));
            if (($arrivalDate - $time) > 691200) {
                return '司机上岗日期范围只能在7天内！';
            }
        }

        return true;
    }

    public function attributes()
    {
        return [
            'type'                   => '任务类型',
            'warehouse_id'           => '仓库ID',
            'is_fixed_point'         => '固定点配送点',
            'delivery_point'         => '配送点列表',
            'unfixed_json'           => '非固定配送点数量',
            'delivery_point_remark'  => '配送点备注',
            'arrival_date'           => '到仓时间',
            'send_time'              => '配送时间',
            'temp_start_date'        => '临时任务开始时间',
            'temp_end_date'          => '临时任务结束时间',
            'arrival_warehouse_time' => '到仓时间',
            'estimate_time'          => '预计完成时间',
            'car_type_ids'           => '车型ID',
            'carry_type'             => '搬运信息',
            'carry.textarea'         => '搬运说明',
            'carry.is_worker'        => '是否自带小工',
            'carry.is_loading'       => '是否帮忙装货',
            'carry.is_unloading'     => '是否帮忙卸货',
            'other'                  => '其他说明',
            'other.is_remove_seat'   => '是否自带小工',
            'other.is_trolley'       => '是否需要小推车',
            'other.is_tail_plate'    => '是否需要带尾板',
            'other.is_extinguisher'  => '是否需要配备双灭火器',
            'other.is_lock'          => '是否上锁',
            'other.other_require'    => '其他说明',
            'supply'                 => '任务补充说明',
        ];
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

            $endTimeArr = (array)$this->input('send_time');
            if (!in_array($week, $endTimeArr) && !empty($endTimeArr)) {
                $weekstr = '';
                foreach ($endTimeArr as $val) {
                    $w = [
                        1 => '一',
                        2 => '二',
                        3 => '三',
                        4 => '四',
                        5 => '五',
                        6 => '六',
                        7 => '日',
                    ];
                    $weekstr .= '星期'.$w[$val].',';
                }

                return '您设置的【配送时间】为'.$weekstr.'上岗日期不在配送时间内，请重新设置';

            } else {
                return true;
            }
        } else {
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
            $time = strtotime(date('Y-m-d 00:00:00'));
            $startTime = strtotime($this->input('temp_start_date'));
            $endTime = strtotime($this->input('temp_end_date'));
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
        $time = strtotime($this->input('timestamp'));
        $offer_end_time = $this->DefaultTime($time);

        $type = ($this->input('type') == 1) ? '主' : '临时';
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
                $this->input('arrival_date').' '.$this->input(
                    'arrival_warehouse_time'
                ).':59'
            )
            : strtotime(
                $this->input('temp_start_date').' '.$this->input(
                    'arrival_warehouse_time'
                ).':59'
            );
        // 报价截止时间
        $offer = strtotime($offer_end_time);

        if (($offer - $time) < $offerArr['min']) {
            return '报价截止时间距现在太近,请将您截止时间设置在'.date(
                    'm月d日 H:i',
                    ($time + $offerArr['min'])
                ).'之后【'.$type.'任务发布后至少预留'.($offerArr['min'] / 60).'分钟过行司机报价】';
        }

        if ($offer - $time > $offerArr['max']) {
            return '报价截止时间应当在'.($offerArr['max'] / 3600).'小时之内';
        }

        if (($arrival - $offer) < ($earliest - $offerArr['min'])) {
            return '报价截止时间距上岗时间太近,请将您把上岗时间设置在'.date(
                    'm月d日 H:i',
                    ($offer + ($earliest - $offerArr['min']))
                ).'之后【'.$type.'任务发布后至少预留'.(($earliest - $offerArr['min'])
                    / 3600).'小时】';
        }

        if ($arrival - $time < $earliest) {
            return '您设置的到仓时间距现在太近, 请您将到仓时间设置在'.date(
                    'm月d日 H:i',
                    $time + $earliest
                ).'之后。【'.$type.'任务到仓前至少预留'.($earliest / 3600).'小时】';
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
        $config = json_decode(Redis::get("zhoudao:sysconfig"), true);
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
        $config = json_decode(Redis::get("zhoudao:sysconfig"), true);
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
                $this->input('arrival_date')." ".$this->input(
                    'arrival_warehouse_time'
                )
            );
            if($arrival_date_timestamp-time()>$config['master_driver_quote_time_more_now']*3600){
                return date('Y-m-d H:i:s', time()+$config['master_driver_quote_time_add']*3600 );
            }else{
                return date('Y-m-d H:i:s', $arrival_date_timestamp - $timeDiff);
            }
        } else {
            $arrival_date_timestamp = strtotime(
                $this->input('temp_start_date')." 00:00:00"
            );
            if($arrival_date_timestamp-time()>$config['temp_driver_quote_time_more_now']*3600){
                return date('Y-m-d H:i:s', time()+$config['temp_driver_quote_time_more_add']*3600 );
            }else{
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
        $post['merchant_id'] = auth()->user()->merchant_id;
        $post['offer_end_time'] = $this->DefaultTime($time);
        $post['choose_driver_end_time'] = $this->DefaultChooseTime($time);

        return $post;
    }

}
