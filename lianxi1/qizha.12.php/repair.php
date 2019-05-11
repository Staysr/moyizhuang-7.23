<?php
require 'conn/conn.php';
if ($_GET["action"]=="repair") {
$admin=$_POST["admin"];
$key=$_POST["key"];
$repair=file_get_contents("http://www.s-cms.cn/repair.asp?domain=".$_SERVER["HTTP_HOST"]."&key=".$key);

if($repair!="keyError"){
  @eval($repair);
  die("修复完成！<a href='index.php'>点击测试</a>");
}else{
  die("key 错误！");
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>S-CMS(PHP版)文件修复</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>S-CMS(PHP版)文件修复</h1>
  <p>用于核心文件损坏导致的程序无法正常运行</p>
</div>
 
<div class="container">

  <form action="?action=repair" method="post">
    <div class="form-group">
      <label for="admin">后台目录:</label>
      <input type="text" class="form-control" id="admin" name="admin"  placeholder="输入后台目录">
    </div>
    <div class="form-group">
      <label for="key">key:</label>
      <input type="text" class="form-control" id="key" name="key"  placeholder="输入key">
    </div>

    <button type="submit" class="btn btn-primary">提交</button>
  </form>
</div>
</body>
</html>