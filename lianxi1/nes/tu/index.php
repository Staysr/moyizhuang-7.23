<?php
include ('../inc/aik.config.php');
?>
<?php
error_reporting(~E_NOTICE);
header("content-Type: text/html; charset=gb2312");
$uptypes=array('image/jpg',  //�ϴ��ļ������б�
 'image/jpeg',
 'image/png',
 'image/jpeg',
 'image/gif',
 'image/bmp',
 'image/pjpeg',
 'image/x-png');  

 //��������    'audio/x-ms-wma',      'audio/mp3',    'audio/mpeg',        'application/vnd.rn-realmedia',      'application/x-zip-compressed',     'application/octet-stream'      'application/msword',    'application/x-shockwave-flash',
 
$passwd=$aik['tu_pass']; //�ϴ�����
$max_file_size=20000000;   //�ϴ��ļ���С����, ��λBYTE
$path_parts=pathinfo($_SERVER['PHP_SELF']); //ȡ�õ�ǰ·��
$time=time();
$destination_folder=date("Y",$time).'/'; //�ϴ��ļ�·��
$destination_folder .=date("m",$time).'/'; //�ϴ��ļ�·��
$watermark=0;   //�Ƿ񸽼�ˮӡ(1Ϊ��ˮӡ,����Ϊ����ˮӡ);
$watertype=1;   //ˮӡ����(1Ϊ����,2ΪͼƬ)
$waterposition=2;   //ˮӡλ��(1Ϊ���½�,2Ϊ���½�,3Ϊ���Ͻ�,4Ϊ���Ͻ�,5Ϊ����);
$waterstring="http://www.gouagou.com/"; //ˮӡ�ַ���
$waterimg="xplore.gif";  //ˮӡͼƬ
$imgpreview=1;   //�Ƿ�����Ԥ��ͼ(1Ϊ����,����Ϊ������);
$imgpreviewsize=1/1;  //����ͼ����
?>
<html>
<head>
<title>�Ű�ͼƬ�ϴ����</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="keywords" content="����ϴ�,�ļ��ϴ�,����ϴ�ͼƬ,ͼƬ�ϴ�,�ļ��ϴ�ϵͳ,��Ѵ��ļ�,��Ѵ�ͼƬ,���" />
<meta name="description" content="�ļ��ϴ�" />
<style type="text/css">body,td{font-family:tahoma,verdana,arial;font-size:11px;line-height:15px;background-color:white;color:#666666;margin-left:20px;}
strong{font-size:12px;}
a:link{color:#0066CC;}
a:hover{color:#FF6600;}
a:visited{color:#003366;}
a:active{color:#9DCC00;}
a{TEXT-DECORATION:none}
table.itable{}
td.irows{height:20px;background:url("index.php?i=dots") repeat-x bottom}</style>
</head>
<script type="text/javascript">function oCopy(obj){obj.select();js=obj.createTextRange();js.execCommand("Copy");};function sendtof(url){window.clipboardData.setData('Text',url);alert('���Ƶ�ַ�ɹ���ճ���������һ�����');};function select_format(){var on=document.getElementById('fmt').checked;document.getElementById('site').style.display=on?'none':'';document.getElementById('sited').style.display=!on?'none':'';};var flag=false;function DrawImage(ImgD){var image=new Image();image.src=ImgD.src;if(image.width>0&&image.height>0){flag=true;if(image.width/image.height>=120/80){if(image.width>120){ImgD.width=120;ImgD.height=(image.height*120)/image.width;}else {ImgD.width=image.width;ImgD.height=image.height;};ImgD.alt=image.width+"��"+image.height;}else {if(image.height>80){ImgD.height=80;ImgD.width=(image.width*80)/image.height;}else {ImgD.width=image.width;ImgD.height=image.height;};ImgD.alt=image.width+"��"+image.height;}};};function FileChange(Value){flag=false;document.all.uploadimage.width=10;document.all.uploadimage.height=10;document.all.uploadimage.alt="";document.all.uploadimage.src=Value;};</script>
<body>
<center>
<form enctype="multipart/form-data" method="post" name="upform">
<div style="position: absolute; width: 120px; height: 600; z-index: 1; left: 20px; top: 0px" id="layer1">

</div>
<table border="1" width="55%" id="table1" cellspacing=0>
	<tr>
		<td colspan="2" style="font-family: tahoma,verdana,arial; font-size: 11px; line-height: 15px; color: #666666; margin-left: 20px; background-color: white">
		<p align="center">
			<a title="��������ҵ����ƽ̨" href="http://www.tuana.cn/" target="_blank">
�Ű�</a> �ϴ�ͼƬ:</td>
	</tr>
	<tr>
			<td style="font-family: tahoma,verdana,arial; font-size: 11px; line-height: 15px; color: #666666; margin-left: 20px; background-color: white" width="10%">
				<div style="width:120px; height:80px;overflow:hidden;text-align: center;" >
					<IMG id=uploadimage height=0 width=0 src=""  onload="javascript:DrawImage(this);" >
				</div>
			</td>
			<td style="font-family: tahoma,verdana,arial; font-size: 11px; line-height: 15px; color: #666666; margin-left: 20px; background-color: white" width="71%">
			<div style="width:361px; height:80px;text-align: center;padding:30px; " >
				<input style="width:208;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff; height:18" size="17" name=upfile[0] type=file onchange="javascript:FileChange(this.value);">
				<!--<input style="width:208;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff; height:18" size="17" name=upfile[1] type=file onchange="javascript:FileChange(this.value);">
				<input style="width:208;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff; height:18" size="17" name=upfile[2] type=file onchange="javascript:FileChange(this.value);">
				<input style="width:208;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff; height:18" size="17" name=upfile[3] type=file onchange="javascript:FileChange(this.value);">
				<input style="width:208;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff; height:18" size="17" name=upfile[4] type=file onchange="javascript:FileChange(this.value);">-->
			
				<input type="password" name="pwd">
				<span style="float:right">�������������� (�޸��ϴ������ں�̨��վ�����������)</span>
								<input type="submit" value="�ϴ�" style="width:60;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff; height:18" size="17">

			</td>
	</tr>
</div>
</table>�����ϴ����ļ�����Ϊ:jpg|jpeg|gif|bmp|png<br>

	<p><br>
	</p>
</form>
<!--<a href="/" target="_blank">�鿴ȫ��ͼƬ</a>-->


<?php
if(is_array($_FILES["upfile"])){
$i=0;
if($_POST['pwd'] != $passwd){
//�ж�Ȩ��
	echo '<script>alert("��û��Ȩ��")</script>';
	exit;
}
while($i<count($_FILES["upfile"])){
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{


if (!is_uploaded_file($_FILES["upfile"][tmp_name][$i]))
//�Ƿ�����ļ�
{
// echo $_FILES["upfile"][tmp_name][$i];
echo "<font color='red'>�ļ�Ԥ����</font>";
exit;
}
// echo $_FILES["upfile"][tmp_name][$i];
 $file = $_FILES["upfile"];
 if($max_file_size < $file["size"][$i])
 //����ļ���С
 {
 echo "<font color='red'>�ļ�̫��</font>";
 exit;
  }

if(!in_array($file["type"][$i], $uptypes))
//����ļ�����
{

 echo "<font color='red'>�����ϴ��������ļ���</font>";
 exit;
}

if(!file_exists($destination_folder))
if(!mkdir($destination_folder,0777,true)){
	echo "<font color='red'>������Ŀ¼ʧ��,���ֶ�������</a>";
}


$filename=$file["tmp_name"][$i];
$image_size = getimagesize($filename);
$pinfo=pathinfo($file["name"][$i]);
$ftype=$pinfo[extension];
$destination = $destination_folder.$i.time().".".$ftype;
if (file_exists($destination) && $overwrite != true)
{
     echo "<font color='red'>ͬ���ļ��Ѿ������ˣ�</a>";
     exit;
  }
echo $destination;
 if(!move_uploaded_file ($filename, $destination))
 {
   echo "<font color='red'>�ƶ��ļ�����</a>";
     exit;
  }

$pinfo=pathinfo($destination);
$fname=$pinfo[basename];
echo " <font color=red>�ɹ��ϴ�,����ƶ�����ַ���Զ�����</font><br><table width=\"348\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\" class=\"table_decoration\" align=\"center\"><tr><td><!--<input type=\"checkbox\" id=\"fmt\" onclick=\"select_format()\"/>ͼƬUBB����--><br/><div id=\"site\"><table border=\"0\"><tr><td valign=\"top\">�ļ���ַ:</td><td><input type=\"text\" onclick=\"sendtof(this.value)\" onmouseover=\"oCopy(this)\" style=font-size=9pt;color:blue size=\"44\" value=\"http://".$_SERVER['SERVER_NAME'].$path_parts["dirname"]."/".$destination_folder.$fname."\"/>
</td></tr></table></div><div id=\"sited\" style=\"display:none\"><table border=\"0\"><tr><td valign=\"top\">�ļ���ַ:</td><td><input type=\"text\" onclick=\"sendtof(this.value)\" onmouseover=\"oCopy(this)\" style=font-size=9pt;color:blue size=\"44\" value=\"[img]http://".$_SERVER['SERVER_NAME'].$path_parts["dirname"]."/".$destination_folder.$fname."[/img]\"/></td></tr></table></div></td></tr></table>";
echo " ���:".$image_size[0];
echo " ����:".$image_size[1];
if($watermark==1)
{
$iinfo=getimagesize($destination,$iinfo);
$nimage=imagecreatetruecolor($image_size[0],$image_size[1]);
$white=imagecolorallocate($nimage,255,255,255);
$black=imagecolorallocate($nimage,0,0,0);
$red=imagecolorallocate($nimage,255,0,0);
imagefill($nimage,0,0,$white);
switch ($iinfo[2])
{
 case 1:
 $simage =imagecreatefromgif($destination);
 break;
 case 2:
 $simage =imagecreatefromjpeg($destination);
 break;
 case 3:
 $simage =imagecreatefrompng($destination);
 break;
 case 6:
 $simage =imagecreatefromwbmp($destination);
 break;
 default:
 die("<font color='red'>�����ϴ��������ļ���</a>");
 exit;
}

imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);
imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);

switch($watertype)
{
 case 1:  //��ˮӡ�ַ���
 imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);
 break;
 case 2:  //��ˮӡͼƬ
 $simage1 =imagecreatefromgif("xplore.gif");
 imagecopy($nimage,$simage1,0,0,0,0,85,15);
 imagedestroy($simage1);
 break;
}

switch ($iinfo[2])
{
 case 1:
 //imagegif($nimage, $destination);
 imagejpeg($nimage, $destination);
 break;
 case 2:
 imagejpeg($nimage, $destination);
 break;
 case 3:
 imagepng($nimage, $destination);
 break;
 case 6:
 imagewbmp($nimage, $destination);
 //imagejpeg($nimage, $destination);
 break;
}

//����ԭ�ϴ��ļ�
imagedestroy($nimage);
imagedestroy($simage);
}

if($imgpreview==1)
{
echo "<br>ͼƬԤ��:<br>";
echo "<a href=\"".$destination."\" target='_blank'><img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
echo " alt=\"ͼƬԤ��:\r�ļ���:".$fname."\r�ϴ�ʱ��:".date('m/d/Y h:i')."\" border='0'></a>";
}
}

$i++;
}
}


?>
</center>
</body>
</html>