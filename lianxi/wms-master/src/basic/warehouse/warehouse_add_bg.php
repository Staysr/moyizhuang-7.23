<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
	include "../include.php";
	include "../database.php";

$name = $_POST["name"];
$fuzeren = $_POST["fuzeren"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$remark = $_POST["remark"];

if($name=='')//||$fuzeren==''||$phone==''||$address==''||$remark==''
	$error='�ύ�ı�����';
else{
	$id = "0000";

	$query = "select * from table_warehouse where name = '$name'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	if(!empty($RS))
		$error='�ֿ������Ѵ��ڣ�';
	else{
		$query = "select * from table_warehouse where id = '$id'";
		$result = mysql_query($query);
		$RS = mysql_fetch_array($result);
		
		while(!empty($RS)){
			if(($id=next_value($id))!="Overflow!")
			{
				$query = "select * from table_warehouse where id = '$id'";
				$result = mysql_query($query);
				$RS = mysql_fetch_array($result);
			}
			else
			{
				$error='��������';
				break;
			}	
		}
	}
	if($error=='')
	{
		$query = "insert table_warehouse values ('$id', '$name', '$fuzeren', '$phone', '$address','$remark')";
		$result = mysql_query($query);
		$query = "create table `table_warehouse_$id` (`id` varchar(8) NOT NULL , `num` int(4) NULL , PRIMARY KEY (`id`))";
		//die($query);
		mysql_query($query);
	}
	mysql_close();
}
?>



<?php
echo '<script language="javascript">';
echo 'var url;';

if($error=='')
{
	if($result == FALSE){
		echo "alert('��Ӳֿ�ʧ�ܣ����زֿ����ҳ�棡');";
		echo "var url = 'warehouse_add.php';";
	}
	else{
		echo "alert('��Ӳֿ�ɹ������زֿ������棡\\n��ţ� $id\\n�ֿ����ƣ� $name\\n�����ˣ� $fuzeren\\n�ֿ�绰�� $phone\\n�ֿ��ַ�� $address\\n��ע�� $remark');\n";
		echo "var url = 'warehouse_show.php';";
	}
}
else
{
	echo "alert('$error ���زֿ����ҳ�棡');";
	echo "var url = 'warehouse_add.php';";
}


echo 'location.href=url;';
echo '</script>';

?>



