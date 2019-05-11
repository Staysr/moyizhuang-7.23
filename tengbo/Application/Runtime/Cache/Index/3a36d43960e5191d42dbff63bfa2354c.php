<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>加入我们</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/common.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/coop.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/screen/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/updata.css">
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
                    <li><a href="<?php echo U('Behavior/anli');?>">全部案例</a></li>
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
            <ul class="minul">
                <li><a href="<?php echo U('Behavior/anli');?>">全部案例</a></li>
            </ul>
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
<div class="container">
    <p class="container_nav"><a href="javascript:;">首页</a> &nbsp>&nbsp <a href="javascript:;">关于腾博</a> &nbsp>&nbsp <a href="" class="active">加入我们</a></p>
    <p class="cul_title">加入我们</p>
    <div class="join_banner" style="background: url(<?php echo ($list["pic4"]); ?>);">
        <p class="title">优秀的人才是我们未来发展的宝贵资源，我们提供优良的机会打造全球化的工作团队</p>
        <p>招聘邮件：<?php echo ($list["email"]); ?></p>
        <p>招聘电话：<?php echo ($list["phone"]); ?></p>
        <p>传真：<?php echo ($list["fax"]); ?></p>
    </div>
    <div class="join_shownp">
        <p class="op">
            优秀的人才是我们未来发展的宝贵资源，我们提供优良的机会打造全球化的工作团队
        </p>
        <p>招聘邮件：<?php echo ($list["email"]); ?></p>
        <p>招聘电话：<?php echo ($list["phone"]); ?></p>
        <p>传真：<?php echo ($list["fax"]); ?> </p>
    </div>
    <a class="join_btn" href="javascript:;">招聘职位</a>
    <ul class="join_box">
        <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="join_box-item <?php if(($i) == "1"): ?>history_blok<?php endif; ?>">
            <p class="title"><?php echo ($vo["job"]); ?></p>
            <span></span>
            <p>工作地点:<?php echo ($vo["address"]); ?></p>
            <p>招聘人数:<?php echo ($vo["num"]); ?>人</p>
            <p>学历要求：<?php echo ($vo["require"]); ?></p>
            <p>发布时间：<?php echo ($vo["add_time"]); ?></p>
            <a href="<?php echo U('Behavior/listman',array('id'=>$vo['id']));?>">查看详情</a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <!--<li class="join_box-item">-->
        <!--<p class="title">音响调音员</p>-->
        <!--<span></span>-->
        <!--<p>工作地点：石家庄</p>-->
        <!--<p>招聘人数</p>-->
        <!--<p>学历要求：专科</p>-->
        <!--<p>发布时间：2019/03/26</p>-->
        <!--<a href="javascript:;">查看详情</a>-->

    <!--</li-->
    <!--&gt;<li class="join_box-item">-->
        <!--<p class="title">三维CAD应用</p>-->
        <!--<span></span>-->
        <!--<p>工作地点：石家庄</p>-->
        <!--<p>招聘人数</p>-->
        <!--<p>学历要求：专科</p>-->
        <!--<p>发布时间：2019/03/26</p>-->
        <!--<a href="javascript:;">查看详情</a>-->

    <!--</li-->
    <!--&gt;<li class="join_box-item">-->
        <!--<p class="title">低压电工作业</p>-->
        <!--<span></span>-->
        <!--<p>工作地点：石家庄</p>-->
        <!--<p>招聘人数</p>-->
        <!--<p>学历要求：专科</p>-->
        <!--<p>发布时间：2019/03/26</p>-->
        <!--<a href="javascript:;">查看详情</a>-->

    <!--</li-->
    <!--&gt;<li class="join_box-item">-->
        <!--<p class="title">高级音响调音员</p>-->
        <!--<span></span>-->
        <!--<p>工作地点：石家庄</p>-->
        <!--<p>招聘人数</p>-->
        <!--<p>学历要求：专科</p>-->
        <!--<p>发布时间：2019/03/26</p>-->
        <!--<a href="javascript:;">查看详情</a>-->
    <!--</li-->
    <!--&gt;<li class="join_box-item">-->
        <!--<p class="title">音响调音员</p>-->
        <!--<span></span>-->
        <!--<p>工作地点：石家庄</p>-->
        <!--<p>招聘人数</p>-->
        <!--<p>学历要求：专科</p>-->
        <!--<p>发布时间：2019/03/26</p>-->
        <!--<a href="javascript:;">查看详情</a>-->

    <!--</li-->
    <!--&gt;<li class="join_box-item">-->
        <!--<p class="title">三维CAD应用</p>-->
        <!--<span></span>-->
        <!--<p>工作地点：石家庄</p>-->
        <!--<p>招聘人数</p>-->
        <!--<p>学历要求：专科</p>-->
        <!--<p>发布时间：2019/03/26</p>-->
        <!--<a href="javascript:;">查看详情</a>-->

    <!--</li-->
    <!--&gt;<li class="join_box-item">-->
        <!--<p class="title">低压电工作业</p>-->
        <!--<span></span>-->
        <!--<p>工作地点：石家庄</p>-->
        <!--<p>招聘人数</p>-->
        <!--<p>学历要求：专科</p>-->
        <!--<p>发布时间：2019/03/26</p>-->
        <!--<a href="javascript:;">查看详情</a>-->

    <!--</li-->
    <!--&gt;-->
    </ul>
    <div class="join_box-com">
        <div class="fl left" ><img id="history_left"  src="/tengbo/Public/tpHome/img/about/left.png" alt=""></div>
        <div class="fr right" ><img id="history_right"  src="/tengbo/Public/tpHome/img/about/right.png" alt=""></div>
        <div class="cf"></div>
    </div>

    <div class="join_box-more">
        <a href="javascript:;">加载更多</a>
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
            <li><a href="<?php echo U('Behavior/anli');?>">全部案例</a></li>

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
</html>
<script>
    var url = "/tengbo/Public/tpHome/";
</script>
<script src="/tengbo/Public/tpHome/js/jquery.min.js" type="text/javascript"></script>
<script src="/tengbo/Public/tpHome/js/animation.js"></script>
<script src="/tengbo/Public/tpHome/js/about.js"></script>
<script src="/tengbo/Public/tpHome/js/common.js"></script>
<script>
    var i = 0;
    $('#history_left').on('click',function(){
        i++;
        if(i>=1){
            i--;
            // alert(i)
            $('.history_blok').animate({left:'+=10px'},100);
        }else{
            $('.history_blok').animate({marginLeft:'+=25.5%'},100);
        }

    })
    $('#history_right').on('click',function(){
        i--;
        if(i<=-5){
            i++;
            $('.history_blok').animate({left:'-=10px'},100);
        }else{
            $('.history_blok').animate({marginLeft:'-=25.5%'},100);
        }

    })

</script>