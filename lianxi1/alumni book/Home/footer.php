</section>
</section>
	<script src="/Assets/jQuery/jquery.js"></script>
	<?php
require_once('Common/common.php');
if($config['player'] != 0){
	require_once('music.php');
}
	?>
    <script src="/Assets/Home/js/bootstrap.min.js"></script>
    <script src="/Assets/Home/js/jquery.scrollTo.min.js"></script>
    <script src="/Assets/Home/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/Assets/Home/js/common-scripts.js"></script>
    <script src="/Assets/Xc/jquery.blueimp-gallery.min.js"></script>  
    <script src="http://cdn.bootcss.com/jquery.pjax/1.9.6/jquery.pjax.js"></script>
<script>
$(document).pjax('a[target!=_blank][pjax!=no][href!=#]', '#main-content',{fragment:'#main-content', timeout:5000});
$(document).on('pjax:send', function() {
    $("#Loading").css("display", "block");
    $("#main-content").css("display", "none");
    $("#head").css("display", "none");
});
$(document).on('pjax:complete', function() {
    setTimeout(function(){
	$("#Loading").css("display", "none");
    $("#main-content").css("display", "block")
	$("#head").css("display", "block");
	},2000);
});
</script>
</body>
</html>
