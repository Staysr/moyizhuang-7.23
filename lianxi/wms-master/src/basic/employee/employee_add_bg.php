<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
	include "../include.php";
	include "../database.php";

$name = $_POST["name"];
$gender = $_POST["gender"];
$job = $_POST["job"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$depart = $_POST["depart"];

if($name==''||$gender==''||$job==''||$phone==''||$address==''||$depart=='')
	$error='�ύ�ı�����';
else
{
	$date = date("ymd");
	$id = $date."00";
	
	$query = "select * from table_employee where id = '$id'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	while(!empty($RS)){
		if(($id=next_value($id))!="Overflow!"){
			$query = "select * from table_employee where id = '$id'";
			$result = mysql_query($query);
			$RS = mysql_fetch_array($result);
		}
		else{
			$error='��������';
			break;
		}	
	}
	if($error==''){
		$query = "insert table_employee values ('$id', '$name', '$gender', '$job', '$phone', '$address','$depart')";
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
		echo "alert('���Ա��ʧ�ܣ�����Ա�����ҳ�棡');";
		echo "var url = 'employee_add.php';";
	}
	else{
		echo "alert('���Ա���ɹ�������Ա��������棡\\n��ţ� $id\\n������ $name\\n�Ա� $gender\\nְλ�� $job\\n�ֻ��� $phone\\nסַ�� $address\\n�������ţ� $depart');\n";
		echo "var url = 'employee_show.php';";
	}
}
else
{
	echo "alert('$error ����Ա�����ҳ�棡');";
	echo "var url = 'employee_add.php';";
}
?>

location.href=url;
</script>





