<?php
	function dtcxsql($table,$ziduan,$neirong){//单条查询
		@$sql1='select * from '.$table.' where '.$ziduan.'="'.$neirong.'"';
		@$zxsql1=mysql_query($sql1);
		@$hqsql1=mysql_fetch_assoc($zxsql1);	
		return($hqsql1);
	}
	function xhcxsql($table,$ziduan,$neirong,$huoqu){//循环查询
		@$sql1='select * from '.$table.' where '.$ziduan.'="'.$neirong.'"';
		@$zxsql1=mysql_query($sql1);
		while (@$hqsql1=mysql_fetch_assoc($zxsql1)){
			return($hqsql1[$huoqu]);
		}
	}

  	date_default_timezone_set('PRC');
    $time=addslashes(date('Y-m-d H:i:s'));

if(getenv('HTTP_CLIENT_IP')) {
    $onlineip = getenv('HTTP_CLIENT_IP');
} elseif(getenv('HTTP_X_FORWARDED_FOR')) {
    $onlineip = getenv('HTTP_X_FORWARDED_FOR');
} elseif(getenv('REMOTE_ADDR')) {
    $onlineip = getenv('REMOTE_ADDR');
} else {
    $onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
}
  
	function tishi($tubiao,$shuoming,$time,$tiaozhuan){
			echo '<meta charset="utf-8">';
			echo '<link href="./style/yiqi.css" rel="stylesheet" />';
			echo '<script type="text/JavaScript" src="./js/yiqi.js"></script>';
			echo '<body></body>';
			echo '<script type="text/javascript">';
			echo 'tishi('.$tubiao.',"'.$shuoming.'",'.$time.',"'.$tiaozhuan.'");';
			 echo '</script>';
	}

	function Vip($id){
			if(@$id==1){
						echo '<img src="images/icon/v1.png">';
					}elseif(@$id==2){
						echo '<img src="images/icon/v2.png">';
					}elseif(@$id==3){
						echo '<img src="images/icon/v3.png">';
					}
	}




?>