<?php
	session_start();
	include_once 'config.php';
	include_once 'func.php';
	$user = $_SESSION['user'];
	deluser(PERSON,$user);
	$newline = '[<font color=pink>系统公告</font>]只见 <font color=blue>'.$user.'</font> 抱了抱拳，说道："青山不改，绿水长流，以后再见了。。。"&nbsp;[<font color=brown>'.date('H:i:s').'</font>]';
	addmess(MESS,$newline);
	unlink('priv/'.$user);
	session_destroy();
?>
<script>
window.close();
</script>