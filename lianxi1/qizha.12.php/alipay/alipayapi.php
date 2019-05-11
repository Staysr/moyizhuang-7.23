<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>支付宝即时到账交易接口接口</title>
</head>
<?php
/* *
 * 功能：即时到账交易接口接入页
 * 版本：3.4
 * 修改日期：2016-03*08
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************注意*****************
 
 *如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 *1、开发文档中心（https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.KvddfJ&treeId=62&articleId=103740&docType=1）
 *2、商户帮助中心（https://cshall.alipay.com/enterprise/help_detail.htm?help_id=473888）
 *3、支持中心（https://support.open.alipay.com/alipay/support/index.htm）

 *如果想使用扩展功能,请按文档要求,自行添加到parameter数组即可。
 **********************************************
 */
require_once("../conn/conn2.php");
require_once("../conn/function.php");
require_once("alipay.config.php");
require_once("lib/alipay_submit.class.php");


$O_ids=trim($_REQUEST["O_id"]);
$O_id=explode(",",$O_ids);
for ($i=0 ;$i< count($O_id);$i++){
$sql="select * from SL_orders,SL_product,SL_member,SL_lv where M_lv=L_id and O_pid=P_id and O_member=M_id and O_id=".$O_id[$i];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if(mysqli_num_rows($result) > 0) {
$P_title=$row["P_title"];
$O_all=$row["O_price"]*$row["O_num"]*$row["L_discount"]*0.01;
}
$money=$money+$O_all;
if($i==0){
if(count($O_id)>1){
$P_title1=lang($P_title)."等".count($O_id)."件商品";
}else{
$P_title1=lang($P_title);
}
}
}

if ($O_ids!="" ){

$out_trade_no = date("YmdHis");

$subject = $P_title1;

$total_fee = $money;

$body = $O_ids;

}else{

$out_trade_no = date("YmdHis");

$subject = "用户充值".$_REQUEST["fee"]."元";

$total_fee = $_REQUEST["fee"];

$body = $_REQUEST["M_id"]."|".$_REQUEST["fee"];

}


//构造要请求的参数数组，无需改动
$parameter = array(
		"service"       => $alipay_config['service'],
		"partner"       => $alipay_config['partner'],
		"seller_id"  => $alipay_config['seller_id'],
		"payment_type"	=> $alipay_config['payment_type'],
		"notify_url"	=> $alipay_config['notify_url'],
		"return_url"	=> $alipay_config['return_url'],
		
		"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
		"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
		"out_trade_no"	=> $out_trade_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
        //如"参数名"=>"参数值"
		
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;

?>
</body>
</html>