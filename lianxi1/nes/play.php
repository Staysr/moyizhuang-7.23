<?php
error_reporting(0);
$player = base64_decode($_GET['play']);
$tvinfo = file_get_contents($player);


$tvzz = '#<div class="num-tab-main g-clear\s*js-tab"\s*(style="display:none;")?>[\s\S]+?<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">[\s\S]+?</div>#';

//$tvzz1 = "#<a href='(.*?)' data-daochu=to=imgo class='js-link'><div class='w-newfigure-imglink g-playicon js-playicon'> <img src='(.*?)' data-src='(.*?)' alt='(.*?)'  /><span class='w-newfigure-hint'>(.*?)</span>#";
$tvzz1 = '#<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">#';
//$bflist = "#<a href='(.*?)' data-daochu=to=imgo class='js-link'#";
$bflist = '#<a data-daochu(.*?) href="(.*?)" class="js-site-btn btn btn-play">#';
$jianjie = '#<p class="item-desc js-open-wrap">(.*?)</p>#';
$biaoti = '#<h1>(.*?)</h1>#';

$pan = '#<h2 class="title g-clear">(.*?)</h2>#';
$pan1 = '#<h2 class="g-clear">(.*?)</h2>#';



$zytimu = '#<ul class="list w-newfigure-list g-clear">
                (.*?)
            </ul>#';
preg_match_all($jianjie, $tvinfo, $jjarr);
preg_match_all($tvzz, $tvinfo, $tvarr);

preg_match_all($pan, $tvinfo, $ptvarr);
preg_match_all($pan1, $tvinfo, $ptvarr1);
preg_match_all($bflist, $tvinfo, $tvlist);

preg_match_all($biaoti, $tvinfo, $btarr);
preg_match_all($zytimu, $tvinfo, $zybtarr);

$mvsrc = $tvlist[2][0];

$jian = $jjarr[1][0];
$timu = $btarr[1][0];


$panduan = $ptvarr[1][0];
$panduan1 = $ptvarr1[1][0];



$zybiaoti = $zybtarr[3][0];
$mvsrc1 = str_replace("http://cps.youku.com/redirect.html?id=0000028f&url=", "", "$mvsrc");
$zcf = implode($glue, $tvarr[0]);



preg_match_all($tvzz1, $zcf, $tvarr1);
if(empty($tvarr1[0][0]))
{
	$tvzz1 = "#<a href='(.*?)' data-daochu=to=(.*?) class='js-link'><div class='w-newfigure-imglink g-playicon js-playicon'> <img src='(.*?)' data-src='(.*?)' alt='(.*?)'  /><span class='w-newfigure-hint'>(.*?)</span>#";
	preg_match_all($tvzz1, $tvinfo, $tvarr1);
	
	
	$jishu = $tvarr1[5];
	$b = $tvarr1[1];
	
	
	$pan = "#<p class='title g-clear'><span class='s1'>(.*?)</span></p>#";
	$pan1 = "#<p class='title g-clear'><span class='s1'>(.*?)</span></p>#";
	preg_match_all($pan, $tvinfo, $ptvarr);
	preg_match_all($pan1, $tvinfo, $ptvarr1);
	$panduan = $ptvarr[1][0];
	$panduan1 = $ptvarr1[1][0];
	
	
	
	if(empty($tvarr1[0][0]))
	{
		$tvzz1 = '#<a data-num="(.*?)"data-daochu="to=(.*?)" href="(.*?)">(.*?)</a>#';
		preg_match_all($tvzz1, $tvinfo, $tvarr1);
		
		
		$jishu = $tvarr1[1];
		$b = $tvarr1[3];
		
		
		$pan = '#<h2 class="title g-clear"><em></em>(.*?)</h2>#';
		$pan1 = '#<h2 class="title g-clear"><em></em>(.*?)</h2>#';
		preg_match_all($pan, $tvinfo, $ptvarr);
		preg_match_all($pan1, $tvinfo, $ptvarr1);
		$panduan = $ptvarr[1][0];
		$panduan1 = $ptvarr1[1][0];
		
		
	}
	


}
else
{
	$jishu = $tvarr1[1];
	$b = $tvarr1[3];
}





$much = 1;
include ('./inc/aik.config.php');
include ('./inc/aik.adsconfig.php');

?>
<?php
$pizza = $adaik["qq_name"];
$pieces = explode("#", $pizza);
if (!empty($pizza) && in_array($timu, $pieces)) {
?><meta http-equiv=refresh content='0; url=404.php'><?php
	exit(0);
} else {
	echo "";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cache-control" content="no-siteapp">
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/play.css' type='text/css' media='all' />
<script type='text/javascript' src='http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>

<meta name="keywords" content="<?php 
echo $timu;
?>-播放页">
<title>正在播放-<?php 
echo $timu;
?>-<?php 
echo $aik['sitename'];
?></title>
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<style>
.w-newfigure{list-style:none; float:left;}
.list{ margin-left:-40px;}
</style>
<body class="page-template page-template-pages page-template-posts-play page-template-pagesposts-play-php page page-id-16">
<?php 
include 'header.php';
if($aik["allopen"] == 1 ) $auth=0; //zjpro 
?>
<div class="single-post">
<section class="container">
    <div class="content-wrap">
    	<div class="content">
<div class="asst asst-post_header"><?php echo $adaik['play_up']?></div>
<div class="sptitle"><h1><?php 
echo $timu;
?></h1></div>
<div id="bof">
</div>
<div class="am-cf"></div>
<div class="am-panel am-panel-default">
<div class="am-panel-bd">

<div class="bofangdiv">
<?php echo $adaik['play_ad']?>
<iframe id="video" src="/jiazai.php" style="width:100%;border:none"></iframe>
<a style="display:none" id="videourlgo" href=""></a>
</div>
<?php 

if($auth==0){?>
<div id="xlu">
<button onclick="xldata('<?php echo $aik['jiekou1'];?>')">线路一</button>
<button onclick="xldata('<?php echo $aik['jiekou2'];?>')">线路二</button>
<button onclick="xldata('<?php echo $aik['jiekou3'];?>')">线路三</button>
<button onclick="xldata('<?php echo $aik['jiekou4'];?>')">线路四</button>
<button onclick="xldata('<?php echo $aik['jiekou5'];?>')">线路五</button>
<button onclick="xldata('<?php echo $aik['jiekou6'];?>')">线路六</button>
<button onclick="xldata('<?php echo $aik['jiekou7'];?>')">线路七</button>
<button onclick="xldata('<?php echo $aik['jiekou8'];?>')">线路八</button>
<button onclick="xldata('<?php echo $aik['jiekou9'];?>')">线路九</button>
<button onclick="xldata('<?php echo $aik['jiekou10'];?>')">线路十</button>
</div>				
<?php } ?> 
	<script type="text/javascript">
function xldata(urls){
	var videourls = document.getElementById('video');
	var xlqieh = document.getElementById('videourlgo');
	videourls.src = urls+xlqieh.href;
}
</script>
<div style="clear: both;"></div> 
<div id="xuji"></div>
<div class="video-list view-font">
<script type="text/javascript">
	var al = $('.num-tab-main a');
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
	 if($("div").hasClass("js-tab-main")){ 
	var taba = $('.js-tab-main a');
	for(var g=0;g<taba.length;g++){
		taba.eq(g).attr('onclick','tabqh(\''+[g]+'\')');
	};
	var numtba = $('.num-tab .num-tab-main');
	for(var g=0;g<numtba.length;g++){
		numtba.eq(g).attr('id','num'+[g]);
	};
	document.getElementById('num1').style.display = 'block';
	function tabqh(ylen){
		var idylen = parseInt(ylen);
		var tabalen = $('.js-tab-main a').length;
		for (var xcyh=0;xcyh<tabalen;xcyh++) {
			document.getElementById('num'+xcyh).style.display = 'none';
		}
		document.getElementById('num'+idylen).style.display = 'block';
	}
	 }
</script>

<div class="dianshijua" id="dianshijuid">
<h3 class="single-strong">无需安装任何插件<font color="#ff6651">【点击选择选集才会播放哦！☟解析的接口是测试的时候可以播放 如果切换全部线路无法播放，反馈站长】</font></h3> 
<div class="top-list-ji">
    <h2 class="title g-clear"><em class="a-bigsite a-bigsite-leshi"></em></h2>
    <div class="ji-tab-content js-tab-content" style="opacity:1;">
<?php 

 
if (empty($panduan) && empty($panduan1)) {
    switch ($auth)
     {
     case 1:
        echo "<a href='javascript:;' class='action-rewards' etap='rewards'>";echo "$timu</a>";
       break;
     case 2:
        echo "<div onClick='auth()' class='lipbtn'>";echo "$timu</div>";
       break;
     default:
       echo "<a href='$mvsrc1' target='ajax'>";echo "$timu</a>";
    }
} else {
	$ggstr='';
	foreach ($b as $key => $video) {
		$mmm = $much++;
		$vd = $video;
		switch ($auth)
        {
           case 1:
			$ggstr.="<a href='javascript:;' class='action-rewards' etap='rewards'>"."$jishu[$key]</a>";
            // echo "<a href='javascript:;' class='action-rewards' etap='rewards'>";echo "$jishu[$key]</a>";
             break;
           case 2:
		   $ggstr.="<div onClick='auth()' class='lipbtn'>"."$jishu[$key]</div>";
            //echo "<div onClick='auth()' class='lipbtn'>";echo "$jishu[$key]</div>";
             break;
           default:
			if($jishu[$key]==1){$ggstr='';}
			$ggstr.="<a href='$vd' target='ajax'>"."$jishu[$key]</a>";
             //echo "<a href='$vd' target='ajax'>";echo "$jishu[$key]</a>";
        }
	}
	echo $ggstr;
	if (!empty($panduan1)) {
		echo "<ul class='list' style='display:block;'>";
	}
	echo "$zybiaoti</ul>";
}
?> 
</div>
</div>          
</div>
 </div>
<div style="clear: both;"></div>
<p class="jianjie"><h3 class="single-strong">简介</h3><p class="item-desc js-close-wrap" ><?php 
echo $jian;
?>
<div style="clear: both;"></div>
<h3 class="single-strong">猜你喜欢</h3>
<ul class="cainixihuan">
 <?php 
include './data/like.php';
?>
</ul>

<?php 
echo '</p>

<div style="clear: both;"></div>

';
echo $aik['changyan'];
?>


<div style="clear: both;"></div>
</div>



<script type="text/javascript">
	function bofang(mp4url,jiid){
		<?php if($auth==1){
		echo "var tishi = (".'"<a href=\'login.php\'>你还没有登录，请登录后进行播放!<span>立马登录</span></a>"'.");";
		}
		elseif($auth==2){
	    echo "var tishi = (".'"<a href=\'user/payvip.php\'>开通VIP会员，无限畅享本站影视!<span>立即开通</span></a>"'.");";	
		}else{
		echo "var tishi = ('如不能正常播放请更换播放线路');";	
		 } 
		?>
		document.getElementById('videourlgo').href=mp4url;
		document.getElementById('xuji').innerHTML = tishi;
		if(mp4url.indexOf('iqiyi')>=0){
			document.getElementById('video').src='<?php 
echo $aik['jiekou1'];
?>'+mp4url;
		}else if(mp4url.indexOf('qq')>=0){
			document.getElementById('video').src='<?php 
echo $aik['jiekou1'];
?>'+mp4url;
		}else if(mp4url.indexOf('sohu')>=0){
			document.getElementById('video').src='<?php 
echo $aik['jiekou1'];
?>'+mp4url;
		}else if(mp4url.indexOf('youku')>=0){
			document.getElementById('video').src='<?php 
echo $aik['jiekou1'];
?>'+mp4url;
		}else if(mp4url.indexOf('tudou')>=0){
			document.getElementById('video').src='<?php 
echo $aik['jiekou1'];
?>'+mp4url;
		}else if(mp4url.indexOf('le')>=0){
			document.getElementById('video').src='<?php 
echo $aik['jiekou1'];
?>'+mp4url;
		}else if(mp4url.indexOf('58')>=0 && mp4url.indexOf('58')<5 ){
			document.getElementById('video').src='<?php 
echo $aik['jiekou1'];
?>'+mp4url;
		}else{
			document.getElementById('video').src='<?php 
echo $aik['jiekou1'];
?>'+mp4url;
		};
		//点击之后
		document.getElementById('xuji').style.display='block';
		document.getElementById('video').style.display='none';
		document.getElementById('addid').style.display = 'block';
		document.getElementById('xlu').style.display = 'block';
		function test() {
			document.getElementById('video').style.display='block';
			document.getElementById('addid').style.display = 'none';
		}
		setTimeout(test, 5000);
	};
</script>



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

<script language="javascript"> 
function auth() { 
if (confirm("哎吆歪！会员过期了，去开通下!")) { 
  window.location.href="user/payvip.php";
} } 
</script> 
</div>
<div class="article-actions clearfix">
 <div class="shares">
        <strong>分享到：</strong>
        <a href="javascript:;" data-url="<?php echo $aik['pcdomain'];?>" class="share-weixin" title="分享到微信"><i class="fa"></i></a><a etap="share" data-share="qzone" class="share-qzone" title="分享到QQ空间"><i class="fa"></i></a><a etap="share" data-share="weibo" class="share-tsina" title="分享到新浪微博"><i class="fa"></i></a><a etap="share" data-share="tqq" class="share-tqq" title="分享到腾讯微博"><i class="fa"></i></a><a etap="share" data-share="qq" class="share-sqq" title="分享到QQ好友"><i class="fa"></i></a><a etap="share" data-share="renren" class="share-renren" title="分享到人人网"><i class="fa"></i></a><a etap="share" data-share="douban" class="share-douban" title="分享到豆瓣网"><i class="fa"></i></a>
    </div>   
</div> 
	
</div>
</div>
<?php 
include 'sidebar.php';
?>
</section>
</div>
<?php 
include 'footer.php';
?>
</body>
</html>