<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加月度目标</title>
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
                        <h5>月度目标表格模版管理 <a style="margin-left: 15px; color:#06cbc4" href="/lianxi1/azqrsg/Personnelsystem/Targets/monthadd">填写月度目标</a></h5>
                        <div class="ibox-tools">
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="/lianxi1/azqrsg/Personnelsystem/Targets/SetModelsAction" class="form-horizontal" id="form-admin-add" >
                        
                            
                            <div class="form-group">
                                <label class="col-sm-1 control-label">模版表格</label>
                                <div class="col-sm-11">
                                  <script id="container" name="mModel" type="text/plain"><?php echo ($rs_models["mModel"]); ?>
    </script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/lianxi1/azqrsg/Public/Theme1/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/lianxi1/azqrsg/Public/Theme1/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
    
    
    autoHeightEnabled: true,
    autoFloatEnabled: true
});
    </script>
                                </div>
                            </div>
                                
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存</button>
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

<script type="text/javascript" src="/lianxi1/azqrsg/Public/Theme1/check/js/jquery.validate.min.js"></script> 

<script type="text/javascript" src="/lianxi1/azqrsg/Public/Theme1/check/js/messages_zh.min.js"></script> 

<script type="text/javascript" src="/lianxi1/azqrsg/Public/Theme1/check/js/validate-methods.js"></script> 

    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
    
    <script type="text/javascript">
	$(function(){
	$("#form-admin-add").validate({
		rules:{
			dName:{
                required:true,
                minlength:2,
                maxlength:20
            },
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});
</script> 
    
    
</body>

</html>