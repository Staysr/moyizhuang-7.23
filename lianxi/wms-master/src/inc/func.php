<?php
session_start();

function w_log($act){
	$filename = "log.txt";
	if(file_exists($filename)){
		$f_open = fopen($filename,"a+");
	}
	else
	{
		$f_open = fopen($filename,"w+");
	}
		$str = $_SESSION['username'].",".date("Y-m-d H:i:s").",".$_SERVER['REMOTE_ADDR'].",".$act."\n";
		fwrite($f_open,$str);
		fclose($f_open);
}
//ɾ��ϵͳ��־
function c_log(){
	$filename="../log.txt";
	if(file_exists($filename))
		unlink($filename);
	else
		echo "<script>alert('����ϵͳ��־��');history.go(-1);</script>";
}


//�����ļ����µ��ļ��б�
function show_file(){
	$folder_name = "sql";
	$d_open = opendir($folder_name);
	$num = 0;
	while($file = readdir($d_open)){
		$filename[$num] = $file;
		$num++; 
	}
	closedir($d_open);
	return $filename;
}
//��ȡ�ֶ�
//$conn,���ݿ�����
//$dataname�����ݱ�����
//$fieldname��Ҫ�����ֶ�
//$n_id������id��
function read_field($conn,$tablename,$fieldname,$n_id){
	$sqlstr = "select ".$fieldname." from ".$tablename." where id = ".$n_id;
	$result = mysql_query($sqlstr,$conn);
	$rows = mysql_fetch_row($result);
	return $rows[0];
}
?>