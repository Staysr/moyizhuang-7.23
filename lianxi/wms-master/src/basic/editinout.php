<?php
  include("../conn/conn.php");
   $id=$_GET[id];
   $sql=mysql_query("select * from tb_inout where id='".$_GET[id]."'",$conn);
   $info=mysql_fetch_array($sql);
		  
?>
<title>��ӳ�/������</title>
<link rel="stylesheet" type="text/css" href="css/font.css">
<style type="text/css">
<!--
.style5 {
	color: #000000;
	font-weight: bold;
}
.style6 {color: #000000}
.style7 {color: #990000}
.style1 {color: #FFFFFF}
.STYLE9 {color: #FFFFFF; font-size: 18px; }
.STYLE10 {font-size: 10px}
-->
</style>
<script language="javascript">
function showhide(value){
 var flag=value;;
 if (flag=="���"){
  content.style.display="";
 }else{
  content.style.display="none";
 }
}//��ӭ����վ����Ч�������ǵ���ַ��www.zzjs.net���ܺüǣ�zzվ����js����js��Ч����վ�ռ��� ��������js���룬���������������ء�
</script> 
<body topmargin="0" leftmargin="0" bottommargin="0" class="scrollbar">
  
<table width="600" border="1" align="center" cellpadding="0" cellspacing="30" bordercolor="#33FFCC">
  <tr>
    <td height="20" align="center" bgcolor="#3399FF"><span class="STYLE9">��Ʒ����/����������</span>     -�༭���</td>
  </tr>
  <tr>
    <td align="center"><form name="form1" method="post" action="savenewinout.php?id=<?php echo $info[id];?>">
      <label>���
      <select name="type" onChange="showhide(this.value);">
        <option value="���" <?php if($info[type]==���){ ?>selected="selected"<?php } ?>>���</option>
        <option value="����"<?php if($info[type]==����){ ?>selected="selected"<?php } ?>>����</option>
      </select>
      </label>
        <label>����
        <input type="text" name="name"value="<?php echo $info[name];?>" readOnly="true"/>
        </label>
        <p>
		<div id="content">
          <label>�Ƿ����ɱ�����
          <select name="cost">
            <option value="1"<?php if($info[cost]==1){ ?>selected="selected"<?php } ?>>��</option>
            <option value="0" <?php if($info[cost]==0){ ?>selected="selected"<?php } ?>>��</option>
          </select>
          </label>
		 </div>
        </p>
        <p>
          <label>
          <input type="submit" name="Submit" value="����"> 
          </label>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label>
          <input type="button" name="button"onClick="javascript:window.open('inoutsetting.php','_self')" value="�˳�">
          </label>
        </p>
    </form>
    </td>
  </tr>
</table>
</body>
</html>
