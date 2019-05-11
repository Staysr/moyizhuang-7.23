<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		
		<script type="text/javascript" src="js/jquery1.7.2.js" ></script>
		<title></title>
	</head>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#name_id").change(function(){
				var name_id=$("#name_id").val();
					$.get("inputJudge.php?name_id="+name_id,function(data,status){
					$("#waring1").html(data);
					if(data!='')
						$("#name_id").val("");
				});			
			});
			
			$("#qq").change(function(){
				var qq=$("#qq").val();
					$.get("inputJudge.php?qq="+qq,function(data,status){
					$("#waring2").html(data);
					if(data!='')
						$("#qq").val("");
				});			
			});
		

		});
		
		
function isRegSubmit1(form){
	if(!form.name.value){
		alert("请输入名称！");
		return false;
	}else if(!form.name_id.value){
		alert("请输入ID！");
		return false;
	}else if(!form.qq.value){
		alert("请输入客户QQ！");
		return false;
	}else if(!form.xs.value){
		alert("请选择形式！");
		return false;
	}else if(!form.lb.value){
		alert("请选择男号/女号！");
		return false;
	}
	return true;
}
			</script>
	<body style="width: 70%;margin: auto;">
		<div class="jumbotron text-center">
		  <h1 class="text-center">信息录入</h1>
		<?
		 session_start();	     
	    if(isset($_SESSION['username']) ){
	        echo "您好！{$_SESSION['name']},欢迎回来！";
	        echo "<a href='logout.php'>注销</a><br /><br />";
	    ?>
	   <form action="insertInfo.php" method="post" onsubmit="return isRegSubmit1(this)">
	<table class="table table-bordered" >
	<thead>
		<tr>
			标记<span style="color: red;font-size: 20px;">*</span>为必填项
		</tr>
	</thead>
	<tbody >
		<tr class="active">
			<td class="text-right">名称：</td>
			<td class="text-left">
				<input type="text" name="name" id="name" placeholder="请输入名称"/><span style="color: red;font-size: 20px;">*</span>
				
			</td>
			<td class="text-right">ID：</td>
			<td class="text-left">
				<input type="text" name="name_id" id="name_id" value="" placeholder="请输入ID"/><span style="color: red;font-size: 20px;">*</span>
				<span id="waring1" style="color: red;">	</span>
			</td>
			
		</tr>
		<tr class="active">
			<td class="text-right">粉丝：</td>
			<td class="text-left">
				<input type="text" name="fans" id="fans" value=""  placeholder="请输入粉丝数" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
			</td>
			<td class="text-right">男女比例：</td>
			<td class="text-left">
				<input type="text" name="sex_f" id="sex_f" value=""  placeholder="请输入男女比例" />
			</td>
		</tr>
		
		<tr class="active">
			<td class="text-right">UV：</td>
			<td class="text-left">
				<input type="text" name="uv" id="uv" value=""  placeholder="请输入UV" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
			</td>
			<td class="text-right">单价：</td>
			<td class="text-left">
				<input type="text" name="jg" id="jg" value=""  placeholder="请输入软文单价" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
				<input type="text" name="jg1" id="jg1" value=""  placeholder="请输入硬广单价" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
			</td>
		</tr>
		
		<tr class="active">
			<td class="text-right">客服QQ：</td>
			<td class="text-left">
				<input type="text" name="qq" id="qq" value=""  placeholder="请输入客户QQ" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/><span style="color: red;font-size: 20px;">*</span>
				<span id="waring2" style="color: red;">	</span>
			</td>
			
		</tr>
		
		<tr class="active">
			<td class="text-right">形式：<span style="color: red;font-size: 20px;">*</span></td>
			<td class="text-left">
				<label  class="btn btn-info">
		            <input  type="radio" name="xs" value="0"> 公司
		        </label>
		        <label  class="btn btn-info">
		            <input  type="radio" name="xs" value="1"> 个人
		        </label>				
			</td>
			<td class="text-right">男号/女号（多选）：<span style="color: red;font-size: 20px;">*</span></td>
			<td class="text-left">
				<label  class="btn btn-info">
		            <input  type="checkbox" name="lb[]" value="1"> 男号
		        </label>
		        <label class="btn btn-info">
		            <input  type="checkbox" name="lb[]" value="0"> 女号
		        </label>
			</td>
		</tr>
		
		
	</tbody>
	
</table>
  		<button type="submit" name="submit" class="btn btn-success">提交</button>
  		<button type="button" class="btn btn-danger">重置</button>  		
  		</form>
  		<br /><br /><br />
  		<table class="table table-bordered table-striped" >
	<thead>
		<tr >
			<th class="text-center">名称</th>
			<th class="text-center">ID</th>
			<th class="text-center">粉丝</th>
			<th class="text-center">男女比例</th>
			<th class="text-center">UV</th>
			<th class="text-center">软文单价</th>
			<th class="text-center">硬广单价</th>			
			<th class="text-center">QQ</th>
			<th class="text-center">形式</th>
			<th class="text-center">类别</th>
			<th class="text-center">录入者</th>
		</tr>
	</thead>
	<tbody >
		
		<form action="" method="post">
			<input id="searchid" name="searchid"  type="text" style="margin-right: 20px;" placeholder="ID查询"/>
			<button type="submit" class="btn btn-success" style="margin-right: 20px;">搜索</button>			
		</form>
		<form action="" method="post">
			<input id="searchqq" name="searchqq"  type="text" style="margin-right: 20px;" placeholder="QQ查询" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
			<button type="submit" class="btn btn-success">搜索</button>			
		</form>
		<form action="" method="post">
			<button type="submit" class="btn btn-success">显示全部</button>
		</form>
		<?
			if($_SESSION['name']=="管理员"){
  						echo "<button type=\"button\" class=\"btn btn-default\" onclick=\"window.location.href='down.php'\">导出Excel</button>";
  						echo "<button type=\"button\" class=\"btn btn-default\" onclick=\"window.location.href='import/index.php'\">导入Excel</button>";
  			}
		?>
		
		
		<button type="button" class="btn btn-default" onclick="window.location.href='screening.php'">筛选</button>
		<?
			include("conn.php");
	  		$num_rec_per_page=20;   // 每页显示数量
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			if (isset($_GET["group"])) { $group  = $_GET["group"]; } else { $group=1; };
			$start_from = ($page-1) * $num_rec_per_page; 
			
			if(isset($_POST['searchid'])){
  				$sql = "SELECT * FROM info where name_id='{$_POST['searchid']}' order by Id desc LIMIT $start_from, $num_rec_per_page "; 
  		}else if(isset($_POST['searchqq'])){
  				$sql = "SELECT * FROM info where qq='{$_POST['searchqq']}' order by Id desc LIMIT $start_from, $num_rec_per_page "; 
  		}else
			$sql = "SELECT * FROM info  order by Id desc LIMIT $start_from, $num_rec_per_page "; 
			$result = mysqli_query($conn,$sql); // 查询数据
  						
			//$result=mysqli_query($conn,"select * from info order by Id desc");
			while($row=mysqli_fetch_array($result)){
			?>
  		<tr>
  			<td class="text-center"><? echo $row['name']; ?></td>
  			<td class="text-center"><? echo $row['name_id']; ?></td>
  			<td class="text-center"><? echo $row['fans']; ?></td>
  			<td class="text-center"><? echo $row['sex_f']; ?></td>
  			<td class="text-center"><? echo $row['uv']; ?></td>
  			<td class="text-center"><? echo $row['jg']; ?></td>
  			<td class="text-center"><? echo $row['jg1']; ?></td>
  			<td class="text-center">
  				
  				<? 
  					if($_SESSION['name']=="管理员"){
  						echo $row['qq'];
  					}
  					else if($row['username']==$_SESSION['name']) 
  						echo $row['qq'];
  					else echo "******";
  				?>
  			</td>
  			<td class="text-center">
  				<? if($row['xs']==0) echo "公司";else echo "个人"; ?>
  				
  			</td>
  			<td class="text-center">  				
  					<? if(strpos($row['lb'],'0')!==false) echo " 女号 ";?>
  					<? if(strpos($row['lb'],'1')!==false) echo " 男号 ";?>  				
  			</td>
  			<td class="text-center"><? echo $row['username']; ?></td>
  			<td class="text-center">
  				
  				
  				
  			<a href="update.php?name_id=<? echo $row['name_id']; ?>">
  				<? 
  					if($_SESSION['name']=="管理员"){
  						echo "修改";
  					}
  					else if($row['username']==$_SESSION['name']) 
  						echo "修改";
  				?>
  				
  			</a>
  				
  				</td>
  		</tr>
  		<?  
		  }			
		?>
  		
	</table>
<?
$sql = "SELECT * FROM info "; 
$rs_result = mysqli_query($conn,$sql); //查询数据
$total_records = mysqli_num_rows($rs_result);  // 统计总共的记录条数
$total_pages = ceil($total_records / $num_rec_per_page);  // 计算总页数
$num_rec_per_group=3;// 每页组显示页数量
$total_groups=ceil($total_pages / $num_rec_per_group);  // 计算总页组数
//
//echo "<br/>数据共".$total_records."项";
//echo "<br/>数据共".$total_pages."页";
//echo "<br/>数据共".$total_groups."页组";
//echo "<br/>现在是第".$page."页";
//echo "<br/>";
?>

<nav >
  <ul class="pager">
    <li><a href="index.php?page=1">首页</a></li>
    <li><a href="index.php?page=<? echo $total_pages;?>&group=<?echo $total_groups; ?>">尾页</a></li>
  </ul>
</nav>
<nav aria-label="Page navigation" style="text-align: center;">
  <ul   class="pagination">
  	<?
  		if($group==1){
  	?>
	  	<li aria-label="Previous" class="disabled">	      
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
  	<?
  		}else{
  	?>
	  	<li aria-label="Previous">
	      <a href="index.php?group=<?echo $group-1; ?>&page=<?echo ($group-2)*$num_rec_per_group+1; ?>" >
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
  	<?
  		}
  	?>
  	
    <?
    	//$group=;//页组
    	//$num_rec_per_group=3;// 每页组显示页数量
    	for ($i=1; $i<=$total_pages; $i++) {
    		
    		if($i<=$group*$num_rec_per_group && ($group-1)*$num_rec_per_group<$i){
    			if($page==$i) {
	    			echo "<li class=\"active\"><a href='index.php?page=".$i."'>".$i."</a></li> ";  
	    		}else{    			
	    			echo "<li><a href='index.php?page=".$i."'>".$i."</a></li> "; 
	    		}
    		}          
		};
    ?>
    
    <?
  		if($group==$total_groups){
  	?>
	  	<li aria-label="Next" class="disabled">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  	<?
  		}else{
  	?>
	  	<li aria-label="Next">
      <a href="index.php?group=<?echo $group+1; ?>&page=<?echo ($group)*$num_rec_per_group+1; ?>" >
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  	<?
  		}
  	?>
  </ul>
</nav>

<?
	mysqli_close($conn);
?>

	</tbody >
	</table>
  		
  		
	        
	   <?     
	        
	    }  else {
	    	?>
	<!-- 登录-->
	<form class="form-inline" action="loginJudge.php" method="post">
		<br />		
	  <div class="form-group">	    
	    <input type="text" class="form-control" name="username" placeholder="请输入用户名">
	  </div>
	  <div class="form-group">	  
	    <input type="password" class="form-control" name="password" placeholder="请输入密码">
	  </div>
	  <button type="submit" class="btn btn-default">登录</button>
	  <button type="button" class="btn btn-default" onclick="location='register/index.php'">注册</button>
	</form>
	<br /><br />
	
	<table class="table table-bordered table-striped" >
	<thead>
		<tr >
			<th class="text-center">名称</th>
			<th class="text-center">ID</th>
			<th class="text-center">粉丝</th>
			<th class="text-center">男女比例</th>
			<th class="text-center">UV</th>
			<th class="text-center">软文单价</th>
			<th class="text-center">硬广单价</th>			
			<th class="text-center">QQ</th>
			<th class="text-center">形式</th>
			<th class="text-center">类别</th>
			<th class="text-center">录入者</th>
		</tr>
	</thead>
	<tbody >
		<form action="" method="post">
			<input id="searchid" name="searchid"  type="text" style="margin-right: 20px;" placeholder="ID查询"/>
			<button type="submit" class="btn btn-success" style="margin-right: 20px;">搜索</button>			
		</form>
		<form action="" method="post">
			<input id="searchqq" name="searchqq"  type="text" style="margin-right: 20px;" placeholder="QQ查询"/>
			<button type="submit" class="btn btn-success">搜索</button>			
		</form>
		<form action="" method="post">
			<button type="submit" class="btn btn-success">显示全部</button>
		</form>
		
		
		<button type="button" class="btn btn-default" onclick="window.location.href='screening.php'">筛选</button>
		<?
			include("conn.php");
	  		$num_rec_per_page=20;   // 每页显示数量
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			if (isset($_GET["group"])) { $group  = $_GET["group"]; } else { $group=1; };
			$start_from = ($page-1) * $num_rec_per_page; 
			
			if(isset($_POST['searchid'])){
  				$sql = "SELECT * FROM info where name_id='{$_POST['searchid']}' order by Id desc LIMIT $start_from, $num_rec_per_page "; 
  		}else if(isset($_POST['searchqq'])){
  				$sql = "SELECT * FROM info where qq='{$_POST['searchqq']}' order by Id desc LIMIT $start_from, $num_rec_per_page "; 
  		}else
			$sql = "SELECT * FROM info  order by Id desc LIMIT $start_from, $num_rec_per_page ";
			
			$result = mysqli_query($conn,$sql); // 查询数据
  						
			//$result=mysqli_query($conn,"select * from info order by Id desc");
			while($row=mysqli_fetch_array($result)){
			?>
  		<tr>
  			<td class="text-center"><? echo $row['name']; ?></td>
  			<td class="text-center"><? echo $row['name_id']; ?></td>
  			<td class="text-center"><? echo $row['fans']; ?></td>
  			<td class="text-center"><? echo $row['sex_f']; ?></td>
  			<td class="text-center"><? echo $row['uv']; ?></td>
  			<td class="text-center"><? echo $row['jg']; ?></td>
  			<td class="text-center"><? echo $row['jg1']; ?></td>
  			<td class="text-center">
  				<? 
  					
  					echo "******";
  				?>
  			</td>
  			<td class="text-center">
  				<? if($row['xs']==0) echo "公司";else echo "个人"; ?>
  				
  			</td>
  			<td class="text-center">  				
  					<? if(strpos($row['lb'],'0')!==false) echo " 女号 ";?>
  					<? if(strpos($row['lb'],'1')!==false) echo " 男号 ";?>  				
  			</td>
  			<td class="text-center"><? echo $row['username']; ?></td>
  			<td class="text-center">
  				
  			
  				</td>
  		</tr>
  		<?  
		  }			
		?>
  		
	</table>
<?
$sql = "SELECT * FROM info"; 
$rs_result = mysqli_query($conn,$sql); //查询数据
$total_records = mysqli_num_rows($rs_result);  // 统计总共的记录条数
$total_pages = ceil($total_records / $num_rec_per_page);  // 计算总页数
$num_rec_per_group=3;// 每页组显示页数量
$total_groups=ceil($total_pages / $num_rec_per_group);  // 计算总页组数
//
//echo "<br/>数据共".$total_records."项";
//echo "<br/>数据共".$total_pages."页";
//echo "<br/>数据共".$total_groups."页组";
//echo "<br/>现在是第".$page."页";
//echo "<br/>";
?>

<nav >
  <ul class="pager">
    <li><a href="index.php?page=1">首页</a></li>
    <li><a href="index.php?page=<? echo $total_pages;?>&group=<?echo $total_groups; ?>">尾页</a></li>
  </ul>
</nav>
<nav aria-label="Page navigation" style="text-align: center;">
  <ul   class="pagination">
  	<?
  		if($group==1){
  	?>
	  	<li aria-label="Previous" class="disabled">	      
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
  	<?
  		}else{
  	?>
	  	<li aria-label="Previous">
	      <a href="index.php?group=<?echo $group-1; ?>&page=<?echo ($group-2)*$num_rec_per_group+1; ?>" >
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
  	<?
  		}
  	?>
  	
    <?
    	//$group=;//页组
    	//$num_rec_per_group=3;// 每页组显示页数量
    	for ($i=1; $i<=$total_pages; $i++) {
    		
    		if($i<=$group*$num_rec_per_group && ($group-1)*$num_rec_per_group<$i){
    			if($page==$i) {
	    			echo "<li class=\"active\"><a href='index.php?page=".$i."'>".$i."</a></li> ";  
	    		}else{    			
	    			echo "<li><a href='index.php?page=".$i."'>".$i."</a></li> "; 
	    		}
    		}          
		};
    ?>
    
    <?
  		if($group==$total_groups){
  	?>
	  	<li aria-label="Next" class="disabled">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  	<?
  		}else{
  	?>
	  	<li aria-label="Next">
      <a href="index.php?group=<?echo $group+1; ?>&page=<?echo ($group)*$num_rec_per_group+1; ?>" >
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  	<?
  		}
  	?>
  </ul>
</nav>

<?
	mysqli_close($conn);
?>

	</tbody >
	</table>
	
	
	
	
	
	
	
	
	
	
	
	<?
	  }    
	?>	
	
		</div>
			
	</body>
</html>
