<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
include "../basic/include.php";

$date = $_POST[date];
$yewuyuan = $_POST[yewuyuan];
$type = "none";
$warehouse = $_POST[warehouse];
$warehouse2 = $_POST[warehouse2];
$remark = $_POST[remark];
$itemstr = $_POST[item_str];

//echo "$yewuyuan||$date||$warehouse||$warehouse2||$type||$itemstr";die();

if($yewuyuan==''||$date==''||$warehouse==''||$warehouse2==''||$type==''||$itemstr=='' )//$id==''||
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
	if(mysql_query("select * from table_warehouse_$warehouse2")==false)//���Ŀ��ֿ������Ƿ���
		die("�ֿ�$warehouse2�����ڣ�");
		
	$query = "select * from test_exchange where id = '$id'";
	$result = mysql_query($query);
	$RS = mysql_fetch_array($result);
	
	while(!empty($RS)){
		if(($id = next_value($id))!="Overflow!"){//��ȡ����ID
			$query = "select * from test_exchange where id = '$id'";
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
		$query = "insert test_exchange values ('$id', '$date', '$yewuyuan', '$type', '$warehouse', '$warehouse2', '$remark', '$itemstr')";
		$result = mysql_query($query);
	}
	
	//�����Ʒ�б�����������
	$list = explode('|',$itemstr);//print_r($list);
	foreach($list as $str){
		$info = explode('+',$str);//print_r($info);die();
		$item_id = $info[0];
		$item_num = $info[1];
		//$item_price = $info[2];
		
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
			$query = "insert test_inout values ('$inout_id', '$item_id', '$item_num', '0', '$id', '$type')";
			$result = mysql_query($query);
		}
		
		$query = "select * from table_warehouse_$warehouse where id = '$item_id'";//���Ĳֿ�����Ӧ��Ʒ����
		$result = mysql_query($query );
		$RS = mysql_fetch_array($result);
		if(empty($RS)){//����òֿ���֮ǰû�д˻�Ʒ���������Ŀ�����������Ŀ
			$query = "insert table_warehouse_$warehouse values('$item_id' , $item_num )";echo "<br>".$query."<br>";
			mysql_query($query);
		}
		else{
			$RS[num] -= $item_num;
			//$item_num = $RS[num] - $item_num;
			$query = "update table_warehouse_$warehouse set num = $RS[num] where id = '$item_id'";echo "<br>".$query."<br>";
			mysql_query($query);
		}
		
		$query = "select * from table_warehouse_$warehouse2 where id = '$item_id'";//���Ĳֿ�����Ӧ��Ʒ����
		$result = mysql_query($query );
		$RS = mysql_fetch_array($result);
		if(empty($RS)){//����òֿ���֮ǰû�д˻�Ʒ���������Ŀ�����������Ŀ
			$query = "insert table_warehouse_$warehouse2 values('$item_id' , $item_num )";echo "<br>".$query."<br>";
			mysql_query($query);
		}
		else{
			$RS[num] += $item_num;
			//$item_num += $RS[num];
			$query = "update table_warehouse_$warehouse2 set num = $RS[num] where id = '$item_id'";echo "<br>".$query."<br>";
			mysql_query($query);
		}//die();
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
		echo "var url = 'receipt_exchange.php';";
	}
	else{
		echo "alert('��ӳɹ���');\n";
		echo "var url = 'receipt_exchange.php';";
	}
}
else
{
	echo "alert('$error');";
	echo "var url = 'receipt_exchange.php';";
}

echo 'location.href=url;';
echo '</script>'
?>