<?php
//Ȩ����֤����
include("../../const.php");
if ($authority[7]==0){  
	echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
	exit;
}
//Ȩ����֤����

	include "../include.php";
	include "../database.php";
	
	$query="select * from table_measureunit";//echo $query."<br>";
	$result = mysql_query($query);

	mysql_close();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������λ����</title>
</head>
<script language="javascript">
//ɾ��ĳ����λ��������
function removeUnit(){
	var x = document.getElementById("unit_list");
	if(x.selectedIndex != -1){
		var url = "../sql_delete_bg.php?db=measureunit&id="+x.options[x.selectedIndex].value;
		if(confirm("ȷ��ɾ����")==true)
		location.href = url;
	}
	//alert("deleteOptionLeft() runing!");	
}
//ɾ��ĳ����λ��������
//��鵥λ�����Ƿ�Ϊ�ջ����б����Ƿ���ڣ�������ν��������������
function checkForm(){
	var x = document.getElementById("unit_list");
	var y = document.getElementById("name");
	if(y.value == ''){
		alert("������λ���Ʋ�Ϊ�գ�");
		return false;
	}
	for(var i=0;i<x.length;i++)
		if(y.value == x.options[i].text){
			alert("�ü�����λ�Ѵ��ڣ�");
			return false;
		}
	return true;
	//alert("deleteOptionLeft() runing!");	
}
//��鵥λ�����Ƿ�Ϊ�ջ����б����Ƿ���ڣ�������ν��������������
</script>
<body style="width:800px">
<h3>������λ/���ʹ���</h3>
<form id="unitForm" name="unitForm" method="post" action="measureunit_add_bg.php" onsubmit="return checkForm()">
  <table border="1" cellpadding="5" cellspacing="0" bordercolor="#CC99FF">
    <tr valign="top" align="left">
      <td>���е�λ��</td>
      <td>
        <select id="unit_list" name="unit_list" size="10" ondblclick="removeUnit()">
          <?php while($RS=mysql_fetch_array($result)) echo "<option value='$RS[id]'>$RS[name]</option>"; ?>
        </select></td>
      <td>&nbsp;
        <input id="name" name="name" type="text" size="5" />
        <input name="add" type="submit" value="���" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="remove" type="button" id="remove" value="ɾ��" onClick="removeUnit()"/></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<p><a href="">������һҳ</a></p>
</body>
</html>
