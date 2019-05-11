<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  include 'head.php';
$tv='class="active"'?>
<title>追热剧-最新电视剧-好看电视剧-最新电视剧排行-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="追热剧-最新电视剧-好看电视剧-最新电视剧排行,<?php echo $mkcms_keywords;?>">
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
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_25.png">电视剧频道</h3></div>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted">按剧情</span></li>
											  <li><a href="?m=/dianshi/list.php?cat=all&pageno=1" >全部</a></li>
											  <?php
foreach($dmcat as $kcat=>$vcat){
$flname=$name[$kcat];
$flid="?m=/dianshi/list.php?cat=".$vcat.'&pageno=1'; 
echo "<a href='$flid' class='acat' >$flname</a>"; 
} ?></ul>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted">按年份</span></li>
<li><a href="?m=/dianshi/list.php?area=all&pageno=1">全部</a></li>
<?php
foreach($cat1 as $kcat=>$vcat){$flname=$name1[$kcat];
$flid='/dianshi/list.php?year='.$vcat.'&pageno=1';
echo "<li><a href='?m=$flid' target='_self'>$flname</a></li>";}?>
</ul>
</div>
<ul class="stui-screen__list type-slide bottom-line-dot clearfix hide">
<li><span class="text-muted">按地区</span></li>
<li><a href="?m=/dianshi/list.php?area=all&pageno=1">全部</a></li>
<?php
foreach($cat2 as $kcat=>$vcat){$flname=$name2[$kcat];
$flid='/dianshi/list.php?area='.$vcat.'&pageno=1';
echo "<li><a href='?m=$flid' target='_self'>$flname</a></li>";}?>
</ul></div>
<div class="stui-pannel stui-pannel-bg clearfix"> 
   <div class="fed-screen-list fed-layout fed-bgc-white fed-row"> 
    <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4"> 
<dt>按剧情</dt> 
  <dd><a href="?m=/dianshi/list.php?cat=all&pageno=1" >全部</a></dd>
<?php
foreach($cat as $kcat=>$vcat){$flname=$name[$kcat];
$flid='/dianshi/list.php?cat='.$vcat.'&pageno=1';
echo "<dd><a href='?m=$flid' target='_self'>$flname</a></dd>";}?></dl>  
      <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4"> 
        <dt>按年份</dt>
<dd><a href="?m=/dianshi/list.php?area=all&pageno=1">全部</a></dd>
<?php
foreach($cat1 as $kcat=>$vcat){$flname=$name1[$kcat];
$flid='/dianshi/list.php?year='.$vcat.'&pageno=1';
echo "<dd><a href='?m=$flid' target='_self'>$flname</a></dd>";}?>
      </dl>
     <dl class="fed-col-sx12 fed-col-sm6 fed-col-md4"> 
        <dt>按地区</dt>
        <dd><a href="?m=/dianshi/list.php?area=all&pageno=1">全部</a></dd>
<?php
foreach($cat2 as $kcat=>$vcat){$flname=$name2[$kcat];
$flid='/dianshi/list.php?area='.$vcat.'&pageno=1';
echo "<dd><a href='?m=$flid' target='_self'>$flname</a></dd>";}?>
      </dl>
    </div>
  </div>
<div class="stui-pannel_hd">
<div class="stui-pannel__head active bottom-line clearfix">
				<span class="more text-muted pull-right hidden-xs">千万部VIP视频免费等你观看</span>
				<ul class="nav nav-head">
<li class="active"><a href="#">最近热映</a></li>
				</ul>
</div>
</div>
<div class="stui-pannel_bd">
<ul class="stui-vodlist clearfix">
 <?php
$flid1=$_GET['m'];
if ($flid1==""){
$flid1='/dianshi/list.php?rank=rankhot&pageno=1';
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
