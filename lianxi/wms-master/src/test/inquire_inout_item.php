<?php
	$con = mysql_connect("localhost","root","1234");
	mysql_select_db("db_wms", $con);
	mysql_query("set names gb2312 ");
	
	$limit_string = '';
	$option = $_GET[option];//echo $option;
	if($option == 'type'){
		$id = $_GET[id];
		$limit_string = " and type = '$id'";
	}
	else if($option == 'receipt'){
		$id = $_GET[id];
		$limit_string = " and receipt = '$id'";
	}
	else if($option == 'item'){
		$id = $_GET[id];
		$limit_string = " and item = '$id'";
	}
	
	$query = "select count(*) as num from test_inout where 1".$limit_string;//echo $query."<br>";
	$result = mysql_query($query) or die("Invalid query: " . mysql_error());
	$RS = mysql_fetch_array($result);
	$num = $RS[num];
	
	$query = "select * from test_inout where 1".$limit_string;//echo $query."<br>";
	$result_receipt = mysql_query($query);
	
	$query = "select * from tb_inout order by id";//echo $query."<br>";
	$result_type = mysql_query($query);//��ȡ����������б�
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������ѯ-��Ʒ</title>
</head>
<script language="javascript">
function gotoURL(target){
	var id = target.innerHTML;
	var url = "receipt_show_inout.php?id="+id;
	//location.href = url;
	window.open(url,'_blank','directorys=no,toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=640,height=480,top=176,left=161');
}
function gotoURL2(target){
	var id = target.innerHTML;
	var url = "receipt_show_exchange.php?id="+id;
	//location.href = url;
	window.open(url,'_blank','directorys=no,toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=640,height=480,top=176,left=161');
}
function optionChange(object){
	hideAll();
	switch(object.value){
		case 'inquiry_type':
			document.getElementById('inquiry_type').hidden = false;
			break;
		case 'inquiry_item':
			document.getElementById('inquiry_item').hidden = false;
			break;
		case 'inquiry_receipt':
			document.getElementById('inquiry_receipt').hidden = false;
			break;
		default:break;
	}
}
function hideAll(){
	
	document.getElementById('inquiry_type').hidden = true;	
	document.getElementById('inquiry_item').hidden = true;	
	document.getElementById('inquiry_receipt').hidden = true;
}
</script>
<script type="text/javascript" src="../js/TableSort_mains.js"></script>
<body>
<h3>������ѯ-��Ʒ</h3>
<?php
echo "<p>���� $num ����¼</p>";
?>
<!--��ȷ��ѯ���-->
<!--<div style="margin-bottom:8px; height:20px"> ��ȷ��ѯ��
  <input id="receipt_id" name="receipt_id" type="text" value="�����뵥��ID" onclick="this.value=''" onblur="if(this.value=='') this.value='�����뵥��ID'"/>
  <input name="search" type="button" value="����" onclick="location.href='receipt_show_inout.php?id=' + document.getElementById('receipt_id').value"/>
</div>-->
<!--��ȷ��ѯ���-->
<!--��ѯ���-->
<div style="margin-bottom:8px; height:20px">
  <!--��ѯ��ʽѡ��-->
  <div style="float:left">��ѯ��ʽ��
    <select id="inquiry" name="inquiry" onchange="optionChange(this)">
      <option value="none" selected="selected">��</option>
      <option value="inquiry_item">��ƷID</option>
      <option value="inquiry_receipt">����ⵥ</option>
      <option value="inquiry_type">���������</option>
    </select>
  </div>
  <!--��ѯ��ʽѡ��-->
  <!--���������-->
  <div id="inquiry_type">
    <select name="menu1" onchange="location.href='inquire_inout_item.php?option=type&id='+this.value">
      <option value="none">��ѡ��</option>
      <?php 
	  	while($RS = mysql_fetch_array($result_type))
			echo "<option value='$RS[id]'>$RS[name]</option>";
	  ?>
      <option value="none">�ֿ����</option>
    </select>
  </div>
  <!--���������-->
  <!--��ƷID-->
  <div id="inquiry_item">
    <input id="item_id" name="item_id" value="�������ƷID" type="text" onclick="this.value=''" onblur="if(this.value=='') this.value='�������ƷID'"/>
    <input name="button" type="button" value="��ѯ" onclick="location.href='inquire_inout_item.php?option=item&id=' + document.getElementById('item_id').value"/>
  </div>
  <!--��ƷID-->
  <!--����ⵥ��ID-->
  <div id="inquiry_receipt">
    <input id="receipt_id" name="item_id" value="�����뵥��ID" type="text" onclick="this.value=''" onblur="if(this.value=='') this.value='�����뵥��ID'"/>
    <input name="button" type="button" value="��ѯ" onclick="location.href='inquire_inout_item.php?option=receipt&id=' + document.getElementById('receipt_id').value"/>
  </div>
  <!--����ⵥ��ID--->
</div>
<script language="javascript">
hideAll();
</script>
<div>
  <input name="" type="button" value="��ʾȫ��" onclick="location.href='inquire_inout_item.php'"/>
</div>
<table id="MyTable" width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#9999FF">
  <thead>
  <tr align="center">
    <td rowspan="2" onclick="SortTable('MyTable',0,'string')" style="cursor:pointer">��¼���</td>
    <td colspan="4">��Ʒ��Ϣ</td>
    <td colspan="3">�������Ϣ</td>
    <td colspan="2">����������Ϣ</td>
  </tr>
  <tr align="center">
    <td onclick="SortTable('MyTable',1,'string')" style="cursor:pointer">��ƷID</td>
    <td onclick="SortTable('MyTable',2,'string')" style="cursor:pointer">����</td>
    <td onclick="SortTable('MyTable',3,'string')" style="cursor:pointer">�ͺ�</td>
    <td onclick="SortTable('MyTable',4,'string')" style="cursor:pointer">��λ</td>
    <td onclick="SortTable('MyTable',5,'int')" style="cursor:pointer">����</td>
    <td onclick="SortTable('MyTable',6,'float')" style="cursor:pointer">�۸�</td>
    <td onclick="SortTable('MyTable',7,'string')" style="cursor:pointer">����</td>
    <td onclick="SortTable('MyTable',8,'string')" style="cursor:pointer">����ID</td>
    <td onclick="SortTable('MyTable',9,'string')" style="cursor:pointer">�ֿ�</td>
  </tr>
  </thead>
  <tbody>
  <?php
	while($RS = mysql_fetch_array($result_receipt))
	{
		echo "<tr align='center'>";
		echo "<td>$RS[id]</td>";
		
		echo "<td  style='background-color:#CCCCCC'>$RS[item]</td>";
		
		if(1){
			$query = "select * from tb_product where encode = '$RS[item]'";
			$result_iteminfo = mysql_query($query);
			$RS2 = mysql_fetch_array($result_iteminfo);
			echo "<td>$RS2[name]</td>";
			echo "<td>$RS2[size]</td>";
			echo "<td>$RS2[unit]</td>";
		}
		else{
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
		}

		echo "<td>$RS[num]</td>";
		echo "<td>$RS[price]</td>";
		
		if($RS[type]!='none'){
			$query = "select name from tb_inout where id = '$RS[type]'";//echo $query."<br>";
			$result = mysql_query($query);
			$RS2 = mysql_fetch_array($result);
			echo "<td>$RS2[name]</td>\n";//���������
		}
		else
			echo "<td>�ֿ����</td>\n";
		
		if($RS[type]!='none'){
			echo "<td onclick='gotoURL(this)' style='background-color:#CCCCCC'>$RS[receipt]</td>\n";			
			$query = "select warehouse from test_receipt where id = '$RS[receipt]'";//echo $query."<br>";
			$result = mysql_query($query);
			$RS2 = mysql_fetch_array($result);
			$query = "select name from table_warehouse where id = '$RS2[warehouse]'";//echo $query."<br>";
			$result = mysql_query($query);
			$RS3 = mysql_fetch_array($result);
			echo "<td>$RS3[name]</td>\n";
		}
		else{
			echo "<td onclick='gotoURL2(this)' style='background-color:#CCCCCC'>$RS[receipt]</td>\n";	
			$query = "select warehouse from test_exchange where id = '$RS[receipt]'";//echo $query."<br>";
			$result = mysql_query($query);
			$RS2 = mysql_fetch_array($result);
			$query = "select name from table_warehouse where id = '$RS2[warehouse]'";//echo $query."<br>";
			$result = mysql_query($query);
			$RS3 = mysql_fetch_array($result);
			echo "<td>$RS3[name]</td>\n";
		}
		echo "</tr>";
	}
?></tbody>
</table>
</body>
</html>
