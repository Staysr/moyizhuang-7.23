<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
include "../basic/include.php";

$date = $_POST[date];
$yewuyuan = $_POST[yewuyuan];
$type = $_POST[type];
$company = $_POST[company];
$warehouse = $_POST[warehouse];
$remark = $_POST[remark];
$itemstr = $_POST[item_str];

//echo "$yewuyuan||$date||$company||$warehouse||$type||$itemstr";die();

if($yewuyuan==''||$date==''||$company==''||$warehouse==''||$type==''||$itemstr=='' )//$id==''||
	$error='�ύ�ı�����';
else
{	
	$date2 = date("ymd");
	$id = $date2."00";
	$con = mysql_connect("localhost","root","1234") or die("�������ӵ�Mysql Server");
	mysql_select_db("db_wms", $con) or die("���ݿ�ѡ��ʧ��");
	mysql_query("set names gb2312");
	
	if(mysql_query("select * from table_warehouse_$warehouse")==false)//���Ŀ��ֿ������Ƿ���
		die("�ֿ�$warehouse�����ڣ�");
		
	$query = "select * from test_receipt where id = '$id'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	while(!empty($RS)){
		if(($id = next_value($id))!="Overflow!"){//��ȡ����ID
			$query = "select * from test_receipt where id = '$id'";
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
		$query = "insert test_receipt values ('$id', '$date', '$yewuyuan', '$type', '$company', '$warehouse', '$remark', '$itemstr')";
		$result = mysql_query($query);
	}
	
	//�����Ʒ�б�����������
	$list = explode('|',$itemstr);//print_r($list);
	foreach($list as $str){
		$info = explode('+',$str);//print_r($info);
		$item_id = $info[0];
		$item_num = $info[1];
		$item_price = $info[2];
		
		$inout_id = $date2."00";
		$query = "select * from test_inout where id = '$inout_id'";
		$result = mysql_query($query);
		$RS = mysql_fetch_array($result);
		while(!empty($RS)){
			if(($inout_id = next_value($inout_id))!="Overflow!"){//��ȡ����ID
				$query = "select * from test_inout where id = '$inout_id'";
				$result = mysql_query($query);
				$RS = mysql_fetch_array($result);
			}
			else{
				$error='��������';
				break;
			}	
		}
		if($error=='')//��������¼
		{
			$query = "insert test_inout values ('$inout_id', '$item_id', '$item_num', '$item_price', '$id', '$type')";
			$result = mysql_query($query);
		}
		
		$query = "select * from table_warehouse_$warehouse where id = '$item_id'";//���Ĳֿ�����Ӧ��Ʒ����
		$result = mysql_query($query );
		$RS = mysql_fetch_array($result);
		if(empty($RS)){//����òֿ���֮ǰû�д˻�Ʒ���������Ŀ�����������Ŀ
			$query = "insert table_warehouse_$warehouse values('$item_id' , $item_num )";//echo "<br>".$query."<br>";
			mysql_query($query);
		}
		else{
			$item_num += $RS[num];
			$query = "update table_warehouse_$warehouse set num = $item_num where id = '$item_id'";//echo "<br>".$query."<br>";
			mysql_query($query);
		}
	}
	
//	for($i=0;$i<$list.length;$i++){
//		$info = explode('+',$list[$i]);
//		$item_id = $info[0];
//		$item_num = $info[1];
//		$item_price = $info[2];
//		if(($result = mysql_query("select * from table_warehouse_$warehouse where id = '$item_id'"))==true){
//			$RS = mysql_fetch_array($result);
//			$item_num += $RS[num];
//			mysql_query("insert table_warehouse_$warehouse values('$item_id' , $item_num , $item_price)");
//		}
//	}
	mysql_close();
}

echo '<script language="javascript">';
echo 'var url;';

if($error=='')
{
	if($result == FALSE){
		echo "alert('���ʧ�ܣ�');";
		echo "var url = 'receipt_in.php';";
	}
	else{
		echo "alert('��ӳɹ���');\n";
		echo "var url = 'receipt_in.php';";
	}
}
else
{
	echo "alert('$error');";
	echo "var url = 'receipt_in.php';";
}

echo 'location.href=url;';
echo '</script>'
?>