<?php
	include "../include.php";
	include "../database.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>���Ա��</title>
</head>
<script language="javascript">
function checkForm(){
	if(document.getElementById('name').value==''){
		alert("��������Ϊ�գ�");
		document.getElementById('name').focus();
		return false;
	}
	return true;
}
</script>
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
<body>
<h3>���Ա��</h3>
<p>ע��*����Ŀ����Ϊ�գ� </p>
<form id="employee_add" name="employee_add" method="post" action="employee_add_bg.php" onsubmit=" return checkForm()">
  <table border="1" cellpadding="5" cellspacing="0" bordercolor="#9999FF">
    <tr>
      <td align="center">*������</td>
      <td><input id="name" name="name" type="text" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <td align="center">*�Ա�</td>
      <td><input name="gender" type="radio" value="��" checked="checked" />
        ��
        <input name="gender" type="radio" value="Ů" />
        Ů</td>
    </tr>
    <tr>
      <td align="center">*ְλ��</td>
      <td><input name="job" type="text" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <td align="center">*���ţ�</td>
      <td><select name="depart">
          <?php 
			$query = "select name from table_depart";
			$result = mysql_query($query);
			
			$i = 0;
			while($RS = mysql_fetch_array($result)){
				echo "<option value='".$RS['name']."'>".$RS['name']."</option>";	
				$i++;	
			}
			if($i == 0)
				die("û�в�����Ϣ������Ӳ��ź������Ա��");	
		  ?>
        </select>
      </td>
    </tr>
    <tr>
      <td align="center">*�ֻ���</td>
      <td><input name="phone" type="text" size="12" maxlength="11" 
		onkeyup="value=value.replace(/[^\d]/g,'')"
		onblur="if(value.length!=11) document.getElementById('span1').innerHTML='�ֻ��������';else document.getElementById('span1').innerHTML=''"
		/>
        <span id="span1"></span></td>
    </tr>
    <tr>
      <td align="center">*סַ��</td>
      <td><input name="address" type="text" size="40" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center"><input name="submit" type="submit" value="�ύ" />
      </td>
      <td><input name="submit" type="reset" value="����" />
      </td>
    </tr>
  </table>
  <p><a href="employee_show.php">������һҳ</a></p>
</form>
</body>
</html>
