﻿<?php 
require '../conn/conn2.php';
require '../conn/function.php';

$sql="Select * from SL_slide order by S_id desc limit 1";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
    if ($C_memberbg=="" || is_null($C_memberbg)){
    $S_pic=$row["S_pic"];
}else{
$S_pic=$C_memberbg;
}
    }
    $id=floor($_REQUEST["id"]);

$_SESSION["from"]=$C_dir."bbs/list.php?id=".$id;
$sql="Select * from SL_bsort where S_id=".$id;

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
    $S_title=lang($row["S_title"]);
    $S_content=lang($row["S_content"]);
    $S_picx=$row["S_pic"];
    $S_lv=$row["S_lv"];
    $S_sh=$row["S_sh"];
}

if($S_lv>0){
$S_fen=getrs("select * from SL_lv where L_id=".$S_lv,"L_fen");
$L_title=getrs("select * from SL_lv where L_id=".$S_lv,"L_title");
if($_SESSION["M_id"]==""){
box("该板块需要登录会员后浏览！",$C_dir."member","error");
}else{
if(getrs("select * from SL_member where M_id=".$_SESSION["M_id"],"M_fen")-$S_fen<0){
box("本板块浏览等级限制为“".$L_title."”，请先升级！",$C_dir."member/member_role.php","error");
}
}
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo lang($C_description)?>">
    <meta name="author" content="s-cms">
    <title><?php echo $S_title?> - <?php echo lang($C_webtitle)?></title>
    <link href="<?php echo $C_dir.$C_ico?>" rel="shortcut icon" />
    <link href="../member/css/bootstrap.css" rel="stylesheet">
    <link href="../css/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../member/css/style.css" rel="stylesheet" type="text/css">
    <script src="../member/js/jquery.min.js"></script>
    <script src="../member/js/bootstrap.min.js"></script>
    <style type="text/css">  
    .navbar .nav > li .dropdown-menu {  
        margin: 0;  
    }  
    .navbar .nav > li:hover .dropdown-menu {  
        display: block;  
    }  
    .search_pic{padding:5px;border:#CCCCCC solid 1px;width:100%;max-width:150px;min-width:100px;}
    table{width: 100%;}
    .search_area{background: #FFFFFF;margin: 100px 0 70px 0;border:2px #EEEEEE solid; border-radius: 10px;padding: 20px;font-size: 14px;}
    .search_area .list{padding: 10px;}
    .search_area td{padding: 10px;}
    .bg1{position:fixed; z-index:-1;filter: blur(5px);background-image:url(../<?php echo $S_pic?>);background-repeat: no-repeat;background-position:center center;width:100%;height:100%;background-size: cover;}
    .bg2{position:fixed; z-index:-2;background-image:url(../<?php echo $S_pic?>);background-repeat: no-repeat;background-position:center center;width:100%;height:100%;background-size: cover;}
</style>  
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top s_top" role="navigation">
    <div class="s_head" style="padding-top:4px;">
    <div class="container">
    <div class="pull-left">
    <span style="font-size: 12px;"><?php echo lang($C_webtitle)?></span>
    </div>
    <div class="pull-right">
    <?php if ($_SESSION["M_login"]==""){?>
    <a href="../member/member_reg.php"><?php echo lang("注册/l/Sign Up")?></a> <a href="../member/member_login.php"><?php echo lang("登录/l/Sign In")?></a>
    <?php }else{?>
    <a href="../member"><?php echo $_SESSION["M_login"]?></a> <a href="../member/member_login.php?action=unlogin"><?php echo lang("退出/l/Sign Out")?></a>
    <?php }?>
    </div>
    </div>
    </div>
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="../"><img src="../<?php echo $C_logo?>" height="60"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav navbar-right">

<?php 

$sql="select * from SL_menu where U_sub=0 and U_hide=0 order by U_order,U_id desc";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    echo "<li ><a href=\"../?type=".$row["U_type"]."&S_id=".$row["U_typeid"]."\" >".lang($row["U_title"])." </a>";
    $sql2="select * from SL_menu where U_sub=".$row["U_id"]." and U_hide=0 order by U_order,U_id desc";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
    echo "<ul class=\"dropdown-menu\">";
    while($row2 = mysqli_fetch_assoc($result2)) {
    echo "<li><a href=\"../?type=".$row2["U_type"]."&S_id=".$row2["U_typeid"]."\">".lang($row2["U_title"])."</a></li>";
       }
    echo "</ul>";
}
echo "</li>";
        }
}
?> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<nav class="navbar navbar-inverse navbar-fixed-bottom s_top" role="navigation">
    
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <p style="margin:20px 0 0 10px; "><?php echo lang($C_foot).$C_code?></p>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header Carousel -->
<div style="height: 100%;position: relative;">
<div class="bg1"></div>
<div class="bg2"></div>

    <!-- Page Content -->
<div class="container" style="z-index: 9999">
<div class="search_area">

<div class="row">
    <div class="col-md-3" style="height: 100%">
        <div style="background: #f7f7f7;text-align: center;padding: 10px;height: 100%">
            <div style="font-weight: bold;margin: 20px;"><?php echo $S_title?></div>
            <img src="../<?php echo $S_picx?>" style="width:120px;height:120px;border-radius:10px; ">
            <p style="margin: 10px;"><?php echo $S_content?></p>
            <div><a href="bbs.php?S_id=<?php echo $id?>" class="btn btn-primary">发帖</a> <a href="index.php" class="btn btn-info">返回首页</a></div>
        </div>
    </div>
    <div class="col-md-9">
<div class="list-group">
<a href="item.php?id=9" class="list-group-item active" style="height:55px;"> <span style="font-weight:bold">帖子</span><span style="float:right;font-size:12px;">作者<br>时间</span></a>

<?php 
if ($S_sh==0){
$sql="select * from SL_bbs where B_sort=".$id." and B_sub=0 order by B_id desc";
}else{
$sql="select * from SL_bbs where B_sort=".$id." and B_sub=0 and B_sh=1 order by B_id desc";
}


$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
echo "<a href=\"item.php?id=".$row["B_id"]."\" class=\"list-group-item\" style=\"height:55px;\"><span style=\"color:#AAAAAA;\">[".$S_title."]</span> <span style=\"font-weight:bold\">".lang($row["B_title"])."</span><span style=\"float:right;font-size:12px;\">".getrs("select * from SL_member where M_id=".$row["B_mid"],"M_login")."<br>".$row["B_time"]."</span></a>";
}
}
?>

</div>
    </div>
</div>
</div>
    </div>
    </div>
    <!-- /.container -->
</body>
</html>