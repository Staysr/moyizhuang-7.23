<?php
require_once('Common/common.php');
if($config['player'] == 1){
?>
<!-- Your XlchPlayerKey -->
<script>XlchKey="<?=$config['playerkey']?>";</script>
<!-- font-awesome 4.2.0 -->
<link href="http://lib.baomitu.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- JQuery-mousewheel 3.1.9 -->
<script src="http://lib.baomitu.com/jquery-mousewheel/3.1.9/jquery.mousewheel.min.js"></script>
<!-- Scrollbar -->
<script src="http://static.badapple.top/BadApplePlayer/js/scrollbar.js"></script>
<!-- BadApplePlayer -->
<script src="http://static.badapple.top/BadApplePlayer/Player.js"></script>
<?php
}else{
?>
<link rel="stylesheet" href="Assets/Player/style.css" type="text/css"/>
<script src="Assets/Player/Player.js"></script>
<div class="txl-music">
	<div class="icon">></div>
	<div class="music">
			<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=100% height=110 src="http://music.163.com/outchain/player?type=0&id=<?=$config['playerkey']?>&auto=1&height=90"></iframe>
	</div>
</div>
<?php
}
?>