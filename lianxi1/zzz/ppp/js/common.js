function check_all(_this, name){
	$("input[name^='"+name+"']").prop("checked", $(_this).prop("checked"));
}

/**
 * 根据input_name的值显示panel_list数组中某个面板
 * @param input_name input名称
 * @param panel_list 面板列表，格式：[{'id':'panel_a','value':'0'},{'id':'panel_b','value':'1'}]
 * @param input_type input类型(radio/select)
 */
function show_panel(input_name, panel_list, input_type = 'radio'){
	var val = null;
	if(input_type == 'radio')
		val = $("input[name*='"+input_name+"']:checked").val();
	else if(input_type == 'select')
		val = $("select[name*='"+input_name+"']").val();
	
	if(val !== null)
	{
		for(var i in panel_list)
		{
			if(panel_list[i].id == '')
				continue;
			if(panel_list[i].value == val)
				$("#"+panel_list[i].id).show();
			else
				$("#"+panel_list[i].id).hide();
		}
	}
}

function bind_panel(input_name, panel_list, input_type = 'radio')
{
	if(input_type == 'radio')
	{
		$("input:radio[name*='"+input_name+"']").on("click", function(){
			show_panel(input_name, panel_list, 'radio');
		});		
	}
	else if(input_type == 'select')
	{
		$("select[name*='"+input_name+"']").on("change", function(){
			show_panel(input_name, panel_list, 'select');
		});		
	}

	show_panel(input_name, panel_list, input_type);	
}