<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
include "../basic/include.php";

$date = $_POST[date];
$yewuyuan = $_POST[yewuyuan];
//$type = $_POST[type];
//$company = $_POST[company];
$warehouse = $_POST[warehouse];
$remark = $_POST[remark];
$itemstr = $_POST[item_str];

//echo "$yewuyuan||$date||$company||$warehouse||$type||$itemstr";die();

if($yewuyuan==''||$date==''||$warehouse==''||$itemstr=='' )//$id==''||$company==''||$type==''
	$error='�ύ�ı�����';
else
{	
	$date2 = date("ymd");
	$id = $date2."00";
	$con = mysql_connect("localhost","root","1234") or die("�������ӵ�Mysql Server");
	mysql_select_db("db_wms", $con) or die("���ݿ�ѡ��ʧ��");
	mysql_query("set names gb2312");
	
	if(mysql_query("select * from table_warehouse_$warehouse")==false)//���Ŀ��ֿ����ݱ��Ƿ���
		die("�ֿ�$warehouse�����ڣ�");
		
	$query = "select * from test_check where id = '$id'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	while(!empty($RS)){
		if(($id = next_value($id))!="Overflow!"){//��ȡ����ID
			$query = "select * from test_check where id = '$id'";
			$result = mysql_query($query);
			$RS = mysql_fetch_array($result);
		}
		else{
			$error='��������';
			break;
		}	
	}
	
	if($error=='')//������ⵥ
	{
		$query = "insert test_check values ('$id', '$date', '$yewuyuan', '$warehouse', '$remark', '$itemstr')";
		$result = mysql_query($query);
	}
	mysql_close();
}

echo '<script language="javascript">';
echo 'var url;';

if($error=='')
{
	if($result == FALSE){
		echo "alert('���ʧ�ܣ�');";
		echo "var url = 'receipt_check.php';";
	}
	else{
		echo "alert('��ӳɹ���');\n";
		echo "var url = 'receipt_check.php';";
	}
}
else
{
	echo "alert('$error');";
	echo "var url = 'receipt_check.php';";
}

echo 'location.href=url;';
echo '</script>'
?>