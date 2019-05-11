<?php include('../system/inc.php');

$q=$_POST['wd'];
$seach=file_get_contents('https://so.360kan.com/index.php?kw='.$q);
$szz='#js-playicon" title="(.*?)"\s*data-logger#';
$szz1='#a href="(.*?)" class="g-playicon js-playicon"#';
$szz2='#<img src="(.*?)" alt="(.*?)" \/>[\s\S]+?</a>\n</div>#';
$szz3='#(<b>(.*?)</b><span>(.*?)</span></li></ul>)?<ul class="index-(.*?)-ul g-clear">(\n\s*)?<li>(\n\s*)?<b>类型：</b>(\n\s*)?<span>(.*?)</span>#';
$szz4='#<b>类型：</b>[\s\S]*?</li>#';
$szz5='#<b>地区：</b>[\s\S]*?</li>#';
$szz6='#<div class="cont">[\s\S]*?<h3 class="title">#';//评分
$szz7='#<b>导演：</b>(.*?)</li>#';//导演
$szz8='#data-desc=\'[\s\S]+?\'>#';//简介
$mxss='#<li data-logger=(.*?) class=\'w-mfigure\'><a class=\'w-mfigure-imglink g-playicon js-playicon\' href=\'(.*?)\'> <img src=\'(.*?)\' data-src=\'(.*?)\' alt=\'(.*?)\'  /><span class=\'w-mfigure-hintbg\'>(.*?)</span><span class=\'w-mfigure-hint\'>(.*?)</span></a><h4><a class=\'w-mfigure-title\' href=\'(.*?)\'>(.*?)</a></h4></li>#';//模糊搜索结果
preg_match_all($szz,$seach,$sarr);
preg_match_all($szz8,$seach,$sarr8);
preg_match_all($szz1,$seach,$sarr1);
preg_match_all($szz2,$seach,$sarr2);
preg_match_all($szz3,$seach,$sarr3);
preg_match_all($szz4,$seach,$sarr4);
preg_match_all($szz5,$seach,$sarr5);
preg_match_all($szz6,$seach,$sarr6);
preg_match_all($szz7,$seach,$sarr7);
preg_match_all($mxss,$seach,$sarr8);
$one=$sarr[1];//标题
$two=$sarr2[1];//图片
$three=$sarr3[3];//集数
$si=$sarr4[0];//类型
$wu=$sarr5[0];//年代
$liu=$sarr6[0];//评分
$qi=$sarr7[1];//导演
$ba=$sarr8[0];//简介
$nine =$sarr1[1];
$mingxing =$sarr8[2];
$mingxing1 =$sarr8[4];
$mingxing2 =$sarr8[5];
$mingxing3 =$sarr8[6];
?>
<!DOCTYPE html>
<html>
<head lang="en">
<?php  include 'head.php';?>
<title>搜索<?php echo $q?>-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $q?>,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $mkcms_description;?>">

</head>

<body class="vod-search">
<?php  include 'header.php';?>

<section class="tuijian_box">

  <div class="dianying_box bgfff clearfix content">
    <ul class="clearfix">
	<?php 

	$result = mysql_query('select * from mkcms_vod where d_name like "%'.$q.'%" order by d_id desc');
		while ($row = mysql_fetch_array($result))
{
$tupian=$row['d_picture'];
$cs=$row['d_name'];
$jianjie=$row['d_content'];
$cc="./bplay.php?play=";
$dd="./bplay/";
if ($mkcms_wei==1){
$chuandi=$dd.$row['d_id'];
}
else{
$chuandi=$cc.$row['d_id'];	
}	
?>
<li><a href="<?php echo $chuandi?>">
<img src="<?php echo $tupian?>"></a>       
<p class="clearfix leimu"><span class="fl"></span><span class="fr"><?php echo get_channel_name($row['d_parent'])?></span></p>
        <a href="<?php echo $chuandi?>">
		<span class="biaoti"><?php echo $cs?></span></a></li>
<?php } ?> 
<?php 

foreach ($one as $ni=>$cs){ 
$mvsrc1 = str_replace("http://www.360kan.com", "", "$nine[$ni]");
$pingfen = str_replace('<div class="b-tomato"><div class="rating-site yellow"><p class="value">评分：<span>', '', "$liu[$ni]");
$pingfen = str_replace('</span></p></div></div>', '', "$pingfen");
$pingfen = str_replace('    ', '', "$pingfen");
$pingfen = str_replace('<div class="cont">', '', "$pingfen");
$pingfen = str_replace('<h3 class="title">', '', "$pingfen");
$pingfen = str_replace(array("\r\n", "\r", "\n"), '', "$pingfen");
$pingfen = str_replace('<div class="b-tomato"><div class="rating-site red"><p class="value">评分：<span>', '', "$pingfen");
$pingfen = str_replace('<div class="b-tomato"><div class="rating-site green"><p class="value">评分：<span>', '', "$pingfen");
$jianjie= str_replace("data-desc='", '', "$ba[$ni]");
$jianjie= str_replace("'>", '', "$jianjie");
$tupian=$two[$ni];
if ($mkcms_wei==1){
$chuandi='./play.php?play='.$mvsrc1;
}
else{
$chuandi='./play.php?play='.$mvsrc1;	
}//结束
$d_scontent=explode(',',$mkcms_shoufei);
for($i=0;$i<count($d_scontent);$i++)
{
if($cs==$d_scontent[$i]){
//提示错误值
$xianshi='style="display:none"';
     }	

}
?>
<li><a href="<?php echo $chuandi?>">
<img src="<?php echo $tupian?>"></a>        
<p class="clearfix leimu"><span class="fl"></span><span class="fr"><?php echo $three[$ni]?></span></p>
        <a href="<?php echo $chuandi?>">
		<span class="biaoti"><?php echo $cs?></span></a></li>
<?php } ?>
<?php 
foreach ($mingxing as $k=>$mx){ 
$mvsrc1 = str_replace("http://www.360kan.com", "", "$mingxing[$k]");
$tupian=$mingxing1[$k];
$title=$mingxing2[$k];
$jishu=$mingxing3[$k];
if ($mkcms_wei==1){
$chuandi='./play.php?play='.$mvsrc1;
}
else{
$chuandi='./play.php?play='.$mvsrc1;	
}//结束
$d_scontent=explode(',',$mkcms_shoufei);
for($i=0;$i<count($d_scontent);$i++)
{
if($cs==$d_scontent[$i]){
//提示错误值
$xianshi='style="display:none"';
     }	

}
?>
<li><a href="<?php echo $chuandi?>">
<img src="<?php echo $tupian?>"></a>        
<p class="clearfix leimu"><span class="fl"></span><span class="fr"><?php echo $jishu?></span></p>
        <a href="<?php echo $chuandi?>">
		<span class="biaoti"><?php echo $title?></span></a></li>
<?php } ?>
 
    </ul>  
  </div>

</section>


<?php  include 'footer.php';?>
