<?php
//Ȩ����֤����
include("../../const.php");
if ($authority[5]==0){  
	echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
	exit;
}
//Ȩ����֤����

	include "../include.php";
	include "../database.php";
	
	$query="select * from table_itemclassify order by name";//echo $query."<br>";
	$result = mysql_query($query);

	mysql_close();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��Ʒ�������</title>
</head>
<script type="text/javascript"> 
//�Ƴ��ұ����е�ѡ��
function removeAllOption(){
	var right = document.getElementById("right");
	for(;right.length!=0;)
		right.remove(right.options[0]);
}
//����ѡ�е�ѡ����ʾ�ұߵ�ѡ��
function showOption(){
	removeAllOption();
	var left = document.getElementById("left");
	var right = document.getElementById("right");
	
	var option_str = "";
	if(left.selectedIndex != -1)
		var option_str = left.options[left.selectedIndex].value;
		
	var option_list = option_str.split("|");
	var y;
	
	for (i=2;i<option_list.length;i++){
		y = document.createElement('option');
		y.text = option_list[i];
		right.add(y);//right.appendChild(y,null);
	}
}
function checkClassName(){
	var rename = document.getElementById("rename").value;
	var left = document.getElementById("left");
	
	var error;
	for(var i=0;i<left.length;i++){
		if(left.options[i].text==rename && i!=left.selectedIndex){
			alert("�Ѵ����ظ���ѡ�");
			document.getElementById("rename").value = left.options[left.selectedIndex].text;
			error=1;
			return false;
		}
	}
	return true;
}
//���ұ�ѡ�������ʱ���ı����ѡ�е�ѡ���Value
function changeValue(){
	var right = document.getElementById("right");
	var str = "";
	for(i=0;i<right.length;i++)
		if(right.options[i]!=''){
			str+="|";
			str+=right.options[i].text;
		}
	//alert("changeValue(): str = "+str);
	var rename = document.getElementById("rename").value;
	
	var left = document.getElementById("left");
	
	var option_str = "";
	if(left.selectedIndex != -1)
		option_str = left.options[left.selectedIndex].value;
	var option_list = option_str.split("|");
	left.options[left.selectedIndex].value = option_list[0]+"|"+rename+str;
	
	var hidden = document.getElementById("hidden").value = left.options[left.selectedIndex].value;
	document.getElementById('left').disabled=true;
	document.getElementById('new').disabled=true;
	document.getElementById('add').disabled=true;
	document.getElementById('submit').disabled=false;
	
	//alert("changeValue(): value = "+left.options[left.selectedIndex].value);
}
//ɾ�����ѡ�е�ѡ����ҳ����ת
function deleteOptionLeft(){
	var left = document.getElementById("left");
	var url = "";
	if(left.selectedIndex != -1){
		var option_str = left.options[left.selectedIndex].value;
		var option_list = option_str.split("|");
		url = "../sql_delete_bg.php?db=itemclassify&id="+option_list[0];
		if(confirm("ȷ��ɾ����")==true)
		location.href = url;
	}
	//alert("deleteOptionLeft() runing!");
		
}
//ɾ���ұ�ѡ�е�ѡ��ı����ѡ�е�option��Value
function deleteOptionRight(){
	var right = document.getElementById("right");
	right.remove(right.selectedIndex);
	changeValue();
}
//�����ѡ��ı�������ı仯
function changeLeft(){
	var rename = document.getElementById("rename");
	var left = document.getElementById("left");
	rename.value = left.options[left.selectedIndex].text;
	showOption();
	//alert("changeLeft() runing!");
}
//����ұ�ѡ��  (������ж�ѡ���Ƿ��ظ����ж�)
function insertOption(){
	var y = document.createElement('option');
	y.text = document.getElementById("optiontext").value;
	var right = document.getElementById("right");
	
	var error;
	for(var i=0;i<right.length;i++){
		if(right.options[i].text==y.text){
			alert("�Ѵ����ظ���ѡ�");
			error=1;
			break;
		}
	}
	if(error!=1){
		right.add(y); // standards compliant/ IE
		changeValue();
	}
}
function checkForm(){
	alert("checkForm() runing!");
}
//��ѡ�е��ұ�ѡ������
function upOption(){
	var right = document.getElementById('right');
	var text;
	if(right.selectedIndex!=-1&&right.selectedIndex!=0){
		text = right.options[right.selectedIndex].text;
		right.options[right.selectedIndex].text = right.options[right.selectedIndex-1].text;
		right.options[right.selectedIndex-1].text = text;
		right.selectedIndex-=1;
		changeValue()
	}
	//alert("upOption() runing!");
}
//��ѡ�е��ұ�ѡ������
function downOption(){
	var right = document.getElementById('right');
	var text;
	if(right.selectedIndex!=-1&&right.selectedIndex!=right.length-1){
		text = right.options[right.selectedIndex].text;
		right.options[right.selectedIndex].text = right.options[right.selectedIndex+1].text;
		right.options[right.selectedIndex+1].text = text;
		right.selectedIndex+=1;
		changeValue()
	}
	//alert("downOption() runing!");
}
//����µķ���
function addNewClass(){
	if(document.getElementById('new').value!=''){
		var url = 'itemclassify_add_bg.php?name='+document.getElementById('new').value;
		location.href=url;
	}
	//alert("addNewClass() runing!");
}
</script>
<body>
<h3>��Ʒ���ࣨ���ࡢС�ࣩ����</h3>
<form name="item_classify" id="item_classify" method="post" action="itemclassify_modify_bg.php" >
  <input name="hidden" id="hidden" type="hidden" >
  <table border="1" align="left" cellpadding="5" cellspacing="0" bordercolor="#CCCCFF">
    <tr>
      <td valign="top">���ࣺ</td>
      <td><select name="left" size="10" id="left" onChange="changeLeft()" ondblclick="deleteOptionLeft()">
          <!--IE��֧��-->
          <?php 
while($RS=mysql_fetch_array($result))
	echo "<option value='$RS[id]|$RS[name]$RS[lowerclass]'>$RS[name]</option>";
?>
        </select>
      </td>
      <td><input id="new" name="new" type="text" size="5">
        <input name="add" type="button" id="add" onClick="addNewClass()" value="���" size="5">
        <p>
          <input id="rename" name="rename" type="text" size="5" onChange="if(checkClassName()==true) changeValue();">
        </p></td>
      <td valign="top">С�ࣺ</td>
      <td><select name="right" size="10" id="right" ondblclick="deleteOptionRight()">
          <!--IE��֧��-->
          <script language="javascript">showOption();</script>
        </select>
      </td>
      <td><p>
          <input type="button" name="up" value="��" onClick="upOption()">
        </p>
        <p>
          <input id="optiontext" name="optiontext" type="text" size="5" />
          <input name="add" type="button" id="add" value="���" onClick="insertOption()"/>
        </p>
        <p>
          <input type="button" name="down" value="��" onClick="downOption()">
        </p></td>
    </tr>
    <tr>
      <td></td>
      <td><input name="delete_left" type="button" value="ɾ��" onClick="deleteOptionLeft()"></td>
      <td></td>
      <td></td>
      <td><input name="delete_right" type="button" value="ɾ��" onClick="deleteOptionRight()"></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td><input id="submit" type="submit" value="�ύ" disabled />
        <input id="reset" type="button" value="����" onClick="location.reload(true)" /></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</form>
</body>
