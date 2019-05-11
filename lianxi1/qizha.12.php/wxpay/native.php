<?php 
require '../conn/conn2.php';
require '../conn/function.php';

$APPID = $C_wx_appid;
$MCHID = $C_wx_mchid;
$KEY = $C_wx_key;
$APPSECRET = $C_wx_appsecret;
	
$NOTIFY_URL = "http://".$C_domain.$C_dir."wxpay/notify_url.php";

$body=$_REQUEST["body"];
$attach=$_REQUEST["attach"];
$total_fee=$_REQUEST["total_fee"]*100;
$product_id=1;
$genkey=gen_key(20);

$sign=strtoupper(MD5("appid=".$APPID."&attach=".$attach."&body=".$body."&mch_id=".$MCHID."&nonce_str=".$genkey."&notify_url=".$NOTIFY_URL."&out_trade_no=".$genkey."&spbill_create_ip=127.0.0.1&total_fee=".$total_fee."&trade_type=NATIVE&key=".$KEY));


$info=getbody("https://api.mch.weixin.qq.com/pay/unifiedorder","<xml><appid>".$APPID."</appid><attach>".$attach."</attach><body>".$body."</body><mch_id>".$MCHID."</mch_id><nonce_str>".$genkey."</nonce_str><notify_url>".$NOTIFY_URL."</notify_url><out_trade_no>".$genkey."</out_trade_no><spbill_create_ip>127.0.0.1</spbill_create_ip><total_fee>".$total_fee."</total_fee><trade_type>NATIVE</trade_type><sign>".$sign."</sign></xml>");

$postObj = simplexml_load_string( $info );

echo $postObj->code_url;
?>