<?php
require_once("./conn/conn.php");
require_once("./conn/function.php");
session_start();
?>
<?php
$page=intval($_GET['page']);
$kspage=($page-1)*10;
$jspage=$kspage+10;
@$pengyou_user=$_SESSION['pengyou_user'];
if($pengyou_user){
	$sql='select * from pengyou_content limit '.$kspage.','.$jspage.'';
	$zxsql=mysql_query($sql);
	$pcont=array();
	while($cxsql=mysql_fetch_assoc($zxsql)){
		$zcont=array();
		$username=$cxsql['username'];
		$sql1='select * from pengyou_user where username= "'.$username.'"';
		$zxsql1=mysql_query($sql1);
		$hqsql1=mysql_fetch_assoc($zxsql1);
		$name='';
		$vip='';
		if($hqsql1['name']){
			$name=$hqsql1['name'];
		}else{
			$name=$username;
		}
		if($hqsql1['vip']==0){
			$vip='';
		}elseif($hqsql1['vip']==1){
			$vip="'<img src=\"images/icon/v1.png\">'";
		}elseif($hqsql1['vip']==2){
			$vip="<img src=\"images/icon/v2.png\">";
		}
		$zcont[]=$name;
		$zcont[]=$vip;
		$pcont[]=$zcont;
	};
	$fhjson=urldecode(json_encode($pcont));
	print_r($fhjson);
}

//echo '{"success":true,"msg":"成功"}';

?>