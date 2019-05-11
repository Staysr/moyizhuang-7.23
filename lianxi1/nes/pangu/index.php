<?php

//-----------------------------------------------------------
//index播放文件请勿修改，因修改此文件造成无法解析概不负责！
//-----------------------------------------------------------

//判断当前环境是否与本版本解析兼容
if(version_compare(PHP_VERSION,'5.4.0','<')){exit('请升级当前PHP环境,本版本解析需PHP5.4以上版本支持！');}
//文件名称
define('SELF', pathinfo(__file__, PATHINFO_BASENAME));
// 网站根目录
define('FCPATH', str_replace("\\", "/", str_replace(SELF, '', __file__)));
//加载配置文件
require_once FCPATH . 'config.php';
//接收参数
@$url = htmlspecialchars($_GET['url'] ? $_GET['url'] : $_GET['vid']);
if (empty($url))
{
		exit('URL地址不能为空~!');
}
if(strstr($url,'miguvideo.com')==true)
{
    preg_match('|cid=(\d+?)|U',$url,$cid);
    $url=$cid['1'].'@miguvideo';
}
$a=new __abose();
$url = $a->get_key($url, 'E', 'Leuqugirl');
$us_lotime=0;
//防盗链判断
if (!$a->is_referer()){if(USER_LOTIME ==''|| USER_LOLINK==''){header('HTTP/1.1 403 Forbidden');exit(ERROR);}else{$us_lotime='1';}}
//用户验证
$c_to_yz=$a->xxtea_encrypt(C_ROOT_TOKEN,C_ROOT_KEY);
//缓存文件~请确认是否有权限创建文件
if (!is_dir('cache/')) mkdir('cache/'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/> 
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=11"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=USER_TITLE?USER_TITLE:'_云解析系统_';?></title>
<style type="text/css">body,html,.content{background-color:black;padding: 0;margin: 0;width:100%;height:100%;color:#999;}.divs{width:100%;height:auto;position:fixed;left:0;top:0;z-index:999}</style>
<script type="text/javascript" src="https://apps.bdimg.com/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="<?=$user['path'];?>/ckplayer/ckplayer.js?v=1.1.1"></script>
</head>
<body style="overflow-y:hidden;">
<div id="loading" align="center"><strong><br><br><br><br><br><span class="tips">服务器正在解析中,请稍等....<font class="timemsg">0</font>s</span></strong><span class="timeout" style="display:none;color:#f90;">解析响应超时，请刷新重试！</span></div>
<input type="hidden" id="k1" value='<?= time(); ?>'/>
<div id="a1" class="content" style="display:none;"></div>
<div id="error" class="content" style="display:none;font-weight:bold;padding-top:90px;" align="center"></div>
<script type="text/javascript">
function tipstime(count){
    $('.timemsg').text(count);
    if (count == 20) {
       $('.tips').hide();
       $('.timeout').show();
    } else {
        count += 1;
        setTimeout(function () {
            tipstime(count);
        }, 1000);
    }
}
tipstime(0);
/*(*^__^*)*/<?=$a->jsencode('fuck = \''.$c_to_yz.'\';')?>
skin={'skin':'<?=$user['skin']?>','hand':'<?=$user['hand']?>','logo':'<?=$user['cklogo']?>','href':'<?=$user['ckhref']?>','font':'<?=$user['ckfont']?>','dp':'<?=$user['dplayer']?>','expire':'<?=$user['danmaku']?>','id':'<?=C_ROOT_ID?>'},site_domaim=function(){var path=window.location.pathname;if(path.indexOf(".")>-1){var i=path.lastIndexOf("/");var path=path.substring(0,i+1);}return path;}();ver='<?=base64_encode(VERSION)?>';auto='<?=USER_AUTO=="1"?1:0;?>';auto_h5='<?=USER_AUTO_H5=="1"?1:0;?>';var str_href=window.location.href,other_l =str_href.substring(str_href.indexOf('=')+1);if(!other_l){var other_l='kkkk';};
function player(){var isiPad=navigator.userAgent.match(/iPad|iPhone|Android|Linux|iPod/i)!=null;if(isiPad){var form='1';}
$.post("api.php",{'url':'<?php echo $url; ?>','referer':'<?=base64_encode(@$_SERVER['HTTP_REFERER']);?>','ref':form,'time':'<?= time() ?>','type':'<?=htmlspecialchars(@$_REQUEST['type']);?>','other':y.base64_encode(other_l),'key':key,'t':cip,'times':B,'uuid':A,'tip':C,'tips':tips,'k1':k1,'fuck':fuck},function(data){if(data.code=="200"){if(data.play=="lication"){play={url:decodeURIComponent(lequgirl(data.url,data.utd))};eval("parse."+data.list+".parser(play)")}else{if(data.play=="dplayer"){parse.h5play.dplayer_play(decodeURIComponent(lequgirl(data.url,data.utd)),data.type,form)}else{if(isiPad&&data.msg=="h5"){if(data.list=='sohu'){parse.setimg(data.play)};$("#a1").html('<video src="'+lequgirl(data.url,data.utd)+'" controls="controls" <?=USER_AUTO_H5=='1'?'autoplay="autoplay"':'';?> preload="preload" poster="'+site_domaim+'loading_wap.gif" width="100%" height="100%"></video>')}else{if(data.type=="m3u8"){var flashvars={f:"<?=$user['path'];?>/ckplayer/m3u8.swf",a:lequgirl(data.url,data.utd),c:0,s:4,lv:data.live,p:auto,v:100}}else{if(data.type=="mp4"){var flashvars={f:lequgirl(data.url,data.utd),c:0,s:0,p:auto,v:100,h:3}}else{if(data.type=="xml"){var flashvars={f:lequgirl(data.url,data.utd),c:0,s:2,p:auto,v:100,h:3}}}}var params={bgcolor:"#FFF",allowFullScreen:true,allowScriptAccess:"always",wmode:"transparent"};CKobject.embedSWF("<?=$user['path'];?>/ckplayer/ckplayer.swf","a1","ckplayer_a1","100%","100%",flashvars,params)}}}$("#loading").hide();$("#a1").show()}else{$("#loading").hide();$("#a1").hide();$("#error").show();$("#error").html(data.msg)};if(data.code=='500'&&data.mode=='1'){$("#a1").html('<iframe frameborder=0  marginheight=0 marginwidth=0 scrolling=no src="'+(data.url+data.play)+'" width="100%" height="100%" allowfullscreen="true"></iframe>');$("#error").hide();$("#loading").hide();$("#a1").show()}parse.sync(data.sync.op,data.sync.open,data.sync.time,data.sync.setime,data.utid)},"json")}
function getcip(){$.get("https://data.video.iqiyi.com/v.f4v",function(cdnip){sip=cdnip.match(/\d+\.\d+\.\d+\.\d+/);cip=sip[0];player();});}<?php if(USER_AD!=''){$ad=explode(',',USER_AD);$ads='';foreach($ad as $i =>$value){$ads.='document.writeln("<script type=\'text/javascript\' src=\'//'.$value.'\'><\/script>");';}echo $ads;}?>domain='cdn.qipacao.com';document.writeln("<script type='text/javascript' src='//"+window.location.host+site_domaim+"dplayer/dplayer.js?v=1.2.7'><\/script>");</script><?php if(USER_TONGJI!=''){$tongji='<div style="display:none"><script type="text/javascript">var cnzz_s_tag = document.createElement("script");cnzz_s_tag.type = "text/javascript";cnzz_s_tag.async = true;cnzz_s_tag.charset = "utf-8";cnzz_s_tag.src = "//'.USER_TONGJI.'&async=1";var root_s = document.getElementsByTagName("script")[0];root_s.parentNode.insertBefore(cnzz_s_tag, root_s);</script></div>';echo $tongji;}else{echo "<script type='text/javascript'>var nometa = document.createElement('meta');nometa.name = 'referrer',nometa.content='never';document.getElementsByTagName('head')[0].appendChild(nometa);</script>";}if($us_lotime=='1'){echo '<script type="text/javascript">setTimeout(function (){window.location.href="'.USER_LOLINK.'";},'.(USER_LOTIME*1000).'); </script>';}?></body></html>