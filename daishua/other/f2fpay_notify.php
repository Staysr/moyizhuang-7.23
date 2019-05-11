<?php
/* *
 * 支付宝当面付异步通知页面
 */

require_once("./inc.php");
require_once(SYSTEM_ROOT."f2fpay/config.php");
require_once(SYSTEM_ROOT."f2fpay/AlipayTradeService.php");

//计算得出通知验证结果
$alipaySevice = new AlipayTradeService($config); 
//$alipaySevice->writeLog(var_export($_POST,true));
$verify_result = $alipaySevice->check($_POST);

if($verify_result && $conf['alipay_api']==3) {//验证成功
	//商户订单号
	$out_trade_no = daddslashes($_POST['out_trade_no']);

	//支付宝交易号
	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];

	//买家支付宝
	$buyer_id = daddslashes($_POST['buyer_id']);

	$srow=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$out_trade_no}' limit 1 for update");

    if ($_POST['trade_status'] == 'TRADE_SUCCESS' && $srow['status']==0) {
		//付款完成后，支付宝系统发送该交易状态通知
		$DB->query("update `shua_pay` set `status` ='1' where `trade_no`='{$out_trade_no}'");
		if($DB->affected()>=1){
			$DB->query("update `shua_pay` set `endtime` ='$date' where `trade_no`='{$out_trade_no}'");
			processOrder($srow);
		}
    }

	echo "success";
}
else {
    //验证失败
    echo "fail";
}
?>