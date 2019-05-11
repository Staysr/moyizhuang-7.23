<?php
error_reporting(0); 
$movie="";
$tv="";
$dm="";
$zy="";
$result = mysql_query('select * from mkcms_system where id = 1');
$row = mysql_fetch_array($result);
$mkcms_domain = $row['s_domain'];
$mkcms_name = $row['s_name'];
$mkcms_seoname = $row['s_seoname'];
$mkcms_keywords = $row['s_keywords'];
$mkcms_description = $row['s_description'];
$mkcms_copyright = $row['s_copyright'];
$mkcms_cache = $row['s_cache'];
$mkcms_wei = $row['s_wei'];
$mkcms_user = $row['s_user'];
$mkcms_logo = $row['s_logo'];
$mkcms_weixin = $row['s_weixin'];
$mkcms_dashang = $row['s_dashang'];
$mkcms_mjk = $row['s_mjk'];
$mkcms_jiekou = $row['s_jiekou'];
$mkcms_changyan = $row['s_changyan'];
$mkcms_qqun = $row['s_qqun'];
$mkcms_token= $row['s_token'];
$mkcms_bdyun= $row['s_bdyun'];
$mkcms_tongji= $row['s_tongji'];
$mkcms_qianxian= $row['s_qianxian'];
$mkcms_dianying= $row['s_dianying'];
$mkcms_dianshi= $row['s_dianshi'];
$mkcms_zongyi= $row['s_zongyi'];
$mkcms_dongman= $row['s_dongman'];
$mkcms_tuiguang= $row['s_tuiguang'];
$mkcms_shoufei= $row['s_shoufei'];
$mkcms_cishu= $row['s_cishu'];
$mkcms_pc= $row['s_pc'];
$mkcms_hong= $row['s_hong'];
$mkcms_gonggao= $row['s_gonggao'];
$mkcms_bofang= $row['s_bofang'];
$mkcms_guanzhu= $row['s_guanzhu'];
$mkcms_fengmian= $row['s_fengmian'];
$mkcms_mail= $row['s_mail'];
$mkcms_smtp= $row['s_smtp'];
$mkcms_muser= $row['s_muser'];
$mkcms_mpwd= $row['s_mpwd'];
$mkcms_wappid= $row['s_wappid'];
$mkcms_wkey= $row['s_wkey'];
$mkcms_alipay= $row['s_alipay'];
$mkcms_appid= $row['s_appid'];
$mkcms_appkey= $row['s_appkey'];
$mkcms_tixing= $row['s_tixing'];
$mkcms_appewm= $row['s_appewm'];
$mkcms_appbt= $row['s_appbt'];
$mkcms_apppic= $row['s_apppic'];
$mkcms_appurl= $row['s_appurl'];
$mkcms_gg= $row['s_gg'];
$mkcms_hctime= $row['s_hctime'];
$mkcms_beijing= $row['s_beijing'];
$mkcms_dianyingnew= $row['s_dianyingnew'];
$mkcms_dongmannew= $row['s_dongmannew'];
$mkcms_zongyinew= $row['s_zongyinew'];
$mkcms_zhifu= $row['s_zhifu'];
$mkcms_tuijian= $row['s_tuijian'];
$mkcms_wxguanzhu= $row['s_wxguanzhu'];
$mkcms_smsname= $row['s_smsname'];
$mkcms_smspass= $row['s_smspass'];
$mkcms_miaoshu= $row['s_miaoshu'];
$real_domain= $row['s_shouquan'];
$mkcms_hz= $row['s_hz'];
$mkcms_yq= $row['s_yq'];
//广告获取
function get_ad($t0){
	$result = mysql_query('select * from mkcms_ad where catid ='.$t0.'');
	if (!!$row = mysql_fetch_array($result)){
return $row['pic'];
	}else{
		return '';
	};
}

function curl_file_get_contents($durl){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $durl);
   curl_setopt($ch, CURLOPT_TIMEOUT, 5);
   curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
   curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $r = curl_exec($ch);
   curl_close($ch);
    return $r;
 }

?>
