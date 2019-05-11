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
include('configads.php'); 
if( isset($_GET['act']) && $_GET['act']=='setting' && isset($_POST['edit']) && $_POST['edit']==1){
	$datas = $_POST;
	$data = $datas['adaik'];
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
    if(!isset($datas['adaik']['joinhotkey'])){
		$data['joinhotkey']='0';
	}
	if(file_put_contents('../inc/aik.adsconfig.php',"<?php\n \$adaik =  ".var_export($data,true).";\n?>")){
		  echo "<script>alert('恭喜你，修改成功！');window.location= 'settingads.php';</script>"; 	
	}else{
		 echo "<script>alert('修改失败，请重新修改');window.location= 'settingads.php';</script>"; 	
	}	
     $adaik = $data;
} 
$tips = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告设置</title>
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
 <form name="configform" id="configform" action="./settingads.php?act=setting&t=<?php echo time()?>" method="post" onsubmit="return subck()">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">
<tr class="thead">
<td colspan="10" align="center">视频侵权设置<a href="https://www.gouagou.com/news/txtlist_i296v.html" target="_blank">【设置说明】</a></td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">屏蔽侵权影片名称：</td>
    <td valign="top"><div class="cl5"></div><textarea name="adaik[qq_name]" cols="80" rows="4"><?php echo $adaik['qq_name']?></textarea><br>直接填写例如：醉玲珑#无证之罪#权力的游戏第七季 然后保存。<br>影片名称要写全称，多个影片名称用#隔开</td>
</tr>
<tr class="thead" style="color:#0CF;font-weight:bold;">
<td colspan="10" align="center">首页幻灯广告</td>
</tr>
 <tr>
    <td width="150" align="right" valign="middle" class="s_title">幻灯1：</td>
    <td valign="top">请投放1920x420图片链接<div class="cl5"></div><textarea name="adaik[huandeng_1]" cols="80" rows="1"><?php echo $adaik['huandeng_1']?></textarea>
   <br/>以下为广告链接：<br/><div class="cl5"></div><textarea name="adaik[huandeng_url_1]" cols="80" rows="1"><?php echo $adaik['huandeng_url_1']?></textarea>
   </td>
</tr> 
 <tr>
    <td width="150" align="right" valign="middle" class="s_title">幻灯2：</td>
    <td valign="top">请投放1920x420图片链接<div class="cl5"></div><textarea name="adaik[huandeng_2]" cols="80" rows="1"><?php echo $adaik['huandeng_2']?></textarea>
   <br/>以下为广告链接：<br/><div class="cl5"></div><textarea name="adaik[huandeng_url_2]" cols="80" rows="1"><?php echo $adaik['huandeng_url_2']?></textarea>
   </td>
</tr> 
 <tr>
    <td width="150" align="right" valign="middle" class="s_title">幻灯3：</td>
    <td valign="top">请投放1920x420图片链接<div class="cl5"></div><textarea name="adaik[huandeng_3]" cols="80" rows="1"><?php echo $adaik['huandeng_3']?></textarea>
   <br/>以下为广告链接：<br/><div class="cl5"></div><textarea name="adaik[huandeng_url_3]" cols="80" rows="1"><?php echo $adaik['huandeng_url_3']?></textarea>
   </td>
</tr> 
 <tr>
    <td width="150" align="right" valign="middle" class="s_title">幻灯4：</td>
    <td valign="top">请投放1920x420图片链接<div class="cl5"></div><textarea name="adaik[huandeng_4]" cols="80" rows="1"><?php echo $adaik['huandeng_4']?></textarea>
   <br/>以下为广告链接：<br/><div class="cl5"></div><textarea name="adaik[huandeng_url_4]" cols="80" rows="1"><?php echo $adaik['huandeng_url_4']?></textarea>
   </td>
</tr> 
 <tr>
    <td width="150" align="right" valign="middle" class="s_title">幻灯5：</td>
    <td valign="top">请投放1920x420图片链接<div class="cl5"></div><textarea name="adaik[huandeng_5]" cols="80" rows="1"><?php echo $adaik['huandeng_5']?></textarea>
   <br/>以下为广告链接：<br/><div class="cl5"></div><textarea name="adaik[huandeng_url_5]" cols="80" rows="1"><?php echo $adaik['huandeng_url_5']?></textarea>
   </td>
</tr> 
  <tr class="thead" style="color:#0CF;font-weight:bold;">
<td colspan="10" align="center">手机版首页随机广告</td>
</tr>
   <tr>
    <td width="150" align="right" valign="middle" class="s_title">随机1：</td>
    <td valign="top">请投放360x120<div class="cl5"></div><textarea name="adaik[m_suiji_1]" cols="80" rows="3"><?php echo $adaik['m_suiji_1']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/m/m1.jpg" border="0" width="100%" height="100%"  /></a></textarea> 
     </td>
</tr> 
  <tr>
    <td width="150" align="right" valign="middle" class="s_title">随机2：</td>
    <td valign="top">请投放360x120<div class="cl5"></div><textarea name="adaik[m_suiji_2]" cols="80" rows="3"><?php echo $adaik['m_suiji_2']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/m/m2.jpg" border="0" width="100%" height="100%"  /></a></textarea>    
    </td>
</tr> 
  <tr>
    <td width="150" align="right" valign="middle" class="s_title">随机3：</td>
    <td valign="top">请投放360x120<div class="cl5"></div><textarea name="adaik[m_suiji_3]" cols="80" rows="3"><?php echo $adaik['m_suiji_3']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/m/m3.jpg" border="0" width="100%" height="100%"  /></a></textarea>    
    </td>
</tr>
    <tr>
    <td width="150" align="right" valign="middle" class="s_title">随机4：</td>
    <td valign="top">请投放360x120<div class="cl5"></div><textarea name="adaik[m_suiji_4]" cols="80" rows="3"><?php echo $adaik['m_suiji_4']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/m/m2.jpg" border="0" width="100%" height="100%"  /></a></textarea>      
      </td>
</tr> 
    <tr>
    <td width="150" align="right" valign="middle" class="s_title">随机5：</td>
    <td valign="top">请投放360x120<div class="cl5"></div><textarea name="adaik[m_suiji_5]" cols="80" rows="3"><?php echo $adaik['m_suiji_5']?></textarea>
      <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/m/m5.jpg" border="0" width="100%" height="100%"  /></a></textarea>
      </td>
</tr> 
<!--<tr class="thead" style="color:#0CF;font-weight:bold;">
<td colspan="10" align="center">列表页广告</td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">电影列表广告：</td>
    <td valign="top">请投放1250x117<div class="cl5"></div><textarea name="adaik[movie_ad]" cols="80" rows="3"><?php echo $adaik['movie_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/bottomads.gif" style="width:100%"></a></textarea>  
  </td>
  </tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">电视剧列表广告：</td>
    <td valign="top">请投放1250x117<div class="cl5"></div><textarea name="adaik[tv_ad]" cols="80" rows="3"><?php echo $adaik['tv_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/bottomads.gif" style="width:100%"></a></textarea>  
  </td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">综艺列表广告：</td>
    <td valign="top">请投放1250x117<div class="cl5"></div><textarea name="adaik[zongyi_ad]" cols="80" rows="3"><?php echo $adaik['zongyi_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/bottomads.gif" style="width:100%"></a></textarea>   
  </td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">动漫列表广告：</td>
    <td valign="top">请投放1250x117<div class="cl5"></div><textarea name="adaik[dongman_ad]" cols="80" rows="3"><?php echo $adaik['dongman_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/bottomads.gif" style="width:100%"></a></textarea>   
  </td>
</tr>-->
<tr class="thead">
<td colspan="10" align="center"  style="color:#0CF;font-weight:bold;">播放页广告</td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">播放器顶部广告：</td>
    <td valign="top">请投放328x525<div class="cl5"></div><textarea name="adaik[play_up]" cols="80" rows="3"><?php echo $adaik['play_up']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/play_up.gif" border="0" usemap="#Map" style="width:100%"></textarea>  
  </td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">播放器加载广告：</td>
    <td valign="top">请投放903x616<div class="cl5"></div><textarea name="adaik[jiazai_ad]" cols="80" rows="3"><?php echo $adaik['jiazai_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a href="http://www.tuana.cn" target="_blank"><img src="images/jiazai.png" width="100%"></a></textarea>   
  </td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">播放器上图片广告：</td>
    <td valign="top">请投放903x616<div class="cl5"></div><textarea name="adaik[play_ad]" cols="80" rows="3"><?php echo $adaik['play_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><img id="addid" src="images/1280jiazai.png" style="display: none;width:100%;border: 2px solid #ff6651"></textarea>  
  </td>
</tr>
<tr class="thead" style="color:#0CF;font-weight:bold;">
<td colspan="10" align="center">播放页侧边栏广告</td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">侧边栏一</td>
    <td valign="top"><div class="cl5"></div><textarea name="adaik[cebian1_ad]" cols="80" rows="5"><?php echo $adaik['cebian1_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a class="style02" href="http://www.tuana.cn" target="_blank"><strong>关注微信</strong><div class="article-wechats"> </br> <img src="images/qrcode.png"></div> </a></textarea>  
  </td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">侧边栏二</td>
     <td valign="top"><div class="cl5"></div><textarea name="adaik[cebian2_ad]" cols="80" rows="5"><?php echo $adaik['cebian2_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a class="style02" href="http://www.tuana.cn" target="_blank"><strong>优惠券</strong><h2>爱艺VIP券券-优惠购物</h2><p>淘宝天猫内部优惠券,公开优惠券搜索，省钱购买！
领取内部优惠券，一样的东西，领券购买一般比自己直接买【省30%-60%】不等，券额多大就是省多少钱！</p></a></textarea>  
  </td>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">侧边栏三</td>
    <td valign="top"><div class="cl5"></div><textarea name="adaik[cebian3_ad]" cols="80" rows="5"><?php echo $adaik['cebian3_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><h3>广告赞助</h3><div class="textwidget"><a href="http://www.tuana.cn" target="_blank"><img src="images/jianzhi.png" width="100%"></a></div></textarea>   
  </td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">侧边栏四</td>
 <td valign="top"><div class="cl5"></div><textarea name="adaik[cebian4_ad]" cols="80" rows="5"><?php echo $adaik['cebian4_ad']?></textarea>
    <br/>以下为删错备用对照代码：<br/><textarea cols="80" rows="2"><a class="style01" href="http://www.tuana.cn" target="_blank"><strong>广而告知</strong><h2>更好的影院</h2><p>1.扁平化、简洁风、多功能配置，优秀的电脑、平板、手机支持，响应式布局，不同设备不同展示效果...2.视频全自动采集，不需人工干预，懒人必备！</p></a></textarea>  
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