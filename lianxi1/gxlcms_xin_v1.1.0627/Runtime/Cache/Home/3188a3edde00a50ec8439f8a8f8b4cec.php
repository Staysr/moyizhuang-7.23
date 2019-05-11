<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<base target="_blank">
<title><?php echo ($sitename); ?></title>
<meta name="keywords" content="<?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($description); ?>">
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
 



<?php $tv_new=gxl_sql_ting('field:ting_id,ting_cid,ting_name,ting_pic,ting_anchor,ting_title,ting_content,ting_gold,ting_addtime,ting_hits;limit:8;order:ting_hits desc'); ?>
<div class="content-box fn-clear">
        <div class="box-model hot-layout">
            <div class="box-model-tit fn-clear">
                <h3>最近更新</h3>
            
                <div class="box-model-more"><a href="<?php echo gxl_mytpl_url('my_new.html');?>">更多<i class="iconfont">&#xe60b;</i></a></div>
            </div>
            <div class="hot-wrap zy-hover fn-clear" style="display: block">
                <ul class="fn-clear">
                <?php if(is_array($tv_new)): $i = 0; $__LIST__ = array_slice($tv_new,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxlting): $mod = ($i % 2 );++$i;?><li class="hot-list hot-box-400x300">
                            <a href="<?php echo ($gxlting["ting_readurl"]); ?>" title="<?php echo ($gxlting["ting_name"]); ?>" target="_blank" class="hot-bg-icon">
                                <img class="loading" src="<?php echo ($apicss); ?>v256/images/pic.png" data-original="<?php echo ($gxlting["ting_picurl"]); ?>"  alt="<?php echo ($gxlting["ting_name"]); ?>" />
                                <span class="hot-zy-span fn-clear">
                                    <em class="play-bg"><i class="iconfont">&#xe611;</i></em>
                                    <span>
                                        <em><?php echo ($gxlting["ting_name"]); ?></em>
                                        <em><?php echo (msubstr($gxlting["ting_content"],0,20,'...')); ?></em>
                                    </span>
                                </span>
                                <i class="hot-zy-bg"></i>
                            </a>
                            
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>  
                        <?php if(is_array($tv_new)): $i = 0; $__LIST__ = array_slice($tv_new,1,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxlting): $mod = ($i % 2 );++$i;?><li class="hot-list hot-box-190x300">
                            <a href="<?php echo ($gxlting["ting_readurl"]); ?>" target="_blank" title="<?php echo ($gxlting["ting_name"]); ?>" class="first">
                                <span class="box-img">
                                    <img class="loading" src="<?php echo ($apicss); ?>v256/images/pic.png" data-original="<?php echo ($gxlting["ting_picurl"]); ?>"  alt="<?php echo ($gxlting["ting_name"]); ?>"/>
                                    <i class="box-img-h-bg"></i>
                                    <i class="box-img-play"></i>
                                </span>
                                <span class="box-tc">
                                    <em class="box-tc-t"><?php echo ($gxlting["ting_name"]); ?></em>
                                    <em class="box-tc-c"><?php echo (msubstr($gxlting["ting_actor"],0,15,'...')); ?></em>
                                </span>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        
                </ul>
            </div>
            
        </div>
        
    </div>
	
	
<?php $array_listidd = getlistall(2); ?>
<?php if(is_array($array_listidd)): $k = 0; $__LIST__ = array_slice($array_listidd,0,7,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxl_listid): $mod = ($k % 2 );++$k;?><div class="content-box fn-clear">
    <div class="box-model hot-layout">
        <div class="box-model-tit fn-clear">
            <h3><?php echo ($gxl_listid["list_name"]); ?></h3>
            <div class="box-model-more"><a href="<?php echo ($gxl_listid["list_url"]); ?>">更多<i class="iconfont">&#xe60b;</i></a></div>
        </div>
        <div id="J-neidi-con" class="film-model-layout">
            <div class="box-model-cont fn-clear" style="display: block">
            <?php $mov_list = gxl_sql_ting('cid:'.$gxl_listid['list_id'].';field:ting_id,ting_cid,ting_name,ting_pic,ting_title,ting_gold;limit:6;order:ting_addtime desc'); ?>  
             <?php if(is_array($mov_list)): $i = 0; $__LIST__ = $mov_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppting): $mod = ($i % 2 );++$i;?><a href="<?php echo ($ppting["ting_readurl"]); ?>" title="<?php echo ($ppting["ting_name"]); ?>" <?php if(in_array(($i), explode(',',"1"))): ?>class="first"<?php endif; ?>target="_blank">
                        <span class="box-img">
                            <img class="loading" src="<?php echo ($apicss); ?>v256/images/pic.png" data-original="<?php echo ($ppting["ting_picurl"]); ?>"  alt="<?php echo ($ppting["ting_name"]); ?>" />
                            <i class="box-img-h-bg"></i>
                            <i class="box-img-play"></i>
                        </span>
                        <span class="box-tc">
                            <em class="box-tc-t"><?php echo ($ppting["ting_name"]); ?></em>
                            <em class="box-tc-c"><?php echo ($ppting["ting_actor"]); ?></em>
                            <em class="box-tc-f"><?php echo ($ppting["ting_gold"]); ?></em>
                        </span>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>                          
            </div>
        
        </div>
    </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?> 
<div class="content-box fn-clear">
  <div class="box-model hot-layout">
    <div class="box-model-tit fn-clear">
      <h3>合作伙伴</h3>
      <div class="box-model-nav" id="J-hz-nav"> <a  class="on">媒体合作</a> <a >友情链接</a> </div>
    </div>
    <div class="friend-link" id="J-hz-con">
      <div class="fl-model fl-friend fn-clear" style="display: block">
	  
	  
	   <?php if(is_array($list_link)): $i = 0; $__LIST__ = $list_link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppting): $mod = ($i % 2 );++$i; if(($ppting["link_type"]) == "2"): ?><span><a href="<?php echo ($ppting["link_url"]); ?>" target="_blank"><img src="<?php echo ($ppting["link_logo"]); ?>" alt="<?php echo ($ppting["link_name"]); ?>友情链接"></a></span><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	  
	  </div>
      <div class="fl-model fl-link fn-clear" >
        <?php if(is_array($list_link)): $i = 0; $__LIST__ = $list_link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppting): $mod = ($i % 2 );++$i; if(($ppting["link_type"]) == "1"): ?><span><a href="<?php echo ($ppting["link_url"]); ?>" target="_blank"><?php echo ($ppting["link_name"]); ?></a></span><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
  </div>
</div>
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
    

<script>v256.index.init();v256.film.init();</script>
</body>
</html>