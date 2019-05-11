<?php
//公用函数库

//提示函数
function msg($text,$t=1) {
    if ($t == 1) {
        exit("<script language='javascript'>alert('$text');history.go(-1);</script>");
    }else{
		exit("<script language='javascript'>alert('$text');window.location.href='".$t."';</script>");
	}
}

//判断提交值是否为空
function isnull($key,$t='post') {
	if ($t == 'post'){
		if ($_POST[$key] != ''){
			return $_POST[$key];
		}else{
			msg('所有项不能为空!');
		}
	}else if ($t == 'get'){
		if ($_GET[$key] != ''){
			return $_GET[$key];
		}else{
			msg('所有相不能为空!');
		}
	}
}
