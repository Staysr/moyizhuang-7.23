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

<div class="row"  style="margin-top:10px"><?php echo get_ad(9)?></div>
<div class="row">
<div class="hy-layout clearfix">
  <div class="hy-min-screen clearfix">
    <div class="item clearfix">
      <dl class="clearfix">
        <dt class="text-muted">按剧情</dt>
        <dd class="clearfix">
											  <a href="?m=/dianying/list.php?cat=all&page=1" >全部</a>
											  <?php
foreach($mcat as $kcat=>$vcat){$flname=$mname[$kcat];
if($flname!==伦理){
$flid='/dianying/list.php?cat='.$vcat.'&page=1';
echo "<a href='?m=$flid' target='_self'>$flname</a>";}}?></dd>
      </dl>
      <dl class="cleafix">
        <dt class="text-muted">按年份</dt>
        <dd class="clearfix">
<a href="?m=/dianying/list.php?area=all&pageno=1">全部</a>
<?php

foreach($mcat1 as $kcat=>$vcat){$flname=$mname1[$kcat];
$flid='/dianying/list.php?year='.$vcat.'&page=1';
echo "<a href='?m=$flid' target='_self'>$flname</a>";}?></dd>
      </dl>
      <dl class="cleafix hidden-sm">
        <dt class="text-muted">按地区</dt>
        <dd class="clearfix">
						<a href="?m=/dianying/list.php?area=all&page=1">全部</a>
<?php
foreach($mcat2 as $kcat=>$vcat){$flname=$mname2[$kcat];
$flid='/dianying/list.php?area='.$vcat.'&page=1';
echo "<a  href='?m=$flid' target='_self'>$flname</a>";}?></dd>
      </dl>
    </div>
  </div>
</div>


<div class="container">
<div class="row"  style="margin-top:0px"><?php echo get_ad(9)?></div></div>
		<div class="hy-layout clearfix" style="margin-top: 10px;">
			<div class="hy-switch-tabs active clearfix">
				<span class="text-muted pull-right hidden-xs">如果您喜欢本站请动动小手分享给您的朋友！</span>
				<ul class="nav nav-tabs">
<?php 
$b=(strpos($_GET['m'],'rank='));
$ye=substr($_GET['m'],$b+5);
?>
					<li <?php if ($ye=="rankhot"){echo 'class="active"';}elseif($ye=="createtime" or $ye=="rankpoint"){}else{ echo 'class="active"';};?>><a href="?m=/dianying/list.php?rank=rankhot&page=1">按最热</a></li>
					<li <?php if ($ye=="createtime"){echo 'class="active"';}else{};?>><a href="?m=/dianying/list.php?rank=createtime&page=1">按最新</a></li>
					<li <?php if ($ye=="rankpoint"){echo 'class="active"';}else{};?>><a href="?m=/dianying/list.php?rank=rankpoint&page=1">按好评</a></li>

				</ul>
			</div>
			<div class="hy-video-list">
				<div class="item">
					<ul class="clearfix">
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

			echo '<div class="col-md-2 col-sm-3 col-xs-4">
							<a class="videopic lazy" href="'.$ccb.'" title="'.$xvau.'" data-original="'.$ximg[$key].'" style="background: url(./style/load.gif) no-repeat; background-position:50% 50%; background-size: cover;">
							<span class="play hidden-xs"></span></a>
							<div class="title">
								<h5 class="text-overflow"><a href="'.$ccb.'">'.$xvau.'</a></h5>
							</div>
							<div class="subtitle text-muted text-muted text-overflow hidden-xs">'.$xstar[$key].'</div>
						</div>';
						
 } ?>

						</ul>
				</div>
			</div>
			<div class="hy-page clearfix">
				<ul class="cleafix">
<?php include('system/fenye.php');?>
</ul>
			</div>		</div>
	</div>
</div>
	  <div class="container">
<div class="row"  style="margin-top:0px"><?php echo get_ad(8)?></div></div>
<?php  include 'footer.php';?>
