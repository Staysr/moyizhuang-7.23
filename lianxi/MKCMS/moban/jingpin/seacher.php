<?php  include 'head.php';?>
<title>搜索<?php echo $q?>-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $q?>,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body>
<?php  include 'header.php';?>
<div class="container">
   <div class="row">
    <div class="col-lg-wide-75 col-xs-1 padding-0">
     <div class="stui-pannel stui-pannel-bg clearfix">
      <div class="stui-pannel-box">
       <div class="stui-pannel_hd">
        <div class="stui-pannel__head active bottom-line clearfix">
         <span class="more text-muted pull-right hidden-xs"></span>
         <h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_25.png" />与“<?php echo $q?>”相关的影片</h3>
        </div>
       </div>
       <div class="stui-pannel_bd">
        <ul class="stui-vodlist__media col-pd clearfix">
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
		 <li class ="activeclearfix">
          <div class="thumb">
           <a class="v-thumb stui-vodlist__thumb lazyload" href="<?php echo $chuandi?>" title="<?php echo $cs?>" data-original="<?php echo $tupian?>"><span class="play hidden-xs"></span>
		   <span class="pic-text text-right"></span></a>
          </div>
		  <div class="detail">
           <h3 class="title"><a href="<?php echo $chuandi?>"><?php echo $cs?></a></h3>
           <p class="data"><span class="text-muted hide">导演：</span></p>
           <p class="data"><span class="text-muted hide">主演：</span></p>
           <p class="data hide">
		   <span class="text-muted">类型：</span><span class="split-line"></span>
		   <span class="text-muted hide">地区：</span><span class="split-line hide"></span>
		   <span class="text-muted hide">年份：</span></span></p>
           <p class="margin-0 hidden-smss hidden-xss"><span class="text-muted">简介：</span><?php echo $jianjie?></p>
		   <p class="margin-0 hidden-smss hidden-xss"><a class="text-muted" href="<?php echo $chuandi?>">查看详情</a></p>
          </div>
         </li>
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
		 <li class ="activeclearfix" <?php echo $xianshi?>>
          <div class="thumb">
           <a class="v-thumb stui-vodlist__thumb lazyload" href="<?php echo $chuandi?>" title="<?php echo $cs?>" data-original="<?php echo $tupian?>"><span class="play hidden-xs"></span>
		   <span class="pic-text text-right"></span></a>
          </div>
		  <div class="detail">
           <h3 class="title"><a href="<?php echo $chuandi?>"><?php echo $cs?></a></h3><br>
            <p class="margin-0 hidden-smss hidden-xss"><span class="text-muted">简介：</span><?php echo $jianjie?></p><br>
      <p class="margin-0 hidden-smss hidden-xss"><a class="text-muted" href="<?php echo $chuandi?>">查看详情</a></p>
          </div>
         </li>
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
		 <li class ="activeclearfix" <?php echo $xianshi?>>
          <div class="thumb">
           <a class="v-thumb stui-vodlist__thumb lazyload" href="<?php echo $chuandi?>" title="<?php echo $title?>" data-original="<?php echo $tupian?>"><span class="play hidden-xs"></span>
		   <span class="pic-text text-right"></span></a>
          </div>
		  <div class="detail">
           <h3 class="title"><a href="<?php echo $chuandi?>"><?php echo $title?></a></h3><br>
           <p class="data"><span class="text-muted">主演：<?php echo $q?></span></p><br>
           <p class="data"><span class="text-muted"> <a class="text-muted" href="<?php echo $chuandi?>">查看详情 <i class="icon iconfont icon-right"></i></a></span></p>
          </div>
         </li>
<?php } ?> 
<?php } ?>
		          </ul>
	  
       </div>
					   
      </div>
     </div>
     
    </div>
    <div class="col-lg-wide-25 stui-pannel-side hidden-md hidden-sm hidden-xs">
     <div class="stui-pannel stui-pannel-bg clearfix">
      <div class="stui-pannel-box">
       <div class="stui-pannel_hd">
        <div class="stui-pannel__head active bottom-line clearfix">
         <h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_1.png" />影片热度排行榜</h3>
        </div>
       </div>
       <div class="stui-pannel_bd clearfix">
	    <ul class="stui-vodlist__text active col-pd clearfix">
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
		  echo "<li class='col-xs-1 padding-0'><a class='text-overflow' href='$chuandi' title='$title'><span class='text-muted pull-right'>$bdnum</span>
		 <em class='text-red'></em>$title</a></li>";

      }
      ?>
		       </ul>
       </div>
      </div>
     </div>
	 <div class="stui-pannel stui-pannel-bg clearfix">
      <div class="stui-pannel-box">
       <div class="stui-pannel_hd">
        <div class="stui-pannel__head active bottom-line clearfix">
         <h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_2.png" />剧集热度排行榜</h3>
        </div>
       </div>
       <div class="stui-pannel_bd clearfix">
	    <ul class="stui-vodlist__text active col-pd clearfix">
      <?php
	   include './data/bangdan.php';
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
		  echo "<li class='col-xs-1 padding-0'><a class='text-overflow' href='$chuandi' title='$title'><span class='text-muted pull-right'>$bdnum</span>
		 <em class='text-red'></em>$title</a></li>";

      }
      ?>
		       </ul>
       </div>
      </div>
     </div>

    </div>
   </div>
 
<?php  include 'footer.php';?>