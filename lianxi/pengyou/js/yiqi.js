// JavaScript Document
/*开源qq330729121*/
	var Zheight=document.documentElement.scrollHeight;
	var Zwidth = document.documentElement.scrollWidth;
	var Kheight = document.documentElement.clientHeight;
			function shanchutishi(){
				
					var zhezhao = document.getElementById("zhezhao");
					var tishik = document.getElementById("tishik");
				if(zhezhao){
					document.body.removeChild(zhezhao);
					document.body.removeChild(tishik);
					
				}
						if(arguments[0]){
					   		window.location.href=arguments[0];
					   }
					
						
			}
			/*弹出提示框
			img=1是错误图片
			img=2是正确图片
			weizhi是文字说明
			time是持续时间
			*/
				function tishi(img,wenzi,time){
					var zhezhao = document.createElement("div");
				   zhezhao.id="zhezhao";
				   zhezhao.style.height=Zheight+"px";
				   document.body.appendChild(zhezhao);
				var tishik = document.createElement("div");
				   	tishik.id="tishik";
				   	tishik.innerHTML="<div class=\"tsk-img\" align=\"center\">\
		<img src=\"images/icon/"+img+".png\"></div>\
		<div align=\"center\">\
			<p id=\"tsk-p\">"+wenzi+"</p>\
			</div>";
				   document.body.appendChild(tishik);
				    var DHeight= tishik.offsetHeight;
				   var DWidth = tishik.offsetWidth;
				   tishik.style.top=(Kheight-DHeight)/2+"px";	
				    tishik.style.left=(Zwidth-DWidth)/2+"px";	
					if(arguments[3]){
					   var url =arguments[3];
					   }else{
						   var url = "";
					   }
				   setTimeout("shanchutishi('"+url+"')",time);
				}

	function byId(id){
			return typeof(id) ==="string"?document.getElementById(id):id;
		}
	function Newopen(url){
		window.open(url);
	}
	function Dqopen(url){
		window.location.replace(url);
	}

function yiqilogin(){
			var user = byId("yiqi-js-user").value,
				pass = byId("yiqi-js-pass").value,
				wz = byId("yiqi-js-wz");
					if(user.value=="" || pass.value==""){
						wz.innerHTML="账号密码不能为空";
					   }else{
						if(user.length>20 || pass.length>30){
			   				wz.innerHTML="非法操作，拿个小本子记录一下IP";
						}else{
							var str2= user.replace(/[\-\_\,\!\|\~\`\(\)\#\$\%\^\&\*\{\}\:\;\"\L\<\>\?\！\￥\……\（\）\——\+\@\/]/g, '');// 去掉特殊字符
						   var hello = new XMLHttpRequest;
								hello.open("POST","denglu.php");
								hello.setRequestHeader("Content-type","application/x-www-form-urlencoded");
								hello.send("user=" + str2	
											+ "&pass=" + pass
										  );
								hello.onreadystatechange=function(){
											if(hello.readyState===4){
													if(hello.status===200){
														var fanhui = JSON.parse(hello.responseText);	
														if(fanhui.success){
														tishi(2,fanhui.msg,1500,"index.php");

														}else{
														tishi(1,fanhui.msg,1500,"login.php");

														}


													}
											}
										}

			   
								}
						 
					   	}
	}		
