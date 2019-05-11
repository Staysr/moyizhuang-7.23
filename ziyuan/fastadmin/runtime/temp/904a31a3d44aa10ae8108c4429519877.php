<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:111:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/public/../application/admin/view/example/multitable/index.html";i:1556524046;s:91:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/layout/default.html";i:1547349022;s:88:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/common/meta.html";i:1547349022;s:90:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/common/script.html";i:1547349022;}*/ ?>
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
                                <div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <div class="panel-lead"><em>多表格（Multitable）</em>用于展示在一个页面展示多个表格数据,并且每次切换时刷新</div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#first" data-toggle="tab">表格1</a></li>
            <li><a href="#second" data-toggle="tab">表格2</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="first">
                <div id="toolbar1" class="toolbar">
                    <?php echo build_toolbar('refresh'); ?>
                </div>
                <table id="table1" class="table table-striped table-bordered table-hover" width="100%">
                </table>
            </div>
            <div class="tab-pane fade" id="second">
                <div id="toolbar2" class="toolbar">
                    <?php echo build_toolbar('refresh'); ?>
                </div>
                <table id="table2" class="table table-striped table-bordered table-hover" width="100%">
                </table>
            </div>
        </div>
    </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/ziyuan/fastadmin/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/ziyuan/fastadmin/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>