<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

<?php
include "../include.php";
include "../database.php";

$id = "0000";
$name = $_POST["name"];
$type = $_POST["type"];
$contact = $_POST["contact"];
$phone = $_POST["phone"];
$fax = $_POST["fax"];
$email = $_POST["email"];
$bank = $_POST["bank"];
$bankaccount = $_POST["bankaccount"];
$tariff = $_POST["tariff"];
$area = $_POST["area"];
$province = $_POST["province"];
$address = $_POST["adress"];
$zipcode = $_POST["zipcode"];

if($id==''||$name=='')//||$contact==''||$phone==''||$fax==''||...
	$error='�ύ�ı�����';
else{
//	$con = mysql_connect("localhost","root","1234") or die("�������ӵ�Mysql Server");
//	mysql_select_db("db_wms", $con) or die("���ݿ�ѡ��ʧ��");
//	mysql_query("set names gb2312");
	
	$query = "select * from table_company where name = '$name'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	if(!empty($RS))
		$error="�������Ѵ��ڣ�";
	
	$query = "select * from table_company where id = '$id'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	while(!empty($RS)){
		if(($id=next_value($id))!="Overflow!")
		{
			$query = "select * from table_company where id = '$id'";
			$result = mysql_query($query);
			$RS = mysql_fetch_array($result);
		}
		else
		{
			$error='��������';
			break;
		}
	}	
	if($error=='')
	{
		$query = "insert table_company values ('$id', '$name', '$type', '$contact', '$phone', '$fax', '$email', '$bank', '$bankaccount', '$tariff', '$area', '$province', '$address', '$zipcode')";
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
		echo "alert('���ʧ�ܣ��������ҳ�棡');";
		echo "var url = 'company_add.php';";
	}
	else{
		echo "alert('��ӳɹ������ع�����棡\\n��ţ� $id\\n���ƣ� $name\\n');\n";
		echo "var url = 'company_show.php';";
	}
}
else
{
	echo "alert('$error �������ҳ�棡');";
	echo "var url = 'company_add.php';";
}
?>
location.href=url;
</script>