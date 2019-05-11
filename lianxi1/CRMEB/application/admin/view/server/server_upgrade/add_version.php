{extend name="public/container"}
{block name="content"}
<div class="row">
    <div class="col-sm-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox">
                <div class="ibox-content">
<!--                    <div class="row">-->
<!--                        <div class="col-sm-12">-->
<!--                            <div class="m-b-md">-->
<!--                                <div class="col-sm-8"><h2>添加升级信息</h2></div>-->
<!--                                <div class="col-sm-1"><span class="btn btn-success" onclick="$eb.createModalFrame(this.innerText,'{:Url('ip_http_list')}')"">IP白名单列表</span></div>-->
<!--                                <div class="col-sm-1"><span class="btn btn-danger" onclick="$eb.createModalFrame(this.innerText,'{:Url('create')}')"">添加IP白名单</span></div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" onsubmit="return false">
                                <div class="form-group text-right col-sm-12">
                                    <label class="col-sm-2 col-sm-offset-1 control-label">版本号：</label>
                                    <div class="col-sm-7">
                                        <input type="text" placeholder="版本号如：1.0" class="form-control" id="version">
                                        <span class="help-block m-b-none">请输入升级的版本号</span>
                                    </div>
                                </div>
                                <div class="form-group text-right col-sm-12">
                                    <label class="col-sm-2 col-sm-offset-1 control-label">更新内容：</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control text" rows="10"></textarea>
                                        <span class="help-block m-b-none">请输入更新内容</span>
                                    </div>
                                </div>
                                <style>
                                    .zipfile{
                                        position: relative;
                                        padding: 30px;
                                        border: 1px dashed #e2e2e2;
                                        background-color: #fff;
                                        text-align: center;
                                        cursor: pointer;
                                        color: #999;
                                    }
                                    .zipfile>i{
                                        font-size: 50px;
                                        color: #ccc;
                                    }
                                </style>
                                <div class="form-group text-right col-sm-12">
                                    <label class="col-sm-2 col-sm-offset-1 control-label">上传ZIP文件：</label>
                                    <div class="col-sm-7" style="position: relative">
                                        <div class="zipfile col-sm-5">
                                            <h3 id="name"></h3>
                                            <i class="fa fa-cloud-upload"></i>
                                        </div>
                                        <input type="file" name="zip_file" class="zip_file" style="display: none">
                                        <input type="hidden" name="zip_nam" id="zip_nam">
                                        <input type="hidden" name="openfile" id="openfile">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 text-center">
                                    <button class="btn btn-primary" type="submit" id="submit">保存内容</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function (){
        $('.zipfile').click(function () {
            $('.zip_file').click();
        })
        $('#name').click(function(e){
            var that=this;
            e.stopPropagation();
            if(!$('#zip_nam').val()) return false;
            $eb.layer.confirm('确认删除刚刚上传的ZIP文件吗？', {
                btn: ['删除','取消'] //按钮
            }, function(){
                $.ajax({
                    data:{
                        zip_name:$('#zip_nam').val(),
                    },
                    type: "POST",
                    url:"{:Url('del_zip')}",
                    dataType: 'json',
                    success: function (result) {
                        if(result.code==200){
                            $(that).text('');
                        }else{
                            $eb.layer.msg(result.msg);
                        }

                    }
                })
            }, function(){
                $eb.layer.msg('已取消',{icon:0});
            });
        })
        $('input[type="file"]').change(function(e){
            var $data=new FormData;
            var zip=e.delegateTarget.files[0];
            $data.append('zip_file',zip);
            $('#name').text(zip.name);
            $.ajax({
                data: $data,
                type: "POST",
                url:"{:Url('upload')}",
                cache: false,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (result) {
                    if(result.code==200){
                        $('.fa-cloud-upload').css('color','#009688');
                        $("#zip_nam").val(result.data.savename);
                        $('#openfile').val(result.data.openfile);
                        $eb.layer.msg('上传成功');
                    }else{
                        $('#name').text('');
                        $eb.layer.msg(result.msg);
                    }
                }
            })
        })
        $("#submit").click(function () {
            var content=$('.text').val().trim(),zip_name=$('#zip_nam').val().trim(),version=$('#version').val().trim();
            if(!content){
                $eb.layer.msg('请写入升级版本内容');
                return false;
            }
            if(!version){
                $eb.layer.msg('请写入版本号');
                return false;
            }
            if(!zip_name){
                $eb.layer.msg('请写上传ZIP文件');
                return false;
            }
            $.ajax({
                data:{
                    content:content,
                    zip_name:zip_name,
                    version:version,
                    openfile:$("#openfile").val().trim()
                },
                type: "POST",
                url:"{:Url('add_version')}",
                dataType: 'json',
                success: function (result) {
                    if(result.code==200){
                        $eb.layer.msg(result.msg);
                    }else{
                        $eb.layer.msg(result.msg);
                    }

                }
            })
        })
    })()
</script>
{/block}