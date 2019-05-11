<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		
		<script type="text/javascript" src="js/jquery1.7.2.js" ></script>
		<title>信息筛选</title>
		
		<script>
//			$(document).ready(function(){
//				$("#uv_1").change(function(){
//					$("#uv_2").val('');
//				});
//				$("#uv_2").change(function(){
//					var uv_1=$("#uv_1").val();
//					if(uv_1==''){
//						alert("请输入uv1");
//						
//					}	
//				});
//				
//				$("#jg_1").change(function(){
//					$("#jg_2").val('');
//				});
//				
//				$("#jg_2").change(function(){
//					var jg_1=$("#jg_1").val();
//					if(jg_1==''){
//						alert("请输入jg_1");
//					}	
//				});
//				
//				$("#jg1_1").change(function(){
//					$("#uv_2").val('');
//				});
//				$("#jg1_2").change(function(){
//					var jg1_1=$("#jg1_1").val();
//					if(jg1_1==''){
//						alert("请输入jg1_1");
//					}	
//				});
//				
//				$("#fans1").change(function(){
//					$("#uv_2").val('');
//				});
//				$("#fans2").change(function(){
//					var fans1=$("#fans1").val();
//					if(fans1==''){
//						alert("请输入fans2");
//					}	
//				});
//				
//				$("#qq").change(function(){
//					var qq=$("#qq").val();
//						$.get("inputJudge.php?qq="+qq,function(data,status){
//						$("#waring2").html(data);
//						if(data!='')
//							$("#qq").val("");
//					});			
//				});
//		
//
//		});
//		
		function isRegSubmit(form){
			
			if(form.uv_1.value){
				if(!form.uv_2.value){
					alert("请输入uv_2！");
					return false;
				}				
			}
			if(form.uv_2.value){
				if(!form.uv_1.value){
					alert("请输入uv_1");
					return false;
				}				
			}
			
			if(form.jg_1.value){
				if(!form.jg_2.value){
					alert("请输入jg_2！");
					return false;
				}				
			}
			if(form.jg_2.value){
				if(!form.jg_1.value){
					alert("请输入jg_1");
					return false;
				}				
			}
			
			if(form.jg1_1.value){
				if(!form.jg1_2.value){
					alert("请输入jg1_2！");
					return false;
				}				
			}
			if(form.jg1_2.value){
				if(!form.jg1_1.value){
					alert("请输入jg1_1");
					return false;
				}				
			}
			
			if(form.fans1.value){
				if(!form.fans2.value){
					alert("请输入fans2！");
					return false;
				}				
			}
			if(form.fans2.value){
				if(!form.fans1.value){
					alert("请输入fans1");
					return false;
				}				
			}
			
			
			if(!form.uv_1.value){
				alert("请输入uv！");
				return false;
			}
			if(!form.jg_1.value){
				alert("请输入软文单价！");
				return false;
			}
			if(!form.jg1_1.value){
				alert("请输入硬广单价！");
				return false;
			}
			if(!form.fans1.value){
				alert("请输入粉丝量！");
				return false;
			}
			
			if(!form.lb.value){
				alert("请选择男号/女号!");
				return false;
			}
			return true;
			
		}
		</script>
	</head>
	
	<body style="width: 80%;margin: auto;">
		<div class="jumbotron text-center">
		  <h1 class="text-center">信息筛选</h1>
		  <button type="submit" name="screening" class="btn btn-success" onclick="window.location.href='index.php'" >返回首页</button>
		<!--<?
		 session_start();	     
	    if(isset($_SESSION['username']) ){
	        echo "您好！{$_SESSION['name']},欢迎回来！";
	        echo "<a href='logout.php'>注销</a><br /><br />";
	    ?>
	   <?     
	        
	    }  
	    ?>-->
	
	<br />		
  		
  		<form action="" method="post" onsubmit="return isRegSubmit(this)">
			<table class="table table-bordered table-striped">
				<tr>
					<td>uv</td>
					<td>
						
						<input type="text" name="uv_1" id="uv_1" value="0" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>-
						<input type="text" name="uv_2" id="uv_2" value="10000000000" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
					</td>
					<td>软文单价	</td>
					<td>
						<input type="text" name="jg_1" id="jg_1" value="0" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>-
						<input type="text" name="jg_2" id="jg_2" value="10000000000" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
						
					</td>
					<td>硬广单价	</td>
					<td>
						<input type="text" name="jg1_1" id="jg1_1" value="0" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>-
						<input type="text" name="jg1_2" id="jg1_2" value="10000000000" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
						
					</td>
					
				</tr>
				<tr>
					<td>粉丝</td>
					<td>
						<input type="text" name="fans1" id="fans1" value="0" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>-
						<input type="text" name="fans2" id="fans2" value="10000000000" onchange="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}"/>
					</td>
					<td>男号/女号</td>
					<td>
						<label  class="btn btn-info">
				            <input  type="checkbox" name="lb[]" value="1" checked> 男号
				        </label>
				        <label class="btn btn-info">
				            <input  type="checkbox" name="lb[]" value="0" checked> 女号
				        </label>
					</td>
					<td>公司/个人</td>
					<td>
						<label  class="btn btn-info">
				            <input  type="radio" name="xs" value="0" checked> 公司
				        </label>
				        <label  class="btn btn-info">
				            <input  type="radio" name="xs" value="1"> 个人
				        </label>	
					</td>
					<td>
						<button type="submit" name="screening" class="btn btn-success" >筛选</button>
						
					</td>
				</tr>
				
			</table>
			
			
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
		
		
		
		
		
		<?
			include("conn.php");
	  		$num_rec_per_page=20;   // 每页显示数量
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			if (isset($_GET["group"])) { $group  = $_GET["group"]; } else { $group=1; };
			$start_from = ($page-1) * $num_rec_per_page; 
			
			if(isset($_POST['screening'])){
				
	    
				$uv_1=$_POST['uv_1'];
				$uv_2=$_POST['uv_2'];
				
				$jg_1=$_POST['jg_1'];
				$jg_2=$_POST['jg_2'];
				
				$jg1_1=$_POST['jg1_1'];
				$jg1_2=$_POST['jg1_2'];
				
				$fans1=$_POST['fans1'];
				$fans2=$_POST['fans2'];
				
				if(isset($_POST['xs'])){
					$xs=$_POST['xs'];
				}else $xs='';
				
				if(isset($_POST['lb'])){
					$lb=$_POST['lb'];
					if(!isset($lb[0]))
						$lb[0]="";
					if(!isset($lb[1]))
						$lb[1]="";
					$lbs=$lb[0].$lb[1];
				}else $lbs='';
				
				
				if($uv_1!='' && $jg_1!=''  && $jg1_1!=''  && $fans1!='' && $xs!='' && $lbs!=''){
$sql = "select * from info where (uv BETWEEN '{$uv_1}' AND '{$uv_2}') AND (jg BETWEEN '{$jg_1}' AND '{$jg_2}') AND (jg1 BETWEEN '{$jg1_1}' AND '{$jg1_2}') AND (fans BETWEEN '{$fans1}' AND '{$fans2}') AND (xs='{$xs}') AND (lb='{$lbs}') ";            
				echo $sql;				
				}else {
					$sql = "SELECT * FROM info  order by Id desc LIMIT $start_from, $num_rec_per_page "; 
					echo $sql;		
				}	
			
					
				
				
				
				
			}else{
				$sql = "SELECT * FROM info  order by Id desc LIMIT $start_from, $num_rec_per_page "; 
				echo $sql;	echo "没有";		
			}

			
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
  					if(isset($_SESSION['name'])){
  						if($_SESSION['name']=="管理员"){
  							echo $row['qq'];
  						}
  						else if($row['username']==$_SESSION['name']) 
  							echo $row['qq'];
  					}
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
  					if(isset($_SESSION['name'])){
  						if($_SESSION['name']=="管理员"){
	  						echo "修改";
	  					}
	  					else if($row['username']==$_SESSION['name']) 
	  						echo "修改";
  					}
  					
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
  		

	
		</div>
			
	</body>
</html>
