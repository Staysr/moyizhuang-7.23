<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>管理员列表</title>

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
                        <h5>管理员列表 <a href="/lianxi1/azqrsg/Personnelsystem/Manage/manageadd" style="margin-left: 15px; color: #06cbc4">添加管理员</a></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th class="dropdown hidden-xs">ID</th>
                                    <th>登陆账号</th>
                                    <th class="dropdown hidden-xs">真实姓名</th>
                                    <th class="dropdown hidden-xs">性别</th>
                                    <th class="dropdown hidden-xs">电话</th>
                                    <th >角色名</th>
                                    <th class="dropdown hidden-xs">部门管辖范围</th>
                                    <th class="dropdown hidden-xs">使用状态</th>
                                    <th class="dropdown hidden-xs">登录状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($rs_admin)): foreach($rs_admin as $key=>$val_admin): ?><tr>
                                    <td class="dropdown hidden-xs"><?php echo ($val_admin["aId"]); ?></td>
                <td><?php echo ($val_admin["aUser"]); ?></td>
                <td class="dropdown hidden-xs"><?php echo ($val_admin["aName"]); ?></td>
                <?php if($val_admin["aSex"] == 1): ?><td class="dropdown hidden-xs">男</td>
                <?php else: ?>
                <td class="dropdown hidden-xs">女</td><?php endif; ?>
                <td class="dropdown hidden-xs"><?php echo ($val_admin["aTel"]); ?></td>
                <?php $aPowers=$val_admin["aPowers"]; $admin_role=M("admin_role"); $rs_role=$admin_role->field("arName,arPowers")->where("arId={$aPowers}")->find(); ?>
                <?php if($val_admin["aPowers"] == 0): ?><td><span style="color:#ff0000">内置管理员</span></td>
                <?php else: ?>
                    <?php if(($rs_role["arPowers"] == '0-0-0-0-B') OR ($rs_role["arPowers"] == 'A-A1-A2-0-B') OR ($rs_role["arPowers"] == 'A-A1-0-0-B') OR ($rs_role["arPowers"] == 'A-0-A2-0-B')): ?><td class="dropdown hidden-xs"><?php echo ($rs_role["arName"]); ?> 
                        <a title="分配部门" href="/lianxi1/azqrsg/Personnelsystem/Manage/manageupdatedepartment/aId/<?php echo ($val_admin["aId"]); ?>" style="text-decoration:none; color:#0000ff">分配部门</a>
                    </td>
                    <?php else: ?>
                    <td ><?php echo ($rs_role["arName"]); ?></td><?php endif; endif; ?>
                <?php if($val_admin["aDid"] == 0): ?><td class="dropdown hidden-xs">全部</td>
                <?php else: ?>
                <?php $aDid=$val_admin["aDid"]; $department=M("department"); $rs_departmentInfo=$department->where("dId={$aDid}")->field("dId,dPid,dPsid,dName")->find(); ?>
                <?php if($rs_departmentInfo["dPid"] == 0 AND $rs_departmentInfo["dPsid"] == 0): ?><td class="dropdown hidden-xs" ><?php echo ($rs_departmentInfo["dName"]); ?></td>
                <?php elseif($rs_departmentInfo["dPid"] != 0 AND $rs_departmentInfo["dPsid"] == 0): ?>
                <?php $dPid=$rs_departmentInfo["dPid"]; $department=M("department"); $rsp=$department->where("dId={$dPid}")->find(); ?>
                <td class="dropdown hidden-xs" ><?php echo ($rsp["dName"]); ?> -> <?php echo ($rs_departmentInfo["dName"]); ?></td>
                <?php elseif($rs_departmentInfo["dPid"] == 0 AND $rs_departmentInfo["dPsid"] != 0): ?>
                <?php $dPsid=$rs_departmentInfo["dPsid"]; $department=M("department"); $rsps=$department->where("dId={$dPsid}")->find(); $rsPsPid=$rsps["dPid"]; $rsPspe=$department->where("dId={$rsPsPid}")->find(); ?>
                <td class="dropdown hidden-xs" ><?php echo ($rsPspe["dName"]); ?> -> <?php echo ($rsps["dName"]); ?> -> <?php echo ($rs_departmentInfo["dName"]); ?></td><?php endif; endif; ?>
                <?php if($val_admin["aPowers"] == 0): ?><td class="dropdown hidden-xs td-status"><span class="label label-success radius">默认启用</span></td>
                <?php else: ?>
                    <?php if($val_admin["aStatic"] == 1): ?><td class="td-status dropdown hidden-xs "><span class="label label-success radius"><a href="/lianxi1/azqrsg/Personnelsystem/Manage/ManageUpdateStatic/ast/0/aId/<?php echo ($val_admin["aId"]); ?>" style="color:#ffffff">已启用</a></span></td>
                    <?php else: ?>
                    <td class="td-status dropdown hidden-xs "><span class="label label-error radius"><a href="/lianxi1/azqrsg/Personnelsystem/Manage/ManageUpdateStatic/ast/1/aId/<?php echo ($val_admin["aId"]); ?>" style="color:#ffffff">已停用</a></span>
                    </td><?php endif; endif; ?>
                <?php if($val_admin["aPowers"] == 0): ?><td class="td-status dropdown hidden-xs "><span class="label label-success radius">默认正常</span></td>
                <?php else: ?>
                <?php if(($val_admin["aErrorPwdNum"] != $systemEPLN) AND ($val_admin["aErrorPwdNum"] != -1)): ?><td class="td-status dropdown hidden-xs "><span class="label label-success radius"><a href="/lianxi1/azqrsg/Personnelsystem/Manage/ManageUpdateLock/lock/-1/aId/<?php echo ($val_admin["aId"]); ?>" style="color:#ffffff">正常状态</a></span></td>
                <?php elseif($val_admin["aErrorPwdNum"] == -1): ?>
                <td class="td-status dropdown hidden-xs "><span class="label label-error radius"><a href="/lianxi1/azqrsg/Personnelsystem/Manage/ManageUpdateLock/lock/0/aId/<?php echo ($val_admin["aId"]); ?>" style="color:#ffffff">管理员锁定</a></span></td>
                <?php elseif($val_admin["aErrorPwdNum"] == $systemEPLN): ?>
                <td class="td-status dropdown hidden-xs "><span class="label label-error radius"><a href="/lianxi1/azqrsg/Personnelsystem/Manage/ManageUpdateLock/lock/0/aId/<?php echo ($val_admin["aId"]); ?>" style="color:#ffffff">系统锁定</a></span></td><?php endif; endif; ?>
                <?php if($val_admin["aPowers"] == 0): if($sessionPowers == 0): ?><td class="td-manage">
                 <a title="修改我的资料" href="/lianxi1/azqrsg/Personnelsystem/Manage/manageupdate/aId/<?php echo ($val_admin["aId"]); ?>" style="text-decoration:none">修改我的资料</a>
                </td>
                <?php else: ?>
                <td class="td-manage">
                 <span style="color:#ff0000">内置管理员</span>
                </td><?php endif; ?>
                <?php else: ?>
                <td class="td-manage">
                <?php if($val_admin["aId"] == $sessionaId): ?><span style="color:#1247F3">当前登录账户</span><a title="修改我的资料" href="/lianxi1/azqrsg/Personnelsystem/Manage/manageupdate/aId/<?php echo ($val_admin["aId"]); ?>" style="text-decoration:none"><i class="glyphicon glyphicon-pencil"></i></a>
                <?php else: ?>
                    <a title="修改" href="/lianxi1/azqrsg/Personnelsystem/Manage/manageupdate/aId/<?php echo ($val_admin["aId"]); ?>"  style="text-decoration:none"><i class="glyphicon glyphicon-pencil"></i></a>
                
                <a title="删除" href="/lianxi1/azqrsg/Personnelsystem/Manage/ManageDelAction/aId/<?php echo ($val_admin["aId"]); ?>" style="text-decoration:none; margin-left:10px;"><i class="glyphicon glyphicon-remove"></i></a><?php endif; ?>
                </td><?php endif; ?>
                                   
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