<?php  include 'head.php';?>
<title><?php echo $d_title;?></title>
<meta name="keywords" content="<?php echo $d_keywords;?>">
<meta name="description" content="<?php echo $d_description;?>">
<style type="text/css">
#timer{background: rgba(0, 0, 0, 0.59);padding: 5px;text-align: center;width: 30px;position: absolute;top: 5%;right: 2%;color: #fff;font-size: 16px;border-radius: 50%;height: 30px;line-height: 20px}
#xiang{background: rgba(177, 13, 13, 0.87);padding: 5px;text-align: center;width: auto;position: absolute;bottom: 2%;right: 1%;color: #fff;font-size: 16px;border-radius: 10px;height: 20px;line-height: 9px}
#ys {background: deepskyblue;color: black; }
.jkbtn{background: deepskyblue;color: black;}
#box,#box2,#box3,#box4{padding:6px;} 
#xlus{background: #000;padding: 2px 2px;text-align: center;margin-top: -4px;}
#xlus button{cursor: pointer;font-size: 12px;color: #fff;background: #000;text-align: center;padding: 5px 7px;margin: 4px;border-radius: 2px;border: 1px solid #eee;}

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
【<span style="color:red">播放提示</span>】：<label>如果好用请推荐给你的朋友！
</div>

<p id="pMain" style="display:none;border:1px solid #FFFFB9;background:#000006"> </p>
<div id="xlu">
<p id="box" style="display: none;">

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
        $("#shiping_box").html('<iframe allowFullscreen="true" src="<?php echo $mkcms_domain;?>jx/jx.php?url=<?php $result = mysql_query('select * from mkcms_vod where d_id ='.$d_id.'');
	if (!!$row = mysql_fetch_array($result)){
$d_scontent=explode("\r\n",$row['d_scontent']);
//print_r($d_scontent);
for($i=0;$i<count($d_scontent);$i++)
{	$d_scontent[$i]=explode('|',$d_scontent[$i]);
		}
	echo $d_scontent[0][1];
	}else{
		return '';
	};?><?php $result = mysql_query('select * from mkcms_vod where d_id ='.$d_id.'');
	if (!!$row = mysql_fetch_array($result)){
$d_scontent=explode("\r\n",$row['d_scontent']);
//print_r($d_scontent);
for($i=0;$i<count($d_scontent);$i++)
{	$d_scontent[$i]=explode('$',$d_scontent[$i]);
		}
	echo $d_scontent[0][1];
	}else{
		return '';
	};?>" id="video" style="width:100%;border:none" allowtransparency="true" allowfullscreen="true" frameborder="0" scrolling="no"></iframe>');  
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
<h4 class="title" id="xuji">正在播放：<?php echo $d_name; ?><span class="js"></span></h4>
<p class="data margin-0 ">

<a class="detail-more" href="javascript:;">详情 <i class="icon iconfont icon-moreunfold"></i></a>
</p>
<div class="detail-content" style="display: none;">

<p class="desc margin-0"><span class="left text-muted">简介：</span><?php echo $d_content; ?></p>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box">
<div class="stui-pannel_hd">
<div class="stui-pannel__head bottom-line active clearfix">
<span class="more text-muted pull-right">无需安装任何插件，即可快速播放</span>
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_7.png">播放列表</h3>
</div>
</div>
<style>

@media (max-width: 767px){.stui-content__playlist.column10 .dyli {width: 30%;margin: 0px 3px;padding: 0px 0px;}}
@media (min-width: 768px){.stui-content__playlist.column10 .dyli {width: 11%;margin: 0px 3px;padding: 0 0px;}}
@media (max-width: 767px){.stui-content__playlist.column10 .zyli {width: 50%;} #dianshijuid img {height: 87px;border-radius: 5px;}}
@media (min-width: 768px){.stui-content__playlist.column10 .zyli {width: 20%;} #dianshijuid img {height: 96px;border-radius: 5px;}}
.stui-vodlist__box img {border-radius: 5px;}
</style>
<div class="stui-pannel_bd col-pd clearfix dianshijua" id="dianshijuid">
<ul class="stui-content__playlist column10 clearfix">
<?php $result = mysql_query('select * from mkcms_vod where d_id ='.$d_id.'');
	if (!!$row = mysql_fetch_array($result)){
$d_scontent=explode("\r\n",$row['d_scontent']);
//print_r($d_scontent);
for($i=0;$i<count($d_scontent);$i++)
{	$d_scontent[$i]=explode('$',$d_scontent[$i]);
if($d_scontent[$i][1]!=""){
	echo'<li><a href="'.$mkcms_domain.'jx/jx.php?url='.$d_scontent[$i][1].'" target="ajax" id="'.$d_scontent[$i][0].'">'.$d_scontent[$i][0].'</a></li>';
}
	}
	}else{
		return '';
	};?>


</ul>
</div>
</div>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<h3 class="title"><img src="http://v.wslmf.com/template/jingpin/img/icon_12.png">影片评论</h3>
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
</div>

</div>
</div>
<script type="text/javascript">
	var al = $('.dianshijua a');
	al.attr('class','am-btn am-btn-default lipbtn');
	var ji= new Array();
	var btnji= new Array();
	
	for(var g=0;g<al.length;g++){
		ji.push(al[g].href);
		btnji.push(al[g].id);
		
		al[g].href = 'javascript:void(0)';
		al[g].target = '_self';
		al.eq(g).attr('onclick','bofang(\''+ji[g]+'\',\''+btnji[g]+'\')');
	};
</script>
<script type="text/javascript">
var tishi = ('正在为您播放<?php echo $d_name; ?>');
document.getElementById('xuji').innerHTML = tishi;
	function bofang(mp4url,jiid){
		var tishi = ('正在为您播放<?php echo $d_name; ?> '+jiid+'');
		document.getElementById('xuji').innerHTML = tishi;
		document.getElementById('video').src=''+mp4url;
		
		
				//点击之后
document.getElementById('xuji').style.display='block';
document.getElementById('video').style.display='none';
function test() {
			document.getElementById('video').style.display='block';
			
		}
		setTimeout(test, 0);
	};
</script>

<?php include 'footer.php'; ?>