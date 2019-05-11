<?php  include 'head.php';?>
<title><?php echo $timu; ?>-正在播放-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $timu; ?>,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $timu; ?>,<?php echo $mkcms_description;?>">
<style type="text/css">
#timer{background: rgba(0, 0, 0, 0.59);padding: 5px;text-align: center;width: 30px;position: absolute;top: 5%;right: 2%;color: #fff;font-size: 16px;border-radius: 50%;height: 30px;line-height: 20px}
#xiang{background: rgba(177, 13, 13, 0.87);padding: 5px;text-align: center;width: auto;position: absolute;bottom: 2%;right: 1%;color: #fff;font-size: 16px;border-radius: 10px;height: 20px;line-height: 9px}
#ys {background: deepskyblue;color: black; }

#box,#box2,#box3,#box4{padding:6px;} 
#xlus{background: #000;padding: 2px 2px;text-align: center;margin-top: -4px;}
#xlus a{cursor: pointer;font-size: 12px;color: #fff;background: #000;text-align: center;padding: 5px 7px;margin: 4px;border-radius: 2px;border: 1px solid #eee;}
.jkbtn{background: deepskyblue;color: black;}
</style>

</head>
<body>
<?php include 'header.php'; ?>
<div class="pageLoading">
	<div class="monster">
		<div class="eye">
			<div class="eyeball"></div>
		</div>
		<div class="mouth"></div>
	</div>
	<div class="loading">
		<div class="bar"></div>
	</div>
</div><div class="container">
<div class="row">
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box"><div class="stui-pannel-bd">
<div class="stui-player col-pd">
<div class="notes" style="border: 1px solid #E6D8B9;background:#FEFFE6;color: #080;line-height: 20px;padding: 5px 10px;margin-bottom:10px;">
【<span style="color:red">播放提示</span>】：<label>如果无法播放请点此<a href="###" style="color:red" onclick="openShutManager(this,box)">&nbsp;切换线路&nbsp;</a><span class="hidden-xs">，如果还是不行,请点击☞<a href="#" style="color:red">报错</a>，好用请推荐给你的朋友！</span></label>
</div>
<p id="pMain" style="display:none;border:1px solid #FFFFB9;background:#000006"> </p>
<div id="xlus">
<p id="box" style="display: none;">
<?php if($mjk!=""){ ?><a onclick="xldata(this)" data-jk="<?php echo $mjk; ?>">默认</a><?php } ?>  
<?php

$jkjk=explode("\r\n",$mkcms_jiekou);
for($k=0;$k<count($jkjk);$k++){
$jkjk[$k]=explode('$',$jkjk[$k]);
echo '<a onclick="xldata(this)" data-jk="'.$jkjk[$k][1].'">'.$jkjk[$k][0].'</a>  ';
}
?>
</div>
<div class="stui-player__video embed-responsive embed-responsive-16by9 clearfix">
<div id="cc1play" style="height:0px; width:0px;display:none;wiidth:100%px;heiight:600px;"></div>
<div id="shiping_box"></div>
<script type="text/javascript"> 

          function run(){
        var s = document.getElementById("timer");      
        if(!s){          
            return false;
        }else{
          s.innerHTML = s.innerHTML * 1 - 1;
        }
        
    }
    window.setInterval("run();", 1000);
	$('#shiping_box').html('<div style="text-align:center;width:100%;"><?php echo get_ad(1)?></div><div id="timer"><?php echo $mkcms_miaoshu;?></div>');
    //设置延时函数
    function adsUp(){    
        $("#shiping_box").html('<iframe id="video" src="<?php
if (empty($panduan) && empty($panduan1)) {
	 $dyurl = str_replace('http://cps.youku.com/redirect.html?id=0000028f&url=', '', "$c[0]");
	echo"$mjk$dyurl";
}

 else{
	 if(!empty($b[0])){echo "$mjk$b[0]";}
	 
	 else{
		 echo"$mjk$zyvi[1]";
		 }
	 }
	 ?>"  allowfullscreen="true" allowtransparency="true" style="width:100%;border:none"></iframe>');  
    }
    //五秒钟后自动收起
    var t = setTimeout(adsUp,<?php echo $mkcms_miaoshu*1000;?>); 
    
</script>
</div>
<script type="text/javascript">
//===========================点击展开关闭效果====================================
function openShutManager(oSourceObj,oTargetObj,shutAble,oOpenTip,oShutTip){
var sourceObj = typeof oSourceObj == "string" ? document.getElementById(oSourceObj) : oSourceObj;
var targetObj = typeof oTargetObj == "string" ? document.getElementById(oTargetObj) : oTargetObj;
var openTip = oOpenTip || "";
var shutTip = oShutTip || "";
if(targetObj.style.display!="none"){
   if(shutAble) return;
   targetObj.style.display="none";
   if(openTip  &&  shutTip){
    sourceObj.innerHTML = shutTip; 
   }
} else {
   targetObj.style.display="block";
   if(openTip  &&  shutTip){
    sourceObj.innerHTML = openTip; 
   }
}
}
</script>
<div style="clear: both;"></div> 
<div class="video-list view-font">
</div>	
<div class="stui-player__detail detail">
<span class="bdsharebuttonbox hidden-md hidden-sm hidden-xs pull-right">
<span class="bds_shere"></span>
<a class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a><a class="bds_tqf" data-cmd="tqf" title="分享到腾讯朋友"></a><a class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a><a class="bds_more" data-cmd="more" title="更多"></a></span>
<h4 class="title" id="xuji">正在播放：<?php echo $timu; ?><span class="js"></span></h4>
<p class="data margin-0 ">
<span class="text-muted ">类型：</span>&nbsp;&nbsp;<span class="split-line"></span><span class="text-muted hidden-xs ">地区：</span>
<span class="split-line"></span><span class="text-muted hidden-xs ">年份：</span>
<a href="#"></a>
<span class="split-line"></span>
<a class="detail-more" href="javascript:;">详情 <i class="icon iconfont icon-moreunfold"></i></a>
</p>
<div class="detail-content" style="display: none;">
<p class="data "><span class="text-muted">主演：</span>  </p>
<p class="data "><span class="text-muted">导演：</span>  </p>

<p class="desc margin-0"><span class="left text-muted">简介：</span><?php echo $jian; ?></p>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box">
<style>
@media (max-width: 767px){.stui-content__playlist.column10 .dyli {width: 30%;margin: 0px 3px;padding: 0px 0px;}}
@media (min-width: 768px){.stui-content__playlist.column10 .dyli {width: 11%;margin: 0px 3px;padding: 0 0px;}}
@media (max-width: 767px){.stui-content__playlist.column10 .zyli {width: 50%;} #dianshijuid img {height: 87px;border-radius: 5px;}}
@media (min-width: 768px){.stui-content__playlist.column10 .zyli {width: 20%;} #dianshijuid img {height: 96px;border-radius: 5px;}}
.stui-vodlist__box img {border-radius: 5px;}
</style>
<?php
if (empty($panduan) && empty($panduan1)) {
	echo '<div class="stui-pannel_hd">
<div class="stui-pannel__head bottom-line active clearfix">
<span class="more text-muted pull-right">无需安装任何插件，即可快速播放</span>
<h3 class="title"><img src="'.$mkcms_domain.'moban/'.$mkcms_bdyun.'/img/icon_7.png">播放列表</h3>
</div>
</div>
<div class="stui-pannel_bd col-pd clearfix dianshijua" id="dianshijuid">
<ul class="stui-content__playlist column10 clearfix">
';
	foreach ($c as $kk => $vod) {
    $dyurl = str_replace('http://cps.youku.com/redirect.html?id=0000028f&url=', '', "$vod");
	$dyname = str_replace('付费', '免费', "$d[$kk]");
		//echo $much++;
		//echo $video.'<br/>';
		//echo $key.'<br/>';
		echo "<li class='dyli'><a href='$dyurl' id='' target='ajax'>";
		echo "$dyname</a></li>";
	}
echo '</ul>
</div>';
} else {
	$i=0;
	foreach ($yuan as $vv => $ly) {

		//echo $much++;
		//echo $video.'<br/>';
		//echo $key.'<br/>';
echo '
<div class="stui-pannel_hd">
<div class="stui-pannel__head bottom-line active clearfix">
<span class="more text-muted pull-right">无需安装任何插件，即可快速播放</span>
<h3 class="title"><img src="'.$mkcms_domain.'moban/'.$mkcms_bdyun.'/img/icon_7.png">'.unicode_decode("$yuanname[$vv]").'播放列表</h3>
</div>
</div>
';
					
echo '<div class="stui-pannel_bd col-pd clearfix dianshijua" id="dianshijuid">
<ul class="stui-content__playlist column10 clearfix">';		

 $site = $ly;
  $id=$mkcmsid;
  if ($mkcmstyle==tv){
  $category="2";
  }
  else{
 $category="4";
	  }
  $url = "http://www.360kan.com/cover/switchsite?site=".$site."&id=".$id."&category=".$category;
  $html = curl_file_get_contents($url);
  $data=json_decode($html);
  
 $tvzz='#<div class="num-tab-main g-clear\s*js-tab"\s*(style="display:none;")?>[\s\S]+?<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">[\s\S]+?</div>#';
   $tvzz1 = '#<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">#';
   preg_match_all($tvzz, $data, $tvarr);
   $zcf = implode($glue, $tvarr[0]);
  preg_match_all($tvzz1,  $zcf, $tvarr);
  $b = $tvarr1[3];
  $yeshu=$tvarr1[1];

	foreach ($b as $yy => $tvurl) {
		echo "<li><a data-num='$yeshu[$yy]' href='$b[$yy]' class='btn-play-source'>";
		echo '第'.$yeshu[$yy].'集</a></li>';

	}

echo '</ul>
</div>';
$i ++;}

if (!empty($panduan1)){ 
		
	echo '<div class="stui-pannel_hd">
<div class="stui-pannel__head bottom-line active clearfix">
<span class="more text-muted pull-right">无需安装任何插件，即可快速播放</span>
<h3 class="title"><img src="'.$mkcms_domain.'moban/'.$mkcms_bdyun.'/img/icon_7.png">播放列表</h3>
</div>
</div>
<div class="stui-pannel_bd col-pd clearfix dianshijua" id="dianshijuid">
<ul class="stui-content__playlist column10 clearfix">
';
foreach ($zyvi as $keya=>$tvideoa){
 			
		echo "<li class='zyli'><a data-num='$noqi[$keya]' href='$tvideoa' class='btn btn-danger 1'><img src='$zypic[$keya]' width=100%/><br>$noqi[$keya]<br>$zyname[$keya]</a></li>";
    	
		
		}
		echo '</ul>
</div>';
						}
}
?>

</div>
</div>
<script>
 $(function () {
	               $.each($('.dianshijua'),function () {
		             var al = $('.stui-content__playlist a');
	                al.attr('class','am-btn am-btn-default lipbtn');
	   });
                    $.each($('.lipbtn'),function () {
                        var url = $(this).attr('href');
                        $(this).attr('data-href',url);
                        $(this).attr('href','javascript:;');
                        $(this).attr('onclick','bofang(this)');
                    });
                    var biaoti = $('#xuji').text();
                    $('title').text(biaoti);
                    $('#box').children('a:eq(0)').addClass('jkbtn');
                    var autourl = $('.lipbtn:eq(0)').attr('data-href');
                    $('.lipbtn:eq(0)').attr('id','ys');
                    var text = $('.lipbtn:eq(0)').text();
                    $('.js').text('-'+text+'');
                    var jiekou = $('#box').children('a:eq(0)').attr('data-jk');
                    if(autourl!=''||autourl!=null){
                        setTimeout(function () {
                            $('#video').attr('src', jiekou + autourl);
                        },0)
                    }
					    // 上一集
    $("#btn-pre").click(function() {
        $("#ys.btn-play-source").prev().click();
    });
    
    // 下一集
    $("#btn-next").click(function() {
        $("#ys.btn-play-source").next().click();
    });
					    // 上一集
    $("#btn-pre1").click(function() {
        $("#ys.btn-play-source").prev().click();
    });
    
    // 下一集
    $("#btn-next1").click(function() {
        $("#ys.btn-play-source").next().click();
    });
                })
            </script>
            <script>
                function bofang(obj) {
                    var href = $(obj).attr('data-href');
                    var text = $(obj).text();
                    $('.js').text('-' + text+'');
                    $.each($('.lipbtn'), function () {
                        $(this).attr('id','');
                    });
                    $(obj).attr('id','ys');
                    var jiekou = $('.jkbtn').attr('data-jk');
                    if (href != '' || href != null) {
                        setTimeout(function () {
                            $('#video').attr('src', jiekou + href);
                        },0)
                    }
                }
                function xldata(obj) {
                    var url = $(obj).attr('data-jk');
                    $.each($('.jkbtn'), function () {
                        $(this).removeClass('jkbtn');
                    });
                    $(obj).addClass('jkbtn');
                    var src = $('#ys').attr('data-href');
                    $('#video').attr('src', url + src);
                }
		
			
            </script>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_12.png">影片评论</h3>
</div>
</div>
<div class="stui-pannel_bd">
<ul class="stui-vodlist__bd clearfix">
<div id="cyEmoji" role="cylabs" data-use="emoji"></div>
<script type="text/javascript" charset="utf-8" src="https://changyan.itc.cn/js/lib/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="https://changyan.sohu.com/js/changyan.labs.https.js?appid=cytlgnLlm"></script></ul>
</div>
</div>
</div>				
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_6.png">猜你喜欢</h3>
</div>
</div>
<ul class="stui-vodlist__bd clearfix">
<?php include 'data/like2.php'; ?>
</ul>
</div>
</div>
</div></div>
</div>
<?php include 'footer.php'; ?>