// JavaScript Document
//发送消息
function tk(form,maxtm){
	if(form.cont.value == ''){
		alert('发言不允许为空！');
		form.cont.focus();
		return false;
	}
	face = form.face.value;
	color = form.color.value;
	obt = form.obt.value;
	cont = form.cont.value;
	var url = "talk_chk.php?action=send&face="+face+"&color="+color+"&obt="+obt+"&cont="+cont;
	xmlhttp.open("GET",url,true);
	xmlhttp.onreadystatechange = callback;
	xmlhttp.send(null);
	form.cont.value = '';
	form.cont.focus();
	refrsh(maxtm);
	return false;
}

//改变说话对象
function changename(name){
	url = "talk_chk.php?action=to&name="+name;
	xmlhttp.open("get",url,true);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4){
			var msg = xmlhttp.responseText;
			top.bottomFrame.obtobt.innerHTML = msg;
		}
	}
	xmlhttp.send(null);
}
//退出

function logout(){
	alert('欢迎下次光临');
	top.location='logout.php';
}

//改变滚屏状态
function changeroll(form){
	url = "talk_chk.php?action=roll";
	if(!form.rollscreen1.checked){
		form.rollscreen1.checked = false;
		url = url + "&rollscreen=0";
	}else{
		form.rollscreen1.checked = true;
		url = url + "&rollscreen=1";
	}
	xmlhttp.open("get",url,true);
	xmlhttp.onreadystatechange = callback;
	xmlhttp.send(null);
	top.mainFrame.location = 'center.php';
	top.priFrame.location = 'private.php';
}

//刷新用户列表
function showlist(){
	url = "list_chk.php";
	xmlhttp.open("get",url,true);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4){
			if(xmlhttp.status == 200){
				var msg = xmlhttp.responseText;
				userlist.innerHTML = msg;
			}
		}
	}
	xmlhttp.send(null);
}

//刷新公共信息
function showpub(){
	url = "center_chk.php";
	xmlhttp.open('get',url,true);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4){
			var msg = xmlhttp.responseText;
			top.mainFrame.publist.innerHTML = msg;
		}
	}
	xmlhttp.send(null);
}

//刷新私聊信息
function showpriv(){
	url = "private_chk.php";
	xmlhttp.open('get',url,true);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4){
			var msg = xmlhttp.responseText;
			top.priFrame.privlist.innerHTML = msg;
		}
	}
	xmlhttp.send(null);
}

//处理函数
function callback(){
	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
		var msg = xmlhttp.responseText;
		if(msg == 1){
		}else{
			setTimeout('callback()',ceil(Math.random()) * 100);
		}
	}
}

//更新说话时间
function refrsh(maxtm){
	clearTimeout(timer);
	timer = window.setTimeout("logout()",maxtm);
}

//禁止刷新
function enterkey(){
	if(event.keyCode == 116){
		alert('禁止刷新');
		event.keyCode = 0;
		return false;
	}
}
document.onkeydown=enterkey;