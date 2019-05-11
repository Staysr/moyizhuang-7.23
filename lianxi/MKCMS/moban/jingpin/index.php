<?php  include 'head.php';?>
<title><?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $mkcms_keywords ;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
</head>
<body class="index">
<?php  include 'header.php';
?>
<div class="container">
<div class="row"><?php echo get_ad(2)?></div>
<div class="row">
<!-- 幻灯片 -->
<div class="stui-pannel stui-pannel-bg clearfix" >
<div class="stui-pannel-box clearfix">
<div class="stui-pannel-bd">
<div class="carousel carousel_default flickity-page">
<?php
						$result = mysql_query('select * from mkcms_slideshow order by s_order desc');
						if($result&&mysql_num_rows($result)){
						while($row = mysql_fetch_array($result)){
						?>
<div class="col-md-2 col-xs-1">
<a href="<?php echo $row['s_url'];?>" class="stui-vodlist__thumb" title="<?php echo $row['s_name'];?>" alt="<?php echo $row['s_name'];?>" style="background: url(<?php echo $row['s_picture'];?>) no-repeat; background-position:50% 50%; background-size: cover; padding-top: 45%;">
<span class="pic-text text-center"><?php echo $row['s_name'];?></span>
</a>
</div>
<?php }
}
else{
foreach ($one as $ni=>$cs){
$cs= str_replace('https://www.360kan.com', '', "$cs");
echo '
<div class="col-md-2 col-xs-1">
<a href="./play.php?play='.$cs.'" class="stui-vodlist__thumb" title="'.$three[$ni].'" alt="'.$three[$ni].'" style="background: url('.$two[$ni].') no-repeat; background-position:50% 50%; background-size: cover; padding-top: 45%;">
<span class="pic-text text-center">'.$three[$ni].'</span>
</a>
</div>
';
}
}?>
</div>
</div>
</div>
</div>
<!-- 幻灯片 -->
<!--公告-->
<?php if($mkcms_gg==1){?>
<div class="stui-pannel stui-pannel-bg clearfix  hidden-xs">
<div class="stui-pannel-box clearfix">
<div class="col-lg-wide-75 col-xs-1 padding-0">
  <div class="stui-pannel_hd">
     <div class="stui-pannel__head clearfix">
		     <li class="active">
			<img src="images/notice.png" width="22" height="22" />
			 <strong><?php echo $mkcms_gonggao;?></strong>
			 </li>
  </div> </div>
  </div>
</div>
</div>
<?php }?>
<!--公告-->
<!-- 分类列表 -->
<div class="stui-pannel stui-pannel-bg clearfix">
<div><?php echo get_ad(3)?></div>
<!--抢先看-->
<?php if($mkcms_qianxian==1){?>
<div class="stui-pannel-box clearfix">
<div class="col-lg-wide-75 col-xs-1 padding-0">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<a class="more text-muted pull-right" href="vlist.php?cid=0">更多 <i class="icon iconfont icon-more"></i></a>
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_12.png"><a href="vlist.php?cid=0">热门尝鲜</a></h3>
</div>
</div>
<div class="stui-pannel_bd clearfix">
<ul class="stui-vodlist clearfix">
<?php
$i=0;
if ($i<12){
$result = mysql_query('select * from mkcms_vod where d_rec=0 order by d_id desc LIMIT 0,12');
while ($row = mysql_fetch_array($result)){
$cc="./bplay.php?play=";
$dd="./bplay/";
if ($mkcms_wei==1){
$ccb=$dd.$row['d_id'];
}
else{
$ccb=$cc.$row['d_id'];	
}
if ($row['d_jifen']>0){
$ok="onclick=\"return confirm('此视频为收费视频，观看需要支付".$row['d_jifen']."积分，您是否观看？')\"";
}
else{
$ok="";
}
echo '<li class="col-md-5 col-sm-4 col-xs-3 ';
if ($i>=10){
echo 'hidden-lg hidden-md';
}
echo '">
<div class="stui-vodlist__box">
<a class="stui-vodlist__thumb lazyload img-shadow" href="'.$ccb.'" '.$ok.' title="'.$row['d_name'].'" alt="'.$row['d_name'].'" data-original="'.$row['d_picture'].'">
<span class="play hidden-xs"></span>
</a><div class="stui-vodlist__detail">
<h4 class="title text-overflow">
<a href="'.$ccb.'" '.$ok.' title="'.$row['d_name'].'">'.$row['d_name'].'</a>
</h4>
<p class="text text-overflow text-muted hidden-xs">'.$row['d_zhuyan'].'</p>
</div>
</div>
</li>';
$i ++;		 }
}?>
	</ul>
</div>
</div>
<div class="col-lg-wide-25 hidden-md hidden-sm hidden-xs">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<a class="more text-muted pull-right" href="vlist.php?cid=0">更多 <i class="icon iconfont icon-more"></i></a>
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_9.png">特别推荐</h3>
</div>
</div>
<div class="stui-pannel_bd">
<style>
li.w-newfigure.w-newfigure-180x153 {
    list-style: none;
    margin: 10px 10px 0;
}

.w-newfigure-imglink.g-playicon.js-playicon {
    float: left;
    margin-right: 10px;
    position: relative;
    width: 120px;
    height: 66px;
    overflow: hidden;
}
li:nth-child(n+4) .w-newfigure-imglink {display:none}

img.hotju {
    width: 100%;
}
span.w-newfigure-hint {
    position: absolute;
    right: 4px;
    bottom: 4px;
    padding: 0;
    background: rgba(0,0,0,.8);
    color: #fff;
    border-radius: 2px;
    font-size: 12px;
}
.w-newfigure-detail {
    overflow: hidden;
    position: relative;
    height: 66px;
}
li:nth-child(n+4) .w-newfigure-detail {height: 44px;}
p.title.g-clear {
    margin: 0;
    width: 250px;
    color: #222;
    height: 20px;
    overflow: hidden;
    font-size: 14px;
    line-height: 20px;
    white-space: nowrap;
    text-overflow: ellipsis;
}
p.title.g-clear:hover {
    color: #ff9900;
}

p.w-newfigure-desc {
    margin-top: 10px;
    color: #999;
    font-size: 12px;
}
li:nth-child(n+4) .w-newfigure-desc {margin-top: 0;}
li:nth-child(n+4) span.s1 {background: url(<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/hot.png) 0 center no-repeat;
    padding-left: 20px;}	
</style>
<ul class="list w-newfigure-list g-clear">
  <?php $result = mysql_query('select * from mkcms_vod where d_rec=1 order by d_id desc LIMIT 0,10');
		while ($row = mysql_fetch_array($result)){
$cc="./bplay.php?play=";
$dd="./bplay/";
if ($mkcms_wei==1){
$ccb=$dd.$row['d_id'];
}
else{
$ccb=$cc.$row['d_id'];	
}
if ($row['d_jifen']>0){
$ok="onclick=\"return confirm('此视频为收费视频，观看需要支付".$row['d_jifen']."积分，您是否观看？')\"";
}
else{
$ok="";
}
echo '<li  title="'.$row['d_name'].'" class="w-newfigure w-newfigure-180x153"><a href="'.$ccb.'" '.$ok.' class="js-link">
			 <div class="w-newfigure-imglink g-playicon js-playicon"> <span class="play hidden-xs"></span><img class="hotju" src="'.$row['d_picture'].'" alt="'.$row['d_name'].'"  />
			 <span class="w-newfigure-hint"></span></div><div class="w-newfigure-detail"><p class="title g-clear"><span class="s1">'.$row['d_name'].'</span></p>
			 <p class="w-newfigure-desc">'.$row['d_zhuyan'].'</p></div></a></li>';

		}?>		 
			 </ul>
</div>
</div>
</div>
<?php }?>
<!--抢先看-->
<!--电视剧-->
<?php if($mkcms_dianshi==1){?>
<div style="margin-top:-18px"><?php echo get_ad(5)?></div> 
<div class="row"><?php echo get_ad(3)?></div>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box clearfix">
<div class="col-lg-wide-75 col-xs-1 padding-0">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<a class="more text-muted pull-right" href="tv.php">更多 <i class="icon iconfont icon-more"></i></a>
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_2.png"><a href="tv.php?m=/dianshi/list.php?cat=all&page=1">热播剧集</a></h3>
<ul class="nav nav-text pull-right hidden-sm hidden-xs">
<li><a href="tv.php?m=/dianshi/list.php?area=10&pageno=1" class="text-muted">国产剧</a> <span class="split-line"></span></li>
<li><a href="tv.php?m=/dianshi/list.php?area=11&pageno=1" class="text-muted">港台剧</a> <span class="split-line"></span></li>
<li><a href="tv.php?m=/dianshi/list.php?area=12&pageno=1" class="text-muted">日韩剧</a> <span class="split-line"></span></li>
<li><a href="tv.php?m=/dianshi/list.php?area=13&pageno=1" class="text-muted">欧美剧</a> <span class="split-line"></span></li>
</ul>
</div>
</div>
<div class="stui-pannel_bd clearfix">
<ul class="stui-vodlist clearfix">	
<?php include './data/tvjx.php';
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<12){
$gul=$listarr[1][$key]; 
$guq=$listarr[1][$key]; 
$_GET['id']=$gul; 
$zimg=$imgarr[1][$key]; 
$zname=$namearr[1][$key]; 
$nname=$nnamearr[1][$key]; 
$jishu=$xjishu[1][$key]; 
$zstar=$stararr[1][$key]; 
$jiami=$gul; 

 if ($mkcms_wei==1){
$chuandi='./vod'.$jiami;
}
else{
$chuandi='./play.php?play='.$jiami;	
}

echo '<li class="col-md-5 col-sm-4 col-xs-3 ';
if ($i>=10){
echo 'hidden-lg hidden-md';
}
echo '">
<div class="stui-vodlist__box">
<a class="stui-vodlist__thumb lazyload img-shadow" href="'.$chuandi.'" title="'.$zname.'" alt="'.$zname.'" data-original="'.$zimg.'">
<span class="play hidden-xs"></span>
<span class="pic-text text-right">'.$jishu.'</span>
</a><div class="stui-vodlist__detail">
<h4 class="title text-overflow">
<a href="'.$chuandi.'" title="'.$zname.'">'.$zname.'</a>
</h4>
<p class="text text-overflow text-muted hidden-xs">'.$zstar.'</p>
</div>
</div>
</li>';

$i ++;		 }
}		 ?>
	</ul>
</div>
</div>
<?php }?>
<!--电视剧-->
<!--综艺-->
<?php if($mkcms_zongyi==1){?>
<div class="col-lg-wide-25 hidden-md hidden-sm hidden-xs">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<a class="more text-muted pull-right" href="zongyi.php?m=/zongyi/list.php?rank=rankhot&page=1">更多 <i class="icon iconfont icon-more"></i></a>
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_9.png">综艺排行</h3>
</div>
</div>
<div class="stui-pannel_bd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<ul class="stui-vodlist__media active col-pd clearfix">
<?php include './data/zyjx.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<3){
$gul=$listarr[1][$key]; 
$cd=$host.'/alist.php?id='.$gul; 
$guq=$listarr[1][$key]; 
$_GET['id']=$gul; 
$zimg=$imgarr[1][$key]; 
$zname=$namearr[1][$key]; 
$nname=$nnamearr[1][$key]; 
$qishu=$xjishu[1][$key]; 
$zstar=$stararr[1][$key]; 
$jiami=$gul; 
 if ($mkcms_wei==1){
$chuandi='./vod'.$jiami;
}
else{
$chuandi='./play.php?play='.$jiami;	
}
echo '<li><div class="thumb">
<a class="m-thumb stui-vodlist__thumb lazyload" href="'.$chuandi.'" title="'.$zname.'" data-original="'.$zimg.'">
<span class="pic-tag pic-tag-h">Top</span>
</a></div><div class="detail detail-side">
<h4 class="title"><a href="'.$chuandi.'"><i class="icon iconfont icon-more text-muted pull-right"></i>'.$zname.'</a></h4>
<p class="font-12">
<span class="text-muted">'.$qishu.'</span></p>
<p class="font-12 margin-0">'.$zstar.'</p>
</div>
</li>';

$i ++;		 }
}		 ?>
</ul></div>
<div class="stui-pannel_bd">
<div class="stui-pannel__head clearfix">
<a class="more text-muted pull-right" href="movie.php?m=/dianying/list.php?rank=createtime&page=1">更多 <i class="icon iconfont icon-more"></i></a>
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_25.png">筛选</h3>
</div>
</div>
<div class="stui-pannel_bd col-pd">
<ul class="stui-vodlist__screen clearfix">
<li>
<a href="movie.php?m=/dianying/list.php?area=10&page=1" title="大陆">大陆</a></li>
<li><a href="movie.php?m=/dianying/list.php?area=15&page=1" title="香港">香港</a></li>
<li><a href="movie.php?m=/dianying/list.php?area=18&page=1" title="台湾">台湾</a></li>
<li><a href="movie.php?m=/dianying/list.php?area=14" title="日本">日本</a></li>
<li><a href="movie.php?m=/dianying/list.php?area=13" title="韩国">韩国</a></li>
<li><a href="movie.php?m=/dianying/list.php?area=11" title="欧美">欧美</a></li>
<li><a href="movie.php?m=/dianying/list.php?area=21" title="泰国">泰国</a></li>
<li><a href="movie.php?m=/dianying/list.php?area=other" title="其他">其他</a></li>
</ul>
<ul class="stui-vodlist__screen top-line-dot clearfix">
<li><a href="movie.php?m=/dianying/list.php?year=2018&page=1" title="2018">2018</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2017&page=1" title="2017">2017</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2016&page=1" title="2016">2016</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2015&page=1" title="2015">2015</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2014&page=1" title="2014">2014</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2013&page=1" title="2013">2013</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2012&page=1" title="2012">2012</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2011&page=1" title="2011">2011</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2010&page=1" title="2010">2010</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2009&page=1" title="2009">2009</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=2008&page=1" title="2008">2008</a></li>
<li><a href="movie.php?m=/dianying/list.php?year=more" title="更早">更早</a></li>
</ul>
</div>
</div>
</div>
</div>
<!--综艺-->
<?php }?>
<!--电影-->
<?php if($mkcms_dianying==1){?>
<div style="margin-top:-18px"><?php echo get_ad(4)?></div> 
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box clearfix">
<div class="col-lg-wide-100 col-xs-1 padding-0">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<a class="more text-muted pull-right" href="./movie.php">更多 <i class="icon iconfont icon-more"></i></a>
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_1.png"><a href="movie.php?m=/dianying/list.php?rank=rankhot&page=1">热映大片</a></h3>
<ul class="nav nav-text pull-right hidden-sm hidden-xs">
<li><a href="movie.php?m=/dianying/list.php?area=10&page=1" class="text-muted">华语强档</a> <span class="split-line"></span></li>
<li><a href="movie.php?m=/dianying/list.php?rank=rankpoint&page=1" class="text-muted">网络热映</a> <span class="split-line"></span></li>
<li><a href="movie.php?m=/dianying/list.php?area=11&page=1" class="text-muted">欧美范儿</a> <span class="split-line"></span></li>
<li><a href="movie.php?m=/dianying/list.php?area=13&page=1" class="text-muted">亚洲风情</a> <span class="split-line"></span></li>
</ul>
</div>
</div>
<div class="stui-pannel_bd clearfix">
<ul class="stui-vodlist clearfix">
<?php  include './data/dyjx.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<12){
$gul=$listarr[1][$key]; 
$_GET['id']=$gul; 
$zimg=$imgarr[1][$key]; 
$zname=$namearr[1][$key]; 
$fname=$fnamearr[1][$key]; 
$nname=$nnamearr[1][$key]; 
$zstar=$stararr[1][$key];
$tok=$gul; 
if ($mkcms_wei==1){
$playurl=vod.$tok;
}
else{
$play='./play.php?play=';
$playurl=$play.$tok;	
}
echo '<li class="col-md-6 col-sm-4 col-xs-3">
<div class="stui-vodlist__box">
<a class="stui-vodlist__thumb lazyload img-shadow" href="'.$playurl.'" title="'.$zname.'" alt="$name" data-original="'.$zimg.'">
<span class="play hidden-xs"></span>
<span class="pic-text text-right">'.$nname.'</span>
</a><div class="stui-vodlist__detail">
<h4 class="title text-overflow">
<a href="'.$playurl.'" title="'.$zname.'">'.$zname.'</a>
</h4>
<p class="text text-overflow text-muted hidden-xs">'.$zstar.'</p>
</div>
</div>
</li>';
$i ++;	}
} ?>	
</ul>
</div>
</div>
<div class="stui-pannel_bd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</div>
</div>
</div>
<?php }?>
<!--电影-->
<!--动漫-->
<?php if($mkcms_dongman==1){?>
<div style="margin-top:-18px"><?php echo get_ad(7)?></div> 
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box clearfix">
<div class="col-lg-wide-100 col-xs-1 padding-0">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<a class="more text-muted pull-right" href="./dongman.php">更多 <i class="icon iconfont icon-more"></i></a>
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_1.png"><a href="movie.php?m=/dianying/list.php?rank=rankhot&page=1">最新动漫</a></h3>
<ul class="nav nav-text pull-right hidden-sm hidden-xs">
<li><a href="dongman.php?m=/dongman/list.php?cat=100&page=1" class="text-muted">热血</a> <span class="split-line"></span></li>
<li><a href="dongman.php?m=/dongman/list.php?cat=101&page=1" class="text-muted">恋爱</a> <span class="split-line"></span></li>
<li><a href="dongman.php?m=/dongman/list.php?cat=108&page=1" class="text-muted">悬疑</a> <span class="split-line"></span></li>
<li><a href="dongman.php?m=/dongman/list.php?cat=111&page=1" class="text-muted">少儿</a> <span class="split-line"></span></li>
</ul>
</div>
</div>
<div class="stui-pannel_bd clearfix">
<ul class="stui-vodlist clearfix">
<?php  include './data/dmjx.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<12){
$gul=$listarr[1][$key]; 
$_GET['id']=$gul; 
$zimg=$imgarr[1][$key]; 
$zname=$namearr[1][$key]; 
$fname=$fnamearr[1][$key]; 
$nname=$nnamearr[1][$key]; 
$zstar=$stararr[1][$key];
$tok=$gul; 
if ($mkcms_wei==1){
$playurl=vod.$tok;
}
else{
$play='./play.php?play=';
$playurl=$play.$tok;	
}
echo '<li class="col-md-6 col-sm-4 col-xs-3">
<div class="stui-vodlist__box">
<a class="stui-vodlist__thumb lazyload img-shadow" href="'.$playurl.'" title="'.$zname.'" alt="$name" data-original="'.$zimg.'">
<span class="play hidden-xs"></span>
<span class="pic-text text-right">'.$nname.'</span>
</a><div class="stui-vodlist__detail">
<h4 class="title text-overflow">
<a href="'.$playurl.'" title="'.$zname.'">'.$zname.'</a>
</h4>
<p class="text text-overflow text-muted hidden-xs">'.$zstar.'</p>
</div>
</div>
</li>';
$i ++;	}
} ?>	
</ul>
</div>
</div>
<div class="stui-pannel_bd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</div>
</div>
</div>
<?php }?>
<!--动漫-->
<!--友链-->
<?php if($mkcms_yq==1){?>
<div class="stui-pannel hidden-sm hidden-xs clearfix">
<div class="stui-pannel-box clearfix">
<div class="stui-pannel_hd">
<div class="stui-pannel__head clearfix">
<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_26.png">友情链接</h3>
</div>
</div>
<div class="stui-pannel_bd clearfix">
<div class="col-xs-1">
<ul class="stui-link__text clearfix">
<?php
						$result = mysql_query('select * from mkcms_link');
						while($row = mysql_fetch_array($result)){
						?>
						<li><a class="text-color-999" href="<?php echo $row['l_url'];?>" target="_blank"><?php echo $row['l_name'];?></a></li><?php
						}
						?>

</ul></div></div></div></div>
<?php }?>
<!--友链-->
</div></div></div>
<?php  include 'footer.php';?>