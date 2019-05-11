<?php
/**
 * 远程获取数据，POST模式
 * 注意：
 * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
 * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
 * @param $url 指定URL完整路径地址
 * @param $cacert_url 指定当前工作目录绝对路径
 * @param $para 请求的数据
 * @param $input_charset 编码格式。默认值：空值
 * return 远程输出的数据
 */
function getHttpResponsePOST($url, $para, $headers = array(), $cacert_url = '', $input_charset = '') {

    if (trim($input_charset) != '') {
        $url = $url . "_input_charset=" . $input_charset;
    }
    $curl = curl_init($url);
    if ($cacert_url) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true); //SSL证书认证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //严格认证
        curl_setopt($curl, CURLOPT_CAINFO, $cacert_url); //证书地址
    }
    if (empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 显示输出结果
    curl_setopt($curl, CURLOPT_POST, true); // post传输数据
    curl_setopt($curl, CURLOPT_POSTFIELDS, $para); // post传输数据
    $responseText = curl_exec($curl);
    //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);

    return $responseText;
}

/**
 * 远程获取数据，GET模式
 * 注意：
 * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
 * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
 * @param $url 指定URL完整路径地址
 * @param $cacert_url 指定当前工作目录绝对路径
 * return 远程输出的数据
 */
function getHttpResponseGET($url, $headers = array(), $cacert_url = '') {
    $curl = curl_init($url);
    if (!empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 显示输出结果
    if ($cacert_url) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true); //SSL证书认证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //严格认证
        curl_setopt($curl, CURLOPT_CAINFO, $cacert_url); //证书地址
    }

    $responseText = curl_exec($curl);
    //var_dump(curl_error($curl)); //如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);

    return $responseText;
}

//字节数转换成带单位的
/* 原理是利用对数求出欲转换的字节数是1024的几次方。
 * 其实就是利用对数的特性确定单位。
 */
function size2mb($size, $digits = 2) { //digits，要保留几位小数
    $unit = array('', 'K', 'M', 'G', 'T', 'P'); //单位数组，是必须1024进制依次的哦。
    $base = 1024; //对数的基数
    $i = floor(log($size, $base)); //字节数对1024取对数，值向下取整。
    return round($size / pow($base, $i), $digits) . ' ' . $unit[$i] . 'B';
}

/**
 * 按格式错误返回
 * @param type $msg
 * @param type $status
 * @param type $data
 * @return type
 */
function failed($msg = '', $status = 0, $data = array()) {
    return array('msg' => $msg, 'status' => $status, 'data' => $data);
}

/**
 * 按格式成功返回
 * @param type $data
 * @return type
 */
function success($data = array()) {
    return array('msg' => '成功', 'status' => 200, 'data' => $data);
}
/**
 * 获取毫秒级别的时间戳
 */
function getMillisecond() {
//获取毫秒的时间戳
    $time = explode(" ", microtime());
    $time = $time[1] . ($time[0] * 1000);
    $time2 = explode(".", $time);
    $time = $time2[0];
    return $time;
}
/**
 * 产生随机字符串，不长于32位
 * @param int $length
 * @return 产生的随机字符串
 */
function getNonceStr($length = 32) {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

/**
 * 判断一个字符串是不是手机号
 * @param type $num
 * @return type
 */
function isphone($num) {
    return preg_match("/^1[34578]\d{9}$/", $num);
}
