<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ֿ���Ϣ�޸�</title>
</head>
<?php
	include "../include.php";
	include "../database.php";
	
	$id=$_GET["id"];
	if($id=="")die("�������ݴ���");
	
	$query="select * from table_warehouse where id=$id";//echo $query."<br>";
	$result=mysql_query($query);
	$RS=mysql_fetch_array($result);
	if(empty($RS))
		$error="ָ����Ŀ�겻����!";
	mysql_close();
?>
<body>
<h3>�ֿ���ϸ��Ϣ</h3>
<form id="warehouse_modify" name="warehouse_modify" method="post" action="warehouse_modify_bg.php">
  <table border="1" cellpadding="5" cellspacing="0" bordercolor="#9999FF">
    <tr>
      <td align="center">�ֿ��ţ�</td>
      <td><input name="id" type="text" value="<?php echo $RS['id']; ?>" size="6" style="background-color:#CCCCCC" readonly/></td>
    </tr>
	<tr>
      <td align="center">�ֿ����ƣ�</td>
      <td><input name="name" type="text" value="<?php echo $RS['name']; ?>" size="6" /></td>
    </tr>
    <tr>
      <td align="center">�����ˣ�</td>
      <td><input name="fuzeren" type="text" value="<?php echo $RS['fuzeren']; ?>" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <td align="center">�ֿ�绰��</td>
      <td><input name="phone" type="text" value="<?php echo $RS['phone']; ?>" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <td align="center">�ֿ��ַ��</td>
      <td><input name="address" type="text" value="<?php echo $RS['address']; ?>" size="30" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center">��ע��</td>
      <td><input name="remark" type="text" value="<?php echo $RS['remark']; ?>" size="30" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center"><input type="submit" name="Submit" value="�ύ" /></td>
      <td><input name="reset" type="reset" id="reset" value="�ָ�" /></td>
    </tr>
  </table>
  <p>&nbsp;<a href="warehouse_show.php">������һҳ</a></p>
</form>
<script language="javascript">
var url;

<?php
if($error!=''){
	echo "alert('$error �뷵��Ա����Ϣ����ҳ�棡');";
	echo "var url = 'warehouse_show.php';";
	echo "location.href=url;";
}
?>
</script>
</body>
</html>
