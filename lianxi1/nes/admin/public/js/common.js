$.ajaxSetup ({
    cache: false
});

//绑定顶部ajax菜单
function navload() {
    $('.top_nav a').live("click",
    function() {
		url = $(this).attr("href");
		if (url !== '' && url !== '#') {
        $.get(url, function(result){
           $("#nav").html(result);
        });
		}
	return false;
	});
}


//绑定ajax超链接
function hrftload() {
    $('.load a,.url').live("click",
    function() {
        url = $(this).attr("href");
		len=url.substring(url.length-1,url.length);
        if (len == "" || len == '#') {
            return false;
        }
		ajaxload(url);
        return false;
    });
	$('#nav ul a').live("click",function(){
		$("#nav ul a").removeClass('selected');
		$(this).addClass('selected');
	});
}

function ajaxload(url) {
    main_load(url);
}
//菜单超链接跳转
function menuload(url) {
    window.top.main_load(url);
}
//绑定表格隔行变色
function livetable() {
    $('.table_list tr:even,.form_table tr:odd').addClass('odd');
}


//提交锁屏
function sub_lock() {
	var txt = '正在处理数据，请稍后...';
    //IE6位置
    if (!window.XMLHttpRequest) {
        $("#targetFixed").css("top", $(document).scrollTop() + 2);	
    }
    //创建半透明遮罩层
    if (!$("#overLay").size()) {
        $('<div id="overLay"></div>').prependTo($("body"));
        $("#overLay").css({
            width: "100%",
            backgroundColor: "#000",
            opacity: 0.1,
            position: "absolute",
            left: 0,
            top: 0,
            zIndex: 99
        }).height($(document).height());
    }
    $.dialog.tips(txt,3);
}
//锁屏关闭
function sub_lock_close() {
	var txt = '数据处理完毕！';
	$("#overLay").remove();
    $.dialog.tips(txt,1);
}

$(document).ready(function() {
livetable();	
})

//ajax提交含有确认提示
function ajaxpost(name,url,data,tip,success,failure,cancel){
	$.dialog({
		title: '操作确认',
		content: name,
		lock: true,
		button: [{
			name: '确认操作',
			callback: function() {
			sub_lock();
			$.ajax({
			type: 'POST',
			url: url,
			data: data,
			dataType: 'json',
			success: function(json) {
				sub_lock_close();
				if(tip==1){
				$.dialog.tips(json.message, 3);
				}
				if (json.status == 1) {
					if(typeof success == "function"){
					success(json.message);
					}
				} else {
					if(typeof failure == "function"){
					failure(json.message);
					}
				}
			}
	});
	},
	focus: true
	},
		{
			name: '取消',
			callback: function() {
				  if(typeof cancel == "function"){
					cancel();
				}
			}
		}]
	});
}

//ajax提交无确认提示
function ajaxpost_w(url,data,tip,success,failure,msg){
	$.ajax({
			type: 'POST',
			url: url,
			data: data,
			dataType: 'json',
			success: function(json) {
				if(tip==1){
				$.dialog.tips(json.message, 3);
				}
				if(tip==2&&msg!=''){
				$.dialog.tips(msg, 3);
				}
				if(json != null){
				if (json.status == 1) {
					if(typeof success == "function"){
					success(json.message);
					}
				} else {
					if(typeof failure == "function"){
					failure(json.message);
					}
				}
				}
			}
	});
}

//弹出窗口
function urldialog(title,url){
	$.dialog({
	title:title,
	content: 'url:'+url
	})
}

//标准表单保存
function savelistform(addurl,listurl,data){
$('#form').mkform(function() {
	sub_lock();
	if(typeof data == "function"){
		data(data);
	}
	setTimeout(function() {
		$('#form').ajaxSubmit({
			dataType: "json",
			type: 'post',
			success: function(json) {
				sub_lock_close();
				if (json.status == 0) {
					$.dialog.tips(json.message, 3);
				} else {
					$.dialog({
						title: '操作成功！',
						content: json.message+' 3秒后自动返回列表! ',
						lock: true,
						button: [{
							name: '继续添加',
							callback: function() {
								window.location.href=addurl
							},
							focus: true
						},
						{
							name: '返回列表',
							callback: function() {
								window.location.href=listurl
							}
						}]
					});
					setTimeout(function() {
					window.location.href=listurl
    		        }, 3000);

				}
				
			}
		});
	},
	1000);
	return false;
});
}

//表单直接保存
function saveform(success,failure){
	$('#form').mkform(function(){
	setTimeout(function() {
	$('#form').ajaxSubmit({
		dataType: "json",
		success: function(json) {
		if (json.status == 1) {
			if(typeof success == "function"){
			success(json.message);
			}
		} else {
			if(typeof failure == "function"){
			failure(json.message);
			}
		}
		}
	});
	},
	1000);
	return false;
	});
}

