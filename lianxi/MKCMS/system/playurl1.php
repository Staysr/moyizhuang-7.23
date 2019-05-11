<?php
error_reporting(0);
function unicode_decode($name){
 
  $json = '{"str":"'.$name.'"}';
  $arr = json_decode($json,true);
  if(empty($arr)) return '';
  return $arr['str'];
}
$yuming='http://www.360kan.com';
$player = $yuming.$_GET['play'];
$tvinfo = file_get_contents($player);
$tvzz='#<div class="num-tab-main g-clear\s*js-tab"\s*(style="display:none;")?>[\s\S]+?<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">[\s\S]+?</div>#';
$tvzz1 = '#<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">#';
$dyzz= '#<span class="txt">站点排序：</span>[\s\S]+?<div style=\' visibility:hidden\'#';
$bflist = '#<a data-daochu=(.*?) class="btn js-site ea-site (.*?)" href="(.*?)">(.*?)</a>#';
$jianjie = '#<p class="item-desc js-open-wrap">(.*?)</p>#';
$biaoti = '#<h1>(.*?)</h1>#';
$pan = '#<h2 class="title g-clear">(.*?)</h2>#';
$pan1 = '#<h2 class="g-clear">(.*?)</h2>#';
$str=$_GET['play'];
$arr = explode('/', $str);
$mkcmsid=str_replace('.html', '', "$arr[2]");
$mkcmstyle=$arr[1];
$laiyuan = '#{"ensite":"(.*?)","cnsite":"(.*?)","vip":(.*?)}#';
preg_match_all($jianjie, $tvinfo, $jjarr);
preg_match_all($tvzz, $tvinfo, $tvarr);
preg_match_all($dyzz, $tvinfo, $dyarr);
preg_match_all($pan, $tvinfo, $ptvarr);
preg_match_all($pan1, $tvinfo, $ptvarr1);
preg_match_all($dyzz, $tvinfo, $tvlist);
preg_match_all($biaoti, $tvinfo, $btarr);
$mvsrc = implode($glue, $tvlist[0]);
preg_match_all($bflist, $mvsrc, $dyarr1);
//电视剧动漫多来源判断
preg_match_all($laiyuan, $tvinfo, $laiyuanarr);
$yuan=$laiyuanarr[1];//来源英文
$yuanname=$laiyuanarr[2];//来源中文
//电影链接
$dysrc=$dyarr1[0];

$c=$dyarr1[3];//电影的播放链接

$d=$dyarr1[4];//电影来源

$jian = $jjarr[1][0];//简介
$timu = $btarr[1][0];//标题
$panduan = $ptvarr[1][0];
$panduan1 = $ptvarr1[1][0];

$zyv="#<div class=\"juji-main\">[\s\S]+?<div class=\"juji-page\">#";
$qi="#<span class='w-newfigure-hint'>(.*?)</span>#";
$zyimg="#data-src='(.*?)' alt='(.*?)'#";
preg_match_all($zyv, $tvinfo,$zyvarr);
$zylist = implode($glue, $zyvarr[0]);
$ztlizz="#<a href='(.*?)' data-daochu=to=(.*?) class='js-link'><div class='w-newfigure-imglink g-playicon js-playicon'>#";
preg_match_all($ztlizz, $zylist,$zyliarr);
preg_match_all($qi, $zylist,$qiarr);
preg_match_all($zyimg, $zylist,$imgarr);
$zyvi=$zyliarr[1];
$noqi=$qiarr[1];
$zypic=$imgarr[1];
$zyname=$imgarr[2];
//print_r($zyvi);

$zcf = implode($glue, $tvarr[0]);
preg_match_all($tvzz1, $zcf, $tvarr1);

$b = $tvarr1[3];
$much = 1;
$mjk=$mkcms_mjk;

if (empty($c[0])){
$result = mysql_query('select * from mkcms_vod order by d_id asc');
		while ($row = mysql_fetch_array($result))
		{
if($timu==$row['d_name']){
	echo '<meta http-equiv = "refresh" content = "0;url='.$mkcms_domain.'bplay.php?play='.$row['d_id'].'">';
}
else{
if (empty($b[0]) and empty($zyvi[0]))	{
	alert_href('视频还没上映不能观看!',''.$mkcms_domain.'');
}
}
}
}
$d_scontent=explode(',',$mkcms_shoufei);
for($i=0;$i<count($d_scontent);$i++)
{
if($timu==$d_scontent[$i]){
//提示错误值
alert_href('对不起,您的观看的视频已经下架,请到官网观看.谢谢!',''.$mkcms_domain.'');	
     }	

}
if($mkcms_user==1){//开启收费模式
//判定会员是否登录
if(!isset($_SESSION['user_name'])){
		alert_href('请注册会员登录后观看',''.$mkcms_domain.'wap/login.php');
	};
//获取会员信息
 $result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');//查询会员积分
     if($row = mysql_fetch_array($result)){
     $u_points=$row['u_points'];//会员积分
     $u_plays=$row['u_plays'];//会员观看记录
     $u_end=$row['u_end'];//到期时间
	 $u_group=$row['u_group'];//会员组
     }	
//判断会员组
if ($u_group==1){
$d_cishu=explode(',',$u_plays);
for($i=0;$i<count($d_cishu);$i++)
{
$cishu=$i;
}
if ($cishu>=$mkcms_cishu){
	//大于免费观看次数出现此信息
	 alert_href('对不起,您的观看次数已经用完，请充值续费！',''.$mkcms_domain.'wap/user.php?op=open');	
}
else
//写入观看记录
{
 $uplays = $u_plays.",".$mkcmsid;	
 $uplays = str_replace(",,",",",$uplays);
 $_data['u_plays'] =$uplays;
 $sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
if (mysql_query($sql)) {
}
} 


}
//视频收费
	 
}
 ?>
