<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

<?php
	include "../include.php";
	include "../database.php";

$id = $_POST["id"];
$name = $_POST["name"];
$major = $_POST["major"];
$phone = $_POST["phone"];


if($id==''||$name=='')//||$major==''||$phone==''
	$error='�ύ�ı�����';
else{
	$query = "select * from table_depart where id = '$id'";//echo $query."<br>";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	if(empty($RS))
		$error = "ID�������޸ĵ�Ŀ�겻���ڣ�";	
	else{
		$query = "update table_depart set name='$name',major='$major',phone='$phone' where id = '$id'";//,major='$major',phone='$phone'
		$result = mysql_query($query);
	}
	mysql_close();
}
?>

<script language="javascript">
var url;

<?php
if($error==''){
	if($result == FALSE){
		echo "alert('���²�����Ϣʧ��!�����ز�����Ϣ�޸�ҳ�棡');";
		echo "var url = 'depart_modify.php?id=".$id."';";
	}
	else{
		echo "alert('���²�����Ϣ�ɹ������ز��Ź�����棡\\n���ű�ţ� $id\\n�������ƣ� $name\\n�������ܣ� $major\\n��ϵ�绰�� $phone');\n";
		echo "var url = 'depart_show.php';";
	}
}
else{
	echo "alert('$error ���ز�����Ϣ�޸�ҳ�棡');";
	echo "var url = 'depart_modify.php?id=".$id."';";
}
?>

location.href=url;
</script>
