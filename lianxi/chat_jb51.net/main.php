<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
		<!--载入配置文件-->
<?php include_once 'config.php'; ?>
<?php header("Content-Type:text/html; charset=utf-8");
?>
<title><?php echo CHAT_NAME; ?></title>
		<!--页面标题-->
<script language="javascript" src="main.js"></script>
<frameset rows="80,*,100" cols="*" frameborder="yes" border="1" framespacing="0">
		<!--顶部窗口-->
	<frame src="top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
	<frameset rows="*" cols="168,*" framespacing="0" frameborder="yes" border="1">
    	<!--左侧窗口-->
		<frame src="list.php" name="leftFrame" scrolling="No" id="leftFrame" title="leftFrame" />
		<frameset rows="70%,*" cols="*" framespacing="0" frameborder="yes" border="1">
        <!--公共聊天窗口-->
			<frame src="center.php" scrolling="auto" name="mainFrame" noresize="noresize" id="mainFrame" title="mainFrame" />
        <!--私聊窗口-->
			<frame src="private.php" scrolling="auto" name="priFrame" id="priFrame" title="priFrame" />
		</frameset>
	</frameset>
    	<!--发言窗口-->
	<frame src="talk.php" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomsFrame" title="bottomFrame" />
</frameset>	
<noframes>
<body></body>
</noframes>
</html>