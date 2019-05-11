<?php

//---------------------------------------------------------
//QQ钱包支付即时到帐支付后台回调示例，商户按照此文档进行开发即可
//---------------------------------------------------------
require_once("./inc.php");
require_once(SYSTEM_ROOT.'qqpay/qpayNotify.class.php');
@header('Content-Type: text/html; charset=UTF-8');

$qpayNotify = new QpayNotify();
$result = $qpayNotify->getParams();
//判断签名
if($qpayNotify->verifySign() && $conf['qqpay_api']==1) {

//判断签名及结果（即时到帐）
	if($result['trade_state'] == "SUCCESS") {
		//商户订单号
		$out_trade_no = daddslashes($result['out_trade_no']);
		//QQ钱包订单号
		$transaction_id = $result['transaction_id'];
		//金额,以分为单位
		$total_fee = $result['total_fee'];
		//币种
		$fee_type = $result['fee_type'];
		
		//------------------------------
		//处理业务开始
		//------------------------------
		$srow=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$out_trade_no}' limit 1 for update");
		
		if($srow['status']==0){
			$DB->query("update `shua_pay` set `status` ='1' where `trade_no`='{$out_trade_no}'");
			if($DB->affected()>=1){
				$DB->query("update `shua_pay` set `endtime` ='$date' where `trade_no`='{$out_trade_no}'");
				processOrder($srow);
			}
		}
		//------------------------------
		//处理业务完毕
		//------------------------------
		echo "<xml>
<return_code>SUCCESS</return_code>
</xml>";
	} else {
		echo "<xml>
<return_code>FAIL</return_code>
</xml>";
	}

} else {
    //回调签名错误
	echo "<xml>
<return_code>FAIL</return_code>
<return_msg>签名失败</return_msg>
</xml>";
}

 

?>