<?php
/**
 *
 * @author: honor<763569752@qq.com>
 * @day: 2017/11/13
 */

namespace app\admin\model\server;

use traits\ModelTrait;
use basic\ModelBasic;
use app\admin\model\server\ServerWeb;
/**
 * 身份管理 model
 * Class SystemRole
 * @package app\admin\model\system
 */
class ServerVersion extends ModelBasic
{
    use ModelTrait;

    private static $seperater = "{&&}";

    public static function systemPage()
    {
        return self::page(new self);
    }
    /*
     * 对比ip和域名白名单上的数据
     * @param string $ip
     * @return boolean 有效返回true，无效返回false
     */
    public static function get_IpAndHttp_rule($ip,$https){
        if(empty($ip) || empty($https)) return false;
        $https=ServerWeb::isAuth($ip,$https);
        if($https){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 检查token,return bool
     *
     * token : https+ip+生成时间+过期时间
     *
     * @param string $token
     * @return array | boolean 有效返回[https,ip]，无效返回false
     */
    public static function check_token($data,$fun=null){
        $token=self::Examine($data,'token');
        $token=self::deCode($token['token']);
        $data=explode(self::$seperater,$token);
        if($data){
            //验证是否为4个索引
            if(!isset($data[0]) || !isset($data[1]) || !isset($data[2]) || !isset($data[3])) return false;
            //验证是否为的https
            if(!self::pregMatcHttp($data[0])) return false;
            //验证是否为IP
            if(!self::pregMatchIp($data[1])) return false;
            //验证数组长度 和过期时间
            if(count($data)!=5 || (int)$data[3]<time()) return false;
            //验证ip 和 https 是否为白名单
            if(!self::get_IpAndHttp_rule($data[1],$data[0])){
                if($fun!==null && is_callable($fun)){
                    if($fun()) return [$data[0],$data[1]];
                }
                return false;
            }
            return [$data[0],$data[1]];
        }
        return false;
    }
    /*
    *@return Boolen
    *@param String $ip 要匹配的ip地址
    *@param String $pat 匹配的正则规则
    *@param Boolen 匹配成功后返回的布尔值
    *preg_match()
    *0为不成功，1为成功
    */
    public static function pregMatchIp($ip){
        $pat = "/^(((1?\d{1,2})|(2[0-4]\d)|(25[0-5]))\.){3}((1?\d{1,2})|(2[0-4]\d)|(25[0-5]))$/";
        if(preg_match($pat,$ip)){
            $num = preg_match($pat,$ip);
            return $num;
        }else{
            $num = preg_match($pat,$ip);
            return $num;
        }
    }
    /*
    *@return Boolen
    *@param String $http 要匹配的http地址
    *@param Boolen 匹配成功后返回的布尔值
    *preg_match()
    *0为不成功，1为成功
    */
    public static function pregMatcHttp($http){
        $mar='/\b(([\w-]+:\/\/?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/)))/';
        return preg_match($mar,$http) == 1;
    }
    /**
     * 获取版本号
     * @return String
     */
    public static function getNowVersion(){
        return self::order('id desc')->value('version');
    }
    /**
     * 获取版本升级所需详细信息
     * @param String $version 版本号
     * @return Array
     */
    public static function getZipInfo($post){
        if(empty($post)) return false;
        return self::where(['version'=>$post['version'],'id'=>$post['id']])->field(['content','add_time','zip_name'])->find()->toArray();
    }
    /**
     * 数据验证
     * @param Array $data 需要验证的数组
     * @param String || Array  $field 索引名
     * @return Array
     */
    public static function Examine($data,$field){
        $request=[];
        if(is_string($field)){
            $request[$field]=isset($data[$field])?$data[$field]:'';
        }else if(is_array($field)){
            foreach ($field as $val){
                if(isset($data[is_array($val) && isset($val[0])?$val[0]:$val])){
                    $request[is_array($val) && isset($val[0])?$val[0]:$val]=$data[is_array($val) && isset($val[0])?$val[0]:$val];
                }else{
                    $request[is_array($val) && isset($val[0])?$val[0]:$val]=is_array($val) && isset($val[1])?$val[1]:'';
                }
            }
        }
        unset($data,$field,$val);
        return $request;
    }
    /**
     * 通用解密
     * @param String $string 需要解密的字串
     * @param String $skey 解密KEY
     * @return String
     */
    private static function deCode($string = '', $skey = 'fb') {
        $skey = array_reverse(str_split($skey));
        $strArr = str_split(str_replace('O0O0O', '=', $string), 2);
        $strCount = count($strArr);
        foreach ($skey as $key => $value) {
            $key < $strCount && $strArr[$key] = rtrim($strArr[$key], $value);
        }
        return base64_decode(join('', $strArr));
    }


}