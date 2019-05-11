<?php
if(!defined('VER'))exit('非法访问!');
$title = "班级相册";
require_once(PATH.'Home/header.php');
$p = is_numeric($_GET['p']) ? $_GET['p'] : '1';
$pp=$p+7;
$pagesize=15;
$start=($p-1)*$pagesize;
$photos=$db->rs("SELECT * FROM ".$Mysql['prefix']."photo ORDER BY pid DESC LIMIT $start,$pagesize");
$pages=ceil($db->count('SELECT count(*) FROM '.$Mysql['prefix'].'photo')/$pagesize);
if($pp>$pages){
$s = 1;
$pp=$pages;
if($pages > 8){
$s = $pages - $p;
$s = 7 - $s;
$s = $p - $s;
}
}else{
$s = $p;
}
if($p==1){
	$prev=1;
}else{
	$prev=$p-1;
}
if($p==$pages){
	$next=$p;
}else{
	$next=$p+1;
}
?>
<!-- 主页面 Start-->
<style>
	.xctp{
		overflow:hidden;
		float:left;
		width:116px;
		height:146px;
		margin:10px;
		margin-left:12px;
		border-radius:6px;
		border-style: solid;
		border-width:2px;
		border-color:#00A6FA;
	}
	.xctp img{
		max-width:116px;
	}
	.txl li{
		display:inline;
	}
</style>
<div class="row">
<div class="col-sm-12">
<section class="panel">
<div style="height:50px;line-height:50px;text-align:center;background-color:#1C86EE;color:#fff;border-radius:5px 5px 0px 0px">
<span style="font-size:18px"><i class="icon-picture"></i> 班级相册</span><span>-图片点击放大</span>
</div>
<div class="panel-body">
	<div class="lightBoxGallery">
	<div style="padding:10px;text-align:center">
<?php if($photos){foreach($photos as $photo){ ?>
	<div class="xctp">
		<a href="<?=$photo['src']?>"" title="<?=$photo['title']?>" data-gallery="">
		<img src="<?=$photo['src']?>">
		</a>
	</div>
<?php } ?>
<?php }else{ ?>
<div class="inbox-head" style="text-align:center">
<i class="icon-stackexchange" style="font-size:80px"></i><br>
<h3>目前暂无图片,快来上传一张吧!</h3>
</div>
<?php } ?>
	</div>
	<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
	</div>
	</div>
</div>
<div class="col-sm-12" style="text-align:center;">
<div class="btn-group">
<ul class="txl">
<li><a class="btn btn-info" href="?mod=xc&p=1">首页</a></li>
<li><a class="btn btn-info" href="?mod=xc&p=<?=$prev?>">&laquo;</a></li>
<?php for($i=$s;$i<=$pp;$i++){?>
<li><a class="btn btn-info <?php if($i==$p){echo'active';}?>" href="?mod=xc&p=<?=$i?>"><?=$i?></a></li>
<?php }?>
<li><a class="btn btn-info" href="?mod=xc&p=<?=$next?>">&raquo;</a></li>
<li><a class="btn btn-info" href="?mod=xc&p=<?=$pages?>">末页</a></li>
</ul>
</div>
</div>
</section>
</div>
</div>
<!-- 主页面 End -->
<?php
require_once(PATH.'Home/footer.php');
?>