<?php  
//include("config.php");
//实现跨域，关键在于服务器，客户端的代码按照正常的方式编写即可。对于服务器，只需要在收到OPTIONS请求的地方，返回的头信息中增加该属性即可
header("Access-Control-Allow-Origin:*"); //*号表示所有域名都可以访问  
header("Access-Control-Allow-Method:POST,GET");  
 
header("Content-type: text/html;charset=utf-8");
//过虑回车键，空格键之类
 
function unhtml($str) 
{ 
$str = strip_tags($str,"");
$str = ereg_replace("\t","",$str);
$str = ereg_replace("\r\n","",$str);
$str = ereg_replace("\r","",$str);
$str = ereg_replace("\n","",$str);
$str = ereg_replace(" "," ",$str); 
$str = ereg_replace("VALUES","[***]",$str); 
$str = ereg_replace("values","[***]",$str); 
$str = ereg_replace("INTO","[***]",$str); 
$str = ereg_replace("into","[***]",$str); 
$str = ereg_replace("DELETE","[***]",$str); 
$str = ereg_replace("delete","[***]",$str); 
$str = ereg_replace("FROM","[***]",$str); 
$str = ereg_replace("from","[***]",$str); 
$str = ereg_replace("INSERT","[***]",$str); 
$str = ereg_replace("insert","[***]",$str); 
$str = str_replace(array("i", "I", "d", "D", "O", "o", "u", "U", "V", "v", "=", "?", "&", "q", "Q", "("), "[*]", $str); 
return $str; 
} 
function getIP() { 
if (getenv('HTTP_CLIENT_IP')) { 
$ip = getenv('HTTP_CLIENT_IP'); 
} 
elseif (getenv('HTTP_X_FORWARDED_FOR')) { 
$ip = getenv('HTTP_X_FORWARDED_FOR'); 
} 
elseif (getenv('HTTP_X_FORWARDED')) { 
$ip = getenv('HTTP_X_FORWARDED'); 
} 
elseif (getenv('HTTP_FORWARDED_FOR')) { 
$ip = getenv('HTTP_FORWARDED_FOR'); 
 
} 
elseif (getenv('HTTP_FORWARDED')) { 
$ip = getenv('HTTP_FORWARDED'); 
} 
else { 
$ip = $_SERVER['REMOTE_ADDR']; 
} 
return $ip; 
} 
 
//判断电话号码
if(preg_match("/^1[345768]{1}\d{9}$/",$_POST['phone'])){  //是手机号码
	// 预处理及绑定
	$enterprise_id = trim($_POST['enterprise_id']);
	
	//判定企业id是否正确
	$enterprise_m_id=$enterprise_id;
	$sql_d9 = "Select id FROM data_enterprise where id=".$enterprise_m_id;
	$result_d9 = mysqli_query($conn, $sql_d9);  
	$rs_d9 = mysqli_fetch_assoc($result_d9);  
	$rs_d9_id=$rs_d9['id'];	
	
	
	if($enterprise_id=="" || is_numeric($enterprise_id)==false || $rs_d9_id==""){//没有填写企业ID
	      $datausername="data_guestbook";		
	}else{
	      $datausername=$enterprise_id."_data_guestbook";	
	}
	
 
	$stmt = $conn->prepare("INSERT INTO ".$datausername." (project, ad, type1, type2, type3, type4, type5, title, username, content, url, qq, phone, wx, email, admin_name,enterprise_id,ip,checkbox1,checkbox2,checkbox3,checkbox4,checkbox5,c1,c2,c3,c4,c5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?)");
	$stmt->bind_param("ssssssssssssssssssssssssssss", $project, $ad, $type1, $type2, $type3, $type4, $type5, $title, $username, $content, $url, $qq, $phone, $wx, $email, $admin_name,$enterprise_id,$ip,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$c1,$c2,$c3,$c4,$c5);
	 
	// 设置参数并执行
 
	$project = trim($_POST['project']);
	$ad = $_POST['ad']=="undefined"?"":trim($_POST['ad']);
	$type1 =$_POST['type1']=="undefined"?"":trim($_POST['type1']);
	
	$type2 = $_POST['type2']=="undefined"?"":trim($_POST['type2']);
	$type3 = $_POST['type3']=="undefined"?"":trim($_POST['type3']);
	$type4 = $_POST['type4']=="undefined"?"":trim($_POST['type4']);
	$type5 = $_POST['type5']=="undefined"?"":trim($_POST['type5']);
	
	$checkbox1 = $_POST['checkbox1']=="undefined"?"":trim($_POST['checkbox1']);
	$checkbox2 = $_POST['checkbox2']=="undefined"?"":trim($_POST['checkbox2']);
	$checkbox3 = $_POST['checkbox3']=="undefined"?"":trim($_POST['checkbox3']);
	$checkbox4 = $_POST['checkbox4']=="undefined"?"":trim($_POST['checkbox4']);
	$checkbox5 = $_POST['checkbox5']=="undefined"?"":trim($_POST['checkbox5']);
	
    $c1 = $_POST['c1']=="undefined"?"":trim($_POST['c1']);
	$c2 = $_POST['c2']=="undefined"?"":trim($_POST['c2']);
	$c3 = $_POST['c3']=="undefined"?"":trim($_POST['c3']);
	$c4 = $_POST['c4']=="undefined"?"":trim($_POST['c4']);
	$c5 = $_POST['c5']=="undefined"?"":trim($_POST['c5']);
	
	$title = $_POST['title']=="undefined"?"":trim($_POST['title']);
	
	$username = $_POST['username']=="undefined"?"":trim($_POST['username']);
	$content = $_POST['content']=="undefined"?"":trim($_POST['content']);
	$url = $_POST['url']=="undefined"?"":trim($_POST['url']);
	
	$qq = $_POST['qq']=="undefined"?"":trim($_POST['qq']);
	$phone = trim($_POST['phone']);
	$wx = $_POST['wx']=="undefined"?"":trim($_POST['wx']);
	
	$email = $_POST['email']=="undefined"?"":trim($_POST['email']);
	$admin_name = trim($_POST['admin_name']);
	
	$enterprise_id = trim($_POST['enterprise_id']);
	$ip=getIP();
	//$ip=$_SERVER["REMOTE_ADDR"]; 
	//$ip = "127.0.0.1"; 
	
	//判断手机号码是否已经存在
	$sql_dt = "Select id,phone,time FROM ".$datausername." where phone=".$phone;
	$result_dt = mysqli_query($conn, $sql_dt);
	$v_result = mysqli_fetch_assoc($result_dt); 
	if (mysqli_num_rows($result_dt) > 0) {	//已经存在电话
		//判断时间大于7天后就能重新注册
		//$msg=9; 
		//echo $msg;
		
		 
		 $zero1=date("Y-m-d");  
		 $zero2=$starttime=date("Y-m-d", strtotime("+7 days", strtotime($v_result['time'])));//+7；从现在时间将来7  
		 if(strtotime($zero1)<strtotime($zero2)){//不够7天，不能申请
				$msg=9; 
				echo $msg;
		      //echo "zero1早于zero2";  
		 }else{
			   $stmt->execute();
				$msg=1; 
				echo $msg;
		      //echo "zero2早于zero1";  
		 } 
	} else {//不存在记录，就添加
	    $stmt->execute();
		$msg=1; 
		echo $msg;
	}
	
	
	$stmt->close();
	$conn->close();
}else{ //不是手机号码
    $msg=1;  
	 echo $msg;
}
 
//输出结果
//$msg=1; 
//$msg='电话：'.$_POST['phone'].',project：'.$_POST['project'].',ad：'.$_POST['ad'].',type1：'.$_POST['type1'].',type2：'.$_POST['type2'].',type3：'.$_POST['type3'].',title：'.$_POST['title'].',username：'.$_POST['username'].',content：'.$_POST['content'].',url：'.$_POST['url'].',qq：'.$_POST['qq'].',wx：'.$_POST['wx'].',email：'.$_POST['email'].',admin_name：'.$_POST['admin_name'];
//echo $msg;
  