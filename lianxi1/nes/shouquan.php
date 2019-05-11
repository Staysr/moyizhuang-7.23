<?php
header("Content-type: text/html; charset=gb2312"); 
?>
<?php 
$b1 = "wedf32";
$b2 = "66788";
$b3 = "ew5$#";
$b4 = "2245"; 

function encrypt($string,$operation,$key='')
 {
  $key=md5($key);
  $key_length=strlen($key);
  $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
  $string_length=strlen($string);
  $rndkey=$box=array();
  $result='';
  for($i=0;$i<=255;$i++)
  {
   $rndkey[$i]=ord($key[$i%$key_length]);
   $box[$i]=$i;
  }
  for($j=$i=0;$i<256;$i++)
  {
   $j=($j+$box[$i]+$rndkey[$i])%256;
   $tmp=$box[$i];
   $box[$i]=$box[$j];
   $box[$j]=$tmp;
  }
  for($a=$j=$i=0;$i<$string_length;$i++)
  {
   $a=($a+1)%256;
   $j=($j+$box[$a])%256;
   $tmp=$box[$a];
   $box[$a]=$box[$j];
   $box[$j]=$tmp;
   $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
  }
  if($operation=='D')
  {
   if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8))
   {
    return substr($result,8);
   }
   else
   {
    return'';
   }
  }
  else
  {
   return str_replace('=','',base64_encode($result));
  }
 }
$p = ""; 
$www ="";
$token ="";
       if(isset($_POST["pwd"])){ 
           if(!empty($_POST["pwd"])){ 
                $isview = true; 
                $www =$_POST["pwd"];
                $token = encrypt($www, 'E', 'chanese');
            }else{
				 $isview = false;
				 $p = "授权域名不能为空，请输入域名！"; 
                 } 
        }else{ 
             $isview = false; 
             $p = "请输入域名进行授权查询！。"; 
             } 
if($isview){ ?> 
  <?php 
     echo '授权码:'.$token;
	 echo '<br />';
     echo '授权域名为:'.encrypt($token, 'D', 'chanese');
     echo '<br />'; 
  ?> 
<?php }else{ ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns=" http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
<meta http-equiv="pragma" content="no-cache" /> 
<meta http-equiv="cache-control" content="no-cache" /> 
<meta http-equiv="expires" content="0" /> 
<title>服务器连接</title> 
<!--[if lt IE 6]> 
<style type="text/css"> 
.z3_ie_fix{ 
float:left; 
} 
</style> 
<![endif]--> 
<style type="text/css"> 
<!-- 
body{ 
background:none; 
} 
.passport{ 
border:1px solid red; 
background-color:#FFFFCC; 
width:400px; 
height:100px; 
position:absolute; 
left:49.9%; 
top:49.9%; 
margin-left:-200px; 
margin-top:-55px; 
font-size:14px; 
text-align:center; 
line-height:30px; 
color:#746A6A; 
} 
--> 
</style> 
<div class="passport"> 
<div style="padding-top:20px;"> 
<form action="?yes" method="post" style="margin:0px;">输入查看密码 
<input type="text" name="pwd" /> <input type="submit" value="查看" /> 
</form> 
<?php echo $p; ?> 
</div> 
</div> 
<?php 
} ?> 
</body> 
</html> 