<?php
//Ȩ����֤����
include("../const.php");
if ($authority[12]==0){  
	echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
	exit;
}
//Ȩ����֤����
	include "../basic/include.php";
	include "../basic/database.php";
	
	$query = "select count(*) as num from tb_product where 1";//echo $query."<br>";die();
	$result = mysql_query($query) or die("Invalid query: " . mysql_error());
	$RS = mysql_fetch_array($result);
	$num = $RS[num];
	
	$query = "select * from tb_product where 1 order by encode";//echo $query."<br>";die();
	$result_product = mysql_query($query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>����ѯ-���л�Ʒ</title>
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
<script type="text/javascript" src="../js/Calendar3.js"></script>
<script type="text/javascript" src="../js/TableSort_mains.js"></script>
<script language="javascript">
function gotoURL(target){
	var id = target.innerHTML;
	var url = "inquire_storage_item.php?itemid="+id;
	//location.href = url;
	window.open(url,'_blank','directorys=no,toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=640,height=480,top=176,left=161');
}
function gotoURL2(target){
	var value = target.value;
	var url = "inquire_storage_allitem.php?option="+value;
	location.href = url;
}
</script>
<body style="width:800px; font-size:14px">
<div>
  <h3>����ѯ-���л�Ʒ</h3>
  <p>���� <?php echo $num; ?> ����Ʒ��¼��</p>
  <div style="float:left">������Ʒ��ſ��Բ鿴����Ʒ������顣</div>
  <div style="float:right">ɸѡ��
    <select name="filter" onchange="gotoURL2(this)">
      <option value="0" <?php if($_GET[option]==0) echo 'selected';?>>ȫ��</option>
      <option value="1" <?php if($_GET[option]==1) echo 'selected';?>>����</option>
      <option value="2" <?php if($_GET[option]==2) echo 'selected';?>>��������</option>
      <option value="3" <?php if($_GET[option]==3) echo 'selected';?>>��������</option>
    </select>
  </div>
  <table id="table_storage" width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#9999FF">
    <thead style="color: #330066">
      <tr align="center" bordercolor="#9999FF">
        <td onclick="SortTable('table_storage',0,'string')" style="cursor:pointer">��Ʒ���</td>
        <td onclick="SortTable('table_storage',1,'string')" style="cursor:pointer">��Ʒ����</td>
        <td onclick="SortTable('table_storage',2,'string')" style="cursor:pointer">�ͺ�</td>
        <td onclick="SortTable('table_storage',3,'string')" style="cursor:pointer">��λ</td>
        <td onclick="SortTable('table_storage',4,'int')" style="cursor:pointer">�������</td>
        <td onclick="SortTable('table_storage',5,'int')" style="cursor:pointer">�������</td>
        <td onclick="SortTable('table_storage',6,'int')" style="cursor:pointer">�����</td>
        <td onclick="SortTable('table_storage',7,'string')" style="cursor:pointer">Ԥ����Ϣ</td>
      </tr>
    </thead>
    <tbody>
      <?php
	while($RS = mysql_fetch_array($result_product))
	{
		$sum = 0;
		$query = "select id from table_warehouse order by id";//echo $query."<br>";
		$result_warehouse = mysql_query($query);//��ȡ�ֿ��б�
		while($RS2 = mysql_fetch_array($result_warehouse)){
			$query = "select num from table_warehouse_$RS2[id] where id = '$RS[encode]'";//echo $query."<br>";
			$result_num = mysql_query($query);
			$RS3 = mysql_fetch_array($result_num);
			$sum += $RS3[num];
		}
		if($sum > $RS[upperlimit]){
			$string = "��������";
			$color = 'red';
		}
		else if($sum < $RS[lowerlimit]){
			$string = "��������";
			$color = 'gray';
		}
		else{
			$string = "����";
		 	$color = 'green';
		}
		$option = $_GET[option];
		if($option==0 || ($option==1&&$string=="����") || ($option==2&&$string=="��������") || ($option==3&&$string=="��������")){		
			echo "<tr align='center' bordercolor='#9999FF'>";
			echo "<td customvalue='$RS[encode]'><a href='inquire_storage_item.php?itemid=$RS[encode]'>$RS[encode]</a></td>\n";
			echo "<td>$RS[name]</td>\n";
			echo "<td>$RS[size]</td>\n";
			echo "<td>$RS[unit]</td>\n";
			echo "<td>$RS[upperlimit]</td>\n";
			echo "<td>$RS[lowerlimit]</td>\n";
			echo "<td>$sum</td>\n";
			echo "<td style='color:$color'>$string</td>\n";
			echo "</tr>";
		}
	}
?>
    </tbody>
  </table>
  <p>
    <input name="" type="button" value="������WORD" onclick=" AllAreaWord()"/>
    <input name="" type="button" value="������EXCEL" onclick="AutomateExcel()"/>
  </p>
<script language="javascript">
function AllAreaWord() 
{
	if(document.all("table_storage").rows.length==0){
		alert("û�����ݿɵ���");
		return;
	}
	try{
		var oWD = new ActiveXObject("Word.Application"); 
	}
	catch(e){
		alert("�޷�����Office������ȷ�����Ļ����Ѱ�װ��Office���ѽ���ϵͳ��վ�������뵽IE������վ���б��У�");
		return;
	}
	var oDC = oWD.Documents.Add("",0,1); 
	var oRange =oDC.Range(0,1); 
	var sel = document.body.createTextRange(); 
	sel.moveToElementText(table_storage); //tab Ϊ�����������ڵı��ID
	sel.select(); 
	sel.execCommand("Copy"); 
	oRange.Paste(); 
	oWD.Application.Visible = true; 
}

function AutomateExcel(){	
	try{
		var appExcel = new ActiveXObject( "Excel.Application" ); 
	}
	catch(e){
	  alert("�޷�����Office������ȷ�����Ļ����Ѱ�װ��Office���ѽ���ϵͳ��վ�������뵽IE������վ���б��У�");
	  return;
	}
	var elTable = document.getElementById("table_storage"); //outtable Ϊ�����������ڵı��ID��
	var oRangeRef = document.body.createTextRange(); 
	
	oRangeRef.moveToElementText( elTable ); 
	oRangeRef.execCommand( "Copy" );
	
	appExcel.Visible = true; 
	appExcel.Workbooks.Add().Worksheets.Item(1).Paste(); 
	appExcel = null;
}
function selectitem(){//ѡ�����
	//var url = 'item_choose.php';
	var url = '../../wms/product/showproduct.php?stype=1&mtype=1';
	window.open(url,'_blank','directorys=no,toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=853,height=470,top=176,left=161');
}
</script>
  <p>
  <div>������ѯ��ʽ��</div>
  <div> ����Ʒ��ѯ��
    <input id="item_id" name="item_id" type="text"  style="background-color:#CCCCCC" value="�뵥��ѡ����Ʒ" onclick="selectitem()"/>
    <button type="button" onclick="if(document.getElementById('item_id').value!='�뵥��ѡ����Ʒ'){url='inquire_storage_item.php?itemid='+document.getElementById('item_id').value;window.open(url,'_self');}">&nbsp;��ѯ&nbsp;</button>
    <input id="item_name" name="item_name" type="text" size="5" style="background-color:#CCCCCC; visibility:hidden"/>
    <input id="item_model" name="item_model" type="text" size="5" style="background-color:#CCCCCC; visibility:hidden"/>
    <input id="item_unit" name="item_unit" type="text" size="5" style="background-color:#CCCCCC; visibility:hidden"/>
  </div>
  <div> ���ֿ��ѯ��
    <select id="warehouse" name="warehouse" onchange="if(this.value!='none'){url='inquire_storage_warehouse.php?warehouse='+this.value;window.open(url,'_self')}">
      <option value='none'>-��ѡ��-</option>
      <?php 
	$query = "select * from table_warehouse order by name";//echo $query."<br>";
	$result_warehouse = mysql_query($query);//��ȡ�ֿ��б�
	
	while($RS = mysql_fetch_array($result_warehouse))
		echo "<option value='$RS[id]'>$RS[name]</option>";
	?>
    </select>
  </div>
  </p>
</div>
</div>
</body>
</html>
