<?php
include ('./inc/aik.config.php');
include ('./inc/aik.adsconfig.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv=“X-UA-Compatible” content=“chrome=1″ />
  <meta http-equiv=“X-UA-Compatible” content=“IE=8″>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cache-control" content="no-siteapp">
<title><?php echo $aik['title'];?></title>
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/index.css' type='text/css' media='all' />
<link href="css/huandeng.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/slider.js"></script>
<meta name="keywords" content="<?php echo $aik['keywords'];?>">
<meta name="description" content="<?php echo $aik['description'];?>">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
  <style type="text/css">
.pc_acmsd{display:block;}
.m_acmsd{ display:none}
@media(max-width:801px) {
.pc_acmsd{display:none !important;}
.m_acmsd{display:block !important;}}
</style>
</head>
<body class="home blog">
<?php  include 'header.php';?>
  <div class="pc_acmsd">
   <!-- 轮播广告 -->
    <div id="banner_tabs" class="flexslider">
        <ul class="slides">
            <li>
                <a target="_blank" href="<?php echo $adaik['huandeng_url_1'];?>">
                    <img width="1920" height="482" alt="" style="background: url(<?php echo $adaik['huandeng_1'];?>) no-repeat center;" src="images/alpha.png">
                </a>
            </li>
            <li>
                <a href="<?php echo $adaik['huandeng_url_2'];?>">
                    <img width="1920" height="482" alt="" style="background: url(<?php echo $adaik['huandeng_2'];?>) no-repeat center;" src="images/alpha.png">
                </a>
            </li>
            <li>
                <a href="<?php echo $adaik['huandeng_url_3'];?>">
                    <img width="1920" height="482" alt="" style="background: url(<?php echo $adaik['huandeng_3'];?>) no-repeat center;" src="images/alpha.png">
                </a>
            </li>
                      <li>
                <a href="<?php echo $adaik['huandeng_url_4'];?>">
                    <img width="1920" height="482" alt="" style="background: url(<?php echo $adaik['huandeng_4'];?>) no-repeat center;" src="images/alpha.png">
                </a>
            </li>
            <li>
                <a href="<?php echo $adaik['huandeng_url_5'];?>">
                    <img width="1920" height="482" alt="" style="background: url(<?php echo $adaik['huandeng_5'];?>) no-repeat center;" src="images/alpha.png">
                </a>
            </li>
        </ul>
        <ul class="flex-direction-nav">
            <li><a class="flex-prev" href="javascript:;">Previous</a></li>
            <li><a class="flex-next" href="javascript:;">Next</a></li>
        </ul>
        <ol id="bannerCtrl" class="flex-control-nav flex-control-paging">
            <li><a>1</a></li>
            <li><a>2</a></li>
            <li><a>3</a></li>
            <li><a>4</a></li>
            <li><a>5</a></li>
        </ol>
    </div>
    <script type="text/javascript">
    $(function() {
        var bannerSlider = new Slider($('#banner_tabs'), {
            time: 5000,
            delay: 400,
            event: 'hover',
            auto: true,
            mode: 'fade',
            controller: $('#bannerCtrl'),
            activeControllerCls: 'active'
        });
        $('#banner_tabs .flex-prev').click(function() {
            bannerSlider.prev()
        });
        $('#banner_tabs .flex-next').click(function() {
            bannerSlider.next()
        });
    })
    </script>
			</div>
  <div class="m_acmsd">
 <script language="JavaScript" type="text/javascript">
//随机显示广告代码
tips = new Array(5);
tips[0] = '<?php echo $adaik['m_suiji_1'];?>';
tips[1] = '<?php echo $adaik['m_suiji_2'];?>';
tips[2] = '<?php echo $adaik['m_suiji_3'];?>';
tips[3] = '<?php echo $adaik['m_suiji_4'];?>';
tips[4] = '<?php echo $adaik['m_suiji_5'];?>';
index = Math.floor(Math.random() * tips.length);
document.write(tips[index]);
</script>
  </div>
<div id="homeso">
<form method="post" id="soform" style="text-align: center;float: none" action="./seacher.php">
<center><?php echo $aik['logo_ss'];?></center><br><br>
<input tabindex="2" class="homesoin" id="sos" name="wd" type="text" placeholder="输入你要观看的视频" value="">
<button id="button" tabindex="3" class="homesobtn" type="submit"><i class="fa">观看</i></button>
</form>
</div>
<!--<section class="container">
<div class="single-strong">最新热门电影推荐<span class="chak"><a href="./movie.php?m=http://www.360kan.com/dianying/list.php?cat=all%26pageno=1">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php 
        include './data/dyjx.php';
       foreach ($namearr[1] as $key => $value)
       {   
           $gul=$yuming.$listarr[1][$key];//取出播放链接
           $cd=$host.'/alist.php?id='.$gul;
           $guq=$listarr[1][$key];
           $_GET['id']=$gul;
           //echo $guq;
           $zimg=$imgarr[1][$key];//取出图片链接
           $zname=$namearr[1][$key];//取出影片名字
		   $fname=$fnamearr[1][$key];//取出影片评分
		   $nname=$nnamearr[1][$key];//取出影片年份
           $zstar=$stararr[1][$key];
           $jiami=base64_encode($gul);
           $tok=base64_encode($gul);
           //echo $zname;
           //echo $gul;//取出播放链接
           $chuandi=$host.'/inc/b.php?id='.$jiami;
           echo "
		  <li  class='item'><a class='js-tongjic' href='./play.php?play=$tok' title='$zname' target='_blank'>
         <div class='cover g-playicon'>
          <img src='$zimg' alt='$zname' />
          <span class='pay'>推荐</span><span class='hint'>$nname</span>
         </div>
         <div class='detail'>
          <p class='title g-clear'>
		    <span class='s1'>$zname</span>
			<span class='s2'>$fname</span></p>
           <p class='star'>$zstar</p>
          </div>
         </a></li>";
       }
?>
</ul>
</div>
</div>
<div class="single-strong">最新热门电视剧推荐<span class="chak"><a href="./tv.php?u=http://www.360kan.com/dianshi/list.php?cat=all%26pageno=1">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php 
       include './data/tvjx.php';
       foreach ($namearr[1] as $key => $value)
       {
           $gul=$yuming.$listarr[1][$key];//取出播放链接
           $cd=$host.'/alist.php?id='.$gul;
           $guq=$listarr[1][$key];
           $_GET['id']=$gul;
           //echo $guq;
           $zimg=$imgarr[1][$key];//取出图片链接
           $zname=$namearr[1][$key];//取出影片名字
		   $nname=$nnamearr[1][$key];//取出影片年份
           $zstar=$stararr[1][$key];
           $jiami=base64_encode($gul);
           //echo $zname;
           //echo $gul;//取出播放链接
           $chuandi='./play.php?play='.$jiami;
           echo "<li class='item'><a class='js-tongjic' href='$chuandi' title='$zname'>
         <div class='cover g-playicon'>
          <img src='$zimg' alt='$zname' />
          <span class='hint'>$nname</span>
         </div>
         <div class='detail'>
		 <p class='title g-clear'>
           <span class='s1'>$zname</span>
           <span class='s2'></span></p>
         <p class='star'>$zstar</p>
          </div>
         </a></li>";
       }
?>
</ul>
</div>
</div>
</section> -->
<?php  include 'footer.php';?>
</body>
</html>