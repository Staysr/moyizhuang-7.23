<?php include('../system/inc.php');?>
<head>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>视频解析</title>
</head>

<?
if(strpos($_GET["url"] ,'.mp4')||strpos($_GET["url"] ,'.m3u8')){
	$urls='/jx/index.php?url='.$_GET["url"];
}else{
	$urls = $_GET["url"];
}

?>
<iframe id="iframepage" allowFullScreen=ture marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="<?php echo $urls;?>" height="100%" width="100%"></iframe>
<style type="text/css">
body{
  	margin: 0px;
    padding: 0px;
    background: #000;
}
</style>