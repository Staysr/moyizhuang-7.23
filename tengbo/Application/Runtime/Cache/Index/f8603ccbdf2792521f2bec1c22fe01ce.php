<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新闻详情</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/common.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/coop.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/screen/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/updata.css">
</head>
<body onload="active()">
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
<div class="container">
    <p class="container_nav  min-newstitle"><a href="<?php echo U('Index/index');?>">首页</a> &nbsp>&nbsp <a href="">技术资源</a> &nbsp>&nbsp  <a href="" class="active">常见问题</a></p>
    <p class="container_nav min-newsnav"><a href="<?php echo U('Index/index');?>">首页</a> &nbsp>&nbsp <a href="">技术资源</a> &nbsp>&nbsp  <a href="" >常见问题</a> &nbsp>&nbsp  <a href="" class="active">设计方案达到用户需求</a></p>
    <p class="cul_title"><?php echo ($list["title"]); ?></p>
    <p class="news_detail-time">发布时间: <?php echo ($list["add_time"]); ?> 浏览量：<?php echo ($list["page_view"]); ?></p>
    <div class="news_detail-container">
        <!--<div class="img">-->
            <!--<img src="/tengbo/Public/tpHome/img/case/news.png" alt="">-->
        <!--</div>-->
        <!--<p>河北腾博电子科技有限公司成立于2001年，我企业定位为专业扩声设备与技术服务商，一直致力于专业扩声设备的产品与技术服务，先后与国内、国际知名厂商建立合作关系，现已成为d&b战略合作伙伴、Crestron（快思聪）河北区总代理、DESFINE (迪斯)战略合作伙伴、RunningMan河北总代理、EAW核心合作伙伴、QSC核心合作伙伴、AKG(爱科技)、nightsun(夜太阳)、YMIOO(优麦)核心合作伙伴，产品涵盖会议系统、PA系统、模拟周边、数字控制系统等众多国内国际品牌。</p>-->
        <!--<p>在过去的几年中，腾博公司一直专注于专业扩声系统的设备与技术推广，已成为中国演艺物资技术协会会员单位，先后5名员工拿到了音响技术工程师及项目经理证书，我们可以为客户提供工程设计、绘图、方案论证、安装调试、售后服务等一系列的服务。</p>-->
        <!--<p>河北腾博电子科技有限公司注册资金600万，为河北地区知名的音视频产品与技术服务商。河北腾博电子科技有限公司自成立以来长期服务于视频通讯、显示系统、专业音响及中央控制系统的高科技的前沿，为客户提供完善的音视频系统解决方案： 会议系统集成、大屏幕显示系统、剧院、场馆扩声。-->
        <!--</p>-->
        <!--<p>河北腾博电子科技有限公司以“以诚信求生存，以质量其发展，将优质服务进行到底” 为服务宗旨。 公司将以良好的信誉为基础，秉承求实与创新的精神，为客户提供更全面、更优质的服务。公司员工将本着职业责任心，以创新为动力，以绩效为考核标准，以客户满意为工作准则，以不断创新为宗旨，以完善的经营制度来感谢社会各界对公司的支持。</p>-->
        <!--<div class="two-img">-->
            <!--<img src="/tengbo/Public/tpHome/img/case/news2.png" alt="">-->
        <!--</div>-->
        <!--<p>-->
            <!--河北腾博电子科技有限公司成立于2001年，我企业定位为专业扩声设备与技术服务商，一直致力于专业扩声设备的产品与技术服务，先后与国内、国际知名厂商建立合作关系，现已成为d&b战略合作伙伴、Crestron（快思聪）河北区总代理、DESFINE (迪斯)战略合作伙伴、RunningMan河北总代理、EAW核心合作伙伴、QSC核心合作伙伴、AKG(爱科技)、nightsun(夜太阳)、YMIOO(优麦)核心合作伙伴，产品涵盖会议系统、PA系统、模拟周边、数字控制系统等众多国内国际品牌。-->


        <!--</p>-->
        <!--<p>-->
            <!--在过去的几年中，腾博公司一直专注于专业扩声系统的设备与技术推广，已成为中国演艺物资技术协会会员单位，先后5名员工拿到了音响技术工程师及项目经理证书，我们可以为客户提供工程设计、绘图、方案论证、安装调试、售后服务等一系列的服务。-->
        <!--</p>-->

        <p><?php echo ($list["content"]); ?></p>

        <div class="footerl fl" id="news-foot-left" >
            <span id="lt"><img class="" src="/tengbo/Public/tpHome/img/case/prev-normal.png" alt=""></span>
        </div>
        <div class="footerr fr" id="news-foot-right" >
            <span id="gt"><img class="" src="/tengbo/Public/tpHome/img/case/next-normal.png" alt=""></span>
        </div>
        <div class="cf"></div>
    </div>
</div>
<input id="statuss" type="hidden" value="<?php echo ($statuss); ?>">
<input id="add_time" type="hidden" value="<?php echo ($list["add_time"]); ?>">

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
<script>
    var url = "/tengbo/Public/tpHome/";
</script>
<script src="/tengbo/Public/tpHome/js/jquery.min.js"></script>
<script>
    function active() {

        function GetQueryString(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]); return null;
        }
//调用
        var add_time = document.getElementById("add_time").value;
        var statuss = document.getElementById("statuss").value;

        console.log(statuss)
        var id = GetQueryString("id");

        var type = GetQueryString("type");

        $.ajax({
            type: "post",
            dataType: 'json',
            url: "<?php echo U('Behavior/pubdatalist');?>",

            data: {id: id,add_time:add_time,type:type,statuss:statuss},
            success: function (res) {
                console.log(res)
                if(type == null){
                    if(res.list == null){
                        var ac = "没有上一条了";
                        $("#lt").html("<span><img class='' src='/tengbo/Public/tpHome/img/case/prev-normal.png' alt=''>"+ac+"</span>");
                        // return false;
                    }else{
                        $("#lt").html("<a href='addcaa?id=" + res.list.id + " '><span>"+ res.list.title +"<img class='' src='/tengbo/Public/tpHome/img/case/prev-normal.png' alt=''></span></a>");
                        $("#add_time").html("<input id='add_time'  type='hidden' value="+res.list.add_time+">");
                    }

                    if(res.list1 == null){
                        var so = "没有下一条了"
                        $("#gt").html("<span>"+ so +"<img class='' src='/tengbo/Public/tpHome/img/case/next-normal.png' alt=''></span>");

                    }else{
                        $("#gt").html("<a href='addcaa?id=" + res.list1.id + " '><span><img class='' src='/tengbo/Public/tpHome/img/case/next-normal.png' alt=''>"+ res.list1.title +"</span></a>");

                        $("#add_time").html("<input id='add_time'  type='hidden' value="+res.list1.add_time+">");
                    }
                }else if (type == "gongsi"){
                    if(res.list == null){
                        var ac = "没有上一条了";
                        $("#lt").html("<span><img class='' src='/tengbo/Public/tpHome/img/case/prev-normal.png' alt=''>"+ac+"</span>");
                        // return false;
                    }else{
                        $("#lt").html("<a href='addcaa?id=" + res.list.id + "&type=gongsi" + " '><span><img class='' src='/tengbo/Public/tpHome/img/case/prev-normal.png' alt=''>"+ res.list.title +"</span></a>");
                        $("#add_time").html("<input id='add_time'  type='hidden' value="+res.list.add_time+">");
                    }

                    if(res.list1 == null){
                        var so = "没有下一条了"
                        $("#gt").html("<span>"+ so +"<img class='' src='/tengbo/Public/tpHome/img/case/next-normal.png' alt=''></span>");

                    }else{
                        $("#gt").html("<a href='addcaa?id=" + res.list1.id + "&type=gongsi" + " '><span><img class='' src='/tengbo/Public/tpHome/img/case/next-normal.png' alt=''>"+ res.list1.title +"</span></a>");

                        $("#add_time").html("<input id='add_time'  type='hidden' value="+res.list1.add_time+">");
                    }
                }else if(type == "anli"){
                    if(res.list == null){
                        var ac = "没有上一条了";
                        $("#lt").html("<span><img class='' src='/tengbo/Public/tpHome/img/case/prev-normal.png' alt=''>"+ac+"</span>");
                        // return false;
                    }else{
                        $("#lt").html("<a href='addcaa?id=" + res.list.id + "&type=anli" + " '><span>"+ res.list.title +"<img class='' src='/tengbo/Public/tpHome/img/case/prev-normal.png' alt=''></span></a>");
                        $("#add_time").html("<input id='add_time'  type='hidden' value="+res.list.add_time+">");
                    }

                    if(res.list1 == null){
                        var so = "没有下一条了"
                        $("#gt").html("<span>"+ so +"<img class='' src='/tengbo/Public/tpHome/img/case/next-normal.png' alt=''></span>");

                    }else{
                        $("#gt").html("<a href='addcaa?id=" + res.list1.id + "&type=anli" + " '><span><img class='' src='/tengbo/Public/tpHome/img/case/next-normal.png' alt=''>"+ res.list1.title +"</span></a>");

                        $("#add_time").html("<input id='add_time'  type='hidden' value="+res.list1.add_time+">");
                    }
                }

                }

        });


    }

</script>

<script src="/tengbo/Public/tpHome/js/animation.js"></script>
<script src="/tengbo/Public/tpHome/js/common.js"></script>
</html>