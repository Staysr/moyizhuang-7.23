<?php

/**

 * [Laike System] Copyright (c) 2018 laiketui.com

 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.

 */
require_once(MO_LIB_DIR . '/DBAction.class.php');

class testAction extends Action {

	public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();

        $now = time();
        $ktsql = "select ptcode,uid from lkt_group_open where UNIX_TIMESTAMP(endtime) < $now and ptstatus=1";
        $ktres = $db -> select($ktsql);
        
        $config = $db -> select('select * from lkt_group_config');
        if(!empty($config)) $config = $config[0] -> refunmoney;

        if(!empty($ktres)){
            foreach ($ktres as $k => $v) {
                $ordersql = "select m.*,u.wx_id as uid from (select o.id,o.user_id,o.ptcode,o.sNo,o.z_price,o.add_time,o.pay,o.trade_no,d.p_name,d.p_price from lkt_order as o left join lkt_order_details as d on o.sNo=d.r_sNo where o.ptcode='$v->ptcode') as m left join lkt_user as u on m.user_id=u.user_id";
                $orderres = $db -> select($ordersql); 
                
                $fromarr = array();
                if($orderres){
                    foreach ($orderres as $key => $value) {
                        $fromidres = $this->get_fromid($value->uid);
                        $fromarr[0]=(object)$fromidres;

                        if($config == 1){
                            $refund = $ordernum = date('Ymd').mt_rand(10000,99999).substr(time(),5);
                            if($value -> pay == 'wallet_Pay'){
                                $oldmoney = $db -> select("select money from lkt_user where user_id='$value->user_id'");
                                $oldmoney = $oldmoney[0] -> money;
                                $sql = "update lkt_user set money=money+$value->z_price where user_id='$value->user_id'";
                                $res = $db -> update($sql);
                                $date = date('Y-m-d H:i:s');
                                $recordsql = "insert into lkt_record(user_id,money,oldmoney,add_date,event,type) values('$value->user_id',$value->z_price,$oldmoney,'$date','".$value->user_id."拼团失败退款',5)";
                                $db -> insert($recordsql);


                                $fromres1 = $this->get_fromid($value->uid);
                                $fromid = $fromres1['fromid'];
                                $sql = "select * from lkt_notice where id = '1'";
                                $r = $db->select($sql);
                                if($r){
                                    $template_id = $r[0]->refund_success;
                                }else{
                                    $template_id = '';
                                }
                                $this -> Send_fail($value -> uid,$fromid,$value -> sNo,$value -> p_name,$value -> z_price,
                                    $template_id,'pages/user/user');
                                if($fromid == $fromidres['fromid']){
                                    $fromidres = $this->get_fromid($value->uid,$fromid);
                                    $fromarr[0]=(object)$fromidres;
                                }

                            }else if($value -> pay == 'wxPay'){
                                $price = $value -> z_price*100;
                                $res = $this -> wxrefundapi($value -> trade_no,$refund,$price);
                            }

                            if($res > 0 || ($res['return_code'] == 'SUCCESS' && $res['result_code'] == 'SUCCESS')){
                                $modifysql = "update lkt_order set ptstatus=3,status=11,refundsNo='$refund' where sNo='$value->sNo'";
                                $modres = $db -> update($modifysql);
                            }
                        }
                    }
                    foreach ($orderres as $ke => $va) {
                        if($va -> uid != $fromarr[0]->fromid){
                            $fromidres = $this->get_fromid($va -> uid);
                            $fromarr[0]=(object)$fromidres;
                        }

                        foreach ($fromarr as $key => $val) {
                            if($val -> openid == $va -> uid){
                                $orderres[$ke] -> fromid = $val -> fromid;
                            }
                        }
                    }
                }



                $sql = "select * from lkt_notice where id = '1'";
                $r = $db->select($sql);
                if($r){
                    $template_id = $r[0]->group_fail;
                }else{
                    $template_id = 0;
                }
                $this -> Send_success($orderres,$template_id);
                $uptsql = "update lkt_group_open set ptstatus=3 where ptcode='$v->ptcode'";
                $uptres = $db -> update($uptsql);
                if($config == 2){
                    $db -> update("update lkt_order set ptstatus=3,status=10 where ptcode='$v->ptcode'");
                }
            }        

        }
        $delsql = "delete from lkt_user_fromid where UNIX_TIMESTAMP(lifetime) < '$now'";
        $delres = $db -> delete($delsql);
        
        //十二宫格抽奖处理过期代码
        $sql2 = "select * from lkt_twelve_draw_config where 1=1 ";
        $r2 = $db->select($sql2);
        if($r2){
            $arr = unserialize($r2[0]->sets);
        }else{
            $arr = [];
        }
        
        $endsql = "update lkt_group_buy set is_show=0 where is_show=1 and endtime<='$now'";    //结束已经到期的拼团活动
        $db -> update($endsql);
        $time = $arr['invalid'];
        if($time){
            $date = date('Y-m-d H:i:s', strtotime("-$time days"));
            $sql = "update lkt_twelve_draw_order set status='4' where id in(select a.id from(select id from lkt_twelve_draw_order where addtime < '$date' and status = '2')as a)";
            $res = $db -> update($sql);
        }
        
    }

    public function Send_fail($uid,$fromid,$sNo,$p_name,$price,$template_id,$page){
            $db = DBAction::getInstance();
            $request = $this->getContext()->getRequest();
            $sql = "select * from lkt_config where id=1";
            $r = $db->select($sql);
            if($r){
                $appid = $r[0]->appid; // 小程序唯一标识
                $appsecret = $r[0]->appsecret; // 小程序的 app secret
                $AccessToken = $this->getAccessToken($appid, $appsecret);
                $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$AccessToken;
                        
            }  
            
                $data = array();
                $data['access_token'] = $AccessToken;
                $data['touser'] = $uid;
                $data['template_id'] = $template_id;
                $data['form_id'] = $fromid;
                $data['page'] = $page;
                $price = $price.'元';
                $minidata = array('keyword1' => array('value' => $sNo,'color' => "#173177"),'keyword2' => array('value' => $p_name,'color' => "#173177"),'keyword3' => array('value' => $price,'color' => "#173177"),'keyword4' => array('value' => '退回到钱包','color' => "#FF4500"),'keyword5' => array('value' => '拼团失败--退款','color' => "#FF4500"));
                $data['data'] = $minidata;
                
                $data = json_encode($data);
                
                $da = $this->httpsRequest($url,$data);
                $delsql = "delete from lkt_user_fromid where open_id='$uid' and fromid='$fromid'";  
                $db -> delete($delsql);             
                var_dump(json_encode($da));  
    }

  /*
   * 发送请求
   @param $ordersNo string 订单号　
   @param $refund string 退款单号
   @param $price float 退款金额
   return array
   */
  private function wxrefundapi($ordersNo, $refund, $total_fee, $price) {
    //通过微信api进行退款流程
    $db = DBAction::getInstance();
    $sql = "select * from lkt_config where id=1";
    $r = $db -> select($sql);
    if ($r) {
      $appid = $r[0]->appid;
      // 小程序唯一标识
      $appsecret = $r[0]->appsecret;
      // 小程序的 app secret
      $company = $r[0] ->company;
      $mch_key = $r[0]->mch_key; // 商户key
      $mch_id = $r[0]->mch_id; // 商户mch_id
    }

    $parma = array('appid' => $appid, 'mch_id' => $mch_id, 'nonce_str' => $this -> createNoncestr(), 'out_refund_no' => $refund, 'out_trade_no' => $ordersNo, 'total_fee' => $total_fee, 'refund_fee' => $price, 'op_user_id' =>  $appid);
    $parma['sign'] = $this -> getSign($parma,$mch_key);
    $xmldata = $this -> arrayToXml($parma);
    $xmlresult = $this -> postXmlSSLCurl($xmldata, 'https://api.mch.weixin.qq.com/secapi/pay/refund');
    $result = $this -> xmlToArray($xmlresult);
    return $result;
  }

  /*
   * 生成随机字符串方法
   */
  protected function createNoncestr($length = 32) {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  /*
   * 对要发送到微信统一下单接口的数据进行签名
   */
  protected function getSign($Obj,$mch_key) {
    foreach ($Obj as $k => $v) {
      $Parameters[$k] = $v;
    }
    //签名步骤一：按字典序排序参数
    ksort($Parameters);
    $String = $this -> formatBizQueryParaMap($Parameters, false);
    //签名步骤二：在string后加入KEY
    $String = $String . "&key=".$mch_key;
    //签名步骤三：MD5加密
    $String = md5($String);
    //签名步骤四：所有字符转为大写
    $result_ = strtoupper($String);
    return $result_;
  }

  /*
   *排序并格式化参数方法，签名时需要使用
   */
  protected function formatBizQueryParaMap($paraMap, $urlencode){
    $buff = "";
    ksort($paraMap);
    foreach ($paraMap as $k => $v){
      if($urlencode){
        $v = urlencode($v);
      }
      //$buff .= strtolower($k) . "=" . $v . "&";
      $buff .= $k . "=" . $v . "&";
    }
    $reqPar;
    if (strlen($buff) > 0){
      $reqPar = substr($buff, 0, strlen($buff)-1);
    }
    return $reqPar;
  }

  //数组转字符串方法
  protected function arrayToXml($arr){
    $xml = "<xml>";
    foreach ($arr as $key=>$val)
    {
      if (is_numeric($val)){
        $xml.="<".$key.">".$val."</".$key.">";
      }else{
         $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
      }
    }
    $xml.="</xml>";
    return $xml;
  }

  protected function xmlToArray($xml){
    $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $array_data;
  }

  //需要使用证书的请求
   private function postXmlSSLCurl($xml,$url,$second=30){
      $ch = curl_init();
      //超时时间
      curl_setopt($ch,CURLOPT_TIMEOUT,$second);
      //这里设置代理，如果有的话
      //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
      //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
      curl_setopt($ch,CURLOPT_URL, $url);
      curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
      curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
      //设置header
      curl_setopt($ch,CURLOPT_HEADER,FALSE);
      //要求结果为字符串且输出到屏幕上
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
      //设置证书
      //使用证书：cert 与 key 分别属于两个.pem文件
      //默认格式为PEM，可以注释
      $cert = str_replace('lib','filter',MO_LIB_DIR).'/apiclient_cert.pem';
      $key = str_replace('lib','filter',MO_LIB_DIR).'/apiclient_key.pem';
      curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
      curl_setopt($ch,CURLOPT_SSLCERT, $cert);
      //默认格式为PEM，可以注释
      curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
      curl_setopt($ch,CURLOPT_SSLKEY, $key);
      //post提交方式
      curl_setopt($ch,CURLOPT_POST, true);
      curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);
      $data = curl_exec($ch);
      //返回结果
      if($data){
        curl_close($ch);
        return $data;
      }
      else {
        $error = curl_errno($ch);
        echo "curl出错，错误码:$error"."<br>";
        curl_close($ch);
        return false;
      }
    }

    public function Send_success($arr,$template_id)
    {
            $db = DBAction::getInstance();
            $request = $this->getContext()->getRequest();
            $sql = "select * from lkt_config where id=1";
            $r = $db->select($sql);
            if($r){
                $appid = $r[0]->appid; // 小程序唯一标识
                $appsecret = $r[0]->appsecret; // 小程序的 app secret

                $AccessToken = $this->getAccessToken($appid, $appsecret);
                $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$AccessToken;
                        
            }  
            foreach ($arr as $k => $v) {
                $data = array();
                $data['access_token'] = $AccessToken;
                $data['touser'] = $v -> uid;
                $data['template_id'] = $template_id;
                $data['form_id'] = $v -> fromid;
                $data['page'] = "pages/order/detail?orderId=$v->id";
                $p_price = $v -> p_price.'元';
                $z_price = $v -> z_price.'元';
                $minidata = array('keyword1' => array('value' => $v -> p_name,'color' => "#173177"),'keyword2' => array('value' => $p_price,'color' => "#173177"),'keyword3' => array('value' => $z_price,'color' => "#173177"),'keyword4' => array('value' => $v -> sNo,'color' => "#173177"),'keyword5' => array('value' => '拼团失败','color' => "#FF4500"),'keyword6' => array('value' => $v -> add_time,'color' => "#173177"));
                $data['data'] = $minidata;
                
                $data = json_encode($data);
                
                $da = $this->httpsRequest($url,$data);
                $delsql = "delete from lkt_user_fromid where open_id='$v->uid' and fromid='$v->fromid'";
                $re2 = $db -> delete($delsql);

                var_dump(json_encode($da));
                          
            }
                      
    }

    public function get_fromid($openid,$type = '')
    {           
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		if(empty($type)){
				$fromidsql = "select fromid,open_id from lkt_user_fromid where open_id='$openid' and id=(select max(id) from lkt_user_fromid where open_id='$openid')";
				$fromidres = $db -> select($fromidsql);
				if($fromidres){
					$fromid = $fromidres[0] ->fromid;
					$arrayName = array('openid' => $openid,'fromid' =>$fromid);
					return $arrayName;
				}else{
					return array('openid' => $openid,'fromid' =>'123456');
				}
		}else{
			    $delsql = "delete from lkt_user_fromid where open_id='$openid' and fromid='$type'";
                $re2 = $db -> delete($delsql);
                $fromidsql = "select fromid,open_id from lkt_user_fromid where open_id='$openid' and id=(select max(id) from lkt_user_fromid where open_id='$openid')";
				$fromidres = $db -> select($fromidsql);
				if($fromidres){
					$fromid = $fromidres[0] ->fromid;
					$arrayName = array('openid' => $openid,'fromid' =>$fromid);
					return $arrayName;
				}else{
					return array('openid' => $openid,'fromid' =>'123456');
				}

		}

    }

    function httpsRequest($url, $data=null) {
        // 1.初始化会话
        $ch = curl_init();
        // 2.设置参数: url + header + 选项
        // 设置请求的url
        curl_setopt($ch, CURLOPT_URL, $url);
        // 保证返回成功的结果是服务器的结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(!empty($data)) {
            // 发送post请求
            curl_setopt($ch, CURLOPT_POST, 1);
            // 设置发送post请求参数数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        // 3.执行会话; $result是微信服务器返回的JSON字符串
        $result = curl_exec($ch);
        // 4.关闭会话
        curl_close($ch);
        return $result;
    }

    function getAccessToken($appID, $appSerect) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appID."&secret=".$appSerect;
            // 时效性7200秒实现
            // 1.当前时间戳
            $currentTime = time();
            // 2.修改文件时间
            $fileName = "accessToken"; // 文件名
            if(is_file($fileName)) {
                $modifyTime = filemtime($fileName);
                if(($currentTime - $modifyTime) < 7200) {
                    // 可用, 直接读取文件的内容
                    $accessToken = file_get_contents($fileName);
                    return $accessToken;
                }
            }
            // 重新发送请求
            $result = $this-> httpsRequest($url);
            $jsonArray = json_decode($result, true);
            // 写入文件
            $accessToken = $jsonArray['access_token'];
            file_put_contents($fileName, $accessToken);
            return $accessToken;
    }

    public function execute(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        
        return;
    }

	public function getRequestMethods(){
		return Request :: POST;
	}
}

?>