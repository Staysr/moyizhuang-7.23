<?php include('system/pcon.php');?>
<div class="hy-head-menu">
	<div class="container">
	    <div class="row">
		  	<div class="item">
			    <div class="logo hidden-xs">
					<a class="hidden-sm hidden-xs" href="<?php echo $mkcms_domain;?>"><img src="<?php echo $mkcms_logo;?>" /></a>
		  			<a class="visible-sm visible-xs" href="<?php echo $mkcms_domain;?>"><img src="<?php echo $mkcms_logo;?>" /></a>											  
				</div>	
				<div class="search"> 
<form id="ff-search" role="search" action="<?php echo $mkcms_domain;?>seacher.php?wd=<?php echo $q?>" method="get">
                            <input class="form-control" placeholder="输入影片名称回车搜索..." type="text" id="ff-wd" name="wd" required="">
                            <input type="submit" class="hide"><a href="javascript:" class="btns" title="搜索" onClick="$('#ff-search').submit();"><i class="icon iconfont icon-sou"></i></a>
                  </form>
			   </div>			   
			   <ul class="menulist hidden-xs">
					<li><a href="<?php echo $mkcms_domain;?>">首页</a></li>
					<?php if($mkcms_dianying==1){?><li <?php echo $movie;?>><a href="<?php echo $mkcms_domain;?>movie.php">电影</a></li><?php }?>
					<?php if($mkcms_dianshi==1){?><li <?php echo $tv;?>><a href="<?php echo $mkcms_domain;?>tv.php">电视剧</a></li><?php }?>
					<?php if($mkcms_dongman==1){?><li <?php echo $dm;?>><a href="<?php echo $mkcms_domain;?>dongman.php">动漫</a></li><?php }?>
					<?php if($mkcms_zongyi==1){?><li <?php echo $zy;?>><a href="<?php echo $mkcms_domain;?>zongyi.php">综艺</a></li><?php }?>

										<?php
						$result = mysql_query('select * from mkcms_nav order by id asc');
						while($row = mysql_fetch_array($result)){
						?>
<li class="act<?php echo $row['id'];?>"><a href="<?php echo $row['n_url'];?>" target="_blank"><?php echo $row['n_name'];?></a></li>
<?php
						}
						?>

				</ul>													 
		  	</div>							
	    </div>
	</div>
</div>

