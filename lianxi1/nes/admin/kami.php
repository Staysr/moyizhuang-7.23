<?php

require dirname(__FILE__) . "/dzsck.php";

date_default_timezone_set('PRC'); // 中国时区

include "../conf/pager.class.php";

$CurrentPage = (isset($_GET["page"]) ? $_GET["page"] : 1);





function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){  
    error_reporting(0); 
    include('PHPExcel-1.8/Classes/PHPExcel.php');  
    $obj = new PHPExcel();  
  
    //横向单元格标识  
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');  
      
    $obj->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称  
    $_row = 1;   //设置纵向单元格标识  
    if($title){  
        $_cnt = count($title);  
        $obj->getActiveSheet(0)->mergeCells('A'.$_row.':'.$cellName[$_cnt-1].$_row);   //合并单元格  
        $obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, '数据导出：'.date('Y-m-d H:i:s'));  //设置合并后的单元格内容  
        $_row++;  
        $i = 0;  
        foreach($title AS $v){   //设置列标题  
            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);  
            $i++;  
        }  
        $_row++;  
    }  
  
    //填写数据  
    if($data){  
        $i = 0;  
        foreach($data AS $_v){  
            $j = 0;  
            foreach($_v AS $_cell){  
                $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);  
                $j++;  
            }  
            $i++;  
        }  
    }  
      
    //文件名处理  
    if(!$fileName){  
        $fileName = uniqid(time(),true);  
    }  
  
    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');  
  
    if($isDown){   //网页下载  
        header('pragma:public');  
        header("Content-Disposition:attachment;filename=$fileName.xls");  
        $objWrite->save('php://output');exit;  
    }  
  
    $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码  
    $_savePath = $savePath.$_fileName.'.xlsx';  
     $objWrite->save($_savePath);  
  
     return $savePath.$fileName.'.xlsx';  
}





if($_GET['type']=="daochu")
{
	$cm->query("SELECT * FROM d_kami left join d_adminuser on d_kami.km_uid=d_adminuser.admin_id order by km_time desc ");
	while($row = $cm->fetch_array($rs))
	{

		$biaoge[]=array($row['admin_name'],$agent[$row['admin_aglevel']],$row['km_number'],$kmtype[$row['km_type']],$kmzt[$row['km_sell']],date('Y-m-d',$row['km_time']));

	}
	//exportExcel(array('姓名','年龄'), array(array('a',21),array('b',23)), '档案', './', true);
	exportExcel(array('代理会员','代理类别','卡密','卡密类型','状态','发货时间'), $biaoge, '卡密', './', true);
	
}






 function randCode($length = 32, $type = 0) 

  {

   $arr = array(1 => "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ");

	if ($type == 0)

	 {

	 array_pop($arr);

	 $string = implode("", $arr);

	 } 

	 elseif ($type == "-1") 

	 {$string = implode("", $arr);} 

	 else 

	 {$string = $arr[$type];}

	$count = strlen($string) - 1;

	$code = '';

	for ($i = 0; $i < $length; $i++) 

	 {

		$code .= $string[rand(0, $count)];

	 }

	 return $code;

 }

if($_GET['type']=='del' and $_GET['id']!=''){  

   $delete=$cm->delete('d_kami',"km_id in(".$_GET['id'].")");

		echo tiao("卡密删除成功", "kami.php");

		exit();

  }

if($_GET['add']=='delkami'){
	$idstr='';
	foreach($_POST['items'] as $v)
	{
		$idstr.=$v.',';
	}
	$idstr=rtrim($idstr,",");
	
	 $delete=$cm->delete('d_kami',"km_id in(".$idstr.")");

		echo tiao("卡密删除成功", "kami.php");

		exit();
	
	//print_r($_POST['items']);exit;
}

if($_GET['add']=='kami'){
	
		
	
	


        $shuliang = $_POST['shuliang'];//数量

		$km_uid = $_POST['km_uid'];//代理id

		$km_type = $_POST['km_type'];//卡密类型（月度、年度、季度会员）

        $thetime=time();

for($z=0;$z<$shuliang;$z++){

$cardkm = randCode(16,1);													

$isql="INSERT INTO d_kami(km_uid,km_type,km_number,km_time)VALUES('$km_uid','$km_type','$cardkm','$thetime')";

$addkm=mysql_query($isql);

 }

 	if ($addkm) {

		echo tiao("卡密发货成功", "kami.php");

		exit();

	}

	else {

		echo tiao("卡密发货失败", "kami.php");

		exit();

	}

}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>商品列表</title>

<link href="public/css/base.css" rel="stylesheet" type="text/css" />

<link href="public/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">window.jQuery || document.write("<script src='../Public/Plugin/style/js/jquery-2.0.3.min.js'>"+"<"+"/script>");</script>
<script language="javascript"> 

function delcfm() { 

if (!confirm("确定要删除该卡密吗？")) { 

window.event.returnValue = false; 

} } 

</script> 

<script language="javascript"> 
function kamidel() { 

if (!confirm("确定删除卡密吗？")) { 

window.event.returnValue = false; 

} 
else 
{
	var form = document.getElementById('delForm');
	form.submit();
	
}



} 
function kamifh() { 

if (!confirm("确定要进行发货？")) { 

window.event.returnValue = false; 

} } 

</script> 

</head>

<body>

<!--卡密生成start-->

<div style="margin-top:10px; padding-left:20px;">

<form action="?add=kami" id="Form" name="Form" method="post">

	<table width="100%">

      <tr>

<td  style="width:200px;">发货数量：<input class="text" type="text" name="shuliang" value=""  style="width:100px;"/></td>

<td style="width:250px;">卡密类别：

   <select name="km_type" style="width:150px;">

    <option value="0">月度卡密</option>

    <option value="1">季度卡密</option>

	<option value="2">年度卡密</option>

   </select>

</td>

<td style="width:250px;">代理会员：

  <select name="km_uid" style="width:150px;">

  <option selected="true">请选择...</option>

  <?php   

    $cm->query("SELECT * FROM d_adminuser where admin_aglevel >0 order by admin_id desc");

	  while($row = $cm->fetch_array($rs)){

		   echo '<option value="'.$row["admin_id"].'">'.$row["admin_name"].'</option>';	  

		  }	?>

  </select>

</td>

<td colspan="3"><input class="btnfh" type="submit" name="submit" value="生成卡密" onClick="kamifh()"/>
&nbsp;&nbsp;&nbsp;
<input class="btnfh" type="button" name="submitdel" value="批量删除" onClick="kamidel()"/>
&nbsp;&nbsp;&nbsp;



<input class="btnfh" type="button" name="submitdel" value="导出卡密" onClick="javascript:window.location.href='?type=daochu'  "/>
</td>


</tr>

</table>

</form>

</div>

<!--卡密生成end-->

<?php

if($_GET['type']!='s'){	

$cm->query("SELECT * FROM d_kami left join d_adminuser on d_kami.km_uid=d_adminuser.admin_id order by km_time desc");

}else{

$cm->query("SELECT * FROM d_kami left join d_adminuser on d_kami.km_uid=d_adminuser.admin_id where admin_name like '%".$_POST['key']."%' or admin_level like '%".$_POST['key']."%' order by km_time desc");	

}

$mypagesnum=$cm->db_num_rows();

$p_pageSize = 20;

$myPage = new pager($mypagesnum, intval($CurrentPage), $p_pageSize);

$min_page = ($CurrentPage - 1) * $p_pageSize;



if($_GET['type']!='s'){	

$cm->query("SELECT * FROM d_kami left join d_adminuser on d_kami.km_uid=d_adminuser.admin_id order by km_time desc LIMIT " . $min_page . "," . $p_pageSize);

}else{

$cm->query("SELECT * FROM d_kami left join d_adminuser on d_kami.km_uid=d_adminuser.admin_id where admin_name like '%".$_POST['key']."%' or admin_level like '%".$_POST['key']."%' order by km_time desc LIMIT " . $min_page . "," . $p_pageSize);	

}

		

?>

<div class="tab" id="tab"> 

<a class="selected" href="#">卡密列表(<?=$mypagesnum?>&nbsp;个)</a>&nbsp;&nbsp;&nbsp;&nbsp;

<a href="admindaili.php">代理会员</a>

<form name="forms1" method="post" action="?type=s" style="float:right">

	代理名称：<input type="text" name="key" value="" class="text_value" style="height:20px; width:120px" />

    <button type="submit" class="button" style="height:20px; line-height:20px">搜索</button> 

</form>

</div>



<div class="page_main">

  <div class="page_table table_list">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <th width="8%"><center><input type="button" id="CheckAll" value="全选" /></center></th>
        <th width="8%"><center>代理会员</center></th>

        <th width="8%"><center>代理类别</center></th>

        <th width="20%"><center>卡密</center></th>

        <th width="8%"><center>卡密类型</center></th>

        <th width="8%"><center>状态</center></th>

        <th width="10%"><center>发货时间</center></th>

        <th width="10%"><center>操作</center></th>

      </tr>
<form action="?add=delkami" id="delForm" name="delForm" method="post">
      <?php
	  



$biaoge=array();
while($row = $cm->fetch_array($rs)){

?>

      <tr> 

        <td><center><input type="checkbox" name="items[]" value="<?php echo $row['km_id']?>" /></center></td>
        <td><center><?php  if(empty($row['admin_name']))echo "主站";else echo $row['admin_name'];?></center></td>

        <td><center><?php if(empty($row['admin_name']))echo "主站";else echo  $agent[$row['admin_aglevel']];?></center></td>

        <td><center><?php echo $row['km_number']?></center></td>

        <td><center><?php echo $kmtype[$row['km_type']]?></center></td>

        <td <?php if($row['km_sell']==1){?>  style="color:#F00" <?php } ?>><center><?php echo $kmzt[$row['km_sell']]?></center></td>

        <td><center><?php echo date('Y-m-d',$row['km_time'])?></center></td>

        <td><center><a href="?type=del&id=<?php echo $row['km_id']?>"  onClick="delcfm()">删除卡密</a></center></td>

      </tr>

     <?php

}


?>
</form>
    </table>

  </div>

</div>

<div class="page_tool">

  <div class="page">

  <?php $pageStr= $myPage->GetPagerContent();

	 echo $pageStr;

    ?></div>

</div>


<input type="hidden" value="0" id="is_chek"  />
<div class="fn_clear"></div>
<script>
$("#CheckAll").click(function(){
	if($("#is_chek").val()==0)
	{
		 $("input:checkbox").prop("checked","checked");
		$("#is_chek").val(1)	;
	}
	else
	{
		$("input:checkbox").removeAttr("checked");
			
		$("#is_chek").val(0)	;
	}
	
	
	
           
        });


</script>
</body>



</html>