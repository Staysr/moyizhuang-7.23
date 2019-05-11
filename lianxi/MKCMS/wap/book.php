<?php include('../system/inc.php');
if(isset($_POST['submit'])){
null_back($_POST['userid'],'请输入姓名');
	null_back($_POST['content'],'请输入内容');
	$data['userid'] = $_POST['userid'];
	$data['content'] =addslashes($_POST['content']);
	$data['time'] =date('y-m-d h:i:s',time());
	
	$str = arrtoinsert($data);
		$sql = 'insert into mkcms_book ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){

alert_href('留言成功!','book.php');
}
else{
alert_back('注册失败');
	}
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  include 'head.php';
$zy='class="active"'?>
<title><留言求片,留言板-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="留言板,留言求片">
<meta name="description" content="留言求片:把你想看的大片留言给我们。我们会争取第一时间更新上！">
<script>
  $(function(){
    TagNav('#tagnav',{
        type: 'scrollToFirst',
    });
    $('.weui_tab').tab({
    defaultIndex: 0,
    activeClass:'weui_bar_item_on',
    onToggle:function(index){
    if(index>0){
    alert(index)
    }
    }
});
});     
</script>
<style type="text/css">
  .leimu_zui{width: auto}
  .weui-navigator-list li{font-weight: 500}
  .weui-navigator-list li.weui-state-hover, .weui-navigator-list li.weui-state-active a:after{background-color: none}
</style>
<style>

.clears{ clear:both;}
/*messages*/
.messages{padding:15px;}
.messages input,.messages select,.messages textarea{margin:0;padding:0; background:none; border:0; font-family:"Microsoft Yahei";}
.messlist {height:80px;margin-bottom:10px;}
.messlist label{height:30px; font-size:14px; line-height:30px; text-align:right;padding-right:10px;}
.messlist input{width:100%; height:28px;padding-left:5px;border:#ccc 1px solid;}
.messlist.textareas{ height:auto;}
.messlist textarea{width:100%; height:110px;padding:5px;border:#ccc 1px solid;}
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
<body>

<?php include 'header.php'; ?>

<div class="page-bd">  
				<span class="text-muted pull-right hidden-xs">留言求片:把你想看的大片留言给我们。我们会争取第一时间更新上！</span>

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

<?php include 'footer.php'; ?>
