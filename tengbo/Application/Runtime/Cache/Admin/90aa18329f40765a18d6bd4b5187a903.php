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
<style>
    .close{
        display: none;
    }

</style>
<div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 产品分类列表</strong></div>
    <div class="padding border-bottom">
        <a class="button border-yellow" href="<?php echo U('Product/product_class_add');?>" ><span class="icon-plus-square-o"></span> 添加分类</a>
    </div>
    <table class="table table-hover text-center">
        <tr>
            <th width="1%"></th>
            <th width="10%">分类等级</th>
            <th width="10%">排序</th>
            <th width="20%">分类名</th>
            <th width="10%">添加时间</th>
            <th width="15%">操作</th>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                <td onclick="tree1($(this));" style="background: #aab0bc">+</td>
                <td>一级分类</td>
                <td><input type="number" value="<?php echo ($v["sort"]); ?>" onchange="sort(<?php echo ($v['sort']); ?>,this)" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td>
                <td><?php echo ($v["class_name"]); ?></td>
                <td><?php echo ($v["add_time"]); ?></td>
                <td>
                    <div class="button-group">
                        <a class="button border-main" href="<?php echo U('Product/product_class_update',array('id'=>$v['id']));?>"><span class="icon-edit"></span>修改类名</a>
                        <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($v['id']); ?>,$(this),1)"><span class="icon-trash-o"></span> 删除</a>
                    </div>
                </td>
            </tr>
            <?php if(is_array($v['class2'])): $i = 0; $__LIST__ = $v['class2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr class="close class2">
                    <td onclick="tree2($(this));" style="background: #aab0bc">+</td>
                    <td>二级分类</td>
                    <td><input type="number" value="<?php echo ($vv["sort"]); ?>" onchange="sort(<?php echo ($vv['sort']); ?>,this)" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td>
                    <td><?php echo ($vv["class_name"]); ?></td>
                    <td><?php echo ($vv["add_time"]); ?></td>
                    <td>
                        <div class="button-group">
                            <a class="button border-main" href="<?php echo U('Product/product_class_update',array('id'=>$vv['id']));?>"><span class="icon-edit"></span>修改类名</a>
                            <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($vv['id']); ?>,$(this),2)"><span class="icon-trash-o"></span> 删除</a>
                        </div>
                    </td>
                </tr>
                <?php if(is_array($vv['class3'])): $i = 0; $__LIST__ = $vv['class3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?><tr class="close class3">
                        <td></td>
                        <td>三级分类</td>
                        <td><input type="number" value="<?php echo ($vvv["sort"]); ?>" onchange="sort(<?php echo ($vvv['sort']); ?>,this)" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td>
                        <td><?php echo ($vvv["class_name"]); ?></td>
                        <td><?php echo ($vvv["add_time"]); ?></td>
                        <td>
                            <div class="button-group">
                                <a class="button border-main" href="<?php echo U('Product/product_class_update',array('id'=>$vvv['id']));?>"><span class="icon-edit"></span>修改类名</a>
                                <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($vvv['id']); ?>,$(this),3)"><span class="icon-trash-o"></span> 删除</a>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
<script>
    function del(id,that,level){
        if(confirm('确定要删除吗?')){
            $.ajax({
                type:"post",
                url:"<?php echo U('Product/product_class_del');?>",
                data:{id:id,level:level},
                success:function(response){
                    if(response.code){
                        that.parent().parent().parent().remove();
                    }
                    layer.msg(response.msg);
                }
            });
        }
    }

    function sort(id, that) {
        var sort = $(that).val();
        if(/^[1-9][0-9]*$/.test(sort)){
            $.ajax({
                type: "post",
                url: "<?php echo U('Product/product_class_sort');?>",
                data: {id: id,sort:sort},
                success: function (response) {
                    location.reload()
                }
            });
        }else{
            layer.msg('请填写整数');
        }
    }
    
    function tree1(that) {
        that.text(that.text()=='+' ? '-':'+');
        if(that.parent().next('tr').hasClass('close')){
            //打开
            that.parent().siblings('.class2').removeClass('close');
        }else{
            //关闭
            that.parent().siblings('.class2').addClass('close');
        }
    }

    function tree2(that) {
        that.text(that.text()=='+' ? '-':'+');

        that.parent().siblings('.class3').toggleClass('close');
    }
    

</script>
</body>

</html>