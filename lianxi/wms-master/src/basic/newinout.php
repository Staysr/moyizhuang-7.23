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
    <td height="20" align="center" bgcolor="#3399FF"><span class="STYLE9">��Ʒ����/����������</span>     -<span class="STYLE10">�������</span></td>
  </tr>
  <tr>
    <td align="center"><form name="form1" method="post" action="savenewinout.php">
      <label>���
      <select name="type" onChange="showhide(this.value);">
        <option value="���" selected>���</option>
        <option value="����">����</option>
      </select>
      </label>
        <label>����
        <input type="text" name="name">
        </label>
        <p>
		<div id="content">
          <label>�Ƿ����ɱ�����
          <select name="cost">
            <option value="1">��</option>
            <option value="0" selected>��</option>
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
