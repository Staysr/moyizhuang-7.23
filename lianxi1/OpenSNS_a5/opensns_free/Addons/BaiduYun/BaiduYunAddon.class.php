<?php

namespace Addons\BaiduYun;

use Common\Controller\Addon;

class BaiduYunAddon extends Addon
{
    public $info = array(
        'name' => 'BaiduYun',
        'title' => '百度云短信',
        'description' => '百度云短信插件',
        'status' => 1,
        'author' => '王东旭',
        'version' => '0.1'
    );

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

    /**
     * sms  短信钩子，必需，用于确定插件是短信服务
     * @return bool
     * @author 路飞<lf@ourstu.com>
     */
    public function sms()
    {
        return true;
    }


    public function sendSms($mobile, $content)
    {
        $config = get_addon_config('BaiduYun');
        $data['corp_id'] = $config['corp_id'];
        $data['corp_pwd'] = $config['corp_pwd'];
        $data['corp_service'] = $config['corp_service'];
        $data['mobile'] = $mobile;
        $data['msg_content'] = $content;
        $url = "http://180.76.103.54:8080/sms_send2.do";

        $res = $this->post($url, $data);
        return $res;
    }

    private function post($url, $data, $proxy = null, $timeout = 20)
    {
        header('content-type:text/html;charset=utf-8');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);  //在HTTP请求中包含一个"User-Agent: "头的字符串。
        curl_setopt($curl, CURLOPT_HEADER, 0);                        //启用时会将头文件的信息作为数据流输出。
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type:application/x-www-form-urlencoded;charset=utf-8')); //更改header头信息
        curl_setopt($curl, CURLOPT_POST, true);                       //发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));     //Post提交的数据包
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);                //启用时会将服务器服务器返回的"Location: "放在header中递归的返回给服务器，使用CURLOPT_MAXREDIRS可以限定递归返回的数量。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);            //文件流形式
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);                      //设置cURL允许执行的最长秒数。
        $content = curl_exec($curl);
        curl_close($curl);
        unset($curl);
        if ($content == '0#1') {
            return true;
        } else {
            return "发送失败! 状态码：" . $content . ' ' . $this->getCode($content);
        }
    }

    private function getCode($content)
    {
        switch ($content) {
            case 100:
                return '余额不足';
            case 101:
                return '账号关闭';
            case 102:
                return '短信内容超过1000字（包括1000字）或为空';
            case 103:
                return '手机号码超过200个或合法手机号码为空或者与通道类型不匹配';
            case 104:
                return 'corp_msg_id超过50个字符或没有传corp_msg_id字段';
            case 106:
                return '用户名不存在';
            case 107:
                return '密码错误';
            case 108:
                return '指定访问ip错误';
            case 109:
                return '业务代码不存在或者通道关闭';
            case 110:
                return '扩展号不合法';
            case 9 :
                return '访问地址不存在';
            default :
                return '未知错误';
        }
    }


}