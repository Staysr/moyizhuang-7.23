<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>会员中心首页</title>

    <link rel="shortcut icon" href="favicon.ico"> <link href="/lianxi1/azqrsg/Public/Theme1/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <!-- Morris -->
    <link href="/lianxi1/azqrsg/Public/Theme1/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/lianxi1/azqrsg/Public/Theme1/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="/lianxi1/azqrsg/Public/Theme1/css/animate.min.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/style.min.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg" style="background-image:url(/lianxi1/azqrsg/Public/Theme1/img/bg.jpg)">
    <div class="wrapper wrapper-content">


        <div class="col-sm-3">
                <div class="widget style1 red-bg">
                    <div class="row">
                    
                        <div class="col-xs-4" style="height: 70x">
                            <i ><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/deptadd.png"></i>
                        </div>
                        <div class="col-xs-6 text-center "
                            <span><strong style="font-size:24px; line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Department/add">部门设置</a></strong> </span>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/deptshow.png"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px; line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Department/listsedit">部门信息</a></strong> </span>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/staffinfo.png"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px; line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Staff/lists">员工信息</a></strong></span>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4"  style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/staffadd.png"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px; line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Staff/add">录入员工</a></strong></span>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="widget style1" style="background-color:#59b7d2; color:#ffffff">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/mubiaoadd.png" ></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px; line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Targets/monthadd">目标计划</a></strong></span>
                           
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="widget style1 " style="background-color:#f14696; color:#ffffff">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/mubiaolist.png"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px;line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Targets/monthlists">月度目标</a></strong></span>
                           
                        </div>
                    </div>
                </div>
            </div>

            
            
            <div class="col-sm-3">
                <div class="widget style1 blue-bg">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/setsystem.png"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px;line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/System/system">系统设置</a></strong></span>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="widget style1 " style="background-color:#f68bb3; color:#ffffff">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/mysql.png"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px;line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Bak/index">数据管理</a></strong></span>
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="widget style1 " style="background-color:#ab55f5; color:#ffffff">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/admin.png"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px;line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Manage/managelists">管理人员</a></strong></span>
                           
                        </div>
                    </div>
                </div>
            </div>

           

            <div class="col-sm-3">
                <div class="widget style1 " style="background-color:#07a712; color:#ffffff">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/Public/Theme1/ico/index/huodong.png"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px;line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Hdmenu/add">活动菜单</a></strong></span>
                           
                        </div>
                    </div>
                </div>
            </div>

            <?php if(is_array($rs_hdmenu)): $k = 0; $__LIST__ = $rs_hdmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val_hdmenu): $mod = ($k % 2 );++$k;?><div class="col-sm-3">
                <div class="widget style1 " style="background-color:<?php echo ($color[0]["$k"]); ?>; color:#ffffff">
                    <div class="row">
                        <div class="col-xs-4" style="height: 70px">
                            <i><img src="/lianxi1/azqrsg/<?php echo ($val_hdmenu["hdIco"]); ?>"></i>
                        </div>
                        <div class="col-xs-6 text-center">
                            <span><strong style="font-size:24px;line-height: 70px"><a style="color: #ffffff" href="/lianxi1/azqrsg/Huodong/lists/hdPid/<?php echo ($val_hdmenu["hdId"]); ?>"><?php echo ($val_hdmenu["hdName"]); ?></a></strong></span>
                           
                        </div>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>



        </div>
    </div>


    <script src="/lianxi1/azqrsg/Public/Theme1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/flot/jquery.flot.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/demo/peity-demo.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/content.min.js?v=1.0.0"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/easypiechart/jquery.easypiechart.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/demo/sparkline-demo.min.js"></script>
    
</body>

</html>