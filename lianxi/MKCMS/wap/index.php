<?php include('../system/inc.php');
$seach=file_get_contents('https://www.360kan.com/');
$szz="# <a href='(.*?)' class='p0 g-playicon js-playicon'><img src='(.*?)' alt='(.*?)' /><span class='title'>(.*?)</span><span class='desc'>(.*?)</span><b></b></a>#";
preg_match_all($szz,$seach,$sarr);
$one=$sarr[1];//标题
$two=$sarr[2];
$three=$sarr[5];?>
<!DOCTYPE html>
<html>
<head lang="en">
<?php  include 'head.php';?>
<title><?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $mkcms_keywords ;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
</head>
<body>
<?php  include 'header.php';
?>

<div class="swiper-container">
<?php echo get_ad(2)?>
    <div class="swiper-wrapper">
	

<?php
						$result = mysql_query('select * from mkcms_slideshow order by s_order desc');
						if($result&&mysql_num_rows($result)){
						while($row = mysql_fetch_array($result)){
						?>
        <div class="swiper-slide">
            
            <a href="<?php echo $row['s_url'];?>">
           
            <img src="<?php echo $row['s_picture'];?>" width="100%" >
            <div style="position: absolute;width: 100%;height: 30px;line-height: 30px;bottom: 0;background: rgba(10, 10, 10, 0.64);color: #fff;"><?php echo $row['s_name'];?></div>
            </a>
        </div>
<?php
 }
}
else{
foreach ($one as $ni=>$cs){
$cs= str_replace('https://www.360kan.com', '', "$cs");
 echo '<div class="swiper-slide">
            
            <a href="./play.php?play='.$cs.'">
           
            <img src="'.$two[$ni].'" width="100%" >
            <div style="position: absolute;width: 100%;height: 30px;line-height: 30px;bottom: 0;background: rgba(10, 10, 10, 0.64);color: #fff;">'.$three[$ni].'</div>
            </a>
        </div>';

}
}?>						
    </div> 
</div>
<?php echo get_ad(3)?>
<?php if($mkcms_qianxian==1){?>
<section class="tuijian_box">
  <h2 class="clearfix tuijian bgfff" ><em class="dianyin"></em>尝鲜<a class="fr more" href="vlist.php?cid=0">更多<em class="more_icon"></em></a></h2>
  <div class="dianying_box  bgfff clearfix">
    <ul class="clearfix">      
      <?php $result = mysql_query('select * from mkcms_vod where d_rec=1 order by d_id desc LIMIT 0,6');
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
			echo '<li><a '.$ok.' href="'.$ccb.'"><img src="'.$row['d_picture'].'"></a>
        <p class="clearfix leimu"><span class="fl"></span><span class="fr">'.get_channel_name($row['d_parent']).'</span></p> 
        <a href="'.$ccb.'"><span class="biaoti">'.$row['d_name'].'</span></a></li>';
		

		}?>	
		
      
           
    </ul>
  </div>
</section>
<?php }?>
<?php echo get_ad(4)?>
<?php if($mkcms_dianying==1){?>
<section class="tuijian_box">
  <h2 class="clearfix tuijian bgfff" ><em class="dianyin"></em>电影推荐<a class="fr more" href="./movie.php">更多<em class="more_icon"></em></a></h2>
  <div class="dianying_box  bgfff clearfix">
    <ul class="clearfix">      
     <?php  include '../data/dyjx2.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<6){
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
echo '<li><a href="'.$playurl.'"><img src="'.$zimg.'"></a>';
if ($fname!="") {
echo '<span class="fenshu">'.$fname.'</span>';
} 
echo '<p class="clearfix leimu"><span class="fl"></span><span class="fr">'.$nname.'</span></p>
        <a href="'.$playurl.'"><span class="biaoti">'.$zname.'</span></a></li>'; 
		
		




$i ++;		 }
} ?>

           
    </ul>
  </div>
</section>
<?php }?>
<?php echo get_ad(5)?>
<?php if($mkcms_dianshi==1){?>
<section class="tuijian_box">
  <h2 class="clearfix tuijian bgfff"><em class="dianshiju"></em>电视剧推荐<a class="fr more" href="./tv.php">更多<em class="more_icon"></em></a></h2>
  <div class="dianying_box  bgfff clearfix">
    <ul class="clearfix">
<?php  include '../data/tvjx.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<6){
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
echo '<li><a href="'.$chuandi.'"><img src="'.$zimg.'"></a>
        <p class="clearfix leimu"><span class="fl"></span><span class="fr">'.$jishu.'</span></p>
        <a href="'.$chuandi.'"><span class="biaoti">'.$zname.'</span></a></li>'; 


$i ++;		 }
}		 ?>      
    </ul>
  </div>
</section>
<?php }?>
<?php echo get_ad(6)?>
<?php if($mkcms_zongyi==1){?>
<section class="tuijian_box">
  <h2 class="clearfix tuijian bgfff"><em class="zongyi"></em>综艺推荐<a class="fr more" href="./zongyi.php">更多<em class="more_icon"></em></a></h2>
  <div class="dianying_box clearfix bgfff">
    <ul class="clearfix">
<?php  include '../data/zyjx.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<6){
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
echo '<li><a href="'.$chuandi.'"><img src="'.$zimg.'"></a>
        <p class="clearfix leimu"><span class="fl"></span><span class="fr">'.$nname.'</span></p>
        <a href="'.$chuandi.'"><span class="biaoti">'.$zname.'</span></a></li>'; 
$i ++;		 }
}		 ?>	     
    </ul>
  </div>
</section>
<?php }?>
<?php echo get_ad(7)?>
<?php if($mkcms_dongman==1){?>
<section class="tuijian_box">
  <h2 class="clearfix tuijian bgfff"><em class="dongman"></em>动漫推荐<a class="fr more" href="./dongman.php">更多<em class="more_icon"></em></a></h2>
  <div class="dianying_box clearfix bgfff">
    <ul class="clearfix">
<?php  include '../data/dmjx2.php'; 
$i=0;
foreach ($namearr[1] as $key => $value) 
{if ($i<6){
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
echo '<li><a href="'.$chuandi.'"><img src="'.$zimg.'"></a>
        <p class="clearfix leimu"><span class="fl"></span><span class="fr">'.$jishu.'</span></p>
        <a href="'.$chuandi.'"><span class="biaoti">'.$zname.'</span></a></li>';
$i ++;		 }
}		 ?>     
    </ul>
  </div>
</section>
<?php }?>

<?php  include 'footer.php';?>

