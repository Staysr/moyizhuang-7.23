<SCRIPT LANGUAGE="javascript">
<!--
function AllAreaWord() 
{
	if(document.all("table_storage").rows.length==0){
		alert("û�����ݿɵ���");
		return;
	}
	try{
		var oWD = new ActiveXObject("Word.Application"); 
	}
	catch(e){
		alert("�޷�����Office������ȷ�����Ļ����Ѱ�װ��Office���ѽ���ϵͳ��վ�������뵽IE������վ���б��У�");
		return;
	}
	var oDC = oWD.Documents.Add("",0,1); 
	var oRange =oDC.Range(0,1); 
	var sel = document.body.createTextRange(); 
	sel.moveToElementText(table_storage); //tab Ϊ�����������ڵı��ID
	sel.select(); 
	sel.execCommand("Copy"); 
	oRange.Paste(); 
	oWD.Application.Visible = true; 
}
function AutomateExcel(){	
	try{
		var appExcel = new ActiveXObject( "Excel.Application" ); 
	}
	catch(e){
	  alert("�޷�����Office������ȷ�����Ļ����Ѱ�װ��Office���ѽ���ϵͳ��վ�������뵽IE������վ���б��У�");
	  return;
	}
	var elTable = document.getElementById("table_storage"); //outtable Ϊ�����������ڵı��ID��
	var oRangeRef = document.body.createTextRange(); 
	
	oRangeRef.moveToElementText( elTable ); 
	oRangeRef.execCommand( "Copy" );
	
	appExcel.Visible = true; 
	appExcel.Workbooks.Add().Worksheets.Item(1).Paste(); 
	appExcel = null;
}
//-->
</SCRIPT>

<input type="button" name="tab" onClick="AutomateExcel();" value="������excel" class="notPrint">
<table border="1" cellpadding="0" cellspacing="0" id=outtable>
  <tr height="28">
    <td width="27" height="86" rowspan="4" bgcolor="#ffffcc">���</td>
    <td width="111" rowspan="4" bgcolor="#ffffcc"><div align="center">��������</div></td>
    <td width="402" colspan="7" bgcolor="#ffffcc"><div align="center">�û������</div></td>
  </tr>
  <tr height="19">
    <td width="100" height="39" colspan="3" rowspan="2" bgcolor="#ffffcc"><div align="center">��������</div></td>
    <td width="218" colspan="3" rowspan="2" bgcolor="#ffffcc">�Ը÷�������ʵʩ���λ���������ۣ�����10�֣�ƽ��������</td>
    <td width="84" rowspan="3" bgcolor="#ffffcc"><div align="center">����ƽ����</div></td>
  </tr>
  <tr height="20"> </tr>
  <tr height="19">
    <td width="29" height="19" bgcolor="#ffffcc"><div align="center">4��</div></td>
    <td width="29" bgcolor="#ffffcc"><div align="center">5��</div></td>
    <td width="42" bgcolor="#ffffcc"><div align="center">�ϼ�</div></td>
    <td width="68" bgcolor="#ffffcc"><div align="center">4��</div></td>
    <td width="68" bgcolor="#ffffcc"><div align="center">5��</div></td>
    <td width="82" bgcolor="#ffffcc"><div align="center">�ϼ�</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#ffffcc">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#ffffcc">&nbsp;</td>
    <td bgcolor="#ffffcc">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#ffffcc">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#ffffcc">&nbsp;</td>
    <td bgcolor="#ffffcc">&nbsp;</td>
  </tr>
</table>



--------------------------------------------------------------------------------
