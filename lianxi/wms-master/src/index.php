<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��¼-�ֿ����ϵͳ</title>
  <link rel="shortcut icon" href="images/icon.jpg" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="css/font.css">
</head>
<style type="text/css">
@import url("css/button.css");

form{width:400px;margin:10px auto;border:solid 1px #E0DEDE;background:#6699FF;padding:30px;box-shadow:0 1px 10px rgba(0,0,0,0.1) inset;}
label{display:block;height:40px;position:relative;margin:20px 0;}
span{position:absolute;float:left;line-height:40px;left:10px;color:#BCBCBC;cursor:text;}
.input_txt{width:398px;border:solid 1px #ccc;box-shadow:0 1px 10px rgba(0,0,0,0.1) inset;height:38px;text-indent:10px;}
.input_txt:focus{box-shadow:0 0 4px rgba(255,153,164,0.8);border:solid 1px #B00000;}
.border_radius{border-radius:5px;color:#B00000;}
h2{font-family:"΢���ź�";text-shadow:1px 1px 3px #fff;}
.STYLE3 {border-radius: 5px; color: #0000FF; }
.STYLE5 {font-size: 18px}
.STYLE6 {font-size: 16px}
</style>
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#focus .input_txt").each(function(){
		var thisVal=$(this).val();
		//�ж��ı����ֵ�Ƿ�Ϊ�գ���ֵ�������������ʾ�û��ֵ����ʾ
		if(thisVal!=""){
			$(this).siblings("span").hide();
		}else{
			$(this).siblings("span").show();
		}
		//�۽����������֤
		$(this).focus(function(){
			$(this).siblings("span").hide();
		}).blur(function(){
			var val=$(this).val();
			if(val!=""){
				$(this).siblings("span").hide();
			}else{
				$(this).siblings("span").show();
			}
		});
	})
	$("#keydown .input_txt").each(function(){
		var thisVal=$(this).val();
		//�ж��ı����ֵ�Ƿ�Ϊ�գ���ֵ�������������ʾ�û��ֵ����ʾ
		if(thisVal!=""){
			$(this).siblings("span").hide();
		}else{
			$(this).siblings("span").show();
		}
		$(this).keyup(function(){
			var val=$(this).val();
			$(this).siblings("span").hide();
		}).blur(function(){
			var val=$(this).val();
			if(val!=""){
				$(this).siblings("span").hide();
			}else{
				$(this).siblings("span").show();
			}
		})
	})
})
</script>
 <script language="javascript">
							 function chkuserinput(form){
							   if(form.username.value==""){
								  alert("�������û���!");
								  form.username.select();
								  return(false);
								}		
								if(form.userpwd.value==""){
								  alert("�������û�����!");
								  form.userpwd.select();
								  return(false);
								}	
								if(form.yz.value==""){
								  alert("��������֤��!");
								  form.yz.select();
								  return(false);
								}	
							   return(true);				 
							 }
						  </script>
						    <script language="javascript">
						    function openfindpwd(){
							window.open("openfindpwd.php","newframe","left=200,top=200,width=200,height=100,menubar=no,toolbar=no,location=no,scrollbars=no,location=no");
							   }
						</script>
<body onload="form.username.focus();">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="800" align="left" bgcolor="#FFFFFF" scope="col"><img src="images/login.jpg" width="646" height="114" /></th>
    <th width="200" align="left" bgcolor="#FFFFFF" scope="col"><img src="images/login1.jpg" width="468" height="114" /></th>
  </tr>
  <tr>
    <th scope="row">  <div class="pic"><img src="images/login2.jpg" width="401" height="411" align="left" /><img src="images/login3.gif" width="174" height="412" align="left" /></div></th>
    <th rowspan="2" scope="row"><form id="focus" name="form" class="border_radius" method="post" action="chkuser.php" onSubmit="return chkuserinput(this)">
      <h2 class="STYLE3">WMS ����Ա��¼</h2>
      <label><span>�������û���</span><input type="text" name="username" class="input_txt border_radius"></label>
  <label><span>����������</span><input type="password" name="userpwd" class="input_txt border_radius"></label>
  <a href="reg.php" target="_blank"></a>&nbsp;&nbsp;&nbsp;&nbsp; 
  <input name="submit" type="submit" class="btnx" value="��¼">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:openfindpwd()">���ǵ�¼����</a>
    </form></th>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="2" scope="row">
      <p class="STYLE5">��ϵ�绰: 027-87413985 ����֧��QQ:1210380695 623696552</p>
      <p class="STYLE6">������Ա������ �ƺ��� ������ �Գ�˧ Web������ϵͳ - �ֿ�������B/S��</p></th>
  </tr>
</table>
</body>
</html>
