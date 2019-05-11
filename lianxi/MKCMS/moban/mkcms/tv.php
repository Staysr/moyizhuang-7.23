<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  include 'head.php';
$tv='class="active"'?>
<title>追热剧-最新电视剧-好看电视剧-最新电视剧排行-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="追热剧-最新电视剧-好看电视剧-最新电视剧排行,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
<style>
.hy-head-menu .item .menulist li.act a{ border: 0; background: none; border-bottom: 2px solid #09BB07; color: #09BB07;}
</style>
</head>
<body>
<?php  include 'header.php';?>
<div class="container">
<div class="row"  style="margin-top:10px"><?php echo get_ad(10)?></div>
<div class="row">
<div class="hy-layout clearfix">
  <div class="hy-min-screen clearfix">
    <div class="item clearfix">
      <dl class="clearfix">
        <dt class="text-muted">按剧情</dt>
        <dd class="clearfix">
											
<a href="?m=/dianshi/list.php?cat=all&pageno=1" class="acat" style="white-space: pre-wrap;">全部</a>
											  <?php

foreach ($cat as $kcat=>$vcat)
{ $flname= $name[$kcat];
if($flname!==伦理){
$flid="/dianshi/list.php?cat=".$vcat.'&pageno=1'; 
echo "<a href='?m=$flid' class='acat'>$flname</a>"; } }
?></dd>
      </dl>
      <dl class="cleafix">
        <dt class="text-muted">按年份</dt>
        <dd class="clearfix">
						<a href="?m=/dianshi/list.php?year=all&pageno=1">全部</a>
<?php

foreach($cat1 as $kcat=>$vcat){$flname=$name1[$kcat];
$flid='/dianshi/list.php?year='.$vcat.'&pageno=1';
echo "<a class='acat' href='?m=$flid' target='_self'>$flname</a>";}?></dd>
      </dl>
      <dl class="cleafix hidden-sm">
        <dt class="text-muted">按地区</dt>
        <dd class="clearfix">
						<a href="?m=/dianshi/list.php?area=all&pageno=1">全部</a>
<?php

foreach($cat2 as $kcat=>$vcat){$flname=$name2[$kcat];
$flid='/dianshi/list.php?area='.$vcat.'&pageno=1';
echo "<a class='acat' href='?m=$flid' target='_self'>$flname</a>";}?></dd>
      </dl>
    </div>
  </div>
</div>

<div class="container">
<div class="row"  style="margin-top:0px"><?php echo get_ad(10)?></div></div>
		<div class="hy-layout clearfix" style="margin-top: 10px;">
			<div class="hy-switch-tabs active clearfix">
				<span class="text-muted pull-right hidden-xs">如果您喜欢本站请动动小手分享给您的朋友！</span>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#">最新电视剧</a></li>
				</ul>
			</div>
			<div class="hy-video-list">
				<div class="item">
					<ul class="clearfix">
 <?php
$flid1=$_GET['m'];
if ($flid1==""){
$flid1='/dianshi/list?rank=rankhot&pageno=1';
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
							<a class="videopic lazy" href="'.$ccb.'" title="'.$xvau.'" data-original="'.$ximg[$key].'" style="background: url(./style/load.gif) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span><span class="score">'.$xjishu[$key].'</span></a>
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
<?php include('system/fenye.php');?></ul>
			</div>		</div>
	</div>
</div>
 <script type="text/javascript">var w = document.documentElement ? document.documentElement.clientWidth: document.body.clientWidth;
      if (w > 640) {
        $(".collapse").addClass("in");
      }</script>
<div class="container">
<div class="row"  style="margin-top:0px"><?php echo get_ad(8)?></div></div>
<?php  include 'footer.php';?>
