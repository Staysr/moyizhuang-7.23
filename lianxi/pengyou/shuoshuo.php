<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>记录时刻</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="style/reset.css">
<link rel="stylesheet" href="style/yiqi.css">
<link rel="stylesheet" href="style/main.css">
	<?php
	require_once('./conn/function.php');
	session_start();
	@$user=$_SESSION['pengyou_user'];
	if(empty($user)){
		tishi(1,"未登录账号不允许发布",2000,"index.php");
		die();
	}
	
?>
</head>
<script type="text/javascript" src="js/jQuery.min.js"></script>
<script type="text/javascript" src="js/yiqi.js"></script>
<body>
	<form action="pic.php" method="post" enctype="multipart/form-data">
	<div id='box'>
		<div id='dingwei'>
			<div class="pengyou-ss-head">
				<div class="pengyou-ss-head-left"><span onClick="Dqopen('index.php');">取消</span></div>
				<div class="pengyou-ss-head-right"><input type="submit" value="发布"></div>
			</div>
			<div class="pengyou-ss-dingwei">
				<div class="pengyou-ss-font">
					<textarea placeholder="这一刻的想法...." maxlength="1000" id ="pengyou-wz-nr" name="pengyou-wz-nr"></textarea>
				</div>
				<div class="pengyou-upload-insert">
				
						<div id="picInput">
							<div class="pengyou_upload_input" id="pengyou_upload_input" dqtj='1'>
								<img id="img_preview1" style="" onClick="uploadbut(1)" src="images/icon/insertimg.png">
								<img id="img_preview2" style=" display: none;" onClick="uploadbut(2)" src="images/icon/insertimg.png">
								<img id="img_preview3" style="display: none;" onClick="uploadbut(3)" src="images/icon/insertimg.png">
								<img id="img_preview4" style="display: none;" onClick="uploadbut(4)" src="images/icon/insertimg.png">
								<img id="img_preview5" style="display: none;" onClick="uploadbut(5)" src="images/icon/insertimg.png">
								<img id="img_preview6" style="display: none;" onClick="uploadbut(6)" src="images/icon/insertimg.png" >
								<img id="img_preview7" style="display: none;" onClick="uploadbut(7)" src="images/icon/insertimg.png" >
								<img id="img_preview8" style="display: none;" onClick="uploadbut(8)" src="images/icon/insertimg.png" >
								<img id="img_preview9" style="display: none;" onClick="uploadbut(9)" src="images/icon/insertimg.png" >
							</div>
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg1">
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg2">
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg3">
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg4">
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg5">
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg6">
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg7">
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg8">
							<input type="file" name='myfile[]' class="pengyou_upload_input_but" style='display:none' id="tjimg9">
							
						</div>
						
				
				</div>
			</div>
		</div>
	</div>
			</form>
</body>
	<script type="text/javascript">
			var z = 1;
			var tjbutid=$("#pengyou_upload_input").attr('dqtj'),
					butid=parseInt(tjbutid)+1;
			var uploadbut = function(id){
				$("#tjimg"+id).click();
			}
	</script>
	<script type="text/javascript" src="js/imgFileupload.js"></script>
</html>