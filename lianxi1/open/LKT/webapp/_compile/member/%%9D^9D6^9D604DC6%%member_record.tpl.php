<?php /* Smarty version 2.6.26, created on 2019-01-11 09:14:52
         compiled from member_record.tpl */ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link href="style/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="style/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="style/css/style.css" rel="stylesheet" type="text/css" />
<link href="style/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />

<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe62d;</i> 配置管理 <span class="c-gray en">&gt;</span> 管理员记录表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="text-c">
        <form name="form1" action="index.php" method="get">
            <input type="hidden" name="module" value="member" />
            <input type="hidden" name="action" value="member_record" />
            <input type="hidden" name="pagesize" value="<?php echo $this->_tpl_vars['pagesize']; ?>
" id="pagesize" />

            <input type="text" name="admin_name" size='8' value="<?php echo $this->_tpl_vars['admin_name']; ?>
" id="" placeholder="管理员账号" style="width:200px" class="input-text">
            <input name="startdate" value="<?php echo $this->_tpl_vars['startdate']; ?>
" size="8" readonly class="scinput_s" style="width: 100px; height:26px;font-size: 14px;vertical-align: middle;" />
            <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
            至
            <input name="enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" size="8" readonly  class="scinput_s" style="width: 100px; height:26px;font-size: 14px;vertical-align: middle;"/>
            <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
            <input name="" id="" class="btn btn-success" type="submit" value="查询">
            <input type="button" value="导出" class="btn btn-success" onclick="excel('all')">
            <input type="button" class="btn btn-warning radius" onclick="multiple_del('onekey')" value="一键清空" />
        	<input type="button" class="btn btn-danger radius" onclick="multiple_del('batch')" value="批量删除" />
        </form>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover">
            <thead>
                <tr class="text-c">
                    <th width="25">
                        <div style="position: relative;display: flex;height: 30px;align-items: center;">
                            <input name="ipt1" id="ipt1" type="checkbox" value="" class="inputC">
                            <label for="ipt1"></label>
                        </div>
                    </th>
                    <th>管理员账号</th>
                    <th>事件</th>
                    <th>时间</th>
                </tr>
            </thead>
            <tbody>
            <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['f1']['iteration']++;
?>
                <tr class="text-c">
                    <td>
                        <div style="display: flex;align-items: center;height: 60px;">
                            <input name="id[]"  id="<?php echo $this->_tpl_vars['item']->id; ?>
" type="checkbox" class="inputC " value="<?php echo $this->_tpl_vars['item']->id; ?>
">
                            <label for="<?php echo $this->_tpl_vars['item']->id; ?>
"></label>
                        </div>
                    </td>
                    <td><?php echo $this->_tpl_vars['item']->admin_name; ?>
</td>
                    <td><?php echo $this->_tpl_vars['item']->event; ?>
</td>
                    <td><?php echo $this->_tpl_vars['item']->add_date; ?>
</td>
                </tr>
            <?php endforeach; endif; unset($_from); ?>
            </tbody>
        </table>
    </div>
    <div style="text-align: center;display: flex;justify-content: center;"><?php echo $this->_tpl_vars['pages_show']; ?>
</div>
</div>

<script type="text/javascript" src="style/js/jquery.js"></script>
<script type='text/javascript' src='modpub/js/calendar.js'> </script>

<script type="text/javascript" src="style/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="style/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="style/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="style/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="style/js/H-ui.js"></script> 
<script type="text/javascript" src="style/js/H-ui.admin.js"></script>

<?php echo '
<script type="text/javascript">
function excel(pageto) {
    var pagesize = $("#pagesize").val();
    location.href=location.href+\'&pageto=\'+pageto+\'&pagesize=\'+pagesize;
}

/*批量删除*/
function multiple_del($type){
    if($type == \'onekey\'){
        confirm("确认要一键清空吗？",$type);
    }else{
        var checkbox=$("input[name=\'id[]\']:checked");//被选中的复选框对象
        var Id = \'\';
        for(var i=0;i<checkbox.length;i++){
            Id+=checkbox.eq(i).val()+",";
        }
        console.log(Id)
        if(Id==""){
            appendMask(\'未选择数据!\');
            return false;
        }
        confirm("确认要批量删除吗？",$type,Id);
    }
}
function confirm (content,type,id){
    $("body").append(`
        <div class="maskNew">
            <div class="maskNewContent">
                <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                <div class="maskTitle">提示</div>
                <div style="text-align:center;margin-top:30px"><img src="images/icon1/ts.png"></div>
                <div style="height: 50px;position: relative;top:20px;font-size: 22px;text-align: center;">
                    ${content}
                </div>
                <div style="text-align:center;margin-top:30px">
                    <button class="closeMask" style="margin-right:20px" onclick=closeMask(\'${type}\',\'${id}\') >确认</button>
                    <button class="closeMask" onclick=closeMask1() >取消</button>
                </div>
            </div>
        </div>
    `)
}
function appendMask(content,src){
    $("body").append(`
        <div class="maskNew">
            <div class="maskNewContent">
                <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                <div class="maskTitle">删除</div>
                <div style="text-align:center;margin-top:30px"><img src="images/icon1/${src}.png"></div>
                <div style="height: 50px;position: relative;top:20px;font-size: 22px;text-align: center;">
                    ${content}
                </div>
                <div style="text-align:center;margin-top:30px">
                    <button class="closeMask" onclick=closeMask1() >确认</button>
                </div>
            </div>
        </div>
    `)
}
function closeMask1(){
    $(".maskNew").remove();
    location.replace(location.href);
}
function closeMask(type,Id){
    $.get("index.php?module=member&action=member_record_del",{\'id\':Id,\'type\':type},function(res){
        if(res.status=="1"){
            appendMask("删除成功","cg");
        }else{
            appendMask("删除失败","ts");
        }
    },"json");
    $(".maskNew").remove();
}
</script>
'; ?>

</body>
</html>