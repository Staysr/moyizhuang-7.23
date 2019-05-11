<?php
if(!defined('VER'))exit('非法访问!');
$title = "上传图片";
require_once(PATH.'Home/header.php');
if ($_POST['do'] == 'do'){
$types=array(  
    'image/jpg',  
    'image/jpeg',  
    'image/png',  
    'image/gif',
);
$dir = './Photo/'.$userrow['user'].'/';
$file = $_FILES["file"];
$uid = $userrow['uid'];
$date = date("Y-m-d H:i:s");
$title = $_POST['title'];
if (!$file['name']){
	msg('请先选择图片!');
}
if ($title == ''){
	$title = '图片';
}
if(!file_exists($dir)){  
	mkdir($dir);  
}  
if (!in_array($file['type'],$types)){
	msg('文件类型不符合要求');
}
$info=pathinfo($file['name']);  
$type=$info['extension'];
$src = $dir.time().'.'.$type;
move_uploaded_file($file['tmp_name'],
$src);
$sql = "INSERT INTO ". $Mysql['prefix'] ."photo(`uid`, `title`, `src`, `date`) VALUES ('{$uid}','{$title}','{$src}','{$date}')";
if ($db->query($sql)){
	msg('上传成功','index.php?mod=upphoto');
}else{
	msg('上传失败');
}
}
?>
<!-- 主页面 Start-->
	
<div class="row">
<div class="col-sm-12">
<section class="panel">
<div style="height:50px;line-height:50px;text-align:center;background-color:#1C86EE;color:#fff;border-radius:5px 5px 0px 0px">
<span style="font-size:18px"><i class="icon-plus"></i> 上传图片</span>
</div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data" class="form-horizontal tasi-form"> 
<input type="hidden" name="do" value="do"> 
<div class="form-group">
<label class="col-sm-2 control-label">选择图片:</label>
<div class="col-sm-10">
<input name="file" type="file">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">图片标题:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="title" placeholder="图片标题(可选)">
</div>
</div>
<p>只能上传格式为.jpg .png .jpeg .gif的文件</p>
<div style="text-align:right">
<input class="btn btn-primary" type="submit" value="提交上传">
</div>
</form>
</section>
</div>
</div>
	
<!-- 主页面 End -->
<?php
require_once(PATH.'Home/footer.php');
?>