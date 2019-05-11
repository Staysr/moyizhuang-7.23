<?php

namespace addons\kdniao\library;

class Kdniao
{
    protected $config = [];

    public function __construct($options = [])
    {
        if ($config = get_addon_config('kdniao')) {
            $this->config = array_merge($this->config, $config);
        }
        $this->config = array_merge($this->config, is_array($options) ? $options : []);
    }

    /**
     * Json方式 查询订单物流轨迹
     * @param string $shipper
     * @param string $code
     * @return int|string
     */
    public function getOrderTracesByJson($shipper, $code)
    {
        $eBusinessID = $this->config["EBusinessID"];
        $appKey = $this->config["AppKey"];
        $reqURL = $this->config["ReqURL"];

        if (!$eBusinessID || !$appKey || !$reqURL) {
            return -1;
        }

        $requestData = "{'OrderCode':'','ShipperCode':'$shipper','LogisticCode':'$code'}";

        $datas = array(
            'EBusinessID' => $eBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData),
            'DataType'    => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $appKey);
        $result = $this->sendPost($reqURL, $datas);

        //根据公司业务处理返回的信息......

        return $result;
    }

    /**
     * Post提交数据
     * @param  string $url   请求Url
     * @param  array  $datas 提交的数据
     * @return string 响应返回的html
     */
    protected function sendPost($url, $datas)
    {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if (empty($url_info['port'])) {
            $url_info['port'] = 80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader .= "Host:" . $url_info['host'] . "\r\n";
        $httpheader .= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader .= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader .= "Connection:close\r\n\r\n";
        $httpheader .= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets .= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商Sign签名生成
     * @param string 内容
     * @param string Appkey
     * @return string DataSign签名
     */
    protected function encrypt($data, $appkey)
    {
        return urlencode(base64_encode(md5($data . $appkey)));
    }
}
