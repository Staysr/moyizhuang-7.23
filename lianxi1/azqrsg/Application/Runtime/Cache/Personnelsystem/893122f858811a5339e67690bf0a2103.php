<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title><?php echo ($rs_systemName["sName"]); ?>-系统中心</title>

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/animate.min.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/style1.min.css?v=4.1.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation" style="background-color:#067fcb;border-right: 0px solid #ffffff">
            <div class="nav-close" ><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                        <?php if($rs_users["uImages"] == null): if($rs_admin["aSex"] == 1): ?><span><img alt="image" class="img-circle" src="/lianxi1/azqrsg/Public/Theme1/img/default_1.jpg" width="80" height="80" /></span>
                            <?php else: ?>
                            <span><img alt="image" class="img-circle" src="/lianxi1/azqrsg/Public/Theme1/img/default_2.jpg" width="80" height="80" /></span><?php endif; ?>
                            <?php else: ?>
                        <span><img alt="image" class="img-circle" src="/lianxi1/azqrsg/<?php echo ($rs_users["uImages"]); ?>" width="80" height="80" /></span><?php endif; ?>
                            
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo ($aUser); ?></strong></span>
                                <span class="text-muted text-xs block"><?php echo ($aName); ?><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs" style="z-index: 2000">
                                <li><a href="/lianxi1/azqrsg/LoginTrue/ExitLogin">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">栏目
                        </div>
                    </li>
                    <?php if(($powersValue == 0) OR $powersValue[1] == 'A1'): ?><li>
                        <a href="#">
                            <i class="glyphicon"><img src="/lianxi1/azqrsg/Public/Theme1/menu/ico/setsystem.png"></i>
                            <span class="nav-label">系统管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a class="J_menuItem" href="/lianxi1/azqrsg/System/system" data-index="0">系统设置</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="/lianxi1/azqrsg/Bak/index" data-index="0">数据库管理</a>
                            </li>
                           
                            <li>
                                <a class="J_menuItem" href="/lianxi1/azqrsg/Variables/lists" data-index="0">配置变量</a>
                            </li>

                             <li>
                                <a class="J_menuItem" href="/lianxi1/azqrsg/Manage/role">角色权限</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="/lianxi1/azqrsg/Manage/managelists">管理员列表</a>
                            </li>
                           
                        </ul>
                    </li><?php endif; ?>
                    <?php if(($powersValue == 0) OR $powersValue[3] == 'A3'): ?><li>
                        <a href="#">
                            <i class="glyphicon"><img src="/lianxi1/azqrsg/Public/Theme1/menu/ico/setdept.png" ></i>
                            <span class="nav-label">部门管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Department/add">添加部门</a></li>
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Department/listsedit">部门信息</a></li>
                        </ul>
                    </li><?php endif; ?>

                    <?php if(($powersValue == 0) OR $powersValue[2] == 'A2'): ?><li>
                        <a href="#"><i class="fa"><img src="/lianxi1/azqrsg/Public/Theme1/menu/ico/setstaff.png"></i> <span class="nav-label">员工管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Staff/lists">员工列表</a>
                            </li>
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Staff/add">添加员工</a>
                            </li>
                            
                        </ul>
                    </li><?php endif; ?>
                    <?php if($morepowersValue == '0-0-0-0-B'): ?><li>
                        <a href="#"><i class="fa"><img src="/lianxi1/azqrsg/Public/Theme1/menu/ico/setstaff.png"></i> <span class="nav-label">员工管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Staff/lists/depId/<?php echo ($aDid); ?>"><?php echo ($rs_department["dName"]); ?>员工列表</a>
                            </li>
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Staff/add/depId/<?php echo ($aDid); ?>">添加<?php echo ($rs_department["dName"]); ?>员工</a>
                            </li>
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Staff/import">导入<?php echo ($rs_department["dName"]); ?>信息</a>
                            </li>
                            
                        </ul>
                    </li><?php endif; ?>

                    <li>
                        <a href="#">
                            <i class="glyphicon"><img src="/lianxi1/azqrsg/Public/Theme1/menu/ico/settarget.png" ></i>
                            <span class="nav-label">月度目标</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Targets/models">模版编辑</a></li>
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Targets/monthadd">填写月度目标</a></li>
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Targets/monthlists">月度目标信息</a></li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa"><img src="/lianxi1/azqrsg/Public/Theme1/menu/ico/setactivity.png" ></i> <span class="nav-label">相关活动</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Hdmenu/add">添加菜单</a>
                            </li>
                            <li><a class="J_menuItem" href="/lianxi1/azqrsg/Hdmenu/lists">编辑菜单</a>
                            </li>
                            <?php if(is_array($rs_hdmenu)): foreach($rs_hdmenu as $key=>$val_hdmenu): ?><li><a class="J_menuItem" href="/lianxi1/azqrsg/Huodong/lists/hdPid/<?php echo ($val_hdmenu["hdId"]); ?>"><?php echo ($val_hdmenu["hdName"]); ?></a>
                            </li><?php endforeach; endif; ?>
                            
                            
                        </ul>
                    </li>
                    
					<li><a class="J_menuItem" href="/lianxi1/azqrsg/About/index"><i class="fa"><img src="/lianxi1/azqrsg/Public/Theme1/menu/ico/about.png" width="32" height="32"></i> <span class="nav-label">关于我们</span></a>
					</li>
                    
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize btn" href="#" style="width:190%; height: 50px; font-size: 18px; line-height: 36px; background: #067fcb; margin-left:0;color: #ffffff"><i class="fa fa-bars"></i><span style="margin-left:20px; margin-right: 100px; color: #ffffff; font-weight: bold;"><?php echo ($rs_systemName["sName"]); ?></span> </a>
                       
                    </div>
                    <!--
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown hidden-xs">
                            <a class="right-sidebar-toggle" aria-expanded="false">
                                <i class="fa fa-tasks"></i> 主题
                            </a>
                        </li>
                    </ul>
                    -->
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft">
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div>
                        <a style="color:#12c3bd; font-weight: bold" href="/lianxi1/azqrsg/Personnelsystem/Index/">主页</a>
                    </div>
                </nav>
                
                <a href="/lianxi1/azqrsg/LoginTrue/ExitLogin" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="/lianxi1/azqrsg/Personnelsystem/Index/welcome" frameborder="0" data-id="index_v1.html" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right J_iframe dropdown hidden-xs" name="iframe0" frameborder="0" data-id="index.html" seamless>
                <span style="color:#1690d8">
                <?php if($rs_glBNum > 0 OR $rs_nlBNum > 0): echo ($ResultNowDay); ?>
                今天还是员工：
                <?php if($rs_glBNum > 0): if(is_array($rs_glB)): foreach($rs_glB as $key=>$val_glB): ?>[ <?php echo ($val_glB["stName"]); ?> ]<?php endforeach; endif; endif; ?>
                <?php if($rs_nlBNum > 0): if(is_array($rs_nlB)): foreach($rs_nlB as $key=>$val_nlB): ?>[ <?php echo ($val_nlB["stName"]); ?> ]<?php endforeach; endif; endif; ?>
                的生日 
                <?php else: ?>
                <?php echo ($ResultNowDay); endif; ?>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active">
                        <a data-toggle="tab" href="#tab-1">
                            <i class="fa fa-gear"></i> 主题
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                            <small><i class="fa fa-tim"></i> </small>
                        </div>
                        <div class="skin-setttings">
                            <div class="title">主题设置</div>
                            <div class="setings-item">
                                <span>收起左侧菜单</span>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定顶部</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                        <label class="onoffswitch-label" for="fixednavbar">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>
                        固定宽度
                    </span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                        <label class="onoffswitch-label" for="boxedlayout">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="title">皮肤选择</div>
                            <div class="setings-item default-skin nb">
                               
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--右侧边栏结束-->
       
    </div>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/layer/layer.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/hplus.min.js?v=4.1.0"></script>
    <script type="text/javascript" src="/lianxi1/azqrsg/Public/Theme1/js/contabs.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/pace/pace.min.js"></script>
</body>

</html>