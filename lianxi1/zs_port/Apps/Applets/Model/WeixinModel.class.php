<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 3:37
 */
namespace Applets\Model;

use Think\Model;

class WeixinModel extends Model
{
    private $appid;
    private $mch_id;
    private $key;
    private $appsecret;
    private $notify_url;
    private $trade_type;
    private $values;
    private $sslcert_path;
    private $sslkey_path;
    //响应
    private $response;

    /**
     * 构造函数
     * 主要配置微信支付商户号等配置信息
     * @param type $config
     */
    public function __construct($config = array()) {
        foreach ($config as $key => $val) {
            $this->$key = $val;
        }
    }
    /**
     *
     * 统一下单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param WxPayUnifiedOrder $inputObj
     * @param int $timeOut
     * @throws WxPayException
     * @return 成功时返回，其他抛异常
     */
    public function unifiedOrder($order = array(), $timeOut = 6) {
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        //检测必填参数
        $checkResult = $this->checkParam($order);
        if ($checkResult['status'] !== 200) {
            return failed($checkResult['msg'], $checkResult['status']);
        }
        $this->values = $order;

        //异步通知url未设置，则使用配置文件中的url
        if (!isset($this->values['notify_url'])) {
            $this->values['notify_url'] = $this->notify_url; //异步通知url
        }
        $this->values['appid'] = $this->appid; //公众账号ID
        $this->values['mch_id'] = $this->mch_id; //商户号
        $this->values['trade_type'] = $this->trade_type; //支付类型
        $this->values['spbill_create_ip'] = $_SERVER['REMOTE_ADDR']; //终端ip
        $this->values['nonce_str'] = getNonceStr();    //随机字符串
        //签名
        $this->SetSign();
        $xml = $this->ToXml();

        $startTimeStamp = getMillisecond(); //请求开始时间
        //执行支付请求
        $response = $this->postXmlCurl($xml, $url, false, $timeOut);

        //判断响应
        if (empty($response)) {
            return failed('请求超时,微信无响应', 1100);
        }

        //解析响应
        $result = $this->FromXml($response);

        //判断本次通讯是否成功
        if ($result['return_code'] != 'SUCCESS') {
            return failed($result['return_msg'], 504);
        }

        //校验返回数据
        $checkResponse = $this->checkResponse();
        if ($checkResponse['status'] != 200) {
            return failed($checkResponse['msg'], $checkResponse['status']);
        }

        //重新组装客户端数据
        $this->values = array();
        $this->values['appid'] = $this->appid; //公众账号ID
        $this->values['partnerid'] = $this->mch_id; //商户号
        $this->values['trade_type'] = $this->trade_type; //支付类型
        $this->values['prepayid'] = $checkResponse['data']['prepay_id']; //预支付交易会话ID
        $this->values['package'] = 'Sign=WXPay'; //扩展字段
        $this->values['noncestr'] = getNonceStr();    //随机字符串
        $this->values['timestamp'] = time(); //时间戳
        $this->values['spbill_create_ip'] = $_SERVER['REMOTE_ADDR']; //终端ip
        $this->SetSign();
        if($this->trade_type == "JSAPI"){
            $this->values['paySign'] = MD5("appId={$this->values['appid']}&nonceStr={$this->values['noncestr']}&package=prepay_id={$this->values['prepayid']}&signType=MD5&timeStamp={$this->values['timestamp']}&key={$this->key}");
        }
        return success($this->values);
    }
    /**
     * 校验下单返回数据
     * @return type
     */
    public function checkResponse() {
        if (!isset($this->values['sign'])) {
            return failed('返回签名错误', 505);
        }
        $sign = $this->MakeSign();
        if ($this->values['sign'] != $sign) {
            return failed('返回签名校验错误', 506);
        }
        return success($this->values);
    }
    /**
     * 校验订单基本参数是否设置
     * @param type $order
     * @return type
     */
    public function checkParam($order = array()) {
        //out_trade_no、body、total_fee、trade_type
        if (!is_array($order) || empty($order)) {
            return failed('订单数据格式不正确', 511);
        }

        if (!isset($order['out_trade_no']) || !$order['out_trade_no']) {
            return failed('未定义订单号', 512);
        }

        if (!isset($order['body']) || !$order['body']) {
            return failed('未定义商品描述', 513);
        }

        if (!isset($order['total_fee']) || !is_numeric($order['total_fee']) || $order['total_fee'] <= 0) {
            return failed('订单金额错误', 514);
        }

        if (!isset($this->trade_type) || !$this->trade_type) {
            return failed('未定义订单支付方式', 515);
        }
        return success();
    }
    /**
     * 设置签名，详见签名生成算法
     * @param string $value
     * */
    public function SetSign() {
        $sign = $this->MakeSign();
        $this->values['sign'] = $sign;
        return $sign;
    }
    /**
     * 生成签名
     * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
     */
    public function MakeSign() {
        //签名步骤一：按字典序排序参数
        ksort($this->values);
        $string = $this->ToUrlParams();
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $this->key;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }
    /**
     * 格式化参数格式化成url参数
     */
    public function ToUrlParams() {
        $buff = "";
        foreach ($this->values as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
    /**
     * 输出xml字符
     * @throws WxPayException
     * */
    public function ToXml() {
        if (!is_array($this->values) || count($this->values) <= 0) {
            throw new Exception("数组数据异常！");
        }

        $xml = "<xml>";
        foreach ($this->values as $key => $val) {
            if (is_numeric($val)) {
                $xml.="<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml.="<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }
    /**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
    public function FromXml($xml) {
        if (!$xml) {
            return array();
        }
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $this->values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $this->values;
    }
    /**
     * 以post方式提交xml到对应的接口url
     *
     * @param string $xml  需要post的xml数据
     * @param string $url  url
     * @param bool $useCert 是否需要证书，默认不需要
     * @param int $second   url执行超时时间，默认30s
     * @throws WxPayException
     */
    private function postXmlCurl($xml, $url, $useCert = false, $second = 30) {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);

        //如果有配置代理这里就设置代理
        /*
          if (WxPayConfig::CURL_PROXY_HOST != "0.0.0.0" && WxPayConfig::CURL_PROXY_PORT != 0) {
          curl_setopt($ch, CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST);
          curl_setopt($ch, CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT);
          }
         *
         */
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if ($useCert == true) {
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLCERT, $this->sslcert_path);
            curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLKEY, $this->sslkey_path);
        } else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            return array();
        }
    }
    /**
     * 获取毫秒级别的时间戳
     */
    public function getMillisecond() {
        //获取毫秒的时间戳
        $time = explode(" ", microtime());
        $time = $time[1] . ($time[0] * 1000);
        $time2 = explode(".", $time);
        $time = $time2[0];
        return $time;
    }

    /**
     * 异步数据校验
     * @param type $xml
     * @return type
     */
    public function notify($xml) {

        $resultData = $this->FromXml($xml);
        if (empty($resultData)) {
            return failed('返回数据不合法', 500);
        }

        $this->values = $resultData;
        $this->values['appid'] = $this->appid;
        $this->values['mch_id'] = $this->mch_id;
        //生成sign
        $checkSign = $this->MakeSign();
        //对比sign
        if ($checkSign != $this->values['sign']) {
            return failed('返回数据检验不通过', 501);
        }

        //对比状态码
        if ($this->values['return_code'] != 'SUCCESS') {
            return failed('通讯失败', 502);
        }
        if ($this->values['result_code'] != 'SUCCESS') {
            return failed('支付失败', 503);
        }

        return success($resultData);
    }

    /**
     * 回复异步通知
     * @param type $flag
     * @param type $msg
     */
    public function replyNotify($flag = true, $msg = 'NO') {
        if ($flag) {
            echo "<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";
        } else {
            echo "<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[{$msg}]]></return_msg></xml>";
        }
        exit;
    }

}