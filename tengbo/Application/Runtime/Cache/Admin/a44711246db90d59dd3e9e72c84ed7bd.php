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
    <script src="/tengbo/Public/layer/layer/layer.js"></script>
</head>

<body>
<div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 案例分类列表</strong></div>
    <div class="padding border-bottom">
        <a class="button border-yellow" href="<?php echo U('Case/case_class_add');?>" ><span class="icon-plus-square-o"></span> 添加分类</a>
    </div>
    <table class="table table-hover text-center">
        <tr>
            <th width="10%">ID</th>
            <th width="20%">分类名</th>
            <th width="10%">添加时间</th>
            <th width="15%">操作</th>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["class_name"]); ?></td>
                <td><?php echo ($v["add_time"]); ?></td>
                <td>
                    <div class="button-group">
                        <a class="button border-main" href="<?php echo U('Case/case_class_update',array('id'=>$v['id']));?>"><span class="icon-edit"></span>修改类名</a>
                        <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($v['id']); ?>,$(this))"><span class="icon-trash-o"></span> 删除</a>
                    </div>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td colspan="9">
                <div class="pagelist">
                    <?php echo ($page); ?>
                </div>
            </td>
        </tr>
    </table>
</div>
<script>
    function del(id,that){
        if(confirm('确定要删除吗?')){
            that.parent().parent().parent().remove();
            $.ajax({
                type:"post",
                url:"<?php echo U('Case/case_class_del');?>",
                data:{id:id},
                success:function(response){

                }
            });
        }
    }

</script>
</body>

</html>