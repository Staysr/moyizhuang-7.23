<?php include('../system/inc.php');
include '../system/list.php';
$page=$_GET['page'];?>
<!DOCTYPE html>
<html>
<head lang="en">
<?php  include 'head.php';
$zy='class="weui-state-active"'?>
<title>综艺列表-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="综艺排行,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">
<style>
.hy-head-menu .item .menulist li.act a{ border: 0; background: none; border-bottom: 2px solid #09BB07; color: #09BB07;}
</style>
</head>
<body>
<?php include 'header.php'; ?>
<section class="tuijian_box">
<?php echo get_ad(12)?>
    <div class="bgfff shaixuan clearfix">
    <div class="fl leimu_zui"> 
	<?php 
$b=(strpos($_GET['m'],'rank='));
$ye=substr($_GET['m'],$b+5);
?>
		
        <a <?php if ($ye=="rankhot"){echo 'class="on"';}elseif($ye=="createtime" or $ye=="rankpoint"){}else{ echo 'class="on"';};?> href="?m=/zongyi/list.php?rank=rankhot&page=1">最近热映</a> 
      
    <a  <?php if ($ye=="createtime"){echo 'class="on"';}else{};?> href="?m=/zongyi/list.php?rank=createtime&page=1">最新上映</a>
         

     
        </div>
    <div class="fr shaixuan_2"><a href="javascript:;" id="shaixuan">条件筛选 <em class="shaixuan_icon"><img src="<?php echo $mkcms_domain;?>wap/style/images/icon_y4_03.jpg"></em></a> </div>
 
  </div>
    
        <div class="lebiao_box bgfff shaixuan" style="display: none">
              <div class="biao_li leibiao clearfix">
        <dt><h2 class="leixing"><a href="?m=/zongyi/list.php?cat=all&page=1">全部</a></h2></dt> 
        <div style="width: 90%;float: right">
          <?php
foreach ($zycat as $kcat=>$vcat){ $flname= $zyname[$kcat];
$flid="/zongyi/list.php?cat=".$vcat.'&pageno=1'; 
echo "<dd><a href='?m=$flid' target='_self'>$flname</a></dd>";}?>       
                       

                        
                        
                        </div>
      </div>
                  <div class="biao_li leibiao clearfix">
        <dt><h2 class="leixing"><a href="?m=/zongyi/list.php?area=all&pageno=1">全部</a></h2></dt>
        <div style="width: 90%;float: right">
                
<?php

foreach($zycat1 as $kcat=>$vcat){$flname=$zyname1[$kcat];
$flid='/zongyi/list.php?act='.$vcat.'&page=1';
echo "<dd><a href='?m=$flid' target='_self'>$flname</a></dd>";}?>

                        
                        </div>
      </div>
                  
      <div class="biao_li leibiao clearfix">
        <dt><h2 class="leixing"><a href="?m=/zongyi/list.php?area=all&page=1">全部</a></h2></dt>
        <div style="width: 90%;float: right">
<?php
foreach($zycat2 as $kcat=>$vcat){$flname=$zyname2[$kcat];
$flid='/zongyi/list.php?area='.$vcat.'&page=1';
echo "<dd><a href='?m=$flid' target='_self'>$flname</a></dd>";}?>

                        
                        
                        </div>
      </div>
       
         
    </div>
  </div>
  <div class="dianying_box bgfff clearfix content">
    <ul class="clearfix">
<?php
$flid1=$_GET['m'];
if ($flid1==""){
$flid1='/zongyi/list.php?rank=rankhot&page=1';
}
include '../system/360.php';
foreach ($xname as $key=>$xvau){ $do=$xlist[$key]; 
$do1=$do; 
$cc="./play.php?play="; 
if ($mkcms_wei==1){
$ccb=vod.$do1;
}
else{
$ccb=$cc.$do1;	
}
echo '<li><a href="'.$ccb.'">
<img src="'.$ximg[$key].'"></a>       
<p class="clearfix leimu"><span class="fl"></span><span class="fr">'.$xjishu[$key].'</span></p>
        <a href="'.$ccb.'">
		<span class="biaoti">'.$xvau.'</span></a></li>
        ';
						

						
 } ?>               
      
 
    </ul>  <div class="hy-page clearfix">
				<ul class="cleafix">
<?php include('../system/fenye.php');?>
</ul>
			</div>
  </div>

</section>

<?php  include 'footer.php';?>
