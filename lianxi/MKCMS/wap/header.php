<section class="logo_box clearfix">
  <div class="fl"> <a href="<?php echo $mkcms_domain;?>wap/"><img class="logo_img" src="<?php echo $mkcms_logo;?>"></a> </div>
  <div class="sosuo_box fl">
    <form  action="<?php echo $mkcms_domain;?>wap/seacher.php" method="post" role="form">
    <input class="btn_com btn_sosuo" type="text" placeholder="请输入影视、电视剧关键词、支持拼音" name="wd" value="">
    </form>
  </div>
  <div class="fr"><a class="tanchu" href="javascript:void(0)"><em class="jilu"></em></a></div>
</section>
<div id="tagnav" class="weui-navigator weui-navigator-wrapper"> 
  <ul class="weui-navigator-list">
<li><a href="<?php echo $mkcms_domain;?>wap/">首页</a></li>
					<?php if($mkcms_dianying==1){?><li <?php echo $movie;?>><a href="<?php echo $mkcms_domain;?>wap/movie.php">电影</a></li><?php }?>
					<?php if($mkcms_dianshi==1){?><li <?php echo $tv;?>><a href="<?php echo $mkcms_domain;?>wap/tv.php">电视剧</a></li><?php }?>
					<?php if($mkcms_dongman==1){?><li <?php echo $dm;?>><a href="<?php echo $mkcms_domain;?>wap/dongman.php">动漫</a></li><?php }?>
					<?php if($mkcms_zongyi==1){?><li <?php echo $zy;?>><a href="<?php echo $mkcms_domain;?>wap/zongyi.php">综艺</a></li><?php }?>

										<?php
						$result = mysql_query('select * from mkcms_nav order by id asc');
						while($row = mysql_fetch_array($result)){
						?>
<li class="act<?php echo $row['id'];?>"><a href="<?php echo $row['n_url'];?>" target="_blank"><?php echo $row['n_name'];?></a></li>
<?php
						}
						?>
  </ul>
</div>

<section class="guanzhu_box">
<a class="jishu fl guanzhu" style="background: none;color: #fff;font-weight:bold;text-aligin：center"><?php echo $mkcms_tixing;?></a>
<a class="guanzhu fl" ></a>
<a class="fr" href="javascript:;"><em class="close"></em></a>
</section>

<style type="text/css"> 
#gongao{width:100%;overflow:hidden;} 
#gongao #scroll_begin, #gongao #scroll_end{display:inline} 
</style> 
<script type="text/javascript"> 
function ScrollImgLeft(){ 
var speed=25; 
var scroll_begin = document.getElementById("scroll_begin"); 
var scroll_end = document.getElementById("scroll_end"); 
var scroll_div = document.getElementById("scroll_div"); 
scroll_end.innerHTML=scroll_begin.innerHTML; 
function Marquee(){ 
if(scroll_end.offsetWidth-scroll_div.scrollLeft<=0) 
scroll_div.scrollLeft-=scroll_begin.offsetWidth; 
else 
scroll_div.scrollLeft++; 
} 
var MyMar=setInterval(Marquee,speed); 
scroll_div.onmouseover=function() {clearInterval(MyMar);} 
scroll_div.onmouseout=function() {MyMar=setInterval(Marquee,speed);} 
} 
</script>
<section class="gonggao_box clearfix">
  <div class="gonggao_box2 clearfix"> <span class="gonggao fl">公告</span>
  
      <div id="gongao" class="fl xianshi" style="width: 82%;height: 27px"> 
        <div style="width:100%;height:27px;margin:0 auto;white-space: nowrap;overflow:hidden;" id="scroll_div" class="scroll_div"> 
        <div id="scroll_begin"> 
         <a class="guanzhu" href="" style="background: none;color: #000"><?php echo $mkcms_gonggao?></a>
        </div> 
        <div id="scroll_end">  
         <a class="guanzhu" href="" style="background: none;color: #000"><?php echo $mkcms_gonggao?></a>
        </div> 
        </div> 
        <script type="text/javascript">ScrollImgLeft();</script> 
        </div>
    
  </div>
</section>
