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
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加案例</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>分类名：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="class_name" data-validate="required:请填写分类名" />
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择一级分类：</label>
                </div>
                <div class="field">
                    <select name="class1" class="input w50" id="class1">
                        <?php if(is_array($class1)): $i = 0; $__LIST__ = $class1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择二级分类：</label>
                </div>
                <div class="field">
                    <select name="class2" class="input w50" id="class2">
                        <option value="">选择二级分类</option>
                        <?php if(is_array($class2)): $i = 0; $__LIST__ = $class2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 添加</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#class1').change(function () {
        var id = $('#class1').val()

        $.ajax({
            type:"post",
            url:"<?php echo U('Product/getClass');?>",
            data:{id:id},
            success:function(response){
                var str = '<option value="">选择二级分类</option>';
                $.each(response,function (k,v) {
                    str += '<option value="'+v.id+'">'+v.class_name+'</option>';
                })
                $('#class2').html(str);
            }
        });
    })


</script>
</body>

</html>