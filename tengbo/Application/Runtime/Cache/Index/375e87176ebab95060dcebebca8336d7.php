<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>经典案例</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/common.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/screen/about.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/coop.css">
    <link rel="stylesheet" href="/tengbo/Public/tpHome/css/updata.css">
    <link rel="stylesheet" href="/tengbo/Public/layui/layui/css/layui.css">

</head>
<body id="caseBody" onload="active(<?php echo ($id); ?>)" style="background: #f5f5f5;">

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
    <p class="container_nav"><a href="">首页</a> &nbsp>&nbsp <a href="" class="active">经典案例</a></p>
    <div class="case">
        <ul>
            <li class="active" onclick="active(9999999999)" id="quanbu"><span>全部</span></li>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="0" id="<?php echo ($vo["id"]); ?>"><span spanid="<?php echo ($vo["id"]); ?>"
                                                  onclick="active(<?php echo ($vo['id']); ?>,this)"><?php echo ($vo["class_name"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="case_box" id="ulul">
        <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
                <div class="descpic" id="title"><?php echo ($vo["title"]); ?></div>
                <a id="void" href="<?php echo U('Behavior/addcaa',array('id'=>$vo['id'],'type'=>anli));?>"><img id="pic"
                                                                                                     src="<?php echo ($vo["pic"]); ?>"
                                                                                                     alt=""></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<input type="hidden" value="<?php echo ($id); ?>" bid="<?php echo ($id); ?>">
<nav id="bottom-pages" aria-label="Page navigation">
    <div id="page"></div>
</nav>

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
<script>
    function active(id) {
        console.log(id)

        $("#" + id + "").ready(function () {
            console.log( $("#" + id + "").removeClass("active"))
            $("#quanbu").removeClass("active");
                $("#" + id + "").removeClass("active");

            $("#" + id + "").addClass("active");
        })
        $("#quanbu").click(function () {
            $("#" + id + "").removeClass("active");
            $(this).addClass("active");
        })

        $("#" + id + "").click(function () {
            $("#quanbu").removeClass("active");
            $("li").removeClass("active");
            $("#" + id + "").removeClass("active");

            $(this).addClass("active");
        })
        $.ajax({
            type: "post",
            dataType: 'json',
            url: "<?php echo U('Behavior/ajaxanli');?>",

            data: {id: id},
            success: function (res) {

                console.log(res)
                var html = "";
                for (var i = 0; i < res.data.length; i++) {
                    var ls = res.data[i];
                    //console.log(ls)
                    html += "<div class='item'><div class='descpic' id='title'>" + ls.title + "</div><a href='addcaa?id=" + ls.id + "&type=anli" + " '><img id='pic' src=" + ls.pic + " alt=''></a></div>";

                }
                $("#ulul").html(html);
                layui.use(['laypage', 'layer'], function () {
                    var laypage = layui.laypage
                        , layer = layui.layer;

                    //调用分页
                    laypage.render({
                        elem: 'page'
                        , count: res.data.length
                        , limit: 11
                        , theme: '#064B89'
                        , jump: function (obj) {
                            console.log(obj)
                            //模拟渲染
                            // for (var i = 0; i < res.data.length; i++) {
                            //     var ls = res.data[i];
                                //console.log(ls)
                                //html += "<div class='item'><div class='descpic' id='title'>" + ls.title + "</div><a href='addcaa?id=" + ls.id + "&type=anli" + " '><img id='pic' src=" + ls.pic + " alt=''></a></div>";
                                document.getElementById('ulul').innerHTML = function () {
                                    var arr = [],
                                        thisData = res.data.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                    layui.each(thisData, function (index, item) {
                                        arr.push("<div class='item'><div class='descpic' id='title'>" + item.title + "</div><a href='addcaa?id=" + item.id + "&type=anli" + " '><img id='pic' src=" + item.pic + " alt=''></a></div>");
                                    });
                                    return arr.join('');
                                }();
                            // }
                        }
                    });
                });
            }
        });

    }
</script>
<script src="/tengbo/Public/tpHome/js/jquery.min.js"></script>
<script src="/tengbo/Public/layui/layui/layui.js"></script>
<script src="/tengbo/Public/tpHome/js/animation.js"></script>
<script src="/tengbo/Public/tpHome/js/common.js"></script>
</body>
</html>