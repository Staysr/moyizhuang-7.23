<?php
/**
 *
 * @author: honor<763569752@qq.com>
 * @day: 2017/11/13
 */

namespace app\admin\model\server;

use traits\ModelTrait;
use basic\ModelBasic;

/**
 * 身份管理 model
 * Class SystemRole
 * @package app\admin\model\system
 */
class ServerUpgradeLog extends ModelBasic
{
    use ModelTrait;

    public static function systemPage($where)
    {
       $model=new self;
        $model = $model->alias('l');
        $model = $model->join('ServerWeb w','l.webid=w.id');
        $model = $model->field('l.*,w.name,w.https,w.ip');
        if($where['webid'] != '') {
            $model = $model->where(array('l.webid|w.name|w.https|w.ip'=>array('like','%'.$where['webid'].'%')));
        }
        $model = $model->order('l.id desc');
        return self::page($model,$where);
    }
//
//    /*
//     *对比ip白名单上的数据
//     * @param string $ip
//     * @return boolean 有效返回true，无效返回false
//     */
//    public static function get_ip_rule($ip){
//
//    }
//    /**
//     * 检查token,return bool
//     *
//     * token : ip+生成时间+过期时间
//     *
//     * @param string $token
//     * @return array | boolean 有效返回true，无效返回false
//     */
//    public static function check_token($data){
//        $token=self::Examine($data,'token');
//        $token=self::deCode($token['token']);
//        $data=explode(self::$seperater,$token);
//        if($data){
////            var_dump($data);
//        }
//    }
//    /**
//     * 获取版本号
//     * @return String
//     */
//    public static function getNowVersion(){
//        return self::order('id desc')->value('version');
//    }
//    /**
//     * 同ip下访问限制获取
//     * @param String $version 版本号
//     * @return Int
//     */
//    public  static function getNum(){
//        $request=Request::instance();
//        return self::where('ip',$request->ip())->whereTime('add_time','today')->value('num');
//    }
//    /**
//     * 获取版本升级所需详细信息
//     * @param String $version 版本号
//     * @return Array
//     */
//    public static function getZipInfo($version){
//        if(empty($version)) return false;
//        return self::where('version',$version)->where('type','update')->field(['content','add_time','zip_name','update_file'])->find()->toArray();
//    }
//    /**
//     * 数据验证
//     * @param Array $data 需要验证的数组
//     * @param String || Array  $field 索引名
//     * @return Array
//     */
//    public static function Examine($data,$field){
//        $request=[];
//        if(is_string($field) && isset($data[$field])){
//            $request[$field]=$data[$field];
//        }else if(is_array($field)){
//            foreach ($field as $val){
//                if(isset($data[$val])){
//                    $request[$val]=$data[$val];
//                }else{
//                    return '';
//                }
//            }
//        }
//        return $request;
//    }
//    /**
//     * 通用解密
//     * @param String $string 需要解密的字串
//     * @param String $skey 解密KEY
//     * @return String
//     */
//    private static function deCode($string = '', $skey = 'fb') {
//        $skey = array_reverse(str_split($skey));
//        $strArr = str_split(str_replace('O0O0O', '=', $string), 2);
//        $strCount = count($strArr);
//        foreach ($skey as $key => $value) {
//            $key < $strCount && $strArr[$key] = rtrim($strArr[$key], $value);
//        }
//        return base64_decode(join('', $strArr));
//    }


}