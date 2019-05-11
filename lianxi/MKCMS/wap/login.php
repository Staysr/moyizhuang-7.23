<?php include('../system/inc.php');
$op=$_GET['op'];

if(isset($_POST['submit'])){
	null_back($_POST['u_name'],'请输入用户名');
	null_back($_POST['u_password'],'请输入密码');
	$u_name = $_POST['u_name'];
	$u_password = $_POST['u_password'];
	$sql = 'select * from mkcms_user where u_name = "'.$u_name.'" and u_password = "'.md5($u_password).'" and u_status=1';
	$result = mysql_query($sql);
	if(!! $row = mysql_fetch_array($result)){
		
	$_data['u_loginnum'] = $row['u_loginnum']+1; 
	$_data['u_loginip'] =$_SERVER["REMOTE_ADDR"]; 
	$_data['u_logintime'] =date('y-m-d h:i:s',time());
	if(!empty($row['u_end'])) $u_end= $row['u_end'];
	if(time()>$u_end){
	$_data['u_flag'] =="0";
	$_data['u_start'] =="";
	$_data['u_end'] =="";
	$_data['u_group'] =1;
	}else{
	$_data['u_flag'] ==$row["u_flag"];
	$_data['u_start'] ==$row["u_start"];
	$_data['u_end'] ==$row["u_end"];
	$_data['u_group'] =$row["u_group"];
	}
	mysql_query('update mkcms_user set '.arrtoupdate($_data).' where u_id ="'.$row['u_id'].'"');
	$_SESSION['user_name']=$row['u_name'];
	$_SESSION['user_group']=$row['u_group'];
	if($_POST['brand1']){ 
setcookie('user_name',$row['u_name'],time()+3600 * 24 * 365); 
setcookie('user_password',$row['u_password'],time()+3600 * 24 * 365); 
} 
		header('location:user.php');
	}else{
		alert_href('用户名或密码错误或者尚未激活','login.php?op=login');
	}
}
if(isset($_POST['reg'])){
$username = stripslashes(trim($_POST['name']));
// 检测用户名是否存在
$query = mysql_query("select u_id from mkcms_user where u_name='$username'");
if(mysql_fetch_array($query)){
echo '<script>alert("用户名已存在，请换个其他的用户名");window.history.go(-1);</script>';
exit;
}
$result = mysql_query('select * from mkcms_user where u_email = "'.$_POST['email'].'"');
if(mysql_fetch_array($result)){
echo '<script>alert("邮箱已存在，请换个其他的邮箱");window.history.go(-1);</script>';
exit;
}
$password = md5(trim($_POST['password']));
$email = trim($_POST['email']);
$regtime = time();
$token = md5($username.$password.$regtime); //创建用于激活识别码
$token_exptime = time()+60*60*24;//过期时间为24小时后
$data['u_name'] = $username;
$data['u_password'] =$password;
$data['u_email'] = $email;
$data['u_regtime'] =$regtime;
if($mkcms_mail==1){
$data['u_status'] =0;
	}else{
$data['u_status'] =1;
	}
$data['u_group'] =1;
$data['u_fav'] =0;
$data['u_plays'] =0;
$data['u_downs'] =0;
//推广注册
if (isset($_GET['tg'])) {
	$data['u_qid'] =$_GET['tg'];
	$result = mysql_query('select * from mkcms_user where u_id="'.$_GET['tg'].'"');
if($row = mysql_fetch_array($result)){

$u_points=$row['u_points'];
}
	}
$_data['u_points'] =$u_points+$mkcms_tuiguang;
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_id="'.$_GET['tg'].'"';
if (mysql_query($sql)) {}	
$data['u_question'] =$token;
$str = arrtoinsert($data);
$sql = 'insert into mkcms_user ('.$str[0].') values ('.$str[1].')';
if (mysql_query($sql)) {
if($mkcms_mail==1){
//写入数据库成功，发邮件
include("emailconfig.php");
    //创建$smtp对象 这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp = new Smtp($MailServer, $MailPort, $smtpuser, $smtppass, true); 
    $smtp->debug = false; 
    $mailType = "HTML"; //信件类型，文本:text；网页：HTML
    $email = $email;  //收件人邮箱
    $emailTitle = "".$mkcms_name."用户帐号激活"; //邮件主题
    $emailBody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='".$mkcms_domain."ucenter/active.php?verify=".$token."' target='_blank'>".$mkcms_domain."ucenter/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- ".$mkcms_name." 敬上</p>";
    
    // sendmail方法
    // 参数1是收件人邮箱
    // 参数2是发件人邮箱
    // 参数3是主题（标题）
    // 参数4是邮件主题（标题）
    // 参数4是邮件内容  参数是内容类型文本:text 网页:HTML
    $rs = $smtp->sendmail($email, $smtpMail, $emailTitle, $emailBody, $mailType);
if($rs==true){
echo '<script>alert("恭喜您，注册成功！请登录到您的邮箱及时激活您的帐号！");window.history.go(-1);</script>';
}
}
if($mkcms_smsname!=""){
if($_POST['txtsmscode']=="" || $_POST['txtsmscode']!=$_SESSION['mobilecode']){
echo "<script type='text/javascript'>alert('短信验证码不能为空！');history.go(-1);</script>"; 
}
else{
	echo '<script>alert("恭喜您，注册成功！");window.history.go(-2);</script>';	
}	
}
else
{
echo '<script>alert("恭喜您，注册成功！");window.history.go(-2);</script>';	
}
}

}
?>
<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta name="author" content="lsl">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="generator" content="webstorm">
<!--移动端响应式-->
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<!--支持IE的兼容模式-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--让部分国产浏览器默认采用高速模式渲染页面-->
<meta name="renderer" content="webkit">
<!--页面style css-->
<link rel="stylesheet" href="<?php echo $mkcms_domain;?>wap/weui/weuix.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $mkcms_domain;?>wap/style/css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo $mkcms_domain;?>wap/style/css/li.css">
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="<?php echo $mkcms_domain;?>wap/style/js/li.js"></script>
<title>会员登陆</title>
<style type="text/css">
img { border: 0; vertical-align: middle; }
.weui_cell:before{width: 95%}
.login-box{width:100%;overflow:hidden;margin:0 auto;}
.lg-title{width:100%;height:auto;overflow:hidden;font-size:20px;text-align:center; line-height:100px; color:#000;}

.login-form{width:100%;height:auto; padding:20px 30px; box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box; -o-box-sizing:border-box;}
.common-div{width:100%;height:40px;overflow:hidden;border-radius:4px;-webkit-border-radius:4px;margin-bottom:20px; position:relative;}
.login-user-name,.login-user-pasw{background-color:rgba(255,255,255,0.1);}
.common-div >.common-icon{float:left;width:20px;height:20px;overflow:hidden;margin:10px;}
.common-div >.common-icon img{width:100%;height:auto;}
.common-div >input{width:92%;height:40px; padding:6px 10px 6px 46px;background-color:#ffffff5c;border:none;outline:none;font-size:15px;color:#000; box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box; -o-box-sizing:border-box; position:absolute; left:50px; top:0; font-family:Helvetica,STHeiti STXihei, Microsoft JhengHei, Microsoft YaHei, Arial;}
.login-btn{background-color:#e21323;color:#fff;font-size:16px;text-align:center;line-height:40px; display:block;}
.forgets{width:100%;height:auto;margin:0 auto; padding:0 30px;  box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box; -o-box-sizing:border-box;}
.forgets >a{color:#fff;opacity:0.2;font-size:14px;}
.forgets >a +a{float:right;}
.login-oth-btn{color: #fff;font-size: 16px;text-align: center;line-height: 40px;display: block;background-color: #000;}
</style>
</head>
<?php if ($op == 'login' or $op == ''){?>
<body style="background:#f6f6f6;">
<div class="login-box">
  <div class="lg-title">欢迎登陆</div>
  <div class="login-form">
    <form action="" method="post" class="form-horizontal form">
        <div class="login-user-name common-div">
            <span class="eamil-icon common-icon">
              <img src="<?php echo $mkcms_domain;?>wap/style/images/eamil.png" />
            </span>
            <input type="text" name="u_name" value="" placeholder="请输入您的手机号" />        
          </div>
          <div class="login-user-pasw common-div">
            <span class="pasw-icon common-icon">
              <img src="<?php echo $mkcms_domain;?>wap/style/images/password.png" />
            </span>
             <input type="password" name="u_password" value="" placeholder="请输入您的密码" />        
          </div>
          <input name="submit" type="submit" value="登陆" class="login-btn common-div"/>
         
          <a href="login.php?op=create" class="login-oth-btn common-div">免费注册</a>
          <!-- <a href="javascript:;" class="login-oth-btn common-div">QQ登陆</a> -->
      </form>
  </div>    
</div>
<?php }?>
<?php if ($op == 'create'){?>
<body>
<script type="text/javascript">
function chk_form(){
var tel = document.getElementById("tel");
if(tel.value==""){
alert("用户名不能为空！");
return false;
//user.focus();
}
var pass = document.getElementById("pass");
if(pass.value==""){
alert("密码不能为空！");
return false;
//pass.focus();
}
var email = document.getElementById("email");
if(email.value==""){
alert("Email不能为空！");
return false;
//email.focus();
}
var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email
if(!preg.test(email.value)){ 
alert("Email格式错误！");
return false;
//email.focus();
}
}
</script>
<script type="text/javascript">
				/*-------------------------------------------*/
				var InterValObj; //timer变量，控制时间
				var count = 60; //间隔函数，1秒执行
				var curCount;//当前剩余秒数
				var code = ""; //验证码
				var codeLength = 6;//验证码长度
				function sendMessage() {
							curCount = count;
							var dealType; //验证方式
				tel = $('#tel').val();
		    if(tel!=''){
			
			//验证手机有效性
			 var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(14[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
            if(!myreg.test($('#tel').val())) 
          { 
             alert('请输入有效的手机号码！'); 
             return false; 
          } 
			tel = $('#tel').val();
			   //产生验证码
				for (var i = 0; i < codeLength; i++) {
								code += parseInt(Math.random() * 9).toString();
							}
							//设置button效果，开始计时
								$("#btnSendCode").attr("disabled", "true");
								$("#btnSendCode").val("请在" + curCount + "秒内输入");
								InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
				//向后台发送处理数据
                $.ajax({
                    type: "POST", //用POST方式传输
                    dataType: "text", //数据格式:JSON
                    url: '/ucenter/yanzhengma.php', //目标地址
                    data: "&tel=" + tel + "&code=" + code,
                    error: function (XMLHttpRequest, textStatus, errorThrown) { },
                    success: function (msg){ }
                });
			
		        }else{
			alert('请填写手机号码');
		        }
				
            }
				//timer处理函数
			function SetRemainTime() {
					if (curCount == 0) {                
						window.clearInterval(InterValObj);//停止计时器
						$("#btnSendCode").removeAttr("disabled");//启用按钮
						$("#btnSendCode").val("重新发送验证码");
						code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效    
					}
					else {
						curCount--;
						$("#btnSendCode").val("请在" + curCount + "秒内输入");
					}
				}
    </script>
<div class="weui_tab" style="height:350px;" id="tab1">
    <!-- <div class="weui_navbar" style="height:44px;">
        <div class="weui_navbar_item ">
            手机注册
        </div>
        <div class="weui_navbar_item">
            账号密码注册
        </div>
    </div> -->
    <div class="weui_tab_bd">
        <div class="">
<form class="form-horizontal js-ajax-form"  method="post" onsubmit="return chk_form();">
                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_hd">
                            <label class="weui_label">手机号</label>
                        </div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="name" id="tel" type="number" required pattern="[0-9]{11}" maxlength="11" placeholder="输入你现在的手机号" emptyTips="请输入手机号" notMatchTips="请输入正确的手机号">
                        </div>
                        <div class="weui_cell_ft">
                            <i class="weui_icon_warn"></i>
                        </div>
                    </div>
                    <div class="weui_cell">
                        <div class="weui_cell_hd">
                            <label class="weui_label">邮箱</label>
                        </div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="email" id="email" type="text" required placeholder="输入邮箱" >
                        </div>
                        <div class="weui_cell_ft">
                            <i class="weui_icon_warn"></i>
                        </div>
                    </div>
                    <div class="weui_cell">
                        <div class="weui_cell_hd">
                            <label class="weui_label">密码</label>
                        </div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="password" id="pass" type="password" placeholder="输入确认密码">
                        </div>
                        <div class="weui_cell_ft">
                            <i class="weui_icon_warn"></i>
                        </div>
                    </div>
                    <?php if($mkcms_smsname!=""){?><div class="weui_cell weui_vcode">
                        <div class="weui_cell_hd">
                            <label class="weui_label">验证码</label>
                        </div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="txtsmscode" id="txtsmscode" type="number" placeholder="请输入验证码" tips="请输入验证码">
                        </div>
                        <div class="weui_cell_ft">
                            <i class="weui_icon_warn"></i>
                            <input id="btnSendCode" class="weui-vcode-btn" type="button" value="获取验证码" onclick="sendMessage()" style="border: none;background: white;border-left: 1px solid #DCDCDC;" >
                        </div>
                    </div><?php }?>
                </div>
                <div class="weui_btn_area">
				<button class="weui_btn weui_btn_primary" type="submit" name="reg" data-wait="1500" style="margin-left: 0px;margin-top:30px;">确定注册</button>
                 
                </div>
            </form>
        </div>        
    </div>
</div>

<?php }?> 
<?php  include 'footer.php';?>
</body>
</html>
