<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:113:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/public/../application/admin/view/example/customsearch/index.html";i:1556524046;s:91:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/layout/default.html";i:1547349022;s:88:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/common/meta.html";i:1547349022;s:90:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/common/script.html";i:1547349022;}*/ ?>
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
    <?php echo build_heading(); ?>

    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <?php echo build_toolbar('refresh'); ?>
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover" width="100%">

                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<script id="customformtpl" type="text/html">
    <!--form表单必须添加form-commsearch这个类-->
    <form action="" class="form-commonsearch">
        <div style="border-radius:2px;margin-bottom:10px;background:#f5f5f5;padding:20px;">
            <h4>自定义搜索表单</h4>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">ID</label>
                        <!--显式的operate操作符-->
                        <div class="input-group">
                            <div class="input-group-btn">
                                <select class="form-control operate" data-name="id" style="width:auto;">
                                    <option value="=" selected>等于</option>
                                    <option value=">">大于</option>
                                    <option value="<">小于</option>
                                </select>
                            </div>
                            <input class="form-control" type="text" name="id" placeholder="" value=""/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">标题</label>
                        <!--隐式的operate操作符，必须携带一个class为operate隐藏的文本框,且它的data-name="字段",值为操作符-->
                        <input class="operate" type="hidden" data-name="title" value="="/>
                        <input class="form-control" type="text" name="title" placeholder="请输入查找的标题" value=""/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">管理员ID</label>
                        <div class="row" data-toggle="cxselect" data-selects="group,admin">
                            <div class="col-xs-6">
                                <select class="group form-control" name="group"
                                        data-url="example/bootstraptable/cxselect?type=group"></select>
                            </div>
                            <div class="col-xs-6">
                                <select class="admin form-control" name="admin_id"
                                        data-url="example/bootstraptable/cxselect?type=admin"
                                        data-query-name="group_id"></select>
                            </div>
                            <input type="hidden" class="operate" data-name="admin_id" value="="/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">用户名</label>
                        <input type="hidden" class="operate" data-name="username" value="="/>
                        <input id="c-category_id" data-source="auth/admin/index" data-primary-key="username"
                               data-field="username" class="form-control selectpage" name="username" type="text"
                               value="">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3" style="min-height:68px;">
                    <!--这里添加68px是为了避免刷新时出现元素错位闪屏-->
                    <div class="form-group">
                        <label class="control-label">IP</label>
                        <input type="hidden" class="operate" data-name="ip" value="in"/>
                        <!--给select一个固定的高度-->
                        <select id="c-flag" class="form-control selectpicker" multiple name="ip" style="height:31px;">
                            <?php if(is_array($ipList) || $ipList instanceof \think\Collection || $ipList instanceof \think\Paginator): if( count($ipList)==0 ) : echo "" ;else: foreach($ipList as $key=>$vo): ?>
                            <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">IP</label>
                        <input type="hidden" class="operate" data-name="createtime" value="RANGE"/>
                        <input type="text" class="form-control datetimerange" name="createtime" value=""/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="submit" class="btn btn-success btn-block" value="提交"/>
                            </div>
                            <div class="col-xs-6">
                                <input type="reset" class="btn btn-primary btn-block" value="重置"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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