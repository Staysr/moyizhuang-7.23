<?php
/**
 * Created by PhpStorm.
 * User: liuzn
 * Date: 2018/7/15/015
 * Time: 11:59
 */

namespace Common\Controller;

use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class AppletsController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->host = "";

    }


    /**
     * 生成数组
     * @param Mixed $aData  返回数据
     * @param Mixed $sInfo  提示
     * @param int $iStatus  状态码
     */
    public function arrReturn($aData, $sInfo = "", $iStatus = 200, $oEncrypt = true)
    {
//     $sInfo = $sInfo ? $sInfo : getCodeMsg($iStatus);
        $aResult = array("data" => $aData, "info" => $sInfo, "status" => $iStatus);
        $this->jsonReturn($aResult, $oEncrypt);
        exit;
    }

    /**
     * 生成json格式加密返回
     * @param $aParam
     * @param $oEncrypt  是否加密
     */
    public function jsonReturn($aParam, $oEncrypt) {
        if ($oEncrypt) {
            echo $this->encrypt(json_encode($aParam));
        } else {
            echo json_encode($aParam);
        }

        exit;
    }


    /**
     * 加密
     * @param type $param
     * @return type
     */
    public function encrypt($param = array()) {
        $model = new \Common\Model\AnalyzerModel();
        if (is_array($param)) {
            $str = $model->encrypt(json_encode($param));
        } else {
            $str = $model->encrypt($param);
        }
        return $str;
    }

    /**
     * 解密
     * @param array $param
     * @return array|bool|string
     */

    public function decrypt($param = array()){
        $model = new \Common\Model\AnalyzerModel();
        $result = json_decode($model->decrypt($param),true);
        if (empty($result)) {
            return array('status' => 0, 'info' => '请求失败');
        }
        return $result;
    }

    /**
     * 获取GET值
     * @param type $sKey
     * @param type $default
     * @return type
     */
    public function getGet($sKey = "", $default = '') {
        $sValue = $default;
        if (isset($_GET[$sKey])) {
            $sValue = $_GET[$sKey];
        } else if (empty($sKey)) {
            $sValue = $_GET;
        }
        return $sValue;
    }

    /**
     * 获得POST的内容
     * @param String $sKey
     * @return String
     */
    public function getPost($sKey = "", $default = '') {
        $sValue = $default;
        if (isset($_POST[$sKey])) {
            $sValue = $_POST[$sKey];
        } else if (empty($sKey)) {
            $sValue = $_POST;
        }
        return $sValue;
    }

    /**
     * 地址加域名
     * @param $arr 数组
     * @param $name 字段
     */
    public function pic_host($arr,$name,$name_1){
        if(!$arr)return false;
        if (count($arr) == count($arr, 1)) { //一维数组
            $arr[$name] = $this->host . $arr[$name];
            isset($name_1)?$arr[$name_1] = $this->host . $arr[$name_1] : '';
        } else {
           foreach ($arr as $key=>$item){
               $arr[$key][$name] =  $this->host . $arr[$key][$name];
               $arr[$key][$name_1] =  $this->host . $arr[$key][$name_1];
           }
        }
        return $arr;
    }
    /*
     * 返回逗号隔开的字符串
     */
    public function inString($arr,$name){
        $new_arr = '';
        foreach ($arr as $item){
            $new_arr .= $item[$name].',';
        }
        $new_arr = rtrim($new_arr,',');
        return $new_arr;
    }

}
