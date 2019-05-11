<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  include 'head.php';?>
<title>搜索<?php echo $q?>-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $q?>,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
</head>

<body class="vod-search">
<?php  include 'header.php';?>
<div class="container">
	<div class="row">
		<div class="col-md-9 col-sm-12 hy-main-content">
			<div class="hy-layout clearfix">
				<div class="hy-video-head">
					<span class="text-muted pull-right hidden-xs"></span>
					<h4 class="margin-0">搜索到与<span class="text-color">“<?php echo $q?>”</span>相关的影片</h4>
				</div>
				<?php 

	$result = mysql_query('select * from mkcms_vod where d_name like "%'.$q.'%" order by d_id desc');
		while ($row = mysql_fetch_array($result))
{
$tupian=$row['d_picture'];
$cs=$row['d_name'];
$jianjie=$row['d_content'];
$cc="./bplay.php?play=";
$dd="./bplay/";
if ($mkcms_wei==1){
$chuandi=$dd.$row['d_id'];
}
else{
$chuandi=$cc.$row['d_id'];	
}	
?>
				<div class="hy-video-details active clearfix">
					<div class="item clearfix">
						<dl class="content">
							<dt><a class="videopic" href="<?php echo $chuandi?>" style="background: url(<?php echo $tupian?>) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span></a></dt>
							<dd class="clearfix">
							<div class="head">
								<h3><?php echo $cs?></h3>
							</div>
							<div class="score">
								<div class="star">
									<span class="star-cur" id="score-0"></span>
								</div>
								<span class="branch"></span>
								<script type="text/javascript">
												var str = "0%" 
												document.getElementById("score-0").style.width = (str.replace(".", ""))
										    </script>
							</div>
							<ul>
								<li><span><?php echo $row['d_zhuyan']?></span></li>
								<li><span>类型：<?php echo get_channel_name($row['d_parent'])?></span></li>
<li><span class="text-muted">简介：</span><?php echo $jianjie?></li>

							</ul>
							<div class="block">
								<a class="text-muted" href="<?php echo $chuandi?>">查看详情 <i class="icon iconfont icon-right"></i></a>
							</div>
							</dd>
						</dl>
					</div>
				</div>
<?php } ?> 
<?php 
if (!empty($one)){
foreach ($one as $ni=>$cs){ 
$mvsrc1 = str_replace("http://www.360kan.com", "", "$nine[$ni]");
$pingfen = str_replace('<div class="b-tomato"><div class="rating-site yellow"><p class="value">评分：<span>', '', "$liu[$ni]");
$pingfen = str_replace('</span></p></div></div>', '', "$pingfen");
$pingfen = str_replace('    ', '', "$pingfen");
$pingfen = str_replace('<div class="cont">', '', "$pingfen");
$pingfen = str_replace('<h3 class="title">', '', "$pingfen");
$pingfen = str_replace(array("\r\n", "\r", "\n"), '', "$pingfen");
$pingfen = str_replace('<div class="b-tomato"><div class="rating-site red"><p class="value">评分：<span>', '', "$pingfen");
$pingfen = str_replace('<div class="b-tomato"><div class="rating-site green"><p class="value">评分：<span>', '', "$pingfen");
$jianjie= str_replace("data-desc='", '', "$ba[$ni]");
$jianjie= str_replace("'>", '', "$jianjie");
$tupian=$two[$ni];
if ($mkcms_wei==1){
$chuandi='../../vod'.$mvsrc1;
}
else{
$chuandi='./play.php?play='.$mvsrc1;	
}//结束
$d_scontent=explode(',',$mkcms_shoufei);
for($i=0;$i<count($d_scontent);$i++)
{
if($cs==$d_scontent[$i]){
//提示错误值
$xianshi='style="display:none"';
     }	

}
?>
<div class="hy-video-details active clearfix" <?php echo $xianshi?>>
					<div class="item clearfix">
						<dl class="content">
							<dt><a class="videopic" href="<?php echo $chuandi?>" style="background: url(<?php echo $tupian?>) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span></a></dt>
							<dd class="clearfix">
							<div class="head">
								<h3><?php echo $cs?><?php echo $three[$ni]?></h3>
							</div>
							<div class="score">
								<div class="star">
									<span class="star-cur" id="score-<?php echo $pingfen?>"></span>
								</div>
								<span class="branch"><?php echo $pingfen?></span>
								<script type="text/javascript">
												var str = "<?php echo $pingfen?>%" 
												document.getElementById("score-<?php echo $pingfen?>").style.width = (str.replace(".", ""))
										    </script>
							</div>
							<ul>
								<li><?php echo $si[$ni]?></li>
								<li><?php echo $wu[$ni]?></li>
<li><span class="text-muted">简介：</span><?php echo $jianjie?></li>

							</ul>
							<div class="block">
								<a class="text-muted" href="<?php echo $chuandi?>">查看详情 <i class="icon iconfont icon-right"></i></a>
							</div>
							</dd>
						</dl>
					</div>
				</div>

<?php } 
}else{
	
foreach ($mingxing as $k=>$mx){ 
$mvsrc1 = str_replace("http://www.360kan.com", "", "$mingxing[$k]");
$tupian=$mingxing1[$k];
$title=$mingxing2[$k];
$jishu=$mingxing3[$k];
if ($mkcms_wei==1){
$chuandi='../../vod'.$mvsrc1;
}
else{
$chuandi='./play.php?play='.$mvsrc1;	
}//结束

?>
<div class="hy-video-details active clearfix">
					<div class="item clearfix">
						<dl class="content">
							<dt><a class="videopic" href="<?php echo $chuandi?>" style="background: url(<?php echo $tupian?>) no-repeat; background-position:50% 50%; background-size: cover;"><span class="play hidden-xs"></span></a></dt>
							<dd class="clearfix">
							<div class="head">
								<h3><?php echo $title?><?php echo $jishu?></h3>
							</div>

							<ul>
<li><span class="text-muted">主演：</span><?php echo $q?></li>
							</ul>
							<div class="block">
								<a class="text-muted" href="<?php echo $chuandi?>">查看详情 <i class="icon iconfont icon-right"></i></a>
							</div>
							</dd>
						</dl>
					</div>
				</div>
<?php } ?> 
<?php } ?> 
				</div>
		</div>
	<div class="col-md-3 col-sm-12 hy-main-side hidden-sm hidden-xs">
			<div class="hy-layout clearfix">
				<div class="hy-video-ranking side clearfix">
					<div class="head">
						<a class="text-muted pull-right" href="<?php echo $mkcms_domain;?>movie.html?m=/dianying/list.php?cat=all%26pageno=1">更多 <i class="icon iconfont icon-right"></i></a>
						<h4><i class="icon iconfont icon-top text-color"></i> 电影排行榜</h4>
					</div>
					<div class="item">
						<ul class="clearfix">
				      <?php 
				      include './data/bangdan.php';
				      foreach ($bdArr['dy']['title'] as $k=>$title){
						
						$bdurl=$bdArr['dy']['url'][$k];//url
						$bdurl = str_replace("http://www.360kan.com", "", $bdurl);
						$bdnum=$bdArr['dy']['num'][$k];//num

						if ($mkcms_wei==1){
							$chuandi='./vod'.$bdurl;
						}
						else{
							$chuandi='./play.php?play='.$bdurl;	
						}
						  echo "<li class='text-overflow '><span class='pull-right text-color'>$bdnum</span><a href='$chuandi' title='$title'><em class='number active'>></em>$title</a></li>";

				      }
				      
				      
				      ?>
						</ul>
					</div>
				</div>
				<div class="hy-video-ranking side clearfix">
					<div class="head">
						<a class="text-muted pull-right" href="<?php echo $mkcms_domain;?>tv.html?u=/dianshi/list.php?cat=all%26pageno=1">更多 <i class="icon iconfont icon-right"></i></a>
						<h4><i class="icon iconfont icon-top text-color"></i> 电视剧排行榜</h4>
					</div>
					<div class="item">
						<ul class="clearfix">
						<?php 
						 foreach ($bdArr['tv']['title'] as $k=>$title){
						
						$bdurl=$bdArr['tv']['url'][$k];//url
						$bdurl = str_replace("http://www.360kan.com", "", $bdurl);
						$bdnum=$bdArr['tv']['num'][$k];//num
						
						if ($mkcms_wei==1){
							$chuandi='./vod'.$bdurl;
						}
						else{
							$chuandi='./play.php?play='.$bdurl;	
						}
						  echo "<li class='text-overflow '><span class='pull-right text-color'>$bdnum</span><a href='$chuandi' title='$title'><em class='number active'>></em>$title</a></li>";

				      }
      
      
      					?>	

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	    var swiper = new Swiper('.hy-slide', {
	        pagination: '.swiper-pagination',
	        paginationClickable: true,
	        autoplay: 3000,
	    });	    
	    </script>
</font>
<?php  include 'footer.php';?>