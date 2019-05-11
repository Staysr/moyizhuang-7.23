<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>部门列表</title>

    <link rel="shortcut icon" href="favicon.ico"> <link href="/lianxi1/azqrsg/Public/Theme1/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/lianxi1/azqrsg/Public/Theme1/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/lianxi1/azqrsg/Public/Theme1/css/animate.min.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/style.min.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>月度目标信息列表 <a style="margin-left: 15px; color:#06cbc4" href="/lianxi1/azqrsg/Personnelsystem/Targets/monthadd">填写月度目标</a></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th class="dropdown hidden-xs">填写人员</th>
                                    <th  class="dropdown hidden-xs">填写时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($rs_mtablesinfo)): foreach($rs_mtablesinfo as $key=>$val_mtablesinfo): ?><tr>
                                    <td><?php echo ($val_mtablesinfo["mtId"]); ?></td>
                                    <td><a href="/lianxi1/azqrsg/Personnelsystem/Targets/monthoneinfo/mtId/<?php echo ($val_mtablesinfo["mtId"]); ?>"><?php echo ($val_mtablesinfo["mtTitle"]); ?></a></td>
                                    
                                    <td class="dropdown hidden-xs"><?php echo ($val_mtablesinfo["mtAname"]); ?></td>
                                    <td class="dropdown hidden-xs"><?php echo ($val_mtablesinfo["mtTime"]); ?></td>
                                    
                                    <td><a href="/lianxi1/azqrsg/Personnelsystem/Targets/monthupdate/mtId/<?php echo ($val_mtablesinfo["mtId"]); ?>"><i class="glyphicon glyphicon-pencil"></i></a> <a style="margin-left: 15px;" href="/lianxi1/azqrsg/Personnelsystem/Targets/MonthDel/mtId/<?php echo ($val_mtablesinfo["mtId"]); ?>"><i class="glyphicon glyphicon-remove"></i></a></td>
                                </tr><?php endforeach; endif; ?>
                            </tbody>
                            
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/content.min.js?v=1.0.0"></script>
    <script>
        $(document).ready(function(){$(".dataTables-example").dataTable();var oTable=$("#editable").dataTable();oTable.$("td").editable("../example_ajax.php",{"callback":function(sValue,y){var aPos=oTable.fnGetPosition(this);oTable.fnUpdate(sValue,aPos[0],aPos[1])},"submitdata":function(value,settings){return{"row_id":this.parentNode.getAttribute("id"),"column":oTable.fnGetPosition(this)[2]}},"width":"90%","height":"100%"})});function fnClickAddRow(){$("#editable").dataTable().fnAddData(["Custom row","New row","New row","New row","New row"])};
    </script>

</body>

</html>