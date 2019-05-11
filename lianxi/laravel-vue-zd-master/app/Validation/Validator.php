<?php
/**
 * car-master
 * Validatorphp.
 * @author luffyzhao@vip.126.com
 */

namespace App\Validation;

use Illuminate\Validation\Validator as Base;
use Illuminate\Support\Facades\Redis;
use DateTime;

class Validator extends Base
{
    /**
     * 手机号码
     * @method ValidatePhone
     * @param $attribute
     * @param $value
     * @param $parameters
     *
     * @return false|int
     *
     * @author luffyzhao@vip.126.com
     */
    public function ValidatePhone($attribute, $value, $parameters)
    {
        return preg_match('/^[1]\d{10}$/', $value);
    }

    /**
     * 验证时间格式
     * @method ValidateDateTime
     * @param $attribute
     * @param $value
     * @param $parameters
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    public function ValidateDateTime($attribute, $value, $parameters)
    {
        if ($value === '' || $value === null) {
            return true;
        }

        return (bool)DateTime::createFromFormat($parameters[0] ?? 'Y-m-d', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     *
     */
    public function ValidateImages($attribute, $value, $parameters)
    {
        foreach ($value as $v) {
            if (isset($v['path'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * 验证码
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     * @author Mark
     * @date 2018/6/11 11:16
     */
    public function ValidateCode($attribute, $value, $parameters)
    {
        $code = Redis::get("zhoudao:app:".$parameters[0].":".$this->attributes()['phone']);
        if ($value == $code) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 经纬度
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return false|int
     * @author Mark
     * @date 2018/6/11 11:16
     */
    public function ValidateLocation($attribute, $value, $parameters)
    {
        return preg_match('/^[0-9]{2,3}(\.[0-9]{1,10})?,[0-9]{2,3}(\.[0-9]{1,10})?$/', $value);
    }
    
    /**
     * 经度/纬度
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return false|int
     */
    public function ValidatePosition($attribute, $value, $parameters)
    {
        return preg_match('/^[0-9]{2,3}(\.[0-9]{1,10})?$/', $value);
    }



    /**
     * 大小值范围
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     * @author Mark
     * @date 2018/6/12 13:45
     */
    public function ValidateValidJson($attribute, $value, $parameters)
    {
        if (isset($value['min']) && isset($value['max'])) {
            $min = (int)$value['min'];
            $max = (int)$value['max'];
            if ($min >= 0 && $min <= 99999 && $max >= 0 && $max <= 99999 && $min <= $max) {
                return true;
            } else {
                $this->setCustomMessages(
                    ['valid_json' => 'json必须包含min和max两个整数值，其中min小于等于max,在0-99999范围之间']
                );

                return false;
            }
        } else {
            $this->setCustomMessages(
                ['valid_json' => 'json必须包含min和max两个整数值，其中min小于等于max,在0-99999范围之间']
            );

            return false;
        }
    }


    /**
     * 允许两位小数的金额,包含0
     * @param $attribute
     * @param $value
     * @param $parameters
     *
     * @return bool
     * @author Mark
     * @date   2018/8/9 15:39
     */
    public function ValidateMoney($attribute,$value,$parameters)
    {
        if (preg_match('/^(([1-9]\d{0,9})|0)(\.\d{0,2})?$/', $value)) {
            return true;
        } else {
            return false;
        }
    }




}


