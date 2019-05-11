<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  include 'head.php';?>
<title><?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $mkcms_keywords ;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
</head>
<body class="index">
<?php  include 'header.php';
?>
<div class="container">
<div class="row"  style="margin-top:10px"><?php echo get_ad(2)?></div>
  <div class="row">
		<div class="hy-layout clearfix">
			<div class="col-lg-7 col-md-6 col-sm-12">
				<div class="swiper-container hy-slide">
					<div class="swiper-wrapper">
					
<?php
						$result = mysql_query('select * from mkcms_slideshow order by s_order desc');
						if($result&&mysql_num_rows($result)){
						while($row = mysql_fetch_array($result)){
						?>
						
						<div class="swiper-slide">
	<div class="hy-video-slide">
		<a class="videopic" href="<?php echo $row['s_url'];?>" title="<?php echo $row['s_name'];?>" style="padding-top: 60%; background: url(<?php echo $row['s_picture'];?>)  no-repeat; background-position:50% 50%; background-size: cover;">	
			<span class="title"><?php echo $row['s_name'];?></span>
	    </a>
	</div>	            					
</div><?php }
}
else{
foreach ($one as $ni=>$cs){
$cs= str_replace('https://www.360kan.com', '', "$cs");
echo '<div class="swiper-slide">
	<div class="hy-video-slide">
		<a class="videopic" href="./play.php?play='.$cs.'" title="" style="padding-top: 60%; background: url('.$two[$ni].')  no-repeat; background-position:50% 50%; background-size: cover;">	
			<span class="title">'.$three[$ni].'</span>
	    </a>
	</div>	            					
</div>';
}
}?>					</div>
					<div class="swiper-button-next hidden-xs">
						<i class="icon iconfont icon-xiangyou"></i>
					</div>
					<div class="swiper-button-prev hidden-xs">
						<i class="icon iconfont icon-back"></i>
					</div>
					<div class="swiper-pagination">
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-6 col-sm-12 padding-0">
				<div class="hy-index-menu clearfix">
					<div class="item">
						<ul class="clearfix">
                            <li><a href="./zhibo.php"><i class="icon iconfont icon-zhibo  text-color"></i><span>电视直播</span></a></li>						
							<li><a href="./vlist.php?cid=0"><i class="icon iconfont icon-vip text-color"></i><span>抢先片源</span></a></li>
							<li><a href="./tv.php?m=/dianshi/list.php?cat=all&page=1"><i class="icon iconfont icon-tv_icon text-color"></i><span>电视剧</span></a></li>
							<li><a href="./ucenter"><i class="icon iconfont icon-tubiaozhizuomobanyihuifu- text-color"></i><span>会员中心</span></a></li>
							                  
						</ul>
					</div>
				</div>
				<div class="hy-index-tags hidden-md clearfix">
					<div class="item">
						<ul class="clearfix">
														<li><a href="./movie.php?m=/dianying/list.php?cat=100&page=1">爱情</a></li>
														<li><a href="./movie.php?m=/dianying/list.php?cat=106&page=1">动作</a></li>
														<li><a href="./movie.php?m=/dianying/list.php?cat=102&page=1">恐怖</a></li>
														<li><a href="./movie.php?m=/dianying/list.php?cat=104&age=1">科幻</a></li>							
														<li><a href="./movie.php?m=/dianying/list.php?cat=112&page=1">剧情</a></li>
														<li><a href="./movie.php?m=/dianying/list.php?cat=105&page=1">犯罪</a></li>
														<li><a href="./movie.php?m=/dianying/list.php?cat=113&page=1">奇幻</a></li>
														<li><a href="./movie.php?m=/dianying/list.php?cat=108&page=1">战争</a></li>						</ul>
					</div>
				</div>
				<div class="hy-right-qrcode hidden-sm hidden-xs">
					<div class="item">
						<dl class="clearfix">
							<dt><img src="<?php echo $mkcms_weixin;?>"></dt>
							<dd>
							<h4>扫描二维码“手机看大片”</h4>
							<p class="text-muted">
								也可以分享到朋友圈哦！
							</p>
							<p class="margin-0 text-muted">
								<?php echo $mkcms_domain;?>							</p>
							</dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
<?php if($mkcms_gg==1){?>
<!--公告-->
<div class="container hidden-xs">
     <div class="row">
		 <div class="hy-layout clearfix">
		     <li class="active">
			 <table border="0">
			 <tr>
			 <td width="22" height="22">
			 <img src="images/notice.png" width="22" height="22" />
			 </td>
			 <td width="12" height="22"></td>
			 <td><strong><?php echo $mkcms_gonggao;?></strong></td>
			 </tr>
			     </table>
			 </li>
		</div>
	</div>
</div><!--公告--><?php }?>
<!--抢先看-->
<?php if($mkcms_qianxian==1){?>
<div class="container">
<div class="row"  style="margin-top:10px"><?php echo get_ad(3)?></div></div>
		<div class="hy-layout clearfix">
			<div class="hy-video-head">
				<h3 class="margin-0"><i class="icon iconfont icon-vip text-color"></i> 抢先看</h3>
				<ul class="pull-right">
					<li class="active"><a href="./vlist.php?cid=0" class="text-muted">更多 <i class="icon iconfont icon-xiangyou"></i></a></li>
				</ul>
			</div>
			<div class="clearfix">
				<div class="hy-video-list cleafix">
					<div class="item">
					    
<?php $result = mysql_query('select * from mkcms_vod where d_rec=1 order by d_id desc LIMIT 0,12');
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
			echo '<div class="col-md-2 col-sm-3 col-xs-4">
							<a class="videopic lazy" '.$ok.' href="'.$ccb.'" title="'.$row['d_name'].'" data-original="'.$row['d_picture'].'" style="background: url(./style/load.gif) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span><span class="score">'.get_channel_name($row['d_parent']).'</span></a>
							<div class="title">
								<h5 class="text-overflow"><a href="'.$ccb.'" '.$ok.'>'.$row['d_name'].'</a></h5>
							</div>
							<div class="subtitle text-muted text-muted text-overflow hidden-xs">'.$row['d_zhuyan'].'</div>
						</div>';
		}?>						
						
				
			</div></div></div>
			<div class="hy-video-footer visible-xs clearfix">
				<a href="./vlist.php?cid=0" class="text-muted">查看更多 <i class="icon iconfont icon-xiangyou pull-right"></i></a>
			</div>
		</div>
		<!--抢先看-->
<?php }?>
<?php if($mkcms_dianying==1){?>
<div class="container">
<div class="row"  style="margin-top:10px"><?php echo get_ad(4)?></div></div>
		<!--电影-->
		<div class="hy-layout clearfix">
			<div class="hy-video-head">
				<ul class="pull-right">
				<li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./movie.php?m=/dianying/list.php?cat=103&page=1" class="text-muted border-right">喜剧</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./movie.php?m=/dianying/list.php?cat=100&page=1" class="text-muted border-right">爱情</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./movie.php?m=/dianying/list.php?cat=106&page=1" class="text-muted border-right">动作</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./movie.php?m=/dianying/list.php?cat=102&page=1" class="text-muted border-right">恐怖</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./movie.php?m=/dianying/list.php?cat=104&page=1" class="text-muted border-right">科幻</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./movie.php?m=/dianying/list.php?cat=121&page=1" class="text-muted border-right">剧情</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./movie.php?m=/dianying/list.php?cat=105&page=1" class="text-muted border-right">犯罪</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./movie.php?m=/dianying/list.php?cat=113&page=1" class="text-muted border-right">奇幻</a> /</li>
				<li class="active"><a href="./movie.php?m=/dianying/list.php?cat=all&page=1" class="text-muted">更多 <i class="icon iconfont icon-xiangyou"></i></a></li>
				</ul>
				<h3 class="margin-0"><i class="icon iconfont icon-caidanicondianyinghui text-color"></i>电影</h3>
			</div>
			<div class="clearfix">
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
			echo '<div class="col-md-2 col-sm-3 col-xs-4">
							<a class="videopic lazy" href="'.$playurl.'" title="'.$zname.'" data-original="'.$zimg.'" style="background: url(./style/load.gif) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span><span class="score">'.$fname.'</span></a>
							<div class="title">
								<h5 class="text-overflow"><a href="'.$playurl.'">'.$zname.'</a></h5>
							</div>
							<div class="subtitle text-muted text-muted text-overflow hidden-xs">'.$zstar.'</div>
						</div>';




$i ++;		 }
} ?>			


				<div class="hy-video-footer visible-xs clearfix">
					<a href="./movie.php?m=/dianying/list.php?cat=all&page=1" class="text-muted">查看更多 <i class="icon iconfont icon-xiangyou pull-right"></i></a>
				</div>
			</div>
		</div>		<!--电影-->
		<?php }?>
<?php if($mkcms_dianshi==1){?>
<div class="container">
<div class="row"  style="margin-top:10px"><?php echo get_ad(5)?></div></div>
		<!--电视剧-->
		<div class="hy-layout clearfix">
			<div class="hy-video-head">
				<ul class="pull-right">
				<li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./tv.php?m=/dianshi/list.php?cat=101&pageno=1" class="text-muted border-right">言情</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./tv.php?m=/dianshi/list.php?cat=105&pageno=1" class="text-muted border-right">伦理</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./tv.php?m=/dianshi/list.php?cat=109&pageno=1" class="text-muted border-right">喜剧</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./tv.php?m=/dianshi/list.php?cat=108&pageno=1" class="text-muted border-right">悬疑</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./tv.php?m=/dianshi/list.php?cat=111&pageno=1" class="text-muted border-right">都市</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./tv.php?m=/dianshi/list.php?cat=100&pageno=1" class="text-muted border-right">偶像</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./tv.php?m=/dianshi/list.php?cat=104&pageno=1" class="text-muted border-right">古装</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./tv.php?m=/dianshi/list.php?cat=107&pageno=1" class="text-muted border-right">军事</a> /</li>
				<li class="active"><a href="./tv.php?m=/dianshi/list.php?cat=all&page=1" class="text-muted">更多 <i class="icon iconfont icon-xiangyou"></i></a></li>
				</ul>
				<h3 class="margin-0"><i class="icon iconfont icon-tv_icon text-color"></i>电视剧</h3>
			</div>
			<div class="clearfix">
<?php  include './data/tvjx.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<12){
$gul=$listarr[1][$key]; 
$guq=$listarr[1][$key]; $_GET['id']=$gul; 
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
			echo '<div class="col-md-2 col-sm-3 col-xs-4">
							<a class="videopic lazy" href="'.$chuandi.'" title="'.$zname.'" data-original="'.$zimg.'" style="background: url(./style/load.gif) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span><span class="score">'.$jishu.'</span></a>
							<div class="title">
								<h5 class="text-overflow"><a href="'.$chuandi.'">'.$zname.'</a></h5>
							</div>
							<div class="subtitle text-muted text-muted text-overflow hidden-xs">'.$zstar.'</div>
						</div>';
$i ++;		 }
}		 ?>
				<div class="hy-video-footer visible-xs clearfix">
					<a href="./tv.php?m=/dianshi/list.php?cat=all&page=1" class="text-muted">查看更多 <i class="icon iconfont icon-xiangyou pull-right"></i></a>
				</div>
			</div>
		</div>		<!--电视剧-->
		<?php }?>
		<?php if($mkcms_zongyi==1){?>
		<!--综艺-->
<div class="container">
<div class="row"  style="margin-top:10px"><?php echo get_ad(6)?></div></div>
		<div class="hy-layout clearfix">
			<div class="hy-video-head">
				<ul class="pull-right">
				<li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./zongyi.php?m=/zongyi/list.php?cat=101&pageno=1" class="text-muted border-right">选秀</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./zongyi.php?m=/zongyi/list.php?cat=102&pageno=1" class="text-muted border-right">八卦</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./zongyi.php?m=/zongyi/list.php?cat=103&pageno=1" class="text-muted border-right">访谈</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./zongyi.php?m=/zongyi/list.php?cat=104&pageno=1" class="text-muted border-right">情感</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./zongyi.php?m=/zongyi/list.php?cat=105&pageno=1" class="text-muted border-right">生活</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./zongyi.php?m=/zongyi/list.php?cat=106&pageno=1" class="text-muted border-right">晚会</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./zongyi.php?m=/zongyi/list.php?cat=107&pageno=1" class="text-muted border-right">搞笑</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./zongyi.php?m=/zongyi/list.php?cat=108&pageno=1" class="text-muted border-right">音乐</a> /</li>
					<li class="active"><a href="./zongyi.php?m=/zongyi/list.php?cat=all&page=1" class="text-muted">更多 <i class="icon iconfont icon-xiangyou"></i></a></li>
				</ul>
				<h3 class="margin-0"><i class="icon iconfont icon-jiemu text-color"></i>综艺</h3>
			</div>
			<div class="clearfix">
				  <?php  include './data/zyjx.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<12){
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
			echo '<div class="col-md-2 col-sm-3 col-xs-4">
							<a class="videopic lazy" href="'.$chuandi.'" title="'.$zname.'" data-original="'.$zimg.'" style="background: url(./style/load.gif) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span><span class="score">'.$qishu.'</span></a>
							<div class="title">
								<h5 class="text-overflow"><a href="'.$chuandi.'">'.$zname.'</a></h5>
							</div>
							<div class="subtitle text-muted text-muted text-overflow hidden-xs">'.$zstar.'</div>
						</div>';
$i ++;		 }
}		 ?>				<div class="hy-video-footer visible-xs clearfix">
					<a href="./zongyi.php?m=/zongyi/list.php?cat=all&page=1" class="text-muted">查看更多 <i class="icon iconfont icon-xiangyou pull-right"></i></a>
				</div>
			</div>
		</div>		<!--综艺-->
		<?php }?>
						<?php if($mkcms_dongman==1){?>
		<!--动漫-->
<div class="container">
<div class="row"  style="margin-top:10px"><?php echo get_ad(7)?></div></div>
		<div class="hy-layout clearfix">
			<div class="hy-video-head">
				<ul class="pull-right">
				<li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./dongman.php?m=/dongman/list.php?cat=100&page=1" class="text-muted border-right">热血</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./dongman.php?m=/dongman/list.php?cat=101&page=1" class="text-muted border-right">恋爱</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./dongman.php?m=/dongman/list.php?cat=102&page=1" class="text-muted border-right">美少女</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./dongman.php?m=/dongman/list.php?cat=103&page=1" class="text-muted border-right">运动</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./dongman.php?m=/dongman/list.php?cat=104&page=1" class="text-muted border-right">校园</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./dongman.php?m=/dongman/list.php?cat=105&page=1" class="text-muted border-right">搞笑</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./dongman.php?m=/dongman/list.php?cat=106&page=1" class="text-muted border-right">幻想</a> /</li>
                <li class="text-muted hidden-md hidden-sm hidden-xs"><a href="./dongman.php?m=/dongman/list.php?cat=107&page=1" class="text-muted border-right">冒险</a> /</li>
					<li class="active"><a href="./dongman.php?m=/dongman/list.php?cat=all%26pageno=1" class="text-muted">更多 <i class="icon iconfont icon-xiangyou"></i></a></li>
				</ul>
				<h3 class="margin-0"><i class="icon iconfont icon-liebiaodaohang_dongman text-color"></i>动漫</h3>
			</div>
			<div class="clearfix">
				  <?php  include './data/dmjx.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<12){
$gul=$listarr[1][$key]; 
$cd=$host.'/alist.php?id='.$gul; 
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
			echo '<div class="col-md-2 col-sm-3 col-xs-4">
							<a class="videopic lazy" href="'.$chuandi.'" title="'.$zname.'" data-original="'.$zimg.'" style="background: url(./style/load.gif) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span><span class="score">'.$jishu.'</span></a>
							<div class="title">
								<h5 class="text-overflow"><a href="'.$chuandi.'">'.$zname.'</a></h5>
							</div>
							<div class="subtitle text-muted text-muted text-overflow hidden-xs">'.$zstar.'</div>
						</div>';
$i ++;		 }
}		 ?>				<div class="hy-video-footer visible-xs clearfix">
					<a href="./dongman.php?m=/dongman/list.php?cat=all%26pageno=1" class="text-muted">查看更多 <i class="icon iconfont icon-xiangyou pull-right"></i></a>
				</div>
			</div>
		</div>		<!--动漫-->
		<?php }?>
<div class="container">
<div class="row"  style="margin-top:10px"><?php echo get_ad(8)?></div></div>
<?php if($mkcms_yq==1){?>
		<div class="hy-layout hidden-sm hidden-xs clearfix">
			<div class="hy-video-head">
				<h3 class="margin-0">友情链接</h3>
			</div>
			<div class="hy-footer-link">
				<div class="item clearfix">
					<ul class="clearfix">
<?php
						$result = mysql_query('select * from mkcms_link');
						while($row = mysql_fetch_array($result)){
						?>
						<a href="<?php echo $row['l_url'];?>" target="_blank"><?php echo $row['l_name'];?></a><?php
						}
						?>
								</ul>
				</div>
			</div>
		</div><?php }?>
		</div></div>
		<script>
	    var swiper = new Swiper('.hy-slide', {
	        pagination: '.swiper-pagination',
	        paginationClickable: true,
	        autoplay: 3000,
	        nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
	    });	    
	    </script>
<?php  include 'footer.php';?>

