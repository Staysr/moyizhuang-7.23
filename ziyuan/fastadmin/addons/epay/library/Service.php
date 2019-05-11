<?php

namespace addons\epay\library;

use Exception;
use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;

/**
 * 订单服务类
 *
 * @package addons\epay\library
 */
class Service
{

    public static function submitOrder($amount, $orderid = null, $type = null, $title = null, $notifyurl = null, $returnurl = null, $method = null)
    {
        if (!is_array($amount)) {
            $params = [
                'amount'    => $amount,
                'orderid'   => $orderid,
                'type'      => $type,
                'title'     => $title,
                'notifyurl' => $notifyurl,
                'returnurl' => $returnurl,
                'method'    => $method,
            ];
        }
        $type = isset($params['type']) && in_array($params['type'], ['alipay', 'wechat']) ? $params['type'] : 'wechat';
        $method = isset($params['method']) ? $params['method'] : 'web';
        $orderid = isset($params['orderid']) ? $params['orderid'] : date("YmdHis") . mt_rand(100000, 999999);
        $amount = isset($params['amount']) ? $params['amount'] : 1;
        $title = isset($params['title']) ? $params['title'] : "支付";
        $auth_code = isset($params['auth_code']) ? $params['auth_code'] : '';
        $openid = isset($params['openid']) ? $params['openid'] : '';

        $request = request();
        $notifyurl = isset($params['notifyurl']) ? $params['notifyurl'] : $request->root(true) . '/addons/epay/index/' . $type . 'notify';
        $returnurl = isset($params['returnurl']) ? $params['returnurl'] : $request->root(true) . '/addons/epay/index/' . $type . 'return/out_trade_no/' . $orderid;
        if ($type == 'alipay') {
            //创建支付对象
            $pay = Pay::alipay(Service::getConfig('alipay'));
            //支付宝支付,请根据你的需求,仅选择你所需要的即可
            $params = [
                'out_trade_no' => $orderid,//你的订单号
                'total_amount' => $amount,//单位元
                'subject'      => $title,
                'notify_url'   => $notifyurl,
                'return_url'   => $returnurl
            ];

            switch ($method) {
                case 'web':
                    //电脑支付,跳转
                    return $pay->web($params)->send();
                case 'wap':
                    //手机网页支付,跳转
                    return $pay->wap($params)->send();
                case 'app':
                    //APP支付,直接返回字符串
                    return $pay->app($params)->send();
                case 'scan':
                    //扫码支付,直接返回字符串
                    return $pay->scan($params);
                case 'pos':
                    //刷卡支付,直接返回字符串
                    //刷卡支付必须要有auth_code
                    $params['auth_code'] = $auth_code;
                    return $pay->pos($params);
                default:
                    //其它支付类型请参考：https://docs.pay.yansongda.cn/alipay
            }
        } else {
            //创建支付对象
            $pay = Pay::wechat(Service::getConfig('wechat'));
            $params = [
                'out_trade_no' => $orderid,//你的订单号
                'body'         => $title,
                'total_fee'    => $amount * 100, //单位分
                'notify_url'   => $notifyurl,
                'return_url'   => $returnurl
            ];

            switch ($method) {
                case 'web':
                    //电脑支付,跳转到自定义展示页面(FastAdmin独有)
                    return $pay->web($params)->send();
                case 'mp':
                    //公众号支付
                    //公众号支付必须有openid
                    $params['openid'] = $openid;
                    return $pay->mp($params);
                case 'wap':
                    //手机网页支付,跳转
                    return $pay->wap($params)->send();
                case 'app':
                    //APP支付,直接返回字符串
                    return $pay->app($params)->send();
                case 'scan':
                    //扫码支付,直接返回字符串
                    return $pay->scan($params);
                case 'pos':
                    //刷卡支付,直接返回字符串
                    //刷卡支付必须要有auth_code
                    $params['auth_code'] = $auth_code;
                    return $pay->pos($params);
                case 'miniapp':
                    //小程序支付,直接返回字符串
                    //小程序支付必须要有openid
                    $params['openid'] = $openid;
                    return $pay->miniapp($params);
                default:
            }
        }
        return "";
    }

    /**
     * 创建支付对象
     * @param string $type   支付类型
     * @param array  $config 配置信息
     * @return bool|\Yansongda\Pay\Gateways\Alipay|\Yansongda\Pay\Gateways\Wechat
     */
    public static function createPay($type, $config = [])
    {
        $type = strtolower($type);
        if (!in_array($type, ['wechat', 'alipay'])) {
            return false;
        }
        $pay = Pay::$type(array_merge(self::getConfig($type), $config));
        return $pay;
    }

    /**
     * 验证回调是否成功
     * @param string $type   支付类型
     * @param array  $config 配置信息
     * @return bool|\Yansongda\Pay\Gateways\Alipay|\Yansongda\Pay\Gateways\Wechat
     */
    public static function checkNotify($type, $config = [])
    {
        $type = strtolower($type);
        if (!in_array($type, ['wechat', 'alipay'])) {
            return false;
        }
        try {
            $pay = Pay::$type(array_merge(self::getConfig($type), $config));
            $data = $pay->verify();
            Log::debug($type . ' notify', $data->all());

            if ($type == 'alipay') {
                if (in_array($data->trade_status, ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
                    return $pay;
                }
            } else {
                return $pay;
            }
        } catch (Exception $e) {
            return false;
        }

        return $pay;
    }

    /**
     * 验证返回是否成功
     * @param string $type   支付类型
     * @param array  $config 配置信息
     * @return bool|\Yansongda\Pay\Gateways\Alipay|\Yansongda\Pay\Gateways\Wechat
     */
    public static function checkReturn($type, $config = [])
    {
        $type = strtolower($type);
        if (!in_array($type, ['wechat', 'alipay'])) {
            return false;
        }
        //微信无需验证
        if ($type == 'wechat') {
            return true;
        }
        try {
            $pay = Pay::$type(array_merge(self::getConfig($type), $config))->verify();
        } catch (Exception $e) {
            return false;
        }

        return $pay;
    }

    /**
     * 获取配置
     * @param string $type 支付类型
     * @return array|mixed
     */
    public static function getConfig($type = 'wechat')
    {
        $config = get_addon_config('epay');
        $config = isset($config[$type]) ? $config[$type] : $config['wechat'];
        if ($config['log']) {
            $config['log'] = [
                'file'  => LOG_PATH . '/epaylogs/' . $type . '-' . date("Y-m-d") . '.log',
                'level' => 'debug'
            ];
        }

        $config['notify_url'] = empty($config['notify_url']) ? addon_url('epay/api/notifyx', [], false) . '/type/' . $type : $config['notify_url'];
        $config['notify_url'] = !preg_match("/^(http:\/\/|https:\/\/)/i", $config['notify_url']) ? request()->root(true) . $config['notify_url'] : $config['notify_url'];
        //只有支付宝才配置return_url
        if ($type == 'alipay') {
            $config['return_url'] = empty($config['return_url']) ? addon_url('epay/api/returnx', [], false) . '/type/' . $type : $config['return_url'];
            $config['return_url'] = !preg_match("/^(http:\/\/|https:\/\/)/i", $config['return_url']) ? request()->root(true) . $config['return_url'] : $config['return_url'];
        }
        return $config;
    }

}