<?php
//Ȩ����֤����
include("../../const.php");
if ($authority[3]==0){  
	echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
	exit;
}
//Ȩ����֤����

	include "../include.php";
	include "../database.php";
	
	$pagesize = 10;//��ҳ��ʾ����Ŀ��
	$page = $_GET['page'];//URL��û�ж���pageʱ��$page=0����ǰҳ��=$page+1��
	$orderby = $_GET['orderby'];//URL��û�ж���orderbyʱ��$orderby=0��ʹ��Ĭ������ʽ
	
	$query="select count(*) as num from table_warehouse";//echo $query."<br>";
	$result = mysql_query($query) or die("Invalid query: " . mysql_error());
	$RS = mysql_fetch_array($result);
	$num = $RS['num'];//�������ݿ��е���Ŀ����
	for($i=0;$i*$pagesize<$num;$i++);//������ʾ���е���Ŀ��Ҫ��ҳ��
	$total=$i;
	
	$string_order=" order by name";
	$string_page=" limit " . $page*$pagesize . "," . ($page+1)*$pagesize;
	
	$query="select * from table_warehouse" . $string_order . $string_page;//echo $query."<br>";
	$result = mysql_query($query) or die("Invalid query: " . mysql_error());
	mysql_close();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ֿ����</title>
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
thead {
	color: #330066
}
</style>
<body style="width:800px">
<h3 align="center">�ֿ���Ϣ����</h3>
<div>
<p><a href="warehouse_add.php">��Ӳֿ�</a></p>
<table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#9999FF">
  <thead><tr align="center" bordercolor="#9999FF">
    <td>�ֿ���</td>
	<td>�ֿ�����</td>
    <td>������</td>
    <td>�ֿ�绰</td>
    <td>�ֿ��ַ</td>
    <td>��ע</td>
    <td>�޸�</td>
    <td>ɾ��</td>
  </tr></thead>
  <tbody>
  <?php
	while($RS=mysql_fetch_array($result))
	{
		echo "<tr align='center' bordercolor='#9999FF'>";
		echo "<td>".$RS['id']."</td>\n";
		echo "<td>".$RS['name']."</td>\n";
		echo "<td>".$RS['fuzeren']."</td>\n";
		echo "<td>".$RS['phone']."</td>\n";
		echo "<td>".$RS['address']."</td>\n";
		echo "<td>".$RS['remark']."</td>\n";
		echo "<td><a href='warehouse_modify.php?id=".$RS['id']."'><img src='../../image/modify.gif' alt='' border='0' /></a></td>\n";
		echo "<td><a href=\"javascript:if(confirm('ȷ����')) location.href='../sql_delete_bg.php?db=warehouse&id=".$RS['id']."'\">";
		echo "<img src='../../image/delete.gif' alt='' border='0' /></a></td>\n";
		echo "</tr>";
	}
?></tbody>
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
	$url_i = "warehouse_show.php?page=".$i;
	echo "<option value='".$url_i."'".$string.">". ($i+1) ."</option>" ;
	}
echo "</select>";

if($current<$total){
	echo "<a href='warehouse_show.php?page=".$current."'>��һҳ</a>";
}
if($current>1){
	$pre = $current-2;
	echo "<a href='warehouse_show.php?page=".$pre."'>��һҳ</a>";
}   
  
?>
</p></div>
</body>
</html>
