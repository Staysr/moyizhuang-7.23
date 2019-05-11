<?php
/* * 
 * 码支付同步通知页面
 */

require_once("./inc.php");
require_once(SYSTEM_ROOT."codepay/codepay_config.php");
ksort($_GET); //排序get参数
reset($_GET); //内部指针指向数组中的第一个元素
$sign = '';
foreach ($_GET AS $key => $val) {
    if ($val == '') continue;
    if ($key != 'sign') {
        if ($sign != '') {
            $sign .= "&";
            $urls .= "&";
        }
        $sign .= "$key=$val"; //拼接为url参数形式
        $urls .= "$key=" . urlencode($val); //拼接为url参数形式
    }
}
if ($conf['alipay_api']!=5 && $conf['qqpay_api']!=5 && $conf['wxpay_api']!=5) {
	exit('fail');
} elseif (!$_GET['pay_no'] || md5($sign . $codepay_config['key']) != $_GET['sign']) { //不合法的数据 KEY密钥为你的密钥
    showalert('验证失败！',4);
} else { //合法的数据
    $out_trade_no = daddslashes($_GET['param']);
    //支付宝交易号
    $trade_no = daddslashes($_GET['pay_no']);

    $srow=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$out_trade_no}' limit 1 for update");
    if($srow['status']==0){
        $DB->query("update `shua_pay` set `status` ='1' where `trade_no`='{$out_trade_no}'");
		if($DB->affected()>=1){
			$DB->query("update `shua_pay` set `endtime` ='$date' where `trade_no`='{$out_trade_no}'");
			processOrder($srow);
		}
        showalert('您所购买的商品已付款成功，感谢购买！',1,$out_trade_no,$srow['tid']);
    }else{
		$DB->query("update `shua_pay` set `endtime` ='$date' where `trade_no`='{$out_trade_no}'");
        showalert('您所购买的商品已付款成功，感谢购买！',1,$out_trade_no,$srow['tid']);
    }
}
?>