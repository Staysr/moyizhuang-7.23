<?php
	$warehouse = $_GET[warehouse];
	$con = mysql_connect("localhost","root","1234");
	mysql_select_db("db_wms", $con);
	mysql_query("set names gb2312 ");
		
	$query = "select * from table_warehouse order by name";//echo $query."<br>";
	$result_warehouse = mysql_query($query);
	
	$query = "select * from table_company where type='������' order by name";
	$result_company = mysql_query($query);
	
	$query = "select * from tb_inout where type='����' order by name";
	$result_inout = mysql_query($query);
	
	if($warehouse=='')
		$warehouse='0000';
	$query = "select * from table_warehouse_$warehouse order by id asc";//die($query);
	$result_item = mysql_query($query);
	
	//mysql_close();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��Ʒ����</title>
</head>
<style>
</style>
<script type="text/javascript" src="../js/Calendar3.js"></script>
<link rel="stylesheet" type="text/css" href="../css/iframe.css" media="screen" />
<script language="javascript">
var MAX = 10;
//�����
function checkForm(){//���ύ��֮ǰ������������룬���ڴ������ύ
	/*var element = document.getElementById('id');
	if(element.value==''){
		alert('���ݱ�Ų���Ϊ�գ�');
		element.focus();
		return false;
	}*/
	element = document.getElementById('control_date');//�������
	if(element.value==''||element.value=='����ѡ������'){
		alert('¼�����ڲ���Ϊ�գ�');
		element.focus();
		return false;
	}
	element = document.getElementById('yewuyuan');//���ҵ��Ա
	if(element.value==''){
		alert('ҵ��Ա����Ϊ�գ�');
		element.focus();
		return false;
	}
	element = document.getElementById('item_str');//����Ʒ
	if(element.value==''){
		alert('���л�Ʒ����Ϊ�գ�');
		//element.focus();
		return false;
	}
	return true;
}
function chooseItem(button){//ѡ�����
	var tr = button.parentNode.parentNode;
	document.getElementById('item_id').value = tr.cells[0].innerHTML;
	document.getElementById('item_name').value = tr.cells[1].innerHTML;
	document.getElementById('item_model').value = tr.cells[2].innerHTML;
	document.getElementById('item_unit').value = tr.cells[3].innerHTML;
	document.getElementById('item_num').focus();
}
function checkInput(){//��飺��Ʒ�Ƿ��Ѵ��ڣ������Ƿ�淶�������Ƿ�淶���Ƿ񳬳���������ȡ�
	var table = document.getElementById('item_list');
	var length = table.rows.length;
	
	var item_id = document.getElementById('item_id').value;//����ƷID
	if(item_id == '����ѡ���Ʒ'){//���û��ѡ���Ʒ
		alert('�뵥��ѡ���Ʒ��');
		return false;
	}
	var item_num = document.getElementById('item_num');//�������
	if(item_num.value == ''){
		alert('��Ʒ��������Ϊ�գ�');
		item_num.focus();
		return false;
	}
	var num = Number(item_num.value);
	var table2 = document.getElementById('storage');
	var length2 = table2.rows.length;
	var pos2 = 0;
	for(var i=0;i<length2;i++)
		if(table2.rows[i].cells[0].innerHTML == item_id)
			pos2 = i;
					
	if(pos2 == 0){
		alert('����û���ҵ���Ӧ���У�');
		return false;
	}
	else{
		var limit = Number(table2.rows[pos2].cells[4].innerHTML);
		if(num > limit){
			alert("���������ȣ�");
			item_num.focus();
			return false;
		}
	}	
	
	var item_price = document.getElementById('item_price');//���۸�
	if(item_price.value == ''){
		alert('��Ʒ�۸���Ϊ�գ�');
		item_price.focus();
		return false;
	}
	
	for(var i=1;i<length;i++)
		if(item_id == table.rows[i].firstChild.innerHTML){//���ѡ��Ļ�Ʒ�Ѵ���
			if(confirm('ѡ��Ļ�Ʒ�Ѵ��ڣ����������ӽ��Ḳ��ԭ��Ϣ��')==true){
				if(editRow2()==true){
					updateStr();
					return false;//�޸���Ϣ�ɹ���������µ��У�����������д���
				}
				else{
					return true;
				}
			}
			else return false;
		}
	//���������Ŀ 
	
	
	return true;
}
function addRow(){//�ڱ�������һ��
	var table = document.getElementById('item_list');
	var pos = table.rows.length;
	if(pos >= MAX+1){
		alert('��Ʒ��Ŀ�Ѵﵽ���ֵ��MAX = ' + MAX);
		return false;
	}
	var tr = table.insertRow(pos);
	tr.align = 'center';
	var td0 = tr.insertCell(0);
	var td1 = tr.insertCell(1);
	var td2 = tr.insertCell(2);
	var td3 = tr.insertCell(3);
	var td4 = tr.insertCell(4);
	var td5 = tr.insertCell(5);
	var td6 = tr.insertCell(6);
	var td7 = tr.insertCell(7);
	var td8 = tr.insertCell(8);
	td0.innerHTML = document.getElementById('item_id').value;
	td1.innerHTML = document.getElementById('item_name').value;
	td2.innerHTML = document.getElementById('item_model').value;
	td3.innerHTML = document.getElementById('item_unit').value;
	td4.innerHTML = document.getElementById('item_num').value;
	var price = new Number(document.getElementById('item_price').value);
	td5.innerHTML = price.toFixed(2);
	var price = document.getElementById('item_num').value*document.getElementById('item_price').value;
	var price_str = price.toFixed(2);
	td6.innerHTML = price_str;
	td7.innerHTML = '<a onclick="removeRow(this)">ɾ��</a>';
	td8.innerHTML = '<a onclick="editRow(this)">�޸�</a>';
	updateStr();//�����������ֵ
	//resetInput()//�ָ�Ĭ�ϵı༭��
	
}
function updateStr(){//�����������ֵ
	var item_str = document.getElementById('item_str');
	var table = document.getElementById('item_list');
	var i,j;
	var str = '';
	var item_array = new Array(3);
	var item_info;
	var list_array = new Array(table.rows.length-1);
	for(i=1;i<table.rows.length;i++){
		item_array[0] = table.rows[i].cells[0].innerHTML;
		item_array[1] = table.rows[i].cells[4].innerHTML;
		item_array[2] = table.rows[i].cells[5].innerHTML;
		item_info = item_array.join('+');
		list_array[i-1] = item_info;
	}
	str = list_array.join('|');
//	for(i=1;i<table.rows.length;i++){
//		str += '|' + table.rows[i].cells[0].innerHTML;
//		str += '&' + table.rows[i].cells[4].innerHTML;
//		str += '&' + table.rows[i].cells[5].innerHTML;
//	}
	item_str.value = str;
	alert(item_str.value);
	resetInput()
}
function removeRow(button){//ɾ������
	var tr = button.parentNode.parentNode;
	var table = tr.parentNode;
 	table.deleteRow(tr.rowIndex);
	updateStr();
}
function editRow(button){//�޸ĸ�����Ϣ�������е�ֵ�����༭��
	var tr = button.parentNode.parentNode;
	document.getElementById('item_id').value = tr.cells[0].innerHTML;
	document.getElementById('item_name').value = tr.cells[1].innerHTML;
	document.getElementById('item_model').value = tr.cells[2].innerHTML;
	document.getElementById('item_unit').value = tr.cells[3].innerHTML;
	document.getElementById('item_num').value = tr.cells[4].innerHTML;
	document.getElementById('item_price').value = tr.cells[5].innerHTML;
}
function editRow2(){//�޸ĸ�����Ϣ�����༭���ֵ����ԭ�е�ֵ
	var table = document.getElementById('item_list');
	var length = table.rows.length;
	var pos = 0;
	for(var i=0;i<length;i++)
		if(table.rows[i].cells[0].innerHTML == document.getElementById('item_id').value)
			pos = i;
			
	if(pos == 0){
		alert('����û���ҵ���Ӧ���У�������µ��У�');
		return false;
	}
	else{
		var tr = table.rows[pos];
		tr.cells[0].innerHTML = document.getElementById('item_id').value
		tr.cells[1].innerHTML = document.getElementById('item_name').value
		tr.cells[2].innerHTML = document.getElementById('item_model').value
		tr.cells[3].innerHTML = document.getElementById('item_unit').value
		tr.cells[4].innerHTML = document.getElementById('item_num').value
		var price = new Number(document.getElementById('item_price').value)
		tr.cells[5].innerHTML = price.toFixed(2)
		var price = document.getElementById('item_num').value * document.getElementById('item_price').value;
		var price_str = price.toFixed(2);
		tr.cells[6].innerHTML = price_str;
		return true;
	}
}
function resetInput(){//�ύ����󣬽�������ַ���ΪĬ�ϣ�������Ƕ��updateStr�У�
	document.getElementById('item_id').value = "����ѡ���Ʒ";
	document.getElementById('item_name').value = "";
	document.getElementById('item_model').value = "";
	document.getElementById('item_unit').value = "";
	document.getElementById('item_num').value = "";
	document.getElementById('item_price').value = "";
}
function valueLimit(input){//��������ļ۸���ʽ
	var str = input.value;
	var list = str.split('.');
	if(list.length>2)
		input.value = list[0] + '.' + list[1];
	else if(list.length==2){
		if(list[0]=='') list[0] = '0';
		if(list[1].length>2) list[1] = list[1].substring(0,2);
		input.value = list[0] + '.' + list[1];
	}
	else if(list[0].length>5){
		input.value = list[0].substring(0,5);
	}
}
function numLimit(input){//���Ƴ�������С�ڲֿ��л�Ʒ������
	var id = document.getElementById('item_id').value;
	var num = Number(input.value);
	var str = input.value;
	var table = document.getElementById('storage');
	var length = table.rows.length;
	var pos = 0;
	for(var i=0;i<length;i++)
		if(table.rows[i].cells[0].innerHTML == id)
			pos = i;
					
	if(pos == 0){
		//alert('����û���ҵ���Ӧ���У�');
		return false;
	}
	else{
		var limit = Number(table.rows[pos].cells[4].innerHTML);
		if(num > limit){
			input.value = str.substr(0,str.length-1);
			//alert("���������ȣ�");
		}
	}
}

</script>
<body>
<form id="item_in" name="item_in" method="post" action="../test/receipt_out_bg.php" onsubmit=" return checkForm()">
  <h3>��Ʒ����</h3>
  <fieldset>
  <legend>�ֿ���Ϣ</legend>
  <label>�����ֿ�</label>
  <select id="warehouse" name="warehouse" onchange="location.href='receipt_out.php?warehouse='+this.value">
    <?php 
	while($RS = mysql_fetch_array($result_warehouse))
		if($warehouse == $RS[id])
			echo "<option value='$RS[id]' selected>$RS[name]</option>";
		else
			echo "<option value='$RS[id]'>$RS[name]</option>";
	?>
  </select>
  <p><a href="/wms/basic/warehouse/warehouse_show.php" target="_blank"><img src="/wms/image/delete.gif" alt="�ֿ����" width="25" height="19" border="0"/></a></p>
  </fieldset>
  <fieldset>
  <legend>����б�</legend>
  <table id="storage" width="500" border="1" cellspacing="0" cellpadding="5" style="font-size:12px; border:thin; border-color:#9999FF ">
    <tr align="center">
      <td>��Ʒ���</td>
      <td>��Ʒ����</td>
      <td>����ͺ�</td>
      <td>��λ</td>
      <td>����</td>
      <td>ѡ��</td>
    </tr>
    <?php
	while($RS = mysql_fetch_array($result_item)){
		echo "<tr align='center'>";
		echo "<td>$RS[id]</td>";	

		if(1){
			$query = "select * from tb_product where encode = '$RS[id]'";
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
		echo "<td><button type='button' onclick='chooseItem(this)'>ѡ��</button></td>";
		echo "</tr>";
	}
	?>
  </table>
  </fieldset>
  <fieldset>
  <legend>����Ϣ</legend>
  <label>���ݱ��</label>
  <input id="id" name="id" type="text" onkeyup="value=value.replace(/[^\d]/g,'')" style="background-color:#CCCCCC" readonly/>
  <label>������</label>
  <select name="company" id="company">
    <?php while($RS = mysql_fetch_array($result_company))echo "<option value='$RS[id]'>$RS[name]</option>";	?>
  </select>
  <p><a href="/wms/basic/company/company_show.php" target="_blank"><img src="/wms/image/delete.gif" alt="������˾����" width="25" height="19" border="0"/></a></p>
  <label>¼������</label>
  <input name="date" type="text" id="control_date" style="background-color:#CCCCCC" onclick="new Calendar().show(this);"  maxlength="10" readonly/>
  <label>��������</label>
  <select id="type" name="type">
    <?php while($RS = mysql_fetch_array($result_inout))echo "<option value='$RS[id]'>$RS[name]</option>";?>
  </select>
  <p><a href="_blank" target="_blank"><img src="/wms/image/delete.gif" alt="��������͹���" width="25" height="19" border="0"/></a></p>
  <label>ҵ��Ա</label>
  <input id="yewuyuan" name="yewuyuan" type="text" />
  </fieldset>
  <textarea name="item_str" id="item_str" hidden></textarea>
  <!--�趨Ϊ������-->
  <fieldset>
  <legend>�����б�</legend>
  <table id="item_list" width="60%" border="1" cellspacing="0" cellpadding="5" style="font-size:12px; border:thin; border-color:#9999FF ">
    <tr align="center">
      <td>��Ʒ���</td>
      <td>��Ʒ����</td>
      <td>����ͺ�</td>
      <td>��λ</td>
      <td>����</td>
      <td>����</td>
      <td>С��</td>
      <td>ɾ��</td>
      <td>�޸�</td>
    </tr>
  </table>
  </fieldset>
  <fieldset>
  <legend>��ӻ�Ʒ</legend>
  <label>���</label>
  <input id="item_id" name="item_id" type="text" onclick="selectitem()" value="����ѡ���Ʒ" size="10" style="background-color:#CCCCCC" readonly />
  <label>����</label>
  <input id="item_name" name="item_name" type="text" size="5" style="background-color:#CCCCCC" readonly />
  <label>���</label>
  <input id="item_model" name="item_model" type="text" size="5" style="background-color:#CCCCCC" readonly />
  <label>��λ</label>
  <input id="item_unit" name="item_unit" type="text" size="5" style="background-color:#CCCCCC" readonly />
  <p>&nbsp;</p>
  <label>����</label>
  <input name="item_num" type="text" id="item_num" onkeyup="value=value.replace(/[^\d]/g,'');numLimit(this)" maxlength="4" />
  <!--onchange="valueLimit(this)"-->
  <label>����</label>
  <input name="item_price" type="text" id="item_price" onkeyup="value=value.replace(/[^.\d]/g,'');valueLimit(this)" maxlength="8" />
  <button type="button" onclick="if(checkInput()==true) addRow();">&nbsp;���&nbsp;</button>
  </fieldset>
  <fieldset>
  <legend>����</legend>
  <label>��ע</label>
  <textarea name="remark" cols="15" rows="3" onkeyup="if(this.innerHTML.length>50) this.innerHTML=this.innerHTML.substr(0,50)"></textarea>
  <button type="submit" style="margin-left:50px">&nbsp;�ύ��&nbsp;</button>
  </fieldset>
</form>
<p><a href="../basic/company/company_show.php">������һҳ</a></p>
</body>
</html>
