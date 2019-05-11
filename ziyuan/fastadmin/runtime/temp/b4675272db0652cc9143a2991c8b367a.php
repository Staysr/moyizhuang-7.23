<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:99:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/public/../application/admin/view/version/edit.html";i:1556524572;s:91:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/layout/default.html";i:1547349022;s:88:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/common/meta.html";i:1547349022;s:90:"/Applications/MAMP/htdocs/18031/ziyuan/fastadmin/application/admin/view/common/script.html";i:1547349022;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal form-ajax" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label for="c-oldversion" class="control-label col-xs-12 col-sm-2"><?php echo __('Oldversion'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-oldversion" class="form-control" name="row[oldversion]" type="text" value="<?php echo $row['oldversion']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-newversion" class="control-label col-xs-12 col-sm-2"><?php echo __('Newversion'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-newversion" class="form-control" name="row[newversion]" type="text" value="<?php echo $row['newversion']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-packagesize" class="control-label col-xs-12 col-sm-2"><?php echo __('Packagesize'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-packagesize" class="form-control" name="row[packagesize]" type="text" value="<?php echo $row['packagesize']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-content" class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-content" class="form-control" name="row[content]"><?php echo $row['content']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-downloadurl" class="control-label col-xs-12 col-sm-2"><?php echo __('Downloadurl'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-downloadurl" class="form-control" name="row[downloadurl]" type="text" value="<?php echo $row['downloadurl']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-enforce" class="control-label col-xs-12 col-sm-2"><?php echo __('Enforce'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_radios('row[enforce]', [1=>__('Yes'), 0=>__('No')], $row['enforce']); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="c-weigh" class="control-label col-xs-12 col-sm-2"><?php echo __('Weigh'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-weigh" class="form-control" name="row[weigh]" type="number" value="<?php echo $row['weigh']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-status" class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_radios('row[status]', ['normal'=>__('Normal'), 'hidden'=>__('Hidden')], $row['status']); ?>
        </div>
    </div>
    <div class="form-group hide layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/ziyuan/fastadmin/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/ziyuan/fastadmin/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>