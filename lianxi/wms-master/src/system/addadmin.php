<?php
	session_start();
	$name=$_GET[name];
	$i=0;
	include "../conn/conn.php";
    $sqlstr = "select id,name from tb_admin";
	$result = mysql_query($sqlstr,$conn);	
?>
<link href="../css/style.css" rel="stylesheet" />
<script >


function chkinput(form)
	{
	  if(form.adminname.value=="")
	   {
	     alert("�������û���!");
		 form.adminname.select();
		 return(false);
	   }
	  
	
	
	  if(form.pwd.value=="")
	   {
	     alert("�������������!");
		 form.pwd.select();
		 return(false);
	   }
	
	   return(true);
	}

 function Refresh() 
{ 

  var v=document.getElementsByTagName("input"); 
  for(var i=0;i<v.length;i++) 
 { 
    if(v[i].type=="text") 
    { 
      v[i].value=""; 
    } 
    if(v[i].type=="checkbox")
    {
        v[i].checked =false;  
    }
  } 
  
  
}

function chAll(name,flag)
{
 var len = document.getElementsByName(name).length;
 var check=flag;
 if(check==true)
 {
    for(var i=0; i < len; i++)
   {
      document.getElementsByName(name)[i].checked = true;
   }
 }
 else
 {
    for(var i=0; i < len; i++)
   {
      document.getElementsByName(name)[i].checked = false;
   }
  }
}
 
 </script>
<style type="text/css">
<!--
.STYLE1 {font-size: 18px}
.STYLE2 {font-size: 16px}
-->
</style>
<table width="853" border="1" cellpadding="0" cellspacing="0" class="big_td">
  <tr>
    <td width="46" height="33" background="../iages/list.jpg" id="list">&nbsp;</td>
    <td width="841" background="../images/list.jpg" id="list">����û�</td>
  </tr>
</table>
<form name="form" method="post" action="saveadmin.php?flag=1" onSubmit="return chkinput(this)">
  <table width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#DEEBEF">
    <tr>
      <td height="255" colspan="2" rowspan="4" align="center" valign="middle" scope="col"><select name="left" size="20" multiple style="width:100px;"onchange="javascript:window.open('adminsetting.php?name='+ this.value, '_self');">
          <?php
	 	while($rows = mysql_fetch_row($result)){
		   if($rows[1]==$name)
		   {
		     echo "<option value='".$rows[1]."'style='background:#FFFF00' >".$rows[1]."</option>";
		   }
		   else
		
			echo "<option value='".$rows[1]."'>".$rows[1]."</option>";		
		}
	 ?>
        </select>
      <td width="827" height="49" align="center" valign="top" scope="col"><label>�û����� <span class="STYLE1">
        <input name="adminname" type="text" class="big_td" />
        </span></label>
        <label>���룺
        <input type="password" name="pwd" />
        </label></td>
    </tr>
    <tr>
      <td height="5" align="left" valign="top" scope="col"><img src="../images/line.gif" width="600" height="4" /></td>
    </tr>
    <tr>
      <td height="10" align="center" valign="top" scope="col"><label><span class="STYLE1">Ȩ��</span><br />
      </label>
        <label><br />
        </label>
        <label><br />
      </label></td>
    </tr>
    <tr>
      <td height="158" align="center" valign="top" scope="col"><table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><label><input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ������λ����</label></td>
          <td><label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ��������</label>        </td>
          <td><label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>" />
        Ա������</label></td>
          <td><label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>" />
        �ֿ�����</label></td>
        </tr>
        <tr>
          <td><label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ��������</label></td>
          <td><label><input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ��Ʒ�������</label></td>
          <td><label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ��Ʒ��Ϣ����</label></td>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>" />
        ������λ����</label></td>
        </tr>
        <tr>
          <td><label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>" />
        ������</label></td>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        �������</label>        </td>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ������</label></td>
          <td><label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ����̵�</label></td>
        </tr>
        <tr>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>" />
        ����ѯ</label></td>
          <td>  <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>" />
        ���Ԥ��</label></td>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ���ͳ��</label></td>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ����ͳ��</label></td>
        </tr>
        <tr>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ����ͳ��</label></td>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>" />
        �̵�ͳ��</label>        </td>
          <td><label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>" />
        �����û�����</label></td>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ���ݱ���</label></td>
        </tr>
        <tr>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        ���ݻָ�</label></td>
          <td> <label>
        <input name="auth[]" type="checkbox" class="big_td" value="<?php echo $i++;?>"/>
        �鿴ϵͳ������־</label></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="33" colspan="3" align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        �Ƿ�����
        <select name="state">
          <option value="1" selected >����</option>
          <option value="0" >ͣ��</option>
        </select>
        <label>
        <input type="checkbox" name="choall" value="checkbox" onClick="chAll('auth[]',this.checked)" />
        ȫѡ/ȫ��ѡ</label></td>
    </tr>
    <tr>
      <td height="34" colspan="3" align="center" valign="middle"><input type="submit" name="Submit" value="����" />
        <input name="button" type="button" onClick="Refresh()" value="����" />      </td>
    </tr>
    <tr>
      <td height="67" colspan="3" align="center" valign="middle">&nbsp;</td>
    </tr>
  </table>
</form>
