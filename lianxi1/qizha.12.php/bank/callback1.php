<?php 
require '../conn/conn2.php';
require '../conn/function.php';

$PID = $C_7PID;
$PKEY = $C_7PKEY;

$json_string=file_get_contents("php://input");
$obj=json_decode($json_string);

$P_address = $obj->P_address;
$P_attach = $obj->P_attach;
$P_city = $obj->P_city;
$P_country = $obj->P_country;
$P_email = $obj->P_email;
$P_mobile = $obj->P_mobile;
$P_money = $obj->P_money;
$P_name = $obj->P_name;
$P_no = $obj->P_no;
$P_num = $obj->P_num;
$P_postcode = $obj->P_postcode;
$P_price = $obj->P_price;
$P_province = $obj->P_province;
$P_qq = $obj->P_qq;
$P_remarks = $obj->P_remarks;
$P_state = $obj->P_state;
$P_time = $obj->P_time;
$P_title = $obj->P_title;
$P_type = $obj->P_type;
$P_url = $obj->P_url;
$sign = $obj->sign;

if(strtolower(MD5("P_address=".$P_address."&P_attach=".$P_attach."&P_city=".$P_city."&P_country=".$P_country."&P_email=".$P_email."&P_mobile=".$P_mobile."&P_money=".$P_money."&P_name=".$P_name."&P_no=".$P_no."&P_num=".$P_num."&P_postcode=".$P_postcode."&P_price=".$P_price."&P_province=".$P_province."&P_qq=".$P_qq."&P_remarks=".$P_remarks."&P_state=".$P_state."&P_time=".$P_time."&P_title=".$P_title."&P_type=".$P_type."&P_url=".$P_url."&pkey=".$PKEY))==strtolower($sign)){ 
	//==============================================================================

	$sql="select * from SL_list where L_no like '".$P_no."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) <= 0) {
	mysqli_query($conn,"update SL_member set M_money=M_money+".$P_money." where M_id=".$P_attach);
	mysqli_query($conn,"insert into SL_list(L_mid,L_title,L_change,L_time,L_no,L_type) values(".$P_attach.",'用户充值',".$P_money.",'".date('Y-m-d H:i:s')."','".$P_no."',0)");
	}

	//==============================================================================
file_put_contents("log/".$P_no.".txt","success");
echo "success";
}else{
echo "fail";
}
?>