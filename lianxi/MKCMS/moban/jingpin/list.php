<?php  include 'head.php';?>
<title><?php if ($_GET['type']=='movie'){echo "看电影-2018最新好看的最新电影";}elseif ($_GET['type']=='tv'){echo "追热剧-最新电视剧-好看电视剧-最新电视剧排行";}elseif ($_GET['type']=='dm'){echo "动漫列表";}elseif ($_GET['type']=='zy'){echo "综艺列表";}?>-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php if ($_GET['type']=='movie'){echo "看电影-2018最新好看的最新电影";}elseif ($_GET['type']=='tv'){echo "追热剧-最新电视剧-好看电视剧-最新电视剧排行";}elseif ($_GET['type']=='dm'){echo "动漫列表";}elseif ($_GET['type']=='zy'){echo "综艺列表";}?>,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
<div class="row">
<!-- 幻灯片 -->
<?php echo get_ad(9)?>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box">
<div class="stui-pannel_hd">
<div class="stui-pannel__head active bottom-line clearfix">

<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_25.png"><?php if ($_GET['type']=='movie'){echo "电影";}elseif ($_GET['type']=='tv'){echo "电视";}elseif ($_GET['type']=='dm'){echo "动漫";}elseif ($_GET['type']=='zy'){echo "综艺";}?>频道</h3>
</div>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted">按剧情</span></li>
<?php 
$response0 = str_replace('<a "',"<li><a ",$response0);
$response0 = str_replace('</a>',"</a></li> ",$response0);
echo $response0;?> 
</ul>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted"><?php if ($_GET['type']=='zy'){echo "按明星";}else{echo "按年份";}?></span></li>
<?php if($_GET['type']=='zy'){echo 
$response2 = str_replace('<a "',"<li><a ",$response2);
$response2 = str_replace('</a>',"</a></li> ",$response2);
$response2;}else{echo 
$response = str_replace('<a "',"<li><a ",$response);
$response = str_replace('</a>',"</a></li> ",$response);
$response;}?>
</ul>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted">按地区</span></li>
<?php 
$response1 = str_replace('<a "',"<li><a ",$response1);
$response1 = str_replace('</a>',"</a></li> ",$response1);
echo $response1?>
</ul>
</div>

 <div class="stui-pannel stui-pannel-bg clearfix"> 
   <div class="fed-screen-list fed-layout fed-bgc-white fed-row"> 
    <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4"> 
     <dt>
      按剧情
     </dt> 

<?php 
$response0= str_replace('<a ',"<dd><a ",$response0);
$response0= str_replace('</a>',"</a></dd>",$response0);
echo $response0?>

    </dl> 
    <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4"> 
     <dt>
<?php if ($_GET['type']=='zy'){echo "按明星";}else{echo "按年份";}?>
     </dt> 

<?php if($_GET['type']=='zy'){
$response2= str_replace('<a ',"<dd><a ",$response2);
$response2= str_replace('</a>',"</a></dd>",$response2);
	echo $response2;}else{
$response= str_replace('<a ',"<dd><a ",$response);
$response= str_replace('</a>',"</a></dd>",$response);
	echo $response;}?>
 
	 
    </dl> 
    <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4 fed-hide-sm fed-show-md-block"> 
     <dt>
      按地区
     </dt> 

<?php 
$response1= str_replace('<a ',"<dd><a ",$response1);
$response1= str_replace('</a>',"</a></dd>",$response1);
echo $response1?>

    </dl> 
   </div> 
  </div>
<div class="stui-pannel_hd">
<div class="stui-pannel__head active bottom-line clearfix">
<span class="more text-muted pull-right hidden-xs">千万部VIP视频免费等你观看</span>
<ul class="nav nav-head">
					<li <?php if ($ye=="rankhot"){echo 'class="active"';}elseif($ye=="createtime" or $ye=="rankpoint"){}else{ echo 'class="active"';};?>>
					<a href="./list.php?type=<?php echo $type?>&cat=<?php echo $cat?>&area=<?php echo $area?>&act=<?php echo $act?>&year=<?php echo $year?>&rank=rankhot">按最热</a></li>
					<li <?php if ($ye=="createtime"){echo 'class="active"';}else{};?>>
					<a href="./list.php?type=<?php echo $type?>&cat=<?php echo $cat?>&area=<?php echo $area?>&act=<?php echo $act?>&year=<?php echo $year?>&rank=createtime">按最新</a></li>
					<li <?php if ($ye=="rankpoint"){echo 'class="active"';}else{};?>>
					<a href="./list.php?type=<?php echo $type?>&cat=<?php echo $cat?>&area=<?php echo $area?>&act=<?php echo $act?>&year=<?php echo $year?>&rank=rankpoint">按好评</a></li>
</ul>
</div>
</div>

<div class="stui-pannel_bd">
<ul class="stui-vodlist clearfix">
 <?php
foreach ($xname as $key=>$xvau){ $do=$xlist[$key]; 
$do1=$do; 
$cc="./play.php?play="; 
if ($mkcms_wei==1){
$ccb=vod.$do1;
}
else{
$ccb=$cc.$do1;	
}

echo "<li class='col-md-6 col-sm-4 col-xs-3'>
<div class='stui-vodlist__box'>
<a class='stui-vodlist__thumb lazyload' href='".$ccb."' title='".$xvau."' data-original='".$ximg[$key]."' >
<span class='play hidden-xs'></span>
                            
<span class='pic-text text-right'>".$xjishu[$key]."</span></a>
<div class='stui-vodlist__detail'>
<h4 class='title text-overflow'><a href='".$ccb."' title='".$xvau."'>".$xvau."</a></h4>
<p class='text text-overflow text-muted hidden-xs'>".$xstar[$key]."</p>
</div>
</div>
</li>"; 

						
 } ?>

</ul>
</div>
</div>
</div>
</div>
<ul class="stui-page text-center cleafix">
<?php echo $yeshu;?>
</ul>
</div>

<div class="row"  style="margin-top:0px"><?php echo get_ad(8)?></div></div>
<?php  include 'footer.php';?>
