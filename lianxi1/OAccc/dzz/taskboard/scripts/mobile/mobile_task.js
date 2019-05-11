//新建取消
$(document).on('touchstart','.weui-taskboard-new-cancel',function(){
	window.location.href=MOD_URL;
})
//选择团队
$(document).on('touchstart','.weui-team-check_label',function(){
	var text=$(this).find('p').text();
	console.log(text);
	window.sessionStorage.setItem('team_name',text);
	window.location.href=MOD_URL+'&op=ajax&do=create';
})