<!DOCTYPE HTML>
<html>
<head>
<?php  include 'head.php';?>
<title>留言求片,留言板-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="留言板,留言求片">
<meta name="description" content="留言求片:把你想看的大片留言给我们。我们会争取第一时间更新上！">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
<style>
.clears{ clear:both;}
/*messages*/
.messages{padding:15px 0;}
.messages input,.messages select,.messages textarea{margin:0;padding:0; background:none; border:0; font-family:"Microsoft Yahei";}
.messlist {height:30px;margin-bottom:10px;}
.messlist label{float:left;width:100px; height:30px; font-size:14px; line-height:30px; text-align:right;padding-right:10px;}
.messlist input{float:left;width:300px;height:28px;padding-left:5px;border:#ccc 1px solid;}
.messlist.textareas{ height:auto;width:auto;}
.messlist textarea{float:left;width:300px; height:110px;padding:5px;border:#ccc 1px solid;}
.messlist.yzms input{width:100px;}
.messlist.yzms .yzmimg{ float:left;margin-left:10px;}
.messsub{padding:0px 0 0 110px;}
.messsub input{width:100px; height:35px; background:#ddd; font-size:14px; font-weight:bold; cursor:pointer;margin-right:5px}
.messsub input:hover{ background:#f60;color:#fff;}
#label0{display:none;color:#0aa770;height:28px;line-height:28px;}
#label1{display:none;color:#0aa770;height:28px;line-height:28px;}
#label2{display:none;color:#0aa770;height:28px;line-height:28px;}
#label3{display:none;color:#0aa770;height:28px;line-height:28px;}
#label4{display:none;color:#0aa770;height:28px;line-height:28px;}
#label5{display:none;color:#0aa770;height:28px;line-height:28px;}
#label6{display:none;color:#0aa770;height:28px;line-height:28px;}
#label7{display:none;color:#0aa770;height:28px;line-height:28px;}
#label8{display:none;color:#0aa770;height:48px;line-height:48px;}
#label9{display:none;color:#0aa770;height:48px;line-height:48px;}
#label10{display:none;color:#0aa770;height:48px;line-height:48px;}
</style>
</head>
<body class="vod-type apptop">
<?php include 'header.php'; ?>
<div class="container">
	<div class="row">
<div style="margin-top:20px;"></div>
		</div>
		<div class="hy-layout clearfix" style="margin-top: 0;">
			<div class="hy-switch-tabs active clearfix">
				<span class="text-muted pull-right hidden-xs">留言求片:把你想看的大片留言给我们。我们会争取第一时间更新上！</span>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#">留言版</a></li>
				</ul>
			</div>
			<div class="hy-video-list">
				<div class="item">
<div class="mail">
 
<div class="send">
<div class="sendbox">
<form method="post" class="messages">
     <div class="messlist">
      <label>姓名</label>
      <input type="text" placeholder="姓名" id="input1" onblur="jieshou()" name="userid">
<div id ="label0">*你还没填写名字呢!</div>
<div id ="label1">√正确</div>
<div id ="label2">×错误</div>
      <div class="clears"></div>
     </div>

     <div class="messlist textareas">
      <label>留言内容</label>
      <textarea placeholder="说点什么吧..." id="input4" onblur="content()" name="content"></textarea>
<div id ="label8">√</div>
<div id ="label9">×</div>
<div id ="label10">* 必填</div>
      <div class="clears"></div>
     </div>

     <div class="messsub">
      <input type="submit" value="提交" name="submit" style="background:#00a3eb;color:#fff;" />
      <input type="reset" value="重填" />
     </div>
</form>	 

<script>
function jieshou(){
var label1 = document.getElementById("label1");
var label2 = document.getElementById("label2");
var nametext = document.getElementById("input1").value;
if(nametext!=""){
label0.style.display = 'none';
label1.style.display = 'block';
label2.style.display = 'none';
}
else{
label0.style.display = 'block';
label1.style.display = 'none';
label2.style.display = 'none';
}
 
}
</script>


<script>
function content(){
var content = document.getElementById("input4").value;
if(content!=""){ 
        label8.style.display = 'block'; 
        label9.style.display = 'none'; 
        label10.style.display = 'none'; //*必填
        return false;
    } 
else{
        label8.style.display = 'none'; 
        label9.style.display = 'none'; 
        label10.style.display = 'block';  
}

}

</script>
</div>
  </div>
</div>
				</div>
			</div>
		</div>
	</div>

<?php include 'footer.php'; ?>