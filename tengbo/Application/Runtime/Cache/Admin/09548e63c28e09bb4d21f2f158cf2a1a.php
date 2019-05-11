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
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加产品</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>选择产品图：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic" data-validate="required:请选择图片" />
                    <div class="tips"><img class="image" src="" alt=""/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择详情图1：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic1" data-validate="required:请选择图片" />
                    <div class="tips"><img class="image" src="" alt=""/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择详情图2：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic2" />
                    <div class="tips"><img class="image" src="" alt=""/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择详情图3：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic3" />
                    <div class="tips"><img class="image" src="" alt=""/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择详情图4：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic4" />
                    <div class="tips"><img class="image" src="" alt=""/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择一级分类：</label>
                </div>
                <div class="field">
                    <select name="class1" class="input w50 class1" data-validate="required:请选择分类">
                        <?php if(is_array($class1)): $i = 0; $__LIST__ = $class1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择二级分类：</label>
                </div>
                <div class="field">
                    <select name="class2" class="input w50 class2" data-validate="required:请选择分类">
                        <?php if(is_array($class2)): $i = 0; $__LIST__ = $class2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>选择三级分类：</label>
                </div>
                <div class="field">
                    <select name="class3" class="input w50 class3" data-validate="required:请选择分类">
                        <?php if(is_array($class3)): $i = 0; $__LIST__ = $class3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>标题：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="title" data-validate="required:请输入标题" />
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>详情：</label>
                </div>
                <div class="field">
                    <textarea type="text" id="content" name="content" style="height:100px;width: 100%" ></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>参数：</label>
                </div>
                <div class="field">
                    <textarea type="text" id="param" name="param" style="height:100px;width: 100%" ></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>简介：</label>
                </div>
                <div class="field">
                    <textarea type="text" id="intro" name="intro" style="height:100px;width: 100%" ></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var content = UE.getEditor('content');
    var param = UE.getEditor('param');
    var intro = UE.getEditor('intro');

    $(".imgInput").change(function(){
        if($(this).val()){
            $(this).next().find(".image").attr("src",URL.createObjectURL($(this)[0].files[0]));
        }else{
            $(this).next().find(".image").attr("src",'');
        }
    });

    $('.class1').change(function () {
        var id = $('.class1').val()

        $.ajax({
            type:"post",
            url:"<?php echo U('Product/get_class');?>",
            data:{id:id},
            success:function(response){
                var class2 = '';
                var class3 = '';
                $.each(response[0],function (k,v) {
                    class2 += '<option value="'+v.id+'">'+v.class_name+'</option>';
                })
                $.each(response[1],function (k,v) {
                    class3 += '<option value="'+v.id+'">'+v.class_name+'</option>';
                })
                $('.class2').html(class2);
                $('.class3').html(class3);
            }
        });
    })

    $('.class2').change(function () {
        var id = $('.class2').val()

        $.ajax({
            type:"post",
            url:"<?php echo U('Product/getClass');?>",
            data:{id:id},
            success:function(response){
                var class3 = '';
                $.each(response,function (k,v) {
                    class3 += '<option value="'+v.id+'">'+v.class_name+'</option>';
                })
                $('.class3').html(class3);
            }
        });
    })
</script>
</body>

</html>