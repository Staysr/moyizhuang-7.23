<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/17 0017
 * Time: 上午 12:46
 */
class Xml extends Api {
    public function response($code, $message = '', $data = array()) {
        if(!is_numeric($code)) {
            return '';
        }
        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        header('Content-Type:text/xml');
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<root>";
        $xml .= self::xmlToEncode($result);
        $xml .= "</root>";
        echo $xml;
    }
    public static  function xmlToEncode($result) {
        $xml = $attr = '';
        foreach($result as $key => $value) {
            //判断键值对，如果是数字键值不允许
            if(is_numeric($key)) {
                $attr = " id='" . $key . "'";
                $key = "item";
            }
            $xml .= "<{$key}{$attr}>";
            //以递归形式返回，主要是因为数组在xml中显示是array，必须显示出来具体键值对
            $xml .= is_array($value) ? self::xmlToEncode($value) : $value;
            $xml .= "</{$key}>\n";
        }
        return $xml;
    }
}
?>