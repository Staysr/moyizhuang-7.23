<?php
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo $title ?></title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<?php if($islogin2==1){
if($userrow['status']==0){
	sysmsg('你的账号已被封禁！',true);exit;
}elseif($userrow['power']>0 && $conf['fenzhan_expiry']>0 && $userrow['endtime']<$date){
	//sysmsg('你的账号已到期，请联系管理员续费！',true);exit;
}
if($userrow['lasttime']==null){
	$DB->query("update shua_site set lasttime='$date' where zid='{$userrow['zid']}'");
}
?>
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">自助下单系统管理中心</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="<?php echo checkIfActive('index,')?>">
            <a href="./"><span class="glyphicon glyphicon-user"></span> 平台首页</a>
          </li>
		  <li>
            <a href="../"><span class="glyphicon glyphicon-shopping-cart"></span> 自助下单</a>
          </li>
		  <li class="<?php echo checkIfActive('workorder')?>">
            <a href="./workorder.php"><span class="glyphicon glyphicon-check"></span> 我的工单</a>
          </li>
		  <?php if($userrow['power']>0){?>
		  <li class="<?php echo checkIfActive('shoplist')?>">
            <a href="./shoplist.php"><span class="glyphicon glyphicon-globe"></span> 商品管理</a>
          </li>
		  <?php if($userrow['power']==2){?>
		  <li class="<?php echo checkIfActive('sitelist')?>">
            <a href="./sitelist.php"><span class="glyphicon glyphicon-th"></span> 分站管理</a>
          </li>
		  <?php }?>
		  <li class="<?php echo checkIfActive('list,record,rank')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"></span> 数据查看<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./list.php">订单查询</a></li>
			  <li><a href="./record.php">收支明细</a></li>
			  <li><a href="./rank.php">分站排行</a></li>
            </ul>
          </li>
		  <li class="<?php echo checkIfActive('uset')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> 系统设置<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./uset.php?mod=user">用户资料设置</a></li>
			  <li><a href="./uset.php?mod=site">网站信息设置</a></li>
			  <li><a href="./uset.php?mod=logo">网站Logo上传</a></li>
            </ul>
          </li>
		   <?php }?>
          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-log-out"></span> 退出登陆</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
<?php }?>