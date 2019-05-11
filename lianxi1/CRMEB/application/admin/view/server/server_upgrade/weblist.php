{extend name="public/container"}
{block name="content"}
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-title">
                <button type="button" class="btn btn-w-m btn-primary" onclick="$eb.createModalFrame(this.innerText,'{:Url('create')}')">添加站点</button>
            </div>
            <div class="ibox-content">

                <div class="row">
                    <div class="m-b m-l">
                        <form action="" class="form-inline">
                            <select name="status" aria-controls="editable" class="form-control input-sm">
                                <option value="" {eq name="where.status" value=""}selected="selected"{/eq}>状态</option>
                                <option value="1" {eq name="where.status" value="1"}selected="selected"{/eq}>正常</option>
                                <option value="0" {eq name="where.status" value="0"}selected="selected"{/eq}>锁定</option>
                            </select>
                            <div class="input-group">
                                <input size="26" type="text" name="keyword" value="{$where.keyword}" placeholder="请输入站点名称、IP、域名" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search" ></i>搜索</button> </span>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="footable table table-striped  table-bordered " data-page-size="20">
                    <thead>
                    <tr>
                        <th class="text-center">编号</th>
                        <th class="text-center">IP</th>
                        <th class="text-center">HTTPS</th>
                        <th class="text-center">名称</th>
                        <th class="text-center">添加时间</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    {volist name="list" id="vo"}
                    <tr>
                        <td class="text-center">{$vo.id}</td>
                        <td class="text-center">{$vo.ip}</td>
                        <td class="text-center">{$vo.https}</td>
                        <td class="text-center">{$vo.name}</td>
                        <td class="text-center">{$vo.add_time|date='Y-m-d H:i:s',###}</td>
                        <td class="text-center">
                            {if $vo.status}
                            <button class="btn btn-warning btn-xs" data-url="{:Url('delete',array('id'=>$vo['id']))}" type="button"><i class="fa fa-warning"></i> 封禁
                            </button>
                            {else}
                            <button class="btn btn-success btn-xs" type="button"><i class="fa fa-warning"></i>已封禁</button>
                            {/if}
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
    $(".btn-warning").click(function () {
        var that=this;
        $eb.layer.confirm('您确定封禁这条IP吗？',{
            btn: ['封禁','取消'] //按钮
        }, function(){
            $.ajax({
                type: "GET",
                url:$(that).data('url'),
                dataType: 'json',
                success: function (result){
                    if(result.code==200){
                        $eb.layer.msg(result.msg,{icon:1});
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