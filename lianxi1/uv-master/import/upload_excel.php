<?

include("function.php"); 
header("Content-Type:text/html;charset=utf-8");
if($_POST['import']=="导入数据"){

	$leadExcel=$_POST['leadExcel'];
	
	if($leadExcel == "true")
	{
		//echo "OK";die();
		//获取上传的文件名
		$filename = $_FILES['inputExcel']['name'];
		//上传到服务器上的临时文件名
		$tmp_name = $_FILES['inputExcel']['tmp_name'];
		echo $filename."<br>";
		echo $tmp_name;
		$msg = uploadFile($filename,$tmp_name);
		echo $msg;
	}
}
?>