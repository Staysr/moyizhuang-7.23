<?php
  include("../const.php");
  include "../conn/conn.php";
   
 /* if ($authority[0]==0)
 {  
      echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
      exit;
  }*/
?>
<?php 
  $sql1=mysql_query("select * from tb_product where id=".$_GET[id]."",$conn);
  $info1=mysql_fetch_array($sql1);

?>

<?php   
//   $con = mysql_connect("localhost","root","hust"); //or die("�������ӵ�Mysql Server");
//	mysql_select_db("db_wms", $con); //or die("���ݿ�ѡ��ʧ��");
//	mysql_query("set names gb2312 ");
	
	$query = "select * from table_itemclassify order by name";//echo $query."<br>";
	$result = mysql_query($query);

	mysql_close();	 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 18px}
-->
</style>
<style type="text/css">
div#PreviewBox{
  position:absolute;
  padding-left:6px;
  display: none;
  Z-INDEX:2006;
}
div#PreviewBox span{
  width:7px;
  height:13px;
  position:absolute;
  left:0px;
  top:9px;
  background:url() 0 0 no-repeat;
}
div#PreviewBox div.Picture{
  float:left;
  border:1px #666 solid;
  background:#FFF;
}
div#PreviewBox div.Picture div{
  border:4px #e8e8e8 solid;
}
div#PreviewBox div.Picture div a img{
  margin:19px;
  border:1px #b6b6b6 solid;
  display: block;
  max-height: 250px;
  max-width: 250px;
}
</style>
</head>
<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script language="javascript">

$("input[type=text][imemode=disabled]").live("click", this, function () {/*���ƹ�������*/

var curVal = $(this).val();

var ran = this.createTextRange();

ran.moveStart('character', curVal.length);

ran.collapse(true);

ran.select();

}).live("keydown", this, function (event) {/*���÷���� Home End PgUp PgDn*/

if (event.keyCode >= 33 && event.keyCode <= 40) {

return false;

}

return true;

}).live("keypress", this, function (event) {

var curVal = $(this).val();

if (event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46) {

if (curVal.indexOf(".") != -1 && event.keyCode == 46) return false; /*����ֻ������һ��С����*/

if (curVal == "0" && event.keyCode != 46) { $(this).val(""); return true; } /*���Ƶ�һλ��0ʱ �������ֺ�0ɾ��*/

if (curVal == "0" && event.keyCode != 46) return false; /*���Ƶ�һλ����0��������С����*/

if (curVal == "" && event.keyCode == 46) $(this).val("0"); /*��һλ����С���� ��ǰһλ��0*/

} else return false;

}).live("paste", function () {/*��ֹճ������ֵ*/

return !clipboardData.getData('text').match(/^\D+(\.\D+)?$/)

}).live("dragenter", function () {/*��ֹ����*/

return false;

});






function chkinput(form1)
	{
		var upperlimit;
	var lowerlimit;
	  if(form1.name.value=="")
	   {
	     alert("�������Ʒ����!");
		 form1.name.select();
		 return(false);
	   }
	  
	  if(form1.encode.value=="")
	   {
	     alert("�������Ʒ����!");
		 form1.encode.select();
		 return(false);
	   }
	  
	
	
	  if(form1.barcode.value=="")
	   {
	     alert("�������Ʒ����!");
		 form1.barcode.select();
		 return(false);
	   }
	   
	   upperlimit=Number(form1.upperlimit.value);
	   lowerlimit=Number(form1.lowerlimit.value);
	  if(upperlimit<lowerlimi)
	  {
	      alert("������޲��ܵ��ڿ������!");
		  form1.upperlimit.select();
		  return(false);
	  }
	
	   return(true);
	}

//�Ƴ��ұ����е�ѡ��
function removeAllOption(){
	var right = document.getElementById("right");
	for(;right.length!=0;)
		right.remove(right.options[0]);
}
//����ѡ�е�ѡ����ʾ�ұߵ�ѡ��
function showOption(){
	removeAllOption();
	var left = document.getElementById("left");
	var right = document.getElementById("right");
	
	var option_str = "";
	if(left.selectedIndex != -1)
		var option_str = left.options[left.selectedIndex].value;
		
	var option_list = option_str.split("|");
	var y;
	
	for (i=2;i<option_list.length;i++){
		y = document.createElement('option');
		y.text = option_list[i];
		y.value = option_list[i];
		right.add(y);//right.appendChild(y,null);
	}
}
//�����ѡ��ı�������ı仯
function changeLeft(){
	//var rename = document.getElementById("rename");
	//var left = document.getElementById("left");
	//rename.value = left.options[left.selectedIndex].text;
	showOption();
	//alert("changeLeft() runing!");
}
</script>
<body>
<script language="javascript" type="text/javascript">
var maxWidth=250;
var maxHeight=250;
function getPosXY(a,offset) {
       var p=offset?offset.slice(0):[0,0],tn;
       while(a) {
           tn=a.tagName.toUpperCase();
           if(tn=='IMG') {
              a=a.offsetParent;continue;
           }
          p[0]+=a.offsetLeft-(tn=="DIV"&&a.scrollLeft?a.scrollLeft:0);
          p[1]+=a.offsetTop-(tn=="DIV"&&a.scrollTop?a.scrollTop:0);
          if(tn=="BODY")
                break;
          a=a.offsetParent;
      }
      return p;
}
function checkComplete() {
     if(checkComplete.__img&&checkComplete.__img.complete)
              checkComplete.__onload();
}
checkComplete.__onload=function() {
         clearInterval(checkComplete.__timeId);
         var w=checkComplete.__img.width;
         var h=checkComplete.__img.height;
         if(w>=h&&w>maxWidth) {
              previewImage.style.width=maxWidth+'px';
         }
        else if(h>=w&&h>maxHeight) {
              previewImage.style.height=maxHeight+'px';
        }
        else {
              previewImage.style.width=previewImage.style.height='';
        }
       previewImage.src=checkComplete.__img.src;previewUrl.href=checkComplete.href;checkComplete.__img=null;
}
function showPreview(e) {
         hidePreview (e);
         previewFrom=e.target||e.srcElement;
         previewImage.src=loadingImg;
         previewImage.style.width=previewImage.style.height='';
         previewTimeoutId=setTimeout('_showPreview()',500);
         checkComplete.__img=null;
}
function hidePreview(e) {
        if(e) {
            var toElement=e.relatedTarget||e.toElement;
            while(toElement) {
                  if(toElement.id=='PreviewBox')
                          return;
                  toElement=toElement.parentNode;
            }
       }
       try {
            clearInterval(checkComplete.__timeId);
            checkComplete.__img=null;
            previewImage.src=null;
       }
       catch(e) {}
       clearTimeout(previewTimeoutId);
       previewBox.style.display='none';
}
function _showPreview() {
        checkComplete.__img=new Image();
        if(previewFrom.tagName.toUpperCase()=='A')
               previewFrom=previewFrom.getElementsByTagName('img')[0];
        var largeSrc=previewFrom.getAttribute("large-src");
        var picLink=previewFrom.getAttribute("pic-link");
        if(!largeSrc)
             return;
        else {
             checkComplete.__img.src=largeSrc;
             checkComplete.href=picLink;
             checkComplete.__timeId=setInterval("checkComplete()",20);
             var pos=getPosXY(previewFrom,[106,26]);
             previewBox.style.left=pos[0]+'px';
             previewBox.style.top=pos[1]+'px';
             previewBox.style.display='block';
        }
}
</script>
<div id="PreviewBox" onMouseOut="hidePreview(event);">
  <div class="Picture" onMouseOut="hidePreview(event);">
   <span></span>
   <div>
    <a id="previewUrl" href="javascript:void(0)" target="_blank"><img oncontextmenu="return(false)" id="PreviewImage" src="about:blank" border="0" onMouseOut="hidePreview(event);" /></a>
   </div>
  </div>
</div>
<script language="javascript" type="text/javascript">
var previewBox = document.getElementById('PreviewBox');
var previewImage = document.getElementById('PreviewImage');
var previewUrl = document.getElementById('previewUrl');
var previewFrom = null;
var previewTimeoutId = null;
//var loadingImg = '/jscss/demoimg/loading.gif';
var loadingImg = 'images/login1.jpg';
</script>



<form id="form1" name="form1"enctype="multipart/form-data" method="post" action="savenewproduct.php?flag=0&&id=<?php echo $_GET[id];?>" onSubmit="return chkinput(this)">
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
    <tr>
      <td colspan="4" align="center" bgcolor="#0000CC"><span class="STYLE1">��Ʒ�༭</span></td>
    </tr>
    <tr>
      <td width="85" align="right">��Ʒ�����:</td>
      <td width="296"><label>
        <select id="left" name="typeid" onChange="changeLeft()">
		<OPTION value="">--��ѡ��--</OPTION> 
		<?php while($RS=mysql_fetch_array($result)){ echo "<option value='$RS[id]|$RS[name]$RS[lowerclass]'";if($info1[maintype]==$RS[name]){echo "selected";}echo">$RS[name]</option>";}?>
        </select>
        </label></td>
      <td width="99" align="center">��Ʒ�����</td>
      <td width="280"><label>
        <select id="right" name="stype" >
		<script language="javascript">showOption();</script>
		<OPTION value=<?php echo $info1[subtype];?> selected="selected"><?php echo $info1[subtype];?></OPTION> 
        </select>
        </label></td>
    </tr>
    <tr>
      <td align="right">��Ʒ����:</td>
      <td><label>
        <input type="text" name="name" value="<?php echo $info1[name];?>" />
        </label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">��Ʒ����:</td>
      <td><input type="text" name="encode" value="<?php echo $info1[encode];?>"/></td>
      <td align="center"><label>��Ʒ����:</label></td>
      <td><input type="text" name="barcode" value="<?php echo $info1[barcode];?>" /></td>
    </tr>
    <tr>
      <td align="right">����ͺ�:</td>
      <td><input type="text" name="size" value="<?php echo $info1[size];?>"/></td>
      <td align="center">������λ:</td>
      <td><label>
        <?php
			$sql=mysql_query("select * from table_measureunit order by id desc",$conn);
			$info=mysql_fetch_array($sql);
			if($info==false)
			{
			  echo "������Ӽ�����λ!";
			}
			else
			{
			?>
            <select name="unit" class="inputcss">
			  <OPTION>--��ѡ��--</OPTION> 
			<?php
			do
			{
			?>
              <option value=<?php echo $info[name];?><?php if($info1[name]==$info[name]) {echo "selected";}?>><?php echo $info[name];?></option>
			<?php
			}
			while($info=mysql_fetch_array($sql));
			?>  
            </select>
            <?php
		     }
		    ?>
      </label></td>
    </tr>
    <tr>
      <td align="right">�������:</td>
      <td><input type="text" name="upperlimit"  value="<?php echo $info1[upperlimit];?>"onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/></td>
      <td align="center">�������:</td>
      <td><input type="text" name="lowerlimit"  value="<?php echo $info1[lowerlimit];?>"onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/></td>
    </tr>
    <tr>
      <td align="right">���ο���:</td>
      <td><input type="text" name="inprice"  value="<?php echo $info1[inprice];?>" style="ime-mode: disabled" imemode="disabled" /></td>
      <td align="center">����ο���:</td>
      <td><input type="text" name="outprice"  value="<?php echo $info1[outprice];?>"style="ime-mode: disabled" imemode="disabled" /></td>
    </tr>
    <tr>
      <td align="right">��ƷͼƬ:</td>
      <td><input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <input type="file" name="upfile" class="inputcss" size="16" /></td>
      <td align="center">�鿴ԭͼ��</td>
      <td>&nbsp;<a href="####" onmouseover='showPreview(event);' onmouseout='hidePreview(event);'><img src="../<?php echo $info1[tupian];?>"" alt="" width="30" height="30"  border="0" large-src="../<?php echo $info1[tupian];?>" pic-link="/"/></a></td>
    </tr>
    <tr>
      <td align="right">��Ʒ��飺</td>
      <td colspan="3"><textarea name="jianjie" cols="80" rows="8" class="inputcss"><?php echo $info1[jianjie];?></textarea></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input name="submit" type="submit" class="btn2" id="submit" value="����" />
        &nbsp;&nbsp;
        <input name="reset" type="reset" class="btn_2k3" value="ȡ��" /></td>
    </tr>
  </table>
</form>
</body>
</html>
