<?php
include('../../system/inc.php');
/* * 
 * 功能：BL云支付页面跳转同步通知页面
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见epay_notify_class.php中的函数verifyReturn
 */

require_once("epay.config.php");
require_once("lib/epay_notify.class.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	//支付方式
	$type = $_GET['type'];


    if($_GET['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
$order = mysql_query('select * from mkcms_user_pay where p_order="'.$out_trade_no.'"');
if($row1 = mysql_fetch_array($order)){
$p_point=$row1['p_point'];//时长
$p_group = $row1['p_group'];//会员组
}
//判定会员组别
$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
if($row = mysql_fetch_array($result)){
$u_group=$row['u_group'];
$send = $row['u_end'];
}
if($send < time()){
$u_end = time()+ 86400*$p_point;
}
else{
$u_end = $send + 86400*$p_point;
}
$_data['u_group'] =$p_group;
$_data['u_end'] =$u_end;
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
$sql1 = 'update mkcms_user_pay set p_status=1 where p_order="'.$out_trade_no.'"';
if (mysql_query($sql1)) {
}
if (mysql_query($sql)) {
alert_href('支付成功!','../mingxi.php');
}


	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>BL云支付即时到账交易接口</title>
	</head>
    <body>
    </body>
</html>
