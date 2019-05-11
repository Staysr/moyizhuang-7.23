function setheight(){
	jQuery('.list').css('height',document.documentElement.clientHeight-jQuery('nav').outerHeight(true)-jQuery('.list-view-home .title').outerHeight(true));
};
function getFolderInfo(folder){
	if(pfolder.length>1) jQuery('.zip-parent').removeClass('disabled')
	else jQuery('.zip-parent').addClass('disabled');
	dfolder=folder;
	jQuery('.list-wrapper').load(DZZSCRIPT+'?mod=zip&op=ajax&do=getfolderinfo&folder='+folder,function(){refresh_header()});
}
var progressTimer=null;
function showProgress(msg,type,timeout){
	var loading=jQuery('#pageLoading').show();
	var img='';
	switch(type){
		case 'loading':
			img='<img src="dzz/zip/images/loading.gif" />';
			break;
		case 'success':
			img='<img src="static/image/common/right.png" />';
			break;
		case 'danger':
			img='<img src="static/image/common/error.png" />';
			break;
		
	}
	var text='<span style="padding-left:10px;">'+msg+'</span>';
	//loading.find('.loading-img').html(img);
	loading.find('.loading-text').html(img+text);
	if(progressTimer) window.clearTimeout(progressTimer);
	if(timeout>0){
		progressTimer=window.setTimeout(function(){jQuery('#pageLoading').hide();},timeout);
	}
}

function addFromDesktop(paths,folder){//增加桌面文件
	if(!paths.length) return;
	var data=paths[0];
	console.log( 1 );
	console.log( paths );
	console.log( 2 );
	paths.splice(0,1);
	
	if(jQuery('.item[data-icoid="'+data.rid+'"]').length){
		addFromDesktop(paths,folder);
		return;
	}
	
	showProgress('正在导入'+data.name,'loading',0);
	jQuery.ajax({
		  type: 'POST',
		  dataType: 'json',
		  url: DZZSCRIPT+'?mod=zip&op=ajax&do=add',
		  data: {'folder':folder,'path':data.path},
		  success: function(json){
			  if(json.error){
				 showProgress(json.error,'danger',3000,1); 
			  }else{
				  var html='';
				  html+=' <div node-type="item" data-icoid="'+data.rid+'" class="item clearfix">'
						+'    <div class="col c1 name" style="width: 50%;" data-name="'+json.name+'">'
						+'          <span node-type="chk" class="chk"> <span class="chk-ico"></span></span>'
						+'          <div node-type="name" class="name" title="'+json.name+'">'
						+'           <img class="icon" src="'+json.img+'" />'
						+'           <span class="name-text-wrapper"> <span node-type="name-text"  data-type="'+json.type+'" data-path="'+json.folder+'" data-dpath="'+json.dpath+'" class="name-text enabled">'+json.name+'</span> </span> '
						+'          </div>'
						+'    </div>'
						+'    <div class="col size" style="width: 15%" data-size="'+json.size+'">'+json.fsize+'</div>'
						+'    <div class="col type" style="width: 15%" data-type="'+json.type+'">'+json.ftype+'</div>'
						+'    <div class="col dateline" style="width: 20%" data-dateline="'+json.dateline+'">'+json.fdateline+'</div>'
						+'  </div>';
				   jQuery(html).appendTo('.list-wrapper');
				   refresh_header();
				   showProgress(data.name+' 导入成功！','success',1000,1);
				   try{needsave=1;
				   //if( iswin ) api.win.needsave=needsave;
				   jQuery('.zip-save').removeClass('disabled');}catch(e){}
			  }
			  addFromDesktop(paths,folder);
		  },
		  error:function(){
			  showProgress(data.name+' 导入失败！跳过!','danger',3000,1);
			  addFromDesktop(paths,folder);
		  }
	});
}
function item_sort(key,order){
	
	var sarr=new Array();
	jQuery('.list-file .item').each(function(index){
		sarr.push((jQuery(this).find('.col.'+key).data(key))+'____'+index);
	});
	if(key=='dateline' || key=='size'){
		sarr=sarr.sort(function(a,b){
			return (parseInt(a)>parseInt(b))?1:0;
		});
	}else{
		sarr=sarr.sort();
	}
	var frage=document.createDocumentFragment();
	var list=jQuery('.list-file .item');
	if(order=='desc'){
		for(var i=sarr.length-1;i>=0;i--){
			var index=sarr[i].split('____')[1];
			frage.appendChild(list.get(index));
		}
	}else{
		for(var i=0;i<sarr.length;i++){
			var index=parseInt(sarr[i].split('____')[1]);
			frage.appendChild(list.get(index));
		}
	}
	var page=jQuery('.list-wrapper .more').clone();
	jQuery(frage).appendTo(jQuery('.list .list-wrapper').empty());
	page.appendTo('.list .list-wrapper');
}

function refresh_header(){
	var sum=jQuery('.list .item.item-active').length;
	var tsum=jQuery('.list .item').length;
	if(sum>0){
		jQuery('.zip-delete').removeClass('disabled');
	}else{
		jQuery('.zip-delete').addClass('disabled');
		jQuery('.chk[node-type=chk-all]').removeClass('chked');
	}
	if(sum>0 && sum>=tsum){
		jQuery('.chk[node-type=chk-all]').addClass('chked');
	}else{
		jQuery('.chk[node-type=chk-all]').removeClass('chked');
	}
	if(tsum>0){
		jQuery('.zip-extract').removeClass('disabled');
		jQuery('.module-share-empty').hide();
	}else{
		jQuery('.zip-extract').addClass('disabled');
		jQuery('.module-share-empty').show();
		
	}
	/*if(!parent._config){ parent._config是桌面系统参数，暂时取消
		jQuery('.zip-extract,.zip-open,.zip-save,.zip-delete,.zip-add').addClass('disabled');
	}*/
}