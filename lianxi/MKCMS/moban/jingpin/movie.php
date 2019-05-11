<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  include 'head.php';
$movie='class="active"'?>
<title>看电影-2018最新好看的最新电影-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="看电影,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
<div class="row">
<?php echo get_ad(9)?>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box">
<div class="stui-pannel_hd">
<div class="stui-pannel__head active bottom-line clearfix">
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_25.png">电影频道</h3></div>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted">按剧情</span></li>
											  <li><a href="?m=/dianying/list.php?cat=all&page=1" >全部</a></li>
											  <?php
foreach($mcat as $kcat=>$vcat){$flname=$mname[$kcat];
if($flname!==伦理){
$flid='/dianying/list.php?cat='.$vcat.'&page=1';
echo "<li><a href='?m=$flid' target='_self'>$flname</a></li>";}}?></ul>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted">按年份</span></li>
<li><a href="?m=/dianying/list.php?area=all&pageno=1">全部</a></li>
<?php
foreach($mcat1 as $kcat=>$vcat){$flname=$mname1[$kcat];
$flid='/dianying/list.php?year='.$vcat.'&page=1';
echo "<li><a href='?m=$flid' target='_self'>$flname</a></li>";}?>
</ul>
</div>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted">按地区</span></li>
<li><a href="?m=/dianying/list.php?area=all&page=1">全部</a></li>
<?php
foreach($mcat2 as $kcat=>$vcat){$flname=$mname2[$kcat];
$flid='/dianying/list.php?area='.$vcat.'&page=1';
echo "<li><a href='?m=$flid' target='_self'>$flname</a></li>";}?>
</ul></div>
<div class="stui-pannel stui-pannel-bg clearfix"> 
   <div class="fed-screen-list fed-layout fed-bgc-white fed-row"> 
    <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4"> 
<dt>按剧情</dt> 
  <dd><a href="?m=/dianying/list.php?cat=all&page=1" >全部</a></dd>
											  <?php
foreach($mcat as $kcat=>$vcat){$flname=$mname[$kcat];
$flid='/dianying/list.php?cat='.$vcat.'&page=1';
echo "<dd><a href='?m=$flid' target='_self'>$flname</a></dd>";}?>  </dl>  
      <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4"> 
        <dt>按年份</dt>
<dd><a href="?m=/dianying/list.php?area=all&pageno=1">全部</a></dd>
<?php

foreach($mcat1 as $kcat=>$vcat){$flname=$mname1[$kcat];
$flid='/dianying/list.php?year='.$vcat.'&page=1';
echo "<dd><a href='?m=$flid' target='_self'>$flname</a></dd>";}?>
      </dl>
     <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4"> 
        <dt>按地区</dt>
        <dd><a href="?m=/dianying/list.php?area=all&page=1">全部</a></dd>
<?php
foreach($mcat2 as $kcat=>$vcat){$flname=$mname2[$kcat];
$flid='/dianying/list.php?area='.$vcat.'&page=1';
echo "<dd><a  href='?m=$flid' target='_self'>$flname</a></dd>";}?>
      </dl>
    </div>
  </div>
<div class="stui-pannel_hd">
<div class="stui-pannel__head active bottom-line clearfix">
				<span class="more text-muted pull-right hidden-xs">千万部VIP视频免费等你观看</span>
				<ul class="nav nav-head">
<?php 
$b=(strpos($_GET['m'],'rank='));
$ye=substr($_GET['m'],$b+5);
?>
<li <?php if ($ye=="rankhot"){echo 'class="active"';}elseif($ye=="createtime" or $ye=="rankpoint"){}else{ echo 'class="active"';};?>><a href="?m=/dianying/list.php?rank=rankhot&page=1">按最热</a></li>
					<li <?php if ($ye=="createtime"){echo 'class="active"';}else{};?>><a href="?m=/dianying/list.php?rank=createtime&page=1">按最新</a></li>
					<li <?php if ($ye=="rankpoint"){echo 'class="active"';}else{};?>><a href="?m=/dianying/list.php?rank=rankpoint&page=1">按好评</a></li>

				</ul>
</div>
</div>
<div class="stui-pannel_bd">
<ul class="stui-vodlist clearfix">
 <?php
$flid1=$_GET['m'];
if ($flid1==""){
$flid1='/dianying/list.php?rank=rankhot&pageno=1';
}
include 'system/360.php';

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
<?php include('system/fenye.php');?>
</ul>
</div>
<div class="row"  style="margin-top:0px"><?php echo get_ad(8)?></div></div>
<?php  include 'footer.php';?>
