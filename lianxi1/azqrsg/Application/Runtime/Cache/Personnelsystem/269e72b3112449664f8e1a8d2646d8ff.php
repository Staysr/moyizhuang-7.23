<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>数据库备份列表</title>
    
    <link rel="shortcut icon" href="favicon.ico"> <link href="/lianxi1/azqrsg/Public/Theme1/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/animate.min.css" rel="stylesheet">
    <link href="/lianxi1/azqrsg/Public/Theme1/css/style.min.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>数据库信息</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                            
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="dropdown hidden-xs">编号</th>
                                    <th class="dropdown hidden-xs">文件名</th>
                                    <th>备份时间</th>
                                    <th >文件大小</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($lists)): foreach($lists as $key=>$row): if($key > 1): ?><tr>
                                    <td class="dropdown hidden-xs"><?php echo ($key-1); ?></td>
                                    <td class="dropdown hidden-xs"><a href="<?php echo U('Bak/index',array('Action'=>'download','file'=>$row));?>"><?php echo ($row); ?></a></td>
                                    <td ><?php echo (getfiletime($row,$datadir)); ?></td>
                                    <td ><?php echo (getfilesize($row,$datadir)); ?></td>
                                    <td><a href="<?php echo U('Bak/index',array('Action'=>'download','file'=>$row));?>">下载</a>
                    <a onclick="return confirm('确定将数据库还原到当前备份吗？')"href="<?php echo U('Bak/index',array('Action'=>'RL','File'=>$row));?>">还原</a>
                    <a onclick="return confirm('确定删除该备份文件吗？')"href="<?php echo U('Bak/index',array('Action'=>'Del','File'=>$row));?>">删除</a></td>
                                </tr><?php endif; endforeach; endif; ?>
                            <tr>  
                                <td colspan="5">   
                                
                                <button class="btn btn-primary" type="submit" onClick="location.href = '/lianxi1/azqrsg/Personnelsystem/Bak/index/Action/backup'">备份数据库</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/content.min.js?v=1.0.0"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/lianxi1/azqrsg/Public/Theme1/js/demo/peity-demo.min.js"></script>
    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
</body>

</html>