<?php
include ('./inc/aik.config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cache-control" content="no-siteapp">
<title><?php echo $aik['title'];?></title>
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/index.css' type='text/css' media='all' />
<script type='text/javascript' src='http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js?ver=0.5 
'></script>
<meta name="keywords" content="<?php echo $aik['keywords'];?>">
<meta name="description" content="<?php echo $aik['description'];?>">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body class="home blog">
<?php  include 'header.php';?>
<div class="warp">
<!--<IFRAME name="音乐搜索" width=100% height=1000 frameborder=0 src="music " ></IFRAME >-->
<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=100% height=1000 src="http://music.163.com/outchain/player?type=0&id=19723756&auto=1&height=430"></iframe>
</div>
<?php  include 'footer.php';?>
</body>
</html>
