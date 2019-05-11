<!doctype html>
<?php
require_once('./conn/conn.php');
require_once('./conn/function.php');
session_start();
@$pengyou_user=$_SESSION['pengyou_user'];
?>
<html>
<head>
<meta charset="utf-8">
<title>朋友圈</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="style/reset.css">
<link rel="stylesheet" href="style/yiqi.css">
<link rel="stylesheet" href="style/main.css">
</head>
<script type="text/javascript" src="js/jQuery.min.js"></script>
<script type="text/javascript" src="js/yiqi.js"></script>
<body id='Body'>
	<div id='box'>
		<div id='dingwei'>
			<div class="pengyou-head">
				<div class="pengyou-head-left"><img src="images/icon/caidan2.png" onClick="tccebianlan()"></div>
				<div class="pengyou-head-right"><img src="images/icon/photo.png" onClick="Dqopen('shuoshuo.php')"></div>
			</div>
			<div class="pengyou-headimg">
				<div class="pengyou-touxiang">
					<div class="pengyou-touxiang-name" align="center">
						<p>crush</p>
					</div>
					<div class="pengyou-touxiang-img">
						<img src="images/touxiang/moren.jpeg">
					</div>
				</div>
			</div>
			<div id="pengyou-content">
			
					<?php 
					$sql='select * from pengyou_content ORDER BY time desc';
					$zxsql=mysql_query($sql);
					$z=0;
					while($hqsql=mysql_fetch_assoc($zxsql)){
						//print_r($hqsql);
						$username=$hqsql['username'];
						$content=$hqsql['content'];
						$time=$hqsql['time'];
						$weiyibiaoshi=$hqsql['Id'];
						@$hqsql1=dtcxsql(pengyou_user,username,$username);
						$name=$hqsql1['name'];
						$vip=$hqsql1['vip'];
						@$images_1=$hqsql['images_1'];
						@$images_2=$hqsql['images_2'];
						@$images_3=$hqsql['images_3'];
						@$images_4=$hqsql['images_4'];
						@$images_5=$hqsql['images_5'];
						@$images_6=$hqsql['images_6'];
						@$images_7=$hqsql['images_7'];
						@$images_8=$hqsql['images_8'];
						@$images_9=$hqsql['images_9'];
						$touxiang=$hqsql1['touxiang'];
						echo '<div class="pengyou-shuoshuo">';
						echo '<div class="pengyou-shuoshuo-left" align="center">';
						echo '<img src="images/touxiang/'.$touxiang.'">';
						echo '</div>';
						echo '<div class="pengyou-shuoshuo-right">';
						echo '<div class="pengyou-shuoshuo-right-name">';
						if($name){
							echo '<p title="">'.$name.'</p>';
						}else{
							echo '<p title="">'.$username.'</p>';
						}
						
							Vip($vip);
						echo '</div>';
						echo '<div class="pengyou-shuoshuo-right-wz">';
						echo '<span>'.$content.'</span>';
						if($images_2){
							echo '<div class="pengyou-photo">';
							
						}else{
							echo '<div class="pengyou-photo-one">';
						}
							if($images_1){
								echo '<img src="images/upload/'.$images_1.'" class="sltfd">';
							}
						if($images_2){
								echo '<img src="images/upload/'.$images_2.'" class="sltfd">';
							}
						if($images_3){
								echo '<img src="images/upload/'.$images_3.'" class="sltfd">';
							}
						if($images_4){
								echo '<img src="images/upload/'.$images_4.'" class="sltfd">';
							}
						if($images_5){
								echo '<img src="images/upload/'.$images_5.'" class="sltfd">';
							}
						if($images_6){
								echo '<img src="images/upload/'.$images_6.'" class="sltfd">';
							}
						if($images_7){
								echo '<img src="images/upload/'.$images_7.'" class="sltfd">';
							}
						if($images_8){
								echo '<img src="images/upload/'.$images_8.'" class="sltfd">';
							}
						if($images_9){
								echo '<img src="images/upload/'.$images_9.'" class="sltfd">';
							}
						echo '</div>';
						echo '</div>';
						echo '<div class="pengyou-shuoshuo-right-time">';
						echo '<span>'.$time.'</span>';
						echo '<div class="pengyou-shuoshuo-right-time-lm">';
						echo '<div class="pengyou-shuoshuo-right-time-lm-nr"  id="pengyou-lm'.$z.'">';
						echo '<div class="pengyou-shuoshuo-right-time-lm-nr-left" align="center" onclick="dianzan('.$weiyibiaoshi.','.$z.')">';
						echo '<img src="images/icon/xin2.png">';
						echo '<span>赞</span>';
						echo '</div>';
						echo '<div class="pengyou-shuoshuo-right-time-lm-nr-right" align="center" onClick="tcpinglunk('.$weiyibiaoshi.','.$z.')">';
						echo '<img src="images/icon/pinglun2.png">';
						echo '<span>评论</span>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
						echo '<div class="pengyou-shuoshuo-right-time-img" onClick="tcdzpl('.$z.')">';
						echo '<img src="images/icon/pinglun.png">';
						echo '</div>';
						echo '</div>';
						echo '<div class="pengyou-shuoshuo-right-pinglun" id="sspinglun'.$z.'">';
						
							@$sql2='select * from pengyou_zan where weiyibiaoshi="'.$weiyibiaoshi.'" ORDER BY time asc';
							@$zxsql2=mysql_query($sql2);
							$zanName=array();
							while (@$hqsql2=mysql_fetch_assoc($zxsql2)){
								if(!empty($hqsql2)){
									$zanuser=$hqsql2['username'];
									@$sql3='select * from pengyou_user where username="'.$zanuser.'"';
									@$zxsql3=mysql_query($sql3);
									while (@$hqsql3=mysql_fetch_assoc($zxsql3)){
										@$zanname=$hqsql3['name'];
										if(empty($zanname)){
											$zanname=$zanuser;
										}else{
											$zanname=$hqsql3['name'];
										}
										$zanName[]=$zanname;
									}
									
								}
									
							}
									if(count($zanName)>0){
										echo '<div class="pengyou-shuoshuo-right-pinglun-zan" id="zanlie'.$z.'">';
										echo '<img src="images/icon/xin.png">';
										
										foreach ($zanName as $lname){
											echo '<span>'.$lname.'</span>';
											
										
										}
										echo '</div>';
									}else{
										echo '<div class="pengyou-shuoshuo-right-pinglun-zan" id="zanlie'.$z.'" style="display:none">';
										echo '<img src="images/icon/xin.png">';
										echo '</div>';
									}
						
						$sql4='select * from pengyou_pinglun where weiyibiaoshi='.$weiyibiaoshi.' ORDER BY time asc';
						$zxsql4=mysql_query($sql4);
						while(@$hqsql4=mysql_fetch_assoc($zxsql4)){
							$hqname1=$hqsql4['name'];
							$hqusername1=$hqsql4['username'];
							$hqcontent=$hqsql4['content'];
							echo '<div class="pengyou-shuoshuo-right-pinglun-wz">';
							@$touser=$hqsql4['touser'];
							if(empty($touser)){
								echo '<div class="pengyou-shuoshuo-right-pinglun-wz-left">';
								echo '<span onclick="Dqopenuser('.$hqusername1.')">'.$hqname1.'</span>';
							}else{
								@$hqname3=dtcxsql(pengyou_user,username,$touser);
								@$hqname4=$hqname3['name'];
								echo '<div class="pengyou-shuoshuo-huifu">';
								echo '<span onclick="Dqopenuser('.$hqusername1.')">'.$hqname1.'</span>';
								if(empty($hqname3['name'])){
									echo '<span onclick="Dqopenuser('.$hqusername1.')">'.$touser.'</span>';
								}else{
									echo '<span onclick="Dqopenuser('.$hqusername1.')">'.$hqname4.'</span>';
								}
							}
							echo '</div>';
							echo '<div class="pengyou-shuoshuo-right-pinglun-wz-right">';
							echo '<span>'.$hqcontent.'</span>';
							echo '</div>';
							echo '</div>';
						}
						echo '</div>';
						echo '</div>';
						echo '<div class="clear"></div> ';
						echo '</div>';
						$z++;
					}
				mysql_close($con);
				?>
				
				<!--<div class="pengyou-shuoshuo">
					<div class="pengyou-shuoshuo-left" align="center">
						<img src="images/touxiang/moren.jpeg">
					</div>
					<div class="pengyou-shuoshuo-right">
						<div class="pengyou-shuoshuo-right-name">
							<p title="">一奇asasassa</p>
							<img src="images/icon/renzhen.png">
						</div>
						<div class="pengyou-shuoshuo-right-wz">
							<span>Hello,world!aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</span>
							<div class="pengyou-photo">
								<img src="images/touxiang/153520559137.jpg" class='sltfd'>
								<img src="images/touxiang/153520571146.jpg" class='sltfd'>
								<img src="images/touxiang/153520575657.jpg" class='sltfd'>
								<img src="images/touxiang/153520579235.png" class='sltfd'>
								<img src="images/touxiang/153520559137.jpg" class='sltfd'>
								<img src="images/touxiang/153520559137.jpg" class='sltfd'>
								<img src="images/touxiang/153520559137.jpg" class='sltfd'>
								<img src="images/touxiang/153520559137.jpg" class='sltfd'>
								<img src="images/touxiang/153520559137.jpg" class='sltfd'>
							</div>
						</div>
						<div class="pengyou-shuoshuo-right-time">
							<span>25分钟前</span>
							<div class="pengyou-shuoshuo-right-time-lm">
								<div class='pengyou-shuoshuo-right-time-lm-nr'  id="pengyou-lm0">
									<div class="pengyou-shuoshuo-right-time-lm-nr-left" align="center">
										<img src="images/icon/xin2.png">
										<span>赞</span>
									</div>
									<div class="pengyou-shuoshuo-right-time-lm-nr-right" align="center" onClick="tcpinglunk(0)">
										<img src="images/icon/pinglun2.png">
										<span>评论</span>
									</div>
								</div>
							</div>
							<div class="pengyou-shuoshuo-right-time-img" onClick="tcdzpl(0)">
								<img src="images/icon/pinglun.png">
							</div>
						</div>
						<div class="pengyou-shuoshuo-right-pinglun">
							<div class="pengyou-shuoshuo-right-pinglun-zan">
								<img src="images/icon/xin.png">
								<span>一奇</span>
								<span>Hello</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
							</div>
							<div class="pengyou-shuoshuo-right-pinglun-wz">
								<div class="pengyou-shuoshuo-right-pinglun-wz-left">
									<span>一奇啊</span>
								</div>
								<div class="pengyou-shuoshuo-right-pinglun-wz-right">
									<span>哈哈哈哈啦啦啦哈哈哈哈啦啦啦哈哈哈哈啦啦啦哈哈哈哈啦啦啦</span>
								</div>
							</div>
							<div class="pengyou-shuoshuo-right-pinglun-wz">
								<div class="pengyou-shuoshuo-huifu">
									<span>一奇啊</span>
									<span>Hello</span>
								</div>
								<div class="pengyou-shuoshuo-right-pinglun-wz-right">
									<span>哈哈哈哈啦啦啦哈哈哈哈啦啦啦哈哈哈哈啦啦啦哈哈哈哈啦啦啦</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clear"></div> 
				</div>
				<div class="pengyou-shuoshuo">
					<div class="pengyou-shuoshuo-left" align="center">
						<img src="images/touxiang/moren.jpeg">
					</div>
					<div class="pengyou-shuoshuo-right">
						<div class="pengyou-shuoshuo-right-name">
							<p title="">一奇asasassa</p>
						</div>
						<div class="pengyou-shuoshuo-right-wz">
							<span>Hello,world!aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</span>
							<div id="pengyou-photo-one">
								<img src="images/touxiang/153520559137.jpg" class='sltfd'>
							</div>
						</div>
						<div class="pengyou-shuoshuo-right-time">
							<span>25分钟前</span>
							<div class="pengyou-shuoshuo-right-time-lm">
								<div class='pengyou-shuoshuo-right-time-lm-nr'  id="pengyou-lm1">
									<div class="pengyou-shuoshuo-right-time-lm-nr-left" align="center">
										<img src="images/icon/xin2.png">
										<span>赞</span>
									</div>
									<div class="pengyou-shuoshuo-right-time-lm-nr-right" align="center" onClick="tcpinglunk(1)">
										<img src="images/icon/pinglun2.png">
										<span>评论</span>
									</div>
								</div>
							</div>
							<div class="pengyou-shuoshuo-right-time-img" onClick="tcdzpl(1)">
								<img src="images/icon/pinglun.png">
							</div>
						</div>
						<div class="pengyou-shuoshuo-right-pinglun">
							<div class="pengyou-shuoshuo-right-pinglun-zan">
								<img src="images/icon/xin.png">
								<span>一奇</span>
								<span>Hello</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
								<span>哈哈</span>
							</div>
							<div class="pengyou-shuoshuo-right-pinglun-wz">
								<div class="pengyou-shuoshuo-right-pinglun-wz-left">
									<span>一奇啊</span>
								</div>
								<div class="pengyou-shuoshuo-right-pinglun-wz-right">
									<span>哈哈哈哈啦啦啦哈哈哈哈啦啦啦哈哈哈哈啦啦啦哈哈哈哈啦啦啦</span>
								</div>
							</div>
							<div class="pengyou-shuoshuo-right-pinglun-wz">
								<div class="pengyou-shuoshuo-right-pinglun-wz-left" id="pengyou-shuoshuo-right-pinglun-wz-left">
									<span>一奇啊</span>
									<span>Hello</span>
								</div>
								<div class="pengyou-shuoshuo-right-pinglun-wz-right">
									<span>哈哈哈哈啦啦啦哈哈哈哈啦啦啦哈哈哈哈啦啦啦哈哈哈哈啦啦啦</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clear"></div> 
				</div>-->
				<div id='pinglun-pinglun' style="display: none;">
					<div class="pinglun-dingwei" align="center">
						<input type="text" placeholder="评论" maxlength="300" id="pinglunk">
					</div>
				</div>
			</div>
		</div>
			<div id='pengyou-cebianlandingwei'>
				<div id="pengyou-cebianlan">
					<div class="pengyou-cebianlan-touxiang" align="center">
						<?php
							@$hqtouxiang = dtcxsql(pengyou_user,username,$pengyou_user);
							$hqtx = $hqtouxiang['touxiang'];
							if(empty($hqtx)){
								echo '<img src="images/icon/pengyouquan.jpg"  id="touxiang">';
							}else{
								echo '<img src="images/touxiang/'.$hqtx.'"  id="touxiang">';
							}
						?>
						<p>欢迎你<?php if(@$pengyou_user){echo $pengyou_user;}else{echo "游客";}?></p>
					</div>
					<div align="left" class="pengyou-cebianlan-left">
						<ul>
							<li  onClick="Dqopen('index.php')"><img src="images/icon/zy.png"><a href="#">首页</a></li>
							<li onClick="Dqopen('login.php')"><img src="images/icon/user3.png"><a href="#">登录</a></li>
							<li onClick="Dqopen('register.php')"><img src="images/icon/reg1.png"><a href="#">注册</a></li>
							<li  onClick="Dqopen('user.php')"><img src="images/icon/geren2.png"><a href="#">个人中心</a></li>
							<li onClick="Dqopen('')"><img src="images/icon/xg1.png"><a href="#">修改资料</a></li>
							<li onClick="Dqopen('')"><img src="images/icon/pass8.png"><a href="#">修改密码</a></li>
							<li onClick="Dqopen('zx.php')"><img src="images/icon/zx.png"><a href="#">注销</a></li>
						</ul>
				</div>
				</div>
			</div>
	</div>
<!--	<div id="zhezhao2"></div>
	<div id='pengyou-fdimg'>
		<img onClick="fdimg(1)" src="images/touxiang/153520559137.jpg">
	</div>-->
</body>
	<script type="text/javascript" src="js/pengyou.js"></script>
	<script type="text/javascript">
			function wcimg(){
				byId('zhezhao2').remove();
				byId('pengyou-fdimg').remove();
			}
				function csa(){
					wcimg();
				}
	</script>
</html>