<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

<?php
	include "../include.php";
	include "../database.php";

$id = "0000";
$name = $_POST["name"];
$major = $_POST["major"];
$phone = $_POST["phone"];

if($id==''||$name=='')
	$error='�ύ�ı�����';
else{
	$query = "select * from table_depart where name = '$name'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	if(!empty($RS))
		$error="�ò����Ѵ��ڣ�";
	
	$query = "select * from table_depart where id = '$id'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	while(!empty($RS)){
		if(($id=next_value($id))!="Overflow!"){
			$query = "select * from table_depart where id = '$id'";
			$result = mysql_query($query);
			$RS = mysql_fetch_array($result);
		}
		else{
			$error='��������';
			break;
		}
	}	
	if($error=='')
	{
		$query = "insert table_depart values ('$id', '$name', '$major', '$phone')";
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
		echo "alert('��Ӳ���ʧ�ܣ����ز������ҳ�棡');";
		echo "var url = 'depart_add.php';";
	}
	else{
		echo "alert('��Ӳ��ųɹ������ز��Ź�����棡\\n���ű�ţ� $id\\n�������ƣ� $name\\n�������ܣ� $major\\n���ŵ绰�� $phonet');\n";
		echo "var url = 'depart_show.php';";
	}
}
else
{
	echo "alert('$error ���ز������ҳ�棡');";
	echo "var url = 'depart_add.php';";
}
?>
location.href=url;
</script>