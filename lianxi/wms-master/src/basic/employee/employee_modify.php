<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Ա����Ϣ�޸�</title>
</head>
<?php
	include "../include.php";
	include "../database.php";

	$id=$_GET["id"];
	if($id=="")die("�������ݴ���");
	
	$query="select * from table_employee where id=$id";//echo $query."<br>";
	$result=mysql_query($query);
	$RS=mysql_fetch_array($result);
	if(empty($RS))
		$error="ָ�����û�������!";
	else{
		$query = "select name from table_depart";
		$result = mysql_query($query);
	}
	mysql_close();
?>
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
<h3>Ա����ϸ��Ϣ</h3>
<form id="employee_modify" name="employee_modify" method="post" action="employee_modify_bg.php">
  <table border="1" cellpadding="5" cellspacing="0" bordercolor="#9999FF">
    <tr>
      <td align="center">Ա����ţ�</td>
      <td><input name="id" type="text" value="<?php echo $RS['id']; ?>" size="6" readonly /></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center">Ա��������</td>
      <td><input name="name" type="text" value="<?php echo $RS['name']; ?>" size="10" maxlength="10" /></td>
      <td align="center">�Ա�</td>
      <td><input name="gender" type="radio" value="��" <?php if($RS['gender']=='��') echo "checked='checked'"; ?> />
        ��
        <input name="gender" type="radio" value="Ů" <?php if($RS['gender']=='Ů') echo "checked='checked'"; ?>/>
        Ů</td>
    </tr>
    <tr>
      <td align="center">ְλ��</td>
      <td><input name="job" type="text" value="<?php echo $RS['job']; ?>" size="10" maxlength="10" /></td>
      <td align="center">���ţ�</td>
      <td><select name="depart">
          <?php
if($error==''){
	$i = 0;
	while($RS2 = mysql_fetch_array($result)){
		$string="";
		if($RS['depart']==$RS2['name']){
			$string=" selected='selected' ";
		}
		echo "<option value='".$RS2['name']."'$string>".$RS2['name']."</option>";
		$i++;	
	}
	if($i == 0)
		$error="û�в�����Ϣ������Ӳ��ź������Ա��";
}
?>
        </select>
      </td>
    </tr>
    <tr>
      <td align="center">�ֻ���</td>
      <td><input name="phone" type="text" value="<?php echo $RS['phone']; ?>" size="12" maxlength="11" onkeyup="value=value.replace(/[^\d]/g,'')"/></td>
      <td align="center">סַ��</td>
      <td><input name="address" type="text" value="<?php echo $RS['address']; ?>" size="30" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td><input type="submit" name="Submit" value="�ύ" /></td>
      <td align="center"><input name="reset" type="reset" id="reset" value="�ָ�" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;<a href="employee_show.php">������һҳ</a></p>
</form>
<script language="javascript">
var url;
<?php
if($error!=''){
	echo "alert('$error �뷵��Ա����Ϣ����ҳ�棡');";
	echo "var url = 'employee_show.php';";
	echo "location.href=url;";
}
?>
</script>
</body>
</html>
