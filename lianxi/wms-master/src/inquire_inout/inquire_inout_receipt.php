<?php
//Ȩ����֤����
include("../const.php");
if ($authority[14]==0){  
	echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
	exit;
}
if ($authority[15]==0){  
	echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
	exit;
}
//Ȩ����֤����
	include "../basic/include.php";
	include "../basic/database.php";
	
	$limit_string = '';
	$option = $_GET[option];//echo $option;
	if($option == 'date'){
		$date1 = $_GET[date1];
		$date2 = $_GET[date2];
		if($date1 != '' && $date2 == '')
			$limit_string = " and date >= '$date1'";
		else if($date2 != '' && $date1 == '')
			$limit_string = " and date <= '$date2'";
		else if($date1 != '' && $date2 != '')
			$limit_string = " and date between '$date1' and '$date2'";
	}
	else if($option == 'type'){
		$id = $_GET[id];
		$limit_string = " and type = '$id'";
	}
	else if($option == 'warehouse'){
		$id = $_GET[id];
		$limit_string = " and warehouse = '$id'";
	}
	else if($option == 'company'){
		$id = $_GET[id];
		$limit_string = " and company = '$id'";
	}
	
	$query = "select count(*) as num from test_receipt where 1".$limit_string;//echo $query."<br>";die();
	$result = mysql_query($query) or die("Invalid query: " . mysql_error());
	$RS = mysql_fetch_array($result);
	$num = $RS[num];
	
	$query = "select * from test_receipt where 1".$limit_string;//echo $query."<br>";die();
	$result_receipt = mysql_query($query);
	
	$query = "select * from tb_inout order by id";//echo $query."<br>";
	$result_type = mysql_query($query);//��ȡ����������б�
	
	$query = "select * from table_warehouse order by id";//echo $query."<br>";
	$result_warehouse = mysql_query($query);//��ȡ�ֿ��б�
	
	$query = "select * from table_company order by id";//echo $query."<br>";
	$result_company = mysql_query($query);//��ȡ��˾�б�

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������ѯ-����</title>
</head>
<style type="text/css">
<!--
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
-->
</style>
<script type="text/javascript" src="../js/TableSort_mains.js"></script>
<script type="text/javascript" src="../js/Calendar3.js"></script>
<script language="javascript">
function optionChange(object){
	hideAll();
	switch(object.value){
		case 'inquiry_time':
			document.getElementById('inquiry_time').style.display = "inline";
			break;
		case 'inquiry_type':
			document.getElementById('inquiry_type').style.display = "inline";
			break;
		case 'inquiry_warehouse':
			document.getElementById('inquiry_warehouse').style.display = "inline";
			break;
		case 'inquiry_company':
			document.getElementById('inquiry_company').style.display = "inline";
			break;
		default:break;
	}
}
function hideAll(){
	document.getElementById('inquiry_time').style.display = "none";
	document.getElementById('inquiry_type').style.display = "none";
	document.getElementById('inquiry_warehouse').style.display = "none";
	document.getElementById('inquiry_company').style.display = "none";
}
</script>
<body style="width:800px; font-size:14px">
<h3>������ѯ-����</h3>
<?php
echo "<p>���� $num ����¼</p>";
?>
<!--��ȷ��ѯ���-->
<div style="margin-bottom:8px; height:20px"> ��ȷ��ѯ��
  <input id="receipt_id" name="receipt_id" type="text" value="�����뵥��ID" onclick="this.value=''" onblur="if(this.value=='') this.value='�����뵥��ID'"/>
  <input name="search" type="button" value="����" onclick="location.href='../receipt_inout/receipt_show_inout.php?id=' + document.getElementById('receipt_id').value"/>
</div>
<!--��ȷ��ѯ���-->
<!--��ѯ���-->
<div style="margin-bottom:8px; height:20px">
  <!--��ѯ��ʽѡ��-->
  <div style="float:left">��ѯ��ʽ��
    <select id="inquiry" name="inquiry" onchange="optionChange(this)">
      <option value="none" selected="selected">��</option>
      <option value="inquiry_time">ʱ�䷶Χ</option>
      <option value="inquiry_company">��˾</option>
      <option value="inquiry_warehouse">�ֿ�</option>
      <option value="inquiry_type">���������</option>
    </select>
  </div>
  <!--��ѯ��ʽѡ��-->
  <!--����-->
  <div id="inquiry_time"> ��
    <input name="date1" type="text" id="date1" onclick="new Calendar().show(this);" size="8" maxlength="10"/>
    ��
    <input name="date2" type="text" id="date2" onclick="new Calendar().show(this);" size="8" maxlength="10" />
    <input name="search" type="button" value="����" onclick="location.href='inquire_inout_receipt.php?option=date&date1=' + document.getElementById('date1').value + '&date2=' + document.getElementById('date2').value"/>
  </div>
  <!--����-->
  <!--���������-->
  <div id="inquiry_type">
    <select name="menu1" onchange="location.href='inquire_inout_receipt.php?option=type&id='+this.value">
      <option value="">��ѡ��</option>
      <?php 
	  	while($RS = mysql_fetch_array($result_type))
			echo "<option value='$RS[id]'>$RS[name]</option>";
	  ?>
    </select>
  </div>
  <!--���������-->
  <!--�ֿ�-->
  <div id="inquiry_warehouse">
    <select name="menu1" onchange="location.href='inquire_inout_receipt.php?option=warehouse&id='+this.value">
      <option value="none">��ѡ��</option>
      <?php 
	  	while($RS = mysql_fetch_array($result_warehouse))
			echo "<option value='$RS[id]'>$RS[name]</option>";
	  ?>
    </select>
  </div>
  <!--�ֿ�-->
  <!--��˾-->
  <div id="inquiry_company">
    <select name="menu1" onchange="location.href='inquire_inout_receipt.php?option=company&id='+this.value">
      <option value="none">��ѡ��</option>
      <?php 
	  	while($RS = mysql_fetch_array($result_company))
			echo "<option value='$RS[id]'>$RS[name]</option>";
	  ?>
    </select>
  </div>
  <!--��˾-->
</div>
<!--��ѯ���-->
<script language="javascript">hideAll();</script>
<div>
  <input name="" type="button" value="��ʾȫ��" onclick="location.href='inquire_inout_receipt.php'"/>
</div>
<table id="MyTable" width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#9999FF">
  <thead style="color: #330066">
    <tr align="center" bordercolor="#9999FF">
      <td onclick="SortTable('MyTable',0,'string')" style="cursor:pointer">���ݱ��</td>
      <td onclick="SortTable('MyTable',1,'string')" style="cursor:pointer">�Ƶ�����</td>
      <td onclick="SortTable('MyTable',2,'string')" style="cursor:pointer">ҵ��Ա</td>
      <td onclick="SortTable('MyTable',3,'string')" style="cursor:pointer">���׹�˾</td>
      <td onclick="SortTable('MyTable',4,'string')" style="cursor:pointer">�����ֿ�</td>
      <td onclick="SortTable('MyTable',5,'string')" style="cursor:pointer">���������</td>
      <td>��ע</td>
    </tr>
  </thead>
  <tbody>
    <?php
	while($RS = mysql_fetch_array($result_receipt))
	{
		echo "<tr align='center' bordercolor='#9999FF'>";
		echo "<td customvalue='$RS[id]'><a href='../receipt_inout/receipt_show_inout.php?id=$RS[id]'>$RS[id]</a></td>\n";
		echo "<td>$RS[date]</td>\n";
		echo "<td>$RS[yewuyuan]</td>\n";
		$query = "select name from table_company where id = '$RS[company]'";//echo $query."<br>";
		$result = mysql_query($query);
		$RS2 = mysql_fetch_array($result);
		echo "<td>$RS2[name]</td>\n";//��˾����
		$query = "select name from table_warehouse where id = '$RS[warehouse]'";//echo $query."<br>";
		$result = mysql_query($query);
		$RS2 = mysql_fetch_array($result);
		echo "<td>$RS2[name]</td>\n";//�ֿ�����
		$query = "select name from tb_inout where id = '$RS[type]'";//echo $query."<br>";
		$result = mysql_query($query);
		$RS2 = mysql_fetch_array($result);
		echo "<td>$RS2[name]</td>\n";//���������
		echo "<td>$RS[remark]</td>\n";
		echo "</tr>";
	}
?>
  </tbody>
</table>
</body>
</html>
