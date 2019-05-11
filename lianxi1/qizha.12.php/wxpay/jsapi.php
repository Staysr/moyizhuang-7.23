<?php
require '../conn/conn2.php';
require '../conn/function.php';


$O_id=$_REQUEST["O_id"];
$fee=$_REQUEST["fee"];


$APPID = $C_wx_appid;
$MCHID = $C_wx_mchid;
$KEY = $C_wx_key;
$APPSECRET = $C_wx_appsecret;
	
$NOTIFY_URL = "http://".$C_domain.$C_dir."wxpay/notify_url.php";

$body=1;
$attach=$O_id;
$total_fee=$fee*100;
$product_id=1;
$genkey=gen_key(20);


$Code = $_GET["code"];
$info=getbody("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$APPID."&secret=".$APPSECRET."&code=".$Code."&grant_type=authorization_code","");


$openid=json_decode($info)->openid;


$sign=strtoupper(MD5("appid=".$APPID."&attach=".$attach."&body=".$body."&mch_id=".$MCHID."&nonce_str=".$genkey."&notify_url=".$NOTIFY_URL."&openid=".$openid."&out_trade_no=".$genkey."&spbill_create_ip=127.0.0.1&total_fee=".$total_fee."&trade_type=JSAPI&key=".$KEY));

$info=getbody("https://api.mch.weixin.qq.com/pay/unifiedorder","<xml><appid>".$APPID."</appid><attach>".$attach."</attach><body>".$body."</body><mch_id>".$MCHID."</mch_id><nonce_str>".$genkey."</nonce_str><notify_url>".$NOTIFY_URL."</notify_url><openid>".$openid."</openid><out_trade_no>".$genkey."</out_trade_no><spbill_create_ip>127.0.0.1</spbill_create_ip><total_fee>".$total_fee."</total_fee><trade_type>JSAPI</trade_type><sign>".$sign."</sign></xml>");

$postObj = simplexml_load_string($info);

$prepay_id=$postObj->prepay_id;

$timeStamp=time();
$nonceStr=gen_key(20);
$signType="MD5";

$paySign=strtoupper(MD5("appId=".$APPID."&nonceStr=".$nonceStr."&package=prepay_id=".$prepay_id."&signType=MD5&timeStamp=".$timeStamp."&key=".$KEY));

$jsApiParameters='{"appId":"'.$APPID.'","timeStamp":"'.$timeStamp.'","nonceStr":"'.$nonceStr.'","package":"prepay_id='.$prepay_id.'","signType":"MD5","paySign":"'.$paySign.'"}';

Header("Location: ../member/".$_REQUEST["page"]."?jsApiParameters=".$jsApiParameters."&O_id=".$O_id."&money=".$fee)
?>