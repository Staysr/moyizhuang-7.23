<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
	include "../include.php";
	include "../database.php";

$id = $_POST["id"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$job = $_POST["job"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$depart = $_POST["depart"];

if($id==''||$name==''||$gender==''||$job==''||$phone==''||$address==''||$depart=='')
	$error='�ύ�ı�����';
else{	
	$query = "select * from table_employee where id = '$id'";//echo $query."<br>";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	if(empty($RS))
		$error = "ID�������޸ĵ�Ŀ�겻���ڣ�";	
	else{
		$query = "update table_employee set name='$name',gender='$gender',job='$job',phone='$phone',address='$address',depart='$depart' where id = '$id'";
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
		echo "alert('����Ա����Ϣʧ��!������Ա����Ϣ�޸�ҳ�棡');";
		echo "var url = 'employee_modify.php?id=".$id."';";
	}
	else{
		echo "alert('����Ա����Ϣ�ɹ�������Ա��������棡\\n��ţ� $id\\n������ $name\\n�Ա� $gender\\nְλ�� $job\\n��ϵ�绰�� $phone\\nסַ�� $address\\n�������ţ� $depart');\n";
		echo "var url = 'employee_show.php';";
	}
}
else{
	echo "alert('$error ����Ա����Ϣ�޸�ҳ�棡');";
	echo "var url = 'employee_modify.php?id=".$id."';";
}
?>

location.href=url;
</script>
