<?php
	session_start();
	include "../conn/conn.php";
	//if($_SESSION[username]="") then

$pwd_old=$_POST[pwd_old];
$pwd_new=$_POST[pwd_new];
    $sql=mysql_query("select * from tb_admin where name='".$_SESSION[username]."' and pwd='".md5($pwd_old)."'",$conn);
    $info=mysql_fetch_array($sql);
if($info==false)
{

    echo "<script>alert('ԭ�������!');history.back();</script>";
    exit;
}

else
	{
	
	    mysql_query("update tb_admin set pwd='".md5(pwd_new)."' where name='".$_SESSION[username]."'",$conn);
	    echo "<script>alert('�����޸ĳɹ�!');window.location='../desk.php';</script>";
	   
	}
	
?>
