<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>系统参数设置</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/lianxi1/azqrsg/Public/Theme1/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/animate.min.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/style.min.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>系统配置参数 <small></small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="/lianxi1/azqrsg/Personnelsystem/System/SystemAction" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">系统名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="sName" id="sName" placeholder="控制在25个字、50个字节以内" value="<?php echo ($rs_systemInfo["sName"]); ?>" required >
                                </div>
                            </div>
                            
                                <div class="form-group">
                                <label class="col-sm-2 control-label">网址</label>
                                    <div class="col-sm-10">
                                        <input type="url" name="sUrl" id="sUrl" placeholder="请输入网址" value="<?php echo ($rs_systemInfo["sUrl"]); ?>" class="form-control" required>
                                    </div>
                            	</div>

                                <div class="form-group">
                                <label class="col-sm-2 control-label">企业名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sCompany" id="sCompany" placeholder="请输入企业名称" value="<?php echo ($rs_systemInfo["sCompany"]); ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="col-sm-2 control-label">企业简介</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sCompanyIntroduce" id="sCompanyIntroduce" placeholder="请输入企业简介" value="<?php echo ($rs_systemInfo["sCompanyIntroduce"]); ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="col-sm-2 control-label">联系电话</label>
                                    <div class="col-sm-10">
                                        <input type="tel" name="sCompanyTel" id="sCompanyTel" placeholder="请输入联系电话" value="<?php echo ($rs_systemInfo["sCompanyTel"]); ?>" class="form-control" required>
                                    </div>
                                </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">验证码开关</label>

                                <div class="col-sm-10">
                                <?php if($rs_systemInfo["sCheckCodeSwitch"] == 1): ?><label class="checkbox-inline">
                                    
                                        <input type="radio" value="1" name="sCheckCodeSwitch" checked> 开启</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="0" name="sCheckCodeSwitch"> 关闭</label>
                                        <?php else: ?>
                                        <label class="checkbox-inline">
                                    
                                        <input type="radio" value="1" name="sCheckCodeSwitch" > 开启</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="0" name="sCheckCodeSwitch" checked> 关闭</label><?php endif; ?>
                                    
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">登录超时（分钟）</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="sLoginTimeout" placeholder="请输入登录几分钟超时" value="<?php echo ($rs_systemInfo["sLoginTimeout"]); ?>" class="form-control" required>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                <label class="col-sm-2 control-label">登错次数锁定</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="sErrorPwdLockNum" placeholder="请输入登录错误几次锁定账户" value="<?php echo ($rs_systemInfo["sErrorPwdLockNum"]); ?>" class="form-control" required>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                <label class="col-sm-2 control-label">站点LOGO</label>
                                    <div class="col-sm-10">
                                    <img src="/lianxi1/azqrsg/<?php echo ($rs_systemInfo["sLogo"]); ?>" width="300" height="100">

                                        <input style="margin-top: 8px;" type="file" name="sLogo" class="form-control" >
                                    </div>
                                </div>

                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存配置</button>
                                    <button class="btn btn-white" type="submit">取消</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/lianxi1/azqrsg/Public/Theme1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/content.min.js?v=1.0.0"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
</body>

</html>