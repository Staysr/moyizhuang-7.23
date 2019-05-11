<?php
	$vid = (int)$_GET['vid'];
	header("Location: play.php?vid={$vid}&playgroup=1&index=0");
?>