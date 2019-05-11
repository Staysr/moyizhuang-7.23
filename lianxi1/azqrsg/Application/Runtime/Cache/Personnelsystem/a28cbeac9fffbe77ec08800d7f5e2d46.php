<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加员工信息</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/lianxi1/azqrsg/Public/Theme1/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/animate.min.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/static/plupload/upfiless.css" rel="stylesheet" type="text/css" />
    <link href="/lianxi1/azqrsg/Public/Theme1/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
    <link href="/lianxi1/azqrsg/Public/Theme1/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加员工信息 <a href="/lianxi1/azqrsg/Personnelsystem/Staff/lists" style="margin-left:15px; color:#06cbc4">员工列表</a></h5>
                        <div class="ibox-tools">
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="/lianxi1/azqrsg/Personnelsystem/Staff/AddAction" class="form-horizontal" id="form-admin-add" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">编号</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stNum" id="stNum" value="<?php echo ($number); ?>" placeholder="请输入整数,员工的编号或序号" class="form-control">
                                </div>
                                 <label class="col-sm-1 control-label">姓名</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stName" id="stName" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">性别</label>

                                <div class="col-sm-3">
                                
                                    <label class="checkbox-inline">
                                        <input type="radio" value="1" name="stSex" checked> 男</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="2" name="stSex"> 女</label>
                                </div>

                                <label class="col-sm-1 control-label">生日</label>
                                    <div class="col-sm-1">
                                    <select data-placeholder="出生日期" name="stBirthdateType" class="chosen-select form-control" required>
                                    <option value="1" >公历</option>
                                    <option value="2" >农历</option>
                                    </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="date" name="stBirthdate" id="stBirthdate" class="form-control">
                                    </div>
                            </div>

                            

                            <div class="form-group">
                                <label class="col-sm-1 control-label">电话</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stTel" id="stTel" class="form-control">
                                </div>

                                <label class="col-sm-1 control-label">学历</label>
                                <div class="col-sm-3">
                                <select class="chosen-select form-control" size="1" name="stDegrees" id="stDegrees" required >
                                    <option value="" >请选择学历</option>
                                    <?php if(is_array($xueli)): foreach($xueli as $xuelik=>$valxueli): ?><option value="<?php echo ($xuelik); ?>" ><?php echo ($valxueli); ?></option><?php endforeach; endif; ?>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">入职日期</label>
                                <div class="col-sm-3">
                                    <input type="date" name="stEntryDate" id="stEntryDate" class="form-control">
                                </div>
                                <?php if($depId != 0): ?><label class="col-sm-1 control-label">所在部门</label>
                                <div class="col-sm-3">
                                     <select class="chosen-select form-control" size="1" name="stDid" required>
                                     <?php if($rs_department["dPid"] == 0 AND $rs_department["dPsid"] == 0): ?><option value="<?php echo ($rs_department["dId"]); ?>" style="color:#f87ca8" ><?php echo ($rs_department["dName"]); ?></option>
                                    <?php elseif($rs_department["dPid"] != 0 AND $rs_department["dPsid"] == 0): ?>
                                    <?php $dPid=$rs_department["dPid"]; $department=M("department"); $rsp=$department->where("dId={$dPid}")->find(); ?>
                                    <option style="color:#44a5e4" value="<?php echo ($rs_department["dId"]); ?>" ><?php echo ($rsp["dName"]); ?> -> <?php echo ($rs_department["dName"]); ?></option>
                                    <?php elseif($rs_department["dPid"] == 0 AND $rs_department["dPsid"] != 0): ?>
                                    <?php $dPsid=$rs_department["dPsid"]; $department=M("department"); $rsps=$department->where("dId={$dPsid}")->find(); $rsPsPid=$rsps["dPid"]; $rsPspe=$department->where("dId={$rsPsPid}")->find(); ?>
                                    <option style="color:#067b14" value="<?php echo ($rs_department["dId"]); ?>"><?php echo ($rsPspe["dName"]); ?> -> <?php echo ($rsps["dName"]); ?> -> <?php echo ($rs_department["dName"]); ?></option><?php endif; ?>

                                    </select>
                                </div>

                                <?php else: ?>
                                <label class="col-sm-1 control-label">所在部门</label>
                                <div class="col-sm-3">
                                    <select class="chosen-select form-control" size="1" name="stDid" id="stDid" required >
                                   
                                    <option value="" selected>请选择员工所在部门</option>
                                    <?php if(is_array($rs_department)): foreach($rs_department as $key=>$val_department): if($val_department["dPid"] == 0 AND $val_department["dPsid"] == 0): ?><option style="color:#f87ca8" value="<?php echo ($val_department["dId"]); ?>"><?php echo ($val_department["dName"]); ?></option>
                                    <?php elseif($val_department["dPid"] != 0 AND $val_department["dPsid"] == 0): ?>
                                    <?php $dPid=$val_department["dPid"]; $department=M("department"); $rsp=$department->where("dId={$dPid}")->find(); ?>
                                    <option style="color:#44a5e4" value="<?php echo ($val_department["dId"]); ?>"><?php echo ($rsp["dName"]); ?> -> <?php echo ($val_department["dName"]); ?></option>
                                    
                                    <?php elseif($val_department["dPid"] == 0 AND $val_department["dPsid"] != 0): ?>
                                    <?php $dPsid=$val_department["dPsid"]; $department=M("department"); $rsps=$department->where("dId={$dPsid}")->find(); $rsPsPid=$rsps["dPid"]; $rsPspe=$department->where("dId={$rsPsPid}")->find(); ?>
                                    <option style="color:#067b14" value="<?php echo ($val_department["dId"]); ?>"><?php echo ($rsPspe["dName"]); ?> -> <?php echo ($rsps["dName"]); ?> -> <?php echo ($val_department["dName"]); ?></option><?php endif; endforeach; endif; ?>
                                    
                                </select>
                                </div><?php endif; ?>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">职称</label>
                                <div class="col-sm-3">
                                    <select class="chosen-select form-control" size="1" name="stPositionalTitles" id="stPositionalTitles" required >
                                   
                                    <option value="" selected>请选择职称</option>
                                    <?php if(is_array($zhicheng)): foreach($zhicheng as $zhichengk=>$valzhicheng): ?><option value="<?php echo ($zhichengk); ?>" ><?php echo ($valzhicheng); ?></option><?php endforeach; endif; ?> 
                                    
                                </select>
                                </div>

                                <label class="col-sm-1 control-label">职务</label>
                                <div class="col-sm-3">
                                    <select class="chosen-select form-control" size="1" name="stDuties" id="stDuties" required >
                                    <option value="" selected>请选择职务</option>
                                    <?php if(is_array($zhiwu)): foreach($zhiwu as $zhiwuk=>$valzhiwu): ?><option value="<?php echo ($zhiwuk); ?>" ><?php echo ($valzhiwu); ?></option><?php endforeach; endif; ?>
                                    
                                </select>
                                </div>

                            </div>


                            <div class="form-group">
							
								<label class="col-sm-1 control-label">婚姻状况</label>
									<div class="col-sm-3">
									<select class="chosen-select form-control" size="1"
										name="stMarital" id="stMarital" required>
										<option value="">请选择婚姻状况</option>
										<?php if(is_array($hunyin)): foreach($hunyin as $hunyink=>$valhunyin): ?><option value="<?php echo ($hunyink); ?>"><?php echo ($valhunyin); ?></option><?php endforeach; endif; ?>
									</select>
									</div>
							
							
                                <label class="col-sm-1 control-label">民族</label>
								<div class="col-sm-3">
                                   <select class="chosen-select form-control" size="1"
										name="stMultiracial" id="stMultiracial" required>
										<option value="">请选择民族</option>
										<?php if(is_array($minzu)): foreach($minzu as $minzuk=>$valminzu): ?><option value="<?php echo ($minzuk); ?>"><?php echo ($valminzu); ?></option><?php endforeach; endif; ?>
									</select> 
                                        
								</div>

                                

                            </div>


                            <div class="form-group">
								<label class="col-sm-1 control-label">籍贯</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stNativePlace" id="stNativePlace" class="form-control">
                                </div>
							
                                <label class="col-sm-1 control-label">身份证号码</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stIDCard" id="stIDCard" class="form-control">
                                </div>

                                

                            </div>

                            <div class="form-group">
							
								<label class="col-sm-1 control-label">所在地</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stCity" id="stCity" class="form-control">
                                </div>
							
                                <label class="col-sm-1 control-label">身高（CM）</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stHeight" id="stHeight" class="form-control">
                                </div>

                                

                            </div>

                            <div class="form-group">
							
								<label class="col-sm-1 control-label">体重（Kg）</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stWeight" id="stWeight" class="form-control">
                                </div>
							
                                <label class="col-sm-1 control-label">政治面貌</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stPoliticalIandscape" id="stPoliticalIandscape" class="form-control">
                                </div>

                                

                            </div>

                            <div class="form-group">
								<label class="col-sm-1 control-label">员工QQ</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stQQ" id="stQQ" class="form-control">
                                </div>
							
                                <label class="col-sm-1 control-label">邮箱</label>
                                <div class="col-sm-3">
                                    <input type="text" name="stEmail" id="stEmail" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">工作经验</label>
                                <div class="col-sm-3">
                                    <textarea class="input-text form-control" id="stJingyuan" name="stJingyuan" rows="3" ></textarea>
                                </div>
                                <label class="col-sm-1 control-label">掌握技能</label>
                                <div class="col-sm-3">
                                    <textarea class="input-text form-control" id="stJineng" name="stJineng" rows="3" placeholder=""></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label" style="margin-top: 20px;">照片</label>
                                <div class="col-sm-7">
                                    <dl id="ul_pics" class="ul_pics clearfix" ></dl>
                                    <a class="upimgs col-sm-2" id="btn" style="background-color:#067fcb; width:100px; margin-top: 2px;">浏览照片</a><input class="form-control upload-url" name="stPhoto" id="pPic" style="width:88%; margin-left:5px; margin-right:5px;">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">附件</label>
                                <div class="col-sm-7">
                                    <input type="file" name="stEnclosure" id="stEnclosure" class="form-control">
                                </div>

                            </div>
                        
                                
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">添加员工</button>
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
<script type="text/javascript" src="/lianxi1/azqrsg/Public/Theme1/lib/webuploader/0.1.5/webuploader.min.js"></script> 

    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
    
    <script type="text/javascript">
	$(function(){
	$("#form-admin-add").validate({
		rules:{
            stNum:{
                required:true,
                minlength:1,
                maxlength:8
            },
            stName:{
                required:true,
                minlength:2,
                maxlength:16
            },
            stSex:{
                required:true,
            },
            stBirthdate:{
                required:true,
            },
            sCompanyIntroduce:{
                required:true,
            },
            stTel:{
                required:true,
                minlength:7,
                maxlength:11
            },
            stDegrees:{
                required:true,
            },
            stEntryDate:{
                required:true,
            },
            stDid:{
                required:true,
            },
            stPositionalTitles:{
                required:true,
            },
            stDuties:{
                required:true,
            },
            stMultiracial:{
                required:true,
            },
            stNativePlace:{
                required:true,
            },
            stIDCard:{
                //required:true,
                minlength:15,
                maxlength:18
            }
            
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
    
<script type="text/javascript" src="/lianxi1/azqrsg/Public/Theme1/static/plupload/plupload.full.min.js"></script>
<script type="text/javascript">
            var uploader = new plupload.Uploader(
                  {
                    runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
                    browse_button: 'btn', // 上传按钮
                    url: "/lianxi1/azqrsg/Personnelsystem/Staff/up", //远程上传地址
                    flash_swf_url: '/lianxi1/azqrsg/Public/plupload/Moxie.swf', //flash文件地址
                    silverlight_xap_url: '/lianxi1/azqrsg/Public/plupload/Moxie.xap', //silverlight文件地址
                    filters: {
                        max_file_size: '2mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                        mime_types: [//允许文件上传类型
                            {title: "files", extensions: "jpg,png,gif"}
                        ]
                 },
                multi_selection: true, //true:ctrl多文件上传, false 单文件上传
                init: {
                    FilesAdded: function(up, files) { //文件上传前
                        if ($("#ul_pics").children("li").length >7) {
                            alert("您上传的图片太多了！");
                            uploader.destroy();
                        } else {
                            var dd = '';
                            plupload.each(files, function(file) { //遍历文件
                                dd += "<dd id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></dd>";
                            });
                            $("#ul_pics").append(dd);
                            uploader.start();
                        }
                    },
                    UploadProgress: function(up, file) { //上传中，显示进度条
                 var percent = file.percent;
                        $("#ul_pics" + file.id).find('.bar').css({"width": percent + "%"});
                        $("#ul_pics" + file.id).find(".percent").text(percent + "%");
                    },
                    FileUploaded: function(up, file, info) { //文件上传成功的时候触发
                       var data = eval("(" + info.response + ")");
                        $("#" + file.id).html("<img src='/lianxi1/azqrsg/" + data.pic + "'/>");
                        var old=$("#pPic").val();
                         $("#pPic").val(old + data.pic+'###');
                    },
                    Error: function(up, err) { //上传出错的时候触发
                        alert(err.message);
                    }
                }
            });
            uploader.init();
        </script>  
</body>

</html>