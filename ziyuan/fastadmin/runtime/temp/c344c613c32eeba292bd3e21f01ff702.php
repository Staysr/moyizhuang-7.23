<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:105:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/public/../application/admin/view/general/logs/index.html";i:1556524614;s:91:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/layout/default.html";i:1547349022;s:88:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/common/meta.html";i:1547349022;s:90:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/common/script.html";i:1547349022;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/ziyuan/fastadmin/public/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/ziyuan/fastadmin/public/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/ziyuan/fastadmin/public/assets/js/html5shiv.js"></script>
  <script src="/ziyuan/fastadmin/public/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <style>
    #treeview .jstree-leaf > .jstree-icon, #treeview .jstree-leaf .jstree-themeicon {
        display: inline-block;
    }

    #treeview .jstree-themeicon {
        display: inline-block;
    }
</style>
<div class="row animated fadeInRight">
    <div class="col-md-3" id="left-content">
        <div class="box box-success">
            <div class="panel-heading">
                目录
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-8">
                    <span class="text-muted"><input type="checkbox" name="" id="expandall"/> <label for="expandall"><small>展开全部</small></label></span>

                    <div id="treeview"></div>
                </div>
            </div>
        </div>

        <div class="box box-info">
            <div class="panel-heading">
                信息
            </div>
            <div class="panel-body">
                <h4>Size: <small id="info-size">Null</small></h4>
                <h4>Update Time: <small id="info-update_time">Null</small></h4>
            </div>
        </div>
    </div>

    <div class="col-md-9 col-xs-12" id="right-content">
        <div class="panel panel-default panel-intro panel-nav">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-list"></i>列表</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="one">
                        <div class="widget-body no-padding">
                            <div id="toolbar" class="toolbar">
                                <?php echo build_toolbar('refresh,del'); ?>

                                <a href="javascript:;" class="btn btn-default btn-channel hidden-xs hidden-sm"><i class="fa fa-bars"></i></a>
                            </div>
                            <table id="table" class="table table-striped table-bordered table-hover" width="100%"
                                   data-operate-detail="<?php echo $auth->check('general/logs/detail'); ?>",
                                   data-operate-del="<?php echo $auth->check('general/logs/del'); ?>"
                            >

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    /**
    var nodeData = [
        {
            "id": "a",
            "text": "111",
            "type": "folder",
            "children": [
                {
                    "id": "a/b",
                    "text": "222",
                    "type": "folder",
                    "children": [
                        {
                            "id": "a/b/c.text",
                            "text": "text",
                            "type": 'file',
                            "state": {
                                "selected": true
                            },
                        }
                    ]
                }
                , {
                    "id": "c",
                    "text": "333",
                    "type": "file",
                }
            ]
        }
    ];
    **/
    var nodeData = <?php echo json_encode($directory);; ?>;
</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/ziyuan/fastadmin/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/ziyuan/fastadmin/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>