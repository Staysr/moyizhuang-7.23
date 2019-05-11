<?php
	
Header("Content-type:application/octet-stream");
Header("Accept-Ranges:bytes");
Header("Content-type:application/vnd.ms-excel");  
Header("Content-Disposition:attachment;filename=test.xls");
$con=mysqli_connect("localhost","root","root","uv");

$sql = "select Id,name,name_id,fans,sex_f,uv,jg,jg1,qq,xs,lb,username from info";
$result = mysqli_query($con,$sql);
echo "id\tname\tname_id\tfans\tsex_f\tuv\tjg\tjg1\tqq\txs\tlb\tusername";
while ($rs=mysqli_fetch_array($result)){
 echo "\n";
 echo $rs['Id']."\t".$rs['name']."\t".$rs['name_id']."\t".$rs['fans']."\t".$rs['sex_f']."\t".$rs['uv']."\t".$rs['jg']."\t".$rs['jg1']."\t".$rs['qq']."\t".$rs['xs']."\t".$rs['lb']."\t".$rs['username'];
}


	
?>