<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($ting_name); ?></title>
<meta name="keywords" content="<?php echo ($ting_skeywords); ?>">
<meta name="description" content="<?php echo (msubstr(h($ting_sdescription),0,100)); ?>...">       
<script language="javascript"><!-- 
window.onerror=function(){return true;} 
// --></script>
<link href="<?php echo ($apicss); ?>v256/css/base.css" type="text/css" rel="stylesheet">  
<script type="text/javascript"> <?php if(!empty($mobile_status)): ?>var Siteurl='<?php echo rtrim($murl,'/');?>'; var Mvodurl='<?php echo rtrim($murl,'/'); echo ($thisurl); ?>'; <?php else: ?>var Siteurl='<?php echo ($siteurl); ?>'; var Mvodurl='<?php echo rtrim($siteurl,'/'); echo ($thisurl); ?>';<?php endif; ?> Root='<?php echo ($root); ?>';var Sid='<?php echo ($sid); ?>';var Cid='<?php echo ($list_id); ?>';<?php if($sid == 1): ?>var Id='<?php echo ($ting_id); ?>';<?php else: ?>var Id='<?php echo ($news_id); ?>';<?php endif; ?></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/jquery.qrcode.min.js"></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/scrollbar.js"></script>

<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/lazyload.js"></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/v256.js"></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/playclass.js"></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/jquery.base.js"></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/js.js"></script>
<?php if(!empty($mobile_status)): ?><link rel="canonical" href="<?php echo rtrim($siteurl,'/'); echo ($thisurl); ?>"/>
<meta name="mobile-agent" content="format=xhtml;url=<?php echo rtrim($murl,'/'); echo ($thisurl); ?>" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="Cache-Control" content="no-transform" />
<script src="<?php echo ($apicss); ?>v256/js/uaredirectforpc.js" type="text/javascript"></script>
<script type="text/javascript">uaredirect("<?php echo rtrim($murl,'/'); echo ($thisurl); ?>");</script><?php endif; ?>
<?php $cattvlist = getlistmcat($tv_id); ?>
<?php $catmovlist = getlistmcat($mov_id); ?>
<?php $catdmlist = getlistmcat($dm_id); ?>
<?php $catzylist = getlistmcat($zy_id); ?>
<?php $catweilist = getlistmcat($wei_id); ?>
<?php $array_listtvid = getlistall($tv_id); ?>
<?php $array_listmovid = getlistall($mov_id); ?>

<?php $listarray = getlistmcat($list_id); ?>  
<link rel="stylesheet" href="/v256/tingcss/smusic.css"/>   
</head>
<body>
                <div class="top-layout" id="J-fixtop">
            <div class="top-wrap fn-clear">
                <h1><a href="<?php echo ($siteurl); ?>"><?php echo ($sitename); ?></a></h1>  
                <div class="search-wrap">
                    <form method="post" action="<?php echo str_replace('-wd--p-1','',UU('Home-ting/search','',true,false));?>">
                        <div class="search-l">
                            <i class="iconfont">&#xe601;</i>
                            <input autocomplete="off" id="wd" name="wd" type="text" value="输入作品名或主播。" onfocus="if(this.value=='输入作品名或主播。'){this.value='';}" onblur="if(this.value==''){this.value='输入作品名或主播。';};" autocomplete="off" class="search-text1">
                        </div>
                        <input type="submit" value="搜 索" class="search-btn" id="btn"></form>
                            <div class="search-list">
      <div class="search-list-left fn-left">
        <ul class="search-list-ul" id="search-list-ul">

        </ul>
      </div>
      
      <div class="search-list-right fn-right">
        <div class="slr-inner" id="slr-inner">
        </div>
      </div>
    <div class="search-list-right"></div>
    </div><!--search-list-->
                </div>
               
            </div>
        </div>
        <div class="navgation-layout">
            <div class="navgation-wrap fn-clear">
                <div class="navgation-left">
                    <a href="<?php echo ($siteurl); ?>" <?php if(($list_id) == ""): if( $sid['sid'] > ''): else: ?>class="on"<?php endif; endif; ?>><i class="iconfont"></i><em>首页</em></a>
                    <?php if(is_array($list_menu)): $i = 0; $__LIST__ = $list_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvod): $mod = ($i % 2 );++$i; if(($ppvod["list_pid"]) == "0"): ?><a href="<?php echo ($ppvod["list_url"]); ?>"  <?php if(($sid["sid"]) == "story"): else: if(($ppvod["list_id"]) == $list_id): ?>class="on"<?php endif; if(($ppvod["list_id"]) == $list_pid): ?>class="on"<?php endif; endif; ?>><i class="iconfont"></i><em><?php echo ($ppvod["list_name"]); ?></em></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                 </div>
               
            </div>
            <div class="navgation-shodw"></div>
        </div>

<div class="film-detail-layout fn-clear"> 
                <div class="film-detail-img">
                    <a href="<?php echo ($ting_readurl); ?>" class="play_btn" rel="nofollow" target="_blank"> <img src="<?php echo ($ting_picurl); ?>" alt="<?php echo ($ting_name); ?>" /><?php if(($list_pid == $tv_id) OR ($list_id == $zy_id) OR ($list_id == $dm_id)): if(($ppting["ting_continu"]) != "0"): ?><i class="updating"></i><?php endif; endif; ?><span class="hide-bg"></span><span class="hide-btn hover"></span>
                    </a>
                </div>
                <input type='hidden' name='_void_id' id='_void_id' value='<?php echo ($ting_id); ?>'/>
                <div class="film-detail-con">
        
       
                    <i class="film-detail-icon"></i>
                    <div class="fd-box">
                        <div class="fd-box-t fn-clear">
                            <h1><?php echo ($ting_name); ?></h1>
                               <?php if(($ting_continu) != "0"): if(!empty($ji)): ?><div class="ting_z">更新至<font color="#FF3300"><?php echo ($ji); ?></font><?php if(($list_id) == $zy_id): ?>期<?php else: ?>集<?php endif; if(!empty($ting_total)): ?>&nbsp;&nbsp;|&nbsp;&nbsp;共<?php echo preg_replace('/\D/s', '', $ting_total); ?>集<?php endif; ?></div><?php endif; endif; ?>

                        </div>

                    
                     

                             <div class="update-last-time">
                     <div id="detail-rating" class="fn-left">
		  <div id="detail-rating" class="fn-clear">
          <div id="rating" class="fn-left"><span class="label">给影片评分：</span>
            <ul class="rating">
              <li class="one current" title="很差" val="1">很差</li>
              <li class="two current" title="较差" val="2">较差</li>
              <li class="three current" title="还行" val="3">还行</li>
              <li class="four" title="推荐" val="4">推荐</li>
              <li class="five" title="力荐" val="5">力荐</li>
            </ul>
            <span id="ratewords">还行</span></div>
        </div>
			</div>
             <div class="ting-info ui-boxb" id="detail-box">
	  <div class="rating-box" id="rating-main" style="display: block;"><div class="rating-total fn-clear"><label class="rating-total-item" id="total">&nbsp;</label><div class="pingfen-total"><strong id="pingfen"></strong><em id="pingfen2"></em></div></div><div class="rating-panle"><div class="rating-bar"><div class="rating-bar-item" id="fenshu">&nbsp;</div></div><ul class="rating-show"><li><span title="力荐" class="starstop star5">力荐</span><div class="power"><div class="power-item" id="pam"></div></div><em id="pa">人</em></li><li><span title="推荐" class="starstop star4">推荐</span><div class="power"><div class="power-item" id="pbm"></div></div><em id="pb">人</em></li><li><span title="还行" class="starstop star3">还行</span><div class="power"><div class="power-item" id="pcm"></div></div><em id="pc">人</em></li><li><span title="较差" class="starstop star2">较差</span><div class="power"><div class="power-item" id="pdm"></div></div><em id="pd">人</em></li><li><span title="很差" class="starstop star1">很差</span><div class="power"><div class="power-item" id="pem"></div></div><em id="pe">人</em></li></ul></div></div>
	  <div class="rating-box" id="rating-kong" style="display: none;"><div class="rating-kong-item"><span class="loadingg">评分加载中...</span></div></div></div>  
                    </div><!--update-last-time-->       
                        <p class="fd-list ting-jj"><span>介绍：<?php echo strip_tags($ting_content);?></span></p>
                                           
<!--                        <div class="fd-play-box fn-clear">
                            <div id="ad7" class="fn-left"></div>
                        </div>-->
            </div>
        </div>
 </div>
   <div class="grid-music-container f-usn">
    <div class="m-music-play-wrap">
        <div class="u-cover"></div>
        <div class="m-now-info">
            <h1 class="u-music-title"><strong><?php echo ($ting_name); ?></strong><small>主播</small></h1>
            <div class="m-now-controls">
                <div class="u-control u-process">
                    <span class="buffer-process"></span>
                    <span class="current-process"></span>
                </div>
                <div class="u-control u-time">00:00/00:00</div>
                <div class="u-control u-volume">
                    <div class="volume-process" data-volume="0.50">
                        <span class="volume-current"></span>
                        <span class="volume-bar"></span>
                        <span class="volume-event"></span>
                    </div>
                    <a class="volume-control"></a>
                </div>
            </div>
            <div class="m-play-controls">
                <a class="u-play-btn prev" title="上一曲"></a>
                <a class="u-play-btn ctrl-play play" title="暂停"></a>
                <a class="u-play-btn next" title="下一曲"></a>
                <a class="u-play-btn mode mode-list current" title="列表循环"></a>
                <a class="u-play-btn mode mode-random" title="随机播放"></a>
                <a class="u-play-btn mode mode-single" title="单曲循环"></a>
            </div>
        </div>
    </div>
    <div class="f-cb">&nbsp;</div>
    <div class="m-music-list-wrap"></div>
</div>





<script src="/v256/tingjs/smusic.min.js"></script>
<script>
var musicList = [
<?php if(is_array($playson)): $i = 0; $__LIST__ = array_slice($playson,$ting_pid-1,20,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pptingson): $mod = ($i % 2 );++$i;?>{
		title : '<?php echo ($pptingson["playname"]); ?>',
		singer : '',
		cover  : '<?php echo ($ting_picurl); ?>',
		src    : '<?php echo ($pptingson["playpath"]); ?>'
	}<?php if(($i) != "20"): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>
];
new SMusic({
	musicList:musicList
});
</script>
<div class="foot">        
    
    <div class="foot-layout">
    <div class="foot-wrap">
       
<p class="foot-p2"><?php echo ($copyright); ?></p>
<p class="foot-p2">若本站收集的节目无意侵犯了贵司版权，请给<a href="mailto:<?php echo ($email); ?>"><?php echo ($email); ?></a>邮箱地址来信，我们将在第一时间删除相应资源</p>
<p class="foot-p2">Copyright &#169; 2015-2018 www.gxlcms.com.All Rights Reserved .</p>
    </div>
</div>
    </div>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/read.js"></script>
<script type="text/javascript" src="<?php echo ($apicss); ?>v256/js/foot_js.js"></script>   
    

</body>
</html>