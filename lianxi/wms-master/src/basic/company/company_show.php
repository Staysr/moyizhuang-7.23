<?php
//Ȩ����֤����
include("../../const.php");
if ($authority[0]==0){  
	echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
	exit;
}
//Ȩ����֤����

	include "../include.php";
	include "../database.php";

	$pagesize = 10;//��ҳ��ʾ����Ŀ��
	$page = $_GET['page'];//URL��û�ж���pageʱ��$page=0����ǰҳ��=$page+1��
	$orderby = $_GET['orderby'];//URL��û�ж���orderbyʱ��$orderby=0��ʹ��Ĭ������ʽ
	
	$query="select count(*) as num from table_company";//echo $query."<br>";
	$result = mysql_query($query) or die("Invalid query: " . mysql_error());
	$RS = mysql_fetch_array($result);
	$num = $RS['num'];//�������ݿ��е���Ŀ����
	for($i=0;$i*$pagesize<$num;$i++);//������ʾ���е���Ŀ��Ҫ��ҳ��
	$total=$i;
	
	if($orderby!=''){
		$string_order=" order by $orderby";
		$string_url="orderby=$orderby&";
	}
	else{
		$string_order=" order by id";
		$string_url="";
	}
	/*switch($orderby){
		case 'id':$string_order=" order by id";$string_url="orderby=id&";break;
		case 'name':$string_order=" order by name";$string_url="orderby=name&";break;
		case 'gender':$string_order=" order by gender";$string_url="orderby=gender&";break;
		case 'job':$string_order=" order by job";$string_url="orderby=job&";break;
		case 'depart':$string_order=" order by depart";$string_url="orderby=depart&";break;
		default:$string_order="";$string_url="";
	}*/
	
	$string_page=" limit " . $page*$pagesize . "," . ($page+1)*$pagesize;
	
	$query="select * from table_company" . $string_order . $string_page;//echo $query."<br>";
	$result = mysql_query($query) or die("Invalid query: " . mysql_error());
	mysql_close();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������˾����</title>
</head>
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
body {
	width:800px;
	font-size:14px
}
</style>
<body style="font-size:14px; width:800px">
<h3 align="center">������λ����</h3>
<p>
<div align="left" style="width:100px;float:left"><a href="company_add.php">���������λ</a></div>
<div align="right" style="width:200px;float:right">����ʽ��
  <select name="orderby" onchange="location.href=this.value">
    <option value="company_show.php?orderby=id" <?php if($orderby==""||$orderby=="id") echo " selected='selected' "; ?>>���</option>
    <option value="company_show.php?orderby=name" <?php if($orderby=="name") echo " selected='selected' "; ?>>����</option>
	<option value="company_show.php?orderby=type" <?php if($orderby=="type") echo " selected='selected' "; ?>>����</option>
    <option value="company_show.php?orderby=area" <?php if($orderby=="area") echo " selected='selected' "; ?>>����</option>
    <option value="company_show.php?orderby=contact" <?php if($orderby=="contact") echo " selected='selected' "; ?>>��ϵ��</option>
  </select>
</div>
</p>
<table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#9999FF">
  <tr align="center" bordercolor="#9999FF" style="color: #330066">
    <td>���</td>
    <td>����</td>
	<td>����</td>
    <td>��ϵ��</td>
    <td>�绰</td>
    <td>����</td>
    <td>ʡ��</td>
    <td>�޸�</td>
    <td>ɾ��</td>
  </tr>
  <?php
	while($RS=mysql_fetch_array($result))
	{
		echo "<tr align='center' bordercolor='#9999FF'>";
		echo "<td>".$RS['id']."</td>\n";
		echo "<td>".$RS['name']."</td>\n";
		echo "<td>".$RS['type']."</td>\n";
		echo "<td>".$RS['contact']."</td>\n";
		echo "<td>".$RS['phone']."</td>\n";
		echo "<td>".$RS['area']."</td>\n";
		echo "<td>".$RS['province']."</td>\n";
		echo "<td><a href='company_modify.php?id=".$RS['id']."'><img src='../../image/modify.gif' alt='' border='0' /></a></td>\n";
		echo "<td><a href=\"javascript:if(confirm('ȷ����')) location.href='../sql_delete_bg.php?db=company&id=" . $RS['id'] . "'\">";
		echo "<img src='../../image/delete.gif' alt='' border='0' /></a></td>\n";
		echo "</tr>";
	}
?>
</table>
</p>
<p>
  <?php
$current=$page+1;
echo "��".$current."ҳ����".$total."ҳ";
echo "&nbsp;&nbsp;��ҳ��";
echo "<select name='pagechoose' onchange='javascript:location.href=this.value;'>";
for($i=0;$i<$total;$i++){
	$string="";
	if($i==$page) $string=" selected='selected' ";
	$url_i = "company_show.php?".$string_url."page=".$i;
	echo "<option value='".$url_i."'".$string.">". ($i+1) ."</option>" ;
	}
echo "</select>";

if($current<$total){
	echo "<a href='company_show.php?".$string_url."page=".$current."'>��һҳ</a>";
}
if($current>1){
	$pre = $current-2;
	echo "<a href='company_show.php?".$string_url."page=".$pre."'>��һҳ</a>";
}   
  
?>
</p>
</body>
</html>
