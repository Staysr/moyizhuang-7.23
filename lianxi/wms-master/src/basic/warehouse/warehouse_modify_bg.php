<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
	include "../include.php";
	include "../database.php";
	
$id = $_POST["id"];
$name = $_POST["name"];
$fuzeren = $_POST["fuzeren"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$remark = $_POST["remark"];

if($name=='')//||$fuzeren==''||$phone==''||$address==''||$remark==''
	$error='�ύ�ı�����';
else
{	
	$query = "select * from table_warehouse where id = '$id'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	if(empty($RS))
		$error='ID�������޸ĵ�Ŀ�겻���ڣ�';
	else{
		$query = "select * from table_warehouse where name = '$name'";
		$result = mysql_query($query);
		$RS = mysql_fetch_array($result);
		if(!empty($RS)&&($RS['name']!=$name))
			$error='�ֿ������ظ���';
	}
	
	if($error=='')
	{
		$query = "update table_warehouse set name='$name',fuzeren='$fuzeren',phone='$phone',address='$address',remark='$remark' where id = '$id'";
		$result = mysql_query($query);
	}
	mysql_close();
}
?>

<script language="javascript">
var url;

<?php
if($error=='')
{
	if($result == FALSE){
		echo "alert('�޸Ĳֿ���Ϣʧ�ܣ����زֿ��޸�ҳ�棡');";
		echo "var url = 'warehouse_modify.php?id=".$id."';";
	}
	else{
		echo "alert('�޸Ĳֿ���Ϣ�ɹ������زֿ������棡\\n��ţ� $id\\n�ֿ����ƣ� $name\\n�����ˣ� $fuzeren\\n�ֿ�绰�� $phone\\n�ֿ��ַ�� $address\\n��ע�� $remark');\n";
		echo "var url = 'warehouse_show.php';";
	}
}
else
{
	echo "alert('$error ���زֿ����ҳ�棡');";
	echo "var url = 'warehouse_modify.php?id=".$id."';";
}
?>

location.href=url;
</script>





