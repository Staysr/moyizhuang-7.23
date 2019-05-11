<?php  include 'head.php';?>
<title>视频列表-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="视频排行,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
</head>
<body >
<?php include 'header.php'; ?>
<div class="container">
<div class="row">
<!-- 幻灯片 -->
<?php echo get_ad(9)?>
<div class="stui-pannel stui-pannel-bg clearfix">
<div class="stui-pannel-box">
<div class="stui-pannel_hd">
<div class="stui-pannel__head active bottom-line clearfix">

<h3 class="title"><img src="<?php echo $mkcms_domain;?>moban/<?php echo $mkcms_bdyun;?>/img/icon_25.png">电影频道</h3>
</div>
</div>

 <div class="stui-pannel stui-pannel-bg clearfix"> 
   <div class="fed-screen-list fed-layout fed-bgc-white fed-row"> 
    <dl class="fed-col-sx12 fed-col-sm6 fed-col-md12"> 
<dd><a href="vlist.php?cid=0?cid=0" class="acat" style="white-space: pre-wrap;">全部</a></dd>
<?php
$result = mysql_query('select * from mkcms_vod_class where c_pid=0 order by c_id asc');
while ($row = mysql_fetch_array($result)){

			echo '<dd><a href="vlist.php?cid=0?cid='.$row['c_id'].'" class="acat" style="white-space: pre-wrap;margin-bottom: 4px;">'.$row['c_name'].'</a></dd>';
		}
?>
<?php
if ($_GET['cid'] != 0){
	?>
<?php
$result = mysql_query('select * from mkcms_vod_class where c_pid='.$_GET['cid'].' order by c_sort desc,c_id asc');
while ($row = mysql_fetch_array($result)){

			echo '<dd><a href="vlist.php?cid=0?cid='.$row['c_id'].'" class="acat" style="white-space: pre-wrap;margin-bottom: 4px;">'.$row['c_name'].'</a></dd>';
		}
?>
<?php }?>
    </dl> 
   </div> 
  </div>
<div class="stui-pannel_hd">
<div class="stui-pannel__head active bottom-line clearfix">
<span class="more text-muted pull-right hidden-xs">千万部VIP视频免费等你观看</span>

</div>
</div>

<div class="stui-pannel_bd">
<ul class="stui-vodlist clearfix">
<?php
							if (isset($_GET['cid'])) {
								if ($_GET['cid'] != 0){
									$sql = 'select * from mkcms_vod where d_parent in ('.$_GET['cid'].') order by d_id desc';
									$pager = page_handle('page',24,mysql_num_rows(mysql_query($sql)));
									$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								}else{
									$sql = 'select * from mkcms_vod order by d_id desc';
									$pager = page_handle('page',24,mysql_num_rows(mysql_query($sql)));
									$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								}
							}
							while($row= mysql_fetch_array($result)){
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
echo "<li class='col-md-6 col-sm-4 col-xs-3'>
<div class='stui-vodlist__box'>
<a class='stui-vodlist__thumb lazyload' ".$ok." href='".$ccb."' title='".$row['d_name']."' data-original='".$row['d_picture']."' >
<span class='play hidden-xs'></span>
                            
<span class='pic-text text-right'></span></a>
<div class='stui-vodlist__detail'>
<h4 class='title text-overflow'><a href='".$ccb."' title='".$row['d_name']."'>".$row['d_name']."</a></h4>
<p class='text text-overflow text-muted hidden-xs'>".$row['d_zhuyan']."</p>
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
<?php echo page_show($pager[2],$pager[3],$pager[4],2);?>
</ul>
</div>

<div class="row"  style="margin-top:0px"><?php echo get_ad(8)?></div></div>
<?php  include 'footer.php';?>
