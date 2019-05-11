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
    <script type="text/javascript" charset="utf-8" src="/tengbo/Public/ueditor/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/tengbo/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>

<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加精彩视频</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>选择图片：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic" />
                    <div class="tips"><img class="image" src="<?php echo ($info["pic"]); ?>" alt="<?php echo ($info["pic"]); ?>"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>标题：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["title"]); ?>" name="title" data-validate="required:请输入标题" />
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>浏览量：</label>
                </div>
                <div class="field">
                    <input type="number" class="input w50" value="<?php echo ($info["page_view"]); ?>" name="page_view" data-validate="number:请输入整数"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>详情：</label>
                </div>
                <div class="field">
                    <textarea type="text" id="editor" name="content" style="height:100px;width: 100%" ><?php echo ($info["content"]); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('editor');

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