<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��λ��Ϣ�޸�</title>
</head>
<script language="javascript">
function checkForm(){
	//if(company_add.name.value==''){
		//alert("Check Form��");
		return true;
	//}
}
</script>
<?php
	include "../include.php";
	include "../database.php";

	$id=$_GET["id"];
	if($id=="")die("�������ݴ���");
	
//	$con = mysql_connect("localhost","root","1234") or die("�������ӵ�Mysql Server");
//	mysql_select_db("db_wms", $con) or die("���ݿ�ѡ��ʧ��");
//	mysql_query("set names gb2312 ");
	$query="select * from table_company where id=$id";//echo $query."<br>";
	$result=mysql_query($query);
	$RS=mysql_fetch_array($result);
	if(empty($RS))
		$error="ָ�����û�������!";
	/*else{
		$query = "select name from table_depart";
		$result = mysql_query($query);
	}*/
	mysql_close();
?>
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
body {
	width:800px;
	font-size:14px
}
thead {
	color: #330066
}
</style>
<body>
<h3>�޸���Ϣ</h3>
<p>ע��*����Ŀ����Ϊ�գ� </p>
<form id="company_modify" name="company_modify" method="post" action="company_modify_bg.php" onsubmit="return checkForm();">
  <!--onsubmit=" return checkform()"-->
  <table border="1" cellpadding="5" cellspacing="0" bordercolor="#9999FF">
    <tr>
      <td bordercolor="#990099"><table width="100%">
          <tr>
            <td width="100" align="center">*��ţ�</td>
            <td><input name="id" type="text" size="10" maxlength="10" style=" background-color:#CCCCCC" value="<?php echo $RS['id']; ?>" readonly/></td>
          </tr>
          <tr>
            <td width="100" align="center">*��λ���ƣ�</td>
            <td><input name="name" type="text" value="<?php echo $RS['name']; ?>" size="10" maxlength="10" /></td>
          </tr>
          <tr>
            <td width="100" align="center">*���ͣ�</td>
            <td><select name="type">
                <option value="������">������</option>
                <option value="��Ӧ��">��Ӧ��</option>
              </select></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><table width="100%">
          <tr>
            <td width="100" align="center">*��ϵ�ˣ�</td>
            <td><input name="contact" type="text" value="<?php echo $RS['contact']; ?>" size="10" maxlength="10"/></td>
          </tr>
          <tr>
            <td width="100" align="center">*��ϵ�绰��</td>
            <td><input name="phone" type="text" value="<?php echo $RS['phone']; ?>" size="10" maxlength="10"/></td>
          </tr>
          <tr>
            <td width="100" align="center">*���棺</td>
            <td><input name="fax" type="text" value="<?php echo $RS['fax']; ?>" size="10" maxlength="10"/></td>
          </tr>
          <tr>
            <td width="100" align="center">*Email��</td>
            <td><input name="email" type="text" value="<?php echo $RS['email']; ?>" size="10" maxlength="10"/></td>
          </tr>
        </table></td>
      <td><table width="100%">
          <tr>
            <td width="100" align="center">*�������У�</td>
            <td><input name="bank" type="text" value="<?php echo $RS['bank']; ?>" size="10" maxlength="10" /></td>
          </tr>
          <tr>
            <td width="100" align="center">*�����˻���</td>
            <td><input name="bankaccount" type="text" value="<?php echo $RS['bankaccount']; ?>" size="10" maxlength="10" />
          </tr>
          <tr>
            <td width="100" align="center">*˰�ţ�</td>
            <td><input name="tariff" type="text" onkeyup="value=value.replace(/[\W]/g,'')" value="<?php echo $RS['tariff']; ?>" size="10" maxlength="10"/></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><table width="100%">
          <tr>
            <td width="100" align="center">*����:</td>
            <td><select name="area">
                <option value="����" <?php if($RS['area']=="����") echo 'selected'; ?>>����</option>
                <option value="����" <?php if($RS['area']=="����") echo 'selected'; ?>>����</option>
                <option value="����" <?php if($RS['area']=="����") echo 'selected'; ?>>����</option>
                <option value="����" <?php if($RS['area']=="����") echo 'selected'; ?>>����</option>
                <option value="����" <?php if($RS['area']=="����") echo 'selected'; ?>>����</option>
                <option value="����" <?php if($RS['area']=="����") echo 'selected'; ?>>����</option>
                <option value="����" <?php if($RS['area']=="����") echo 'selected'; ?>>����</option>
              </select></td>
          </tr>
          <tr>
            <td width="100" align="center">*ʡ�ݣ�</td>
            <td><input name="province" type="text" value="<?php echo $RS['province']; ?>" size="10" maxlength="10" /></td>
          </tr>
          <tr>
            <td width="100" align="center">*��ַ��</td>
            <td><input name="address" type="text" value="<?php echo $RS['address']; ?>" size="10" maxlength="10" /></td>
          </tr>
          <tr>
            <td width="100" align="center">*�ʱࣺ</td>
            <td><input name="zipcode" type="text" value="<?php echo $RS['zipcode']; ?>" size="10" maxlength="10" /></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td align="center"><input name="submit" type="submit" value="�ύ" /></td>
      <td><input name="submit" type="reset" value="����" />
      </td>
    </tr>
  </table>
</form>
<p><a href="company_show.php">������һҳ</a></p>
</body>
</html>
