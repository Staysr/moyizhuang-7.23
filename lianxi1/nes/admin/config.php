<?php
require dirname(__FILE__) . "/dzsck.php";
	if (($_GET["type"] == "editpass") && $_POST) {
		$cm->query("SELECT * FROM d_admin where admin_id='1' order by admin_id desc");
		$row = $cm->fetch_array($rs);

		if ($row["admin_pass"] != md5($_POST["oldpass"])) {
			echo tiao("原密码输入错误", "config.php#home2");
			exit();
		}

		if (md5($_POST["newpass2"]) != md5($_POST["newpass"])) {
			echo tiao("两次输入的新密码不一致", "config.php#home2");
			exit();
		}

		if (!okpass($_POST["newpass"])) {
			echo tiao("密码不可包含字符", "config.php#home2");
			exit();
		}

		$date = array("admin_pass" => md5($_POST["newpass"]));
		$updates = $cm->cmupdate($date, "admin_id='1'", "d_admin");

		if ($updates) {
			echo tiao("修改密码成功", "config.php#home2");
			exit();
		}
		else {
			echo tiao("修改密码失败", "config.php#home2");
			exit();
		}
	}

$cm->query("SELECT * FROM d_config where config_id='1' order by config_id desc");
$row = $cm->fetch_array($rs);

?>
<!DOCTYPE html>
<html lang="cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>全局设置</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="../Public/Plugin/style/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../Public/Plugin/style/css/ace.min.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">window.jQuery || document.write("<script src='../Public/Plugin/style/js/jquery-2.0.3.min.js'>"+"<"+"/script>");</script>
<script src="../Public/Plugin/style/js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-sm-12 widget-container-span">
 <div class="widget-box transparent">
   <div class="widget-header">
     <div class="widget-toolbar no-border">
       <ul class="nav nav-tabs" id="myTab2">
         <li class="active"><a data-toggle="tab" href="#home1">系统基本信息</a></li>
         <li><a data-toggle="tab" href="#home2">管理员修改密码</a></li>
       </ul>
     </div>
    </div>
  <div class="widget-body">
    <div class="widget-main padding-12 no-padding-left no-padding-right">
      <div class="tab-content padding-4">
      <div id="home1" class="tab-pane in active">
       <div id="hd_main">
   <div style="margin:20px;">
   <?php
    $path = $_SERVER['SCRIPT_NAME'];
    if(strpos($path,'/admin/')>-1){
	   echo '<div style="text-align:center; color:red; font-size:16px; margin-bottom:15px;">您的后台目录默认为 域名/admin ，为了安全请尽快修改后台目录</div>';	
	}
	if($aik['admin_name']=='aik' && $aik['admin_pass']=='a13a02276910cbc879f020ed88816512'){
	   echo '<div style="text-align:center; color:red; font-size:16px; margin-bottom:15px;">您的账号密码为系统默认，请尽快修改</div>';	
	}
   ?>
      <table width="600" border="0" class="tablecss" cellspacing="0" cellpadding="0" align="center">
   <tr>
    <td colspan="2" align="center"><b>欢迎使用团啊VIP电影管理系统！</b><br>
	</td>
    </tr>
  <tr>
    <td align="right">当前使用版：</td>
    <td><span><a href="https://www.tuana.cn/news/txtlist_i303v.html" target="_blank">V3.7.5独家注册会员功能版</a><br><a href="https://www.tuana.cn/product/view64.html" target="_blank">源码购买：http://www.tuana.cn/product/view64.html</b></a></span></td>
  </tr>
  <tr>
    <td align="right">团啊视频CMS系统官网：</td>
    <td><a href="http://cms.tuana.cn" target="_blank">http://cms.tuana.cn</a></td>
  </tr>
  <tr>
    <td width="213" align="right">服务器操作系统：</td>
    <td width="387"><?php $os = explode(" ", php_uname()); echo $os[0];?> (<?php if('/'==DIRECTORY_SEPARATOR){echo $os[2];}else{echo $os[1];} ?>)</td>
  </tr>
  <tr>
    <td width="213" align="right">服务器解译引擎：</td>
    <td width="387"><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
  </tr>
  <tr>
    <td width="213" align="right">PHP版本：</td>
    <td width="387"><?php echo PHP_VERSION?></td>
  </tr>
  <tr>
    <td align="right">域名：</td>
    <td><?php echo $_SERVER['HTTP_HOST']?></td>
  </tr>
  <tr>
    <td align="right">allow_url_fopen：</td>
    <td><?php echo ini_get('allow_url_fopen') ? '<span class="green">支持</span>' : '<span class="red">不支持</span>'?></td>
  </tr>
  <tr>
    <td align="right">curl_init：</td>
    <td><?php if ( function_exists('curl_init') ){ echo '<span class="green">支持</span>' ;}else{ echo '<span class="red">不支持</span>';}?></td>
  </tr>
<tr>
    <td align="right">/data/目录权限检测：</td>
    <td><?php echo is_writable('../data/') ? '<span class="green">可写</span>' : '<span class="red">不可写</span>'?></td>
  </tr>
</table>
<table width="600" border="0" class="tablecss" cellspacing="0" cellpadding="0" align="center">
   <tr>
    <td colspan="2" align="center"><b>以下为团啊网互联网+创业服务 （价格实惠，欢迎使用支持！）</b><br>
	<a href="http://www.tuana.cn/" target="_blank" style="color:#F00; font-weight:bold; font-size:18px">团啊网官网：<b  style="text-decoration:underline;color:#03F;">www.tuana.cn</b></a>
	</td>
    </tr>
    <tr>
    <td align="right">免备案国内空间：</td>
    <td><span><a href="http://www.gouwang.net/" target="_blank">http://www.gouwang.net/</a></br>（开通时选择php多版本）</span></td>
  </tr>
	<tr>
    <td align="right">VPS/虚拟主机/域名：</td>
    <td><span><a href="http://yun.gouagou.com" target="_blank">http://yun.gouagou.com</a></br>景安官方代理，联系客服可以享受VPS年付半价优惠！</span></td>
  </tr>
    <tr>
    <td align="right">商标注册：</td>
    <td><span><a href="http://sb.gouagou.com" target="_blank">http://sb.gouagou.com</a></br>商标注册380元/一个,担保注册888元/一个。<br/>建议担保注册，注册失败全额退款。</span></td>
  </tr>
    </tr>
    <tr>
    <td align="right">主机业务代理：</td>
    <td><span><a href="http://www.gouwang.net/ag.asp" target="_blank">http://www.gouwang.net/ag.asp</a></br>预付款≥200元人民币6折代理，预付款≥800元人民币5.5折代理。<br/>可搭建独立平台，自用、售卖都划算！</span></td>
  </tr>
      <tr>
    <td align="right">威客开发任务：</td>
    <td><span><a href="https://www.tuana.cn/task/" target="_blank">https://www.tuana.cn/task/</a></br>在线提交网站软件开发、平面设计等需求。</span></td>
  </tr>
</table>
   </div>
</div>
      </div>
      <div id="home2" class="tab-pane in">
       <div class="row">
        <div class="col-xs-12 no-padding-right">
    <form class="form-horizontal" role="form" action="?type=editpass" method="post">
    <div class="form-group">
       <label class="col-sm-3 control-label no-padding-right"for="form-field-1"> 原密码： </label>
       <div class="col-sm-9"><input type="password" id="form-field-1"value="" name="oldpass" class="col-xs-10 col-sm-6">
       </div>
     </div>
     <div class="space-4"></div>
     <div class="form-group">
       <label class="col-sm-3 control-label no-padding-right"for="form-field-2"> 新密码： </label>
        <div class="col-sm-9">
         <input type="password" id="form-field-2" value="" name="newpass" class="col-xs-10 col-sm-6">
        </div>
      </div>
      <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right"for="form-field-2"> 确认新密码： </label>
        <div class="col-sm-9">
          <input type="password" id="form-field-2"value="" name="newpass2" class="col-xs-10 col-sm-6">
        </div>
       </div>
       <div class="clearfix form-actions">
       <div class="col-md-offset-3 col-md-9">
       <button class="btn btn-info" type="submit"><i class="icon-ok bigger-110"></i> 提交</button>&nbsp; &nbsp; &nbsp;<button class="btn" type="reset"><i class="icon-undo bigger-110"></i> 取消</button>
       </div>
      </div>
     </form>
     </div></div></div></div></div></div></div></div>