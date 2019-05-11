<?php
/* 检查用户昵称是否重复
 * 参数$user是登录用户的昵称
 * 返回值为true时，昵称可用
 * 返回值为false时，昵称不可用
 */
function chklogin($file,$user){
	$boo = false;
	if(file_exists($file)){
		$userarr = file($file);
		/* 判断昵称是否重复 */
		foreach($userarr as $value){	//判断昵称是否重复
			$tmparr = explode('#',$value);	//使用"#"作为分隔符来拆分字符串
			if($user == $tmparr[0]){	//如果用户数组中包含此用户
				$boo = true;
				break;
			}
		}
	}
	return $boo;
}
/* 将登录的用户昵称写入到文件中
 * 保存格式为：昵称#ip#登录时间
 * $file：保存文件地址
 * $user：昵称
 * $ip：登录IP
 * $sex：性别
 */
function addlogin($file,$user,$ip,$sex){
	$tmp = $user.'#'.$ip.'#'.$sex.chr(13).chr(10);  //chr(13) 是一个回车,Chr(10) 是个换行符,chr(32) 是一个空格符
	$fp = fopen($file,'a');   //写入方式在文件末尾追加信息
	$boo = fwrite($fp,$tmp);
	fclose($fp);
	return $boo;
}
/* 将用户列表转为数组
 * $file：用户列表文件
 */
function storeuser($file){
	$tmparr = file($file);		//将文件内容写入数组
	$userarr = array();		//创建数组
	foreach($tmparr as $value){		//循环输出数组内容
		$tmparr = explode('#',$value);	//使用#拆分字符串
		$userarr[] = $tmparr[0].','.$tmparr[2];		//将用户名和用户性别保存到新数组中
	}
	return $userarr;
}
/* 将发言内容写入到文件中
 * $file：保存文件地址
 * $mess：保存内容
 */
function addmess($file,$mess){
	$fp = fopen($file,'a');		//以追加的形式打开文件
	$boo = fwrite($fp,$mess.chr(13).chr(10));	//将信息写入文件中
	fclose($fp);	//关闭文件
	return boo;
}
/* 在文件中删掉用户
 * $file：保存文件地址
 * $user：要删除的用户
 */
function deluser($file,$user){
	$tmparr = file($file);		//将文件内容写入数组
	$rearr = array();	//创建数组
	foreach($tmparr as $value){		//循环输出数组内容
		$tmp = explode('#',$value);		//使用#拆分字符串
		if($tmp[0] != $user){	//如果变量中的用户名和当前用户不相等
			$rearr[] = $value;	//将该用户信息保存到新数组中
		}
	}
	$fp = fopen($file,'w+');	//以只写的方式打开文件
	foreach($rearr as $value){	//循环数组
		fwrite($fp,$value);		//写入数组内容
	}
	fclose($fp);	//关闭文件
}
/* 用户登录时，信息文件的行数
 * $file：文件名
 */
function getRows($file){
	if(file_exists($file)){		//如果文件存在
		$fl = file($file);		//将文件按行写入数组
		return count($fl);		//求出数组长度并返回
	}else{
		return 0;		//如果文件不存在，返回0
	}
}
?>