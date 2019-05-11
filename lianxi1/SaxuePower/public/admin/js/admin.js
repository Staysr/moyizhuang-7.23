function doDialog(url, name, width, height) {
	width = (typeof(width)=="undefined") ? '700' : width;
	height = (typeof(height)=="undefined") ? '500' : height;
	window.top.art.dialog({id:'doDialog'}).close();
	window.top.art.dialog({title:name,id:'doDialog',iframe:url,width:width,height:height,padding:0}, function(){var d = window.top.art.dialog({id:'doDialog'}).data.iframe;d.document.getElementById('submit').click();return false;}, function(){window.top.art.dialog({id:'doDialog'}).close()});
}
function doDialogClose() {
	window.top.art.dialog({id:'doDialog'}).close();
}
function doTip(msg) {
	window.top.art.dialog({content:msg,lock:true,width:'250',height:'50'}, function(){this.close();});
}
function setPage(size) {
	document.getElementById("pagesize").value = size;
	document.frmsearch.submit();
}
function batchctrl(){
	var sel = document.getElementById("batchaction");
	if (sel.value == '') {
		alert('请先在下拉列表里选择批量操作类型');
		return false;
	}
	if(confirm('确定要『'+sel.options[sel.selectedIndex].text+'』所有选中记录吗？')) {
		document.frmpost.submit();
	}
	return false;
}
/**
 * 全选checkbox,注意：标识checkbox id固定为为check_all
 * @param string name 列表check名称,如 uid[]
 */
function checkall(name) {
	if ($("#check_all").attr("checked")) {
		$("input[name='"+name+"']").each(function() {
			this.checked=true;
		});
	} else {
		$("input[name='"+name+"']").each(function() {
			this.checked=false;
		});
	}
}
//提交排序表单
function formSort(field, sort, order) {
	if( document.frmsearch ) {
		form_search = document.frmsearch;
	} else {
		form_search = this.form;
	}
	if( form_search ){
		if( form_search.form_sort ) {
			obj_sort = form_search.form_sort;
		} else {
			obj_sort = formCreat( form_search, 'form_sort' );
		}
		if( form_search.form_order ) {
			obj_order = form_search.form_order;
		} else {
			obj_order = formCreat( form_search, 'form_order' );
		}
		obj_sort.value = field;
		if(field != sort) {
			obj_order.value = 'desc';
		} else if(order == 'asc') {
			obj_order.value = 'desc';
		} else if(order == 'desc') {
			obj_order.value = 'asc';
		}
		form_search.submit();
	} else {
		return false;
	}
}
//创建表单元素
function formCreat(form, ename) {
	var e = document.createElement("input");
	e.type = "hidden";
	e.name = ename;
	e.value = "";
	form.appendChild( e );
	return e;
}

function swapTab(cnt,cur){
	for(i=1;i<=cnt;i++){
		if(i==cur){
			 $('#div_setting_'+i).show();
			 $('#tab_setting_'+i).attr('class','on');
		}else{
			 $('#div_setting_'+i).hide();
			 $('#tab_setting_'+i).attr('class','');
		}
	}
}

function display(id) {
	var obj = document.getElementById(id);
	if(obj.style.visibility) {
		obj.style.visibility = obj.style.visibility == 'visible' ? 'hidden' : 'visible';
	} else {
		obj.style.display = obj.style.display == '' ? 'none' : '';
	}
}