<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

<?php
//include "../include.php";
include "../database.php";

$id = $_POST["id"];
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

if($id==''||$name=='')//||$gender==''||$job==''||$phone==''||$address==''||$depart==''
	$error='�ύ�ı�����';
else
{
//	$con = mysql_connect("localhost","root","1234") or die("�������ӵ�Mysql Server");
//	mysql_select_db("db_wms", $con) or die("���ݿ�ѡ��ʧ��");
//	mysql_query("set names gb2312");
	
	$query = "select * from table_company where id = '$id'";//echo $query."<br>";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	if(empty($RS))
		$error = "ID�������޸ĵ�Ŀ�겻���ڣ�";	
	else{
		$query = "update table_company set name='$name',type='$type',contact='$contact',phone='$phone',fax='$fax',email='$email',bank='$bank',bankaccount='$bankaccount',tariff='$tariff',area='$area',province='$province',address='$address',zipcode='$zipcode' where id = '$id'";
		//echo $query;die();
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
		echo "alert('������Ϣʧ��!��������Ϣ�޸�ҳ�棡');";
		echo "var url = 'company_modify.php?id=".$id."';";
	}
	else{
		echo "alert('������Ϣ�ɹ������ع�����棡\\n��ţ� $id\\n���ƣ� $name');\n";
		echo "var url = 'company_show.php';";
	}
}
else{
	echo "alert('$error ����Ա����Ϣ�޸�ҳ�棡');";
	echo "var url = 'company_modify.php?id=".$id."';";
}
?>

location.href=url;
</script>
