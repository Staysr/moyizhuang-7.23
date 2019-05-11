<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>员工列表</title>

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
                        <h5>员工列表 <a href="/lianxi1/azqrsg/Personnelsystem/Staff/add" style="margin-left:15px; color:#06cbc4">添加员工</a></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>

                    <form method="post" action="/lianxi1/azqrsg/Personnelsystem/Staff/DelAll" class="form-horizontal" id="form-admin-add">
                    <script type="text/javascript">
                    function CheckAll(val) {
                        $("input[name='node[]']").each(function() {
                            this.checked = val;
                        });
                    }
                    </script>


                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>
                                <tr>
                                    <th></th>
                                    
                                    <th >序号</th>
                                    <th >姓名</th>
                                    <th >性别</th>
                                    <th >年龄</th>
									<th >婚姻</th>
                                    <th class="dropdown hidden-xs">学历</th>
                                    <th class="dropdown hidden-xs">手机</th>
                                    <th class="dropdown hidden-xs">部门</th>
                                    <th class="dropdown hidden-xs">工龄</th>
                                    <th class="dropdown hidden-xs">照片</th>
                                    <th class="dropdown hidden-xs">附件</th>
                                    <th class="dropdown hidden-xs">状态</th>
                                    <th class="dropdown hidden-xs">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($rs_staffLists)): foreach($rs_staffLists as $key=>$val_staffLists): ?><tr class="text-c">
                <td><input type="checkbox" name="node[]" value="<?php echo ($val_staffLists["stId"]); ?>"></td> 
                
                <td ><?php echo ($val_staffLists["stNum"]); ?></td>
                <td><a href="/lianxi1/azqrsg/Personnelsystem/Staff/show/stId/<?php echo ($val_staffLists["stId"]); ?>"><?php echo ($val_staffLists["stName"]); ?></a></td>
                <?php if($val_staffLists["stSex"] == 1): ?><td>男</td>
                <?php else: ?>
                <td>女</td><?php endif; ?>
                <?php $nowTime=time(); $stBirthdate=strtotime($val_staffLists["stBirthdate"]); $stAge=floor((($nowTime-$stBirthdate)/86400)/365); ?>
                <td><?php echo ($stAge); ?> 岁</td>
				<?php $hunyinInfo=""; $hunyinId=$val_staffLists["stMarital"]; $variables=M("variables"); $rs_variables=$variables->where("vId=4")->find(); $hunyin=explode("|",$rs_variables["vVariablesVal"]); foreach($hunyin as $key=>$valhunyin){ if($key==$hunyinId){ $hunyinInfo=$valhunyin; } } ?> 
				<td><?php echo ($hunyinInfo); ?></td>
                <?php $xueliInfo=""; $xueliId=$val_staffLists["stDegrees"]; $variables=M("variables"); $rs_variables=$variables->where("vId=1")->find(); $xueli=explode("|",$rs_variables["vVariablesVal"]); foreach($xueli as $key=>$valxueli){ if($key==$xueliId){ $xueliInfo=$valxueli; } } ?>  
                <td class="dropdown hidden-xs"><?php echo ($xueliInfo); ?></td>
                <td class="dropdown hidden-xs"><?php echo ($val_staffLists["stTel"]); ?></td>
                <?php $departmentInfo=M("department"); $rs_departmentInfo=$departmentInfo->field("dId,dPid,dPsid,dName")->where("dId={$val_staffLists['stDid']}")->find(); ?>
                <?php if($rs_departmentInfo["dPid"] == 0 AND $rs_departmentInfo["dPsid"] == 0): ?><td class="dropdown hidden-xs" ><?php echo ($rs_departmentInfo["dName"]); ?></td>
                <?php elseif($rs_departmentInfo["dPid"] != 0 AND $rs_departmentInfo["dPsid"] == 0): ?>
                <?php $dPid=$rs_departmentInfo["dPid"]; $department=M("department"); $rsp=$department->where("dId={$dPid}")->find(); ?>
                <td class="dropdown hidden-xs" ><?php echo ($rsp["dName"]); ?> -> <?php echo ($rs_departmentInfo["dName"]); ?></td>
                <?php elseif($rs_departmentInfo["dPid"] == 0 AND $rs_departmentInfo["dPsid"] != 0): ?>
                <?php $dPsid=$rs_departmentInfo["dPsid"]; $department=M("department"); $rsps=$department->where("dId={$dPsid}")->find(); $rsPsPid=$rsps["dPid"]; $rsPspe=$department->where("dId={$rsPsPid}")->find(); ?>
                <td class="dropdown hidden-xs" ><?php echo ($rsPspe["dName"]); ?> -> <?php echo ($rsps["dName"]); ?> -> <?php echo ($rs_departmentInfo["dName"]); ?></td><?php endif; ?>

                <?php $nowTime=time(); $stEntryDate=strtotime($val_staffLists["stEntryDate"]); $quiteYear=strtotime($val_staffLists["stDepartureDate"]); if($quiteYear!=0){ $nowWorkingYear=round(((($quiteYear-$stEntryDate)/86400)/365),1); }else{ $nowWorkingYear=round(((($nowTime-$stEntryDate)/86400)/365),1); } ?>
                <td class="dropdown hidden-xs"><?php echo ($nowWorkingYear); ?> 年</td>
                <?php $stPhoto=strlen($val_staffLists["stPhoto"]); ?>
                <?php if($stPhoto < 10): ?><td class="dropdown hidden-xs"><img src="/lianxi1/azqrsg/Public/Theme1/img/not.png" width="100px" height="110px"></td>
                <?php else: ?>
                <td class="dropdown hidden-xs"><a href="/lianxi1/azqrsg/Personnelsystem/Staff/showimages/stId/<?php echo ($val_staffLists["stId"]); ?>">
                <img src="/lianxi1/azqrsg/<?php echo ($val_staffLists["stPhoto"]); ?>" width="100px" height="110px">
                </a>
                </td><?php endif; ?>
                <?php $resname=""; if(strlen($val_staffLists["stEnclosure"])>5){ $stEnclosure=(explode(".",$val_staffLists["stEnclosure"])); if($stEnclosure[1]=="jpg" || $stEnclosure[1]=="png" || $stEnclosure[1]=="gif" || $stEnclosure[1]=="jpeg"){ $resname="1"; }else{ $resname="2"; } }else{ $resname="0"; } ?>
                <?php if($resname == 0): ?><td class="dropdown hidden-xs">暂无</td>
                <?php elseif($resname == 1): ?>
                <td class="dropdown hidden-xs"><a href="/lianxi1/azqrsg/Personnelsystem/Staff/showfujian/stId/<?php echo ($val_staffLists["stId"]); ?>">查看</a></td>
                <?php elseif($resname == 2): ?>
                <td class="dropdown hidden-xs"><a href="/lianxi1/azqrsg/<?php echo ($val_staffLists["stEnclosure"]); ?>">下载</a></td><?php endif; ?>
                <?php if($val_staffLists["stJobState"] == 1): ?><td class="dropdown hidden-xs"><span class="label label-success radius">在职</span></td>
                <?php else: ?>
                <td class="dropdown hidden-xs"><span class="label label-error radius">离职</span></td><?php endif; ?>
                
                <td class="td-manage dropdown hidden-xs">
                <a title="设置离职员工" href="/lianxi1/azqrsg/Personnelsystem/Staff/quitadd/stId/<?php echo ($val_staffLists["stId"]); ?>"><i class="glyphicon glyphicon-minus" style="margin-right: 10px;"></i></a>
                
                <a title="编辑员工资料" href="/lianxi1/azqrsg/Personnelsystem/Staff/update/stId/<?php echo ($val_staffLists["stId"]); ?>/depId/<?php echo ($depId); ?>"><i class="glyphicon glyphicon-pencil" style="margin-right: 10px;"></i></a>
                
                <a title="删除" href="/lianxi1/azqrsg/Personnelsystem/Staff/DelAction/stId/<?php echo ($val_staffLists["stId"]); ?>" ><i class="glyphicon glyphicon-remove"></i></a>
                
                </td>
            </tr><?php endforeach; endif; ?>
                            </tbody>
                            
                        </table>
                        <input type='checkbox' id='chkAll' onclick="CheckAll(this.checked)"> <span style="margin-right: 10px;color: #2c86da; font-size: 12px; font-weight: bold">全 选</span>
                        <input class="btn btn-success btn-xs" type="submit" value="删除" >
                    </div>
                    </form>
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