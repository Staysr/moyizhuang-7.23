<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="/tengbo/Public/admin/css/pintuer.css">
    <link rel="stylesheet" href="/tengbo/Public/admin/css/admin.css">
    <script src="/tengbo/Public/admin/js/jquery.js"></script>
    <script src="/tengbo/Public/admin/js/pintuer.js"></script>
    <script src="/tengbo/Public/laydate/laydate.js"></script>

    <script type="text/javascript" charset="utf-8" src="/tengbo/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/tengbo/Public/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/tengbo/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>

<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>联系我们基础信息</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>公司文化图1：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic1" />
                    <div class="tips"><img class="image" src="<?php echo ($info["pic1"]); ?>" alt="<?php echo ($info["pic1"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司文化图2：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic2" />
                    <div class="tips"><img class="image" src="<?php echo ($info["pic2"]); ?>" alt="<?php echo ($info["pic2"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司文化图3：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic3" />
                    <div class="tips"><img class="image" src="<?php echo ($info["pic3"]); ?>" alt="<?php echo ($info["pic3"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>加入我们图：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic4" />
                    <div class="tips"><img class="image" src="<?php echo ($info["pic4"]); ?>" alt="<?php echo ($info["pic4"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>招聘邮箱：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["email"]); ?>" name="email" data-validate="required:请输入邮箱,email:请输入合法邮箱" />
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>招聘电话：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["phone"]); ?>" name="phone" data-validate="required:请输入电话,phone:请输入合法电话"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>传真：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["fax"]); ?>" name="fax" data-validate="required:请输入传真,phone:请输入合法传真号"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <input type="hidden" value="<?php echo ($info["id"]); ?>" name="id"/>
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(".imgInput").change(function(){
        if($(this).val()){
            $(this).next().find(".image").attr("src",URL.createObjectURL($(this)[0].files[0]));
        }else{
            $(this).next().find(".image").attr("src",$(this).next().find(".image").attr('alt'));
        }
    });
</script>
</body>

</html>