<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加一级部门</title>
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
                        <h5>添加部门 <a href="/lianxi1/azqrsg/Personnelsystem/Department/listsedit" style="margin-left:15px; color:#06cbc4">部门列表</a></h5>
                        <div class="ibox-tools">
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="/lianxi1/azqrsg/Personnelsystem/Department/AddAction" class="form-horizontal" id="form-admin-add" >
                            <div class="form-group">
                                <label class="col-sm-2 control-label">部门名称</label>
                                <div class="col-sm-10">
                                    <input type="text" name="dName" id="dName" placeholder="控制在10个字、20个字节以内"  class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">部门负责人</label>
                                <div class="col-sm-10">
                                    <input type="text" name="dDirector" id="dDirector" placeholder="控制在5个字、10个字节以内" value="<?php echo ($rs_systemInfo["sUrl"]); ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">负责人电话</label>
                                <div class="col-sm-10">
                                    
                                    <input type="text" name="dDirectorTel" id="dDirectorTel" placeholder="控制在15个字符以内" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">负责人QQ</label>
                                <div class="col-sm-10">
                                    
                                    <input type="text" name="dDirectorQQ" id="dDirectorQQ" placeholder="控制在10个字节内" class="form-control">
                                </div>
                            </div>
                                

                            <div class="form-group">
                                <label class="col-sm-2 control-label">负责人邮箱</label>
                                <div class="col-sm-10">
                                    <input type="email" name="dDirectorEmail" id="dDirectorEmail" placeholder="控制在50个字符内" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">部门简介</label>
                                <div class="col-sm-10">
                                   <textarea class="input-text form-control" id="dInfo" name="dInfo" rows="3" placeholder="控制在500个汉字以内"></textarea>
                                </div>
                            </div>
                                
                            
                                
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">添加部门</button>
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