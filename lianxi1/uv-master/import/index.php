<meta charset="utf-8" />
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		
		<script type="text/javascript" src="../js/jquery1.7.2.js" ></script>
		<title>导入数据</title>
 <h1 class="text-center">数据导入</h1>
 <p class="text-center" style="color: red;">**危险操作，请谨慎操作**</p>
<form name="form2" method="post" enctype="multipart/form-data" action="upload_excel.php" >
<input type="hidden" name="leadExcel" value="true" >
<table align="center" width="60%" border="0">
<tr>
   <td>
    <input type="file" name="inputExcel"><br />
    <input type="submit" name="import" value="导入数据" class="btn btn-danger">
    <input type="button"onclick="window.location.href='../index.php'" value="返回首页" class="btn btn-success">
   </td>
</tr>
</table>
</form>