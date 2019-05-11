{extend name="public/container"}
{block name="content"}
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-title">
                <button type="button" class="btn btn-w-m btn-primary" onclick="$eb.createModalFrame(this.innerText,'{:Url('add_version')}')">添加版本</button>
            </div>
            <div class="ibox-content">


                <table class="footable table table-striped  table-bordered " data-page-size="20">
                    <thead>
                    <tr>
                        <th class="text-center">编号</th>
                        <th class="text-center">版本号</th>
                        <th class="text-center">更新时间</th>
                        <th class="text-center">更新内容</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    {volist name="list" id="vo"}
                    <tr>
                        <td class="text-center">{$vo.id}</td>
                        <td class="text-center">{$vo.version}</td>
                        <td class="text-center">{$vo.add_time|date='Y-m-d H:i:s',###}</td>
                        <td class="text-center">{$vo.content}</td>
                        <td class="text-center">

                            <button class="btn btn-warning btn-xs"type="button"  onclick="$eb.createModalFrame(this.innerText,'{:Url(\'edit_version\',array(\'id\'=>$vo[\'id\']))}')"><i class="fa fa-warning"></i>编辑</button>
                            <button class="btn btn-success btn-xs" data-url="{:Url('delete_version',array('id'=>$vo['id']))}"  type="button"><i class="fa fa-warning"></i>删除</button>
                        </td>
                    </tr>
                    {/volist}
                    </tbody>
                </table>
                {include file="public/inner_page"}
            </div>
        </div>
    </div>
</div>
<script>
    $(".btn-success").click(function () {
        var that=this;
        $eb.layer.confirm('您确删除这个版本吗？',{
            btn: ['删除','取消'] //按钮
        }, function(){
            $.ajax({
                type: "GET",
                url:$(that).data('url'),
                dataType: 'json',
                success: function (result){
                    if(result.code==200){
                        $eb.layer.msg(result.msg,{icon:1});
                        $(that).parents('tr').remove();
                    }else{
                        $eb.layer.msg(result.msg);
                    }
                }
            })
        }, function(){
            $eb.layer.msg('已取消',{icon:0});
        });
    })
</script>
{/block}