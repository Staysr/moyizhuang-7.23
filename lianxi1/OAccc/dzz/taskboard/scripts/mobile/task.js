
//点击右侧
$(document).off('touchstart.rightTopmenu').on('touchstart.rightTopmenu','.rightTopmenu',function(){
	if($('#weui-right-panel').hasClass('hide')){
		$('#weui-right-panel').removeClass('hide');
		$('#weui-right-panel .event').load(correcturl(MOD_URL+'&op=list&do=event&operation=getEventByDate&tbid='+tbid));
	}else{
		$('#weui-right-panel').addClass('hide');
	}
	
});
$(document).off('touchend.background').on('touchend.background','.background-right',function(){
	$('#weui-right-panel').addClass('hide');
});
//内页搜索
$(document).on('touchend','.weui-search-button',function(){
	$('.weui-navbar-nav-left').addClass('hide');
	$(this).addClass('hide');
	$('.weui-search-left').removeClass('hide');
//	$('.weui-search-left').find('#searchval').trigger('click').focus();
	$(this).siblings('.weui-close-button').removeClass('hide');
    $('.seach-label').css('display','inline-block').html('<a href="javascript:;">标签</a>');
    $('.seach-member').css('display','inline-block').html('<a href="javascript:;">成员</a>');
    $('.seach-date').css('display','inline-block').html('<a href="javascript:;">日期</a>');
});
$(document).on('touchend','.weui-location-back',function () {
    $('.seach-label').css('display','inline-block').html('<a href="javascript:;">标签</a>');
    $('.seach-member').css('display','inline-block').html('<a href="javascript:;">成员</a>');
    $('.seach-date').css('display','inline-block').html('<a href="javascript:;">日期</a>');
    return false;
});
$(document).on('touchend','.weui-close-button',function(){
	jQuery('#searchval').val('');
	board_filter_empty();
	board_filter();
	$('.weui-search-left').addClass('hide');
	$(this).addClass('hide');
	$('.weui-navbar-nav-left').removeClass('hide');
	$(this).siblings('.weui-search-button').removeClass('hide');
	return false;
});

/*修复url 没有？的时候第一个&改为？*/
function correcturl(url){
	if(url && url.indexOf('?')===-1){
		url=url.replace(/&/i,'?');
	}
	return url;
}
function setSave(name,val,orgid){
	 if(name=='title'){
		 if(val==''){
			 $.ajax('名称不能为空');
			 jQuery('#title_1').focus();
			 return;
		 } 
	 }
	 jQuery.post(ajaxurl+'&do=setSave&orgid='+orgid,{name:name,val:val});
}
 function catlist_save(){
	var catlist=[];
	jQuery('#catlist_container .catlist').each(function(){
		catlist.push(jQuery(this).attr('catid'));
	});
	jQuery.post(correcturl(cpurl+'&do=savecatlist'),{'catlist':catlist});

}
function callback_taskmove(data){
	layout_catlist();
	if(data.prevtaskid=='undefined') data.prevtaskid=0;
	jQuery.post(correcturl(cpurl+'&do=savemovetask'),data);
} 
function callback_tasksubmove(data){
	if(data.prevtaskid=='undefined') data.prevtaskid=0;
	jQuery.post(correcturl(cpurl+'&do=savemovetasksub'),data);
}
function callback_board_members(ids,data,tbid){//任务板用户回调函数
	jQuery.post(correcturl(ajaxurl+'&do=ajax&operation=board_members'),{"ids":ids},function(html){
		if(html!='error'){
			jQuery('#board_members').html(html);
			jQuery('#board_members').find('js-popbox').each(function(){
				jQuery(this).popbox();
			});
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
function catlist_toggle_hide(obj){
	if(!jQuery(obj).hasClass('iscatlistHide')){
		jQuery(obj).html('全部展开').addClass('iscatlistHide');
		jQuery('.catlist').addClass('catlistHide');
		jQuery('.catlist').find('.catlist-hide-icon .glyphicon').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	}else{
		jQuery(obj).html('全部收起').removeClass('iscatlistHide');;
		jQuery('.catlist').removeClass('catlistHide');
		jQuery('.catlist').find('.catlist-hide-icon .glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
}
function inlit_dzzdragsort(flag,layout){
	if(flag=='catlist'){
		if(layout>0){
			jQuery('#catlist_container').dzzdragersort_catlist({
				'scrollContainer':jQuery('#taskboard_container'), //滚动层
				'contentContainer':jQuery('#catlist_container'), //内容层
				'hoder_div_css':'margin:15px;background-color:RGBA(0,0,0,.15);border-radius: 5px;',
				'width_correct':30,
				'height_correct':30,
				'itemselector':'.catlist',
				'scrollspeed':10,
				'addspeed':1,
				'layout':1
			},catlist_save);
		}else{
			jQuery('#catlist_container').dzzdragersort_catlist({
				'scrollContainer':jQuery('#taskboard_container'), //滚动层
				'contentContainer':jQuery('#catlist_container'), //内容层
				'hoder_div_css':'margin:25px 5px 5px 0;display:inline-block;background-color:RGBA(0,0,0,.15);border-radius: 5px;',
				'width_correct':15,
				'height_correct':15,
				'itemselector':'.catlist',
				'scrollspeed':20,
				'addspeed':5,
				'layout':0
			},catlist_save);
		}
		
	}else{
		if(layout>0){
			jQuery('.task-container').dzzdragersort({
				'pscrollContainer':jQuery('#taskboard_container'), //滚动层
				'pcontentContainer':jQuery('#catlist_container'), //内容层
				'scrollContainer':jQuery('.tasklist-container'), //滚动层
				'contentContainer':jQuery('.task_container'), //内容层
				'itemselector':'.task-item',
				'hoder_div_css':'background:#cdd2d4;border-bottom:1px solid #e2e2e2;border-radius:3px',
				'width_correct':0,
				'height_correct':0,
				'scrollspeed':20,
				'addspeed':5,
				'layout':1
			},callback_taskmove);
		}else{
			jQuery('.task-container').dzzdragersort({
				'pscrollContainer':jQuery('#taskboard_container'), //滚动层
				'pcontentContainer':jQuery('#catlist_container'), //内容层
				'scrollContainer':jQuery('.tasklist-container'), //滚动层
				'contentContainer':jQuery('.task_container'), //内容层
				'hoder_div_css':'background:#cdd2d4;border-bottom:1px solid #e2e2e2;border-radius:3px',
				'width_correct':0,
				'height_correct':0,
				'scrollspeed':20,
				'addspeed':5,
				'layout':0
			},callback_taskmove);
		}
	}
}
function close_all(){
	//关闭菜单
	jQuery('.popbox .close').trigger('click');
	
	//关闭添加应用表单
	jQuery('.task-poster button.btn-simple').trigger('click');
}
function layout_catlist(el){
	
	if(!el || !el.hasClass('catlist')) el=jQuery('.catlist');
	var clientHeight=document.documentElement.clientHeight;
	var topHeight=jQuery('.weui-position-header').outerHeight(true);
	var catlistHeight=clientHeight-topHeight-parseInt(jQuery('.catlist').css('margin-top'))*2;
	if(board.layout<1){
		if(catlistHeight<242) catlistHeight=242;
		el.css('max-height',catlistHeight);
		var tasklistHeight=catlistHeight-el.find('.catlist-header').outerHeight(true)-el.find('.catlist-footer').outerHeight(true);
		el.find('.tasklist-container').each(function(){
			var height=0;
			jQuery(this).find('.task-item,.task-poster:visible').each(function(){
				height+=jQuery(this).outerHeight(true);
			});
			if(tasklistHeight>height) jQuery(this).css('height','auto');
			else jQuery(this).css('height',tasklistHeight);
		});
		var width=el.outerWidth(true);
		var catlistWidth=(width+10)*(jQuery('.catlist').length+1);
		if(catlistWidth<document.documentElement.clientWidth) catlistWidth=document.documentElement.clientWidth;
		jQuery('#catlist_container').css('width',catlistWidth);
		jQuery('#taskboard_container').css({'top':topHeight,'height':catlistHeight+parseInt(jQuery('.catlist').css('margin-top'))*2});
	}else{
		jQuery('#taskboard_container').css({'top':topHeight,'height':catlistHeight+parseInt(jQuery('.catlist').css('margin-top'))*2});
	}
	try{jQuery('#taskpanel .task-panel-body').css('height',jQuery('#taskpanel').height()-jQuery('#taskpanel .task-panel-header').outerHeight(true));}catch(e){}	
}
function init_catlist_add(){
	var el=jQuery('.catlist-new');
	jQuery('.cat-add').click(function(){
		jQuery(this).addClass('hide');
		jQuery('.form-catlist-add').removeClass('hide');
		if(board.layout>0){
//			jQuery('#taskboard_container').scrollTop(jQuery('#catlist_container').outerHeight(true));
		}
		return false;
	});
	el.find('button').click(function(){
		switch(jQuery(this).data('click')){
			case 'cancel':
				el.find('.form-catlist-add').addClass('hide');jQuery('.cat-add').removeClass('hide');
			case 'submit':
				var catname=el.find('input').val();
				if(catname==''){
					el.find('input').focus();
				}else{
					add_catlist(catname);
				}
				break;
		}
	});
	el.find('input').keyup(function(e){
		if(e.keyCode==13) add_catlist(jQuery(this).val());
	});
}
function add_catlist(catname){
	var el=jQuery('.catlist-new');
	jQuery.getJSON(correcturl(cpurl+'&do=addCatlist'),{'catname':catname},function(json){
		if(json.error){
			el.find('input').focus();
		}else{
			appendCatlist(json);
			el.find('input').val('').focus();
		}
	});
}
function appendCatlist(data){
 var html='';
	 html+='<div id="catlist_'+data.catid+'" class="catlist" catid="'+data.catid+'">';
     html+='          <div class="catlist-header clearfix">';
     html+='              <span class="catlist-header-span">'+data.catname+'</span>';
     html+='              <a href="javascript:;" class="catlist-header-menu action-icon js-popbox" data-href="'+MOD_URL+'&op=menu&do=catmenu&catid='+data.catid+'" data-catid="'+data.catid+'" data-placement="bottom" data-auto-adapt="true"><i class="dzz dzz-more"></i></a>';
	
     html+='           </div>';
	

     html+='      <div class="tasklist-container " id="tasklist_'+data.catid+'">';
	 html+='      	<div class="task-container"  catid="'+data.catid+'">';
	 html+='            <div class="task-append nodrager" style="height:0"></div>';
	 html+='            <div class="task-poster nodrager hide" catid="'+data.catid+'">';
	 html+='                 <div class="task-poster-body task-poster-body-focus clearfix">';
	 html+='					<div class="task-item-labels"></div>';
	 html+='					<textarea class="form-control " name="taskname" catid="'+data.catid+'"></textarea>';
	 html+='					<div class="task-poster-body-footer">';
	 html+='					   <div class="task-item-badges"></div>';
	 html+='					   <div class="task-item-members"></div>';
	 html+='					</div>';
	 html+='				</div>';
	 html+='				<div class="task-poster-footer"> ';
	 html+='					<button data-click="cancel" class="weui-task-btn weui-task-cancel" >取消</button> ';
	 html+='					<button data-click="submit" class="weui-task-btn weui-task-submit" >添加 </button>'; 	 
	 html+='				</div>';
	 html+='            </div>';
	 html+='         </div>';
     html+='        </div>';
     html+='         <div class="catlist-footer">';
     html+='              <a href="javascript:;" class="task-add" catid="'+data.catid+'">新建任务</a>';
     html+='     </div>';
	 
	 jQuery('.catlist-new').before(html);
	 jQuery('#catlist_'+data.catid+' .js-popbox').popbox();	
	layout_catlist();
	if(board.layout>0){
//		jQuery('#taskboard_container').scrollTop(jQuery('#catlist_container').outerHeight(true));
	}else{
		//jQuery('#taskboard_container').scrollLeft(jQuery('#catlist_container').outerWidth(true));
	}
	 catlist_save();
	 inlit_dzzdragsort('catlist',board.layout);
	 inlit_dzzdragsort('tasklist',board.layout);
	layout_catlist();
}

function init_task_poster(){
	jQuery(document).on('click','.task-add',function(){
		
		var catdiv=jQuery(this).closest('.catlist');
		var catid=catdiv.attr('catid');
		var el=catdiv.find('.task-poster');
		jQuery(this).addClass('hide');
		el.removeClass('hide');
		layout_catlist(jQuery('#catlist_'+catid));
		jQuery('#catlist_'+catid).find('.tasklist-container').scrollTop(99999);
		el.find('textarea').focus();
		return false;
	});
	jQuery(document).on('click','.task-poster button',function(){
		var catdiv=jQuery(this).closest('.catlist');
		var catid=catdiv.attr('catid');
		var el=catdiv.find('.task-poster');
		switch(jQuery(this).data('click')){
			case 'cancel':
				el.addClass('hide').find('.task-item-badges').empty().end().find('.task-item-labels').empty().end().find('.task-item-members').empty();jQuery('.task-add').removeClass('hide');jQuery(document).off('mousedown.task-poster');
				layout_catlist(catdiv);
				
				return false;
			case 'submit':
				var taskname=el.find('textarea').val();
				if(taskname==''){
					el.find('textarea').focus();
				}else{
					add_task(catid,taskname);
				}
				return false;
		}
	});
	
	jQuery(document).on('keyup','.task-poster textarea',function(e){
		var catdiv=jQuery(this).closest('.catlist');
		var catid=catdiv.attr('catid');
		
		if(e.keyCode==13){
			 add_task(catid,jQuery(this).val().replace('\n','')); 
			 this.value='';
			return false;
		}
	});
	
	
}
function add_task(catid,taskname){
	var catdiv=jQuery('#catlist_'+catid);
	var el=catdiv.find('.task-poster');
	var data={'taskname':taskname,'catid':catid};
	var uids=[];
	var labels=0;
	var time='';
	var worktime=0;
	el.find('.task-item-labels .task-label').each(function(){
		labels+=parseInt(jQuery(this).attr('pow'));
	});
	el.find('.task-item-members a').each(function(){
		uids.push(jQuery(this).attr('uid'));
	});
	if(el.find('.task-item-badges .task-badge-time')){
		time=el.find('.task-item-badges .task-badge-time em').html();
	}
	if(uids.length>0) data.uids=uids;
	if(labels>0) data.labels=labels;
	if(time!='') data.time=time;
	jQuery.post(correcturl(cpurl+'&do=addtask'),data,function(json){
		if(json.error){
			//el.find('.btn-success').button(json.error);
			el.find('textarea').focus();
			//window.setTimeout(function(){el.find('.btn-success').button('reset');},3000);
		}else{
			appendTask(json);
			el.find('textarea').val('').focus();
			//el.find('.btn-success').button('reset');
		}
	},'json');
}
function appendTask(data,taskid){
	var html='';	
	html+='<div class="task-item clearfix" id="task_'+data.taskid+'" taskid="'+data.taskid+'">';
	html+='	<div class="task-item-cont">';	
	html+='	<div class="task-item-labels">';
	for(var i in data.labels){
		html+='	<span class="task-label '+data.labels[i].color+'-label" pow="'+data.labels[i].pow+'"></span>';
	}
	html+='	</div>';
	if(board.layout<1){
		html+='<div class="task-item-coverimage">';
		if(data.dpath){
			html+='	<img src="index.php?mod=io&op=thumbnail&width=240&height=280&path='+data.dpath+'">';
		}
		html+='	<div class="long_image_shadow"></div>';
		html+='</div>';
	} 
	html+=' <div class="task-item-main">';
	html+='<a class="task-item-check weui-cells_checkbox" data-taskid="'+data.taskid+'">';	
	html+='<label class="weui-cell weui-check__label">';		    
	html+=' <input type="checkbox" class="weui-check" name=""  value="2" onchange="task_complete(\''+data.taskid+'\',this)">';		     
	html+='<i class="weui-icon-checked"></i>';		      
	html+='</label>';		    			 
	html+='</a>';
	html+='		<a class="task-item-title " href="javascript:;">'+data.name+'</a>';
	html+='  </div>';
	html+='   <div class="task-badges-container">';
	
	html+='  <div class="task-item-badges">';
	if(data.endtime>0){
		if(data.endtime<data.dateline){
			html+='<span class="task-badge task-badge-time badge-expire-due" title="任务已经截止"><i class="dzz dzz-notifications"></i><em>'+data.fendtime+'</em></span> ';
		}else{
			html+='<span class="task-badge task-badge-time" title="截止时间：'+data.fendtime+'"><i class="dzz dzz-notifications"></i><em>'+data.fendtime+'</em></span> ';
		}
	}
	if(data.subs>0){
		if(data.subs==data.subs_c) {
			var done='badge-todo-done';
		}else{
			var done='';
		}
		html+='<span class="task-badge task-badge-sub '+done+'" title="检查项：'+data.subs_c+'/'+data.subs+'"><i class="dzz dzz-assignment_turned"></i><em>'+data.subs_c+'/'+data.subs+'</em></span>';
	}
	
	if(data.replys>0){
		html+='<span class="task-badge task-badge-comment " title="任务有 '+data.replys+' 个评论"><i class="dzz dzz-comment"></i><em>'+data.replys+' 个</em></span>';
	}
	if(data.attachs>0){
		html+='<span class="task-badge task-badge-attach " title="任务有 '+data.replys+' 个附件"><i class="dzz dzz-attachment"></i><em>'+data.attachs+' 个</em></span>';
	}
	if(data.money>0){
		
		html+='<span class="task-badge task-badge-money " title="预算：'+data.money+'"><i class="dzz dzz-money"></i><em>'+data.money+'</em></span>';
	}
	if(data.worktime>0){
		
		html+='<span class="task-badge task-badge-worktime " title="工时：'+data.worktime+'小时"><i class="dzz dzz-clock"></i><em>'+data.worktime+'</em></span>';
	}
	html+='  </div>';
	html+='   <div class="task-item-members">';
	for(var i in data.user_assign){
		html+='		 <a class="avatar avatar-30" data-href="'+correcturl(MOD_URL+'&op=menu&do=taskmenu&uid='+data.user_assign[i].uid+'&taskid='+taskid+'&step=15&ac=2')+'" data-placement="top" data-auto-adapt="true" title="'+data.user_assign[i].username+'" uid="'+data.user_assign[i].uid+'" href="javascript:;"> ';
		// html+='			<span class="avatar-face"><img src="avatar.php?uid='+data.user_assign[i].uid+'" alt="'+data.user_assign[i].username+'"></span>';
		html+='		</a>';
	}
	html+=' </div>';
	html+='</div>';
	html+='</div>';
	html+='</div>';
	if(taskid){
		jQuery('#task_'+taskid).after(html);
	}else{
		jQuery('#catlist_'+data.catid+' .task-append').before(html);
	}
	
	layout_catlist(jQuery('#catlist_'+data.catid));
	if(board.layout<1){
		if(taskid){
			//jQuery('#catlist_'+data.catid).find('.tasklist-container').scrollTop('scrollTo',((jQuery('#task_'+data.taskid).position()).top))
		}else{
			jQuery('#catlist_'+data.catid).find('.tasklist-container').scrollTop(jQuery('#catlist_'+data.catid).find('.tasklist-container .task-container').outerHeight(true));
		}
	}
	jQuery('.js-popbox').each(function(){
		jQuery(this).popbox();
	});
	inlit_dzzdragsort('task',board.layout);	
}

function removeHTMLTag(str) {
            str = str.replace(/<\/?[^>]*>/g,''); //去除HTML tag
            str = str.replace(/[ | ]*\n/g,'\n'); //去除行尾空白
            //str = str.replace(/\n[\s| | ]*\r/g,'\n'); //去除多余空行
            str=str.replace(/ /ig,'');//去掉 
            return str;
    }
/* @authorcode  f12c4e54920727fc04d615f7ab97416a */
function task_toggle_label(taskid,pow,obj){//选择标签
	var el=jQuery(obj);
	var flag=el.find('.dzz-done').length;
	var labelname=removeHTMLTag(el.attr('title'));
	var color=el.data('color');	
	el.find('.dzz').toggleClass('dzz-done');
	if(flag){
		if(jQuery('#task_'+taskid+' .task-item-labels .task-label[pow='+pow+']').length){
			jQuery('#task_'+taskid+' .task-item-labels .task-label[pow='+pow+']').remove(); 
			jQuery('.task-panel[taskid='+taskid+'] .task-labels .task-label[pow='+pow+']').remove();
			jQuery.get(correcturl(cpurl+'&do=setLabel'),{"pow":pow,"taskid":taskid,'isadd':0},function(){});
		}
		if(jQuery('#task_panel_'+taskid+' .task-label[pow='+pow+']').length){
			jQuery('#task_'+taskid+' .task-item-labels .task-label[pow='+pow+']').remove(); 
			jQuery('.task-panel[taskid='+taskid+'] .task-labels .task-label[pow='+pow+']').remove();
			jQuery.get(correcturl(cpurl+'&do=setLabel'),{"pow":pow,"taskid":taskid,'isadd':0},function(){});
		}
	}else{
		if(!jQuery('#task_'+taskid+' .task-item-labels .task-label[pow='+pow+']').length){			
			jQuery('<span class="task-label '+color+'-label" pow="'+pow+'"></span>').appendTo('#task_'+taskid+' .task-item-labels');
			jQuery('#task_panel_'+taskid+' .task-labels .list-unstyled').prepend('<li class="task-label '+color+'-label weui-task-label" pow="'+pow+'">'+labelname+'</li>');
			jQuery.get(correcturl(cpurl+'&do=setLabel'),{"pow":pow,"taskid":taskid,'isadd':1},function(){});
		}
	}
	if(board.layout<1){
	var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
		layout_catlist(jQuery('#catlist_'+catid));
	}
	task_label(taskid);
}
function task_label(taskid){
	var leng=jQuery('.task_panel_'+taskid+' .task-labels .list-unstyled').find('li').length;
	if(leng>0){
		$('.list-unstyled').closest('.task-labels').siblings('.content_module_top').find('.weui-add-span').addClass('hide');		
	}else{
		$('.list-unstyled').closest('.task-labels').siblings('.content_module_top').find('.weui-add-span').removeClass('hide');		
	}
}
function task_remove_label(taskid,pow,obj){//选择标签
	jQuery('#task_'+taskid+' .task-item-labels .task-label[pow='+pow+']').remove();
	jQuery('.task-panel[taskid='+taskid+'] .task-labels .task-label[pow='+pow+']').remove();
	jQuery.get(correcturl(cpurl+'&do=setLabel'),{"pow":pow,"taskid":taskid,'isadd':0},function(){});
	if(board.layout<1){
	var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
		layout_catlist(jQuery('#catlist_'+catid));
	}
}
function task_remove_assign_user(taskid,uid,username,action){
	if(action>1){
		jQuery('#task_'+taskid+' .task-item-members .avatar[uid='+uid+']').remove();
		jQuery('#task_panel_'+taskid+' .task-members.Member .avatar[uid='+uid+']').parent().remove();
		
		if(board.layout<1){
		var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
			layout_catlist(jQuery('#catlist_'+catid));
		}
		task_members(taskid);
	}else{
		jQuery('#task_panel_'+taskid+' .task-members.follow .avatar[uid='+uid+']').parent().remove();
		task_follow(taskid);
	}
	
	jQuery.get(correcturl(cpurl+'&do=saveuser'),{"uid":uid,'username':username,"taskid":taskid,'type':'remove','action':action},function(){});
}
function task_toggle_assign_user(taskid,uid,username,obj){ //分配任务
	var el=jQuery(obj);
	var flag=el.find('.dzz-done').length;
	el.find('.dzz').toggleClass('dzz-done');
	if(flag){
		jQuery('#task_'+taskid+' .task-item-members .avatar[uid='+uid+']').remove();
		jQuery('#task_panel_'+taskid+' .task-members.Member .avatar[uid='+uid+']').parent().remove();
		jQuery.get(correcturl(cpurl+'&do=saveuser'),{"uid":uid,'username':username,"taskid":taskid,'type':'remove','action':2},function(){});
	}else{
		var datahref=correcturl(MOD_URL+'&op=menu&do=taskmenu&uid='+uid+'&taskid='+taskid+'&step=15&ac=2');
		var html='<a class="avatar avatar-30 js-popbox" data-href="'+datahref+'" data-placement="top" data-auto-adapt="true" title="'+username+'" uid="'+uid+'" href="javascript:;">';
        	html+='</a>';
		var el1=jQuery(html);
		el1.appendTo('#task_'+taskid+' .task-item-members');
		el.find('.Topcarousel,img.img-circle').clone().appendTo(el1);
		
		if(jQuery('#task_panel_'+taskid).length){
			
			var html1='<li><a class="avatar avatar-40 js-popbox" data-href="'+datahref+'" data-placement="top" data-auto-adapt="true" title="'+username+'" uid="'+uid+'" href="javascript:;">';
				html1+='</a></li>';
			var el2=jQuery(html1);

			jQuery('#task_panel_'+taskid+' .task-members.Member ul').prepend(el2);
			el.find('.Topcarousel,img.img-circle').clone().appendTo(el2.find('.avatar'));
		}
		jQuery.get(correcturl(cpurl+'&do=saveuser'),{"uid":uid,'username':username,"taskid":taskid,'type':'add','action':2},function(){});
	}
	if(board.layout<1){
	var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
		layout_catlist(jQuery('#catlist_'+catid));
	}
	jQuery('.js-popbox').each(function(){
		jQuery(this).popbox();
	});
	task_members(taskid);
}
function task_members(taskid){
	var leng=jQuery('#task_panel_'+taskid+' .task-members.Member .list-unstyled').find('li').length;
	if(leng>0){
		$('.task-members.Member .list-unstyled').closest('.task-members').siblings('.content_module_top').find('.weui-add-span').addClass('hide');		
	}else{
		$('.task-members.Member .list-unstyled').closest('.task-members').siblings('.content_module_top').find('.weui-add-span').removeClass('hide');		
	}
}
function task_toggle_user_all(obj,flag){
	var el=jQuery(obj);
	el.closest('.popbox').find('.member-item>a').each(function(){
		var self=jQuery(this);
		if(flag>0){
			if(self.find('span.dzz-done').length<1){
				self.trigger('click');
			}
		}else{
			self.trigger('click');
		}
	});
}
function task_toggle_follow_user(taskid,uid,username,obj){ //分配任务 
	var el=jQuery(obj);
	var flag=el.find('.dzz-done').length;
	el.find('.dzz').toggleClass('dzz-done');
	
	if(flag){

		jQuery('#task_panel_'+taskid+' .task-members.follow .avatar[uid='+uid+']').parent().remove();
		jQuery.get(correcturl(cpurl+'&do=saveuser'),{"uid":uid,'username':username,"taskid":taskid,'type':'remove','action':1},function(){});
	}else{
		var datahref=correcturl(MOD_URL+'&op=menu&do=taskmenu&uid='+uid+'&taskid='+taskid+'&step=15&ac=1');
		jQuery.get(correcturl(cpurl+'&do=saveuser'),{"uid":uid,'username':username,"taskid":taskid,'type':'add','action':1},function(){});
		if(jQuery('#task_panel_'+taskid).length){
			var html1='<li><a class="avatar avatar-40 js-popbox" data-href="'+datahref+'" data-placement="top" data-auto-adapt="true" title="'+username+'" uid="'+uid+'" href="javascript:;">';
				html1+='</a></li>';
			var el2=jQuery(html1);
			jQuery('#task_panel_'+taskid+' .task-members.follow ul').prepend(el2);
			el.find('.Topcarousel,img.img-circle').clone().appendTo(el2.find('.avatar'));
		}
	}
	var total=jQuery('.popbox-body .member-item').length;
	var selsum=jQuery('.popbox-body .dzz-done').length;
	if(selsum==total){//全部选中
		var html2='<a href="javascript:;"  class="action-item " onClick="task_toggle_user_all(this,0)"><span>所有成员已关注</span>(<span class="count">'+selsum+'/'+total+'</span>)</a>';
	}else{
		var html2='<a href="javascript:;"  class="action-item " onClick="task_toggle_user_all(this,1)"><span>添加全部成员</span>(<span class="count">'+selsum+'/'+total+'</span>)</a>';
	}
	el.closest('.popbox').find('.popbox-footer>.action-item').replaceWith(html2);
	jQuery('.js-popbox').each(function(){
		jQuery(this).popbox();
	});
	task_follow(taskid);
}
function task_follow(taskid){
	var leng=jQuery('#task_panel_'+taskid+' .task-members.follow .list-unstyled').find('li').length;
	
	if(leng>0){
		$('.task-members.follow .list-unstyled').closest('.task-members').siblings('.content_module_top').find('.weui-add-span').addClass('hide');		
	}else{
		$('.task-members.follow .list-unstyled').closest('.task-members').siblings('.content_module_top').find('.weui-add-span').removeClass('hide');		
	}
}
function task_worktime(taskid,worktime){
	var el=jQuery('#task_'+taskid+' .task-badge-worktime,#task_panel_'+taskid+' .task-badge-worktime');
	if(worktime=='0'){
		el.remove();
	}else{
		var html='<span class="task-badge task-badge-worktime" title="工时:'+worktime+'小时"><i class="dzz dzz-clock"></i><em>'+worktime+'</em></span>';
		if(el.length){
			el.replaceWith(html);
		}else{
			jQuery(html).appendTo('#task_'+taskid+' .task-item-badges,#task_panel_'+taskid+' .task-item-badges');
		}
	}
	jQuery.post(correcturl(cpurl+'&do=saveworktime'),{"taskid":taskid,'worktime':worktime},function(){});
	var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
		layout_catlist(jQuery('#catlist_'+catid));
}
function task_money(taskid,money){
	var el=jQuery('#task_'+taskid+' .task-badge-money,#task_panel_'+taskid+' .task-badge-money');
	if(money=='0'){
		el.remove();
	}else{
		var html='<span class="task-badge task-badge-money" title="预算:'+money+'"><i class="dzz dzz-money"></i><em>'+money+'</em></span>';
		if(el.length){
			el.replaceWith(html);
		}else{
			jQuery(html).appendTo('#task_'+taskid+' .task-item-badges,#task_panel_'+taskid+' .task-item-badges');
		}
	}
	jQuery.post(correcturl(cpurl+'&do=savemoney'),{"taskid":taskid,'money':money},function(){});
	if(board.layout<1){
	var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
		layout_catlist(jQuery('#catlist_'+catid));
	}
}
function task_endtime(taskid,endtime){
	var el=jQuery('#task_'+taskid+' .task-badge-time,#task_panel_'+taskid+' .task-badge-time');
	if(endtime=='0'){
		el.remove();
	}else{
		var now=new Date().getTime();
		var endtimestamp=new Date(endtime).getTime();
		var arr=endtime.split('-');
		if(new Date().getFullYear()==parseInt(arr[0])) var fendtime=arr[1]+'-'+arr[2];
		else var fendtime=endtime;
		var html='';
		if(endtimestamp-now<0 && now-endtimestamp<60*60*24*1000){
		   html+='<span class="task-badge task-badge-time badge-expire-soon" title="截止:'+endtime+'" time="'+endtime+'"><i class="dzz dzz-notifications"></i><em>'+fendtime+'</em></span>';
		}else if(now>endtimestamp){
		   html+='<span class="task-badge task-badge-time badge-expire-due" title="任务已经截止" time="'+endtime+'"><i class="dzz dzz-notifications"></i><em>'+fendtime+'</em></span>';
		}else{
		   html+='<span class="task-badge task-badge-time" title="截止:'+endtime+'" time="'+endtime+'"><i class="dzz dzz-notifications"></i><em>'+fendtime+'</em></span>';
		}
		if(el.length){
			el.replaceWith(html);
		}else{
			jQuery(html).appendTo('#task_'+taskid+' .task-item-badges,#task_panel_'+taskid+' .task-item-badges');
		}
	}
	jQuery.post(correcturl(cpurl+'&do=saveendtime'),{"taskid":taskid,'endtime':endtime},function(){});
	if(board.layout<1){
	var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
		layout_catlist(jQuery('#catlist_'+catid));
	}
}
function task_del(taskid){
	var el=jQuery('#task_'+taskid);
	jQuery.getJSON(correcturl(cpurl+'&do=taskdelete'),{'taskid':taskid},function(json){
		var cat=el.closest('.catlist');
		el.remove();
		window.location.reload();
		if(board.layout<1){
			layout_catlist(cat);
		}

		task_panel_close();
	});
}
function task_archive(taskid){//归档完成任务
    var taskids=[taskid];
	var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
	jQuery.getJSON(correcturl(cpurl+'&do=taskarchive'),{'taskid':taskid,'taskids':[taskid]},function(data){
		if(data.msg=='success'){
			window.location.reload();
			layout_catlist(jQuery('#catlist_'+catid));
		}
	});
}
function task_move_to(catid,taskid){
	jQuery.getJSON(correcturl(cpurl+'&do=moveto'),{'catid':catid,'taskid':taskid},function(json){
		if(json.msg=='success'){
			var taskdiv=jQuery('#task_'+taskid);
			var catlist=jQuery('#catlist_'+catid);
			if(catlist.length){
			catlist.find('.task-append').before(taskdiv.get(0));
			}else{
				taskdiv.remove();
			}
			if(board.layout<1){
				layout_catlist(catlist);
				var ocatid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
				layout_catlist(jQuery('#catlist_'+ocatid));
			}
			//window.location.href=MOD_URL+'&op=list&tbid='+tbid;	
			task_panel_close();
		}
	});
}
function task_complete(taskid,obj,tbid){
	var el=jQuery(obj);
	if(el.closest('#task_'+taskid).length>0){
		var tar1=jQuery('.task-panel[taskid='+taskid+'] .task-title input');
	}else{
		var tar1=jQuery('#task_'+taskid+' input');
	} 
	var tar=jQuery('#task_'+taskid+', .task-panel[taskid='+taskid+'] .task-title');
	var status=0;
	if(el.prop('checked')){
		status=2;
		tar1.prop('checked',true);
		tar.addClass('line-through');
	}else{
		tar1.prop('checked',false);
		tar.removeClass('line-through');
	}
	var data={'status':status,'taskid':taskid};
	if(tbid) data.tbid=tbid;
	jQuery.getJSON(correcturl(cpurl+'&do=taskcomplete'),data,function(json){
		if(board && board.autoarchive>0){
			jQuery('#task_'+taskid).remove();
			if(board.layout<1){
				var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
				layout_catlist(jQuery('#catlist_'+catid));
			}
		}
	});
}
/* @authorcode  f12c4e54920727fc04d615f7ab97416a */
function task_show_todo(taskid){
	jQuery('#task_panel_'+taskid+' .content-module-subs').removeClass('hide');
}

function task_show_todo_editor(subid,taskid,obj){
	var el=jQuery(obj).addClass('hide');
	el.parent().find('.edit').removeClass('hide');
	el.parent().find('input').focus();
	jQuery(document).on('click.todo_edit_'+subid,function(event){
		if(!jQuery(event.target).closest(el.parent()).length){
			 task_save_todo(subid,taskid);
			 jQuery(document).off('click.todo_edit_'+subid);
		}
	});
}

function task_save_todo(subid,taskid){
	var li=jQuery('#task_panel_'+taskid+' .todo-item[subid='+subid+']');
	var osubname=trim(li.find('.todo-item-edit p').html());
	var subname=trim(li.find('.todo-edit-control input').val());
	if(osubname==subname){
		li.find('.todo-item-edit p').removeClass('hide');
		li.find('.todo-item-edit .edit').addClass('hide');
		return;
	}
	jQuery.getJSON(correcturl(cpurl+'&do=tasksubedit'),{'subname':subname,'subid':subid,'taskid':taskid},function(json){
		if(json.msg=='success'){
			li.find('.todo-item-edit p').html(subname).removeClass('hide');
			li.find('.todo-item-edit .edit').addClass('hide');
			li.find('.todo-edit-control input').val(subname);
		}
	});
}
function task_show_add_todo_editor(taskid,obj){
	var el=jQuery(obj);
	el.addClass('hide');
	el.parent().find('.new-todo-control').removeClass('hide');
	el.parent().find('.new-todo-control input').focus();
	jQuery(document).on('click.new-todo-'+taskid,function(event){
		if(!jQuery(event.target).closest(el.parent()).length){
			 task_cancel_add_todo_editor(taskid);
			 jQuery(document).off('click.new-todo-'+taskid);
		}
	});
}
function task_cancel_add_todo_editor(taskid){
	var el=jQuery('#task_panel_'+taskid+' .new-todo');
	el.find('.new-todo-control').addClass('hide');
	el.find('a').removeClass('hide');
	
}
function task_del_todo(subid,taskid){
	var li=jQuery('#task_panel_'+taskid+' .todo-item[subid='+subid+']');
	jQuery.getJSON(correcturl(cpurl+'&do=tasksubdel'),{'subid':subid,'taskid':taskid},function(json){
		if(json.msg=='success'){
			li.remove();
			task_subs_update(taskid);
		}
	});
}
function task_complete_todo(subid,taskid,obj){
	
	var el=jQuery(obj);
	var complete=el.find('.dzz-max').length;
	jQuery.getJSON(correcturl(cpurl+'&do=tasksubcomplete'),{'subid':subid,'taskid':taskid,'completed':complete},function(json){
		if(json.msg=='success'){
			if(complete>0) {
				
				el.find('.dzz').removeClass('dzz-max').addClass('dzz-assignment_turned');
			}else{
				el.find('.dzz').removeClass('dzz-assignment_turned').addClass('dzz-max');
			}
		}
		task_subs_update(taskid);
	});
	
}
function task_add_todo(taskid){
	var newtodo=jQuery('#task_panel_'+taskid+' .new-todo');
	var subname=newtodo.find('.new-todo-text').val();
	if(subname==''){
		newtodo.find('.new-todo-text').focus();
		return;
	}
	
	jQuery.getJSON(correcturl(cpurl+'&do=tasksubadd'),{'subname':subname,'taskid':taskid},function(json){
		if(json.msg=='success'){
			appendTaskTodo(json);
			newtodo.find('.new-todo-text').val('').focus();
		}
	});
}

function task_attachs_update_coverimage(taskid,dpath,id){//更新附件数量
	jQuery.post(correcturl(cpurl+'&do=setCoverImage'),{'taskid':taskid,'id':id},function(json){
		if(json.error){
			showmessage(json.error,'danger',3000,1);
		}else{
			if(json.imageaid>0){
				jQuery('#fwin_view_'+taskid+' .attach-item a.save_dffed').html('设为封面')
				jQuery('#fwin_view_'+taskid+' .attach-item[attachid='+id+'] a.save_dffed').html('取消封面');
				var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
				if(jQuery('#task_'+taskid+' .task-item-coverimage').length){
					jQuery('#task_'+taskid+' .task-item-coverimage').html('<img src="'+DZZSCRIPT+'?mod=io&op=thumbnail&path='+dpath+'&width=512&height=1024" onload="layout_catlist(jQuery(\'#catlist_'+catid+'\'))" /> <div class="long_image_shadow"></div>');
					layout_catlist(jQuery('#catlist_'+catid));
				}
				if(jQuery('#fwin_view_'+taskid+' .task-item-coverimage').length){
					jQuery('#fwin_view_'+taskid+' .task-item-coverimage').html('<img src="'+DZZSCRIPT+'?mod=io&op=thumbnail&path='+dpath+'&width=800&height=160" />');
				}
			}else{
				jQuery('#fwin_view_'+taskid+' a.save_dffed').html('设为封面');
				jQuery('#task_'+taskid+' .task-item-coverimage').empty();
				jQuery('#fwin_view_'+taskid+' .task-item-coverimage').empty();
			}
		}
	},'json');
};
function task_attachs_update(taskid,attachs){//更新附件数量
	if(!attachs)  attachs=jQuery('#task_panel_'+taskid+' .content-module-attachs .attach-item').length;
	if(jQuery('#task_panel_'+taskid+' .task-item-badges .task-badge-attach').length){
		jQuery('#task_panel_'+taskid+' .task-item-badges .task-badge-attach').replaceWith('<span class="task-badge task-badge-attach" title="任务有'+attachs+' 个附件"><i class="dzz dzz-attachment"></i><em>'+attachs+' 个</em></span>');
	}else{
		jQuery('<span class="task-badge task-badge-attach" title="任务有'+attachs+' 个附件"><i class="dzz dzz-attachment"></i><em>'+attachs+' 个</em></span>').appendTo('#task_panel_'+taskid+' .task-item-badges');
	}
	//task-item
	if(jQuery('#task_'+taskid+' .task-item-badges .task-badge-attach').length){
		jQuery('#task_'+taskid+' .task-item-badges .task-badge-attach').replaceWith('<span class="task-badge task-badge-attach" title="任务有'+attachs+' 个附件"><i class="dzz dzz-attachment"></i><em>'+attachs+' 个</em></span>');
	}else{
		jQuery('<span class="task-badge task-badge-attach" title="任务有'+attachs+' 个附件"><i class="dzz dzz-attachment"></i><em>'+attachs+' 个</em></span>').appendTo('#task_'+taskid+' .task-item-badges');
	}
	
}
function task_subs_update(taskid){ //更新检查项；
	var todo=jQuery('#task_panel_'+taskid+' .task-todos .sortable');
		var subs=todo.children().length;
		var subs_c=todo.find('.todo-item-check .dzz-assignment_turned').length;
	var task_badges_sub=jQuery('.task-item-badges .task-badge-sub');
	var html='';
	jQuery('#task_panel_'+taskid+' .progress-todos .progress-bar').css('width',(subs?subs_c/subs*100:0)+'%');
	jQuery('#task_panel_'+taskid+' .progress-todos span').html((subs?Math.ceil(subs_c/subs*100):0)+'%');
	if(!subs && !subs_c){
		task_badges_sub.remove();
	}else{
		var done=''
		if(subs==subs_c){
			done='badge-todo-done';
		}
		//task-panel
		if(jQuery('#task_panel_'+taskid+' .task-item-badges .task-badge-sub').length){
			jQuery('#task_panel_'+taskid+' .task-item-badges .task-badge-sub').replaceWith('<span class="task-badge task-badge-sub '+done+'" title="检查项：'+subs_c+'/'+subs+'"><i class="dzz dzz-assignment_turned"></i> <em>'+subs_c+'/'+subs+'</em></span>');
		}else{
			jQuery('<span class="task-badge task-badge-sub '+done+'" title="检查项：'+subs_c+'/'+subs+'"><i class="dzz dzz-assignment_turned"></i> <em>'+subs_c+'/'+subs+'</em></span>').appendTo('#task_panel_'+taskid+' .task-item-badges');
		}
		//task-item
		if(jQuery('#task_'+taskid+' .task-item-badges .task-badge-sub').length){
			jQuery('#task_'+taskid+' .task-item-badges .task-badge-sub').replaceWith('<span class="task-badge task-badge-sub '+done+'" title="检查项：'+subs_c+'/'+subs+'"><i class="dzz dzz-assignment_turned"></i> <em>'+subs_c+'/'+subs+'</em></span>');
		}else{
			jQuery('<span class="task-badge task-badge-sub '+done+'" title="检查项：'+subs_c+'/'+subs+'"><i class="dzz dzz-assignment_turned"></i> <em>'+subs_c+'/'+subs+'</em></span>').appendTo('#task_'+taskid+' .task-item-badges');
		}
	}
}
function appendTaskTodo(data){
	var html='';
	html+='<li class="todo-item " subid="'+data.subid+'" taskid="'+data.taskid+'"> ';
	html+='		<a class="todo-item-check" onclick="task_complete_todo(\''+data.subid+'\', \''+data.taskid+'\',this)" ><span class="dzz dzz-max"></span></a>';
	html+='	<div class="todo-item-edit editable">';
	html+='	  <p onclick="task_show_todo_editor(\''+data.subid+'\',\''+data.taskid+'\', this)" class=""> '+data.subname+'</p>';
	html+='	  <div class="edit hide">';
	html+='		<div class="todo-edit-control">';
	html+='		  <input  type="text" class="form-control" value="'+data.subname+'" onkeyup="if(event.keyCode==13){task_save_todo(\''+data.subid+'\', \''+data.taskid+'\');}">';
	html+='		</div>';
	html+='		<button onclick="task_save_todo(\''+data.subid+'\',\''+data.taskid+'\')"   class="weui-task-btn weui-task-submit weui-task-view todo-save">保存 </button>';
	html+='		<button class="weui-task-btn weui-task-cancel weui-task-view todo-del todo-del" onclick="task_del_todo(\''+data.subid+'\', \''+data.taskid+'\')"> 删除 </button>';
	html+='	  </div>';
	html+='	</div>';
	html+='  </li>';
	jQuery(html).appendTo('#task_panel_'+data.taskid+' .task-todos .sortable');
	//task_subs_update(data.taskid);
	
}
function cat_rename(catid){//重命名列表
	if(!catid) return;
	var catname_input=jQuery('#catname_pop_'+catid);
	var catname=trim(catname_input.val());
	if(!catname || catname=='undefined'){
		catname_input.focus();
		return;
	}
	var popbox=catname_input.closest('.popbox');
	//popbox.find('button.btn-success').button('loading');
	jQuery.getJSON(correcturl(cpurl+'&do=catrename'),{'catid':catid,'catname':catname},function(json){
		if(json.msg=='success'){
			jQuery('#catlist_'+json.catid+' .catlist-header-span').html(json.catname);
			popbox.find('.close').trigger('click');
		}
	});
	if(board.layout<1){
		layout_catlist(jQuery('#catlist_'+catid));
	}
}
function cat_del(catid){//删除列表
	jQuery.getJSON(correcturl(cpurl+'&do=catdelete'),{'catid':catid},function(json){
		if(json.msg=='success'){
			jQuery('#catlist_'+catid).remove();
		}
		catlist_save();
	});
}
function cat_archive(catid){//归档列表
	jQuery.getJSON(correcturl(cpurl+'&do=catarchive'),{'catid':catid},function(json){
		if(json.msg=='success'){
			jQuery('#catlist_'+catid).remove();
		}
		catlist_save();
	});
}
function cat_copy(catid){//拷贝列表
	if(!catid) return;
	var catname_input=jQuery('#catname_pop_'+catid);
	var catname=trim(catname_input.val());
	if(!catname || catname=='undefined'){
		catname_input.focus();
		return;
	}
	var popbox=catname_input.closest('.popbox');
	//popbox.find('button.btn-success').button('loading');
	jQuery.getJSON(correcturl(cpurl+'&do=catcopy'),{'catid':catid,'catname':catname},function(data){
		if(data.error){
			//popbox.find('button.btn-success').button(data.error);
		}else{
			popbox.find('.close').trigger('click');
			 var html='';
				 html+='<div id="catlist_'+data.catid+'" class="catlist" catid="'+data.catid+'">';
				 html+='      <div class="catlist-header clearfix">';
				 html+='          <span class="catlist-header-span">'+data.catname+'</span>';
				 html+='		  <a href="javascript:;" class="catlist-header-menu action-icon  js-popbox" data-href="'+MOD_URL+'&op=menu&do=catmenu&catid='+data.catid+'" data-catid="'+data.catid+'" data-placement="bottom" data-auto-adapt="true"> <i class="dzz dzz-more"></i> </a>';
				 html+='      </div>';
				 html+='      <div class="tasklist-container u-fancy-scrollbar">';
				 html+='      	<div class="task-container" catid="'+data.catid+'">';
				 html+='            <div class="task-append" style="height:0"></div>';
				 html+='            <div class="task-poster hide nodrager" catid="'+data.catid+'">';
				 html+='                 <div class="task-poster-body task-poster-body-focus clearfix">';
				 html+='					<div class="task-item-labels"></div>';
				 html+='					<textarea class="form-control " name="taskname" catid="'+data.catid+'"></textarea>';
				 html+='					<div class="task-poster-body-footer">';
				 html+='					   <div class="task-item-badges"></div>';
				 html+='					   <div class="task-item-members"></div>';
				 html+='					</div>';
				 html+='				</div>';
				 html+='				<div class="task-poster-footer"> ';
				 html+='					<button data-click="submit" class="btn btn-success confirm mr10" >保存 </button>'; 
				 html+='					<button data-click="cancel" class="btn btn-simple" >取消</button> ';
				 html+='					<a href="javascript:;"  class="action-icon"  data-placement="right" data-align="middle" data-auto-adapt="true"> <i class="glyphicon glyphicon-collapse-down"></i> </a>'; 
				 html+='				</div>';
				 html+='            </div>';
				 html+='         </div>';
				 html+='       </div>';
				 html+='         <div class="catlist-footer">';
				 html+='              <a href="javascript:;" class="task-add" catid="'+data.catid+'">新建任务</a>';
				 html+='         </div>';
				 html+='     </div>';
				 jQuery('#catlist_'+catid).after(html);
				 jQuery('#catlist_'+data.catid+' .js-popbox').popbox();
				 catlist_save();
				 inlit_dzzdragsort('catlist',board.layout);
				 //获取分类下的任务
				 jQuery.get(MOD_URL+'&op=list&do=ajax&operation=getTasklistByCatid&catid=&tbid='+tbid,{'catid':data.catid},function(html){
					jQuery('#catlist_'+data.catid+' .task-append').before(html);
					
						if(board.layout<1){
						//设置高度
							layout_catlist(jQuery('#catlist_'+data.catid));
						}
					  inlit_dzzdragsort('tasklist',board.layout);
					});
					//保存顺序
				 	
					
					
		}
	});
}
function cat_task_endtime(catid,endtime){//批量设置截止时间

	jQuery('#catlist_'+catid+' .task-item').each(function(){
		var taskid=jQuery(this).attr('taskid');
		task_endtime(taskid,endtime);
	});
	
}
/* @authorcode  f12c4e54920727fc04d615f7ab97416a */
function cat_task_worktime(catid,worktime){//批量设置截止时间

	jQuery('#catlist_'+catid+' .task-item').each(function(){
		var taskid=jQuery(this).attr('taskid');
		task_worktime(taskid,worktime);
	});
	
}
function cat_task_money(catid,money){//批量设置截止时间

	jQuery('#catlist_'+catid+' .task-item').each(function(){
		var taskid=jQuery(this).attr('taskid');
		task_money(taskid,money);
	});
	
}
function cat_task_label(catid,pow,obj){//批量设置标签
	var el=jQuery(obj);
	var flag=el.find('.dzz-done').length;
	var labelname=el.attr('title');
	var color=el.data('color');
	el.find('.dzz').toggleClass('dzz-done');
	jQuery('#catlist_'+catid+' .task-item').each(function(){
		var taskid=jQuery(this).attr('taskid');
		if(flag){
			if(jQuery('#task_'+taskid+' .task-item-labels .task-label[pow='+pow+']').length){
				jQuery('#task_'+taskid+' .task-item-labels .task-label[pow='+pow+']').remove();
				jQuery('.task-panel[taskid='+taskid+'] .task-labels .task-label[pow='+pow+']').remove();
				jQuery.get(correcturl(cpurl+'&do=setLabel'),{"pow":pow,"taskid":taskid,'isadd':0},function(){});
			}
		}else{
			if(!jQuery('#task_'+taskid+' .task-item-labels .task-label[pow='+pow+']').length){
				jQuery('<div class="task-label '+color+'-label" pow="'+pow+'"></div>').appendTo('#task_'+taskid+' .task-item-labels');
				jQuery('<li class="task-label '+color+'-label" pow="'+pow+'">'+labelname+'<a class="icon-action glyphicon glyphicon-remove" href="javascript:;" onclick="task_remove_label('+taskid+','+pow+',this)" title="移除该标签"></a></li>').appendTo('.task-panel[taskid='+taskid+'] .task-labels .list-unstyled');
				jQuery.get(correcturl(cpurl+'&do=setLabel'),{"pow":pow,"taskid":taskid,'isadd':1},function(){});
			}
		}
	});
	if(board.layout<1){
	layout_catlist(jQuery('#catlist_'+catid));
	}
}
function cat_task_assign(catid,uid,username,obj){//批量分配任务
	var el=jQuery(obj);
	var flag=el.find('.dzz-done').length;       
	el.find('.dzz').toggleClass('dzz-done');
	
	jQuery('#catlist_'+catid+' .task-item').each(function(){
		var taskid=jQuery(this).attr('taskid');
		if(flag){//移除分配任务
			if(jQuery('#task_'+taskid+' .task-item-members .avatar[uid='+uid+']').length) {
				jQuery('#task_'+taskid+' .task-item-members .avatar[uid='+uid+']').remove();
				jQuery('#task_panel_'+taskid+' .task-members.member .avatar[uid='+uid+']').parent().remove();
				jQuery.get(correcturl(cpurl+'&do=saveuser'),{"uid":uid,'username':username,"taskid":taskid,'type':'remove','action':2},function(){});
			}
		}else{//分配任务
			if(!jQuery('#task_'+taskid+' .task-item-members .avatar[uid='+uid+']').length) {
				
				
				var html='<a class="avatar avatar-30 js-popbox" data-href="'+MOD_URL+'&op=menu&do=taskmenu&uid='+uid+'&taskid='+taskid+'&step=15&ac=2" data-placement="top" data-auto-adapt="true" title="'+username+'" uid="'+uid+'" href="javascript:;">';
					//html+=el.find('.avatar.avatar-30').html();;
					html+='</a>';
				var el1=jQuery(html);
				el1.appendTo('#task_'+taskid+' .task-item-members');
				el.find('.Topcarousel,img.img-circle').clone().appendTo(el1);
				
				if(jQuery('#task_panel_'+taskid).length){
					var html1='<li><a class="avatar avatar-40 js-popbox" data-href="'+MOD_URL+'&op=menu&do=taskmenu&uid='+uid+'&taskid='+taskid+'&step=15&ac=2" data-placement="top" data-auto-adapt="true" title="'+username+'" uid="'+uid+'" href="javascript:;">';
						// html+=el.find('.avatar.avatar-30').html();;
						html1+='</a></li>';
					var el2=jQuery(html1);

					jQuery('#task_panel_'+taskid+' .task-members.Member ul .task_labels_btn').before(el2);
					el.find('.Topcarousel,img.img-circle').clone().appendTo(el2.find('.avatar'));
				}
				jQuery.get(correcturl(cpurl+'&do=saveuser'),{"uid":uid,'username':username,"taskid":taskid,'type':'add','action':2},function(){});
			}
		}
		
	});
	jQuery('.js-popbox').each(function(){
		jQuery(this).popbox();
	});
	if(board.layout<1){
		layout_catlist(jQuery('#catlist_'+catid));
	}
}
function cat_task_move_to(catid,ocatid){//批量移动任务
	var taskids=[];
	jQuery('#catlist_'+ocatid+' .task-item').each(function(){
		taskids.push(jQuery(this).attr('taskid'));
	});
	if(taskids.length){
		jQuery.getJSON(correcturl(cpurl+'&do=batchmoveto'),{'taskids':taskids,'catid':catid},function(data){
				for(var i in data.taskids){
					var html=jQuery('#task_'+data.taskids[i]).get(0);
					jQuery('#task_'+data.taskids[i]).remove();
					jQuery('#catlist_'+catid+' .task-append').before(html);
				}
				if(board.layout<1){
				layout_catlist(jQuery('#catlist_'+catid));
				layout_catlist(jQuery('#catlist_'+ocatid));
				}
				
		});
	}
}

function cat_complete_archive(catid){//归档完成任务
	var taskids=[];
	jQuery('#catlist_'+catid+' .task-item-check .weui-check__label input:checked').each(function(){
		taskids.push(jQuery(this).parent().parent().data('taskid'));
	});
	if(taskids.length){
		jQuery.getJSON(correcturl(cpurl+'&do=taskarchive'),{'taskids':taskids},function(data){
			if(data.msg=='success'){
				for(var i in data.taskids){
					jQuery('#task_'+data.taskids[i]).remove();
				}
				if(board.layout<1){
				layout_catlist(jQuery('#catlist_'+catid));
				}
			}
		});
	}
}

function cat_follow_toggle(catid,obj){
	var el=jQuery(obj);
	var isadd=1;
	if(el.find('.dzz-done').length) isadd=0;
	el.find('span .dzz').toggleClass('dzz-done');
	// jQuery('#catlist_'+catid+' .catlist-header-title h2 i').toggleClass('glyphicon-eye-open');
	jQuery.post(correcturl(cpurl+'&do=catfollow'),{'catid':catid,'isadd':isadd});
}
function print_r(theObj){
        if(theObj.constructor == Array ||
          theObj.constructor == Object){
        document.write("<ul>")
       for(var p in theObj){
      if(theObj[p].constructor == Array||
         theObj[p].constructor == Object){
            document.write("<li>["+p+"] => "+typeof(theObj)+"</li>");
            document.write("<ul>")
            print_r(theObj[p]);
            document.write("</ul>")
      } else {
        document.write("<li>["+p+"] => "+theObj[p]+"</li>");
      }
    }
    document.write("</ul>")
}
}
function showTaskPanel(taskid,flag){
	var pop=null;
	jQuery('.weui-popup__container--visible').removeClass('weui-popup__container--visible').hide();
	if(flag=='comment'){
		if(jQuery('#fwin_view_'+taskid+'_comment').length) {
			pop=jQuery('#fwin_view_'+taskid+'_comment');
			pop.addClass('weui-popup__container--visible').show();
		}else{
			var html='<div id="fwin_view_'+taskid+'_comment" class="weui-popup__container weui-popup__container--visible"></div>';
			pop=jQuery(html).appendTo('body');
			pop.load(correcturl(ajaxurl+'&do=comment&taskid='+taskid));
		}
	}else if(flag=='event'){
		if(jQuery('#fwin_view_'+taskid+'_event').length) {
			pop=jQuery('#fwin_view_'+taskid+'_event');
			pop.addClass('weui-popup__container--visible').show();
		}else{
			var html='<div id="fwin_view_'+taskid+'_event" class="weui-popup__container weui-popup__container--visible"></div>';
			pop=jQuery(html).appendTo('body');
		}
		pop.load(correcturl(ajaxurl+'&do=ajax&operation=getevent&first=1&taskid='+taskid));
	}else{
		if(jQuery('#fwin_view_'+taskid).length) {
			pop=jQuery('#fwin_view_'+taskid);
			pop.addClass('weui-popup__container--visible').show();
		}else{
			var html='<div id="fwin_view_'+taskid+'" class="weui-popup__container weui-popup__container--visible"></div>';
			pop=jQuery(html).appendTo('body');
			
			pop.load(correcturl(MOD_URL+'&op=view&taskid='+taskid));
		}
	}
	
}
function task_panel_close(){
	jQuery(document).off('click.taskpanel');
	jQuery('.found_header button').trigger('click');
	jQuery('.popbox-header .close').trigger('click');
	jQuery('.modal .close').trigger('click');
//	window.history.go(-1);
}
function task_cancel_taskinfo_editor(taskid){
    var el=jQuery('#task_panel_'+taskid+' .content-module-taskinfo');
	el.find('.taskinfo').removeClass('hide');
	el.find('.edit-section').addClass('hide');
   /* if(i==1){
		el.find('.content_module_top h3').removeClass('hide');
		el.find('.edit_form').addClass('hide');
	}else{
		el.find('.task-desc').removeClass('hide');
		el.find('.edit-section').addClass('hide');

		if(!jQuery('.task-desc .task-desc-text p')){
			el.find('.task-desc-add').removeClass('hide');
		}
	}*/
	
}


function task_show_taskinfo_editor(taskid){
	var el=jQuery('#task_panel_'+taskid+' .content-module-taskinfo');
	el.find('.taskinfo').addClass('hide');
	el.find('.edit-section').removeClass('hide');
	/*var el=jQuery('#task_panel_'+taskid+' .content-module-taskinfo');
	if(i==1){
		el.find('.content_module_top h3').addClass('hide');
		el.find('.edit_form').removeClass('hide');
	}else{

		el.find('.task-desc').addClass('hide');
		el.find('.task-desc-add').addClass('hide');
		el.find('.edit-section').removeClass('hide');
	}*/
	
}
function task_attach_del(attachid,taskid){
	var el=jQuery('#task_panel_'+taskid+' .attach-item[attachid='+attachid+']');
	jQuery.getJSON(correcturl(cpurl+'&do=taskattachdel'),{'taskid':taskid,'attachid':attachid},function(json){
		if(json.error){
			showmessage(json.error,'danger',3000,1);
		}else{
			if(parseInt(json.imageaid)==0){
				jQuery('#fwin_view_'+taskid+' a.save_dffed').html('设为封面');
				jQuery('#task_'+taskid+' .task-item-coverimage').empty();
				jQuery('#fwin_view_'+taskid+' .task-item-coverimage').empty();
			}else if(parseInt(json.imageaid)>0){
				jQuery('#fwin_view_'+taskid+' .attach-item a.save_dffed').html('设为封面');
				jQuery('#fwin_view_'+taskid+' .attach-item[attachid='+json.imageaid+'] a.save_dffed').html('取消封面');
				var catid=jQuery('#task_'+taskid).closest('.catlist').attr('catid');
				if(jQuery('#task_'+taskid+' .task-item-coverimage').length){
					jQuery('#task_'+taskid+' .task-item-coverimage').html('<img src="'+DZZSCRIPT+'?mod=io&op=thumbnail&path='+json.dpath+'&width=240&height=280" onload="layout_catlist(jQuery(\'#catlist_'+catid+'\'))" /> <div class="long_image_shadow"></div>');
					layout_catlist(jQuery('#catlist_'+catid));
				}
				if(jQuery('#fwin_view_'+taskid+' .task-item-coverimage').length){
					jQuery('#fwin_view_'+taskid+' .task-item-coverimage').html('<img src="'+DZZSCRIPT+'?mod=io&op=thumbnail&path='+json.dpath+'&width=800&height=160" />');
				}
			}
			el.slideUp(300,function(){el.remove();task_attachs_update(taskid);});
		}
	});
}
function task_attach_down(qid){
	var url=correcturl(MOD_URL+'&op=down&qid='+qid);
	if(BROWSER.ie){
			window.open(url);
		}else{
			if(!window.frames['hidefram']) jQuery('<iframe id="hideframe" name="hideframe" src="about:blank" frameborder="0" marginheight="0" marginwidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>').appendTo('body');
			window.frames['hideframe'].location=url;
		}
}
function task_attach_saveto(qid){
	var url=correcturl(MOD_URL+'&op=saveto&qid='+qid);
	if(!window.frames['hidefram']) jQuery('<iframe id="hideframe" name="hideframe" src="about:blank" frameborder="0" marginheight="0" marginwidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>').appendTo('body');
	window.frames['hideframe'].location=url;
	
}
function task_attach_preview(qid){
	var url=correcturl(MOD_URL+'&op=preview&qid='+qid);
	if(!top._config) window.open(url);
	else{
		if(!window.frames['hidefram']) jQuery('<iframe id="hideframe" name="hideframe" src="about:blank" frameborder="0" marginheight="0" marginwidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>').appendTo('body');
		window.frames['hideframe'].location=url;
	}
	
}
function upload_from_desktop(taskid){
	jQuery('#task_panel_'+taskid+' .content-module-attachs').removeClass('hide');
	try{
	parent.OpenFile('open','打开文件',{attach:['文件',['ATTACH','IMAGE','DOCUMENT','VIDEO','LINK','DZZDOC'],''],image:['图像(*.jpg,*.jpeg,*.png,*.gif)',['IMAGE','JPG','JPEG','PNG','GIF'],'']},{bz:'',multiple:true},function(data){//只打开本地盘
		var datas=[];
		if(data.params.multiple){
			datas=data.icodata
		}else{
			datas=[data.icodata];
		}
		for(var i in datas){
			var arr=datas[i];
			if(arr.type!='attach' && arr.type!='image' && arr.type!='document') arr.aid=0;
			
			arr.taskid=taskid;
			arr.filename=arr.name;
			jQuery.getJSON(correcturl(cpurl+'&do=taskattachsave'),arr,function(json){
				
				if(json.msg=='success'){
					var html='';
					html+='<div class="attach-item" attachid="'+json.id+'">';
					if(json.type=='image'){
						html+='	<div class="pic_fed clearfix">';
						html+='    <div class="img_pfed"> <a class="min_ipfed" hidefocus="true" href="'+json.url+'" rel="'+json.url+'" target="_blank"><img src="'+json.img+'" alt="'+json.filename+'" class="artZoom"  style="cursor: url(dzz/taskboard/images/attach/zoomin.cur), pointer;" ></a> </div>';
						html+=' </div>';
						html+='<div class="file_fed imgfile_fed clearfix"> '+json.filename+'<span class="kb_nffed">('+json.filesize+')</span>';
						html+='	<p class="down_ffed"> ';
						
						html+='	  <a href="javascript:;" hidefocus="true" class="btn_dffed skip_mmfed"  onclick="task_attach_down(\''+json.id+'\')">下载</a>';
						html+='	  <a href="javascript:void(0);" title="" hidefocus="true" class="save_dffed skip_mmfed"  onclick="task_attach_saveto(\''+json.id+'\')">保存到我的文档</a> '; 
						html+='	  <a href="javascript:void(0);" title="" hidefocus="true" class="del_dffed skip_mmfed"  onclick="task_attach_del(\''+json.id+'\',\''+json.taskid+'\')">删除</a>';
						html+='	</p>';
						html+=' </div>';
					}else if(json.type=='dzzdoc' || json.type=='link'){
						html+='<div class="file_fed file_fed_'+json.type+'  clearfix">';
						html+='	<div class="ico_ffed"><img src="'+json.img+'" alt="" style="height:64px;"> </div>';
						html+='	<p class="name_ffed">'+json.filename+'</p>';
						
						html+='	<p class="down_ffed"> ';
						html+='	  <a href="javascript:void(0);" hidefocus="true" class="preview_dffed skip_mmfed" onclick="task_attach_preview(\''+json.id+'\')">预览</a>';
						html+='	  <a href="javascript:void(0);" title="" hidefocus="true" class="del_dffed skip_mmfed"  onclick="task_attach_del(\''+json.id+'\',\''+json.taskid+'\')">删除</a>';
						html+='	</p>';
						html+=' </div>';
					}else if(json.type=='video'){
						html+='<div class="file_fed file_fed_video  clearfix">';
						html+='	<div class="ico_ffed" style="margin-right:20px"><img src="'+json.img+'" alt="" class="videoclass50_50"> </div>';
						html+='	<p class="name_ffed">'+json.filename+'</p>';
						
						html+='	<p class="down_ffed"> ';
						html+='	  <a href="javascript:void(0);" hidefocus="true" class="preview_dffed skip_mmfed" onclick="task_attach_preview(\''+json.id+'\')">预览</a>';
						html+='	  <a href="javascript:void(0);" title="" hidefocus="true" class="del_dffed skip_mmfed"  onclick="task_attach_del(\''+json.id+'\',\''+json.taskid+'\')">删除</a>';
						html+='	</p>';
						html+=' </div>';
						
					}else{
						html+='<div class="file_fed file_fed_attach  clearfix">';
						html+='	<div class="ico_ffed"><img src="'+json.img+'" alt="" style="height:64px;"> </div>';
						html+='	<p class="name_ffed">'+json.filename+'<span class="kb_nffed">('+json.filesize+')</span> </p>';
						
						html+='	<p class="down_ffed"> ';
						html+='	  <a href="javascript:void(0);" hidefocus="true" class="preview_dffed skip_mmfed" onclick="task_attach_preview(\''+json.id+'\')">预览</a>';
						html+='	  <a href="javascript:;" hidefocus="true" class="btn_dffed skip_mmfed"  onclick="task_attach_down(\''+json.id+'\')">下载</a>';
						html+='	  <a href="javascript:void(0);" title="" hidefocus="true" class="save_dffed skip_mmfed"  onclick="task_attach_saveto(\''+json.id+'\')">保存到我的文档</a> '; 
						html+='	  <a href="javascript:void(0);" title="" hidefocus="true" class="del_dffed skip_mmfed"  onclick="task_attach_del(\''+json.id+'\',\''+json.taskid+'\')">删除</a>';
						html+='	</p>';
						html+=' </div>';
					}
					html+=' </div>';
					
					jQuery('#task_panel_'+taskid+' .content-module-attachs .attachment').append(html);
					
					if(json.imageaid>0){
						task_attachs_update_coverimage(taskid,json.imageaid);
					}
					//更新各处附件数量
					task_attachs_update(taskid,json.attachs);
				}
			});
		}
	}); 
	}catch(e){
		alert('请在桌面内使用！');
	}

}
/* @authorcode  f12c4e54920727fc04d615f7ab97416a */
function formatSize(bytes){
	var i = -1; 
	do {
		bytes = bytes / 1024;
		i++;  
	} while (bytes > 99);
   
	return Math.max(bytes, 0).toFixed(1) + ['kB', 'MB', 'GB', 'TB', 'PB', 'EB'][i];          
};

function callback_by_comment(id,action){
	var taskid=jQuery('#'+id).closest('.task-panel').attr('taskid');
	if(!taskid) return;
	task_comment_update(taskid,action=='add'?1:-1);
}
function task_comment_update(taskid,ceof){
	if(jQuery('#task_'+taskid+' .task-item-badges .task-badge-comment').length){
		var comments=parseInt(parseInt(jQuery('#task_'+taskid+' .task-item-badges .task-badge-comment em').html()))+ceof;
	}else{
		var comments=ceof;
	}
	if(comments>0){
		if(jQuery('#task_panel_'+taskid+' .task-item-badges .task-badge-comment').length ){
			jQuery('#task_panel_'+taskid+' .task-item-badges .task-badge-comment').replaceWith('<span class="task-badge task-badge-comment" title="任务有'+comments+' 个附件"><i class="dzz dzz-attachment"></i><em>'+comments+' 个</em></span>');
		}else{
			jQuery('<span class="task-badge task-badge-comment" title="任务有'+comments+' 个附件"><i class="dzz dzz-attachment"></i><em>'+comments+' 个</em></span>').appendTo('#task_panel_'+taskid+' .task-item-badges');
		}
		//task-item
		if(jQuery('#task_'+taskid+' .task-item-badges .task-badge-comment').length && comments>0){
			jQuery('#task_'+taskid+' .task-item-badges .task-badge-comment').replaceWith('<span class="task-badge task-badge-comment" title="任务有'+comments+' 个附件"><i class="dzz dzz-attachment"></i><em>'+comments+' 个</em></span>');
		}else{
			jQuery('<span class="task-badge task-badge-comment" title="任务有'+comments+' 个附件"><i class="dzz dzz-attachment"></i><em>'+comments+' 个</em></span>').appendTo('#task_'+taskid+' .task-item-badges');
		}
	}else{
		jQuery('#task_panel_'+taskid+' .task-item-badges .task-badge-comment,#task_'+taskid+' .task-item-badges .task-badge-comment').remove();
	}
}
function board_complete_archive(tbid){//归档所有完成任务
	var taskids=[];
	$.confirm('确定要归档所有已完成的任务？<br><small>归档后的任务可以在已归档内找到，并且可以再次激活</small>',function(){
		var el=jQuery('.task-item-check input:checked');
		el.each(function(){
			taskids.push(jQuery(this).closest('.task-item-check').data('taskid'));
		});
		if(taskids.length){
			jQuery.getJSON(correcturl(cpurl+'&do=taskarchive'),{'taskids':taskids},function(data){
				if(data.msg=='success'){
					for(var i in data.taskids){
						jQuery('#task_'+data.taskids[i]).remove();
					}
					if(board.layout<1){
					layout_catlist();
					}
				}
			});
		}
		jQuery('.popbox .close').trigger('click');
	});
	
}
function board_autoarchive_toggle(obj){
	var el=jQuery(obj);
	var autoarchive=board.autoarchive>0?0:1;
	jQuery.getJSON(correcturl(cpurl+'&do=boardautoarchive'),{'autoarchive':autoarchive},function(data){
		if(data.msg=='success'){
			board.autoarchive=autoarchive;
			if(autoarchive>0){
				el.find('span.small-tip').html('开启');
			}else{
				el.find('span.small-tip').html('关闭');
			}
		}
	});
}

var filter={'keyword':'','labels':[],'uids':[],'datetype':'','metype':''};
function board_filter_isempty(){
	if(filter.labels.length<1 && filter.uids.length<1 && filter.datetype=='' && filter.keyword=='' && filter.metype==''){
		return true;
	}
	return false;
}
function board_filter_empty(){
	return filter={'keyword':'','labels':[],'uids':[],'datetype':'','metype':''};
}
function filter_turn(){
	if(board_filter_isempty()){
		jQuery('.filter-turn-on').addClass('hide');
		jQuery('.filter-turn-off').removeClass('hide');
	}else{
		jQuery('.filter-turn-on').removeClass('hide');
		jQuery('.filter-turn-off').addClass('hide');
	}
}
function get_filter_str(){
	var hash='';
	for(var key in filter){
		if(jQuery.inArray(key,['labels','uids'])>-1){
			if(filter[key].length){
				hash+=key+':'+filter[key].join('|')+';'
			}
		}else if(filter[key]){
			hash+=key+':'+filter[key]+';';
		}
	}
	return hash;

	/*if(flag==2){
		jQuery('#searchval').val(hash);
	}else if(flag==1){
		location.hash='#'+hash;
	}else{
		jQuery('#searchval').val(hash);
		location.hash='#'+hash;
	}*/
}
function filter_split(hash){
	var hasharr=[];
	var seted=[];
	if(hash){
		hasharr=hash.split(';');
		var hash1=[];
		for(var i=0;i<hasharr.length;i++){
			if(hasharr[i]=='') continue;
			hash1=hasharr[i].split(':');
			if(jQuery.inArray(hash1[0],['labels','uids'])>-1){
				seted[hash1[0]]=hash1[1].split('|');
			}else if(hash1.length>1){
				seted[hash1[0]]=hash1[1]
			}else if(hash1.length==1){
				seted['keyword']=hash1[0];
			}
		}
	}
	if(seted['keyword'] || seted['lables'] || seted['uids'] || seted['datetype']){
		seted['metype']='';
	}
	filter={'keyword':'','labels':[],'uids':[],'datetype':'','metype':''};
	for(var j in seted){
		filter[j]=seted[j];
	}
}
function filter_set(){
	var hash=location.hash;
	var hasharr=[];
	var seted=[];
	if(hash){
		hash=hash.replace(/^#/,'');
		
		hasharr=hash.split(';');
		var hash1=[];
		for(var i=0;i<hasharr.length;i++){
			if(hasharr[i]=='') continue;
			hash1=hasharr[i].split(':');
			if(jQuery.inArray(hash1[0],['labels','uids'])>-1){
				seted[hash1[0]]=hash1[1].split('|');
			}else if(hash1.length>1){
				seted[hash1[0]]=decodeURI(hash1[1]);
			}else if(hash1.length==1){
				seted['keyword']=decodeURI(hash1[0]);
			}
		}
	}
	/*filter={'keyword':'','labels':[],'uids':[],'datetype':'','metype':''};
	for(var j in filter){
		if(seted[j]) filter[j]=seted[j];
	}*/
	$('#searchval').val(get_filter_str());

}

function filter_init(){ //根据filter的值设置pobbox
	
	//设置关键词
	//jQuery('#searchval').val(filter.keyword);
		
	//设置标签
	jQuery('#filtermenu .label-item a').each(function(){
		if(jQuery.inArray(jQuery(this).attr('pow'),filter.labels)>-1){
			jQuery(this).find('.dzz').addClass('dzz-done');
		}else{
			jQuery(this).find('.dzz').removeClass('dzz-done');
		}
	});
	
	//设置用户
	jQuery('#filtermenu .member-item a').each(function(){
		if(jQuery.inArray(jQuery(this).attr('uid'),filter.uids)>-1){
			jQuery(this).parent().addClass('selected');
		}else{
			jQuery(this).parent().removeClass('selected');
		}
	});
	//设置日期
	jQuery('#filtermenu .datefilter-list a').each(function(){
		if(jQuery(this).attr('datetype')==filter.datetype){
			jQuery(this).addClass('selected');
		}else{
			jQuery(this).removeClass('selected');
		}
	});
		
}

function board_filter(){ //过滤结果
	var val=get_filter_str();
	location.hash='#'+val;
	$('#searchval').val(val);
	if(filter.metype!=''){		
		jQuery.getJSON(correcturl(cpurl+'&do=filterme'),{'metype':filter.metype},function(json){
			if(json.msg=='success'){
				var taskids=json.taskids;
				for (var i in taskids){
					taskids[i]='#task_'+taskids[i];
				}
				var selector=taskids.join(',');
				jQuery('.task-item:not('+selector+')').addClass('hide');
			}
		});
	}else{
		jQuery('.task-item').each(function(){
			var hide=0;

			//按标签筛选
			if(filter.labels.length){
				var labels=[];
				jQuery(this).find('.task-item-labels .task-label').each(function(){
					labels.push(jQuery(this).attr('pow'));
				});
				for(var i in filter.labels){
					if(jQuery.inArray(filter.labels[i],labels)<0){
						hide=1;
						break;
					}
				}
			}
			if(hide>0){
				jQuery(this).addClass('hide');
				return true;	
			}

			//按用户筛选
			if(filter.uids.length){ 
				var uids=[];
				jQuery(this).find('.task-item-members .avatar').each(function(){
					uids.push(jQuery(this).attr('uid'));
				});
				for(var i in filter.uids){
					if(jQuery.inArray(filter.uids[i],uids)<0){
						hide=1;
						break;
					}
				}
			}
			if(hide>0){
				jQuery(this).addClass('hide');
				return true;	
			}

			//按日期筛选
			if(filter.datetype!=''){
				switch(filter.datetype){
					case 'today':
						var today=new Date().format('yyyy-MM-dd');
						if(!jQuery(this).find('.task-badge-time[time='+today+']').length) hide=1;
						break;
					case 'tomorrow':
						var today=new Date();
						today.setDate(today.getDate()+1);
						var tomorrow=today.format('yyyy-MM-dd');
						if(!jQuery(this).find('.task-badge-time[time='+tomorrow+']').length) hide=1;
						break;
					case 'week':
						if(!jQuery(this).find('.task-badge-time').length){ 
							hide=1;
						}else{
							var today=new Date();
							var cday=today.getDay();
							var date=today.getDate();
							var week_l=new Date();
							week_l.setDate(date-cday+1);
							week_l_stamp=week_l.getTime();
							var week_u=new Date();
							week_u.setDate(date+(7-cday));
							week_u_stamp=week_u.getTime();
							var taskdate=new Date(jQuery(this).find('.task-badge-time').attr('time')).getTime();
							if(taskdate<week_l || taskdate>week_u){
								hide=1;	
							}
						}
						break;
					case 'nextweek':
						if(!jQuery(this).find('.task-badge-time').length){ 
							hide=1;
						}else{
							var today=new Date();
							var cday=today.getDay();
							var date=today.getDate();
							var week_l=new Date();
							week_l.setDate(date-cday+1+7);
							week_l_stamp=week_l.getTime();
							var week_u=new Date();
							week_u.setDate(date+(7-cday)+7);
							week_u_stamp=week_u.getTime();
							var taskdate=new Date(jQuery(this).find('.task-badge-time').attr('time')).getTime();
							if(taskdate<week_l || taskdate>week_u){
								hide=1;	
							}
						}
						break;
					case 'month':
						if(!jQuery(this).find('.task-badge-time').length){ 
							hide=1;
						}else{
							var today=new Date();
							var cmonth=today.getMonth();
							var date=today.getDate();
							var month_l=new Date();
							month_l.setDate(1);
							month_l_stamp=month_l.getTime();
							var month_u=new Date();
							month_u.setMonth(cmonth+1);
							month_u.setDate(1);
							month_u_stamp=month_u.getTime();
							var taskdate=new Date(jQuery(this).find('.task-badge-time').attr('time')).getTime();
							if(taskdate<month_l || taskdate>=month_u){
								hide=1;	
							}
						}
						break;
					case 'due':
						if(!jQuery(this).find('.task-badge-time.badge-expire-due').length) hide=1;
						break;

				}
			}

			if(hide>0){
				jQuery(this).addClass('hide');
				return true;	
			}

			//按名称查询
			if(filter.keyword!=''){
				if(jQuery(this).find('.task-item-title').html().indexOf(filter.keyword)===-1){
					hide=1;
				}
			}
			if(hide>0){
				jQuery(this).addClass('hide');
				return true;	
			}else{
				jQuery(this).removeClass('hide');
				return true;
			}
		});
	}
	
	if(board.layout<1){
		layout_catlist();
	}
}
function board_filter_label(pow,obj){
	var el=jQuery(obj);
	el.find('.dzz').toggleClass('dzz-done');
	if(el.find('.dzz-done').length){//添加到filter
		if(jQuery.inArray(pow,filter.labels)<0){
			filter.labels.push(pow);
		}
	}else{
		if(jQuery.inArray(pow,filter.labels)>-1){
			for(var i in filter.labels){
				if(filter.labels[i]==pow) filter.labels.splice(i,1);
			}
		}
	}
	filter.metype='';
	board_filter();
}
function board_filter_user(uid,obj){
	var el=jQuery(obj).parent();
	el.toggleClass('selected');
	if(el.hasClass('selected')){//添加到filter
		if(jQuery.inArray(uid,filter.uids)<0){
			filter.uids.push(uid);
		}
	}else{
		if(jQuery.inArray(uid,filter.uids)>-1){
			for(var i in filter.uids){
				if(filter.uids[i]==uid) filter.uids.splice(i,1);
			}
		}
	}
	filter.metype='';
	board_filter();
}
function board_filter_date(datetype,obj){
	var el=jQuery(obj);
	if(el.hasClass('selected')){//添加到filter
		filter.datetype='';
	}else{
		filter.datetype=datetype;
	}
	filter.metype='';
	el.parent().parent().find('a').removeClass('selected');
	if(filter.datetype!='') el.addClass('selected');
	board_filter();
}
var keyTimer=null;
var keyDelay=500;
function board_filter_keyword(keyword){
	filter.keyword=keyword;
	filter.metype='';
	if(keyTimer) window.clearTimeout(keyTimer);
	keyTimer=window.setTimeout(function(){board_filter();},keyDelay);
}

function board_filter_clear(){
	filter={'keyword':'','labels':[],'uids':[],'datetype':'','metype':''};
	filter_init();
	board_filter();
}
function filter_me(metype,obj){
	filter={'keyword':'','labels':[],'uids':[],'datetype':'','keyword':'','metype':metype};
	board_filter();
	if(metype!=''){
		jQuery.getJSON(correcturl(cpurl+'&do=filterme'),{'metype':metype},function(json){
			if(json.msg=='success'){
				var taskids=json.taskids;
				for (var i in taskids){
					taskids[i]='#task_'+taskids[i];
				}
				var selector=taskids.join(',');
				jQuery('.task-item:not('+selector+')').addClass('hide');
				if(board.layout<1){
				layout_catlist();
				
				}
			}
		});
	}
	jQuery('.dropdown-height').hide();
}

function task_active_to(taskid,catid){
	jQuery.getJSON(correcturl(cpurl+'&do=taskactive'),{'taskid':taskid,'catid':catid},function(data){
		if(data.msg=='success'){
			jQuery('#task_'+taskid).slideUp(500,function(){jQuery('#task_'+taskid).remove();});
			task_panel_close();
		}
	});
}
function task_restore_to(taskid,catid){
	jQuery.getJSON(correcturl(cpurl+'&do=taskrestore'),{'taskid':taskid,'catid':catid},function(data){
		if(data.msg=='success'){
			jQuery('#task_'+taskid).slideUp(500,function(){jQuery('#task_'+taskid).remove();});
			task_panel_close();
		}
	});
}
function cat_active(catid){
	showDialog('确定要激活此列表吗？','confirm','',function(){
	jQuery.getJSON(correcturl(cpurl+'&do=catactive'),{'catid':catid},function(data){
		if(data.msg=='success'){
			jQuery('#cat_'+catid).slideUp(500,function(){jQuery('#cat_'+catid).remove();});
		}
	});
	},1);
}
function cat_restore(catid){
	showDialog('确定要恢复此列表吗？','confirm','',function(){
	jQuery.getJSON(correcturl(cpurl+'&do=catrestore'),{'catid':catid},function(data){
		if(data.msg=='success'){
			jQuery('#cat_'+catid).slideUp(500,function(){jQuery('#cat_'+catid).remove();});
		}
	});
	},1);
}
function task_delete_permanent (taskid){
	showDialog('确定要彻底删除此任务吗？<br><small>此操作不可恢复，请注意</small>','confirm','',function(){
	jQuery.getJSON(correcturl(cpurl+'&do=taskdeletepermanent'),{'taskid':taskid},function(data){
		if(data.msg=='success'){
			jQuery('#task_'+taskid).slideUp(500,function(){jQuery('#task_'+taskid).remove();});
		}
	});
	},1);
}
function cat_delete_permanent(catid){
	showDialog('删除列表时列表下的所有任务都将被删除，确定要彻底删除此列表吗？<br><small>此操作不可恢复，请注意</small>','confirm','',function(){
	jQuery.getJSON(correcturl(cpurl+'&do=catdeletepermanent'),{'catid':catid},function(data){
		if(data.msg=='success'){
			jQuery('#cat_'+catid).slideUp(500,function(){jQuery('#cat_'+catid).remove();});
		}
	});
	},1);
}
function task_attach_restore(id){
	showDialog('确定要恢复此附件吗？','confirm','',function(){
	jQuery.getJSON(correcturl(cpurl+'&do=taskattachrestore'),{'id':id},function(data){
		if(data.msg=='success'){
			jQuery('#attach_'+id).slideUp(500,function(){jQuery('#attach_'+id).remove();});
		}
	});
	},1);
}
function task_attach_delete_permanent(id){
	showDialog('确定要彻底删除此附件吗？<br><small>此操作不可恢复，请注意</small>','confirm','',function(){
		jQuery.getJSON(correcturl(cpurl+'&do=taskattachdeletepermanent'),{'id':id},function(data){
			if(data.msg=='success'){
				jQuery('#attach_'+id).slideUp(500,function(){jQuery('#attach_'+id).remove();});
			}
		});
	},1);
}
function board_setting_archive(tbid){//归档任务版
	$.confirm('确定要归档此任务板？<br><small>归档后的任务板任何人都不能做修改操作；可以在已归档内找到，并且可以再次激活</small>',function(){
			jQuery.getJSON(correcturl(ajaxurl+'&do=setting&operation=archive'),{'tbid':tbid},function(data){
				if(data.msg=='success'){
					$.alert('归档成功！正在刷新页面...',function(){
						window.location.reload();
					});
				}else{
					$.alert(json.error);
				}
			});
	},1);
}
function board_setting_active(tbid){//归档任务版
	$.confirm('确定要激活此任务板？<br><small>激活后的任务板将恢复正常状态，成员可以进行修改操作</small>',function(){
			jQuery.getJSON(correcturl(ajaxurl+'&do=setting&operation=active'),{'tbid':tbid},function(data){
				if(data.msg=='success'){
					$.toast('激活成功！正在刷新页面...',function(){
						window.location.reload();
					});
				}else{
					$.toast(json.error,'forbidden');
				}
			});
	},1);
}
function board_setting_restore(tbid){//归档任务版
	$.confirm('确定要恢复此任务板？<br><small>恢复后的任务板将恢复正常状态，成员可以进行修改操作</small>',function(){
			jQuery.getJSON(correcturl(ajaxurl+'&do=setting&operation=restore'),{'tbid':tbid},function(data){
				if(data.msg=='success'){
					$.toast('恢复成功！正在刷新页面...',function(){
						window.location.reload();
					});
				}else{
					$.toast(json.error,'forbidden');
				}
			});
	},1);
}
function board_setting_delete(tbid){//归档任务版
	$.confirm('确定要删除此任务板？<br><small>删除后的任务板可以在回收站内找到</small>',function(){
			jQuery.getJSON(correcturl(ajaxurl+'&do=setting&operation=delete'),{'tbid':tbid},function(data){
				if(data.msg=='success'){
					$.toast('删除成功！正在刷新页面...',function(){
						window.location.reload();
					});
				}else{
					$.toast(json.error,'forbidden');
				}
			});
	},1);
}
function board_recycle_empty(tbid){//清空任务板回收站
	$.confirm('此操作将清空回收站内所有任务、列表和文件，且不可恢复<br>您确定要清空回收站吗？',function(){
			jQuery.getJSON(correcturl(ajaxurl+'&do=recycle&operation=empty'),{'tbid':tbid},function(data){
				if(data.msg=='success'){
					$.toast('清空完成！正在刷新页面...',function(){
						window.location.reload();
					});
				}else{
					$.toast(json.error,'forbidden');
				}
			});
	},1);
}
function toggleRight() {
	if (jQuery('.toggRight').parent('li').hasClass('background-toggle')) {
		jQuery('.bs-main-container').css({
			'margin-right': '0px'
		});
		jQuery('.rightMenu').css('right', '-320px');
		jQuery('.toggRight').parent('li').removeClass('background-toggle').find('.dzz').attr("data-original-title", "开启右侧信息");
		
		
	} else {
		jQuery('.bs-main-container').css({
			'margin-right': '300px'
		});
		jQuery('.rightMenu').css('right', '0');
		jQuery('.toggRight').parent('li').addClass('background-toggle').find('.dzz').attr("data-original-title", "关闭右侧信息");
		jQuery('#rightMenu').load(MOD_URL+'&op=list&do=panel&tbid='+tbid);
	}
};
//底部更多
jQuery(document).off('touchstart.sort').on('touchstart.sort', '.weui-footer-sort', function () {
    var dropup = $(this).next('.weui-dropup');
    if (dropup.hasClass('hide')) {
        dropup.removeClass('hide');
        dropup.next('.background-none').show();
        $(this).find('p').css({'color': '#17ae4b'});
    }
})
//弹出框点击其他地方消失
jQuery(document).off('touchstart.none').on('touchstart.none', '.background-none', function () {
    $(this).prev('.weui-dropup').addClass('hide');
    $(this).prevAll('.weui-footer-none').find('p').css({'color': '#999'});
    $(this).hide();
})
