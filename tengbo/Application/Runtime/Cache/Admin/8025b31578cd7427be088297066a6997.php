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
                    <label>项目技术培训图1：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="project1" />
                    <div class="tips"><img class="image" src="<?php echo ($info["project1"]); ?>" alt="<?php echo ($info["project1"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>项目技术培训图2：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="project2" />
                    <div class="tips"><img class="image" src="<?php echo ($info["project2"]); ?>" alt="<?php echo ($info["project2"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>项目验收图1：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="project3" />
                    <div class="tips"><img class="image" src="<?php echo ($info["project3"]); ?>" alt="<?php echo ($info["project3"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>项目验收图2：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="project4" />
                    <div class="tips"><img class="image" src="<?php echo ($info["project4"]); ?>" alt="<?php echo ($info["project4"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>项目验收图3：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="project5" />
                    <div class="tips"><img class="image" src="<?php echo ($info["project5"]); ?>" alt="<?php echo ($info["project5"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>项目验收图4：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="project6" />
                    <div class="tips"><img class="image" src="<?php echo ($info["project6"]); ?>" alt="<?php echo ($info["project6"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>技术支持图：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic1" />
                    <div class="tips"><img class="image" src="<?php echo ($info["pic1"]); ?>" alt="<?php echo ($info["pic1"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>售后服务图：</label>
                </div>
                <div class="field">
                    <input type="file" class="input w50 imgInput" value="" name="pic2" />
                    <div class="tips"><img class="image" src="<?php echo ($info["pic2"]); ?>" alt="<?php echo ($info["pic2"]); ?>" style="width: 50%;height: auto"/></div>
                    <div class="tips" style="color: red;">图片尺寸：750*375</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>地址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["address"]); ?>" name="address" data-validate="required:请输入地址" />
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>联系电话：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["phone"]); ?>" name="phone" data-validate="required:请输入电话,phone:请输入合法电话"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>周末服务电话：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($info["serve_phone"]); ?>" name="serve_phone" data-validate="required:请输入电话,phone:请输入合法电话"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>终生关爱简介：</label>
                </div>
                <div class="field">
                    <textarea type="text" name="content1" style="height:100px;width: 100%" data-validate="required:请输入简介"><?php echo ($info["content1"]); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>即时服务简介：</label>
                </div>
                <div class="field">
                    <textarea type="text" name="content2" style="height:100px;width: 100%" data-validate="required:请输入简介"><?php echo ($info["content2"]); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>技术支持简介：</label>
                </div>
                <div class="field">
                    <textarea type="text" name="content3" style="height:100px;width: 100%" data-validate="required:请输入简介"><?php echo ($info["content3"]); ?></textarea>
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