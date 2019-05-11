<?php
$fang=$_GET['play']; 
$yuming='http://www.360kan.com';
$jmfang= $yuming.$fang;
$like=file_get_contents($jmfang); 
$likezz="#<li  title='(.*?)' class='w-newfigure w-newfigure-(.*?)'><a href='(.*?)'#"; 
$likeimg="#<li  title='(.*?)' class='w-newfigure w-newfigure-(.*?)'><a href='(.*?)'  class='js-link'><div class='w-newfigure-imglink g-playicon js-playicon'> <img src='(.*?)' data-src='(.*?)' alt='(.*?)'  />#"; 
preg_match_all($likezz, $like,$likearr); 
preg_match_all($likeimg, $like,$likearr1); 
$likename=$likearr1[1]; 
$likeurl=$likearr1[3]; 
$likeimg=$likearr1[5]; 

if(count($likename) == 0){
  $likedm1="#<li class='g-clear'([\s\S]*?)</li>#"; 
  preg_match_all($likedm1, $like,$likedmwy1); 
  $likedm2="#<img src=\"(.*?)\" data-src='(.*?)'>#"; 
  $likedm3="#<p class='title'><a href='(.*?)' data-index=(.*?)>(.*?)</a></p>#"; 
  preg_match_all($likedm2, $like,$likedmwy2); 
  preg_match_all($likedm3, $like,$likedmwy3);
  
  $likename=$likedmwy3[3]; 
  $likeurl=$likedmwy3[1]; 
  $likeimg=$likedmwy2[2]; 

  
}

foreach ($likename as $ks=>$vs){

$host1=$likeurl[$ks]; 
$hjiami=$host1; 
if ($mkcms_wei==1){
$chuandi='../../vod'.$hjiami;
}
else{
$chuandi='./play.php?play='.$hjiami;	
}
	echo "  <div class='swiper-slide'>
								<div class='item'>
									<a class='videopic lazy mkcms' href='$chuandi' title='$vs' data-original='$likeimg[$ks]' style='background: url($likeimg[$ks]) no-repeat; background-position:50% 50%; background-size: cover;'><span class='play hidden-xs'></span><span class='score'>推荐</span></a>
									<div class='title'>
										<h5 class='text-overflow'><a href='$chuandi'>$vs</a></h5>
									</div>
									<div class='subtitle text-muted text-muted text-overflow hidden-xs'>
																			</div>
								</div>
							</div>";
							
							
 } ?>