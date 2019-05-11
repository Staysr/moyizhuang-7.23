<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/js.js" ></script>
		<title></title>

<?
	session_start();	 
	if(isset($_SESSION['name'])){
?>
		<body style="width: 70%;margin: auto;">
	<form action="updateInfo.php" method="post">
	<table class="table table-bordered" >
	<thead> 
		<tr>
			标记<span style="color: red;font-size: 20px;">*</span>为必填项
		</tr>
	</thead>
	<?
		include("conn.php");
			header("Content-Type: text/html; charset=utf8");
			//{$_GET['name_id']}
			$result=mysqli_query($conn,"select * from info where name_id='{$_GET['name_id']}'");
			while($row=mysqli_fetch_array($result)){
	?>
	<tbody >
		<tr class="active">
			<td class="text-right">名称：</td>
			<td class="text-left">
				<input type="text" name="name" id="name" value="<? echo $row['name']; ?>" placeholder="<? echo $row['name']; ?>"/><span style="color: red;font-size: 20px;">*</span>
			</td>
			<td class="text-right">ID：</td>
			<td class="text-left">
				<input type="text" name="name_id" id="name_id" value="<? echo $row['name_id']; ?>" placeholder="<? echo $row['name_id']; ?>"/><span style="color: red;font-size: 20px;">*</span>
			</td>
			
		</tr>
		<tr class="active">
			<td class="text-right">粉丝：</td>
			<td class="text-left">
				<input type="text" name="fans" id="fans" value="<? echo $row['fans']; ?>"  placeholder="<? echo $row['fans']; ?>"/>
			</td>
			<td class="text-right">男女比例：</td>
			<td class="text-left">
				<input type="text" name="sex_f" id="sex_f" value="<? echo $row['sex_f']; ?>"  placeholder="<? echo $row['sex_f']; ?>"/>
			</td>
		</tr>
		
		<tr class="active">
			<td class="text-right">UV：</td>
			<td class="text-left">
				<input type="text" name="uv" id="uv" value="<? echo $row['uv']; ?>"  placeholder="<? echo $row['uv']; ?>"/>
			</td>
			<td class="text-right">单价：</td>
			<td class="text-left">
				<input type="text" name="jg" id="jg" value="<? echo $row['jg']; ?>"  placeholder="<? echo $row['jg']; ?>"/>
				<input type="text" name="jg1" id="jg1" value="<? echo $row['jg1']; ?>"  placeholder="<? echo $row['jg1']; ?>"/>
			</td>
		</tr>
		
		<tr class="active">
			<td class="text-right">客服QQ：</td>
			<td class="text-left">
				<input type="text" name="qq" id="qq" value="<? echo $row['qq']; ?>"  placeholder="<? echo $row['qq']; ?>"/><span style="color: red;font-size: 20px;">*</span>
			</td>
			
		</tr>
		
		<tr class="active">
			<td class="text-right">形式：<span style="color: red;font-size: 20px;">*</span></td>
			<td class="text-left">
				
				
				
				<label  class="btn btn-info">
		            <input  type="radio" name="xs" value="0" <? if($row['xs']==0) echo "checked";?>> 公司
		        </label>
		        <label  class="btn btn-info">
		            <input  type="radio" name="xs" value="1" <? if($row['xs']==1) echo "checked";?>> 个人
		        </label>				
			</td>
			<td class="text-right">男号/女号（多选）：<span style="color: red;font-size: 20px;">*</span></td>
			<td class="text-left">
				<label  class="btn btn-info">
		            <input  type="checkbox" name="lb[]" value="1" <? if(strpos($row['lb'],'0')!==false) echo "checked";?>> 男号
		        </label>
		        <label class="btn btn-info">
		            <input  type="checkbox" name="lb[]" value="0" <? if(strpos($row['lb'],'1')!==false) echo "checked";?>> 女号
		        </label>
			</td>
		</tr>
		
		
	</tbody>
	
	<?  
		  	}
		
	mysqli_close($conn);
			
		?>	  
	
</table>
  		<button type="submit" class="btn btn-success">修改</button>
  		<button type="button" class="btn btn-default">返回</button>
  		</form>
  		

</body>
<?
		
}else  header('location:skip.php?url=./index.php&info=非法访问！请登录');
?>
		
