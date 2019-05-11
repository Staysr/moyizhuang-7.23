/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
 
function cat_move(catid,up){
	catid=parseInt(catid);
	jQuery.getJSON(DZZSCRIPT+'?mod=news&op=menu&do=catmove&catid='+catid+'&up='+up,function(json){
		if(json.error) showmessage(json.error,3000,1);
		else{
			var catids=[];
			jQuery('#cat_'+catid).parent().children().each(function(){
				catids.push(jQuery(this).data('catid'));
			});
			var cur=jQuery.inArray(catid,catids);
			if(up>0 && (cur-1)>-1){
				jQuery('#cat_'+catid).insertBefore('#cat_'+(catids[cur-1]));
			}
			if(up<1 && (cur+1)<catids.length){
				jQuery('#cat_'+catid).insertAfter('#cat_'+(catids[cur+1]));
			}
		}
	});
}
function sendModMessage(btn,newid){
	jQuery(btn).button('loading');
	jQuery.getJSON(DZZSCRIPT+'?mod=news&op=ajax&do=sendModNotice&newid='+newid,function(json){
		jQuery(btn).html(json.msg);
	});
}
function news_click(newid){
	jQuery.post(DZZSCRIPT+'?mod=news&op=ajax&do=updateview&newid='+newid);
	return true;
}
function news_delete(obj){
	var newid=jQuery(obj).attr('newid');
	// if(confirm('确定要删除此信息（此操作不可恢复）？')){
	// alert(111); 
		jQuery.getJSON(DZZSCRIPT+'?mod=news&op=ajax&do=news_delete&newid='+newid,function(json){
			if(json.msg && json.msg=='success'){
				jQuery(obj).closest('tr').remove();
			}else{
				alert(json.error);
			}
		});
	// }
	// return false;
}
function news_type_switch(type){
	 jQuery('#news_type_0,#news_type_1,#news_type_2').not('#news_type_'+type).removeClass('active');
	 jQuery('#news_type_'+type).addClass('active');
	 jQuery('#type').val(type);
	
}

 
var errorShowTimer=null;
function showError(msg){
  if(errorShowTimer) window.clearTimeout(errorShowTimer);
  jQuery('#error_msg').html(msg);
  window.setTimeout(function(){
	  jQuery('#error_msg').html('');
  },3000);
}


    
function uploadfrom_desktop(){
	top.OpenFile('open','打开文件',{image:['图像(*.jpg,*.jpeg,*.png,*.gif)',['IMAGE','JPG','JPEG','PNG','GIF'],'selected']},{bz:'all',multiple:true},function(data){//只打开本地盘
		var datas=[];
		if(data.params.multiple){
			datas=data.icodata
		}else{
			datas=[data.icodata];
		}
		var html='';
		for(var i in datas){
			if(datas[i].aid>0){
			    var img=DZZSCRIPT+'?mod=io&op=thumbnail&width=240&height=160&path='+(datas[i].apath?datas[i].apath:datas[i].dpath);
				html+='<div class="image-item">';
				html+='  <div style="position:absolute;right:15px;top:15px;" onclick="jQuery(this).parent().remove();"><i class="ibtn glyphicon glyphicon-trash"></i></div>';
				html+=' <div class="thumbnail">';
				html+='		<img  src="'+img+'">';
				html+='    <div class="caption text-center">';
				html+='      <input type="text" class="form-control input-imag-title" name="picnew[title][]" value="'+datas[i].name+'" /><input type="hidden" name="picnew[aid][]" value="'+datas[i].aid+'" />';
				html+='    </div>';
				html+=' </div>';
				html+='</div>';
			}
		}
		if(html!=''){
			 if(jQuery('#image_container .image-body .image-item').length>0) jQuery('#image_container .image-body .image-item:first').before(html);
			 else{
				 jQuery('#image_container .image-body').append(html);
			 }
		}
	});
}

Date.prototype.format = function(format) {
	   var date = {
			  "M+": this.getMonth() + 1,
			  "d+": this.getDate(),
			  "h+": this.getHours(),
			  "m+": this.getMinutes(),
			  "s+": this.getSeconds(),
			  "q+": Math.floor((this.getMonth() + 3) / 3),
			  "S+": this.getMilliseconds()
	   };
	   if (/(y+)/i.test(format)) {
			  format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
	   }
	   for (var k in date) {
			  if (new RegExp("(" + k + ")").test(format)) {
					 format = format.replace(RegExp.$1, RegExp.$1.length == 1
							? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
			  }
	   }
	   return format;
}

	
	
