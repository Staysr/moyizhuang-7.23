<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/common.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/screen/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/updata.css">
    <title>发展历程</title>
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
    <p class="container_nav"><a href="<?php echo U('Index/index');?>">首页</a> &nbsp>&nbsp <a href="">关于腾博</a> &nbsp>&nbsp <a href="<?php echo U('Abouttp/about_history');?>" class="active">发展历程</a>
    </p>
    <p class="cul_title">发展历程</p>
    <div class="history_head">
        <p class="history_title">河北腾博电子科技有限公司</p>
        <p class="history_text">河北腾博电子科技有限公司以“以诚信求生存，以质量其发展，将优质服务进行到底” 为服务宗旨。
            公司将以良好的信誉为基础，秉承求实与创新的精神，为客户提供更全面、更优质的服务。公司员工将本着职业责任心，以创新为动力，以绩效为考核标准，以客户满意为工作准则，以不断创新为宗旨，以完善的经营制度来感谢社会各界对公司的支持。</p>
    </div>
    <div class="box-history">
        <div class="history_container history_shown">
            <div>
                <div class="history_container-left fl  show1 show">
                    <div class="left_div"><p class="left_one">2001年</p>
                        <p>河北腾博电子科技有限公司</p></div>
                    <div class="left_two">
                        <p>
                            2001公司更将自身的专业技术推向更高舞台，专业扩声，音视频系统，
                            （视频会议、无纸化办公、智能会议、中控及交互系统）专业舞台灯光、
                            流程化项目管理
                        </p>

                    </div>
                </div>
                <div class="history_container-left fl show2 " style="display: none;">
                    <div class="left_div"><p class="left_one">2005年</p>
                        <p>河北腾博电子科技有限公司</p></div>
                    <div class="left_two">
                        <p>
                            2005公司更将自身的专业技术推向更高舞台，专业扩声，音视频系统，
                            （视频会议、无纸化办公、智能会议、中控及交互系统）专业舞台灯光、
                            流程化项目管理
                        </p>

                    </div>
                </div>
                <div class="history_container-left fl show3 " style="display: none;">
                    <div class="left_div"><p class="left_one">2009年</p>
                        <p>河北腾博电子科技有限公司</p></div>
                    <div class="left_two">
                        <p>
                            2009公司更将自身的专业技术推向更高舞台，专业扩声，音视频系统，
                            （视频会议、无纸化办公、智能会议、中控及交互系统）专业舞台灯光、
                            流程化项目管理
                        </p>

                    </div>
                </div>
                <div class="history_container-left fl show4 " style="display: none;">
                    <div class="left_div"><p class="left_one">2018年</p>
                        <p>河北腾博电子科技有限公司</p></div>
                    <div class="left_two">
                        <p>
                            2018公司更将自身的专业技术推向更高舞台，专业扩声，音视频系统，
                            （视频会议、无纸化办公、智能会议、中控及交互系统）专业舞台灯光、
                            流程化项目管理
                        </p>

                    </div>
                </div>
                <div class="history_container-left fl show5 " style="display: none;">
                    <div class="left_div"><p class="left_one">2019年</p>
                        <p>河北腾博电子科技有限公司</p></div>
                    <div class="left_two">
                        <p>
                            2019公司更将自身的专业技术推向更高舞台，专业扩声，音视频系统，
                            （视频会议、无纸化办公、智能会议、中控及交互系统）专业舞台灯光、
                            流程化项目管理
                        </p>

                    </div>
                </div>
            </div>

            <div class="history_container-right fr">
                <div class="history_rect"></div>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="rect-top history_blok rect_<?php echo ($i); ?>"></span><?php endforeach; endif; else: echo "" ;endif; ?>
                <span id="history_a">
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a onclick="fahuo(<?php echo ($vo["id"]); ?>)" spanid="<?php echo ($vo["id"]); ?>" class="blok_<?php echo ($i); ?> about_block history_blok activei <?php if(($i) == "1"): ?>active<?php endif; ?>" <?php if(($i) == "1"): echo ($vo["id"]); endif; ?>  href="javascript:;"><?php echo ($vo["year"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</span>

                <div class="history_rectimg">
                    <div class="fl left"><img id="history_left" class="history_lefta"
                                              src="/tengbo/Public/tpHome/img/about/left.png" alt="" onclick="fahuo1(this)"></div>
                    <div class="fr right"><img id="history_right" class="history_righta"
                                               src="/tengbo/Public/tpHome/img/about/right.png" alt="" onclick="fahuo1(this)"></div>
                </div>

            </div>
            <div class="_history cf"></div>
        </div>

    </div>

    <div class="box-history">
        <div class="history_container history_hiden">
            <div class="history_container-right fl">

                <div class="history_rect"></div>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="rect-top history_blok rect_<?php echo ($i); ?>"></span><?php endforeach; endif; else: echo "" ;endif; ?>
                <span id="history_a">
                   <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a onclick="fahuo(<?php echo ($vo["id"]); ?>)"  spanid="<?php echo ($vo["id"]); ?>"  class="blok_<?php echo ($i); ?> about_block history_blok <?php if(($i) == "1"): ?>active<?php endif; ?>" <?php if(($i) == "1"): echo ($vo["id"]); endif; ?> href="javascript:void(0);"><?php echo ($vo["year"]); ?></a>
                       <!--<a class="blok_2 about_block history_blok " href="javascript:;">2005</a>-->
                       <!--<a class="blok_3 about_block history_blok " href="javascript:;">2009</a>-->
                       <!--<a class="blok_4 about_block history_blok " href="javascript:;">2018</a>-->
                       <!--<a class="blok_5 about_block history_blok " href="javascript:;">2019</a>--><?php endforeach; endif; else: echo "" ;endif; ?>
				</span>

                <div class="history_rectimg">
                    <div class="fl left"><img id="history_left2" class="history_lefta"
                                              src="/tengbo/Public/tpHome/img/about/left.png" alt="" onclick="fahuo1(this)"></div>
                    <div class="fr right"><img id="history_right2" class="history_righta"
                                               src="/tengbo/Public/tpHome/img/about/right.png" alt="" onclick="fahuo1(this)"></div>
                </div>

            </div>

            <div>
                <div class="history_container-left fr  show<?php echo ($list["id"]); ?> show">
                    <div class="left_div" ><p class="left_one" id="year"><?php echo ($list1["year"]); ?></p>
                        <p id="title"><?php echo ($list1["title"]); ?></p></div>
                    <div class="left_two">
                        <p id="intro">
                            <?php echo ($list1["intro"]); ?>
                        </p>

                    </div>
                </div>
            </div>

            <div class="_history cf"></div>
        </div>
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
<script type="text/javascript">
    function fahuo(e){
        console.log(e)
        $.ajax({
            'url':"<?php echo U('Abouttp/ajaxdata');?>",
            'type':'post',
            'dataType':'json',
            'data':{
                id:e,
            },
            success:function(res) {
                var html = "";
                // $("#year").remove();
                // $("#intro").remove();
                for (var i = 0; i < res.data.length; i++) {
                    var ls = res.data[i];
                    console.log(ls.year)
                    $("#year").html("<p>" + ls.year +" </p>");
                    $("#intro").html("<p>" + ls.intro + "</p>");

                    $("#title").html("<p>" + ls.title + "</p>");
                }

            }
        });
    }
</script>

<script type="text/javascript">
    function fahuo1(e){

      var id  = document.getElementById("chaopengid");
      console.log(id)

    }
</script>
<script src="/tengbo/Public/tpHome/js/jquery.min.js" type="text/javascript"></script>
<script src="/tengbo/Public/tpHome/js/animation.js"></script>
<script src="/tengbo/Public/tpHome/js/common.js"></script>
<script src="/tengbo/Public/tpHome/js/about.js"></script>
<script>
    TranslateLeft($('#history_left'), $('.history_blok'));
    TranslateReft($('#history_right'), $('.history_blok'));
    TranslateLeft($('#history_left2'), $('.history_blok'));
    TranslateReft($('#history_right2'), $('.history_blok'));
</script>