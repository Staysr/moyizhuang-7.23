<?php 
require '../conn/conn2.php';
require '../conn/function.php';
require 'auto.php';
require 'member_check.php';
require 'left.php';

$action=$_GET["action"];
$N_id=intval($_GET["N_id"]);
if($N_id!=""){
$aa="edit&N_id=".$N_id;
$sql="Select * from SL_news Where N_id=".$N_id;

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) > 0) {
		$N_title=lang($row["N_title"]);
		$N_view=$row["N_view"];
		$N_content=lang($row["N_content"]);
		$N_short=$row["N_short"];
		$N_pic=$row["N_pic"];
		$N_sort=$row["N_sort"];
		$N_date=$row["N_date"];
		$N_top=$row["N_top"];
		}
		}else{
$aa="add";
$N_date=date('Y-m-d H:i:s');
}
$N_author=$_SESSION["M_login"];
if($action=="add"){
$N_title=htmlspecialchars($_POST["N_title"]);
$N_author=htmlspecialchars($_POST["N_author"]);
$N_date=htmlspecialchars($_POST["N_date"]);
$N_content=$_POST["N_content"];

if(stripos($N_content,"<script")!==false){
	box("不支持加入javascript","back","error");
}

$N_sort=$_POST["N_sort"];
if($_POST["N_short"]==""){
$N_short=mb_substr(strip_tags($N_content),0,200,"utf-8");
}else{
$N_short=$_POST["N_short"];
}
if(substr($N_pic,0,5)=="media"){
$N_pic=$N_pic;
}else{
$N_pic="media/".$N_pic;
}
if($N_view==""){
$N_view=0;
}
if($N_title!="" and $N_content!="" and $N_pic!="" and $N_sort!=""){

mysqli_query($conn, "insert into SL_news(N_title,N_author,N_content,N_short,N_sort,N_date,N_sh,N_pic) values('".lang_add("",$N_title)."','".$_SESSION["M_login"]."','".lang_add("",$N_content)."','".lang_add("",$N_short)."',".$N_sort.",'".$N_date."',2,'media/20151019213836856.jpg')");

box(lang("添加新闻成功!/l/success"),"member_news.php?type=2","success");
die();
}else{
box(lang("请填全信息！/l/Please fill in the information"),"back","error");
die();
}
}
if($action=="edit"){
$N_id=$_REQUEST["N_id"];
$N_title=htmlspecialchars($_POST["N_title"]);
$N_author=htmlspecialchars($_POST["N_author"]);
$N_view=$_POST["N_view"];
$N_date=htmlspecialchars($_POST["N_date"]);
$N_content=$_POST["N_content"];

if(stripos($N_content,"<script")!==false){
	box("不支持加入javascript","back","error");
}

$N_pic=htmlspecialchars($_POST["N_pic"]);
$N_sort=$_POST["N_sort"];
$N_top=$_POST["N_top"];
if($_POST["N_short"]==""){
$N_short=substr(strip_tags($N_content),0,200);
}else{
$N_short=$_POST["N_short"];
}
if(substr($N_pic,0,5)=="media"){
$N_pic=$N_pic;
}else{
$N_pic="media/".$N_pic;
}
if($N_view==""){
$N_view=0;
}
if($N_title!="" && $N_content!="" && $N_sort!=""){

mysqli_query($conn,"update SL_news set 
		N_title='".lang_add(getrs("select * from SL_news where N_id=".$N_id,"N_title"),$N_title)."',
		N_content='".lang_add(getrs("select * from SL_news where N_id=".$N_id,"N_content"),$N_content)."',
		N_short='".lang_add(getrs("select * from SL_news where N_id=".$N_id,"N_short"),$N_short)."',
		N_sort=".$N_sort.",
		N_date='".$N_date."',
		N_sh=2
		where N_id=".$N_id
	);

box(lang("修改新闻成功!/l/success"),"member_news.php?type=2","success");
die();
}else{
box(lang("请填全信息！/l/Please fill in the information"),"back","error");
die();
}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="<?php echo lang("会员中心/l/Member Center")?>">
  <title><?php echo lang("会员中心/l/Member Center")?></title>
<link href="../<?php echo $C_ico?>" rel="shortcut icon" />

  <!-- Stylesheets -->
      <link rel="stylesheet" href="../css/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/site.min.css">
  <!-- css plugins -->
  <link rel="stylesheet" href="css/icheck.min.css">
 
  <!--[if lt IE 9]>
    <script src="http://ec.yto.net.cn/assets/js/plugins/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <link rel="stylesheet" href="http://ec.yto.net.cn/assets/css/ie8.min.css">
    <script src="http://ec.yto.net.cn/assets/js/plugins/respond/respond.min.js"></script>
    <![endif]-->
	<script>
		var _ctxPath='';
	</script>    
</head>

<link rel="stylesheet" href="css/cropper.min.css">
<body id="crop-avatar" class="body-index">
  

<?php require 'top.php';?>

<div class="page">
<div class="container m_top_10">
			<ol class="breadcrumb">
				<li><i class="icon fa-home" aria-hidden="true"></i><a href="../">首页</a></li>
				<li>文章投稿</li>
				<li class="active">
				我要投稿
				</li>
			</ol>
		<div class="yto-box">
		<div class="row">
	 <div class="col-sm-2 hidden-xs">
	 <div class="my-avatar center-block p_bottom_10">
							<span class="avatar"> 
							  
							    
							      <img alt="..." src="<?php echo $M_pic?>"> 
							    
							    
							  
							</span>
	</div>
	<h5 class="text-center p_bottom_10">您好！<?php echo $M_login?></h5>
	     <ul class="nav nav-pills nav-stacked">
		 <li class="active"><a href="member_newsinfo.php">我要投稿</a></li>
	        <li ><a href="member_news.php?type=0">已通过</a></li>
            <li ><a href="member_news.php?type=1">未通过</a></li>
			<li ><a href="member_news.php?type=2">未审核</a></li>
            
	     </ul>
	 </div>
	 <div class="col-sm-10 b-left">
		<p class="alert alert-danger hidden" role="alert" id="error"></p>
<form id="userinfo_save" method="POST" action="?action=<?php echo $aa?>" class="form-horizontal" id="form">
                           
							<div class="form-group">
								<label for="oldpass" class="col-sm-2 control-label"><?php echo lang("新闻标题/l/title")?></label>
								<div class="col-sm-10">
								   <input name="N_title"  value="<?php echo $N_title?>" title="nickname" class="form-control" >
								</div>
							</div>
														<div class="form-group">
								<label for="oldpass" class="col-sm-2 control-label"><?php echo lang("新闻作者/l/author")?></label>
								<div class="col-sm-10">
								   <input maxlength="15" value="<?php echo $N_author?>" title="nickname" class="form-control" readonly >
								   <input name="N_author" value="<?php echo $N_author?>" title="nickname" class="form-control"  type="hidden">
								</div>
							</div>
														<div class="form-group">
								<label for="oldpass" class="col-sm-2 control-label"><?php echo lang("发布时间/l/time")?></label>
								<div class="col-sm-10">
								   <input name="N_date"  value="<?php echo $N_date?>" title="nickname" class="form-control" >
								</div>
							</div>
														<div class="form-group">
								<label for="oldpass" class="col-sm-2 control-label"><?php echo lang("描述文字/l/content")?></label>
								<div class="col-sm-10">
								   <script charset='utf-8' src='../kindeditor/kindeditor.js'></script><script charset='utf-8' src='../kindeditor/lang/zh_CN.js'></script><script>KindEditor.ready(function(K) {K.create('#content', {uploadJson : '../kindeditor/php/upload_json.php', fileManagerJson : '../kindeditor/php/file_manager_json.php',allowFileManager :true,filterMode: false,items:['source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/','formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage','flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak','anchor', 'link', 'unlink', '|', 'about'] });});</script><textarea name='N_content' style='width:100%;height:350px;' id='content'><?php echo $N_content?></textarea>
								</div>
							</div>
														<div class="form-group">
								<label for="oldpass" class="col-sm-2 control-label"><?php echo lang("新闻分类/l/Category")?></label>
								<div class="col-sm-10">
								   <select name="N_sort" class="form-control">
			<?php 
				$sql1="Select S_title,S_id from SL_nsort where not S_sub=0";
				$result1 = mysqli_query($conn,  $sql1);
				if (mysqli_num_rows($result1) > 0) {
				while($row1 = mysqli_fetch_assoc($result1)) {
			?>
				<option value="<?php echo $row1["S_id"]?>" <?php if ($row1["S_id"]-$N_sort=0){ ?>selected="selected"<?php }?>><?php echo lang($row1["S_title"])?></option>
			<?php 

				}
			}

			?>
			  </select>
								</div>
							</div>
														
							<div class="form-group">
								<div class="col-sm-offset-2  col-sm-4">
								   <input type="submit" value="<?php echo lang("确定/l/Edit")?>" class="btn btn-primary btn-block m_top_20" >
								</div>
							</div>
</form>
</div>
</div>
</div>
</div>
</div>


<?php require 'foot.php';?>
  <!-- js plugins  -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/icheck.min.js"></script>
  <script src="js/page.js"></script>
  <script src="js/yto_cityselect.js"></script>
  <script src="js/cropper.min.js"></script>
  <script src="js/cropper-set.js"></script>
  <script src="js/bootstrap-datetimepicker.js"></script>
 <script type="text/javascript">
	  $(function() {
		  'use strict';
		  setTimeout(function(){
	          $("#error:parent").removeClass("hidden");
	          },200);

		  $("#address").citySelect();
		  
		  $('#birthday').datetimepicker({
			    format: 'yyyy-mm-dd',
			    startDate: '1950-01-01',
			    endDate: '2020-12-30',
			    weekStart : 1,
				todayBtn : 1,
				autoclose : 1,
				initialDate:'1985-01-01',
				todayHighlight : 1,
				startView : 4,
				minView : 2,
				fontAwesome:true,
				forceParse : 0,
				linkFormat: 'yyyy-mm-dd',
		        linkField:'birthday_hidden'
			});

	  });
	</script>
	
	

</body>
</html>