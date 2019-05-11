{extend name="public/container"}
{block name="content"}
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="m-b m-l">
                        <form action="" class="form-inline">
                            <div class="input-group">
                                <input size="26" type="text" name="webid" value="{$where.webid}" placeholder="请输入站点名称、IP、域名" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search" ></i>搜索</button> </span>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="footable table table-striped  table-bordered " data-page-size="20">
                    <thead>
                    <tr>
                        <th class="text-center">编号</th>
                        <th class="text-center">站点ID</th>
                        <th class="text-center">站点名称</th>
                        <th class="text-center">站点网址</th>
                        <th class="text-center">站点IP</th>
                        <th class="text-center">版本id</th>
                        <th class="text-center">之前版本号</th>
                        <th class="text-center">更新版本号</th>
                        <th class="text-center">更新时间</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    {volist name="list" id="vo"}
                    <tr>
                        <td class="text-center">{$vo.id}</td>
                        <th class="text-center">{$vo.webid}</th>
                        <th class="text-center">{$vo.name}</th>
                        <th class="text-center">{$vo.https}</th>
                        <th class="text-center">{$vo.ip}</th>
                        <td class="text-center">{$vo.versionid}</td>
                        <td class="text-center">{$vo.versionbefor}</td>
                        <td class="text-center">{$vo.versionend}</td>
                        <td class="text-center">{$vo.update_time}</td>

                    </tr>
                    {/volist}
                    </tbody>
                </table>
                {include file="public/inner_page"}
            </div>
        </div>
    </div>
</div>
{/block}