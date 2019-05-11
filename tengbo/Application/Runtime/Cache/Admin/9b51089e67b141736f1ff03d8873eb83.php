<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="/tengbo/Public/admin/css/pintuer.css">
    <link rel="stylesheet" href="/tengbo/Public/admin/css/admin.css">
    <script src="/tengbo/Public/admin/js/jquery.js"></script>
    <script src="/tengbo/Public/admin/js/pintuer.js"></script>
    <script src="/tengbo/Public/laydate/laydate.js"></script>
</head>

<body>

<div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder">案例列表</strong></div>
    <div class="padding border-bottom">
        <form method="post" action="<?php echo U('case_list');?>" id="myform">
            <ul class="search" style="padding-left:10px;">
                <li>
                    <a class="button border-main icon-plus-square-o" href="<?php echo U('Case/case_add');?>">添加案例</a>
                </li>
                <li>搜索：</li>
                <li>
                    <input type="text" placeholder="开始时间" id="startTime" name="stime" class="input"
                           value="<?php echo ($_REQUEST['stime']); ?>"
                           style="width:100px; line-height:17px;display:inline-block" autocomplete="off"/>
                    <input type="text" placeholder="结束时间" id="endTime" name="etime" class="input"
                           value="<?php echo ($_REQUEST['etime']); ?>"
                           style="width:100px; line-height:17px;display:inline-block" autocomplete="off"/>
                </li>
                <li>
                    <select name="cid" class="input" style="line-height: 17px">
                        <option value="">请选择分类</option>
                        <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $_REQUEST['cid']): ?>selected<?php endif; ?> ><?php echo ($v["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                <li>
                    <input type="text" placeholder="输入标题" name="remark" value="<?php echo ($_REQUEST['title']); ?>" class="input" style="width:250px; line-height:17px;display:inline-block"/>
                </li>
                <li>
                    <a href="javascript:$('#myform').submit();" class="button border-main icon-search"> 搜索</a>
                </li>
            </ul>
        </form>
    </div>
    <form method="post" action="" id="listform">
        <table class="table table-hover text-center">
            <tr>
                <th>图片</th>
                <th>分类</th>
                <th>标题</th>
                <th>浏览量</th>
                <th>添加时间</th>
                <th width="310">操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                    <td style="width: 50px"><img src="<?php echo ($v["pic"]); ?>" alt="" style="width: 80px;height: auto"/></td>
                    <td><?php echo ($v["class_name"]); ?></td>
                    <td><?php echo ($v["title"]); ?></td>
                    <td><?php echo ($v["page_view"]); ?></td>
                    <td><?php echo ($v["add_time"]); ?></td>
                    <td>
                        <div class="button-group">
                            <a class="button border-main" href="<?php echo U('Case/case_update',array('id'=>$v['id']));?>"><span class="icon-edit"></span>查看编辑</a>
                            <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($v['id']); ?>,this)"><span class="icon-trash-o"></span> 删除</a>
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
    </form>
</div>
<script type="text/javascript">
    function del(id, that) {
        if (confirm('确定删除吗')) {
            $(that).parent().parent().parent().remove();
            $.ajax({
                type: "post",
                url: "<?php echo U('Case/case_del');?>",
                data: {id: id},
                success: function (response) {

                }
            });
        }
    }

    var startDate = laydate.render({
        elem: '#startTime',
        done: function (value, date) {
            if (value != "") {
                date.month = date.month - 1;
                endDate.config.min = date;
            } else {
                endDate.config.min = startDate.config.min;
            }
        },
    });
    var endDate = laydate.render({
        elem: '#endTime',
        done: function (value, date) {
            if (value != "") {
                date.month = date.month - 1;
                startDate.config.max = date;
            } else {
                startDate.config.max = endDate.config.max;
            }
        }
    });
</script>
</body>

</html>