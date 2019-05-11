<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>腾讯电子首页</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/tengbo/Public/tpHome/bs/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/index.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/common.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/screen.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/screen/about.css">
    <link rel="stylesheet" type="text/css" href="/tengbo/Public/tpHome/swiper/idangerous.swiper2.7.6.css">
</head>
<body>

<header>
    <div class="header_logo">
        <img src="/tengbo/Public/tpHome/img/logo.png" alt="">
    </div>
    <div class="header_search">
        <input type="text" class="in_search" >
        <img src="/tengbo/Public/tpHome/img/search1.png" alt="">

    </div>
    <div class="drow_btn">
        <div class="drow">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>
<div>

    <div class="page-head">

        <div class="scre-head">
            <ul class="head-nav">
                <li class="head-li"><a href="<?php echo U('Index/index');?>">首页</a>

                </li
                ><li class="head-li"> <a href="javascript:;">关于腾博</a>

                <ul>
                    <li><a href="<?php echo U('Abouttp/index');?>">公司概况</a></li>
                    <li><a href="<?php echo U('Abouttp/company_status');?>">企业文化</a></li>
                    <li><a href="<?php echo U('Abouttp/about_history');?>">发展历史</a></li>
                    <li><a href="<?php echo U('Abouttp/certificate');?>">荣誉证书</a></li>
                    <li><a href="<?php echo U('Behavior/about_coop');?>">合作单位</a></li>
                    <li><a href="<?php echo U('Behavior/joinus');?>">加入我们</a></li>
                </ul>



            </li
            ><li class="head-li"><a href="javascript:;">动态聚焦</a>
                <ul>
                    <li><a href="<?php echo U('Behavior/index');?>">行业动态</a></li>
                    <li><a href="<?php echo U('Behavior/status');?>">公司动态</a></li>

                </ul>
            </li
            ><li class="head-li"><a href="javascript:;">解决方案</a>
                <ul>
                    <?php if(is_array($solution_class)): $i = 0; $__LIST__ = $solution_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Behavior/fangan',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li
            ><li class="head-li"><a href="javascript:;">经典案例</a>
                <ul>
                    <?php if(is_array($case_class)): $i = 0; $__LIST__ = $case_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Behavior/anli',array('id'=>$vo['id']));?>"><?php echo ($vo["class_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li
            ><li class="head-li"><a href="javascript:;">产品中心</a>
                <ul>
                    <li><a href="product.html">扩声系统</a></li>
                    <!-- 	<li><a href="company_news.html">公司动态</a></li> -->

                </ul>
            </li
            ><li class="head-li"><a href="javascript:;">技术资源</a>
                <ul>
                    <li><a href="video.html">精彩视频</a></li>
                    <li><a href="tech_question.html">技术文章</a></li>
                    <li><a href="tech_text.html">常见问题</a></li>
                </ul>

            </li
            ><li class="head-li"><a href="javascript:;">联系我们</a>
                <ul>
                    <li><a href="project.html">项目服务</a></li>
                    <li><a href="technical.html">技术支持</a></li>
                    <li><a href="after_sale.html">售后服务</a></li>
                </ul>
            </li>
            </ul>
        </div>



    </div>
    <nav id="nav">
        <ul class="nav-ul">
            <li class="nav-li"><a href="<?php echo U('Index/index');?>">首页</a>

            </li
            ><li class="nav-li"> <a href="javascript:;">关于腾博 > </a>
            <ul class="minul">
                <li><a href="<?php echo U('Abouttp/index');?>">公司概况</a></li>
                <li><a href="<?php echo U('Abouttp/company_status');?>">企业文化</a></li>
                <li><a href="<?php echo U('Abouttp/about_history');?>">发展历史</a></li>
                <li><a href="<?php echo U('Abouttp/certificate');?>">荣誉证书</a></li>
                <li><a href="<?php echo U('Behavior/about_coop');?>">合作单位</a></li>
                <li><a href="<?php echo U('Behavior/joinus');?>">加入我们</a></li>
            </ul>

        </li
        ><li class="nav-li"><a href="javascript:;">动态聚焦 > </a>
            <ul  class="minul">
                <li><a href="<?php echo U('Behavior/index');?>">行业动态</a></li>
                <li><a href="<?php echo U('Behavior/status');?>">公司动态</a></li>


            </ul>
        </li
        ><li class="nav-li"><a href="javascript:;">解决方案 > </a>
            <ul class="minul">
                <?php if(is_array($solution_class)): $i = 0; $__LIST__ = $solution_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Behavior/fangan',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li
        ><li class="nav-li"><a href="javascript:;">经典案例 > </a>
            <?php if(is_array($case_class)): $i = 0; $__LIST__ = $case_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Behavior/anli',array('id'=>$vo['id']));?>"><?php echo ($vo["class_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </li
        ><li class="nav-li"><a href="javascript:;">产品中心 > </a>
            <ul class="minul">
                <li><a href="product.html">扩声系统</a></li>
            </ul>
        </li
        ><li class="nav-li"><a href="javascript:;">技术资源 > </a>
            <ul class="minul">
                <li><a href="video.html">精彩视频</a></li>
                <li><a href="tech_question.html">技术文章</a></li>
                <li><a href="tech_text.html">常见问题</a></li>
            </ul>
        </li
        ><li class="nav-li"><a href="javascript:;">联系我们 > </a>
            <ul class="minul">
                <li><a href="project.html">项目服务</a></li>
                <li><a href="technical.html">技术支持</a></li>
                <li><a href="after_sale.html">售后服务</a></li>
            </ul>
        </li>
        </ul>
        <!-- <div class="minul">
            <div>
                <span><a href="javascript:;">关于腾博</a></span>
                <span><a href="about_tp.html">公司概况</a></span>
                <span><a href="about_cul.html">企业文化</a></span>
                <span><a href="about_history.html">发展历史</a></span>

            </div>
            <div>
                <span><a href="javascript:;">动态聚焦</a></span>
                <span><a href="industry_news.html">行业动态</a></span>
                <span><a href="company_news.html">公司动态</a></span>
            </div>
            <div>
                <span><a href="javascript:;">解决方案</a></span>
                <span><a href="solution_theatre.html">剧院剧场</a></span>
                <span><a href="solution_theatre.html">报告厅</a></span>
                <span><a href="solution_theatre.html">体育场馆</a></span>
                <span><a href="solution_theatre.html">指挥中心</a></span>
                <span><a href="solution_theatre.html">多媒体教室</a></span>
                <span><a href="solution_theatre.html">会议室</a></span>
                <span><a href="solution_theatre.html">教育声光设计</a></span>
            </div>
            <div>
                <span><a href="javascript:;">产品中心</a></span>
                <span><a href="product.html">扩声系统</a></span>
            </div>
            <div>
                <span><a href="javascript:;">技术资源</a></span>
                <span><a href="video.html">精彩视频</a></span>
                <span><a href="tech_question.html">技术文章</a></span>
                <span><a href="tech_text.html">常见问题</a></span>
            </div>
            <div>
                <span><a href="javascript:;">联系我们</a></span>
                <span><a href="project.html">项目服务</a></span>
                <span><a href="technical.html">技术支持</a></span>
                <span><a href="after_sale.html">售后服务</a></span>
            </div>
        </div> -->
    </nav>

</div>

<div class="index-container swiper-container">
    <div class="swiper-wrapper ">
        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="swiper-slide"> <img src="<?php echo ($vo["pic"]); ?>" alt=""></div><?php endforeach; endif; ?>
    </div>

    <div  class="banner-pagination">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="active"></span><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

</div>
<div class="content row">
    <?php if(is_array($list1)): foreach($list1 as $k=>$vo): ?><div  class="col-md-4 col-sm-6 col-xs-6  jujiao">

        <div class=" about_title"><?php echo ($vo["title"]); ?></div>
        <p class="jujiao_time"><?php echo ($vo["add_time"]); ?></p>
        <a href="<?php echo U('Behavior/addcaa',array('id'=>$vo['id'],'type'=>gongsi));?>" class="jiaoju_text">
            <?php echo ($vo["intro"]); ?>
        </a>
        <p  class="jiaoju_desc">
            <a href="<?php echo U('Behavior/addcaa',array('id'=>$vo['id'],'type'=>gongsi));?>">
                <?php echo ($vo["intro"]); ?>

            </a>

        </p>
        <?php if($k == 0 ): ?><button class="carbon-btn"><a href="<?php echo U('Behavior/index');?>">前往动态聚焦</a></button><?php endif; ?>
    </div><?php endforeach; endif; ?>

    <!--<div class="col-md-4 col-sm-6 col-xs-6  jujiao">-->
        <!--<div class=" about_title"></div>-->
        <!--<p class="jujiao_time">2019-03-12</p>-->
        <!--<a href="news_detail.html" class="jiaoju_text">-->
            <!--QSC与SONY强强联手打造全球首个STARX巨幕影厅-->
        <!--</a>-->
        <!--<p class="jiaoju_desc">-->
            <!--<a href="news_detail.html">AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活......</a>-->
        <!--</p>-->
    <!--</div>-->
    <div class="col-md-4 col-sm-12 col-xs-12 about col-jujia jujiao">
        <div class=" jujiao_title">关于我们</div>
        <div class="about_img "> <img src="/tengbo/Public/tpHome/img/about-wap.png" alt=""></div>
        <div class="about-con">
            <div class="carbon">
                <p class="about_text">河北腾博电子有限科技公司</p>
                <p class="cursor">河北腾博电子有限科技公司河北腾博电子有限科技公司河北腾博电子有限科技公司河北腾博电子有限科技公司河北腾博电子</p>
                <a href="<?php echo U('Abouttp/index');?>">了解更多</a>
            </div>
        </div>
    </div>
</div>

<div class="box">
    <?php if(is_array($list1)): foreach($list1 as $k=>$vo): ?><div>
        <p class="about_title"><?php echo ($vo["title"]); ?></p>
    </div>
    <div class="box-ju">
        <p class="jujiao_time"><?php echo ($vo["add_time"]); ?></p>
        <p class="jiaoju_text">
            <?php echo ($vo["intro"]); ?>
        </p>
        <p class="jiaoju_desc">
            <?php echo ($vo["intro"]); ?>
        </p>

    </div>

    <!--<div class="box-bon">-->
        <!--<p class="jujiao_time">2019-03-12</p>-->
        <!--<p class="jiaoju_text">-->
            <!--QSC与SONY强强联手打造全球首个STARX巨幕影厅-->
        <!--</p>-->
        <!--<p class="jiaoju_desc">-->
            <!--AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功举办AVC行业俱乐部首期沙龙活动成功......-->
        <!--</p>-->
    <!--</div>-->
        <?php if($k == 1 ): ?><button class="carbon-btn">前往动态聚焦</button><?php endif; endforeach; endif; ?>
    <p class="box_title">关于我们</p>

</div>
<div class="box-about">
    <div class="about_img"> <img src="/tengbo/Public/tpHome/img/about-wap.png" alt=""></div>
    <div class="about-con">
        <div class="carbon">
            <p class="about_text">河北腾博电子有限科技公司</p>
            <p class="about_desc">河北腾博电子有限科技公司河北腾博电子有限科技公司河北腾博电子有限科技公司河北腾博电子有限科</p>
            <a class="about_desc" href="">了解更多</a>
        </div>
    </div>
</div>

<div class="wen-title">
    <h3 class="product">产品中心</h3>
    <p>专业音视频系统服务领跑者</p>
</div>
<div class="img_container">
    <div class="img_left fl">
        <div class="img-one index-pic"> <p>扩声系统</p>
            <img src="/tengbo/Public/tpHome/img/go.png" alt="">
        </div>
        <div class="img-three index-pic"> <p>视频系统</p>
            <img src="/tengbo/Public/tpHome/img/go.png" alt="">
        </div>

    </div>
    <div class="img_right fr">
        <div class="img-two index-pic"> <p>控制系统</p>
            <img src="/tengbo/Public/tpHome/img/go.png" alt="">
        </div>
        <div class="img-four index-pic"> <p>灯光系统</p>
            <img src="/tengbo/Public/tpHome/img/go.png" alt="">
        </div>
        <div class="img-five index-pic"> <p>其他</p>
            <img src="/tengbo/Public/tpHome/img/go.png" alt="">
        </div>

    </div>
    <div class="cf"></div>
</div>
<div class="min-img-container cf">
    <div class="min-img min-one fl">
        <span>扩声系统</span>
        <img src="/tengbo/Public/tpHome/img/mgo.png" alt="">
    </div>
    <div class="min-img min-two fr">
        <span>视频系统</span>
        <img src="/tengbo/Public/tpHome/img/mgo.png" alt="">

    </div>
    <div class="min-img min-three fl">
        <span>控制系统</span>
        <img src="/tengbo/Public/tpHome/img/mgo.png" alt="">
    </div>
    <div class="min-img min-four fr">
        <span>灯光系统</span>
        <img src="/tengbo/Public/tpHome/img/mgo.png" alt="">
    </div>
    <div class="min-img-esc min-five fl">
        <span>其他</span>
        <img src="/tengbo/Public/tpHome/img/mgo.png" alt="">
    </div>
</div>

<div class="wen-title">
    <h3 class="solution_theatre">解决方案</h3>
    <p>我们致力于扎根行业、深入场景进行产品设计和创新</p>
</div>

<div class="banner-controller">

    <p class="banner-text">
        <?php if(is_array($list2)): foreach($list2 as $key=>$vo): ?><span><!-- 报告厅 -->  <?php echo ($vo["title"]); ?></span>
        <!--<span>&lt;!&ndash; 体育场馆 &ndash;&gt;  体育场馆</span>-->
        <!--<span>&lt;!&ndash; 指挥中心 &ndash;&gt;  指挥中心</span>-->
        <!--<span>&lt;!&ndash; 多媒体教室 &ndash;&gt;  多媒体教室</span>-->
        <!--<span>&lt;!&ndash; 会议室 &ndash;&gt;  会议室</span>-->
        <!--<span>&lt;!&ndash; 教育声光设计 &ndash;&gt; 教育声光设计</span>--><?php endforeach; endif; ?>
    </p>
    <p class="circle">
        <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="<?php if(($i) == "1"): ?>circle-active<?php endif; ?>"></span><?php endforeach; endif; else: echo "" ;endif; ?>
    </p>
</div>
<p class="slid"></p>
<div class="bannner banner-container swiper-container">
    <div class=" swiper-wrapper">
        <?php if(is_array($list2)): foreach($list2 as $key=>$vo): ?><div class="banner-img swiper-slide"> <img src="<?php echo ($vo["pic"]); ?>" alt=""></div><?php endforeach; endif; ?>
    </div>

    <div class="page-left"> <img src="/tengbo/Public/tpHome/img/left.png" class="page_up" alt=""></div>
    <div class="page-right"> <img src="/tengbo/Public/tpHome/img/go.png" class="page_next" alt=""></div>
</div>

<div class="min-banner swiper-container">
    <div class="swiper-wrapper ">
        <?php if(is_array($list2)): foreach($list2 as $key=>$vo): ?><div class="swiper-slide"> <img src="<?php echo ($vo["pic"]); ?>" alt=""></div><?php endforeach; endif; ?>
    </div>
    <div class="page-left"> <img src="/tengbo/Public/tpHome/img/left.png" class="page_up" alt=""></div>
    <div class="page-right"> <img src="/tengbo/Public/tpHome/img/mgo.png" class="page_next" alt=""></div>
    <div  class="min-pagination">
        <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="<?php if(($i) == "1"): ?>active<?php endif; ?>"></span><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

<div class="warp row">
    <div class="col-md-6 col-sm-4 col-xs-12 warp-left">
        <div class="warp-img"><img src="/tengbo/Public/tpHome/img/j.png" class="scale-img" alt=""></div>
        <h3 class="technology tech_question">技术资源</h3>
        <p>为您提供全面的在线技术服务及常见问题解答</p>
    </div>
    <div class="col-md-6 col-sm-4 col-xs-12 warp-right">
        <div class="warp-img"><img src="/tengbo/Public/tpHome/img/me.png" class="scale-img" alt=""></div>
        <h3 class="project">联系我们</h3>
        <p>为您提供全面的在线技术服务及常见问题解答</p>
    </div>
</div>

<div class="foote">
    <div class="foot-box">
        <ul>
            <a href="javascript:;">关于腾博</a>
            <li><a href="<?php echo U('Abouttp/index');?>">公司概况</a></li>
            <li><a href="<?php echo U('Abouttp/company_status');?>">企业文化</a></li>
            <li><a href="<?php echo U('Abouttp/about_history');?>">发展历史</a></li>
            <li><a href="<?php echo U('Abouttp/certificate');?>">荣誉证书</a></li>
            <li><a href="<?php echo U('Behavior/about_coop');?>">合作单位</a></li>
            <li><a href="<?php echo U('Behavior/joinus');?>">加入我们</a></li>
            <!--<li>公司概况</li>-->

        </ul>
        <ul>
            <a href="javascript:;">动态聚焦</a>
            <li><a href="<?php echo U('Behavior/index');?>">行业动态</a></li>
            <li><a href="<?php echo U('Behavior/status');?>">公司动态</a></li>
        </ul>
        <ul>
            <a href="javascript:;">解决方案</a>
            <?php if(is_array($solution_class)): $i = 0; $__LIST__ = $solution_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Behavior/fangan',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <ul>
            <a href="javascript:;">经典案例</a>
            <?php if(is_array($case_class)): $i = 0; $__LIST__ = $case_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Behavior/anli',array('id'=>$vo['id']));?>"><?php echo ($vo["class_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
        <ul>
            <a href="javascript:;">产品中心</a>
            <li>扩声系统</li>
            <li>扩声系统</li>
            <li>扩声系统</li>
            <li>扩声系统</li>
            <li>扩声系统</li>
        </ul>
        <ul>
            <a href="javascript:;">技术资源</a>
            <li>常见问题</li>
            <li>常见问题</li>
            <li>常见问题</li>
        </ul>
        <ul>
            <a href="javascript:;">联系我们</a>
            <li>项目服务</li>
            <li>项目服务</li>
            <li>项目服务</li>
        </ul>
    </div>
</div>

<footer>
    <p>版权所有@河北腾博电子</p>
</footer>
<div class="min-foot-box">
    <div class="min-foot">
        <p class="foot-p">
            <a href="javascript:;">关于腾博</a>
            <a href="javascript:;">动态聚焦</a>
            <a href="javascript:;">解决方案</a>
            <a href="javascript:;">经典案例</a>
        </p>
        <p class="foot-p">
            <a href="javascript:;">产品中心</a>
            <a href="javascript:;">技术资源</a>
            <a href="javascript:;">联系我们</a>
            <a href="javascript:;"></a>
        </p>

    </div>
    <div class="min-footer">
        <p>版权所有@河北腾博电子</p>
    </div>
</div>

</body>
<script src="/tengbo/Public/tpHome/js/jquery.min.js" type="text/javascript"></script>
<script src="/tengbo/Public/tpHome/js/animation.js"></script>
<script type="text/javascript" src="/tengbo/Public/tpHome/swiper/idangerous.swiper2.7.6.min.js"></script>
<script src="/tengbo/Public/tpHome/js/index.js"></script>
<script src="/tengbo/Public/tpHome/js/home.js"></script>
<script src="/tengbo/Public/tpHome/js/banner.js"></script>
<script src="/tengbo/Public/tpHome/js/common.js"></script>
<script>


</script>
</html>