// JavaScript Document
function thkg(txt){
	 txt = txt.replace(/[ ]/g,"");
	 txt = txt.replace(/[\r\n]/g,"")
		return txt;
}
function RegeMatch(){
    var pattern = new RegExp("[~'!@#$%^&*()-+_=:]");  
    if($("#reg-username").val() != "" && $("#reg-username").val() != null){  
        if(pattern.test($("#reg-username").val())){  
            $("#reg-username").val=="";  
            $("#reg-username").focus();  
            return false;  
        }else{
			return true; 
		}  
    }else{
		 return false;  
	}
}
$("#reg-username").on(" input propertychange",function(){
  	if(RegeMatch()==false){
		$("#reg-username").css('border-bottom','1px solid red');
		$("#regtishi").text('账号不能使用特殊字符或者为空');
	}else{
		$("#reg-username").css('border-bottom','1px solid #2196F3');
		$("#regtishi").text('');
	};
});
$("#reg-pass").on(" input propertychange",function(){
	if($("#reg-pass").val().length<5){
		$("#reg-pass").css('border-bottom','1px solid red');
		$("#regtishi").text('密码需要大于等于6位数');
	}else{
		$("#reg-pass").css('border-bottom','1px solid #2196F3');
		$("#regtishi").text('');
	}	
});
$("#reg-okpass").on(" input propertychange",function(){
	if($("#reg-okpass").val()!==$("#reg-pass").val()){
		$("#reg-okpass").css('border-bottom','1px solid red');
		$("#regtishi").text('两个密码不一致哦');
	}else{
		$("#reg-okpass").css('border-bottom','1px solid #2196F3');
		$("#regtishi").text('');
	}
});
$("#reg-email").on(" input propertychange",function(){
	if($("#reg-email").val().indexOf('@')==-1){
		$("#reg-email").css('border-bottom','1px solid red');
		$("#regtishi").text('邮箱格式不正确，例如123456@qq.com,数字是你QQ号码');
	}else{
		$("#reg-email").css('border-bottom','1px solid #2196F3');
		$("#regtishi").text('');
	}
});

$('#Dregbut').click(function(){
				var user =thkg($('#reg-username').val()),
					pass =$('#reg-pass').val(),
					okpass=$('#reg-okpass').val(),
					email=$('#reg-email').val();
					if(RegeMatch()){
						if(pass != "" && pass != null && okpass != "" && okpass != null){ 
							if(pass==okpass){
								if(email!="" && email !=null){
									if(email.indexOf('@')==-1){
									   		tishi(1,'邮箱格式不正确',1500);
									   }
								   	$.ajax({
										type:"POST",
										url:'reg.php',
										data:{"user":user,"pass":pass,"okpass":okpass,"email":email},
										dataType:'json',
										beforeSend:function(){
										  $('.ajax_loading').show() //显示加载时候的提示
										},
										success:function(ret){
											if(ret.success){
												tishi(2,ret.msg,1500,"login.php");
											}else{
												tishi(1,ret.msg,1500);
											}
										 $('.ajax_loading').hide() //请求成功,隐藏加载提示
										}
									});
								   }else{
									    tishi(1,'邮箱不能为空',1500); 
								   }
									 
							   }else{
								   tishi(1,'两次密码不一致',1500); 
							   }
								
						}else{
							tishi(1,'密码不能为空',1500); 
						}
					}else{
						tishi(1,'账号不能有特殊字符或者为空',1500); 
					};
});