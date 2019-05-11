<?php 
if (get_magic_quotes_gpc()) { 
function stripslashes_deep($value) 
{ 
$value = is_array($value) ? 
array_map('stripslashes_deep', $value) : 
stripslashes($value); 
 
return $value; 
} 
 
$_POST = array_map('stripslashes_deep', $_POST); 
$_GET = array_map('stripslashes_deep', $_GET); 
$_COOKIE = array_map('stripslashes_deep', $_COOKIE); 
$_REQUEST = array_map('stripslashes_deep', $_REQUEST); 
} 
?>
<?php

require dirname(__FILE__) . "/dzsck.php";

include('configwz.php'); 

//setting

if( isset($_GET['act']) && $_GET['act']=='setting' && isset($_POST['edit']) && $_POST['edit']==1){

	$datas = $_POST;

	$data = $datas['aik'];

	$data['description'] = strip_tags($data['description']);

	$data['foot'] = htmlspecialchars_decode($data['foot']);

	if (get_magic_quotes_gpc()) {

		$data['foot'] = stripslashes($data['foot']);

	}

	$data['hometopnotice'] = htmlspecialchars_decode($data['hometopnotice']);

	if (get_magic_quotes_gpc()) {

		$data['hometopnotice'] = stripslashes($data['hometopnotice']);

	}

	$data['hometopright'] = htmlspecialchars_decode($data['hometopright']);

	if (get_magic_quotes_gpc()) {

		$data['hometopright'] = stripslashes($data['hometopright']);

	}

	$data['homelink'] = htmlspecialchars_decode($data['homelink']);

	if (get_magic_quotes_gpc()) {

		$data['homelink'] = stripslashes($data['homelink']);

	}

	$data['sort'] = trim($data['sort'],',');

	if($data['sort']==''){

	   $data['sort'] = '1,2,3,4,5,6,7,8,9,10';	

	}

    if(!isset($datas['aik']['joinhotkey'])){

		$data['joinhotkey']='0';

	}

	if($data['admin_pass']==''){

		$data['admin_pass'] = $aik['admin_pass'];

	}else{

	    $data['admin_pass'] = md5ff(htmlspecialchars($data['admin_pass']));	

	}

	if(file_put_contents('../inc/aik.config.php',"<?php\n \$aik =  ".var_export($data,true).";\n?>")){

		 echo "<script>alert('恭喜你，修改成功！');window.location= 'settingwz.php';</script>"; 	

	}else{

		 echo "<script>alert('修改失败，请重新修改');window.location= 'settingwz.php';</script>"; 	

	}	

     $aik = $data;

} 

$tips = '';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>网站设置</title>

<link href="public/css/base.css" rel="stylesheet" type="text/css" />

<link href="public/css/style.css" rel="stylesheet" type="text/css" />

<link href="css/style.css" rel="stylesheet" type="text/css" />

<script language="javascript"> 

function delcfm() { 

if (!confirm("确定要删除吗？")) { 

window.event.returnValue = false; 

} 

} 

</script> 

<script language="javascript"> 

function closecfm() { 

if (!confirm("确定要冻结吗？")) { 

window.event.returnValue = false; 

} 

} 

</script> 

<script language="javascript"> 

function opencfm() { 

if (!confirm("确定要重新开启吗？")) { 

window.event.returnValue = false; 

} 

} 

</script> 

</head>

<body> 

<div id="hd_main">

  <div align="center"><?php echo $tips?></div>

 <form name="configform" id="configform" action="./settingwz.php?act=setting&t=<?php echo time()?>" method="post" onsubmit="return subck()">

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">

<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">LOGO设置</td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">导航LOGO：</td>

    <td valign="top">请投放133x40<div class="cl5"></div><textarea name="aik[logo_dh]" cols="80" rows="1"><?php echo $aik['logo_dh']?></textarea><br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="1"><img src="images/logo.png"></textarea></td>
    
</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">搜索框上LOGO：</td>

    <td valign="top">请投放240x80<div class="cl5"></div><textarea name="aik[logo_ss]" cols="80" rows="1"><?php echo $aik['logo_ss']?></textarea><br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="1"><img id="imgsrc" src="images/sologo.png"></textarea></td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">会员中心头像：</td>

    <td valign="top">请投放150x150<div class="cl5"></div><textarea name="aik[logo_tx]" cols="80" rows="1"><?php echo $aik['logo_tx']?></textarea><br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="1"><img id="imgsrc" src="./images/tx.jpg"></textarea></td>

</tr>

<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">基本设置</td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">网站名称：</td>

    <td width="690" valign="middle"><input name="edit" id="edit" type="hidden" value="1" /><input type="text" name="aik[sitename]" value="<?php echo $aik['sitename']?>" size="50">

      <span class="gray tips">如：团啊VIP电影系统</span></td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">网站域名：</td>

    <td width="690" valign="middle"><input type="text" name="aik[pcdomain]" id="aik_pcdomain" value="<?php echo $aik['pcdomain']?>" size="20">

      <span class="gray tips">网站域名，如 http://www.tuana.cn</span></td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">首页标题：</td>

    <td valign="top"><input type="text" name="aik[title]" value="<?php echo $aik['title']?>" size="50">

      <span class="gray tips">显示在首页标题上，一般不超过80个字符</span></td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">首页关键字：</td>

    <td valign="top"><span class="gray tips">关键字请用英文逗号分开，一般不超过100个字符</span><br><textarea name="aik[keywords]" cols="80" rows="2"><?php echo $aik['keywords']?></textarea></td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">首页描述：</td>

    <td valign="top"><span class="gray tips">一般不超过200个字符</span><div class="cl5"></div><textarea name="aik[description]" cols="80" rows="3"><?php echo $aik['description']?></textarea></td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">电脑版导航微信关注：</td>

    <td valign="top">请投放130x130<div class="cl5"></div><textarea name="aik[weixin_ad]" cols="80" rows="1"><?php echo $aik['weixin_ad'];?></textarea><br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="1"><img src="images/about.png"></textarea></td>

</tr>
<tr>

    <td width="150" align="right" valign="middle" class="s_title">导航后链接1：</td>

    <td valign="top">请投放文字链接<div class="cl5"></div><textarea name="aik[daohang_1]" cols="80" rows="1"><?php echo $aik['daohang_1'];?></textarea><br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="1"><a href="https://www.tuana.cn/">团啊</a></textarea></td>

</tr>
  <tr>

    <td width="150" align="right" valign="middle" class="s_title">导航后链接2：</td>

    <td valign="top">请投放链接<div class="cl5"></div><textarea name="aik[daohang_2]" cols="80" rows="1"><?php echo $aik['daohang_2'];?></textarea><br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="1"><a href="http://www.gouwang.net/">购网</a></textarea></td>

</tr>
<tr>

    <td width="125" align="right" valign="middle" class="s_title">ICP备案号：</td>

    <td width="690" valign="middle"><input type="text" name="aik[icp]" id="aik_path" value="<?php echo $aik['icp']?>" size="20"></td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">版权说明：</td>

    <td valign="top"><textarea name="aik[foot]" cols="80" rows="5"><?php echo $aik['foot']?></textarea></td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">统计代码信息：</td>

    <td valign="top"><textarea name="aik[tongji]" cols="80" rows="5"><?php $aik['tongji'] = str_replace("\\'","'",$aik['tongji']);echo htmlspecialchars($aik['tongji'])?></textarea></td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">友情链接：</td>

    <td valign="top"><textarea name="aik[youlian]" cols="80" rows="5"><?php $aik['youlian'] = str_replace("\\'","'",$aik['youlian']);echo htmlspecialchars($aik['youlian'])?></textarea><br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn/" target="_blank">【团啊网】</a>|<a href="http://www.gouwang.net/" target="_blank">【购网主机】</a><br></textarea>

      <span class="gray tips"></span><br>*如友链过多,在后面添加换行代码然后再添加链接</td>

</tr>
<tr>

    <td width="125" align="right" valign="middle" class="s_title">管理员邮箱：</td>

    <td valign="top"><input type="text" name="aik[admin_email]" value="<?php echo $aik['admin_email']?>" size="30"></td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">音乐菜单：</td>

    <td colspan="top"><textarea name="aik[music1]" cols="80" rows="3"><?php echo $aik['music1'];?></textarea><br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="1"><li id="menu-item-20" class="menu-item"><a href="music.php" target="_blank">音乐</a></li></textarea></td>

</tr>
 
  
<tr class="thead">
  
<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">图片上传设置</td>
  
</tr>
    <td width="125" align="right" valign="middle" class="s_title">图片上传密码：</td>

    <td width="690" valign="middle"><input type="text" name="aik[tu_pass]" id="aik_path" value="<?php echo $aik['tu_pass']?>" size="20"> 点击><a href="/tu/" target="_blank">图片上传管理</a></td>

</tr>  
<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">VIP会员设置</td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title" style=" color:#F00">播放权限：</td>

    <td colspan="top"><input type=text name="aik[allopen]" value="<?php echo $aik['allopen'];?>" size="5" style="text-align:center"/>填数字：0就会开启登录可看，填：1就会开启直接观看</td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title" style=" color:#F00">会员免费试用天数：</td>

    <td width="300"  valign="middle"><input type="text" name="aik[config_day]" id="aik_path" value="<?php echo $aik['config_day']?>" size="20" style="text-align:center">天</td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title" style=" color:#F00">VIP会员价格：</td>

    <td width="300"  valign="middle">

	 月度VIP<input type="text" name="aik[vip_month]" id="aik_path" value="<?php echo $aik['vip_month']?>" size="5" style="text-align:center">元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	 季度VIP<input type="text" name="aik[vip_season]" id="aik_path" value="<?php echo $aik['vip_season']?>" size="5" style="text-align:center">元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	 年度VIP<input type="text" name="aik[vip_year]" id="aik_path" value="<?php echo $aik['vip_year']?>" size="5" style="text-align:center">元</td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title" style=" color:#F00">购买卡密链接：</td>

    <td width="300"  valign="middle"><textarea name="aik[km_url]" cols="80" rows="1"><?php echo $aik['km_url']?></textarea>

	<br/>以团啊网平台为例：注册发布宝贝，设置卡密销售，将宝贝链接填到这里<br/>团啊卡密商城<a href="http://www.tuana.cn/product/search_j263v_k266v.html" target="_blank">http://www.tuana.cn/product/search_j263v_k266v.html</a>

</td>

</tr>

<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">支付二维码：</td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">支付宝：</td>

    <td valign="top">请投放200x200（此处无需代码，直接填写图片链接路径）<div class="cl5"></div><textarea name="aik[zfb_ad]" cols="80" rows="1"><?php echo $aik['zfb_ad']?></textarea></td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">微信：</td>

    <td valign="top">请投放200x200（此处无需代码，直接填写图片链接路径）<div class="cl5"></div><textarea name="aik[wx_ad]" cols="80" rows="1"><?php echo $aik['wx_ad']?></textarea></td>

</tr>

<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">会员中心设置：</td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">帮助中心（如何开通会员）：</td>

    <td valign="top"><textarea name="aik[help1]" cols="80" rows="5"><?php echo $aik['help1']?></textarea>
  <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="5">
      <div class="dtit">开通vip会员方法：</div>
      <div class="dzdv" style="text-align:center;">
      <span class="dd">方法一：使用卡密进行自动开通。</span>
         <div class="shang_payimg" style="width:100%; height:auto">
    		<img src="images/pay1.png" alt="卡密开通会员"  width="100%"/>
    	</div>
      <span class="dd">方法二：在线充值自动开通。</span>
         <div class="shang_payimg" style="width:100%; height:auto">
    		<img src="images/pay2.png" alt="在线充值"  width="100%"/>
    	</div>
      </div></textarea>
  </td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">帮助中心（免责申明）：</td>

    <td valign="top"><textarea name="aik[help2]" cols="80" rows="5"><?php echo $aik['help2']?></textarea>
   <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="5">
<div class="dtit">免责声明</div>
      <div class="dzdv" style="text-align:center;">
      <span class="dd">本站提供的最新电影和电视剧资源均系收集于各大视频网站,本站只提供web页面服务,并不提供影片资源存储,也不参与录制、上传</br>若本站收录的节目无意侵犯了贵司版权，请给网页底部邮箱地址来信,我们会及时处理和回复,谢谢。。</span>
      </div></textarea> 
  </td></tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">联系我们：</td>

    <td valign="top"><textarea name="aik[about]" cols="80" rows="5"><?php echo $aik['about']?></textarea>
     <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="5">
      <div class="dtit">联系我们</div>
      <div class="dzdv" style="text-align:center;">
      <span class="dd">团啊VIP电影系统经过不懈努力，目前已拥有过千万粉丝，深受广大用户的喜爱，欢迎广告主及代理商前来洽谈合作。（添加时，请注明来意）</span>
         <span class="dd" style="color:#933">官方微信</span>
         <div class="shang_payimg">
    		<img src="../images/about.png" alt="扫一扫关注"  width="100%"/>
    	</div>
        <span class="dd"><font style="color:#933">官方QQ：</font>805189085</span>
      </div></textarea>
  </td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">加盟代理：</td>

    <td valign="top"><textarea name="aik[jiameng]" cols="80" rows="5"><?php echo $aik['jiameng']?></textarea>
       <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="5">
      <div class="dtit">加盟代理</div>
      <div class="dzdv" style="text-align:center;">
      <span class="dd">团啊VIP电影系统经过不懈努力，目前已拥有过千万粉丝，深受广大用户的喜爱！</span>
      <span class="dd">欢迎广告主及代理商前来洽谈合作。（添加时，请注明来意）</span>
         <span class="dd" style="color:#933">官方QQ：805189085</span>
         <div class="shang_payimg">
    		<img src="../images/about.png" alt="扫一扫关注"  width="100%"/>
    	</div>
       <span class="dd" style="color:#933">招商加盟官方：www.gouagou.com</span>
 <div class="shang_payimg" style="width:100%; text-align:center; height:auto;">
    	<img src="images/jm.png" alt="加盟代理"  width="100%"/>
    	</div>
      </div></textarea>
  </td></tr>

<tr>

<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">解析设置</td>

</tr>

<tr>

    <td width="125" align="right" valign="middle" class="s_title">电影解析接口：</td>

    <td valign="top">请将解析接口分别填入下列空中<font color="red">（第一条是默认调用接口）</font>定期更新免费解析接口 QQ群号码：364338586<div class="cl5"></div>

	<textarea name="aik[jiekou1]" cols="80" rows="1"><?php echo $aik['jiekou1']?></textarea>

	<textarea name="aik[jiekou2]" cols="80" rows="1"><?php echo $aik['jiekou2']?></textarea>

	<textarea name="aik[jiekou3]" cols="80" rows="1"><?php echo $aik['jiekou3']?></textarea>

	<textarea name="aik[jiekou4]" cols="80" rows="1"><?php echo $aik['jiekou4']?></textarea>

	<textarea name="aik[jiekou5]" cols="80" rows="1"><?php echo $aik['jiekou5']?></textarea>

	<textarea name="aik[jiekou6]" cols="80" rows="1"><?php echo $aik['jiekou6']?></textarea>

	<textarea name="aik[jiekou7]" cols="80" rows="1"><?php echo $aik['jiekou7']?></textarea>

	<textarea name="aik[jiekou8]" cols="80" rows="1"><?php echo $aik['jiekou8']?></textarea>

	<textarea name="aik[jiekou9]" cols="80" rows="1"><?php echo $aik['jiekou9']?></textarea>

	<textarea name="aik[jiekou10]" cols="80" rows="1"><?php echo $aik['jiekou10']?></textarea>

    </td>

</tr>
   
<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">盘古无广告解析接口配置</td>

</tr>
   
<tr>

    <td width="125" align="right" valign="middle" class="s_title">盘古uid：</td>

    <td valign="top"><input type="text" name="aik[pangu_uid]" value="<?php echo $aik['pangu_uid']?>" size="30">盘古接口注册地址<a href="http://service.pangujiexi.com/" target="_blank">http://www.pangujiexi.com/</a></td>

</tr>   

<tr>

    <td width="125" align="right" valign="middle" class="s_title">盘古token：</td>

    <td valign="top"><input type="text" name="aik[pangu_token]" value="<?php echo $aik['pangu_token']?>" size="30">uid和token在盘古网站用户中心获取<a href="http://service.pangujiexi.com/" target="_blank">http://service.pangujiexi.com/</a></td>

</tr>  
<tr>

    <td width="125" align="right" valign="middle" class="s_title">盘古域名防盗链：</td>

    <td valign="top"><input type="text" name="aik[pangu_yuming]" value="<?php echo $aik['pangu_yuming']?>" size="30">多个用|隔开，（例如www.tuana.cn|tuana.cn|api.tuana.cn）不设置盗链请留空</td>

</tr>
<tr>

    <td width="125" align="right" valign="middle" class="s_title">盘古接口目录：</td>

    <td valign="top"><input type="text" name="aik[pangu_mulu]" value="<?php echo $aik['pangu_mulu']?>" size="30">默认设置为：/pangu  一般不用修改,除非你修改了/pangu目录名(目录前面带/)</td>

</tr> 
<tr>

    <td width="125" align="right" valign="middle" class="s_title">盘古接口地址：</td>

    <td valign="top">设置在上方10个接口填入盘古接口：http://你的域名/pangu/index.php?url=</td>

</tr> 
<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">短信接口配置</td>

</tr>   
   
<tr>

    <td width="150" align="right" valign="middle" class="s_title">短信宝接口：</td>

    <td colspan="top">注册地址:<a href="http://www.smsbao.com/reg?r=10853" target="_blank">http://www.smsbao.com/reg?r=10853</a> (为了正常使用，必须在此链接下注册。最低套餐：5元/50条，量越多越便宜)

</td>

</tr>

<tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">短信宝账号：</td>

    <td colspan="top"><input type="text" name="aik[sms_user]" value="<?php echo $aik['sms_user'];?>" /></td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">短信宝密码：</td>

    <td colspan="top"><input type="text" name="aik[sms_pass]" value="<?php echo $aik['sms_pass'];?>"></td>

</tr>

<tr>

    <td width="150" align="right" valign="middle" class="s_title">注册短信开关：</td>

    <td colspan="top"><input type="text" name="aik[sms_kg]" size="5" value="<?php echo $aik['sms_kg'];?>">填数字：0就是开启，填：1就是关闭</td>

</tr>
<tr class="thead">

<td colspan="10" align="center" style="color:#0CF;font-weight:bold;">微信公众号搜索接口插件</td>

</tr>
<tr>

    <td width="150" align="right" valign="middle" class="s_title">微信配置方法</td>

    <td colspan="top">1.链接ftp在根目录wx_api.php上设置设置你的token，将:域名/wx_api.php填写在微信公众号基本设置服务器配置，然后填写网页设置的令牌token，EncodingAESKey随机生成，点击保存。
  <br/>2.通信成功后将wx_api.php删掉或者重命名，然后将wx_api_tuana.php重命名为wx_api.php
   <br/>3.在重命名后的wx_api.php上面设置3个地方，1是先前的token，2是关注后的回复文字，3回复后的消息封面图片链接。
  <br/>注意：修改token和网址，123步需要从头再来。
  </td>

</tr>
  <tr>

    <td width="150" align="right" valign="middle" class="s_title">微信效果参考：<br/>团啊网公众号<br/>（wwwtuanacn）</td>

    <td colspan="top"><img src="../images/qrcode_tuana.jpg">
  </td>

</tr>
<tr><!--此处为更新及重要补充，请保留-->

<td colspan="10" align="center"><input name="edit" type="hidden" value="1" /><input id="configSave" type="submit" onclick="return getsort()" value="保 存"></td>

</tr>

</table>

</form>

<script type="text/javascript">

	$(".sxlist:first").dragsort();

</script>

</div>

</body>

</html>