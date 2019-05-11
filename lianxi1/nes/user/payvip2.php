<?php
require dirname(__FILE__) . "/dzsck.php";
include('../inc/aik.config.php'); 
if($_GET['add']=='ddinfo'){
	    $dd_adminid = $_POST["admin_id"];
        $dd_vip = $_POST['dd_vip'];
		$dd_rmb = $_POST['dd_rmb'];
		$dd_paytype = $_POST['dd_paytype'];
		$dd_paynum = $_POST['dd_paynum'];
		$dd_order = $_POST['dd_order'];
		$dd_type = $_POST['dd_type'];
		$nowtime=time();		
$isql="INSERT INTO d_ddcenter(dd_adminid,dd_vip,dd_rmb,dd_paytype,dd_paynum,dd_order,dd_time)VALUES('$dd_adminid','$dd_vip','$dd_rmb','$dd_paytype','$dd_paynum','$dd_order','$nowtime')";

$ddinfo=mysql_query($isql);
 	if ($ddinfo) {
		echo tiao("订单递交成功，正在审核！", "ddcenter.php");
		exit();
	}
	else {
		echo tiao("订单递交失败，请重新递交！", "payvip2.php");
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
	<meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>用户VIP升级</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" type="text/css" href="css/font_1459473269_4751618.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="upload/ssi-uploader.css"  type="text/css"/>
	<link rel="stylesheet" href="css/vip.css"  type="text/css"/>
    <link rel="stylesheet" href="css/ui.css"  type="text/css"/>
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="upload/ssi-uploader.js"></script>
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="css/menu_elastic.css" />
<style type="text/css">
body,td,th {
	font-family: "Microsoft Yahei", "微软雅黑", Arial, "宋体", sans-serif;
}
</style>
<script src="js/snap.svg-min.js"></script>
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body class="huibg">
<div class="divbody">
<nav class="navbar text-center">
   <button class="topleft" onclick ="javascript:history.go(-1);"><span class="iconfont icon-fanhui"></span></button>
  <a class="navbar-tit center-block">开通VIP会员</a>
  <button class="topnav" id="open-button" onclick="window.location.href='index.php'"><span class="iconfont icon-1"></span></button>
</nav>
<ul id="myTab" class="nav nav-tabs" style="margin-top:10px;">
   <li><a href="payvip.php">卡密升级</a></li>
   <li class="active"><a href="payvip2.php">自助开通</a></li>
</ul>
<div class="dingdan">
   <div class="ddlist">
          <form method="post" autocomplete="off" id="queryForm" action="?add=ddinfo" enctype="multipart/form-data" onsubmit="return autoformc();">
            <table class="conTable">
              <tbody id="step1" style="display:;">
                <tr>
                  <th>选择VIP:</th>
                  <td class="mutilLine" id="EventList">
                    <label class="white" title="售价:298元;半年的VIP会员">
                      <input type="radio" name="dd_vip" onclick="CheckEvent(<?php echo $aik['vip_month']?>,'月度VIP',<?php echo $aik['vip_month']?>);" class="moneyRadio" value="1">月度VIP</label>
                    <label class="white" title="售价:398元;1年的VIP会员">
                      <input type="radio" name="dd_vip" onclick="CheckEvent(<?php echo $aik['vip_season']?>,'季度VIP',<?php echo $aik['vip_season']?>);" class="moneyRadio" value="2">季度VIP</label>
                    <label class="white" title="售价:698元;高级VIP">
                      <input type="radio" name="dd_vip" onclick="CheckEvent(<?php echo $aik['vip_year']?>,'年度VIP',<?php echo $aik['vip_year']?>);" class="moneyRadio" value="3">年度VIP</label>
                   </td>
                </tr>
                <tr>
                  <th>应支付:</th>
                  <td>￥
                    <b id="PayMoney">0</b>元
                     <input id="vipgid" name="vipgid" type="hidden" value="0"></td></tr>
                <tr>
                  <th>支付方式:</th>
                  <td>
                    <input id="payway" name="dd_paytype" value="2" type="hidden">
                    <a title="微信扫码支付" style=" text-align:right;" href="javascript:CheckBank(1);" class="qdRadio" id="weixin">
                      <img src="images/weixin.jpg"/>
                    </a>
                    <a title="支付宝转帐支付" style=" text-align:left;" href="javascript:CheckBank(2);" class="qdRadio qdRadioSel" id="alipay">
                     <img src="images/alipay.jpg"/>
                    </a>
                    <a title="QQ(财富通)支付" style="display:none;" href="javascript:CheckBank(3);" class="qdRadio" id="tenpay"></a>
                  </td>
                </tr>
                <tr>
                  <th>支付方法:</th>
                  <td>
                    <span class="span_red" id="pay_account">请使用手机支付宝客户端扫一扫付款。</span></td>
                </tr>
                <tr class="erma">
                  <th></th>
                  <td>
                    <div class="div_erma">
                      <img id="img_erm" src="<?php echo $aik['zfb_ad']?>">
                      <div class="payinfo">
                      <img id="img_gd" src="images/alipay_gd.png">
					  </div>
                    </div>
                    <span>确认支付完成后点击下一步，进入支付信息填写界面。</span>
                  </td>
                </tr>
                <tr>
                  <th></th>
                  <td class="btnBox">
                    <a href="javascript:;" class="paynext span_next" onclick="switchstep(2)">下一步</a>
                  </td>
                </tr>
              </tbody>
              <tbody id="step2" style="display: none;">
                <tr>
                  <th>支付信息</th>
                  <td>
                    <span class="span_blue">确认已经支付成功后，请务必在下面输入相关支付信息，用于管理员核对支付到帐信息。</span></td>
                </tr>
                <tr>
                  <th>选择VIP</th>
                  <td>
                    <input class="inputTxt account" id="creditnum" name="creditnum" type="text" value="0" readonly></td>
                </tr>
                <tr>
                  <th>
                    <span class="span_blue" id="span_pay">支付宝支付</span></th>
                  <td>
                    <input class="inputTxt account" id="paynum" name="dd_rmb" type="text" value="0" readonly>
                    <span>元</span></td>
                </tr>
                <tr>
                  <th>付款帐号</th>
                  <td>
                    <input class="inputTxt account" id="payaccount" name="dd_paynum" type="text" onblur="autoformc()">
                    <span id="ckeckccount">(必填)你转账的支付宝账号。</span></td>
                </tr>
                <tr>
                  <th>交易单号</th>
                  <td>
                    <input class="inputTxt account" id="payorder" name="dd_order" type="text">
                    <span id="UserId2MsgDiv">(必填)填写支付宝订单号。</span></td>
                </tr>
                <tr>
                  <th></th>
				   <input  name="admin_id" type="hidden" value="<?=$_SESSION["adminid"]?>">
                  <td class="btnBox">
                    <a href="javascript:;" class="paynext span_next" onclick="switchstep(1)">上一步</a>
                    <button class="paynext" type="submit" name="advsubmit" id="advsubmit" value="true">提交信息</button>
                    <span>请确认信息填写正确，提交后请耐心等待管理员审核。</span></td>
                </tr>
              </tbody>
            </table>
          </form>
	 <div class="ddlist">
	 <div class="dtit">VIP赞助标准</div>
      <div class="dz"><p class="ziku">月度VIP：</p><strong><?php echo $aik['vip_month']?></strong> 元/月</div>
      <div class="dz"><p class="ziku">季度VIP：</p><strong><?php echo $aik['vip_season']?></strong> 元/季</div>
	  <div class="dz"><p class="ziku">年度VIP：</p><strong><?php echo $aik['vip_year']?></strong> 元/年</div>
      <div class="dz noblord"><p class="ziku">开通会员后，无限畅想看各大vip电影哦！</span><br/><font style="color:#F00"></div>
   </div>
   </div>
</div>
<div class="footnav">
 <div class="footer">
 <div class="col-xs-3 text-center" style="width:50%"><a href="index.php" style="color:#FF7831"><i class="iconfont icon-yonghu"></i><p>用户中心</p></a></div>
 <div class="col-xs-3 text-center" style="width:50%"><a  onclick="window.location.href='/index.php'"><i class="iconfont icon-home"></i><p>返回首页</p></a></div>
 </div>
</div>
</div>
<script type="text/javascript">
function postcheck(){
	if (document.chxform.kami.value==""){
	    alert('亲，请输入购买的卡密号进行升级？');
		document.chxform.kami.focus();
		return false;
	}
	document.chxform.submit();
	return true;	
}
</script> 
<script type="text/javascript">
        var bili = 2;
        function creditpay() {
          var gid = parseInt(document.getElementById("vipgid").value);
          if (gid) {
            showWindow('paybox', '');
          } else {
            alert('请先选择您要开通的VIP用户组。');
          }
        }
        function CheckEvent(obj, vipname, gid) {
          document.getElementById("PayMoney").innerHTML = obj;
          document.getElementById("creditnum").value = vipname;
          document.getElementById("paynum").value = obj;
          document.getElementById("vipgid").value = gid;
        }
        function CheckBank(way) {
          var obj = '';
          var paycount = '';
          var spanpay = '';
          var paysrc = '';
          var ckeckccount = '';
          var useriddiv = '';
          if (way == 1) {
            obj = 'weixin';
            paycount = '请使用手机微信客户端扫一扫付款。';
            spanpay = '微信支付';
            paysrc = '<?php echo $aik['wx_ad']?>';
            ckeckccount = '(必填)你转账的微信号。';
            useriddiv = '(必填)填写微信转账单号。';
          } else if (way == 3) {
            obj = 'tenpay';
            paycount = '请转帐至:361366875,建议使用手机QQ钱包扫一扫付款。';
            spanpay = 'QQ支付';
            paysrc = 'images/tenpay_erm.jpg';
          } else if (way == 4) {
            obj = 'credit';
            paycount = '您选择的是积分支付，在弹出框内完成支付。(2=1元)';
            spanpay = '支付';
            paysrc = 'images/credit_erm.jpg';
          } else {
            obj = 'alipay';
            paycount = '请使用手机支付宝客户端扫一扫付款。';
            spanpay = '支付宝支付';
            paysrc = '<?php echo $aik['zfb_ad']?>';
            ckeckccount = '(必填)你转账的支付宝账号。';
            useriddiv = '(必填)填写支付宝订单号。';
          }
          document.getElementById("payway").value = way;
          document.getElementById("pay_account").innerHTML = paycount;
          document.getElementById("ckeckccount").innerHTML = ckeckccount;
          document.getElementById("UserId2MsgDiv").innerHTML = useriddiv;
          document.getElementById("img_gd").src = 'images/' + obj + '_gd.png';
          document.getElementById("img_erm").src = paysrc;
          document.getElementById("span_pay").innerHTML = spanpay;
          document.getElementById("weixin").className = 'qdRadio';
          document.getElementById("alipay").className = 'qdRadio';
          document.getElementById("tenpay").className = 'qdRadio';
          document.getElementById(obj).className = 'qdRadio qdRadioSel';
        }
        function switchstep(obj) {
          var payway = parseInt(document.getElementById("payway").value);
          var vipgid = parseInt(document.getElementById("vipgid").value);
          if (payway == 4) {
            alert('您选择的是积分支付，在弹出框内完成支付。');
          } else if (!vipgid) {
            alert('请先选择您要开通的VIP用户组。');
          } else {
            document.getElementById("step1").style.display = 'none';
            document.getElementById("step2").style.display = 'none';
            document.getElementById("step" + obj).style.display = '';
          }
        }
</script>

</body>
</html>