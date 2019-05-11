<?php
	session_start();
	header("Content-Type:text/html;charset=utf-8");
	header("CACHE-CONTROL:NO-CACHE");
	include_once 'config.php';
	include_once 'func.php';
	$reback = 0;
	if($_SESSION['user'] != ''){
		if($_GET['action'] == 'send'){ 
			$user = $_SESSION['user'];					//说话人
			$cont = $_GET['cont'];						//说话内容
			$now = date('H:i:s');
			$newline = '[<font color=blue>'.$user.'</font>]<font color=red>'.$_GET['face'].'</font>对[<font color=green>'.$_GET['obt'].'</font>]说：<font color='.$_GET['color'].'>'.$cont.'</font>&nbsp;[<font color=brown>'.$now.'</font>]';
			$tmpsend = 'priv/'.$user;
			$tmpto = 'priv/'.$_GET['obt'];
			if($_GET['obt'] == '所有人'){
				$boo = addmess(MESS,$newline);
				if($boo){
					$reback = '1';
				}else{
					$reback = '2';
				}
			}else if($_GET['obt'] == $user){
				$newline = '[<font color="pink">系统公告</font>]：<font color="red">神经病，别自言自语!!</font>&nbsp;[<font color=brown>'.date('H:i:s').'</font>]';
				$boo = addmess($tmpsend,$newline);
				if($boo){
					$reback = '1';
				}else{
					$reback = '2';
				}
			}else{
				if(file_exists($tmpto)){
					$boo = addmess($tmpsend,$newline);
					if($boo){
						$boo = addmess($tmpto,$newline);
						if($boo){
							$reback = '1';
						}else{
							$reback = '2';
						}
					}else{
						$reback = '2';
					}
				}else{
					$newline = '[<font color="pink">系统公告</font>]：<font color="red">该用户已退出， 请重新选择聊天对象。</font>&nbsp;[<font color=brown>'.date('H:i:s').'</font>]';
					$boo = addmess($tmpsend,$newline);
					if($boo){
						$reback = '1';
					}else{
						$beback = '2';
					}
				}
			}
		}else if($_GET['action'] == 'to'){
			$name = $_GET['name'];
			if(!in_array($name,$_SESSION['per'])){
				$_SESSION['per'][] = $name;
			}
			$tmp = "<select id=\"obt\" name=\"obt\">";
			foreach($_SESSION['per'] as $value){
				if($name == $value){
					$tmp .= "<option value=".$value." selected='selected'>".$value."</option>";
				}else{
					$tmp .= "<option value=".$value.">".$value."</option>";
				}
			}
			$tmp .= "</select>";
			$reback = $tmp;
			
		}else if($_GET['action'] == 'roll'){
			$_SESSION['rollscreen'] = $_GET['rollscreen'];
			$reback = "1";
		}
	}
	echo $reback;
?>