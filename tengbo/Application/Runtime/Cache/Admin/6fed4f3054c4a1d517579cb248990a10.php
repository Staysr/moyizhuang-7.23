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
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加岗位</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>岗位名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["job"]); ?>" name="job" data-validate="required:请输入岗位名称" />
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>工作地点：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["address"]); ?>" name="address" data-validate="required:请输入工作地点"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>招聘人数：</label>
                </div>
                <div class="field">
                    <input type="number" class="input w50" value="<?php echo ($info["num"]); ?>" name="num" data-validate="required:请输入人数,number:请输入合法人数"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>学历要求：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["require"]); ?>" name="require" data-validate="required:请输入学历要求"/>
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
                    <input type="hidden" value="<?php echo ($info["id"]); ?>" name="id"/>
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
</script>
</body>

</html>